<?php
session_start();
if(isset($_SESSION['uid'])){
    $uid=mysql_real_escape_string($_SESSION['uid']);
    $username=mysql_real_escape_string($_SESSION['user']);
  }
if(isset($_POST['update'])){
	include("config.php");
	$fullname=mysql_real_escape_string($_POST['fullname']);
	$about=mysql_real_escape_string($_POST['about']);
	$password=mysql_real_escape_string($_POST['password']);
	$stmt = $mysqli->prepare("UPDATE users SET fullname = ?,about = ?,password = ? WHERE id = ?");
		$stmt->bind_param('sssd',$fullname,$about,$password,$uid);
		$stmt->execute();
		if($stmt->execute()!=null){
			header("Location: setting.php");
			$stmt->close();
		}

}
?>