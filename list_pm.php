<?php
//This page let display the list of personnal message of an user
include("html/mainheader.php");

if(isset($_SESSION['email']))
{

$req1 = $link -> query('select m1.id, m1.title, m1.timestamp, count(m2.id) as reps, users.id as userid, users.email from pm as m1, pm as m2,users where ((m1.user1="'.$_SESSION['userid'].'" and m1.user1read="no" and users.id=m1.user2) or (m1.user2="'.$_SESSION['userid'].'" and m1.user2read="no" and users.id=m1.user1)) and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.id desc');
$req2 = $link -> query('select m1.id, m1.title, m1.timestamp, count(m2.id) as reps, users.id as userid, users.email from pm as m1, pm as m2,users where ((m1.user1="'.$_SESSION['userid'].'" and m1.user1read="yes" and users.id=m1.user2) or (m1.user2="'.$_SESSION['userid'].'" and m1.user2read="yes" and users.id=m1.user1)) and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.id desc');
$req3 = $link -> query('select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['userid'].'" and user1read="no") or (user2="'.$_SESSION['userid'].'" and user2read="no")) and id2="1"');
$nb_new_pm = mysqli_fetch_array($req3);
$nb_new_pm = $nb_new_pm['nb_new_pm'];
?>

<!-- //header-ends -->
        <!-- main content start-->
        <div id="page-wrapper">
            <div class="main-page">

Voici la liste de vos messages:<br />
<a href="new_pm.php" class="button">Nouveau message</a><br />
<h3>Messages non-lus(<?php echo intval(mysqli_num_rows($req1)); ?>):</h3>
<table class="list_pm">
	<tr>
    	<th class="title_cell">Titre</th>
        <th>Nb. Reponses</th>
        <th>Destinataire</th>
        <th>Message envoyé</th>
    </tr>
<?php
while($dn1 = mysqli_fetch_array($req1))
{
?>
	<tr>
    	<td class="left"><a href="read_pm.php?id=<?php echo $dn1['id']; ?>"><?php echo htmlentities($dn1['title'], ENT_QUOTES, 'UTF-8'); ?></a></td>
    	<td><?php echo $dn1['reps']-1; ?></td>
    	<td><a href="profile.php?id=<?php echo $dn1['userid']; ?>"><?php echo htmlentities($dn1['email'], ENT_QUOTES, 'UTF-8'); ?></a></td>
    	<td><?php echo date('d/m/Y H:i:s' ,$dn1['timestamp']); ?></td>
    </tr>
<?php
}
if(intval(mysqli_num_rows($req1))==0)
{
?>
	<tr>
    	<td colspan="4" class="center">Vous n'avez pas de nouveau message.</td>
    </tr>
<?php
}
?>
</table>
<br />
<h3>Messages lus(<?php echo intval(mysqli_num_rows($req2)); ?>):</h3>
<table class="list_pm">
	<tr>
    	<th class="title_cell">Titre</th>
        <th>Nb. Reponses</th>
        <th>Destinataire</th>
        <th>Message envoyé</th>
    </tr>
<?php
while($dn2 = mysqli_fetch_array($req2))
{
?>
	<tr>
    	<td class="left"><a href="read_pm.php?id=<?php echo $dn2['id']; ?>"><?php echo htmlentities($dn2['title'], ENT_QUOTES, 'UTF-8'); ?></a></td>
    	<td><?php echo $dn2['reps']-1; ?></td>
    	<td><a href="profile.php?id=<?php echo $dn2['userid']; ?>"><?php echo htmlentities($dn2['email'], ENT_QUOTES, 'UTF-8'); ?></a></td>
    	<td><?php echo date('d/m/Y H:i:s' ,$dn2['timestamp']); ?></td>
    </tr>
<?php
}
if(intval(mysqli_num_rows($req2))==0)
{
?>
	<tr>
    	<td colspan="4" class="center">VOus n'avez pas de messages lus.</td>
    </tr>
<?php
}
?>
</table>
</div>
</div>
<?php
}
include("html/mainfooter.html");?>