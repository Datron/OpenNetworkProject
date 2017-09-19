<?php
include 'dbconfig.php';
$table = "comments";
session_start();
if (!isset($_SESSION['username']))
    header("Location: /index.html");
$mysqli = new mysqli($db_hostname,$db_username,$db_password,$db_database);
if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
}
if (isset($_POST['post_id']) && isset($_POST['content']))
{
    $post_id = htmlspecialchars($_POST['post_id']);
    $comment = $mysqli->real_escape_string(stripslashes(strip_tags(htmlspecialchars($_POST['content']))));
    lockTableRead($table,$mysqli);
    $query = "INSERT INTO comments(id, post_id, content, owner, neighborhood, TIMESTAMP) VALUES(NULL,'$post_id','$comment','{$_SESSION['username']}','{$_SESSION['neighborhood']}',CURRENT_TIMESTAMP)";
    if ($mysqli->query($query) == true)
    {
        echo "comment added";
        $res = $mysqli->insert_id;
        $quer = "INSERT INTO notifications(username,comment_id,post_id,comment_from,liked_by,is_read,time) VALUES('{$_POST['post_owner']}','$res','$post_id','{$_SESSION['username']}',null,false,CURRENT_TIMESTAMP)";
        if ($mysqli->query($quer) == true)
            echo "notifs sent and updated";
        else
            echo "notifs failed".$mysqli->error;
    }
    else
        echo "commenting failed".$mysqli->error;
    
    unlockTable($mysqli);
    $mysqli->close();
}
?>