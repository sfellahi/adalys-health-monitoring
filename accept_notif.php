<?php
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
else
{
?>
<form action="accept_notif.php?parent=<?php echo $id; ?>" method="post">
	Voulez vous etres associe au projet?
    <input type="hidden" name="confirm" value="yes" />
    <input type="submit" value="Yes" /> <input type="button" value="No" onclick="javascript:history.go(-1);"/>
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