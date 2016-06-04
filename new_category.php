<?php
//This page let create a new category
include('html/mainheader.php');
if(isset($_SESSION['email']) and $_SESSION['email']==$admin)
{

$nb_new_pm = mysqli_fetch_array(mysqli_query($link,'select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['userid'].'" and user1read="no") or (user2="'.$_SESSION['userid'].'" and user2read="no")) and id2="1"'));
$nb_new_pm = $nb_new_pm['nb_new_pm'];
?>
<?php
if(isset($_POST['name'], $_POST['description']) and $_POST['name']!='')
{
	$name = $_POST['name'];
	$description = $_POST['description'];
	if(get_magic_quotes_gpc())
	{
		$name = stripslashes($name);
		$description = stripslashes($description);
	}
	$name = mysqli_real_escape_string($link,$name);
	$description = mysqli_real_escape_string($link,$description);
	if(mysqli_query($link,'insert into categories (id, name, description, position) select ifnull(max(id), 0)+1, "'.$name.'", "'.$description.'", count(id)+1 from categories'))
	{
	?>
	<div id="page-wrapper">
			<div class="main-page">
				<div class="message">The category have successfully been created.<br />
				<meta http-equiv="refresh" content="1; URL=forum.php">
				</div>
			</div>
	</div>
	<?php
	}
	else
	{
		echo 'An error occured while creating the category.';
	}
}
else
{
?>
<div id="page-wrapper">
			<div class="main-page">
<form action="new_category.php" method="post">
	<label for="name">Nom</label><input type="text" name="name" id="name" /><br />
	<label for="description">Description</label>(html enabled)<br />
    <textarea name="description" id="description" cols="70" rows="6"></textarea><br />
    <input type="submit" value="Créer" class="btn btn-success"/>
</form>
<?php
}
?>
</div></div>
     <?php include("html/mainfooter.html");?>
<?php
}
else
{
	echo '<h2>You must be logged as an administrator to access this page: <a href="login.php">Login</a> - <a href="signup.php">Sign Up</a></h2>';
}
include("html/mainfooter.html");?>