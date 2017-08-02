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
    
    function logout(){
        
    }
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
                    <div class="review-header">
                        <image src="images/user-default-gray.png" class="image-circle"></image>
                        <h2 class="person-name"> {$row["owner"]},{$row["neighborhood"]} <h3 class="person-desig"> {$row["time"]}</h3></h2>
                    </div>
EOT;
                if ($row['img_src'] != null)
                    $html .= '<img src="'.$row['img_src'].'" alt="post image" class="img-responsive postpic">';
                
            $html .= <<<EOT
                    <p class="person-review"> {$row['content']} </p>
                    <div class="seperator">______________________________________</div>
                    <div class="toolbar">
                    <div class="likes"><i class="material-icons">thumb_up</i>{$row['likes']}</div>
                    <div class="comment"><i class="material-icons">chat</i>{$row['comments']}</div>
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
        
    }
    function notifs(){
        
    }
    function getNeighbors(){
        
    }
    function postLiked(){
        
    }
    function manageComments(){
        
    }
    function catergoryClicks(){
        
    }
    function showEvents(){
        
    }
    function displayUserProfile(){
        
    }
    function getUserSettings(){
        
    }
    function setUserSettings(){
        
    }
    
}