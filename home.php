<?php 
include 'user.php'; 
session_start();
session_regenerate_id(TRUE); 
if (!isset($_SESSION['username']))
    header("Location: /mybiarro/index.html");
$user = new User();
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
    <!-- FINE UPLOADER -->
    <link href="fine-uploader/fine-uploader-gallery.min.css" rel="stylesheet">
    <script src="fine-uploader/fine-uploader.js"></script>
    <script type="text/template" id="qq-template">
        <div class="qq-uploader-selector qq-uploader qq-gallery" qq-drop-area-text="Drop files here">
            <div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">
                <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>
            </div>
            <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
                <span class="qq-upload-drop-area-text-selector"></span>
            </div>
            <div class="qq-upload-button-selector qq-upload-button">
                <div>Upload a file</div>
            </div>
            <span class="qq-drop-processing-selector qq-drop-processing">
                <span>Processing dropped files...</span>
                <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
            </span>
            <ul class="qq-upload-list-selector qq-upload-list" role="region" aria-live="polite" aria-relevant="additions removals">
                <li>
                    <span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>
                    <div class="qq-progress-bar-container-selector qq-progress-bar-container">
                        <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-progress-bar-selector qq-progress-bar"></div>
                    </div>
                    <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
                    <div class="qq-thumbnail-wrapper">
                        <img class="qq-thumbnail-selector" qq-max-size="120" qq-server-scale>
                    </div>
                    <button type="button" class="qq-upload-cancel-selector qq-upload-cancel">X</button>
                    <button type="button" class="qq-upload-retry-selector qq-upload-retry">
                        <span class="qq-btn qq-retry-icon" aria-label="Retry"></span>
                        Retry
                    </button>

                    <div class="qq-file-info">
                        <div class="qq-file-name">
                            <span class="qq-upload-file-selector qq-upload-file"></span>
                            <span class="qq-edit-filename-icon-selector qq-btn qq-edit-filename-icon" aria-label="Edit filename"></span>
                        </div>
                        <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">
                        <span class="qq-upload-size-selector qq-upload-size"></span>
                        <button type="button" class="qq-btn qq-upload-delete-selector qq-upload-delete">
                            <span class="qq-btn qq-delete-icon" aria-label="Delete"></span>
                        </button>
                        <button type="button" class="qq-btn qq-upload-pause-selector qq-upload-pause">
                            <span class="qq-btn qq-pause-icon" aria-label="Pause"></span>
                        </button>
                        <button type="button" class="qq-btn qq-upload-continue-selector qq-upload-continue">
                            <span class="qq-btn qq-continue-icon" aria-label="Continue"></span>
                        </button>
                    </div>
                </li>
            </ul>

            <dialog class="qq-alert-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">Close</button>
                </div>
            </dialog>

            <dialog class="qq-confirm-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">No</button>
                    <button type="button" class="qq-ok-button-selector">Yes</button>
                </div>
            </dialog>

            <dialog class="qq-prompt-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <input type="text">
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">Cancel</button>
                    <button type="button" class="qq-ok-button-selector">Ok</button>
                </div>
            </dialog>
        </div>
    </script>
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
                        <li><a href=""><i class="material-icons">notifications</i></a></li>
                        <li><a href="">Profile</a></li>
                        <li><a href="#" class="settingsPopover" title="<?php echo $_SESSION['neighborhood'] ?>" data-toggle="popover" data-trigger="focus" data-placement="bottom"><img src="images/user-default-gray.png" class="image-circle"><?php echo $_SESSION['username'] ?></a></li>
                        </ul>
                    <div id="popover_content" class="container-fluid" style="display:none">
                        <a href="#"><h4 class="navH">Settings</h4></a>
                        <a href="logout.php"  class=""><h4 class="navH">Sign out</h4></a>                    
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
    <!--------------------------------END OF NAVBAR ---------------------------------------->
</div>
    <div class="container welcome-msg" style="display:none">
                <div class="panel panel-default">
                <div class="panel-body">
                   hello <?php echo $_SESSION['username'] ?>, here is your feed for <?php echo $_SESSION['neighborhood'] ?>
                </div>
            </div>
                </div>

    <!--------------------------------TAB CONTENT------------------------------------------->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-3 nav-sidebar well">
                <h1 class="nav-heading">Categories</h1>
                <a href="" class=""><h3 class="navOption"><i class="material-icons">poll</i>Recommendations</h3></a>
                <a href="" class=""><h3 class="navOption"><i class="material-icons">warning</i>Crime and Safety</h3></a>
                <a href="" class=""><h3 class="navOption"><i class="material-icons">list</i>Lost and Found</h3></a>

                <h1 class="nav-heading">People</h1>
                    <a href="" class=""><h3 class="navOption"><i class="material-icons">perm_identity</i>Neighbors</h3></a>
                <a href="" class=""><h3 class="navOption"><i class="material-icons">group_work</i>Public Agencies</h3></a>

            </div>
            <div class="col-md-6 refresh-feed" id="feed">
               <?php $user->getFeed() ?>
        
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
        <form class="form-horizontal" id="post-form" role="form">
		<div class="form-group postform">
            <div id="uploader"></div>
            <script>
            var galleryUploader = new qq.FineUploader({
            element: document.getElementById("uploader"),
            template: 'qq-template',
            request: {
            endpoint: "endpoint.php"
                },
                deleteFile: {
                    enabled: true,
                    endpoint: "endpoint.php"
                },
                chunking: {
                    enabled: true,
                    concurrent: {
                        enabled: true
                    },
                    success: {
                        endpoint: "endpoint.php?done"
                    }
                },
                resume: {
                    enabled: true
                },
                retry: {
                    enableAuto: true,
                    showButton: true
                },
                    thumbnails: {
                        placeholders: {
                            waitingPath: 'fine-uploader/placeholders/waiting-generic.png',
                            notAvailablePath: 'fine-uploader/placeholders/not_available-generic.png'
                        }
                    },

                    validation: {
                        allowedExtensions: ['jpeg', 'jpg', 'gif', 'png']
                    },
                    debug: true
                });
            </script>
            <br>
			<textarea class="form-control" rows="6" placeholder="what's happening?" id="postarea"></textarea>
            <div class="jumbotron"></div>
            <div class="row extraTags">
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