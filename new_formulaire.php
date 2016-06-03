<?php
//This page let display the list of topics of a category
include('html/mainheader.php');
if(isset($_GET['parent']))
{
$id = intval($_GET['parent']);
if(isset($_POST['formulaire']))
{
	$nom = $_POST['formulaire'];
	if(mysqli_query($link2,'insert into formulaire (nom_formulaire) VALUES ("'.$nom.'")'))
	{
		$dn2 = mysqli_query($link2,'select id_formulaire from formulaire where nom_formulaire = "'.$nom.'"');
		$dnn2 = mysqli_fetch_array($dn2);
		if(mysqli_query($link,'insert into project_formulaire (id_project, id_formulaire) VALUES ("'.$id.'", "'.$dnn2['id_formulaire'].'")'))
		{
			?>
			<div id="page-wrapper">
			<div class="main-page">
				<div class="message">Le formulaire a ete cree.<br />
				</div></div></div>
     <?php include("html/mainfooter.html");?>
				<meta http-equiv="refresh" content="2; URL=list_formulaire.php?parent=<?php echo $id; ?>">
	<?php
		}
	}
}

?>
<div id="page-wrapper">
			<div class="main-page">
<form action="new_formulaire.php?parent=<?php echo $id; ?>" method="post">

	<div>
        <label for="formulaire">Nom du formulaire:</label>
        <input type="text" name="formulaire" />
    </div>

    
    <div class="button">
        <button type="submit">Créer le formulaire</button>
    </div>

 </form>
 <?php
}?>
                        </div>
</div>
                            <?php include("html/mainfooter.html");?>