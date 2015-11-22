<?php
include("config.php"); //include config file\

if($_POST)
{
	//sanitize post value
	$group_number = filter_var($_POST["group_no"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
	$qid = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
	//throw HTTP error if group number is not valid
	if(!is_numeric($group_number)){
		header('HTTP/1.1 500 Invalid number!');
		exit();
	}
	//get current starting point of records
	$position = ($group_number * $items_per_group);
	//Limit our results within a specified range.
	 $results = $mysqli->query("SELECT questions.*,answers.*,answers.id as aid,users.*,appritiate.*,answers.is_anonymuos as ano  from questions inner join answers on questions.id=answers.question_id  left join users on answers.user_id=users.id left join appritiate on answers.id=appritiate.id where answers.question_id=$qid order by created DESC LIMIT $position, $items_per_group");
	if ($results) {
			?>
                  <?php
                  while($ans=$results->fetch_object()) { 
                  	$count=count($ans->id);
                    $aid=$ans->aid;
                    $sql_like=$mysqli->query("SELECT count(status) as sta from appritiate where ans_id=$aid and status=1");
                    $cnt=$sql_like->fetch_object();
                    $like=$cnt->sta;
                    $sql_unlike=$mysqli->query("SELECT count(status) as stu from appritiate where ans_id=$aid and status=0");
                    $cntunlike=$sql_unlike->fetch_object();
                    $unlike=$cntunlike->stu;
                    $anon=$ans->is_anonymuos;
                    //$status=$ans->appcount;
                    //$img=$ans->image;
                  ?>
                  <div class="panel">
					<div class="panel-body">
                  <div class="user_info">
                   <div id="id_user">
                   <div class="testimonials">
            	<div class="active item">
                  <div class="carousel-info">
                <?php ?>
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
                    <button class="btn btn-sm btn-primary button_like" value="<?php echo $ans->aid;?>" id="linkeBtn"><span class="glyphicon glyphicon-thumbs-up"> Appritiate <span id="like"><?php echo $like;?></span></span><?php ?></button>
                    <button class="btn btn-sm  btn-primary button_unlike" value="<?php echo $ans->aid;?>"  id="unlinkeBtn"><span class="glyphicon glyphicon-thumbs-down"> Depritiate <span id="unlike"><?php echo $unlike;?></span></span></button>
                    <button class="btn btn-sm  btn-primary add" value="<?php echo $ans->aid;?>"><span class="glyphicon glyphicon-check"></span> Comment</button>
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
                      <div id="post_<?php echo $ans->aid;?>">
                      </div>
                      </div>
                  </div>
                 </div>
                  </div>
					</div>
          </div>
                  <?php } ?>
                  <br/>
 <?php
	}
	unset($obj);
	$mysqli->close();

}

?>
<script type="text/javascript">
                    $(document).ready(function(){
                      $(".button_like").unbind().click(function(){
                          var ansid=$(this).attr("value");
                          var mydata={'ansid':ansid};
                          $.ajax({
                            url: 'answer_like_ajax.php',
                            method:'POST',
                            cache: 'false' ,
                             datatype:' html' ,
                            data:mydata, 
                            success: function(data){
                          var like=<?php if(!isset($like)){echo "0";}else{ echo $like;}?>;
                          like=like+1;
                          $('#like').html(like).fadeIn('fast');
                          $(this).attr("disabled",true);
                        },
                          error: function() {
                            alert('Error occurs!');
                         }
                      });
                      });
                      $(".button_unlike").unbind().click(function(){
                          var ansuid=$(this).attr("value");
                          var mydata={'ansuid':ansuid};
                          $.ajax({
                            url: "answer_like_ajax.php",
                            method:"POST",
                            cache: 'false',
                             datatype:' html',
                            data:mydata, 
                            success: function(data){
                          console.log(data);
                          var unlike=<?php if(!isset($unlike)){echo "0";}else{ echo $unlike;}?>;
                          unlike=unlike+1;
                          $('#unlike').html(unlike).fadeIn('fast');
                          $(this).attr("disabled",true);
                        }});
                      });
                     });

                  </script>
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