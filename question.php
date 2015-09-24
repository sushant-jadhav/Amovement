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
          <div class="col-lg-7 col-lg-offset-1">
          <div class="profile-content">
           <div class="form-style-2">
            <form class="form-horizontal" method="post" id="form">
              <fieldset>
                <legend>Start New Discussion</legend>
                <div class="form-group">
                  <label for="inputEmail" class="col-lg-2 control-label">Title:</label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" id="title" name="field1" placeholder="Title" required/>
                  </div>
                </div>
                <div class="form-group">
                  <label for="textArea" class="col-lg-2 control-label">About:</label>
                  <div class="col-lg-10">
                    <textarea class="form-control" id="about" rows="3" name="about" id="textArea" required></textarea>
                    <span class="help-block">A longer block of help text that breaks onto a new line and may extend beyond one line.</span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-2 control-label">Anonomous</label>
                  <div class="col-lg-10">
                    <div class="radio">
                      <label>
                        <input type="checkbox" class="acheckbox" name="checkbox" id="checkbox" value="1">
                        is Anonymous
                      </label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-lg-10 col-lg-offset-2">
                    <!-- <button id="discuss" class="btn btn-primary">Submit</button> -->
                    <input id="discuss" type="button" type="submit" class="btn btn-primary" value="Submit">
                  </div>
                </div>
              </fieldset>
            </form>
            </div>
            <div class="animation_image" style="display:none" align="center">
              <img src="image/ajax-loader.gif">
              </div>
              <div class="que" style="display:none">question posted</div>
            </div>
        </div>
        <div class="col-lg-4">
          <div class="profile-sidebar">
           <div class="profile-userbuttons">
               Asked Questions
            </div>
            <div class="profile-usermenu">
            <ul class="nav">
            <?php include("config.php");
            $que_select="SELECT * from questions where user_id=$uid LIMIT 10";
            $title=$mysqli->query($que_select);
            while($qtitle=$title->fetch_object()){
            ?>
                <li>
                  <a href="profile.php"><?php echo $qtitle->title;?>?</a>
                </li>
             <?php }?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    <?php include("footer.php");?>

    </div>
    </div>
    <script src="js/jquery-1.11.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/filter.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
      //$('.que').hide();
      $("#discuss").click(function(){
        var title=$('#title').val();
        var nicInstance = nicEditors.findEditor('about');
        var notes = nicInstance.getContent();
        var uid=<?php echo $uid?>;
        var anon=$('.acheckbox:checked').val();
        if(anon==1){anon=1;}else{anon=0;}
        $(".animation_image").show();
        $("#form").validate();
        var mydata={'title':title,'about':notes,'uid':uid,'anon':anon};
        $.ajax({
                url: 'question_post.php',
                method:'POST',
                cache: 'false' ,
                datatype:' html' ,
                data:mydata,
                success: function(data){
                $('.animation_image').hide();
                $('.que').show();
                },
                error: function() {
                alert('Error occurs!');
                 }
                });
      });
    });
    </script>
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
//(function(){try{var s,a,i,j,r,c,l=document.getElementsByTagName("a"),t=document.createElement("textarea");for(i=0;l.length-i;i++){try{a=l[i].getAttribute("href");if(a&&a.indexOf("/cdn-cgi/l/email-protection") > -1  && (a.length > 28)){s='';j=27+ 1 + a.indexOf("/cdn-cgi/l/email-protection");if (a.length > j) {r=parseInt(a.substr(j,2),16);for(j+=2;a.length>j&&a.substr(j,1)!='X';j+=2){c=parseInt(a.substr(j,2),16)^r;s+=String.fromCharCode(c);}j+=1;s+=a.substr(j,a.length-j);}t.innerHTML=s.replace(/</g,"&lt;").replace(/>/g,"&gt;");l[i].setAttribute("href","mailto:"+t.value);}}catch(e){}}}catch(e){}})();
/* ]]> */
</script>
</body>
</html>
<!-- 8806733221 617425 776956  -->