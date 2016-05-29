<?php
//This page displays the list of the forum's categories
include('html/mainheader.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="<?php echo $design; ?>/style.css" rel="stylesheet" title="Style" />
        <title>Forum</title>
    </head>
    
<?php
if(isset($_SESSION['email']))
{
$nb_new_pm = mysqli_fetch_array(mysqli_query($link,'select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['userid'].'" and user1read="no") or (user2="'.$_SESSION['userid'].'" and user2read="no")) and id2="1"'));
$nb_new_pm = $nb_new_pm['nb_new_pm'];
?>

<?php
}
else
{
?>

<?php
}
if(isset($_SESSION['email']) and $_SESSION['email']==$admin)
{
?>
	<a href="new_category.php" class="btn btn-primary">Nouvelle Categorie</a>
<?php
}
?>
<div id="page-wrapper">
            <div class="main-page"><table class="categories_table">
	<tr>
    	<th class="forum_cat">Categorie</th>
        <th class="forum_cat">Description</th>
    	<th class="forum_ntop">Topics</th>
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
$dn1 = mysqli_query($link,'select c.id, c.name, c.description, c.position, (select count(t.id) from topics as t where t.parent=c.id and t.id2=1) as topics, (select count(t2.id) from topics as t2 where t2.parent=c.id and t2.id2!=1) as replies from categories as c group by c.id order by c.position asc');
$nb_cats = mysqli_num_rows($dn1);
while($dnn1 = mysqli_fetch_array($dn1))
{
?>
	<tr>
    	<td class="forum_cat"><a href="list_topics.php?parent=<?php echo $dnn1['id']; ?>" class="title"><?php echo htmlentities($dnn1['name'], ENT_QUOTES, 'UTF-8'); ?></a></td>
        <td><div class="description"><?php echo $dnn1['description']; ?></div></td>
    	<td><?php echo $dnn1['topics']; ?></td>
    	<td><?php echo $dnn1['replies']; ?></td>
<?php
if(isset($_SESSION['email']) and $_SESSION['email']==$admin)
{
?>
    	<td><a href="delete_category.php?id=<?php echo $dnn1['id']; ?>"><span class="glyphicon glyphicon-trash" alt="Delete" </span></a>
		<?php if($dnn1['position']>1){ ?><a href="move_category.php?action=up&id=<?php echo $dnn1['id']; ?>"><span class="glyphicon glyphicon-arrow-up" alt="Move Up" /></a><?php } ?>
		<?php if($dnn1['position']<$nb_cats){ ?><a href="move_category.php?action=down&id=<?php echo $dnn1['id']; ?>"><span class="glyphicon glyphicon-arrow-down" alt="Move Down" /></a><?php } ?>
		<a href="edit_category.php?id=<?php echo $dnn1['id']; ?>"><span class="glyphicon glyphicon-pencil" alt="Edit" /></a></td>
<?php
}
?>
    </tr>
<?php
}
?>
</table>
<?php
if(isset($_SESSION['email']) and $_SESSION['email']==$admin)
{
?>
	<a href="new_category.php" class="btn btn-primary">Nouvelle Categorie</a></div></div>
<?php
}
?>