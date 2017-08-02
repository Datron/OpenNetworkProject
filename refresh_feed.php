<?php
include 'user.php';
$user = new User();
if (isset($_POST['refresh']))
    $user->getFeed();
?>