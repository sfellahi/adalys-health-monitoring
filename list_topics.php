<?php
//This page let display the list of topics of a category
include('html/mainheader.php');
if(isset($_GET['parent']))
{
	$id = intval($_GET['parent']);
	$dn1 = mysqli_fetch_array(mysqli_query($link,'select count(c.id) as nb1, c.name,count(t.id) as topics from categories as c left join topics as t on t.parent="'.$id.'" where c.id="'.$id.'" group by c.id'));
if($dn1['nb1']>0)
{

if(isset($_SESSION['email']))
{
$nb_new_pm = mysqli_fetch_array(mysqli_query($link,'select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['userid'].'" and user1read="no") or (user2="'.$_SESSION['userid'].'" and user2read="no")) and id2="1"'));
$nb_new_pm = $nb_new_pm['nb_new_pm'];
?>

<?php
}

if(isset($_SESSION['email']))
{
?>
<div id="page-wrapper">
            <div class="main-page">
	<!-- <a href="new_topic.php?parent=<?php echo $id; ?>" class="btn btn-primary">Nouveau Topic</a> -->
<?php
}
$dn2 = mysqli_query($link,'select t.id, t.title, t.authorid, u.email as author, count(r.id) as replies from topics as t left join topics as r on r.parent="'.$id.'" and r.id=t.id and r.id2!=1  left join users as u on u.id=t.authorid where t.parent="'.$id.'" and t.id2=1 group by t.id order by t.timestamp2 desc');
if(mysqli_num_rows($dn2)>0)
{
?>
<table class="topics_table">
	<tr>
    	<th class="forum_tops">Topic</th>
    	<th class="forum_auth">Expediteur</th>
    	<th class="forum_nrep">Reponses</th>
<?php
if(isset($_SESSION['email']) and $_SESSION['email']==$admin)
{
?>
    	<th class="forum_act">Action</th>
<?php
}
?>
	</tr>
<?php
while($dnn2 = mysqli_fetch_array($dn2))
{
?>
	<tr>
    	<td class="forum_tops"><a href="read_topic.php?id=<?php echo $dnn2['id']; ?>"><?php echo htmlentities($dnn2['title'], ENT_QUOTES, 'UTF-8'); ?></a></td>
    	<td><a href="profile.php?id=<?php echo $dnn2['authorid']; ?>"><?php echo htmlentities($dnn2['author'], ENT_QUOTES, 'UTF-8'); ?></a></td>
    	<td><?php echo $dnn2['replies']; ?></td>
<?php
if(isset($_SESSION['email']) and $_SESSION['email']==$admin)
{
?>
    	<td><a href="delete_topic.php?id=<?php echo $dnn2['id']; ?>"><span class="glyphicon glyphicon-trash" alt="Delete" /></a></td>
<?php
}
?>
    </tr>
<?php
}
?>
</table>
<?php
}
else
{
?>
<div class="message">This category has no topic.</div>
<?php
}
if(isset($_SESSION['email']))
{
?>
	<a href="new_topic.php?parent=<?php echo $id; ?>" class="btn btn-primary">Nouveau Topic</a></div></div></div>
<?php
}

}
else
{
	echo '<h2>This category doesn\'t exist.</h2>';
}
}
else
{
	echo '<h2>The ID of the category you want to visit is not defined.</h2>';
}
include("html/mainfooter.html");?>