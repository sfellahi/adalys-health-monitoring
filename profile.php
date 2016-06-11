<?php
// Cacher les warnings
ini_set("display_errors",0);error_reporting(0);
//This page display the profile of an user
include("html/mainheader.php");

if(isset($_GET['id']))
{
	$id = intval($_GET['id']);
	$dn = $link -> query('select email, date_inscription from users where id="'.$id.'"');
	if(mysqli_num_rows($dn)>0)
	{
		$dnn = mysqli_fetch_array($dn);
?>
This is the profile of "<?php echo htmlentities($dnn['email']); ?>" :
<?php
if($_SESSION['userid']==$id)
{
?>
<br />
<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
			<a href="edit_profile.php" class="button">Editer mon profile</a>
			</div>

<?php
}
?>
<div id="page-wrapper">
			<div class="main-page">
<table style="width:500px;">
	<tr>
    	<td>
	<img src="upload/users/<?php echo $_SESSION['userid'];?>.jpg" alt="">
</td>
    	<td class="left"><h1><?php echo htmlentities($dnn['email'], ENT_QUOTES, 'UTF-8'); ?></h1>
        Cet utilisateur a rejoint le site le <?php echo $dnn['date_inscription']; ?></td>
    </tr>
</table>
</div>	
<?php
if(isset($_SESSION['email']) and $_SESSION['email']!=$dnn['email'])
{
?>

<br /><a href="new_pm.php?recip=<?php echo urlencode($dnn['email']); ?>" class="big">Envoyer un MP à "<?php echo htmlentities($dnn['email'], ENT_QUOTES, 'UTF-8'); ?>"</a>
</div>
</div>
<?php
}
	}
	else
	{
		echo 'This user doesn\'t exist.';
	}
}
else
{
	echo 'The ID of this user is not defined.';
}
include("html/mainfooter.html");