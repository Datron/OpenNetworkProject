<?php
include 'dbconfig.php';
$table = "comments";
session_start();
$mysqli = new mysqli($db_hostname,$db_username,$db_password,$db_database);
if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
}
if (isset($_POST['post_id']) && isset($_POST['content']))
{
    $post_id = htmlspecialchars($_POST['post_id']);
    $comment = htmlspecialchars($_POST['content']);
    lockTableRead($table,$mysqli);
    $query = "INSERT INTO comments(id, post_id, content, owner, neighborhood, TIMESTAMP) VALUES(NULL,'$post_id','$comment','{$_SESSION['username']}','{$_SESSION['neighborhood']}',CURRENT_TIMESTAMP)";
    echo $query;
    if ($mysqli->query($query) == true)
        echo "comment added";
    else
        echo "commenting failed".$mysqli->error;
    unlockTable($mysqli);
    $mysqli->close();
}
?>