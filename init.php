<?php
//Cette page permet d'initialiser le site en verifiant par exemple si le membre est connecté
session_start();
header('Content-type: text/html;charset=UTF-8');
if(!isset($_SESSION['email']) and isset($_COOKIE['email'], $_COOKIE['password']))
{
	$cnn = mysql_query('select password,id from users where email="'.mysql_real_escape_string($_COOKIE['email']).'"');
	$dn_cnn = mysql_fetch_array($cnn);
	if(sha1($dn_cnn['password'])==$_COOKIE['password'] and mysql_num_rows($cnn)>0)
	{
		$_SESSION['email'] = $_COOKIE['email'];
		$_SESSION['userid'] = $dn_cnn['id'];
	}
}
?>