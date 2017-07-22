<?php
include 'dbconfig.php';
session_start();
$mysqli = new mysqli($db_hostname,$db_username,$db_password,$db_database);
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
} 
if ( isset($_POST["userlogin"]) && isset($_POST["password"]) )
{
    $userlogin = htmlentities(stripslashes(strip_tags($_POST["userlogin"])));
    $password = $_POST["password"];
    $query = "SELECT username,email,address,phone,neighborhood,password FROM users WHERE email='$userlogin'";
    $result = $mysqli->query($query);
    $row = $result->fetch_object();
    var_dump($row);
    if (password_verify($password,$row->password) == 1)
        userVerified($row);
    else
        wrongCred();
}
function userVerified($row){
    $_SESSION['USR_AUTH'] = TRUE;
    $_SESSION['username'] = $row->username;
    $_SESSION['email'] = $row->email;
    $_SESSION['address'] = $row->address;
    $_SESSION['phone'] = $row->phone;
    $_SESSION['neighborhood'] = $row->neighborhood;
    header("Location: http://localhost/mybiarro/home.php"); /* Redirect browser */
    exit;
}
function wrongCred(){
    $_SESSION['USR_AUTH'] = FALSE;
    include('login.html');
}
$mysqli->close();