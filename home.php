<?php
session_start();
echo $_SESSION['USR_AUTH'],"<br>",$_SESSION['username'],"<br>",$_SESSION['email'],"<br>",$_SESSION['address'],"<br>",$_SESSION['phone'],"<br>",$_SESSION['neighborhood'];
?>