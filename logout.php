<?php
//Cette page permet aux utilisateurs de se connecter ou de se deconnecter
include('html/mainheader.php');

if(isset($_SESSION['email']))
{
	unset($_SESSION['email'], $_SESSION['userid']);
	setcookie('email', '', time()-100);
	setcookie('password', '', time()-100);

?>
<meta http-equiv="refresh" content="1;URL=login.php">
<?php
}
?>