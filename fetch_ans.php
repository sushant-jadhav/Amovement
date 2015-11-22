<?php
include("config.php"); //include config file

if($_POST)
{
	//sanitize post value
	// $group_number = filter_var($_POST["group_no"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
	//throw HTTP error if group number is not valid
	// if(!is_numeric($group_number)){
	// 	header('HTTP/1.1 500 Invalid number!');
	// 	exit();
	// }
	//get current starting point of records
	// $position = ($group_number * $items_per_group);
	//Limit our results within a specified range. 
	$results = $mysqli->query("SELECT appritiate.*,answers.*,answers.user_id as uid,questions.*,users.* from appritiate inner join answers on appritiate.ans_id=answers.id left join questions on answers.question_id=questions.id left join users on answers.user_id=users.id where appritiate.user_id=$uid ");
	if ($results) {
		//output results from database
		while($que = $results->fetch_object())
		{$abt=$que->que_about;
			?>
			 <!-- <div class="panel panel-default" id="results"> -->
            	<div class="panel-body">
                        <p><?php $text=$app->answer_text; if(strlen($text)>500){echo $text=substr($text,500).'<a href="#"> Read more</a>';}?></p>
                        </div>
 <?php
		}
	}
	unset($obj);
	$mysqli->close();
}
?>