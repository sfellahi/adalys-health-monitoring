<?php
include("html/header.html");
include("config.php");

if(isset($_SESSION['email']))
{
header('Location: index.php');
exit();
}
$opseudo = '';
	//On verifie si le formulaire a ete envoye
	if(isset($_POST['email'], $_POST['password']))
	{
		//On echappe les variables pour pouvoir les mettre dans des requetes SQL
		if(get_magic_quotes_gpc())
		{
			$opseudo = stripslashes($_POST['email']);
			$email = mysqli_real_escape_string($link,$_POST['email']);
			$password = stripslashes(md5($_POST['password']));
		}
		else
		{
			$email = mysqli_real_escape_string($link,$_POST['email']);
			$password = stripslashes(md5($_POST['password']));
		}
		//On recupere le mot de passe de lutilisateur
		$req = $link -> query('select password,id,profil from users where email="'.$email.'"');
		$dn = mysqli_fetch_array($req);
		
		//On le compare a celui quil a entre et on verifie si le membre existe
		if($dn['password']==$password and mysqli_num_rows($req)>0)
			{
			//Si le mot de passe est bon, on ne vas pas afficher le formulaire
			$form = false;
			//On enregistre son email dans la session email et son identifiant dans la session userid
			$_SESSION['email'] = $_POST['email'];
			$_SESSION['userid'] = $dn['id'];
			$_SESSION['profil'] = $dn['profil'];
			//On récupère les infos de l'user connecté
			if(isset($_SESSION['email']))
				{
				$req_usern=$link->query('select email from users where email="'.$_SESSION['email'].'"');
				$dnn = mysqli_fetch_array($req_usern);
				}
				 header('Location: index.php');
				 exit();
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
?>
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
									<label for="brand1"><span></span>Remember me</label><input type="checkbox" name="memorize" id="memorize" value="yes" /><br />
								</li>
							</ul>
						</div>
						<div class="forgot">
							<a href="pass_forgot.php">Forgot password?</a>
						</div>
						<div class="clearfix"> </div>
					</div>
					<input type="submit" name="Sign In" value="Login">
					<?php
						if($form)
						{
						//On affiche un message sil y a lieu
						if(isset($message))
							{							
						?>
							<div class="bs-example">
								<div class="alert alert-danger fade in">
									<a href="#" class="close" data-dismiss="alert">&times;</a>   
									<?php
									echo $message;
									?>
								</div>
							</div>
						<?php

							}
						}
					?>
					<div class="signup-text">
						<a href="signup.php">Don't have an account? Create one now</a>
					</div>
				</form>
			</div>
		</div>
<?php include("html/footer.html"); ?>