<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Baxster an Admin Panel Category Flat Bootstrap Responsive Website Template | Login :: w3layouts</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Baxster Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<link rel="icon" href="favicon.ico" type="image/x-icon" >
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<!--webfonts-->
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
<!--//webfonts--> 
<!-- js -->
<script src="js/jquery-1.11.1.min.js"></script>
<!-- //js -->
</head> 
<body class="login-bg">
		<div class="login-body">
			<div class="login-heading">
				<h1>Login</h1>
			</div>
			<div class="login-info">
				<form action="login.php" method="post">
					<input type="text" class="user" name="email" placeholder="Email" required="">
					<input type="password" name="password" class="lock" placeholder="Password">
					<div class="forgot-top-grids">
						<div class="forgot-grid">
							<ul>
								<li>
									<input type="checkbox" id="brand1" value="">
									<label for="brand1"><span></span>Remember me</label>
								</li>
							</ul>
						</div>
						<div class="forgot">
							<a href="#">Forgot password?</a>
						</div>
						<div class="clearfix"> </div>
					</div>
					<input type="submit" name="Sign In" value="Login">
					<div class="signup-text">
						<a href="signup.php">Don't have an account? Create one now</a>
					</div>
				</form>
			</div>
		</div>
		<div class="go-back login-go-back">
				<a href="index.html">Go To Home</a>
			</div>
		<div class="copyright login-copyright">
           <p>© 2016 Baxster . All Rights Reserved . Design by <a href="http://w3layouts.com/">W3layouts</a></p>    
		</div>
</body>
</html>

<?php
// Connexion à la base de données
		$link = mysql_connect("localhost", "root", "")
		// $link = mysql_connect("localhost", "root", "")
		or die("Impossible de se connecter : " . mysql_error());
		
		// Rendre la base de données bdd, la base courante
		$db_selected = mysql_select_db('adalys', $link);
		if (!$db_selected){
			die ('Impossible de sélectionner la base de données : ' . mysql_error());
		}	

$opseudo = '';
	//On verifie si le formulaire a ete envoye
	if(isset($_POST['email'], $_POST['password']))
	{
		//On echappe les variables pour pouvoir les mettre dans des requetes SQL
		if(get_magic_quotes_gpc())
		{
			$opseudo = stripslashes($_POST['email']);
			$email = mysql_real_escape_string(stripslashes($_POST['email']));
			$password = stripslashes(md5($_POST['password']));
		}
		else
		{
		$email = mysql_real_escape_string($_POST['email']);
		$password = stripslashes(md5($_POST['password']));
		}
		//On recupere le mot de passe de lutilisateur
		 $req = mysql_query('select password,id_user from user where identifiant="'.$email.'"');
		 $dn = mysql_fetch_array($req);
		
		//On le compare a celui quil a entre et on verifie si le membre existe
		if($dn['password']==$password and mysql_num_rows($req)>0)
		{
			//Si le mot de passe est bon, on ne vas pas afficher le formulaire
			$form = false;
			//On enregistre son email dans la session email et son identifiant dans la session userid
			$_SESSION['email'] = $_POST['email'];
			$_SESSION['id'] = $dn['id_user'];
			
			//On récupère les infos de l'user connecté
			if(isset($_SESSION['email'])){$dnn = mysql_fetch_array(mysql_query('select identifiant from user where identifiant="'.$_SESSION['email'].'"'));
			}
			echo "ok";
		}
			else
			{
				//Sinon, on indique que la combinaison nest pas bonne
				$form = true;
				$message = 'La combinaison que vous avez entr&eacute; n\'est pas bonne.';
			}
		}
		else
		{
			$form = true;
		}
		if($form)
		{
			//On affiche un message s'il y a lieu
		if(isset($message))
		{
			echo '<section>'.$message.'</section>';
		}
		//On affiche le formulaire

	}
	?>