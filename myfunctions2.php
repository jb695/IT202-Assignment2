<?php

function safe($fieldname)
{
	global $db;
	global $flag;
	$temp = $_GET[$fieldname];
	$temp = trim($temp);
	$temp = mysqli_real_escape_string($db, $temp);

	
	if($fieldname == "ucid") 
	//The code below will only be executed if safe("ucid");
	{
		
	$count = preg_match( '/^[a-z]{1,4}\s?[0-9]{0,3}$/i', $temp, $matches); //imposes pattern requirements
	//and feeds it the trimmed and mysqli escaped $v string

		if( $count == 0) //if count is 0, then no matches were made
		{
			echo "$fieldname $temp did not satisfy Regex.<br>";
			$flag = false; //flag is set to false when fieldname/ucid doesn't satisfy pattern
			return "Illegal";
		}
	
		else
		{
			echo "$fieldname $temp satisfies Regex.<br>";
			return $temp;	
		}
	}
	
	if($fieldname == "pass")
		
	{
		$count = preg_match( '/^[a-zA-Z0-9?*]{3,5}$/', $temp, $matches); 
		
		if( $count == 0) //if count is 0, then no matches were made
		{
			echo "$fieldname $temp did not satisfy Regex.<br>";
			$flag = false; //flag is set to false when fieldname/ucid doesn't satisfy pattern
			return "Illegal";
		}
	
		else
		{
			echo "$fieldname $temp satisfies Regex.<br>";
			return $temp;	
		}
	}
	
	
	if($fieldname == "amount")
		
	{	
		$count = preg_match( '/^[+-]?([0-9]{1,9}|[0]{1,2})?(\.[0-9]{2})?$/' , $temp, $matches); 
	
		if( $count == 0) //if count is 0, then no matches were made
		{
			echo "$fieldname $temp did not satisfy Regex.<br>";
			$flag = false; //flag is set to false when fieldname/ucid doesn't satisfy pattern
			return "Illegal";
		}
	
		else
		{
			echo "$fieldname $temp satisfies Regex.";
			return $temp;	
		}
	}
			
		
	echo "<br>$fieldname has a value of $temp";
	return $temp;
}


function auth($ucid, $pass) 
{ 
	global $db; 
	$s = "select * from users where ucid = '$ucid'"; 

	( $t = mysqli_query($db,	$s) ) or	die( mysql_error($db )	);
	
	while (	$r = mysqli_fetch_array ($t , MYSQL_ASSOC)	) 
		
		{
			$hash = $r["hash"];
		}
		
		if(password_verify($pass, $hash))
		{
			echo "<br><br>Password is Valid!";
			return true;
		}
		else 
		{
			echo "<br><br>Invalid Password.";
			return false;
		}
}


function retrieve($ucid, $number){
	global $db;
	$s = "select * from accounts where ucid = '$ucid'";

	( $t = mysqli_query($db,	$s) ) or	die( mysql_error($db )	);

while (	$r = mysqli_fetch_array ($t , MYSQL_ASSOC)	) 
	{
		
		$ucid = $r["ucid"];
		$account = $r["account"];
		$balance = $r["balance"]; 
		$recent = $r["recent"]; 

		echo "<br><br><b>UCID: $ucid</b>||";
		echo "<b>Account:$account</b> ||";
		echo "<b>Balance: $ $balance</b> || ";
		echo "<b>Most Recent : $recent</b>";
	

		
	
	 $s = "select * from transactions where ucid = '$ucid' and account = '$account' order by timestamp DESC limit $number";
	( $g = mysqli_query($db, $s) ) or	die( mysql_error($db )	); 
	
	while ($r = mysqli_fetch_array ($g , MYSQL_ASSOC)	) 
	{
		
		$amount = $r["amount"]; 
		$timestamp = $r["timestamp"];
		$mail = $r["mail"];
		
		echo "<br><br><i>Amount: $ $amount</i> ||";
		echo "<i>Timestamp: $timestamp</i> || ";
		echo "<i>Mail Copy : $mail</i>";
		
	
	}
	echo "<hr>";
	
	}
}

function clear($ucid, $account){
	
	global $db;
	$s = "delete from transactions where ucid = '$ucid' and account = '$account'";
	mysqli_query($db,	$s) or	die( mysql_error($db )	);
	
	$s = "update accounts

		set			balance = 0.00, 
					recent  = NOW() 
		
		where		
				ucid = '$ucid'	and account = '$account'  ";	
	mysqli_query($db,	$s) or	die( mysql_error($db )	);
	
	echo "<br><br>Transactions from Account $account have been cleared.";
	
}

function transact($ucid, $account, $amount)	{
		
	global $db;
	
	$s = "insert into transactions values ('$ucid', '$account', '$amount', NOW(), 'N')";
	mysqli_query($db, $s) or die(mysql_error($db));
	
	$a = "update accounts

	set				balance = balance + '$amount', 
					recent  = NOW() 
		
	where		
		ucid = '$ucid'	and account = '$account' and balance + '$amount' >= 0.00 ";	

	mysqli_query($db,	$a)  or	die( mysql_error($db )	);
	$num2 = mysqli_affected_rows($db);
	
	if($num2 == 0)
	{
	echo "<br>Overdraft Detected. Balanced Unchanged.";
	}
	
	else
	{
	echo "<br>Transaction Approved. Balanced Updated.";		
	}
	


}
?>

