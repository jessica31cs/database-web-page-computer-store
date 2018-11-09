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
<html>
<head>
	<link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Login</h1>

<?php
//always start the session before anything else!!!!!! 
session_start(); 

if(isset($_POST['signIn']))  { //check null
	$email = $_POST['email']; // text field for email
	$password = $_POST['password']; // text field for password


	$link = mysqli_connect('localhost','cs631',"cs631") or die( "Unable to connect");
	mysqli_select_db($link, $dbname) or die( "Unable to select database");

			$sql = "Select Email from customer where Email = '$email' and Password = '$password'";
			
			$result = mysqli_query ($link, $sql)  or die(mysqli_error($link));
			if($result == false)
				{
				echo 'The query failed.';
				exit();
			}
			if(mysqli_num_rows($result) == 1){
				$sql= "SELECT CID from customer WHERE Email='$email'";
				$result = $link->query($sql);
				$obj = mysqli_fetch_array($result);
				$c = htmlspecialchars($obj[0]);
				
				$_SESSION['cid'] = $c;
				header('Location: stored_card.php');	
				
			}
			else{ 
			$err = 'Incorrect email or password' ; 
			} 
			//then just above your login form or where ever you want the error to be displayed you just put in 
			echo "$err";
}
else if(isset($_POST['signUp'])) {
header('Location: sign-up.php');
}	
	
?>


<form action="" method="post">
<table>
<tr>
    <td>Email ID</td>
    <td><input type="text" name="email" autofocus  /></td>
	<tr></tr>
</tr>
<tr>
    <td>Password</td>
    <td><input type="password" name="password" /></td>
</tr>
</table>
<br><br><br>
<input type="Submit" value="Sign In" name="signIn" />
<input type="Submit" value="Sign Up" name="signUp" />
</form>



</body>
</html>