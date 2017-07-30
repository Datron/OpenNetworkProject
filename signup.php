<?php
include 'dbconfig.php';
session_start();
$mysqli = new mysqli($db_hostname,$db_username,$db_password,$db_database);
$table = 'users';
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
} 
if (isset($_POST['firstname']) && isset($_POST['zip']))
{
    $name = htmlentities(strip_tags(stripslashes($_POST['firstname'].' '.$_POST['lastname'])));
    $password = htmlentities(strip_tags(stripslashes($_POST['npass'])));
    $email = htmlentities(strip_tags(stripslashes($_POST['email'])));
    $neighborhood = htmlentities(strip_tags(stripslashes($_POST['neighborhood'])));
    $address = htmlentities(strip_tags(stripslashes($_POST['sAddress'].','.$_POST['cAddress'].','.$_POST['zip'])));
    $phone = htmlentities(strip_tags(stripslashes($_POST['phoneno'])));
    $hashpass = password_hash($password,PASSWORD_BCRYPT);
    lockTableRead($table,$mysqli);
    $query = "INSERT INTO users (username,password,email,phone,address,neighborhood)
                VALUES('$name','$hashpass','$email','$phone','$address','$neighborhood')";
    unlockTable($mysqli);
    if ($mysqli->query($query) === TRUE) {
        $_SESSION['USR_AUTH'] = TRUE;
        $_SESSION['username'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['address'] = $address;
        $_SESSION['phone'] = $phone;
        $_SESSION['neighborhood'] = $neighborhood;
        header("Location: http://localhost/mybiarro/home.php"); /* Redirect browser */
        exit;
    }
    else{
        echo $mysqli->error;
    }
}
?>
<html DOCTYPE!>
    <head>
    <title>myBairro - The social network for your neigbourhood|Sign in page</title>
    <meta charset="utf-8">
    <meta lang="en">
    <!---------------- SEO --------------------------->
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta name="author" content="developed by Kartik Gajendra" />
	<meta property="og:title" content=""/>
	<meta property="og:description" content=""/>
	<meta property="og:url" content=""/>
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
    <script>
    function checkPasswordMatch() {
    var password = $("#password").val();
    var confirmPassword = $("#rpassword").val();

    if (password != confirmPassword)
        $("#check").html('<i class="glyphicon glyphicon-remove" id="checkwrong"></i>');
    else
        $("#check").html('<i class="glyphicon glyphicon-ok" id="checkok"></i>');
}

    $(document).ready(function () {
       $("#password, #rpassword").keyup(checkPasswordMatch);
    });    
    </script>
    <style>
        #checkok {
            color: lawngreen;
        }
        #checkwrong {
            color: red;
        }
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
                <div class="col-md-6">
        <form action="" method="POST" class="form-horizontal" role="form">
		<div class="form-group">
			<legend>Please provide some more details</legend>
		</div>
            <div class="form-group">
                <input type="text" class="form-control form-field" value="<?php if(isset($_POST['firstname'])) echo $_POST['firstname'];
                        else echo "First Name"; ?>" id="firstName" name="firstname" required>
                      <br>
                      <input type="text" class="form-control form-field" value="<?php if(isset($_POST['lastname'])) echo $_POST['lastname'];
                        else echo "Last Name"; ?>" id="lastName" name="lastname" required>
                      <br>
                      <input type="text" class="form-control form-field" value="<?php if(isset($_POST['email'])) echo $_POST['email'];
                        else echo "Enter email ID"; ?>" id="emailId" name="email" required>
                      <br>
                    <input type="password" class="form-control form-field" placeholder="password" id="password" name="npass" required>
                      <br>
                <input type="password" class="form-control form-field" placeholder="retype password" id="rpassword" name="rpass" required><i id="check"></i>
                      <br>
                      <input type="text" class="form-control form-field" value="<?php if(isset($_POST['neighborhood'])) echo $_POST['neighborhood'];
                        else echo "Neigbourhood"; ?>" id="Neighborhood" name="neighborhood" required>
                      <br>
                      <input type="text" class="form-control form-field" placeholder="Address" id="sAddress" name="sAddress" required>
                    <br>
                      <input type="text" class="form-control form-field" placeholder="City and State" id="cAddress" name="cAddress" >
                <br>
                      <input type="text" class="form-control form-field" placeholder="zipcode" id="zip" name="zip" required>
                <br>
                        <input type="text" class="form-control form-field" placeholder="Phone Number" id="phoneno" name="phoneno" required>
                <br>
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
<?php
        $mysqli->close();
?>