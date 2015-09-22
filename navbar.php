<div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a href="./" class="navbar-brand">Abhivaad</a>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
          <ul class="nav navbar-nav nav-pills">
          <li>
          <form class="navbar-form navbar-center" role="search" method="post">
            <div class="form-group">
            <input type="text" id="search-box" class="form-control" placeholder="Search Here..." style="width:320px;">
          </div>
          <button type="submit" class="btn btn-default">Submit</button>
        </form>
        <ul id="search_suggestion_holder" class="dropdown-menu drop">
            </ul>
          </li>
           <li class="active"><a href="index.php"><i class="glyphicon glyphicon-home"></i> Home <span class="badge"></span></a></li>
            <li><a href="profile.php"> Profile <span class="badge"></span></a></li>
            <li class="imges">
               <!-- <img src="http://keenthemes.com/preview/metronic/theme/assets/admin/pages/media/profile/profile_user.jpg" class="img-responsive" alt=""> -->
               <img src="image/unnamed.png" class="img-responsive" alt="">
            </li>
            <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php if(isset($username)){echo  $usertrim[0];}?></a>
            <ul class="dropdown-menu">
              <li><a href="profile.php">profile <span class="glyphicon glyphicon-stats pull-right"></span></a></li>
              <li class="divider"></li>
              <li><a href="setting.php"> Settings <span class="glyphicon glyphicon-cog pull-right"></span></a></li>
              <li class="divider"></li>
              <!-- <li><a href="#">Message <span class="badge pull-right"> 42 </span></a></li>
              <li class="divider"></li> -->
              <li><a href="contact.php">contact <span class="glyphicon glyphicon-phone pull-right"></span></a></li>
              <li class="divider"></li>
              <li><a href="about.php">about <span class="glyphicon glyphicon-info pull-right"></span></a></li>
              <li class="divider"></li>
              <li><a href="logout.php">Sign Out <span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
            </ul>
          </li>

          </ul>
          <ul class="nav navbar-nav navbar-right nav-pills">
            <li><form class="navbar-form navbar-center" role="search">
            <div class="form-group">
            <button type="submit" class="btn btn-primary"> Start Discussion?</button>
            </div></form></li>
          </ul> 

        </div>
      </div>
    </div>
    
    