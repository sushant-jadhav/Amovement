<?php
  session_start();
if(isset($_SESSION['uid'])){
    $uid=mysql_real_escape_string($_SESSION['uid']);
    $username=mysql_real_escape_string($_SESSION['user']);
    $array=$username;
    $usertrim=explode(" ",$array);
  }else{
    header("Location: login.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Abhivad | home</title>
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
  <body>
  <?php include("navbar.php");?>

    <div class="container">
      <div class="bs-docs-section">
        <div class="row">
          <div class="col-lg-2">
           <div class="profile-sidebar">
            <div class="profile-userbuttons">
              Feeds
            </div>
        <!-- END SIDEBAR BUTTONS -->
        <!-- SIDEBAR MENU -->
            <div class="profile-usermenu">
              <ul class="nav">
                <li>
                  <a href="profile.php">
                  Posts </a>
                </li>
                <li>
                  <a href="setting.php">
                  Settings </a>
                </li>
                <li>
                  <a href="follower.php">
                  Followers </a>
                </li>
                <li>
                  <a href="help.php">
                   </a>
                </li>
              </ul>
            </div>
        <!-- END MENU -->
           </div>
        </div>
        <div class="col-lg-7">
          <div>
            <?php 
            include("config.php");
            $results=$mysqli->query("SELECT count(*) as total_q from questions");
            $total_records=$results->fetch_object();
            $total_groups =ceil($total_records->total_q/$items_per_group);
            $results->close();
          ?>

            <div class="row">
              <div id="results"></div>
              </div>
                <div class="animation_image" style="display:none" align="center">
              <img src="image/ajax-loader.gif">
              </div><br/>
            </div>
          </div>
          <div class="col-lg-3">
           <div class="profile-sidebar">
            <div class="profile-userbuttons">
              Feeds
            </div>
        <!-- END SIDEBAR BUTTONS -->
        <!-- SIDEBAR MENU -->
            <div class="profile-usermenu">
              <ul class="nav">
                <li>
                  <a href="profile.php">
                  Posts<?php ?> </a>
                </li>
                <li>
                  <a href="setting.php">
                  Settings </a>
                </li>
                <li>
                  <a href="follower.php">
                  Followers </a>
                </li>
                <li>
                  <a href="help.php">
                   </a>
                </li>
              </ul>
            </div>
        <!-- END MENU -->
           </div>
        </div>
      </div>
    <?php include("footer.php");?>

    </div>
    </div>
    <script src="js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
      var track_load = 0; //total loaded record group(s)
      var loading  = false; //to prevents multipal ajax loads
      var total_groups = <?php echo $total_groups; ?>; //total record group(s)
      $('#results').load('load_que.php', {'group_no':track_load}, function() {track_load++;}); //load first group
      //$.post('load_que.php',{'group_no':track_load},function(){track_load++});
      console.log(track_load);
      $(window).scroll(function() { //detect page scroll 
        //console.log(track_load);
        if($(window).scrollTop() + $(window).height() <= $(document).height()-100)  //user scrolled to bottom of the page?
        {console.log(track_load);
          if(track_load <= total_groups && loading==false) //there's more data to load
          {
            loading = true; //prevent further ajax loading
            $('.animation_image').show(); //show loading image
            //load data from the server using a HTTP POST request
            console.log(track_load);
            $.post('load_que.php',{'group_no': track_load}, function(data){
              $("#results").append(data); //append received data into the element
              //hide loading image
              $('.animation_image').hide(); //hide loading image once data is received
              track_load++; //loaded group increment
              loading = false; 
            }).fail(function(xhr, ajaxOptions, thrownError) { //any errors?
              alert(thrownError); //alert with HTTP error
              $('.animation_image').hide(); //hide loading image
              loading = false;
            });
          }
        }
      });
    });
    </script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/filter.js"></script>
    
  <script type="text/javascript">
/* <![CDATA[ */
//(function(){try{var s,a,i,j,r,c,l=document.getElementsByTagName("a"),t=document.createElement("textarea");for(i=0;l.length-i;i++){try{a=l[i].getAttribute("href");if(a&&a.indexOf("/cdn-cgi/l/email-protection") > -1  && (a.length > 28)){s='';j=27+ 1 + a.indexOf("/cdn-cgi/l/email-protection");if (a.length > j) {r=parseInt(a.substr(j,2),16);for(j+=2;a.length>j&&a.substr(j,1)!='X';j+=2){c=parseInt(a.substr(j,2),16)^r;s+=String.fromCharCode(c);}j+=1;s+=a.substr(j,a.length-j);}t.innerHTML=s.replace(/</g,"&lt;").replace(/>/g,"&gt;");l[i].setAttribute("href","mailto:"+t.value);}}catch(e){}}}catch(e){}})();
/* ]]> */
</script>
</body>
</html>
<!-- 8806733221 617425 776956  -->