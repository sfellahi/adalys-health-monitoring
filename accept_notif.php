<?php
// Cacher les warnings
ini_set("display_errors",0);error_reporting(0);
//This page let delete a category
include('html/mainheader.php');

if(isset($_GET['parent'])){
	
	$id = $_GET['parent'];
if(isset($_SESSION['email'])){
?>
    <body>
    	<div id="page-wrapper">
			<div class="main-page">
        <div class="content">
<?php
if(isset($_POST['confirm']))
{
	if($_POST['confirm']=="yes"){
		if(mysqli_query($link,'update project_user set user_accept = "yes", user_read = "yes" where id_project_user="'.$id.'"')) 
		{
		?>
		<div class="message">Vous etes maintenant associé au projet.<br />
		</div>
		<meta http-equiv="refresh" content="1; URL=index.php">
		<?php
		}
		else
		{
			echo 'An error occured while deleting the category and it topics.';
		}
	}
	else {
		if(mysqli_query($link,'update project_user set user_accept = "no", user_read = "yes" where id_project_user="'.$id.'"')) 
		{
		?>
		<div class="message">Vous avez refusé le projet.<br />
		</div>
		<meta http-equiv="refresh" content="1; URL=index.php">
		<?php
		}
	}
}
else
{
?>
<form action="accept_notif.php?parent=<?php echo $id; ?>" method="post">
	Voulez vous être associé au projet?
    <input type="submit" name="confirm" value="yes" />
    <input type="submit" name="confirm" value="no" />
</form>
<?php
}
?>
		</div></div></div>
	</body>
</html>
<?php
}
}
else
{
	echo '<h2>You must be logged as an administrator to access this page: <a href="login.php">Login</a> - <a href="signup.php">Sign Up</a></h2>';
}
include("html/mainfooter.html");?>