<?php
session_start();
// username and password sent from Form
if(isset($_POST['login'])){
	$dbcon=mysqli_connect("localhost","root","");
$res = mysqli_select_db($dbcon,"abhivaad");
$myusername=mysqli_real_escape_string($dbcon,$_POST['email']); 
$mypassword=mysqli_real_escape_string($dbcon,$_POST['password']); 

$sql="SELECT * FROM users WHERE email='$myusername' and password='$mypassword'";
$result=mysqli_query($dbcon,$sql);
$row=mysqli_fetch_array($result);

$count=mysqli_num_rows($result);
//echo $count;
if($count==1){
	$_SESSION['user'] = $row['fullname'];
	$_SESSION['uid'] = $row['id'];

	echo header("location:index.php");
}
else
{
	$error= "Please Enter valid creditentials";
	echo $error;
}
if(isset($formData['remember_me'])){ // if user check the remember me checkbox
        $twoDays = 60 * 60 * 24 * 2 + time();
        setcookie('username', $formData['email'], $twoDays);
        setcookie('password', $formData['password'], $twoDays);
    } else { // if user not check the remember me checkbox
        $twoDaysBack = time() - 60 * 60 * 24 * 2;
        setcookie('username', '', $twoDaysBack);
        setcookie('password', '', $twoDaysBack);
    }

}

?>