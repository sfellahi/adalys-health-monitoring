<?php
//This page let users create new topics
include('html/mainheader.php');
if(isset($_GET['parent']))
{
	$id = intval($_GET['parent']);
if(isset($_SESSION['email']))
{
	$dn1 = mysqli_fetch_array(mysqli_query($link,'select count(c.id) as nb1, c.name from categories as c where c.id="'.$id.'"'));
if($dn1['nb1']>0)
{

$nb_new_pm = mysqli_fetch_array(mysqli_query($link,'select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['userid'].'" and user1read="no") or (user2="'.$_SESSION['userid'].'" and user2read="no")) and id2="1"'));
$nb_new_pm = $nb_new_pm['nb_new_pm'];

if(isset($_POST['message'], $_POST['title']) and $_POST['message']!='' and $_POST['title']!='')
{
	include('bbcode_function.php');
	$title = $_POST['title'];
	$message = $_POST['message'];
	if(get_magic_quotes_gpc())
	{
		$title = stripslashes($title);
		$message = stripslashes($message);
	}
	$title = mysqli_real_escape_string($link,$title);
	$message = mysqli_real_escape_string($link,bbcode_to_html($message));
	if(mysqli_query($link,'insert into topics (parent, id, id2, title, message, authorid, timestamp, timestamp2) select "'.$id.'", ifnull(max(id), 0)+1, "1", "'.$title.'", "'.$message.'", "'.$_SESSION['userid'].'", "'.time().'", "'.time().'" from topics'))
	{
	?>
	<div id="page-wrapper">
			<div class="main-page">
	<div class="message">The topic have successfully been created.<br />
	<a href="list_topics.php?parent=<?php echo $id; ?>">Go to the forum</a></div></div></div></div>
	<?php
	}
	else
	{
		echo 'An error occurred while creating the topic.';
	}
}
else
{
?>
<div id="page-wrapper">
			<div class="main-page">
<form action="new_topic.php?parent=<?php echo $id; ?>" method="post">
	<label for="title">Title</label><input type="text" name="title" id="title"  /><br />
    <label for="message">Message</label><br />
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
    <input type="submit" value="Send" />
</div></div>
</form>
<?php
}
?>

<?php
}
else
{
	echo '<h2>The category you want to add a topic doesn\'t exist.</h2>';
}
}
}
else
{
	echo '<h2>The ID of the category you want to add a topic is not defined.</h2>';
}
?>