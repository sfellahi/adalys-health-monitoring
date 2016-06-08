<?php
//Cette page permet d'initialiser le site en verifiant par exemple si le membre est connecté
session_start();
     mysqli_set_charset($link, "utf8");
header('Content-type: text/html;charset=UTF-8');
if(!isset($_SESSION['email']) and isset($_COOKIE['email'], $_COOKIE['password']))
{
	$cnn = mysqli_query($link,'select password,id,profil from users where email="'.mysql_real_escape_string($_COOKIE['email']).'"');
	$dn_cnn = mysqli_fetch_array($cnn);
	if(sha1($dn_cnn['password'])==$_COOKIE['password'] and mysqli_num_rows($cnn)>0)
	{
		$_SESSION['email'] = $_COOKIE['email'];
		$_SESSION['userid'] = $dn_cnn['id'];
        $_SESSION['profil'] = $dn_cnn['profil'];
	}
        
}
?>