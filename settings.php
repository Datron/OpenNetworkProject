<?php
    session_start();
    include 'dbconfig.php';
    $mysqli = new mysqli($db_hostname,$db_username,$db_password,$db_database);
    if ($mysqli->connect_error)
        {
            die("connection failed".$mysqli->connect_error);
        }
    $query = "SELECT * FROM user_settings WHERE name = '{$_SESSION['username']}'";
    $res = $mysqli->query($query);
    if($res->num_rows == 0)
    {
        if(isset($_POST['about']))
        {
        $about = $mysqli->real_escape_string($_POST['about']);
        $interests = $mysqli->real_escape_string($_POST['interests']);
        $query = "INSERT INTO user_settings(name,about,interests,recommendations,email_verified,address_verified,invited,picture) VALUES(
            '{$_SESSION['username']}','$about','$interests','recommendations',0,0,0,'profilepic')";
        if (!$mysqli->query($query))
        {
            echo "query failed ".$mysqli->error;
        }
        }
    }
?>
<html !DOCTYPE>
<head>
    <title>myBairro - update your settings</title>
    <meta charset="utf-8">
    <meta lang="en">
    <!---------------- SEO ---------------------------->
    
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta name="author" content="developed by Kartik Gajendra" />
	<meta property="og:title" content=""/>
	<meta property="og:description" content=""/>
	<meta property="og:url" content=""/>
    <!------------------------------------------------------------------------------------>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Chela+One|Fira+Sans|Lato|Roboto|Ubuntu|Pacifico" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- JQuery script -->
    <!-- GreenSock JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js"></script>
     <link href="fine-uploader/fine-uploader-gallery.min.css" rel="stylesheet">
    <script src="fine-uploader/fine-uploader.js"></script>
    <link rel="stylesheet" href="css/main.css">
    <script src="js/main.js"></script>
    <script>
    $(document).ready(function(){
    setInterval(getNotifs,5000);
});
function getNotifs(){
    $.ajax({
        method: 'POST',
        url: 'notifs.php',
        data: {'notifs':1}
    }).done(function(data){
        $('.notifs').remove();
        $('#notifications').html(data);
        $('#event').html(data);
        //count unread notifications
        $('.notifs').ready(function(){
            var unread = $('.notifs').length - $('.read').length;
            // var unread = unread;
            $('.badge').html(unread);
        });
    });
}
    </script>
    </head>
    <body>
    <!------------------------------ NAVIGATION MENU -------------------------------------->
    <div id="nav-menu" class="navMenu">
    <h1 class="nav-heading">Categories</h1>
    <a href="#" class="nav-close" id="navClose"><i class="material-icons">close</i></a>
    <a href=""><h2 class="navOption"><i class="material-icons">poll</i>Recommendations</h2></a>
    <a href=""><h2 class="navOption"><i class="material-icons">warning</i>Crime and Safety</h2></a>
    <a href=""><h2 class="navOption"><i class="material-icons">list</i>Lost and Found</h2></a>
    
    <h1 class="nav-heading">People</h1>
        <a href=""><h2 class="navOption"><i class="material-icons">perm_identity</i>Neighbors</h2></a>
    <a href=""><h2 class="navOption"><i class="material-icons">group_work</i>Public Agencies</h2></a>
        
    <h1 class="nav-heading">Options</h1>
        <a href="logout.php"><h2 class="navOption"><i class="glyphicon glyphicon-log-out"></i>Sign out</h2></a>
        
    </div>
    <!------------------------------ START OF PAGE ------------------------------------------>
<div class="mainNav">
    <nav class="navbar">
        <div class="container-fluid">
            <!--SEARCH ROW-->
            <div class="row">
                <div class="col-xs-2 col-sm-1 col-md-2">
                <a href="#" id="nav-menu-button"><i class="material-icons mat-menu">menu</i></a>
                </div>
                <form class="nav-form">
                <div class="col-xs-10 col-sm-10 col-md-4">
                  <div class="input-group">
                    <input type="text" id="searchField" name="searchText" class="form-control form-field" placeholder="Search">
                    <div class="input-group-btn">
                      <button class="btn btn-biarro" type="submit">
                        <i class="material-icons">search</i>
                      </button>
                    </div>
                  </div>
                    </div>
                </form> 
                <div class="col-md-6">
                <nav class="navbar mynav">
                    <div class="container-fluid">
                    <ul class="nav navbar-nav topOptions">
                        <li class="active"><a href="">Home</a></li>
                        <li><a href="#" class="notifsPopover" title="notifcations" data-toggle="popover" data-trigger="click" data-placement="bottom"><i class="material-icons">notifications</i><span class="badge"></span></a></li>
                        <li><a href="profile.php">Profile</a></li>
                        <li><a href="#" class="settingsPopover" title="<?php echo $_SESSION['neighborhood'] ?>" data-toggle="popover" data-trigger="click" data-placement="bottom"><img src="images/user-default-gray.png" class="image-circle"><?php echo $_SESSION['username'] ?></a></li>
                        </ul>
                    <div id="notifications" class="container-fluid" style="display:none">
                    </div> 
                    <div id="popover_content" class="container-fluid" style="display:none">
                        <a href="#" class=""><h4 class="navH">Settings</h4></a>
                        
                        <a href="#" class=""><h4 class="navH">Invite Neighbors</h4></a>
                        <a href="https://goo.gl/forms/3rCEChSCx3Lt5ijd2" class=""><h4 class="navH">Feedback</h4></a>
                        <a href="logout.php" class=""><h4 class="navH">Sign out</h4></a>
                        </div>
                    </div>
                    </nav>
                </div>
            
        </div>
            <!-------------------TABS ROW---------------------->
        </div>
    </nav>
        <div class="container-fluid settings">
            <div class="row">
                <div class="col-md-1"></div>
            <div class="col-md-5">
                <form action="" method="POST" class="form-horizontal" role="form">
                    <div class="form-group">
                        <!-- <legend>Name</legend> -->
                        <!-- <div class="row">
                         <div class="col-md-6">
                             <input type="text" id="new-firstname" name="fname" class="form-control" value="" required="required">
                        </div>
                        <div class="col-md-6">
                            <input type="text" id="new-lastname" name="lname" class="form-control" value="" required="required">
                            </div>
                        </div> -->
                    </div>
                    <!-- <div class="form-group">
                        <legend>email</legend>

                        <input type="email" id="new-email" name="email" class="form-control" value="" required="required">
                    </div> -->
                    
                    <div class="form-group">
                        <legend>Profile picture</legend>
                        <img src="images/user-default-gray.png" class="user-profile-pic img-responsive">
                        <br><br>
                    <input type="file" class="filesup" style="display:none">
                    <button type="button" class="btn btn-success">Upload New</button>
                    </div>
                    <div class="form-group">
                    <legend>Details</legend>
                    <span class="label label-default">About</span>
                    <textarea name="about" id="aboutme" class="form-control" rows="3" required="required"></textarea>
                    <br>
                    <label class="label label-default">Interests</label>
                    <textarea name="interests" id="interests" class="form-control" rows="2" required="required"></textarea>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
            </form>
                </div>
            </div>
            

        </div>
        </div>
    </body>
</html>