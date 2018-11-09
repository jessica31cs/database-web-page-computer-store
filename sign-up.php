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
<?php
	session_start(); 
?>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css">
</head>
<body>
<h2> Register a New Customer </h2>

<?php
//connect to the db 

$link = mysqli_connect($serveLName,$useLName,$password) or die( "Unable to connect");
mysqli_select_db($link, $dbname) or die( "Unable to select database");
if(isset($_POST['sub']))  { //check null
	
	$FName = $_POST['FName']; // text field for FName
	$LName = $_POST['LName'];//text field for LName
	$Email = $_POST['Email'];//text field for email
	$Password = $_POST['Password'];//text field for password
	$address = $_POST['address'];//text field for address
	$phone = $_POST['phone'];//text field for phone
	$status = $_POST['status'];//text field for address
	
	
	
	// store session data
	

	$insert = "INSERT INTO customer (`FName`,`LName`,`Email`,`Password`,`address`,`phone`,`status`) VALUES ('$FName','$LName','$Email','$Password','$address','$phone','$status')";
	$result = mysqli_query ($link, $insert)  or die(mysqli_error($link));
	
	$getQuery = "SELECT CID FROM customer WHERE Email='$Email'";
	$getResult = mysqli_query ($link, $getQuery)  or die(mysqli_error($link));
	$obj = mysqli_fetch_array($getResult);
	$_SESSION['cid'] = htmlspecialchars($obj[0]);
	if($result == false)
		{
		echo 'Customer could not be added at this moment.';
		exit();
	}
	header('Location: credit_card.php');	
} 
	
?>


<form action="" method="post">

First Name <input type="text" name="FName" required />
<br><br>
Last Name <input type="text" name="LName" required />
<br><br>
Email <input type="text" name="Email" required />
<br><br>
Password <input type="text" name="Password" required />
<br><br>
Address <input type="text" name="address" required />
<br><br>
Phone <input type="text" name="phone" required />
<br><br>
Status <input type="text" name="status" required />
<br><br>
<input type="submit" value="Sign Up" name="sub" />
</form>

</body>
</html>