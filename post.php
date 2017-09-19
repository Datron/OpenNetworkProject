<?php
/**
 * PHP script to create a post, save it in the table userposts in db mybiarro. It also allows for classifications.
 */
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

    /**
     *  Create the post
     */
    function makePost(){
        include 'dbconfig.php';
         $table = "user_posts";
        $mysqli = new mysqli($db_hostname,$db_username,$db_password,$db_database);
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }
        lockTableRead($table,$mysqli);
        $this->post_content = $mysqli->real_escape_string($this->post_content);
        $likes = 0;
        $comments = 0;
        $create_post = "INSERT INTO user_posts (id, type, content, img_src, owner, time, likes, neighborhood, comments) VALUES (NULL, '$this->post_type', '$this->post_content', '$this->post_img', '$this->post_owner',  CURRENT_TIMESTAMP, '$likes', '$this->post_nbhood', '$comments')";
        if($mysqli->query($create_post) == true)
        {
            echo "query done";
        }
        else
             echo $mysqli->error;
        $_SESSION['photo_path'] = null;
        $_SESSION['tags'] = null;
        unlockTable($mysqli);
        $mysqli->close();
    }
}
session_start();
if(isset($_POST['text']))
{
    echo "variables recieved. All systems go.";
    if (isset($_POST['tags']))
        $tags_token = $_POST['tags'];
    else 
        $tags_token = null;
//    $str;
//    foreach ($tags_token as $tag)
//    {
//        $str = $str.$tag;
//    }
    $post = new Post($tags_token,$_POST['text'],$_SESSION["photo_path"],$_SESSION['username'],$_SESSION['neighborhood']);
    $post->makePost();
}
else
{
    echo "nothing recieved";
}

?>
