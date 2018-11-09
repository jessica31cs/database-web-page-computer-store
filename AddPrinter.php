<?php
	$conn = mysqli_connect("localhost","cs631","cs631","cs631database");
	session_start();
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>



<?php
	
	$PID = $_POST['PID'];
	$PType = "PRINTER";
	$PName = $_POST['PName'];
	$PPrice= $_POST['PPrice'];
	$Description = $_POST['Description'];    
	$PQuantity = $_POST['PQuantity'];
	$PrinterType = $_POST['PrinterType'];
	$Resolution=$_POST['Resolution'];
	
 
	#echo "MY USERNAME IS".$username." <br/> AND MY PASSWORD IS ".$password;
	
	
	
	$response=mysqli_query($conn, "SELECT * FROM product Where PID='$PID' ");
   	$rowcount=mysqli_num_rows($response);
	
	
	if($rowcount>0){
$x=mysqli_query($conn, "UPDATE product SET PQuantity=PQuantity+$PQuantity Where PID='$PID' ");		
	echo "product updated";
	}
	else {
$x=mysqli_query($conn, "INSERT INTO product(PID, PType, PName, PPrice, Description, PQuantity) VALUES ('$PID', '$PType', '$PName', '$PPrice', '$Description', '$PQuantity') ");
	echo "product added";
	$z=mysqli_query($conn,	"INSERT INTO `printer`(`PID`, `PrinterType`, `Resolution`) VALUES ('$PID','$PrinterType','$Resolution')");
	}


 
	
	$_SESSION['product_added'] = false;
	if(!$x)
		echo "wrong query";
	else
	{
		
		$_SESSION['product_added']=true;
		
	}
	if($_SESSION['product_added']==true)
	{
		header('location:Admin1.php');
	}

?>