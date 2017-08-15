<?php
session_start();
?>
<html !DOCTYPE>
<head>
    <title>myBairro - The social network for your neigbourhood</title>
    <meta charset="utf-8">
    <meta lang="en">
    <!---------------- SEO --------------------------->
    
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta name="author" content="developed by Kartik Gajendra" />
	<meta property="og:title" content=""/>
	<meta property="og:description" content=""/>
	<meta property="og:url" content=""/>
    <!----------------------------------------------------------------------------------->
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
    <style>
    .image-square {
        margin: 10px;
        height: 200px;
        width: 200px;
        border-radius: 4px 4px;
        box-shadow: 4px 8px 4px black;
    }
    .username {
        font-weight: 700;
        font-size: 30px;
        font-family: 'Roboto', sans-serif;
        color: black;
    }
    .person-desig {
        position: relative;
        font-size: 20px;
        bottom: 20px;
        left: 20px;
        font-family: 'Ubuntu',sans-serif;
        font-weight: 600;
        color: white;
    }
    .user-basics {
            text-align: center;
    }
        .user-info {
        }
        .user-info .panel {
            max-width: 400px;
        }
    </style>
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
    <!------------------------------ START OF PAGE ----------------------------------------->
<div class="mainNav">
    <nav class="navbar">
        <div class="container-fluid">
            <!----------SEARCH ROW------------->
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
                        <li><a href="home.php">Home</a></li>
                        <li><a href=""><i class="material-icons">notifications</i></a></li>
                        <li class="active"><a href="">Profile</a></li>
                        <li><a href="#" class="settingsPopover" title="<?php echo $_SESSION['neighborhood'] ?>" data-toggle="popover" data-trigger="click" data-placement="bottom"><img src="images/user-default-gray.png" class="image-circle"><?php echo $_SESSION['username'] ?></a></li>
                        </ul>
                    <div id="popover_content" class="container-fluid" style="display:none">
                        <a href="#" class=""><h4 class="navH">Settings</h4></a>
                        
                        <a href="#" class=""><h4 class="navH">Invite Neighbors</h4></a>
                        <a href="#" class=""><h4 class="navH">Feedback</h4></a>
                        <a href="logout.php" class=""><h4 class="navH">Sign out</h4></a>
                        </div>
                    </div>
                    </nav>
                </div>
            
        </div>
            <!-------------------TABS ROW---------------------->
        </div>
    </nav> 
<div class="container-fluid">
        <div class="user-basics">
        <img src="images/user-default-gray.png" class="image-square">
            <h1 class="username"><?php echo $_SESSION['username']?> </h1>
            <h2><?php echo $_SESSION['neighborhood']?> </h2>
        </div>
        <div class="user-info">
            <div class="col-md-4"></div>
            <div class="col-md-3">
        <div class="container">
            <div class="panel panel-default">
              <div class="panel-heading">
                    <h3 class="panel-title">About me</h3>
              </div>
              <div class="panel-body">
                    Add an about me.........
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">
                    <h3 class="panel-title">Interests</h3>
              </div>
              <div class="panel-body">
                    interests
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">
                    <h3 class="panel-title">recommendations</h3>
              </div>
              <div class="panel-body">
                    Panel content
              </div>
            </div>
            </div>
        </div>
    </div>
    </div>
    </body>
</html>