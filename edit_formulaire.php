<?php
//This page let display the list of topics of a category
include('html/mainheader.php');
if(isset($_GET['parent']))
{
	$id=$_GET['parent'];
	$dn1 = mysqli_query($link,'select id_formulaire from project_formulaire where id_project = "'.$id.'"');
	?>
	<div id="page-wrapper">
            <div class="main-page">
	<table class="topics_table">
	<tr>
    	<th class="forum_tops">Formulaire</th>
	</tr>
    	<?php
    while($dnn1 = mysqli_fetch_array($dn1)){
    $dn2 = mysqli_query($link2,'select nom_formulaire from formulaire where id_formulaire = "'.$dnn1['id_formulaire'].'"');	
    $dnn2 = mysqli_fetch_array($dn2);
    ?>
    <tr>
    	<td><a href="edit_formulaire.php?id=<?php echo $dnn1['id_formulaire']; ?>"><?php echo $dnn2['nom_formulaire']; ?></td>
    </tr>
    <?php
    }
    ?>
	</table>
	<a href="edit_formulaire.php?parent=<?php echo $id; ?>" class="btn btn-primary">Nouveau Formulaire</a></div></div>
<?php
}
include("html/mainfooter.html");?>