<?php
session_start();
?>
<html !DOCTYPE>
<head>
    <title>MyBairro feed</title>
    <meta charset="utf-8">
    <meta lang="en">
    <!---------------- SEO --------------------------->
    
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta name="author" content="developed by Kartik Gajendra and Saahith hegde" />
	<meta property="og:title" content=""/>
	<meta property="og:description" content=""/>
	<meta property="og:url" content=""/>
    <!----------------------------------------------------------------------------------->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Chela+One|Fira+Sans|Lato|Roboto|Ubuntu" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- JQuery script -->
    
    <!-- GreenSock JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js" async></script>
    <!--My Scripts -->
    <link rel="stylesheet" href="css/main.css">
    <script src="js/main.js"></script>
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
                <div class="col-xs-8 col-sm-8 col-md-8">
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
            
        </div>
            <!-------------------TABS ROW---------------------->
            <div class="tabs">
            <nav class="navTabs">
                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 active" title="feed"><button class="btn-tab" ><i class="material-icons tabicon">line_weight</i></button></div>
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"  title="users"><button class="btn-tab"><i class="material-icons tabicon">face</i></button></div>
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"  title="events"><button class="btn-tab"><i class="material-icons tabicon">event</i></button></div>
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" title="settings"><button class="btn-tab"><i class="material-icons tabicon">settings</i></button></div>
                </div>
                </nav>
            </div>
        </div>
    </nav> 
    <!--------------------------------END OF NAVBAR ---------------------------------------->
</div>
    <!--------------------------------TAB CONTENT------------------------------------------->
    <div class="container-fluid">
    <div class="tab-content" id="feed">
        <div class="panel panel-default">
          <div class="panel-heading"><?php echo $_SESSION['username'] ?> Feed</div>
          <div class="panel-body"><?php echo $_SESSION['address'] ?></div>
        </div>
        </div>
    <div class="tab-content" id="user">
        <div class="panel panel-default">
          <div class="panel-heading"><?php echo $_SESSION['username'] ?> User Page</div>
          <div class="panel-body"><?php echo $_SESSION['neighborhood'] ?></div>
        </div>
        </div>
    <div class="tab-content" id="event">
        <div class="panel panel-default">
          <div class="panel-heading"><?php echo $_SESSION['username']?> Events</div>
          <div class="panel-body"><?php echo $_SESSION['phone'] ?></div>
        </div>
        </div>
    <div class="tab-content" id="settings">
        <div class="panel panel-default">
          <div class="panel-heading"><?php echo $_SESSION['username'] ?> Settings</div>
          <div class="panel-body">Settings come here</div>
        </div>
        </div>
    </div>
    <!--------------------------END OF TAB CONTENT-------------------------------------------->
    
    <!--------------------------POST BUTTON AND CONTENT --------------------------------------->
    <div class="container-fluid postButton">
    <button type="button" class="btn btn-post-material" data-toggle="modal" data-target="#postsModal" data-backdrop="static"><i class="material-icons">add</i></button>
    </div>
    <div id="postsModal" class="modal fade" role="application">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Make a post</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" role="form">
		<div class="form-group postform">
            <img class="img-responsive" src="#" id="preview-image">
            <br>
			<textarea class="form-control" rows="6" placeholder="what's happening?" id="postarea"></textarea>
            <div class="jumbotron"></div>
            <div class="row extraTags">
                <div class="col-sm-2"><button class="btn" id="photoUpload"><i class="material-icons">add_a_photo</i></button> select photo
                <input type="file" id="fileUpload" name="upPhoto">
                </div>
                <div class="col-sm-10">
                    <div class="dropdown">
                      <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        set categories
                        <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu tags" aria-labelledby="dropdownMenu1">
                        <li><a href="#">Pets</a></li>
                        <li><a href="#">Recommendations</a></li>
                        <li><a href="#">Classifields</a></li>
                        <!--<li role="separator" class="divider"></li>-->
                        <li><a href="#">Events</a></li>
                      </ul>
                    </div>
                </div>
            </div>
		</div>
            <div class="modal-footer">
        <button type="button" class="btn btn-biarro" data-dismiss="modal" id="submitPost">Post</button>
                </div>
          </form>
        
      
      </div>
    </div>

  </div>
</div>
</body>
</html>