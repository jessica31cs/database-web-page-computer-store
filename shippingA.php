<?php
$servername = "localhost";
$username = "cs631";
$password = "cs631";
$dbname = "cs631database";
	date_default_timezone_set('America/New_York'); 										   
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>
<?php

session_start();
if(isset($_POST['Ship']) )  {
	$RecepientName = $_POST['RecepientName'];
	$SAName = $_POST['SAName'];
	$Street = $_POST['Street'];
	$SNumber = $_POST['SNumber'];
	$City = $_POST['City'];
	$Zip = $_POST['Zip'];
	$State = $_POST['State'];
	$Country = $_POST['Country'];
	
	$c = (int)$_SESSION['cid'];
	$link = mysqli_connect($servername,$username,$password) or die( "Unable to connect");
    mysqli_select_db($link, $dbname) or die( "Unable to select database");
	$sql_query = "Select cc.CID From customer as cc Where (cc.CID = $c)"; //going to validate user
	$result = mysqli_query ($link, $sql_query)  or die(mysqli_error($link)); 
	
	if (mysqli_num_rows($result)){ //checking if it returns something
		$row = mysqli_fetch_array($result);
		$sql_query = "INSERT INTO shipping_address(CID, SAName, RecepientName, Street, SNumber, City, Zip, State, Country) 
		VALUES($c,'$RecepientName','$SAName','$Street','$SNumber','$City','$Zip', '$State', '$Country')";
		//Run our sql query
		$result = mysqli_query ($link, $sql_query)  or die(mysqli_error($link));  
		if($result == false)
		{
			echo 'INSERTING failed.';
			exit();
		}
		header('Location: products.php');	
	}
	else{
		echo 'no such user id #, input again';
	}
	    
}
?> 
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<h3>Shipping Information</h3>
	<form action="" method="post">
		<table>
			<tr>
				<td>Recipient Name: </td>
				<td><input type="text" name="RecepientName" required></td>
			</tr>
			<tr>
				<td>Shipping Address Name: </td>
				<td><input type="text" name="SAName" required></td>
			</tr>
			<tr>
				<td>Street: </td>
				<td><input type="text" name="Street" required></td>
			</tr>
			<tr>
				<td>Street Number: </td>
				<td><input type="text" name="SNumber" required></td>
			</tr>
			<tr>
				<td>City: </td>
				<td><input type="text" name="City" required></td>
			</tr
			<tr>
				<td>Zip: </td>
				<td><input type="text" name="Zip" required></td>
			</tr>
			<tr>
				<td>State: </td>
				<td><input type="text" name="State" required></td>
			</tr>
			<tr>
				<td>Country: </td>
				<td><input type="text" name="Country" required></td>
			</tr>
		</table>
		<input type="submit" value="Ship" name="Ship">
	</form>
</body>
</html>