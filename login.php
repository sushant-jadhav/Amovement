<?php
include ('db.php');
if (isset($_POST['formsubmitted'])) {
    $current_date = date("Y-m-d");
    $error = array();//Declare An Array to store any error message
    if (empty($_POST['name'])) {//if no name has been supplied
        $error[] = 'Please Enter a name ';//add to array "error"
    } else {
        $name = $_POST['name'];//else assign it a variable
    }

    if (empty($_POST['email'])) {
        $error[] = 'Please Enter your Email ';
    } else {


        if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST['email'])) {
           //regular expression for email validation
            $Email = $_POST['email'];
        } else {
             $error[] = 'Your EMail Address is invalid  ';
        }


    }
    if (empty($_POST['password'])) {
        $error[] = 'Please Enter Your Password ';
    } else {
        $Password = $_POST['password'];
    }
    if (empty($error)) //send to Database if there's no error '

    { // If everything's OK...

        // Make sure the email address is available:
        $query_verify_email = "SELECT * FROM users  WHERE email ='$Email'";
        $result_verify_email = mysqli_query($mysqli, $query_verify_email);
        if (!$result_verify_email) {//if the Query Failed ,similar to if($result_verify_email==false)
            echo ' Database Error Occured ';
        }
        if (mysqli_num_rows($result_verify_email) == 0) { // IF no previous user is using this email .
            // Create a unique  activation code:
            $activation = md5(uniqid(rand(), true));
            $query_insert_user = "INSERT INTO users ( fullname, email, password, date_created,active) VALUES ( '$name', '$Email', '$Password', '$current_date',$activation')";


            $result_insert_user = mysqli_query($mysqli, $query_insert_user);
            if (!$result_insert_user) {
                echo 'Query Failed ';
            }

            if (mysqli_affected_rows($mysqli) == 1) { //If the Insert Query was successfull.
                // Send the email:
                $message = " To activate your account, please click on this link:\n\n";
                $message .= WEBSITE_URL . '/activate.php?email=' . urlencode($Email) . "&key=$activation";
                mail($Email, 'Registration Confirmation', $message, 'From: ismaakeel@gmail.com');

                // Flush the buffered output.
                // Finish the page:
                echo '<div class="success">Thank you for
registering! A confirmation email
has been sent to '.$Email.' Please click on the Activation Link to Activate your account </div>';


            } else { // If it did not run OK.
                echo '<div class="errormsgbox">You could not be registered due to a system
error. We apologize for any
inconvenience.</div>';
            }
        } else { // The email address is not available.
            echo '<div class="errormsgbox" >That email
address has already been registered.
</div>';
        }
    } else {//If the "error" array contains error msg , display them

echo '<div class="errormsgbox"> <ol>';
        foreach ($error as $key => $values) {
            echo '  <li>'.$values.'</li>';
        }
        echo '</ol></div>';

    }
    mysqli_close($mysqli);//Close the DB Connection

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
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <!-- <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet"> -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../bower_components/html5shiv/dist/html5shiv.js"></script>
      <script src="../bower_components/respond/dest/respond.min.js"></script>
    <![endif]-->
    
  </head>
  <body>
  
    <div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-xs-offset-3 col-md-7" id="loginpanel">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Log in Or Register</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <!-- <div class="col-xs-6 col-sm-6 col-md-6 separator social-login-box" id="socaillogin"> <br />
                            <a href="" class="btn facebook btn-block" role="button">Log in using Facebook</a>
                            <br />
                            <a href="" class="btn twitter btn-block" role="button">Log in using Twitter</a>
                        </div> -->
                        <div class="col-xs-6 col-sm-6 col-md-6 separator" id="signup">
                            <label style="margin-bottom:10px;">
                                    Register your Email
                            </label>
                            <form role="form" method="post" id="register" action="<?PHP echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" accept-charset="UTF-8">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Fullname" required autofocus />
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                                <input type="text" class="form-control" name="email" id="email" placeholder="Email" required autofocus />
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required />
                            </div>
                            <div class="input-group" id="errorlogin">
                            </div>
                            <label>
                                    <input type="checkbox" value="Remember">
                                    I accept <a>Terms & conditions</a>.
                                </label>
                            <div id="error"><?php if(isset($error)){$_POST[$key] =  !is_array($error) ? trim(addslashes($error)) : 'null';}?></div>
                            <div class="input-group">
                                <button type="submit" name="formsubmitted" class="btn btn-labeled btn-success">
                                <span class="btn-label"><i class="glyphicon glyphicon-ok"></i></span>Register</button>
                            </div>
                            </form>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 login-box">
                        <label style="margin-bottom:10px;">
                                    Login here
                            </label>
                            <form role="form" action="signin.php" method="post">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                                <input type="text" class="form-control" name="email" id="email" placeholder="Email" required autofocus />
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required />
                            </div>
                            <div class="input-group" id="errorlogin">
                            </div>
                             <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="Remember">
                                    Remember me
                                </label>
                            </div>
                            <div class="input-group">
                                <button type="submit" name="login" class="btn btn-labeled btn-success">
                                <span class="btn-label"><i class="glyphicon glyphicon-ok"></i></span> Login </button>
                            </div>
                            <p>
                                <a href="#" >Lost your password?</a></p>
                            Don't have an account? <a href="#" class="registerbox">Sign up here</a>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="Remember">
                                    Remember me
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <script src="js/jquery-1.11.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/filter.js"></script>
    <script src="js/login.js"></script>
    
    <script type="text/javascript">

    // $(document).ready(function(){
    //  $(function () {

    //     $("#signup").hide();
        
    //     $(".registerbox").bind("click", function () {
    //       console.log(1);
    //       $("#socaillogin").hide();        
    //         console.log(2);
    //       if ($(this).attr("class") == "registerbox")
    //       {
    //         $("#signup").show();
    //       }
    //       else 
    //       { 
    //         $("#socaillogin").show();
    //       }
    //     });

    // });
    // });
    </script>

  <script type="text/javascript">
/* <![CDATA[ */
(function(){try{var s,a,i,j,r,c,l=document.getElementsByTagName("a"),t=document.createElement("textarea");for(i=0;l.length-i;i++){try{a=l[i].getAttribute("href");if(a&&a.indexOf("/cdn-cgi/l/email-protection") > -1  && (a.length > 28)){s='';j=27+ 1 + a.indexOf("/cdn-cgi/l/email-protection");if (a.length > j) {r=parseInt(a.substr(j,2),16);for(j+=2;a.length>j&&a.substr(j,1)!='X';j+=2){c=parseInt(a.substr(j,2),16)^r;s+=String.fromCharCode(c);}j+=1;s+=a.substr(j,a.length-j);}t.innerHTML=s.replace(/</g,"&lt;").replace(/>/g,"&gt;");l[i].setAttribute("href","mailto:"+t.value);}}catch(e){}}}catch(e){}})();
/* ]]> */
</script>
</body>
</html>
<!-- 8806733221 617425 776956  -->