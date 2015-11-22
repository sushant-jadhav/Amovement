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
	$results = $mysqli->query("SELECT questions.*,questions.id as q_id,users.*from questions inner join users on questions.user_id=users.id  order by questions.date_create DESC LIMIT $position, $items_per_group");
	if ($results) {
		while($que = $results->fetch_object())
		{$abt=$que->que_about;
			?>
			 <!-- <div class="panel panel-default" id="results"> -->
			 <div class="panel panel-default">
			<div class="panel-body">
			    <small><?php echo strftime("%B, %d %Y", strtotime($que->date_create));?></small>
                  <a href="view.php?id=<?php echo $que->q_id;?>"><strong><h4><?php echo $que->title;?>?</h4></strong></a>
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
                   <a href="view.php?id=<?php echo $que->q_id;?>" class="btn btn-sm btn-primary" ><span class="glyphicon glyphicon-plus"></span>Add Answer</a>
				      <!-- <a href="#" class="btn btn-sm btn-hover btn-danger"><span class="glyphicon glyphicon-thumbs-down"> Depritiate</span></a> -->
				      <button class="btn btn-sm btn-primary add" value="<?php echo $que->q_id;?>"><span class="glyphicon glyphicon-check"></span> Comment</button>
                  </p>
                  <div class="post">
                    <div class="col-lg-12 col-sm-6 text-left">
                      <div class="well">
                      <div class="input-group">
                          <input type="text" id="userComment" class="form-control input-sm" placeholder="Write your message here..." />
                        <span class="input-group-btn" onclick="addComment()">
                              <a href="#" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-comment"></span> Add Comment</a>
                          </span>
                      </div>
                      <div id="post_<?php echo $que->q_id;?>">
                      </div>
                      </div>
                  </div>
                 </div>
               </div>
              </div>
 <?php
		}
	}
	//unset($que);
	$mysqli->close();
}
?>
<script type="text/javascript">
        $(document).ready(function(){
         $('.add').unbind().on("click",(function(e){
          var queid=$(this).attr("value");
	    	$(this).closest('div').find('.post').toggle();
	    	console.log(queid);
        $.post('comment.php',{'qid':queid}, function(data){
          // $(this).closest('div').find('#post').append(data);

        console.log(queid);
          $('#post_'+queid).append(data);
        });
    }));
  });
</script>