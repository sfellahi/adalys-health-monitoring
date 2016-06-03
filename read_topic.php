<?php
//This page display a topic
include('html/mainheader.php');
if(isset($_GET['id']))
{
	$id = intval($_GET['id']);
	$dn1 = mysqli_fetch_array(mysqli_query($link,'select count(t.id) as nb1, t.title, t.parent, count(t2.id) as nb2, c.name from topics as t, topics as t2, categories as c where t.id="'.$id.'" and t.id2=1 and t2.id="'.$id.'" and c.id=t.parent group by t.id'));
if($dn1['nb1']>0)
{


if(isset($_SESSION['email']))
{
$nb_new_pm = mysqli_fetch_array(mysqli_query($link,'select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['userid'].'" and user1read="no") or (user2="'.$_SESSION['userid'].'" and user2read="no")) and id2="1"'));
$nb_new_pm = $nb_new_pm['nb_new_pm'];

}

?>
<h1><?php echo $dn1['title']; ?></h1>
<?php
if(isset($_SESSION['email']))
{
?>
<div id="page-wrapper">
            <div class="main-page">
	<a href="new_reply.php?id=<?php echo $id; ?>" class="btn btn-success">Répondre</a>
<?php
}
$dn2 = mysqli_query($link,'select t.id2, t.authorid, t.message, t.timestamp, u.email as author from topics as t, users as u where t.id="'.$id.'" and u.id=t.authorid order by t.timestamp asc');
?>
<table class="messages_table">
	<tr>
    	<th class="author">Auteurr</th>
    	<th>Message</th>
	</tr>
<?php
while($dnn2 = mysqli_fetch_array($dn2))
{
?>
	<tr>
    	<td class="author center"><?php
?><br /><a href="profile.php?id=<?php echo $dnn2['authorid']; ?>"><?php echo $dnn2['author']; ?></a></td>
    	<td class="left"><?php if(isset($_SESSION['email']) and ($_SESSION['email']==$dnn2['author'] or $_SESSION['email']==$admin)){ ?><div class="edit"><a href="edit_message.php?id=<?php echo $id; ?>&id2=<?php echo $dnn2['id2']; ?>"><span class="glyphicon glyphicon-pencil" alt="Edit" /></a></div><?php } ?><div class="date">Date sent: <?php echo $dnn2['timestamp']; ?></div>
        <div class="clean"></div>
    	<?php echo $dnn2['message']; ?></td>
    </tr>
<?php
}
?>
</table>
<?php
if(isset($_SESSION['email']))
{
?>
	<a href="new_reply.php?id=<?php echo $id; ?>" class="btn btn-success">Répondre</a></div></div></div>
<?php
}
}
else
{
	echo '<h2>This topic doesn\'t exist.</h2>';
}
}
else
{
	echo '<h2>The ID of this topic is not defined.</h2>';
}
include("html/mainfooter.html");