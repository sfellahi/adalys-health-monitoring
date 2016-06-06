<?php
//This page let display the list of topics of a category
include('html/mainheader.php');

?>
<div id="page-wrapper">
			<div class="main-page">
                            <?php
if(isset($_POST['parentprojet']))
{
$id = intval($_POST['parentprojet']);
if(isset($_POST['etat']))
{
	$etat = $_POST['etat'];
	if(mysqli_query($link,'UPDATE projects set etat_project = "'.$etat.'" WHERE id_project ="'.$id.'"'))
	{
			?>
			
				<div class="message">L'etat a ete modifié.<br />
				</div>
				<meta http-equiv="refresh" content="1; URL=list_project.php">
	<?php
		}
	}
}
else if(isset($_POST['parentformulaire'])){ 
 $id = intval($_POST['parentformulaire']);
if(isset($_POST['etat']))
{
	$etat = $_POST['etat'];
	if(mysqli_query($link,'UPDATE formulaire set etat_formulaire = "'.$etat.'" WHERE id_formulaire ="'.$id.'"'))
	{
			?>
			
				<div class="message">L'etat a ete modifié.<br />
				</div>
				<meta http-equiv="refresh" content="1; URL=list_formulaire.php?parent=<?php echo $id;?>">
	<?php
		}
	}   
    
    
    
}?> 
                                </div></div>
     <?php include("html/mainfooter.html");?>