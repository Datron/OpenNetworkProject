<?php
$db_hostname='localhost';
$db_database="mybiarro";
$db_username='root';
$db_password='';

function lockTableRead($table,$sql){
    $q = "LOCK TABLES '$table' READ";
    $res = $sql->query($q);
}
function lockTableWrite($table,$sql){
    $q = "LOCK TABLES '$table' WRITE";
    $res = $sql->query($q);
}
function unlockTable($sqldb){
    $q = "UNLOCK TABLES";
    $res = $sqldb->query($q);
}
?>