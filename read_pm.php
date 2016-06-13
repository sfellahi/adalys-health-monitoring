<?php
//This page display a personnal message
include("html/mainheader.php");

if(isset($_SESSION['email']))
{
if(isset($_GET['id']))
{
$id = intval($_GET['id']);
$req1=$link->query('select title, user1, user2 from pm where id="'.$id.'" and id2="1"');
$dn1 = mysqli_fetch_array($req1);
if(mysqli_num_rows($req1)==1)
{
if($dn1['user1']==$_SESSION['userid'] or $dn1['user2']==$_SESSION['userid'])
{
if($dn1['user1']==$_SESSION['userid'])
{
	$link->query('update pm set user1read="yes" where id="'.$id.'" and id2="1"');
	$user_partic = 2;
}
else
{
	$link->query('update pm set user2read="yes" where id="'.$id.'" and id2="1"');
	$user_partic = 1;
}
$req2=$link->query('select pm.timestamp, pm.message, users.id as userid, users.email from pm, users where pm.id="'.$id.'" and users.id=pm.user1 order by pm.id2');
if(isset($_POST['message']) and $_POST['message']!='')
{
	$message = $_POST['message'];
	if(get_magic_quotes_gpc())
	{
		$message = stripslashes($message);
	}
	$message = mysqli_real_escape_string($link,nl2br(htmlentities($message, ENT_QUOTES, 'UTF-8')));
	if($link->query('insert into pm (id, id2, title, user1, user2, message, timestamp, user1read, user2read)values("'.$id.'", "'.(intval(mysqli_num_rows($req2))+1).'", "", "'.$_SESSION['userid'].'", "", "'.$message.'", "'.time().'", "", "")') and $link->query('update pm set user'.$user_partic.'read="yes" where id="'.$id.'" and id2="1"'))
	{
?>
<div id="page-wrapper">
			<div class="main-page">
<div class="message">Your reply has successfully been sent.<br />
<a href="read_pm.php?id=<?php echo $id; ?>">Go to the PM</a></div></div></div>
<?php
	}
	else
	{
?>
<div id="page-wrapper">
			<div class="main-page">
<div class="message">An error occurred while sending the reply.<br />
<a href="read_pm.php?id=<?php echo $id; ?>">Go to the PM</a></div></div></div>
<?php
	}
}
else
{
?>
<div class="content">
<?php
if(isset($_SESSION['email']))
{
$nb_new_pm = mysqli_fetch_array($link->query('select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['userid'].'" and user1read="no") or (user2="'.$_SESSION['userid'].'" and user2read="no")) and id2="1"'));
$nb_new_pm = $nb_new_pm['nb_new_pm'];
}
?>
<div id="page-wrapper">
			<div class="main-page">
<h1><?php echo $dn1['title']; ?></h1>
<table class="messages_table">
	<tr>
    	<th class="author">Utilisateur</th>
        <th>Message</th>
    </tr>
<?php
while($dn2 = mysqli_fetch_array($req2))
{
?>
	<tr>
    	<td class="author center"><br /><a href="profile.php?id=<?php echo $dn2['userid']; ?>"><?php echo $dn2['email']; ?></a></td>
    	<td class="left"><div class="date">Date sent: <?php echo date('Y/m/d H:i:s' ,$dn2['timestamp']); ?></div>
    	<?php echo $dn2['message']; ?></td>
    </tr>
<?php
}
?>
</table><br />
<h2>Réponse</h2>
<div class="center">
    <form action="read_pm.php?id=<?php echo $id; ?>" method="post">
    	<label for="message" class="center">Message</label><br />
        <textarea cols="40" rows="5" name="message" id="message"></textarea><br />
        <input class="btn btn-default btn-file" type="submit" value="Envoyer" />
    </form>
</div>
</div>
</div>
<?php
}
}
else
{
	echo '<div class="message">You don\'t have the right to access this page.</div>';
}
}
else
{
	echo '<div class="message">This message doesn\'t exist.</div>';
}
}
else
{
	echo '<div class="message">The ID of this message is not defined.</div>';
}
}
include("html/mainfooter.html");