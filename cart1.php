<?php
$servername = "localhost";
$username = "cs631";
$password = "cs631";
$dbname = "cs631database";
$CartID = $_POST['CartID'];
$TStatus = $_POST['TStatus'];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "UPDATE cart SET TStatus='$TStatus' WHERE CartID='$CartID'";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
	
	{
		header('location:CheckStatus.php');
	}

} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
