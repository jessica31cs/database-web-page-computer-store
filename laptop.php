<?php  
$servername = "localhost";
$username = "cs631";
$password = "cs631";
$dbname = "cs631database";
?>

<html>
<head>
	
	<title>LAPTOP</title>
</head>
<body>
	<!-- Uses a header that scrolls with the text, rather than staying
  locked at the top -->

  </header>
 
  <main class="mdl-layout__content">
    <div class="page-content">
    <!-- Your content goes here -->
		<center>
		<h1>
			LAPTOP
		</h1>
	</center>
	<center>
		<form method= "post" action="AddLaptop.php">
			ProductID: <input type="number" name="PID" ><br><br>
			Product Type: <input type="text" name="PType"><br><br>
			Product name: <input type="text" name="PName"><br><br>
			Price: <input type="text" name="PPrice" ><br><br>
			Description: <input type="text" name="Description"><br><br>
			Product Quantity:<input type="text" name="PQuantity"><br><br>
			Battery Type:<input type="text" name="BType"><br><br>
			Weight: <input type="float" name="Weight"><br><br>
			
			
			<button>Submit</button>			</form>
	<p>
<form action="Admin1.php">
<input type="submit" value="back">
</form>

</p>

	
	</center>	
    </div>
  </main>
</div>

</body>
</html>