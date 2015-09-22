<?php
include("config.php"); //include config file\

if($_POST)
{
	//sanitize post value
	$group_number = filter_var($_POST["group_no"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
	
	if(!is_numeric($group_number)){
		header('HTTP/1.1 500 Invalid number!');
		exit();
	}
	//get current starting point of records
	$position = ($group_number * $items_per_group);
	//Limit our results within a specified range. 
	$results = $mysqli->query("SELECT questions.*,answers.*,users.*,appritiate.*  from questions inner join answers on questions.id=answers.question_id  left join users on answers.user_id=users.id left join appritiate on answers.id=appritiate.id where answers.question_id=$qid order by questions.id ASC LIMIT $position, $items_per_group");
	//$strSQL_Result  = $mysqli->query("SELECT 'like',unlike from appritiate where ans_id=1");
  
	if ($results) { 
		//output results from database
		//$res=$results->fetch_assoc();

		//$count=$res['qid'];
		// $date=strftime("%B %d", strtotime($res['date_create']))
			?>
                  <?php
                  while($ans=$results->fetch_object()) { 
                  	$count=count($ans->id);
                  ?>
                  <div class="panel">
					<div class="panel-body">
                  <div class="user_info">
                   <div id="id_user">
                   <div class="testimonials">
            	<div class="active item">
                  <!-- <blockquote><p>Denim you probably haven't heard of. Lorem ipsum dolor met consectetur adipisicing sit amet, consectetur adipisicing elit, of them jean shorts sed magna aliqua. Lorem ipsum dolor met.</p></blockquote> -->
                  <div class="carousel-info">
                    <img alt="" src="http://keenthemes.com/assets/bootsnipp/img1-small.jpg" class="pull-left">
                    <div class="pull-left">
                      <span class="testimonials-name"><?php echo $ans->fullname;?></span>
                      <span class="testimonials-post">Commercial Director</span>
                    </div>
                  </div>
                  <blockquote><p>Denim you probably haven't heard of. Lorem ipsum dolor met consectetur adipisicing sit amet, consectetur adipisicing elit, of them jean shorts sed magna aliqua. Lorem ipsum dolor met.</p></blockquote>
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
                    <button type="button" class="btn btn-sm btn-hover btn-primary button_like" id="linkeBtn"><span class="glyphicon glyphicon-thumbs-up"> Appritiate</span></button>
                    <button class="btn btn-sm btn-hover btn-danger button_unlike" id="unlinkeBtn"><span class="glyphicon glyphicon-thumbs-down"> Depritiate</span></button>
                    <button class="btn btn-sm btn-hover btn-success"><span class="glyphicon glyphicon-check"></span> Comment</button>
              <!-- <a href="#" class="btn btn-xs btn-hover btn-default">Print <span class="glyphicon glyphicon-print"></span></a> -->
                    <!-- 9975872949<a href="#" class="btnn btn-default">Depreciate</a> -->
                  </p>
                  </div>
                 </div>
					</div>
                  <?php  }?>
                  <br/>
 <?php
		
	}
	unset($obj);
	$mysqli->close();
}

?>
<!-- comment box -->
<div class="row">
            <div class="col-md-12 text-center">
                <h2>Bootstrap Twitter Feed</h2>
                <h6>Crafted by <a href="http://www.designbootstrap.com/">DesignBootstrap.com</a> </h6>
                <br />
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 col-sm-4 col-sm-offset-4">
                <!-- TWEET WRAPPER START -->
                <div class="twt-wrapper">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Twitter Feed Example
                        </div>
                        <div class="panel-body">
                            <textarea class="form-control" placeholder="Enter here for tweet..." rows="3"></textarea>
                            <br />
                            <a href="#" class="btn btn-primary btn-sm pull-right">Tweet</a>
                            <div class="clearfix"></div>
                            <hr />
                            <ul class="media-list">
                                <li class="media">
                                    <a href="#" class="pull-left">
                                        <img src="assets/img/1.png" alt="" class="img-circle">
                                    </a>
                                    <div class="media-body">
                                        <span class="text-muted pull-right">
                                            <small class="text-muted">30 min ago</small>
                                        </span>
                                        <strong class="text-success">@ Rexona Kumi</strong>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                            Lorem ipsum dolor sit amet, <a href="#"># consectetur adipiscing </a>.
                                        </p>
                                    </div>
                                </li>
                                <li class="media">
                                    <a href="#" class="pull-left">
                                        <img src="assets/img/2.png" alt="" class="img-circle">
                                    </a>
                                    <div class="media-body">
                                        <span class="text-muted pull-right">
                                            <small class="text-muted">30 min ago</small>
                                        </span>
                                        <strong class="text-success">@ John Doe</strong>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                            Lorem ipsum dolor <a href="#"># ipsum dolor </a>adipiscing elit.
                                        </p>
                                    </div>
                                </li>
                                <li class="media">
                                    <a href="#" class="pull-left">
                                        <img src="assets/img/3.png" alt="" class="img-circle">
                                    </a>
                                    <div class="media-body">
                                        <span class="text-muted pull-right">
                                            <small class="text-muted">30 min ago</small>
                                        </span>
                                        <strong class="text-success">@ Madonae Jonisyi</strong>
                                        <p>
                                            Lorem ipsum dolor <a href="#"># sit amet</a> sit amet, consectetur adipiscing elit.
                                        </p>
                                    </div>
                                </li>
                            </ul>
                            <span class="text-danger">237K users active</span>
                        </div>
                    </div>
                </div>
                 <!-- TWEET WRAPPER END -->
            </div>
        </div>

      <!-- comment ends -->