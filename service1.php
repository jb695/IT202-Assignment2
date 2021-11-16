<?php
session_set_cookie_params ( 0, "/~jb695/assignment2/" );
session_start();

if (!isset ($_SESSION["pinpass"] ) ) 
{
	echo "<br> Not authorized. Please enter Captcha to proceed." ;
	header ( "refresh: 2; url=captcha.html");
	exit();
}
?>

<!DOCTYPE html>

<meta charset = "utf-8">

<style> selector {property:value;}
#number, #account, #amount {display: none;}
form{margin:auto; border:1px dashed blue; padding:20px; width:300px; }
</style>

<form action = "service2.php" autocomplete ="off">
<option value = '' >Please Choose a Service. </option>
<input type = radio name = "choice" id = "List" value = "List" >List Number of Transactions<br>
<input type = radio name = "choice" id = "Perform" value = "Perform" >Perform a Transaction<br>
<input type = radio name = "choice" id = "Clear" value = "Clear" >Clear Account of Transactions<br>


<div id = "number"  ><input type = text name= "number"   > Enter Number<br></div>
<div id = "account" ><input type = text name= "account"  > Enter Account<br></div>
<div id = "amount"  ><input type = text name= "amount"   > Enter Amount<br></div> 

<input type = submit>
</form>

<script>
var ptrList = document.getElementById("List")
var ptrPerform = document.getElementById("Perform")
var ptrClear = document.getElementById("Clear")

var ptrNumber = document.getElementById("number") 
var ptrAccount = document.getElementById("account")
var ptrAmount = document.getElementById("amount")

ptrList.addEventListener("click", F)
ptrPerform.addEventListener("click", F)
ptrClear.addEventListener("click", F)

function F(){
	ptrNumber.style.display =  "none" 
	ptrAccount.style.display =  "none"
	ptrAmount.style.display =  "none"


	if(this.value == "List") {
		ptrNumber.style.display = "block"; 
	}

	if(this.value == "Perform"){
		ptrAccount.style.display = "block"
		ptrAmount.style.display = "block"
	}

	if(this.value == "Clear") {
		ptrAccount.style.display = "block"
	
	}
}
	
</script>