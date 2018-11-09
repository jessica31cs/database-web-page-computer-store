<?php  
$servername = "localhost";
$username = "cs631";
$password = "cs631";
$dbname = "cs631database";
?>

<html>
<head>
	
	<title>main</title>
</head>
<body>
 <Center>
		<h1>Admin Page</h1>
	</center>
	<center>
	
	
	<p align="center">



<p><font size="5"> Select a product to Add</p>
 <p>Product type:
<select name="menu" onchange="gotoPage(this)">
<option value="#">Select a Product</option>
<option value="computer.php">computer</option>
<option value="laptop.php">laptop</option>
<option value="printer.php">printer</option>
</select>
</p>
<input type="button"   onClick="location=document.jump.menu.options[document.jump.menu.selectedIndex].value;" value="Next">
</form><br><br>
<form action="Admin1.php">
<input type="submit" value="Previous">
</form>

</p>


<script type="text/javascript">
function gotoPage(select){
    window.location = select.value;
}
 
</script>
	
	
		
	
	</center>	
    </div>
  </main>
</div>

</body>
</html>