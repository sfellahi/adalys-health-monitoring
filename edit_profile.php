<?php
//This page let an user edit his profile
include("html/mainheader.php");

if(isset($_POST['password'], $_POST['passverif']))
	{
		if(get_magic_quotes_gpc())
		{
			$_POST['password'] = stripslashes($_POST['password']);
			$_POST['passverif'] = stripslashes($_POST['passverif']);
		}
		if($_POST['password']==$_POST['passverif'])
		{
			$password = mysqli_real_escape_string($link,md5($_POST['password']));
			if(strlen($_POST['password'])>=6)
			{
						$req2 = $link -> query('update users set password="'.$password.'" where id="'.mysqli_real_escape_string($link,$_SESSION['userid']).'"');
						if($req2)
						{
							$form = false;
							unset($_SESSION['email'], $_SESSION['userid']);
?>
		<div id="page-wrapper">
			<div class="main-page">
				Your profile have successfully been edited. You must login again.<br />
			</div>
        </div>
	<meta http-equiv="refresh" content="1;URL=login.php">
<?php
						}
				else
				{
					$form = true;
					$message = 'Your password must have a minimum of 6 characters.';
				}
			}
			else
			{
				$form = true;
				$message = 'The passwords you entered are not identical.';
			}
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
			echo '<strong>'.$message.'</strong>';
		}
	}
?>
    <form action="edit_profile.php" method="post">
        You can edit your informations:<br />
        <!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
            <label for="password">Password<span class="small">(6 characters min.)</span></label><input type="password" name="password" id="password"/><br />
            <label for="passverif">Password<span class="small">(verification)</span></label><input type="password" name="passverif" id="passverif"/><br />
            <input type="submit" value="Submit" />
        	</div>
        </div>
    </form>
<?php include("html/mainfooter.html");?>