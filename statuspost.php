<?php
$servername = "localhost";
$username = "cs631";
$password = "cs631";
$dbname = "cs631database";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>
<?php


    		Function get_table()
    		{
          $CartID = 0;
         $CartID = $_POST['CartID'];
    			
			
			$sql=( "SELECT * FROM cart WHERE CartID='$CartID' ");
			$result = $conn->query($sql);
			$rowcount=mysqli_num_rows($result);
			
			

			if ($rowcount > 0) {
    			// output data of each row
    			#echo "inside if";
    			while($row = $result->fetch_assoc()) {
    				#echo "inside while";
					$date = "2018-2-14";
					
    				

			}
			}			
			
        $_SESSION['cart']=$CartID;
			$conn->close();
			return $table_str;
    		}

			
		
?>

<html>

<body>
	
		
		<br><br>
		<div>
		<center>
		<form method= "post" action="cart1.php">
			ENTER THE CART ID: <input type="number" name="CartID" value="<?php print_r($_SESSION['cart']) ?>" ><br>
		<form method= "post" action="cart1.php">	
			<select name="TStatus">
  <option value="shipped">shipped</option>
  <option value="not shipped">not shipped</option>
  <option value="proccessing">processing</option>
</select>
<br>
<br>
			<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
  					Submit
			</button>
		</form>
		
		
		<p>
<form action="CheckStatus.php">
<input type="submit" value="back">
</form>

</p>
</div>
	</center>	
</form>
</body>
</html>