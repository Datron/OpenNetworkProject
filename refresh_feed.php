<?php
include 'user.php';
$user = new User();
if (isset($_POST['refresh']))
    $user->getFeed();
if (isset($_POST['tag']))
    $user->getFeedBasedOn($_POST['tag']);
?>