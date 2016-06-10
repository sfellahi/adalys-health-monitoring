<?php
ob_start();
//Cette page permet aux utilisateurs de se connecter ou de se deconnecter
include('html/mainheader.php');

if(isset($_SESSION['email']))
{
	unset($_SESSION['email'], $_SESSION['userid'],$_SESSION['profil']);
	setcookie('email', '', time()-100);
	setcookie('password', '', time()-100);

?>
<div id="page-wrapper">
 			<div class="main-page">
 				<div class="row">
 					<div class="flat-table" style="margin:0 auto;margin-top:15%;width:18%;height:200px">
 						<div class="message" style="text-align:center ; font-weight:600;font-size:16px">Déconnexion en cours.<br /><br />
 							<div class="showbox">
 								<div class="loader">
 									<svg class="circular" viewBox="25 25 50 50">
 										<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
 									</svg>
 								</div>
 							</div>
 						</div>
 					</div>
 				</div>
 			</div>
 		</div>
<meta http-equiv="refresh" content="1;URL=login.php">
<?php
}
?>