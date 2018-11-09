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
<body>
        
         Credit Card Number
         <div>
		 <?php
			$conn = mysqli_connect('localhost','cs631','cs631') or die( "Unable to connect");
			mysqli_select_db($conn, $dbname) or die( "Unable to select database");
			
			$c = (int)$_SESSION['cid'];
			$sql = "SELECT CCNumber from credit_card WHERE CID=$c";
			$result = $conn->query($sql);
			$obj = mysqli_fetch_array($result);
			$ccNum = (int)htmlspecialchars($obj[0]);
			
			echo "CID : ". $c. "<br>";
			echo "CCNumber  :". $ccNum. "<br>";
		 ?>
		 </div>
		 
            
        <input type="submit" name="submit" value="products" onclick = "location.href = 'products.php'">
    </body>
</html>
