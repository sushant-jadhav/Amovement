<?php

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
            <div class="">
              <div class="row">
                <div class="">
                  <strong>News Feeds</strong> <hr/>
                </div>
              </div>
              
              <div class="row">
              <div class="">
                <span>&#x25cf;</span>&nbsp;&nbsp; sfdiub
              </div>
            </div>
            </div>
          </div>
          <div class="col-lg-7">
            <div>
              <div class="panel panel-default">
                <div class="panel-body">
                  <h2>Example body text</h2>
                  <p>Nullam quis risus eget <a href="#">urna mollis ornare</a> vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam id dolor id nibh ultricies vehicula.</p>
                  <p><small>This line of text is meant to be treated as fine print.</small></p>
                  <p>The following snippet of text is <strong>rendered as bold text</strong>.</p>
                  <p>The following snippet of text is <em>rendered as italicized text</em>.</p>
                  <p>An abbreviation of the word attribute is <abbr title="attribute">attr</abbr>.</p>
                </div>
              </div>

               <div class="panel panel-default">
                <div class="panel-body">
                  <h2>Example body text</h2>
                  <p>Nullam quis risus eget <a href="#">urna mollis ornare</a> vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam id dolor id nibh ultricies vehicula.</p>
                  <p><small>This line of text is meant to be treated as fine print.</small></p>
                  <p>The following snippet of text is <strong>rendered as bold text</strong>.</p>
                  <p>The following snippet of text is <em>rendered as italicized text</em>.</p>
                  <p>An abbreviation of the word attribute is <abbr title="attribute">attr</abbr>.</p>
                  <br/>
                  <a href="#" class="btn btn-default">Share </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="bs-component">
              <div class="panel panel-info">
                <div class="panel-heading">
                  <h3 class="panel-title">New topics info</h3>
                </div>
                <div class="panel-body">
                  Panel content
                </div>
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


    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
  <script type="text/javascript">
/* <![CDATA[ */
(function(){try{var s,a,i,j,r,c,l=document.getElementsByTagName("a"),t=document.createElement("textarea");for(i=0;l.length-i;i++){try{a=l[i].getAttribute("href");if(a&&a.indexOf("/cdn-cgi/l/email-protection") > -1  && (a.length > 28)){s='';j=27+ 1 + a.indexOf("/cdn-cgi/l/email-protection");if (a.length > j) {r=parseInt(a.substr(j,2),16);for(j+=2;a.length>j&&a.substr(j,1)!='X';j+=2){c=parseInt(a.substr(j,2),16)^r;s+=String.fromCharCode(c);}j+=1;s+=a.substr(j,a.length-j);}t.innerHTML=s.replace(/</g,"&lt;").replace(/>/g,"&gt;");l[i].setAttribute("href","mailto:"+t.value);}}catch(e){}}}catch(e){}})();
/* ]]> */
</script>
</body>
</html>
<!-- 8806733221 617425 776956  -->