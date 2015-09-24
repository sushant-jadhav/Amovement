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
    <title>Movement</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="css/bootstrap.css" media="screen">
    <link rel="stylesheet" href="css/custom.min.css">
    <link rel="stylesheet" href="css/my.css">
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
          <img src="image/unnamed.png" class="img-responsive" alt="">
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
            <li>
              <a href="profile.php">
              <i class="glyphicon glyphicon-tag"></i>
              Posts </a>
            </li>
            <li class="active">
              <a href="setting.php">
              <i class="glyphicon glyphicon-user"></i>
              Account Settings </a>
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
      <div class="profile-content">
      <form class="form-horizontal" method="post" action="update.php">
  <fieldset>
    <legend>General Setting</legend>
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Full Name:</label>
      <div class="col-lg-10">
        <input type="text" id="fullname" class="form-control" name="fullname" value="<?php echo $user_profile->fullname;?>">
      </div>
    </div>
    <div class="form-group">
      <label for="inputPassword" class="col-lg-2 control-label">New Password:</label>
      <div class="col-lg-10">
        <input type="password" class="form-control" id="password" name="password" value="<?php echo $user_profile->password;?>">
      </div>
    </div>
    <div class="form-group">
      <label for="textArea" class="col-lg-2 control-label">About you:</label>
      <div class="col-lg-10">
        <textarea class="form-control" name="about" id="about" rows="3" id="textArea"><?php echo $user_profile->about;?></textarea>
        <span class="help-block">A longer block of help text that breaks onto a new line and may extend beyond one line.</span>
      </div>
    </div>
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button type="submit" name="update" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </fieldset>
</form>
    </div>
  </div>
</div>

    <?php include("footer.php");?>

    </div>


    <script src="js/jquery-1.10.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/filter.js"></script>
    <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
    <script type="text/javascript">
            bkLib.onDomLoaded(function() { nicEditors.allTextAreas }); // convert all text areas to rich text editor on that page
            bkLib.onDomLoaded(function() {
                 // new nicEditor({maxHeight : 200}).panelInstance('about');
                 new nicEditor({buttonList : ['bold','italic','underline','fontSize','fontFamily','strikeThrough','subscript','superscript','html']}).panelInstance('about');
        //new nicEditor({fullPanel : true,maxHeight : 200}).panelInstance('area1');
            }); // convert text area with id area1 to rich text editor.
    </script>
  <script type="text/javascript">
/* <![CDATA[ */
(function(){try{var s,a,i,j,r,c,l=document.getElementsByTagName("a"),t=document.createElement("textarea");for(i=0;l.length-i;i++){try{a=l[i].getAttribute("href");if(a&&a.indexOf("/cdn-cgi/l/email-protection") > -1  && (a.length > 28)){s='';j=27+ 1 + a.indexOf("/cdn-cgi/l/email-protection");if (a.length > j) {r=parseInt(a.substr(j,2),16);for(j+=2;a.length>j&&a.substr(j,1)!='X';j+=2){c=parseInt(a.substr(j,2),16)^r;s+=String.fromCharCode(c);}j+=1;s+=a.substr(j,a.length-j);}t.innerHTML=s.replace(/</g,"&lt;").replace(/>/g,"&gt;");l[i].setAttribute("href","mailto:"+t.value);}}catch(e){}}}catch(e){}})();
/* ]]> */
</script>
</body>
</html>
<!-- 8806733221 617425 776956  -->