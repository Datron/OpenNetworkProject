<?php
include 'dbconfig.php';
$table = 'notfications';
$mysqli = new mysqli($db_hostname,$db_username,$db_password,$db_database);
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
$username = $_SESSION['username'];
if($_POST['notfis'] == 1)
{
    $query = "SELECT comment-id,post-id,comment-from,liked,liked-by,is-read FROM notifications WHERE username = '$username' ORDER BY time DESC limit 6";
    $results = $mysqli->query($query);
    $html;
    while ($row = $result->fetch_assoc())
    {
        if  ($row[comment-from != null])
        {
        if ($row['is-read'])
        $html.= <<<EOT
        <div class="row notifs read" value='{$row[post-id]}'>
            <p class="notifs-text"><b>{$row['comment-from']}</b> commented on your post </p>
        </div>
EOT;
        else
          $html.= <<<EOT
        <div class="row notifs" value='{$row[post-id]}'>
            <p class="notifs-text"><b>{$row['comment-from']}</b> commented on your post </p>
        </div>
EOT;      
        }
        else if ($row['liked'])
        {
            if ($row['is-read'])
            $html.= <<<EOT
        <div class="row notifs read" value='{$row[post-id]}'>
            <p class="notifs-text"><b>{$row['liked-by']}</b> liked your post </p>
        </div>
EOT;
            else
                $html.= <<<EOT
        <div class="row notifs" value='{$row[post-id]}'>
            <p class="notifs-text"><b>{$row['liked-by']}</b> liked your post </p>
        </div>
EOT;
        }
    }
}
?>