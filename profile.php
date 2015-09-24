<?php
  session_start();
if(isset($_SESSION['uid'])){
    $uid=mysql_real_escape_string($_SESSION['uid']);
    $username=mysql_real_escape_string($_SESSION['user']);
    $array=$username;
    $usertrim=explode(" ",$array);
  }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>AbhiVaad</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="css/bootstrap.css" media="screen">
    <link rel="stylesheet" href="css/custom.min.css">
    <link rel="stylesheet" href="css/my.css">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox.css?v=2.1.5" media="screen" />
    <link rel="stylesheet" type="text/css" href="js/fancybox/helpers/jquery.fancybox-buttons.css?v=2.1.5" media="screen" />
    <script type="javascript" src="script.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../bower_components/html5shiv/dist/html5shiv.js"></script>
      <script src="../bower_components/respond/dest/respond.min.js"></script>
    <![endif]-->
    
  </head>
  <body id="body">
  <?php include("navbar.php");?>

  <?php
    include("config.php");
    $user=$mysqli->query("SELECT * from users where id=$uid");
    $user_profile=$user->fetch_object();

  ?>
    <div class="container">
    <div class="row profile">
    <div class="col-md-3">
      <div class="profile-sidebar">
        <!-- SIDEBAR USERPIC -->
        <div class="profile-userpic">
          <a href="#" ><img src="image/unnamed.png" class="img-responsive" alt=""></a>
        </div>
        <!-- END SIDEBAR USERPIC -->
        <!-- SIDEBAR USER TITLE -->
        <div class="profile-usertitle">
          <div class="profile-usertitle-name">
            <?php echo $user_profile->fullname;?>
          </div>
          <div class="profile-usertitle-job">
          </div>
        </div>
        <div class="profile-userbuttons">
        </div>
        <div class="profile-usermenu">
          <ul class="nav">
            <li class="active">
              <a href="profile.php">
              <i class="glyphicon glyphicon-tag"></i>
              Posts </a>
            </li>
            <li>
              <a href="setting.php">
              <i class="glyphicon glyphicon-user"></i>
              Settings </a>
            </li>
            <li>
              <a href="follower.php">
              <i class="glyphicon glyphicon-ok"></i>
              Followers </a>
            </li>
            <li>
              <a href="help.php">
              <i class="glyphicon glyphicon-flag"></i>
              Help </a>
            </li>
          </ul>
        </div>
        <!-- END MENU -->
      </div>
    </div>
    <div class="col-md-9">
            
              <!-- <div class="col-md-6 col-md-offset-2"> -->
                <?php
                include("config.php");
                $posts="SELECT appritiate.*,answers.*,answers.user_id as uid,questions.*,users.* from appritiate inner join answers on appritiate.ans_id=answers.id left join questions on answers.question_id=questions.id left join users on answers.user_id=users.id where appritiate.user_id=$uid ";
                $user_post=$mysqli->query($posts);
                if($user_post){
                  while($app=$user_post->fetch_object()){
                    $status=$app->status;
                 ?>
                    <div class="profile-post">
                      <div class="[ col-xs-12 col-sm-offset-0 col-sm-11 ]">
                    <div class="[ panel panel-default ] panel-google-plus">
                        <div class="dropdown">
                            <span class="dropdown-toggle" type="button" data-toggle="dropdown">
                                <span class="[ glyphicon glyphicon-chevron-down ]"></span>
                            </span>
                            <ul class="dropdown-menu" role="menu">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                                <li role="presentation" class="divider"></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
                            </ul>
                        </div>
                        <div class="panel-heading">
                        <?php if($status==1){?>
                        <small class="likecomm"><?php echo $usertrim[0];?> appritiate this in public</span> - <span><?php echo strftime("%B, %d %Y", strtotime($app->status_date));?></span></small><?php }?>
                        <?php if($status==0){?>
                        <small class="likecomm"><?php echo $usertrim[0];?> depritiate this in public</span> - <span><?php echo strftime("%B, %d %Y", strtotime($app->status_date));?></span></small><?php }?>
                            <h2><?php echo $app->title;?>?</h2>
                        </div>
                        <div class="panel-body userinfo">
                            <img class="[ img-circle pull-left ]" src="image/unnamed.png" alt="user" />
                            <h5><?php echo $app->fullname;?></h5>
                            <p><?php echo $app->about;?></p>
                        </div>
                        <div class="panel-body pro">
                        <p><?php $text=$app->answer_text; if(strlen($text)>500){echo $text=substr($text,0);}?></p>
                        </div>
                        <div class="panel-body fetch">
                        </div>
                        <div class="panel-footer">
                            <!-- <button type="button" class="[ btn btn-default ]">Appritiate</button> -->
                            <button type="button" class="[ btn btn-default ]">
                                <span class="[ glyphicon glyphicon-share-alt ]">Share</span>
                            </button>
                            <div class="input-placeholder">Add a comment...</div>
                        </div>
                        <div class="panel-google-plus-comment">
                            <img class="img-circle" src="http://keenthemes.com/preview/metronic/theme/assets/admin/pages/media/profile/profile_user.jpg" alt="User Image" />
                            <div class="panel-google-plus-textarea">
                                <textarea name="area" id="area" rows="5"></textarea>
                                <button type="submit" class="[ btn btn-success disabled ]">Post comment</button>
                                <button type="reset" class="[ btn btn-default ]">Cancel</button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                      </div>
                    </div>
                    </div>
            <?php }}?>
            
    <!-- </div> -->
  <!-- </div> -->
