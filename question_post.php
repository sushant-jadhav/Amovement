<?php 
include("config.php");
if(isset($_POST['title'])){
	//$aid=mysqli_real_escape_string($mysqli,$_POST['aid']);
	//echo 1;
	$title=$_POST['title'];
	$about=$_POST['about'];
	$uid=$_POST['uid'];
	echo $date=date("Y-m-d H:i:s");
	$isanon=$_POST['anon'];

		$query = "INSERT INTO questions (title, que_about,user_id,date_create,is_anonymus) VALUES(?, ?, ?, ?, ?)";
		$statement = $mysqli->prepare($query);
		//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
		$statement->bind_param('ssisi',$title, $about,$uid,$date,$isanon);

		if($statement->execute()){
		    print 'Success! ID of last inserted record is : ' .$statement->insert_id .'<br />'; 
		}else{
		    die('Error : ('. $mysqli->errno .') '. $mysqli->error);
		}
		echo "done";
		$statement->close();
}

?>