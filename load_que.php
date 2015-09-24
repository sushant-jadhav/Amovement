<?php
include("config.php"); //include config file
if($_POST)
{
	//sanitize post value
	$group_number = filter_var($_POST["group_no"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
	//throw HTTP error if group number is not valid
	if(!is_numeric($group_number)){
		//header('HTTP/1.1 500 Invalid number!');
		//exit();
	}
	//get current starting point of records
	$position = ($group_number * $items_per_group);
	
	//Limit our results within a specified range. 
	$results = $mysqli->query("SELECT questions.*,questions.id as que_id,users.* from questions inner join users on questions.user_id=users.id order by questions.date_create DESC LIMIT $position, $items_per_group");
	
	if ($results) { 
		//output results from database
		
		while($que = $results->fetch_object())
		{$abt=$que->que_about;
			?>
			 <!-- <div class="panel panel-default" id="results"> -->
			 <div class="panel panel-default">
			<div class="panel-body">
			    <small><?php echo strftime("%B, %d %Y", strtotime($que->date_create));?></small>
                  <a href="view.php?id=<?php echo $que->que_id;?>"><strong><h3><?php echo $que->title;?>?</h3></strong></a>
                  <div class="user_info">
                   <div class="testimonials">
            	<div class="active item">
                  <!-- <blockquote><p>Denim you probably haven't heard of. Lorem ipsum dolor met consectetur adipisicing sit amet, consectetur adipisicing elit, of them jean shorts sed magna aliqua. Lorem ipsum dolor met.</p></blockquote> -->
                  <?php if(isset($abt)){?><blockquote><p><?php echo $que->que_about;?>.</p></blockquote><?php }?>
                </div>
                </div>
            </div>
                  <br/>
                   <p class="">
                    <!-- <a href="#" class="btnn btn-primary" style="text-decoration: none;">Appricite</a> -->
                   <a href="view.php?id=<?php echo $que->que_id;?>" class="btn btn-sm btn-hover btn-success" ><span class="glyphicon glyphicon-plus"></span> Write</a>
				      <!-- <a href="#" class="btn btn-sm btn-hover btn-danger"><span class="glyphicon glyphicon-thumbs-down"> Depritiate</span></a> -->
				      <a href="#" class="btn btn-sm btn-hover btn-success"><span class="glyphicon glyphicon-check"></span> Comment</a>
				      <!-- <a href="#" class="btn btn-xs btn-hover btn-default">Print <span class="glyphicon glyphicon-print"></span></a> -->
                    <!-- 9975872949<a href="#" class="btnn btn-default">Depreciate</a> -->
                  </p>
               </div>
               </div>
 <?php
		}
	}
	//unset($que);
	$mysqli->close();
}
?>