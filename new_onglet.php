<?php
//This page let display the list of topics of a category
include('html/mainheader.php');
if(isset($_POST['parent']))
{
$id = intval($_POST['parent']);
if(isset($_POST['onglet']))
{
	$onglet = $_POST['onglet'];
	if(mysqli_query($link2,'insert into onglet (nom_onglet, id_formulaire) VALUES ("'.$onglet.'", "'.$id.'")'))
	{
		
			?>
			<div id="page-wrapper">
			<div class="main-page">
				<div class="message">L'onglet a été crée.<br />
				</div></div></div>
     <?php include("html/mainfooter.html");?>
				<meta http-equiv="refresh" content="2; URL=list_onglet.php?parent=<?php echo $id; ?>">
	<?php
		
	}
}

?>
<div id="page-wrapper">
			<div class="main-page">
<form action="new_onglet.php?parent=<?php echo $id; ?>" method="post">

	<div>
        <label for="formulaire">Nom de l'onglet</label>
        <input type="text" name="onglet" />
    </div>

    
    <div class="button">
        <button type="submit">Créer l'onglet</button>
    </div>

 </form>
 <?php
}?>
                        </div>
</div>
                            <?php include("html/mainfooter.html");?>