</div><br/>

    <?php include("footer.php");?>

</div>


    <script src="js/jquery-1.10.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/filter.js"></script>
    <script src="js/profile.js"></script>
   <!-- <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>-->
    <script type="text/javascript">
            // bkLib.onDomLoaded(function() { nicEditors.allTextAreas }); // convert all text areas to rich text editor on that page
            // bkLib.onDomLoaded(function() {
            //      new nicEditor({maxHeight : 300}).panelInstance('area');
        //new nicEditor({fullPanel : true,maxHeight : 200}).panelInstance('area1');
           // }); // convert text area with id area1 to rich text editor.
    </script>

<script type="text/javascript" src="js/fancybox/jquery.fancybox.js"></script>
<script type="text/javascript" src="js/fancybox/helpers/jquery.fancybox-buttons.js"></script>
<script type="text/javascript" src="js/fancybox/helpers/jquery.fancybox-media.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $("#read").click(function(){
      var uid=<?php echo $uid;?>;
      var mydata={'uid':uid};

      //$('.fetch').hide();
      $.ajax({
        url: "fetch_ans.php",
        method:"POST",
        cache: 'false',
        datatype:' html',
        data:mydata, 
        success: function(data){
        console.log(uid);
        //$(this).attr('disabled',true);
        //$(".fetch").append(mydata);
        //$('.pro').hide();
        }});
    });
  });
</script>


  <script type="text/javascript">
/* <![CDATA[ */
(function(){try{var s,a,i,j,r,c,l=document.getElementsByTagName("a"),t=document.createElement("textarea");for(i=0;l.length-i;i++){try{a=l[i].getAttribute("href");if(a&&a.indexOf("/cdn-cgi/l/email-protection") > -1  && (a.length > 28)){s='';j=27+ 1 + a.indexOf("/cdn-cgi/l/email-protection");if (a.length > j) {r=parseInt(a.substr(j,2),16);for(j+=2;a.length>j&&a.substr(j,1)!='X';j+=2){c=parseInt(a.substr(j,2),16)^r;s+=String.fromCharCode(c);}j+=1;s+=a.substr(j,a.length-j);}t.innerHTML=s.replace(/</g,"&lt;").replace(/>/g,"&gt;");l[i].setAttribute("href","mailto:"+t.value);}}catch(e){}}}catch(e){}})();
/* ]]> */
</script>
</body>
</html>
<!-- 8806733221 617425 776956  -->