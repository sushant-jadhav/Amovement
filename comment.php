<?php
include("config.php");
if(isset($_POST['qid'])){
  $qid = $_POST['qid'];
  $res = $mysqli->query("SELECT comment_que.*,users.* from comment_que inner join users on comment_que.user_id=users.id where que_id=$qid");
  
      ?>

    <?php
    if ($res) {
    while($comm = $res->fetch_object())
    {
      ?>
                      <hr data-brackets-id="12673">
                      <ul data-brackets-id="12674" id="sortable" class="list-unstyled ui-sortable">
                          <strong class="pull-left primary-font" id="qid"><?php echo $comm->fullname;?></strong>
                          <small class="pull-right text-muted">
                             <span class="glyphicon glyphicon-time"></span>7 mins ago</small>
                          </br>
                          <li class="ui-state-default"><?php echo $comm->comm_text;?>. </li>
                          </br>
                      </ul>
                      <?php } }?>
  <?php
              }
?>