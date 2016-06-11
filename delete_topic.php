<?php
// Cacher les warnings
ini_set("display_errors",0);error_reporting(0);
//This page let delete a topic
include('html/mainheader.php');
if(isset($_GET['id']))
{
	$id = intval($_GET['id']);
if(isset($_SESSION['email']))
{
	$dn1 = mysqli_fetch_array(mysqli_query($link,'select count(t.id) as nb1, t.title, t.parent, c.name from topics as t, categories as c where t.id="'.$id.'" and t.id2=1 and c.id=t.parent group by t.id'));
if($dn1['nb1']>0)
{
if($_SESSION['profil']=="admin")
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
	if(mysqli_query($link,'delete from topics where id="'.$id.'"'))
	{
	?>
	<div class="message">The topic have successfully been deleted.<br />
	<meta http-equiv="refresh" content="1; URL=list_topics.php?parent=<?php echo $dn1['parent']; ?>">
	<?php
	}
	else
	{
		echo 'An error occured while deleting the topic.';
	}
}
else
{
?>
<form action="delete_topic.php?id=<?php echo $id; ?>" method="post">
	Are you sure you want to delete this topic?
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
	echo '<h2>You don\'t have the right to delete this topic.</h2>';
}
}
else
{
	echo '<h2>The topic you want to delete doesn\'t exist.</h2>';
}
}
else
{
	echo '<h2>You must be logged as an administrator to access this page: <a href="login.php">Login</a> - <a href="signup.php">Sign Up</a></h2>';
}
}
else
{
	echo '<h2>The ID of the topic you want to delete is not defined.</h2>';
}
?>