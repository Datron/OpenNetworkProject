<?php
include 'dbconfig.php';
session_start();
$mysqli = new mysqli($db_hostname,$db_username,$db_password,$db_database);
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
if (isset($_POST['searchText']))
{
    $key = $mysqli->real_escape_string($_POST['searchText']);
    $query_user = "SELECT * FROM users WHERE username LIKE '%$key%'";
    $query_post = "SELECT * FROM user_posts WHERE owner LIKE '%$key%' OR content LIKE '%$key%'";
    $res1 = $mysqli->query($query_user);
    $res2 = $mysqli->query($query_post);
?>
<html !DOCTYPE>
<head>
    <title>MyBairro feed</title>
    <meta charset="utf-8">
    <meta lang="en">
    <!---------------- SEO ---------------------------->
    
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta name="author" content="developed by Kartik Gajendra and Saahith hegde" />
	<meta property="og:title" content=""/>
	<meta property="og:description" content=""/>
	<meta property="og:url" content=""/>
    <!------------------------------------------------------------------------------------>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js"></script>
    <!--My Scripts -->
    <link rel="stylesheet" href="css/main.css">
    
    <script src="js/main.js"></script>
    <script src="js/notifs.js"></script>
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
        <a href="https://goo.gl/forms/3rCEChSCx3Lt5ijd2"><h2 class="navOption"><i class="material-icons">feedback</i>FeedBack</h2></a>
        <a href="logout.php"><h2 class="navOption"><i class="glyphicon glyphicon-log-out"></i>Sign out</h2></a>
        
    </div>
    <!------------------------------ START OF PAGE ------------------------------------------>
<div class="mainNav">
    <nav class="navbar">
        <div class="container-fluid">
            <!----------SEARCH ROW-------------->
            <div class="row">
                <div class="col-xs-2 col-sm-1 col-md-2">
                <a href="#" id="nav-menu-button"><i class="material-icons mat-menu">menu</i></a>
                </div>
                <form class="nav-form" method="post" action="">
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
    </div>
        <!-- SEARCH RESULTS  -->
        <div class="search-results-users">
            <div class="container-fluid">
                <h1 class="searchHeading">Users</h1>
            <div class="col-md-6" id="viewuser">
            
            <ul class="nav navbar-nav searchusers">
               <?php
                    if ($res1->num_rows > 0)
                    {
                        while($row = $res1->fetch_assoc())
                        {
                        echo <<<EOT
                        <li>
                        <div class="review-card" style="width:400px">
                        <div class="review-header">
                        <img src="images/user-default-gray.png" class="image-circle">
                        <h2 class="person-name">{$row["username"]}</h2><h3 class="person-desig"> {$row["neighborhood"]}</h3>
                    </div></li>
                    </div>
                    <br>
EOT;
                        }
                    }
                else
                    echo "<h2>No users found</h2>";
                ?>
            </ul>
                </div>
            </div>
    </div>
    <br>
    <br>
            <div class="search-results-posts">
            
            <div class="container-fluid">
                <h1 class="searchHeading">Posts</h1>
                <div class="col-md-6" id="feed">
                    
            <ul class="nav navbar-nav searchposts">
                <?php
                    if ($res2->num_rows > 0)
                    {
                        while($row = $res2->fetch_assoc())
                        {
                        $html = <<<EOT
                        <li>
               <div class="review-card">
                    <div class="review-header" value="{$row['id']}">
                        <image src="images/user-default-gray.png" class="image-circle"></image>
                        <h2 class="person-name">{$row["owner"]}</h2><h3 class="person-desig"> {$row["neighborhood"]}</h3>
                    </div>
EOT;
                if ($row['img_src'] != null)
                    $html .= '<img src="'.$row['img_src'].'" alt="post image" class="img-responsive postpic">';
                
            $html .= <<<EOT
                    <p class="person-review"> {$row['content']} </p>
                    <div class="toolbar">
                    <div class="likes"><i class="material-icons">thumb_up</i>{$row['likes']}</div>
                    <div class="comment"><i class="material-icons">chat</i>{$row['comments']}</div>
                    </div>
                    <div class="comments-area">
EOT;
                    
                
                    $html .= <<<EOT
                        <div class="add-comment">
                        <textarea name="" class="form-control userComment" rows="2" placeholder="add a comment...."></textarea>
                        <br>
                        <button class="btn btn-primary comment-button" value="{$row['id']}">comment</button>
                        </div>
                    </div>
                </div>
                    </li>
                    <br>
EOT;
            echo $html;
                        }
                    }
}
                ?>
                </ul>
                </div>
                </div>
            </div>
</body>
</html>