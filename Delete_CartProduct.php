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
	$FName= $_SESSION['FName'];
	$LName= $_SESSION['LName'];
	$PID=$_SESSION['PID'];

	$CartID=0;
	$query3 = "SELECT * FROM Customer Where FName='$FName'";
		$response3 = mysqli_query($conn,$query3);
		$CID=0;
		if($row3 = $response3->fetch_assoc())
		{	
			$CID.=$row3["CID"];
			#print_r($row1["CID"]);
		}
		else
		{
			echo "bad query3";
		}
		$_SESSION['CID']=$CID;
		$query4 ="SELECT * FROM cart AS C, APPEARS_IN AS A WHERE C.CartID=A.CartID AND C.CID='$CIDd' AND A.PID='$PID' ";
		$response4=mysqli_query($conn,$query4);
		if($row4 = $response4->fetch_assoc())
		{	
			$CartID.=$row4["CartID"];
			#print_r($row1["CID"]);
		}
		else
		{
			echo "bad query4";
		}
	$_SESSION['CartID']=$CartID;
  	if(!empty($_GET['order']))
  	{
  		$query00="DELETE FROM cart WHERE CartID='$CartID'";
  		$response00 = mysqli_query($conn,$query00);

  		$query0="DELETE FROM appears_in WHERE CartID='$CartID'";
  		$response0 = mysqli_query($conn,$query0);

  		$_SESSION['registration_done'] = false;
		if(!$response0)
			echo "wrong query";
		else
		{
		
			$_SESSION['registration_done']=true;
		
		}
		if($_SESSION['registration_done']==true)
		{
			header('location:cart.php');
		}

  	}
  	else
  	{	
  		$PQuantity=0;
  		$query1="SELECT * FROM product WHERE PID='$PID'";
		$response1 = mysqli_query($conn,$query1);
		if($row1 = $response1->fetch_assoc())
		{	
			$PQuantity =$row1["PQuantity"];
		}
		else
		{
			echo "bad query1";
		}

		$A="Awaiting Response";
		$query2="UPDATE cart SET TStatus ='$A' WHERE CartID = '$CartID'";
		$response2 = mysqli_query($conn,$query2);
		$PQuantity=$PQuantity-1;
  		$query="UPDATE Product SET PQuantity ='$PQuantity' WHERE PID = '$PID'";
		$response = mysqli_query($conn,$query);
		$_SESSION['registration_done'] = false;
		if(!$response)
			echo "wrong query";
		else
		{
		
			$_SESSION['registration_done']=true;
		
		}
		if($_SESSION['registration_done']==true)
		{
			header('location:product4.php');
		}

  	}
	
 ?>