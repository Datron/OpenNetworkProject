<?php
include 'dbconfig.php';
$table = 'notfications';
session_start();
$mysqli = new mysqli($db_hostname,$db_username,$db_password,$db_database);
if ($mysqli->connect_error) 
{
    die("Connection failed: " . $mysqli->connect_error);
}
$username = $_SESSION['username'];
if(true)
{
    $query = "SELECT comment_id,post_id,comment_from,liked_by,is_read FROM notifications WHERE username = '$username' ORDER BY time DESC limit 6";
    $results = $mysqli->query($query);
    $html=null;
    while ($row = $results->fetch_object())
    {
        if  ($row->comment_from != null)
        {
            if ($row->is_read == 1)
            {
            $html.= <<<EOT
            <div class="row notifs read" value='$row->post_id'>
                <p class="notifs-text"><b>$row->comment_from</b> commented on your post </p>
            </div>
EOT;
            }
            else
            {
            $html.= <<<EOT
            <div class="row notifs" value='$row->post_id'>
                <p class="notifs-text"><b>$row->comment_from</b> commented on your post </p>
            </div>
EOT;
            } 
        }
        else if ($row->liked_by != NULL)
        {
            if ($row->is_read)
            {
                $html.= <<<EOT
                <div class="row notifs read" value='$row->post_id'>
                    <p class="notifs-text"><b>$row->liked_by</b> liked your post </p>
                </div>
EOT;
            } 
        }
       
    }
    echo $html;
}
?>
