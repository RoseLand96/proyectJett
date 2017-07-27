<?php if (!isset($_SESSION)) {
  session_start();
}?>

<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_connectionBuyo = "rmspavs8mpub7dkq.chr7pe7iynqr.eu-west-1.rds.amazonaws.com";
$database_connectionBuyo = "h2kfj2brelnh2h1b";
$username_connectionBuyo = "ddn7memdexgsxjz6";
$password_connectionBuyo = "vs096nxeflaie5ug";
$connectionBuyo = mysql_pconnect($hostname_connectionBuyo, $username_connectionBuyo, $password_connectionBuyo) or trigger_error(mysql_error(),E_USER_ERROR); 
?>
<?php 
if (is_file("includes/funciones.php")){
	include("includes/funciones.php");
}
else
{
	include("../includes/funciones.php");
	}
?>