<?php
include('config.php');
if(isset($_POST['anstxt'])){
	$ans_text = $_POST['anstxt'];
	$uid = $_POST['uid'];
	$qid = $_POST['qid'];
	$date = $_POST['comm_date'];
	$isanon = $_POST['isanon'];
	$query = "INSERT INTO answers (answer_text,is_anonymuos, user_id, question_id,created ) VALUES(?, ?, ?,?,?)";
		$statement = $mysqli->prepare($query);
		//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
		$statement->bind_param('siiis',$ans_text,$isanon, $uid, $qid,$date);
		if($statement->execute()){
			// $statement->insert_id;
			$answer_last = $mysqli->query("SELECT answers.*,answers.user_id as uid,users.* from answers inner join users on answers.user_id=users.id where answers.id=$statement->insert_id order by created desc");
			if ($answer_last) {
						//output results from database
						while($ans = $answer_last->fetch_object()){
							// $count=count($ans->id);
       //              $aid=$ans->aid;
       //              $sql_like=$mysqli->query("SELECT count(status) as sta from appritiate where ans_id=$aid and status=1");
       //              $cnt=$sql_like->fetch_object();
       //              $like=$cnt->sta;
       //              $sql_unlike=$mysqli->query("SELECT count(status) as stu from appritiate where ans_id=$aid and status=0");
       //              $cntunlike=$sql_unlike->fetch_object();
       //              $unlike=$cntunlike->stu;
                    $anon=$ans->is_anonymuos;
                    ?>
							<div class="panel">
					<div class="panel-body">
                  <div class="user_info">
                   <div id="id_user">
                   <div class="testimonials">
            	<div class="active item">
                  <div class="carousel-info">
                    <img alt="" src="image/unnamed.png" class="pull-left">
                    <!-- <div class="pull-left"> -->
                    <?php if($anon==0){ ?>
                      <span class="testimonials-name"><?php echo $ans->fullname;?></span>
                      <span class="testimonials-post"><?php echo $ans->about;?></span>
                      <?php }else{?>
                      <span class="testimonials-name">Anonymous user.</span><?php }?>
                    <!-- </div> -->
                  </div>
                  <!-- <blockquote><p>.</p></blockquote> -->
                </div>
            </div>
                   </div>
                   </div>
                  <div class="ans_text">
                  <p><?php echo $ans->answer_text;?>
                  </p>
                  <span id="status"></span><br>
                  <p class="">
                    <!-- <a href="#" class="btnn btn-primary" style="text-decoration: none;">Appricite</a> -->
                    <!-- <button class="btn btn-sm btn-hover btn-primary button_like" value="<?php echo $ans->aid;?>" id="linkeBtn"><span class="glyphicon glyphicon-thumbs-up"> Appritiate <span id="like"><?php echo $like;?></span></span><?php ?></button>
                    <button class="btn btn-sm btn-hover btn-danger button_unlike" value="<?php echo $ans->aid;?>"  id="unlinkeBtn"><span class="glyphicon glyphicon-thumbs-down"> Depritiate <span id="unlike"><?php echo $unlike;?></span></span></button>
                     --><button class="btn btn-sm btn-hover btn-success add" value="<?php echo $ans->id;?>"><span class="glyphicon glyphicon-check"></span> Comment</button>
                  </p>
                  </div>
					</div>
          </div>
					<?php	}
				}
		}
		$statement->close();

}else
{
	echo 'no data';
}
?>