<?php
include 'dbconfig.php';
$mysqli = new mysqli($db_hostname,$db_username,$db_password,$db_database);
class User {
    public $username;
    public $email;
    public $phone;
    public $nbhood;
    public $id;
    public $address;
    public $isLoggedIn;

    /**
     *getFeed obtains the latest posts from the database and encapsulates the data in html
     */
    function getFeed(){
        global $mysqli;
        $q = "SELECT * FROM user_posts up,user_settings us WHERE up.owner=us.name ORDER BY time DESC LIMIT 0,30";
        $html;
        
        if ($result = $mysqli->query($q)) {
            while ($row = $result->fetch_assoc()) {
                $owner = $row['owner'];
                $html = <<<EOT
               <div class="review-card">
                    <div class="review-header" value="{$row['id']}">
                        <image src="{$row['picture']}" class="image-circle"></image>
                        <a href="profile.php?user=$owner" style="text-decoration:none"><h2 class="person-name">{$row["owner"]}</h2></a><h3 class="person-desig"> {$row["neighborhood"]}</h3>
                    </div>
EOT;
                if ($row['img_src'] != null)
                    $html .= '<img src="' . $row['img_src'] . '" alt="post image" class="img-responsive postpic">';

                $html .= <<<EOT
                    <p class="person-review"> {$row['content']} </p>
                    <div class="toolbar">
                    <button class="btn likes" value="{$row['id']}"><i class="material-icons">thumb_up</i><div class="count1">{$row['likes']}</div></button>
                    <button class="btn comment" value="{$row['id']}"><i class="material-icons">chat</i><div class="count2">{$row['comments']}</div></button>
                    </div>
                    <div class="comments-area">
EOT;
                $html .= self::manageComments($row['id'], $mysqli);

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
    }

    /**
     * @param $userTag
     */
    function getFeedBasedOn($userTag){
        global $mysqli;
        $q = "SELECT * FROM user_posts up,user_settings us WHERE up.owner=us.name AND up.type='$userTag' ORDER BY time DESC LIMIT 0,30";
        $html;

        if ($result = $mysqli->query($q))
        {
            while ($row = $result->fetch_assoc()){
                $owner = $row['owner'];
                $html = <<<EOT
               <div class="review-card">
                    <div class="review-header" value="{$row['id']}">
                        <image src="{$row['picture']}" class="image-circle"></image>
                        <a href="profile.php?user=$owner" style="text-decoration:none"><h2 class="person-name">{$row["owner"]}</h2></a><h3 class="person-desig"> {$row["neighborhood"]}</h3>
                    </div>
EOT;
                if ($row['img_src'] != null)
                    $html .= '<img src="'.$row['img_src'].'" alt="post image" class="img-responsive postpic">';

                $html .= <<<EOT
                    <p class="person-review"> {$row['content']} </p>
                    <div class="toolbar">
                    <button class="btn likes" value="{$row['id']}"><i class="material-icons">thumb_up</i><div class="count1">{$row['likes']}</div></button>
                    <button class="btn comment" value="{$row['id']}"><i class="material-icons">chat</i><div class="count2">{$row['comments']}</div></button>
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
    }

    function getNeighbors(){
        //get neighbors in the area
    }

    /**
     * @param $postid
     * @param $likeCount
     * when a user clicks the like button,handleLikes() ia called
     */
    function handleLikes($postid, $likeCount){
        global $mysqli;
        $sql = "UPDATE user_posts SET likes='$likeCount' WHERE id='$postid'";
        if ($mysqli->query($sql) == TRUE)
        {
            echo $mysqli->error;
            echo $mysqli->affected_rows;
        }
        else
            echo $mysqli->error;
    }

    /**
     * @param $postid
     * @param $commentCount
     * When the user comments, handle comments is called
     */
    function handleComments($postid, $commentCount){
        global $mysqli;
        $sql = "UPDATE user_posts SET comments='$commentCount' WHERE id='$postid'";
        if ($mysqli->query($sql) == TRUE)
        {
            echo $mysqli->error;
            echo $mysqli->affected_rows;
        }
        else
            echo $mysqli->error;
    }

    /**
     * @param $userpost
     * sends a notfication if the userpost was liked
     */
    function postLiked($userpost){
        global $mysqli;
        $query = "INSERT INTO notifications VALUES('$userpost',null,'$post_id',null,'{$_SESSION['username']}',false,CURRENT_TIMESTAMP)";
        if ($mysqli->query($query) == true)
            echo "notifs sent and updated for likes";
    }


    /**
     * @param $post_id
     * @param $mysqli
     * @return null|string
     * retrieves the comments from the comments table
     */
    function manageComments($post_id, $mysqli){
        $q = "SELECT * FROM comments,user_settings us WHERE comments.post_id=$post_id AND us.name=comments.owner";
        $comments = null;
        if ($result = $mysqli->query($q))
        {
            while ($row = $result->fetch_assoc())
            {
                $comments .= <<<EOT
                <div class="single-comment">
                        <image src="{$row['picture']}" class="image-circle"></image>
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
    
    function getUserProfile($userName){
            global $mysqli;
            $query = "SELECT * FROM user_settings us,users WHERE us.name = '$userName' AND users.username=us.name";
            $res = $mysqli->query($query);
            $row = $res->fetch_assoc();
            $html = <<<EOT
                <div class="container-fluid">
                    <div class="user-basics">
                        <img src="{$_SESSION['prof_pic']}" class="img-responsive image-square">
                        <h1 class="username">{$row['name']}</h1>
                        <h2>{$row['neighborhood']}</h2>
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
                                        {$row['about']}
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Interests</h3>
                                    </div>
                                    <div class="panel-body">
                                        {$row['interests']}
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">recommendations</h3>
                                    </div>
                                    <div class="panel-body">
                                        {$row['recommendations']}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
EOT;
            echo $html;
            $mysqli->close();
    }
    
    function displayUserProfile(){
        //show other user profiles    
    }

    /**
     * Obtain user settings from user_settings table
     */
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