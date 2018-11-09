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
	$conn = mysqli_connect($servername,$username,$password) or die( "Unable to connect");
	mysqli_select_db($conn, $dbname) or die( "Unable to select database");
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
	<h3>Cart</h3>
	<a href="products.php">BACK</a>
	<div>
		<?php
			$c = (int)$_SESSION['cid'];
			$sql = "SELECT * 
					FROM product as p, appears_in as a, cart as c
					WHERE p.PID= a.PID AND c.CartID = a.CartID AND c.CID=$c"; //everything from that user
			$result = $conn->query($sql);
			
			if ($result->num_rows >0){ //if there are tuples
				while($row=$result->fetch_assoc()){
					echo "Type: ". $row['PType']. 
					"<br>Name : ". $row['PName']. 
					"<br>Price : ". $row['PPrice']. 
					"<br>Description: ". $row['Description'].
					"<br>Quantity: ". $row['PQuantity'].
					"<br><br>";
				}
			}
		?>
		<form action = "" method="post">
			<input type="submit" value="Check out" name="checkout">
		</form>
	</div>
</body>
</html>
<?php
	if(isset($_POST['checkout']) )  {
		header('Location: thanks.php');
	}
?>