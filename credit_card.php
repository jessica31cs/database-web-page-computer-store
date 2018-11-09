<?php
$serveLName = "localhost";
$useLName = "cs631";
$password = "cs631";
$dbname = "cs631database";
// Create connection
$conn = new mysqli($serveLName, $useLName, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css">
</head>
<body>
<h2> Card Details </h2>

<?php
	session_start();

	if(isset($_POST['sub']))  { //check null
		$CCNumber = $_POST['CCNumber']; // text field for Credit Card Number
		$SecNumber = $_POST['SecNumber']; // text field for CVV
		$OwnerName = $_POST['OwnerName']; // text field for OwnerName
		$CCType = $_POST['CCType']; // text field for CCType
		$CCAddress = $_POST['CCAddress']; // text field for CCAddress
		$ExpDate = $_POST['ExpDate']; // text field for ExpDate

	//connect to the db 

		$link = mysqli_connect($serveLName,$useLName,$password) or die( "Unable to connect");
		mysqli_select_db($link, $dbname) or die( "Unable to select database");
			
			$cidd = (int)$_SESSION['cid'];
			$insert = "INSERT INTO credit_card (`CID`, `CCNumber`,`SecNumber`,`OwnerName`,`CCType`,`CCAddress`,`ExpDate`) VALUES ($cidd, $CCNumber, $SecNumber, '$OwnerName','$CCType','$CCAddress','$ExpDate')";
			$result = mysqli_query ($link, $insert)  or die(mysqli_error($link)); 
			
			$sql_query = "INSERT INTO stored_card (CCNumber, CID) VALUES ($CCNumber, $cidd)";
			$result = $link->query($sql_query);
			
			if($result == false)
				{
				echo 'Reader could not be added at this moment.';
				exit();
			}
			header('Location: shippingA.php');	
    } 
	
?>


<form action="" method="post">
	Credit Card Number<input type="text" name="CCNumber" autofocus required />
	<br><br>
	CVV<input type="text" name="SecNumber" required />
	<br><br>
	Card Holder Name <input type="text" name="OwnerName" required />
	<br><br>
	Credit Card Type
	<select name="CCType">
	<option value ="Visa">Visa</option>
	<option Value ="Master Card">Master Card</option>
	<option value ="American Express">American Express<>
	</select>
	<br><br>
	Credit Card address <input type="text" name="CCAddress" required />
	<br><br>
	Expiry date <input type="text" name="ExpDate" required />
	<br><br>
	<input type="submit" value="Save" name = "sub"/>
</form>
</body>
</html>