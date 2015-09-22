<?php
include("config.php");
if(isset($_POST['ansid'])){
	//$aid=mysqli_real_escape_string($mysqli,$_POST['aid']);
	//echo 1;
	$ansid=$_POST['ansid'];
	$userid=1;
	echo $ansid;
	$status=1;

		$query = "INSERT INTO appritiate (ans_id, user_id, status) VALUES(?, ?, ?)";
		$statement = $mysqli->prepare($query);
		//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
		$statement->bind_param('iii',$ansid, $userid, $status);

		if($statement->execute()){
		    print 'Success! ID of last inserted record is : ' .$statement->insert_id .'<br />'; 
		}else{
		    die('Error : ('. $mysqli->errno .') '. $mysqli->error);
		}
		echo "liked";
$statement->close();
	
}

elseif(isset($_POST['ansuid'])){
	$aid=$_POST['ansuid'];
	echo $aid;
	$userid=2;
	$status=0;

		$query = "INSERT INTO appritiate (ans_id, user_id, status) VALUES(?, ?, ?)";
		$statement = $mysqli->prepare($query);

		//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
		$statement->bind_param('iii',$aid, $userid, $status);

		if($statement->execute()){
		    print 'Success! ID of last inserted record is : ' .$statement->insert_id .'<br />'; 
		}else{
		    die('Error : ('. $mysqli->errno .') '. $mysqli->error);
		}
		echo "liked";
$statement->close();
	echo "unliked";
}
?>