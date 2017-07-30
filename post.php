<?php
/*PHP script to create a post, save it in the table userposts in db mybiarro. It also allows for classifications. */
class Post {
    public $post_type;
    public $post_content;
    public $post_img;
    public $post_owner;
    public $post_nbhood;
    function __construct($post_type,$post_content,$post_img,$post_owner,$post_nbhood){
        $this->post_type = $post_type;
        $this->post_content = $post_content;
        $this->post_img = $post_img;
        $this->post_owner = $post_owner;
        $this->post_nbhood = $post_nbhood;
    }
    function makePost(){
        include 'dbconfig.php';
         $table = "user_posts";
        $mysqli = new mysqli($db_hostname,$db_username,$db_password,$db_database);
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }
        lockTableRead($table,$mysqli);
        $likes = 50;
        $comments = 10;
        $create_post = "INSERT INTO user_posts (id, type, content, img_src, owner, time, likes, neighborhood, comments) VALUES (NULL, '$this->post_type', '$this->post_content', NULL, '$this->post_owner',  CURRENT_TIMESTAMP, '$likes', '$this->post_nbhood', '$comments')";
        if($mysqli->query($create_post) == true)
            echo "query done";
        else
             echo $mysqli->error;
        unlockTable($mysqli);
    }
}
session_start();
if(isset($_POST['text']) && isset($_POST['tags']))
{
    echo "variables recieved. All systems go.";
    $tags_token = $_POST['tags'];
    $str;
    foreach ($tags_token as $tag)
    {
        $str = $str.$tag;
    }
    $post = new Post($str,$_POST['text'],null,$_SESSION['username'],$_SESSION['neighborhood']);
    $post->makePost();
}
else
    echo "nothing recieved";


?>
