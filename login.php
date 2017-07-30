<?php
include 'dbconfig.php';
session_start();
$table = "users";
$mysqli = new mysqli($db_hostname,$db_username,$db_password,$db_database);
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
} 
if ( isset($_POST["userlogin"]) && isset($_POST["password"]) )
{
    $userlogin = htmlentities(stripslashes(strip_tags($_POST["userlogin"])));
    $password = $_POST["password"];
    lockTableWrite($table,$mysqli);
    $query = "SELECT username,email,address,phone,neighborhood,password FROM users WHERE email='$userlogin'";
    $result = $mysqli->query($query);
    unlockTable($mysqli);
    $row = $result->fetch_object();
    if (password_verify($password,$row->password) == 1)
        userVerified($row);
    else
        wrongCred();
}
function userVerified($row){
    global $table,$mysqli;
    $_SESSION['USR_AUTH'] = TRUE;
    $_SESSION['username'] = $row->username;
    $_SESSION['email'] = $row->email;
    $_SESSION['address'] = $row->address;
    $_SESSION['phone'] = $row->phone;
    $_SESSION['neighborhood'] = $row->neighborhood;
    lockTableRead($table,$mysqli);
    $verifyquery = "UPDATE users SET isLoggedIn='1' WHERE username='$row->username'";
    $result1 = $mysqli->query($verifyquery);
    unlockTable($mysqli);
    header("Location: http://localhost/mybiarro/home.php"); /* Redirect browser */
    exit;
}
function wrongCred(){
    $_SESSION['USR_AUTH'] = FALSE;
    $html = <<<EOT
    <html DOCTYPE!>
    <head>
    <title>myBairro - The social network for your neigbourhood|login page</title>
    <meta charset="utf-8">
    <meta lang="en">
    <!---------------- SEO --------------------------->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!----------------------------------------------------------------------------------->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Chela+One|Fira+Sans|Lato|Roboto|Ubuntu|Pacifico" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <style>
            .mainNav {
                background-color: #27ae60;
                border-radius: 0px;
                height: 60px;
            }
            .navHeading {
                font-family: 'Pacifico',cursive;
                margin: 2px;
                color: white;
            }
            .form-field {
                margin:10px;
                /*background-color: #388E3C;*/
                border: 1px solid #388E3C;
                border-radius: 10px;
                /*color: white;*/
            }
            .form-field:focus {
                border: 1px solid #388E3C;
            }
            .btn-biarro {
                background-color: #388E3C;
                color: white;
                border-radius: 20px;
            }
            .biarro_description {
                margin-top: 60px;
            }
        .form-group {
            margin: 10px;
            padding: 4px;
        }
        </style>
    </head>
    <body>
        <!-------------------- NAVBAR--------------------------------------->
        <nav class="navbar mainNav">
        <div class="container-fluid">
            <div class="row">
            <div class="col-md-12"><h1 class="navHeading">myBairro</h1></div>
            </div>
            </div>
        </nav>
        <!----------------------------FORM STARTS----------------------------->
        <div class="container-fluid">
        <div class="row">
        <div class="col-md-7">
        <form action="" method="POST" class="form-horizontal" role="form">
		<div class="form-group">
			<div class="well">email ID or password is incorrect. If you haven't created an account yet,please sign up.</div>
          <input type="email" class="form-control form-field" id="user_login_mail" placeholder="enter email ID" name="userlogin" required>
           <input type="password" class="form-control form-field" id="userpass" placeholder="password" name="password" required>
		</div>
        <div class="form-group">
			<div class="col-sm-10 col-sm-offset-2">
				<button type="submit" class="btn btn-biarro">Submit</button>
			</div>
		</div>
        </form>
        </div>
        </div>
        </div>
        </body>
        </html>
EOT;
    echo $html;
}
$mysqli->close();
?>