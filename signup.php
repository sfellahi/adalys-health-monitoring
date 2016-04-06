<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Baxster an Admin Panel Category Flat Bootstrap Responsive Website Template | Signup :: w3layouts</title>
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
				<h1>Sign up</h1>
			</div>
			<div class="login-info">
				<form action="signup.php" method="post">
					<input type="text" class="user" name="email" placeholder="Email" required="">
					<input type="password" name="password" class="lock" placeholder="Password">
					<input type="password" name="password" class="lock" placeholder="Confirm Password">
					<input type="submit" name="Sign In" value="Sign up">
					<div class="signup-text">
						<a href="login.php">Already have an account? Login here.</a>
					</div>
				</form>
			</div>
		</div>
		
		<?php
// Connexion à la base de données
		// $link = mysql_connect("localhost", "root", "root")
		$link = mysqli_connect("localhost", "root", "","adalys");
		if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }	

//On verifie que le formulaire a ete envoye
if(isset( $_POST['email'],$_POST['password']) and $_POST['email']!='')
{
	//On enleve lechappement si get_magic_quotes_gpc est active
	if(get_magic_quotes_gpc())
	{
		$_POST['email'] = stripslashes($_POST['email']);
		$_POST['password'] = stripslashes($_POST['password']);
		
	}	
		//On verifie si le mot de passe a 6 caracteres ou plus
		if(strlen($_POST['password'])>=6)
		{
			//On verifie si lemail est valide
			if(preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',$_POST['email']))
			{
				//On echape les variables pour pouvoir les mettre dans une requette SQL
				$email = mysqli_real_escape_string($link,$_POST['email']);				
				$password = mysqli_real_escape_string($link,md5($_POST['password']));
				//On verifie sil ny a pas deja un utilisateur inscrit avec le email choisis
				$dn = mysqli_num_rows(mysqli_query($link,'select id_user from user where identifiant="'.$email.'"'));
				if($dn==0)
				{
				//On recupere le nombre dutilisateurs pour donner un identifiant a lutilisateur actuel
					$dn2 = mysqli_num_rows(mysqli_query($link,'select id_user from user'));
					$id = $dn2+1;
					
					
					
					//On enregistre les informations dans la base de donnee
                                        
					if(mysqli_query($link,'insert into user (identifiant, password) values ("'.$email.'","'.$password.'")'))
					{
											
								//Si ca a fonctionné, on n'affiche pas le formulaire
								$form = false;							
								?>
								<section>Vous avez bien &eacute;t&eacute; inscrit. Vous pouvez dor&eacute;navant vous connecter.<br /></section>
								<?php
					}
					else
					{
						//Sinon on dit quil y a eu une erreur
						$form = true;
						$message = 'Une erreur est survenue lors de l\'inscription.';
					}
				}
				else
				{
					//Sinon, on dit que le nni est deja utilisé
					$form = true;
					$message = 'Un autre utilisateur utilise d&eacute;j&agrave; le name d\'utilisateur que vous d&eacute;sirez utiliser.';
				}
			}
			else
			{
				//Sinon, on dit que lemail nest pas valide
				$form = true;
				$message = 'L\'email que vous avez entr&eacute; n\'est pas valide.';
			}
		}
		else
		{
			//Sinon, on dit que le mot de passe nest pas assez long
			$form = true;
			$message = 'Le mot de passe que vous avez entr&eacute; contien moins de 6 caract&egrave;res.';
		}
}
else
{
	$form = true;
}
if($form)
{
	//On affiche un message sil y a lieu
	if(isset($message))
	{
		echo '<section>'.$message.'</s>';
	}
}
?>
		
		<div class="go-back login-go-back">
				<a href="index.php">Go To Home</a>
			</div>
		<div class="copyright login-copyright">
           <p>© 2016 Baxster . All Rights Reserved . Design by <a href="http://w3layouts.com/">W3layouts</a></p>    
		</div>
</body>
</html>