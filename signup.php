<?php 
include("html/header.html");
include("config.php");
	
//On verifie que le formulaire a ete envoye
if(isset( $_POST['email'],$_POST['password'],$_POST['passverif'],$_POST['date']) and $_POST['email']!='')
{
	//On enleve lechappement si get_magic_quotes_gpc est active
	if(get_magic_quotes_gpc())
	{
		$_POST['nom'] = stripslashes($_POST['nom']);
		$_POST['prenom'] = stripslashes($_POST['prenom']);
		$_POST['date'] = stripslashes($_POST['date']);
		$_POST['email'] = stripslashes($_POST['email']);
		$_POST['password'] = stripslashes($_POST['password']);
		$_POST['passverif'] = stripslashes($_POST['passverif']);
		$_POST['profil'] = stripslashes($_POST['profil']);
	}	
		//On verifie si le mot de passe a 6 caracteres ou plus
		if(strlen($_POST['password'])>=6)
		{
			if($_POST['password'] == $_POST['passverif'])
			{
				if($_POST['date'] !='')
				{
					//On verifie si lemail est valide
					if(preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',$_POST['email']))
					{
						//On echape les variables pour pouvoir les mettre dans une requette SQL
						$email = mysqli_real_escape_string($link,$_POST['email']);				
						$password = mysqli_real_escape_string($link,$_POST['password']);
						$nom = mysqli_real_escape_string($link,$_POST['nom']);
						$prenom = mysqli_real_escape_string($link,$_POST['prenom']);
						$date = mysqli_real_escape_string($link,$_POST['date']);
						$profil = mysqli_real_escape_string($link,$_POST['profil']);
						//On verifie sil ny a pas deja un utilisateur inscrit avec le email choisis
						$dn = mysqli_num_rows(mysqli_query($link,'select id from users where email="'.$email.'"'));
						if($dn==0)
						{
						//On recupere le nombre dutilisateurs pour donner un identifiant a lutilisateur actuel
							$dn2 = mysqli_num_rows(mysqli_query($link,'select id from users'));
							$id = $dn2+1;
							
								//On enregistre les informations dans la base de donnee
								if(mysqli_query($link,'insert into users(nom,prenom,email, password,date_naissance,profil) values ("'.$nom.'","'.$prenom.'","'.$email.'","'.md5($password).'","'.$date.'", "'.$profil.'")'))
								{
														
											//Si ca a fonctionné, on n'affiche pas le formulaire
											$form = false;							
											$message = 'Vous avez été bien inscrit';
                                                                                        ?><meta http-equiv="refresh" content="1; URL=login.php"><?php 
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
								$message = 'Un autre utilisateur utilise d&eacute;j&agrave; l\'email d\'utilisateur que vous d&eacute;sirez utiliser.';
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
							//Sinon, on dit que lemail nest pas valide
							$form = true;
							$message = 'Entrez une date.';
						}
				}
				else
				{
					//Sinon, on dit que le mot de passe nest pas assez long
					$form = true;
					$message = 'Vous n\'avez pas rentré le meme mot de passe';

				}
		}
				else
				{
					//Sinon, on dit que le mot de passe nest pas assez long
					$form = true;
					$message = 'Le mot de passe que vous avez entr&eacute; contient moins de 6 caract&egrave;res.';

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
				<h1>Sign up</h1>
			</div>
			<div class="login-info">
				<form action="signup.php" method="post">
					<input type="text" class="user" name="nom" placeholder="Nom">
					<input type="text" class="user" name="prenom" placeholder="Prenom">
					<input type="text" class="user" name="email" placeholder="Email*" required="">
					<input type="password" name="password" class="lock" placeholder="Password*" required="">
					<input type="password" name="passverif" class="lock" placeholder="Confirm Password*" required="">
					<input type="date" name="date" required=""/>
					Vous êtes un :
					<select name="profil" class="user">
					  	<option value="user" selected>Utilisateur</option>
					  	<option value="medecin">Medecin</option>
						<option value="organisme">Organisme</option>
					</select>
					<input type="submit" name="Sign In" value="Sign up">
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
					else 
						if(isset($message))
						{							
						?>
							<div class="bs-example">
								<div class="alert alert-success fade in">
									<a href="#" class="close" data-dismiss="alert">&times;</a>
									<?php
									echo $message;
									?>
								</div>
							</div>
						<?php

						}
					?>
					<div class="signup-text">
						<a href="login.php">Already have an account? Login here.</a>
					</div>
				</form>
			</div>
		</div>
<?php
include("html/footer.html");
?>