<?php
//This page let an user edit his profile
include("html/mainheader.php");

if(isset($_POST['password'], $_POST['passverif']))
	{
		if(get_magic_quotes_gpc())
		{
			$_POST['password'] = stripslashes($_POST['password']);
			$_POST['passverif'] = stripslashes($_POST['passverif']);
			$_POST['photo'] = $_POST['photo'];
		}
		
			if(strlen($_POST['password'])>=6)
			{
				if($_POST['password']==$_POST['passverif'])
				{
					$password = mysqli_real_escape_string($link,md5($_POST['password']));
				
						$req2 = $link -> query('update users set password="'.$password.'" where id="'.mysqli_real_escape_string($link,$_SESSION['userid']).'"');
						if($req2)
						{
							
							
							unset($_SESSION['email'], $_SESSION['userid']);
?>
		<div id="page-wrapper">
			<div class="main-page">
				Votre profil a bien été modifié. Vous devez vous relogger.<br />
			</div>
        </div>
	<meta http-equiv="refresh" content="1;URL=login.php">
<?php			
					}
				}
					else
					{
						$form = true;
						$message = 'Vos passwords ne sont pas identiques.';
					}
				}
				else
				{
					$form = true;
					$message = 'Votre mot de passe contient moins de 6 caractères ';
				}
			
		}
	else
	{
		$form = true;
	}
	if($form)
	{
		if(isset($message))
		{
			?>
			<div id="page-wrapper">
			<div class="main-page">
			<?php
			echo '<strong>'.$message.'</strong>';?>
			</div>
			</div>
			<?php
		}
		else 
		{
			?>
			<div class="container">
			<form role="form" action="edit_profile.php" method="post">
       Vous pouvez modifier vos informations:<br />
        <!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
			<div class="form-group">
            Entrer votre password(6 characters min.)<span class="small"></span>
            <input class="form-control" type="password" name="password" id="password" placeholder="Entrer votre nouveau password"/>
            Confirmer votre password<span class="small">(verification)</span>
            <input class="form-control" type="password" name="passverif" id="passverif" placeholder="Retaper votre passe"/>
            </div>
            <input type="submit" value="Modifier mon password" class="btn btn-default"/>
    </form>
    </div>
 
    <div class="form-group">
      <form name="upload" method="post" action="upload.php" enctype="multipart/form-data">
        <label></label><input type="file" name="fichier_upload" id="fichier_upload">
        <label></label><input class="btn btn-default btn-file" type="submit" name="Submit" value="Uploader">
      </form>
      </div>
</div>
        </div>
        <?php
        }
	}

include("html/mainfooter.html");?>