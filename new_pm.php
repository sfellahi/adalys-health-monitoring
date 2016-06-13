<?php
//This page let display the list of personnal message of an user
include("html/mainheader.php");

if(isset($_SESSION['email']))
{
$form = true;
$otitle = '';
$orecip = '';
$omessage = '';
if(isset($_POST['title'], $_POST['recip'], $_POST['message']))
{
	$otitle = $_POST['title'];
	$orecip = $_POST['recip'];
	$omessage = $_POST['message'];
	if(get_magic_quotes_gpc())
	{
		$otitle = stripslashes($otitle);
		$orecip = stripslashes($orecip);
		$omessage = stripslashes($omessage);
	}
	if($_POST['title']!='' and $_POST['recip']!='' and $_POST['message']!='')
	{
		$title = mysqli_real_escape_string($link,$otitle);
		$recip = mysqli_real_escape_string($link,$orecip);
		$message = mysqli_real_escape_string($link,nl2br(htmlentities($omessage, ENT_QUOTES, 'UTF-8')));
		$req = $link -> query('select count(id) as recip, id as recipid, (select count(*) from pm) as npm from users where email="'.$recip.'"');
		$dn1 = mysqli_fetch_array($req);
		if($dn1['recip']==1)
		{
			if($dn1['recipid']!=$_SESSION['userid'])
			{
				$id = $dn1['npm']+1;
				$req2 = $link -> query('insert into pm (id, id2, title, user1, user2, message, timestamp, user1read, user2read)values("'.$id.'", "1", "'.$title.'", "'.$_SESSION['userid'].'", "'.$dn1['recipid'].'", "'.$message.'", "'.time().'", "yes", "no")');
				if($req2)
				{
	?>
	<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
Le message a ete envoye.<br />
	<a href="list_pm.php">Liste de vos messages</a></div></div>
	<?php
					$form = false;
				}
				else
				{
					$error = 'An error occurred while sending the PM.';
				}
			}
			else
			{
				$error = 'You cannot send a PM to yourself.';
			}
		}
		else
		{
			$error = 'The recipient of your PM doesn\'t exist.';
		}
	}
	else
	{
		$error = 'A field is not filled.';
	}
}
elseif(isset($_GET['recip']))
{
	$orecip = $_GET['recip'];
}
if($form)
{
if(isset($error))
{
	echo '<div class="message">'.$error.'</div>';
}
?>
<!-- //header-ends -->
		<!-- main content start-->
		

<?php
$req3 = $link -> query('select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['userid'].'" and user1read="no") or (user2="'.$_SESSION['userid'].'" and user2read="no")) and id2="1"');
$nb_new_pm = mysqli_fetch_array($req3);
$nb_new_pm = $nb_new_pm['nb_new_pm'];
?>

<div class="container">
    <form action="new_pm.php" method="post">
    <div id="page-wrapper">
			<div class="main-page">
			<h1>Nouveau message</h1><br>
			<div class="form-group">
		Merci de completer le message:<br />
        Titre<input class="form-control" type="text" value="<?php echo htmlentities($otitle, ENT_QUOTES, 'UTF-8'); ?>" id="title" name="title" /><br />
        Destinataire<span class="small">(Email)</span><input class="form-control" type="text" value="<?php echo htmlentities($orecip, ENT_QUOTES, 'UTF-8'); ?>" id="recip" name="recip" /><br />
        Message<textarea class="form-control" cols="40" rows="5" id="message" name="message"><?php echo htmlentities($omessage, ENT_QUOTES, 'UTF-8'); ?></textarea><br />
        <input class="btn btn-default btn-file" type="submit" value="Envoyer" />
        </div>
    </form>
</div>
<?php
}
}
else
{
?>
<div class="message">You must be logged to access this page.</div>
<?php
}
include("html/mainfooter.html");?>