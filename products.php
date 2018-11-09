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
	$todayDate = date("m/d/y");
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
	<h3>Products</h3>
	<form action="" method="post">
		<input type="submit" name="productType" value="Computer">
		<input type="submit" name="productType" value="Laptop">
		<input type="submit" name="productType" value="Printer">
		<input type="submit" name="cart" value="Cart">
		<input type="submit" name="home" value="Sign Out">
	</form>
	<div>
		<?php //only for displaying values
			if(isset($_POST['productType'])){
				$selected = $_POST['productType'];
				
				$sql = "SELECT * FROM product WHERE PType = '$selected'";
				$result = $conn->query($sql);
				
				if ($result->num_rows >0){ //if there are tuples
					while($row=$result->fetch_assoc()){
						echo "Type: ". $row['PType']. 
						"<br>PName : ". $row['PName']. 
						"<br>Price : ". $row['PPrice']. 
						"<br>Description: ". $row['Description'].
						"<br>";
					
						$pid = $row['PID']; //current pid
						//$_SESSION['pid'] = $pid;
						$sql_info = "SELECT * FROM $selected as temp Where temp.PID = $pid";
						$info = $conn->query($sql_info);
						while($obj = mysqli_fetch_array($info)){
							for($x = 1; $x < mysqli_num_fields($info); $x++){
								echo htmlspecialchars($obj[$x]);
								echo "<br>";
							}
						}
						echo '<form action="" method="post">';
						echo '<input type="submit" value="'. $pid. '" name="addCart"><br>';
						echo '</form>';
					}
				}
			}
		?>
	</div>
</body>
</html>
<?php
	if(isset($_POST['addCart'])){
		$c = (int)$_SESSION['cid'];
		$getSAName = "SELECT SAName FROM shipping_address as s WHERE s.CID=$c";
		$runVal = mysqli_query ($conn, $getSAName)  or die(mysqli_error($conn));
		$obj = mysqli_fetch_array($runVal);
		$SANameVal = htmlspecialchars($obj[0]);
		
		$getCCNum = "SELECT CCNumber FROM stored_card as sc WHERE sc.CID=$c";
		$runVal = mysqli_query ($conn, $getCCNum)  or die(mysqli_error($conn));
		$obj = mysqli_fetch_array($runVal);
		$CCNum = (int)htmlspecialchars($obj[0]);
		
		$numCart = "SELECT * FROM cart";
		$execute = $conn->query($numCart);
		$result = mysqli_num_rows($execute) +1;	
		$inser = "INSERT INTO cart(CartID, CID, SAName, CCNumber, TStatus, TDate) 
		VALUES ($result, $c, '$SANameVal', $CCNum, 'good', '$todayDate')";
		$run = $conn->query($inser);
		
		$p = $_POST['addCart'];
		$getPrice = "SELECT PPRice FROM product WHERE PID=$p";
		$runVal = mysqli_query ($conn, $getPrice)  or die(mysqli_error($conn));
		$obj = mysqli_fetch_array($runVal);
		$price = (int)htmlspecialchars($obj[0]);	
		
		$inser2 = "INSERT INTO appears_in(CartID, PID, Quantity, PriceSold) 
		VALUES ($result, $p, 1, $price)";
		$run2 = $conn->query($inser2);
		
		$inser3 = "INSERT INTO offer_product(PID, OfferPrice) VALUES ($p, $price)";
		$run3 = $conn->query($inser3);
	}
	if(isset($_POST['cart'])){
		header('Location: cart.php');
	}
	if(isset($_POST['home'])){
		header('Location: login.php');
	}
?>