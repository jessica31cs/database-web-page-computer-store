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
	if(isset($_POST['start']) AND isset($_POST['end']) ){
		$start = $_POST['start'];
		$end = $_POST['end'];
	}
?>
<html>
	<head>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<h3>STATISTICS</h3>		
		<form action="" method="post">
			Start Date : <input type="text" name="start" value="MM/DD/YY"><br><br>
			End Date : <input type="text" name="end" value="MM/DD/YY"><br>
			<br><br>
			<input type="submit" name="freqSP" value ="Most frequently sold product">
			<div>
				<?php
					if(isset($_POST['freqSP'])) {
						$sql = "SELECT a.PID, COUNT(*) AS temp
								FROM appears_in as a, product as p, cart as c
								WHERE a.PID = p.PID AND c.CartID = a.CartID AND (c.TDate BETWEEN '$start' AND '$end')
								GROUP BY a.PID
								ORDER BY temp DESC LIMIT 1";
						$run = $conn->query($sql);
						$obj = mysqli_fetch_array($run);
						$maxProd = (int)htmlspecialchars($obj[0]);
						
						$sql2="SELECT PType, PName FROM  product WHERE PID=$maxProd";
						$run2 = $conn->query($sql2);
						$obj2 = mysqli_fetch_array($run2);
						$prod = htmlspecialchars($obj2[0]);
						$prod2 = htmlspecialchars($obj2[1]);
						echo "Start Date: ". $start. "<br>End Date : ". $end. "<br><br>";
						echo $prod2. " ". $prod. "<br>";
					}
				?>
			</div>
			<br>
			<input type="submit" name="highDC" value ="Products sold to highest number of distinct customers">
			<div>
				<?php
					if(isset($_POST['highDC'])) {
						$sql = "SELECT MAX(X),PID 
								FROM (SELECT PID,COUNT(DISTINCT CID) AS X 
										FROM cart as c, appears_in as a
										WHERE c.CartID = a.CartID AND (c.TDate BETWEEN '$start' AND '$end')
										GROUP BY PID) AS Z";
						$result = $conn->query($sql);
						$obj = mysqli_fetch_array($result);
						$p = htmlspecialchars($obj[1]);
						
						$sql2 = "SELECT PType, PName FROM product WHERE PID = '$p'";
						$result2 = $conn->query($sql2);
						$obj2 = mysqli_fetch_array($result2);
						$high1 = htmlspecialchars($obj2[0]);
						$high2 = htmlspecialchars($obj2[1]);
						echo "Start Date: ". $start. "<br>End Date : ". $end. "<br><br>";
						echo "PType: ". $high1. "<br>PName: ". $high2. "<br><br>";
					}
				?>
			</div>
			<br>
			<input type="submit" name="bestDC" value ="10 best customers in DESC order"> <!--highest money spent-->
			<div>
				<?php
					if(isset($_POST['bestDC'])) {
						$sql = "SELECT c.CID, SUM(PriceSold) as temp 
								FROM appears_in as a, cart as c
								WHERE a.CartID = c.CartID AND (c.TDate BETWEEN '$start' AND '$end')
								GROUP BY c.CID 
								ORDER BY temp DESC LIMIT 10";
								
						$run = $conn->query($sql);
						while($obj = mysqli_fetch_array($run)){
							$id = (int)htmlspecialchars($obj[0]);
							$price = (int)htmlspecialchars($obj[1]);
							
							$sql_query = "SELECT FName, LName FROM customer WHERE CID=$id";
							$run2 = $conn->query($sql_query);
							$obj2 = mysqli_fetch_array($run2);
							$fn= htmlspecialchars($obj2[0]);
							$ln = htmlspecialchars($obj2[1]);
							echo "Start Date: ". $start. "<br>End Date : ". $end. "<br><br>";
							echo "Name: ". $fn. " ". $ln. "<br>". " Total: ". $price. "<br><br>";
						}
						
					}
				?>
			</div><br>
			<input type="submit" name="bestZP" value ="5 best zip codes"> <!-- interms of shipments made-->
			<div>
				<?php
					if(isset($_POST['bestZP'])) {
						$sql = "SELECT s.Zip, COUNT(*) AS temp
								FROM cart as c, shipping_address as s
								WHERE c.CID = s.CID and c.SAName=s.SAName and (c.TDate BETWEEN '$start' AND '$end')
								GROUP BY s.Zip
								ORDER BY temp DESC LIMIT 5";
						$run = $conn->query($sql);
						while($obj = mysqli_fetch_array($run)){
							$zip = (int)htmlspecialchars($obj[0]);
							
							echo "Start Date: ". $start. "<br>End Date : ". $end. "<br><br>";
							echo $zip. "<br><br>";
						}
	
					}
				?>
			</div><br>
			<input type="submit" name="avgSell" value ="Average selling price per product type">
			<div>
				<?php
					if(isset($_POST['avgSell'])) {
						$sql = "SELECT PType, AVG(PriceSold)
								FROM appears_in as a, product as p, cart as c 
								WHERE a.PID = p.PID and c.CartID=a.CartID and (c.TDate BETWEEN '$start' AND '$end')
								GROUP BY p.PType";
						$run = $conn->query($sql);
						while($obj = mysqli_fetch_array($run)){
							$type = htmlspecialchars($obj[0]);
							$avg = (int)htmlspecialchars($obj[1]);
							
							echo "Start Date: ". $start. "<br>End Date : ". $end. "<br><br>";
							echo "Type: ". $type. "<br>".
							" Average Price: ". $avg. "<br><br>";
						}
					}
				?>
			</div>
		</form>
	</body>
</html>