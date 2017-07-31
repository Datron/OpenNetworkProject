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
if(isset($_POST['text']))
{
    echo "variables recieved. All systems go.";
    if (isset($_POST['tags']))
        $tags_token = $_POST['tags'];
    else 
        $tags_token = null;
    $str;
    foreach ($tags_token as $tag)
    {
        $str = $str.$tag;
    }
    /*if (isset($_FILES['upPhoto']))
{
    $nbhood_name = $_SESSION['neighborhood'];
    echo "photo verified.Script executing";
    $validextensions = array("jpeg", "jpg", "png");
    $temporary = explode(".", $_FILES["upPhoto"]["name"]);
    $file_extension = end($temporary);
    if ((($_FILES["upPhoto"]["type"] == "image/png") || ($_FILES["upPhoto"]["type"] == "image/jpg") || ($_FILES["upPhoto"]["type"] == "image/jpeg")
    ) && ($_FILES["upPhoto"]["size"] < 10000000)//Approx. 10mb files can be uploaded.
    && in_array($file_extension, $validextensions)) {
    if ($_FILES["upPhoto"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["upPhoto"]["error"];
    }
    else
    {
    $sourcePath = $_FILES['upPhoto']['tmp_name']; // Storing source path of the file in a variable
    $targetPath = "images/".basename($_FILES['upPhoto']['name']);// Target path where file is to be stored
    $_SESSION['photo_path'] = $targetPath;
    move_uploaded_file($sourcePath,$targetPath); // Moving Uploaded file
    echo "File uploaded";
    }
    }
}
else
    echo "Failure";*/
    $post = new Post($str,$_POST['text'],$_SESSION['photo_path'],$_SESSION['username'],$_SESSION['neighborhood']);
    $post->makePost();
}
else
{
    echo "nothing recieved";
}

?>
