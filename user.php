<?php    
class User {
    public $username;
    public $email;
    public $phone;
    public $nbhood;
    public $id;
    public $address;
    public $isLoggedIn;
    public $userAction;
    
    
    function setUserAction($usr_action){
        $this->userAction = $usr_action;
    }
    
    function getFeed(){
        include 'dbconfig.php';
        $mysqli = new mysqli($db_hostname,$db_username,$db_password,$db_database);
        $q = "SELECT * FROM user_posts ORDER BY time DESC LIMIT 0,30";
        $html;
        if ($result = $mysqli->query($q))
        {
            while ($row = $result->fetch_assoc()){
               $html = <<<EOT
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
                    $html .= self::manageComments($row['id'],$mysqli);
                
                    $html .= <<<EOT
                        <div class="add-comment">
                        <textarea name="" class="form-control userComment" rows="2" placeholder="add a comment...."></textarea>
                        <br>
                        <button class="btn btn-primary comment-button" value="{$row['id']}">comment</button>
                        </div>
                    </div>
                </div>
                    <br>
                    <br>
EOT;
            echo $html;
            }
        }
        $mysqli->close();
    }
    
    
    function post(){
        //add post functionality in the future if needed else delete this function
    }
    
    function notifs(){
        //add notifs to the bell icon during first load    
    }
    
    function getNeighbors(){
        //get neighbors in the area
    }
    
    function postLiked($userpost){
        $query = "INSERT INTO notifications VALUES('$userpost',null,'$post_id',null,'{$_SESSION['username']}',false,CURRENT_TIMESTAMP)";
        if ($mysqli->query($query) == true)
            echo "notifs sent and updated for likes";
    }
    
    
    function manageComments($post_id,$mysqli){
        $q = "SELECT * FROM comments WHERE post_id=$post_id";
        $comments = null;
        if ($result = $mysqli->query($q))
        {
            while ($row = $result->fetch_assoc())
            {
                $comments .= <<<EOT
                <div class="single-comment">
                        <image src="images/user-default-gray.png" class="image-circle"></image>
                <h4>{$row['owner']},{$row['neighborhood']}</h4>
                <p class="actual-comments"> {$row['content']} </p>
                </div>
EOT;
                
            }
            return $comments;
        }
    }
    
    
    function catergoryClicks(){
        //Deal with clicks on the sidebar
    }
    
    function showEvents(){
        //find events to display to the user    
    }
    
    function displayUserProfile(){
        //show other user profiles    
    }
    function getUserSettings(){
        $html = <<<EOT
        <div class="container-fluid settings">
            <div class="row">
                <div class="col-md-1"></div>
            <div class="col-md-5">
                <form action="" method="POST" class="form-horizontal" role="form">
                    <div class="form-group">
                        <legend>Name</legend>
                        <div class="row">
                         <div class="col-md-6">
                             <input type="text" id="new-firstname" class="form-control" value="" required="required">
                        </div>
                        <div class="col-md-6">
                            <input type="text" id="new-lastname" class="form-control" value="" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <legend>email</legend>

                        <input type="email" id="new-email" class="form-control" value="" required="required">
                    </div>
                    
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
                    <textarea name="" id="aboutme" class="form-control" rows="3" required="required"></textarea>
                    <br>
                    <label class="label label-default">Interests</label>
                    <textarea name="" id="interests" class="form-control" rows="2" required="required"></textarea>
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
EOT;
        echo $html;
    }
    
    function setUserSettings(){
        //new user settings updated here
    }
}
?>