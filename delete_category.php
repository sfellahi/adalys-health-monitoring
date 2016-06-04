<?php
//This page let delete a category
include('html/mainheader.php');
if(isset($_GET['id']))
{
$id = intval($_GET['id']);
$dn1 = mysqli_fetch_array(mysqli_query($link,'select count(id) as nb1, name, position from categories where id="'.$id.'" group by id'));
if($dn1['nb1']>0)
{
if(isset($_SESSION['email']) and $_SESSION['profil']=="admin")
{
?>

    <body>
    	<div id="page-wrapper">
			<div class="main-page">
        <div class="content">
<?php
$nb_new_pm = mysqli_fetch_array(mysqli_query($link,'select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['userid'].'" and user1read="no") or (user2="'.$_SESSION['userid'].'" and user2read="no")) and id2="1"'));
$nb_new_pm = $nb_new_pm['nb_new_pm'];

if(isset($_POST['confirm']))
{
	if(mysqli_query($link,'delete from categories where id="'.$id.'"') and mysqli_query($link,'delete from topics where parent="'.$id.'"') and mysqli_query($link,'update categories set position=position-1 where position>"'.$dn1['position'].'"'))
	{
	?>
	<div class="message">The category and it topics have successfully been deleted.<br />
	</div>
	<meta http-equiv="refresh" content="1; URL=forum.php">
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
<form action="delete_category.php?id=<?php echo $id; ?>" method="post">
	Are you sure you want to delete this category and all it topics?
    <input type="hidden" name="confirm" value="true" />
    <input type="submit" value="Yes" /> <input type="button" value="No" onclick="javascript:history.go(-1);" />
</form>
<?php
}
?>
		</div></div></div>
	</body>
</html>
<?php
}
else
{
	echo '<h2>You must be logged as an administrator to access this page: <a href="login.php">Login</a> - <a href="signup.php">Sign Up</a></h2>';
}
}
else
{
	echo '<h2>The category you want to delete doesn\'t exist.</h2>';
}
}
else
{
	echo '<h2>The ID of the category you want to delete is not defined.</h2>';
}
include("html/mainfooter.html");?>