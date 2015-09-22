<?php
  session_start();
if(isset($_SESSION['uid'])){
    $uid=mysql_real_escape_string($_SESSION['uid']);
    $username=mysql_real_escape_string($_SESSION['user']);
    $array=$username;
    $usertrim=explode(" ",$array);
  }

if(isset($_GET['id'])){
    $qid=$_GET['id'];
    echo $qid;
}
// if(is_null($_GET['id'])){
//     header('HTTP/1.1 500 Invalid number!');
//     exit();
//   }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Abhivad </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- <meta http-equiv="refresh" content="1"> -->
    <link rel="stylesheet" href="css/bootstrap.css" media="screen">
    <link rel="stylesheet" href="css/custom.min.css">
    <link rel="stylesheet" type="text/css" href="css/my.css">
    <script type="javascript" src="script.js"></script>
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
          Discuss feeds
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
              Help </a>
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
            $results=$mysqli->query("SELECT count(*) as total_q from answers where question_id=$qid");
            $total_records=$results->fetch_object();
            $total_groups =ceil($total_records->total_q/$items_per_group);
            $results->close();
          ?>
          <?php include("config.php");
          $resu=$mysqli->query("SELECT * from questions where id=$qid");
          $result_q=$resu->fetch_object();
          ?>
              <div class="row">
              <div class="panel panel-default">
              <div class="panel-body">
          
                  <a><strong><h3><?php echo $result_q->title;?>?</h3></strong></a>
                     <div class="user_info">
                   <div class="testimonials">
                  <div class="active item">
                  <!-- <blockquote><p>Denim you probably haven't heard of. Lorem ipsum dolor met consectetur adipisicing sit amet, consectetur adipisicing elit, of them jean shorts sed magna aliqua. Lorem ipsum dolor met.</p></blockquote> -->
                  <blockquote><p><?php echo $result_q->que_about;?></p></blockquote>
                </div>
                </div>
            </div>
           </div>
          </div>
          <div class="span4 well" style="padding-bottom:10px">
            <form accept-charset="UTF-8" action="" method="POST">
                <label><span>Write Here</span></label>
                <textarea class="span4" name="area" id="area" style="width:100%;height:80px;" placeholder="Write Here"
                 ></textarea>
                <button class="btn btn-info" type="submit">Post Answer</button>
            </form>
          </div>
         
          <div id="results"></div></div>
            <div class="animation_image" style="display:none" align="center">
              <img src="image/ajax-loader.gif">
              </div><br/>
            </div>
          </div>

          <div class="col-lg-3">
            <div class="profile-sidebar">
            <div class="profile-userbuttons">
              Related stuff
            </div>
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
              Help </a>
            </li>
          </ul>
        </div>
            </div>
          </div>
        </div>
      </div>

      <div id="source-modal" class="modal fade">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Source Code</h4>
            </div>
            <div class="modal-body">
              <pre></pre>
            </div>
          </div>
        </div>
      </div>

    <?php include("footer.php");?>

    </div>


    <script src="js/jquery-1.10.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
    <script type="text/javascript">
    $(document).ready(function() {
      var track_load = 0; //total loaded record group(s)
      var loading  = false; //to prevents multipal ajax loads
      var total_groups = <?php echo $total_groups; ?>; //total record group(s)
      var qid =<?php echo $qid; ?>;
      $('#results').load("load_ans.php", {'group_no':track_load,'id':qid}, function() {track_load++;}); //load first group
      $(window).scroll(function() { //detect page scroll
        if($(window).scrollTop() + $(window).height() == $(document).height())  //user scrolled to bottom of the page?
        {
          if(track_load <= total_groups && loading==false) //there's more data to load
          {
            loading = true; //prevent further ajax loading
            $('.animation_image').show(); //show loading image
            //load data from the server using a HTTP POST request
            $.post('load_ans.php',{'group_no': track_load,'id':qid}, function(data){
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
    <script type="text/javascript">
            bkLib.onDomLoaded(function() { nicEditors.allTextAreas }); // convert all text areas to rich text editor on that page
            bkLib.onDomLoaded(function() {
                 new nicEditor({maxHeight : 200}).panelInstance('area');
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