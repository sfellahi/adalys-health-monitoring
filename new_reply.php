<?php
//This page let reply to a topic
include('html/mainheader.php');
if(isset($_GET['id']))
{
	$id = intval($_GET['id']);
if(isset($_SESSION['email']))
{
	$dn1 = mysqli_fetch_array(mysqli_query($link,'select count(t.id) as nb1, t.title, t.parent, c.name from topics as t, categories as c where t.id="'.$id.'" and t.id2=1 and c.id=t.parent group by t.id'));
if($dn1['nb1']>0)
{

$nb_new_pm = mysqli_fetch_array(mysqli_query($link,'select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['userid'].'" and user1read="no") or (user2="'.$_SESSION['userid'].'" and user2read="no")) and id2="1"'));
$nb_new_pm = $nb_new_pm['nb_new_pm'];

if(isset($_POST['message']) and $_POST['message']!='')
{
	include('bbcode_function.php');
	$message = $_POST['message'];
	if(get_magic_quotes_gpc())
	{
		$message = stripslashes($message);
	}
	$message = mysqli_real_escape_string($link,bbcode_to_html($message));
	if(mysqli_query($link,'insert into topics (parent, id, id2, title, message, authorid, timestamp, timestamp2) select "'.$dn1['parent'].'", "'.$id.'", max(id2)+1, "", "'.$message.'", "'.$_SESSION['userid'].'", "'.time().'", "'.time().'" from topics where id="'.$id.'"') and mysqli_query($link,'update topics set timestamp2="'.time().'" where id="'.$id.'" and id2=1'))
	{
	?>
	<div id="page-wrapper">
			<div class="main-page">
	<div class="message">Le message a été envoyé.<br />
	<a href="read_topic.php?id=<?php echo $id; ?>">Go to the topic</a></div></div></div>
	<?php
	}
	else
	{
		echo 'An error occurred while sending the message.';
	}
}
else
{
?>
	<div class="container">
<form action="new_reply.php?id=<?php echo $id; ?>" method="post">
<div id="page-wrapper">
			<div class="main-page">
			<div class="form-group">
    <label for="message">Votre réponse</label><br />
    <div class="message_buttons">
        <input type="button" value="Bold" onclick="javascript:insert('[b]', '[/b]', 'message');" /><!--
        --><input type="button" value="Italic" onclick="javascript:insert('[i]', '[/i]', 'message');" /><!--
        --><input type="button" value="Underlined" onclick="javascript:insert('[u]', '[/u]', 'message');" /><!--
        --><input type="button" value="Image" onclick="javascript:insert('[img]', '[/img]', 'message');" /><!--
        --><input type="button" value="Link" onclick="javascript:insert('[url]', '[/url]', 'message');" /><!--
        --><input type="button" value="Left" onclick="javascript:insert('[left]', '[/left]', 'message');" /><!--
        --><input type="button" value="Center" onclick="javascript:insert('[center]', '[/center]', 'message');" /><!--
        --><input type="button" value="Right" onclick="javascript:insert('[right]', '[/right]', 'message');" />
    </div>
    <textarea name="message" id="message" cols="70" rows="6"></textarea><br />
    </div>
    <input type="submit" class="btn btn-default btn-file" value="Envoyer" />
</form>
</div></div></div>
<?php
}

}
else
{
	echo '<h2>The topic you want to reply doesn\'t exist.</h2>';
}
}

}
else
{
	echo '<h2>The ID of the topic you want to reply is not defined.</h2>';
}
include("html/mainfooter.html");?>