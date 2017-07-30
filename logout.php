<?php
if ($_SESSION['USR_AUTH'] == true)
{
session_unset();
session_destroy();
session_write_close();
setcookie(session_name(),'',0,'/');
}
header("Location: http://mybairro.com/myindex.html");
?>