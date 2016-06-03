<?php
//This page let display the list of topics of a category
include('html/mainheader.php');
if(isset($_GET['parent']))
{
$id = intval($_GET['parent']);
if(isset($_POST['etat']))
{
	$etat = $_POST['etat'];
	if(mysqli_query($link,'UPDATE projects set etat_project = "'.$etat.'" WHERE id_project ="'.$id.'"'))
	{
			?>
			<div id="page-wrapper">
			<div class="main-page">
				<?php echo $etat; ?>
				<div class="message">L'etat a ete modifié.<br />
				</div></div></div>
     <?php include("html/mainfooter.html");?>
				<meta http-equiv="refresh" content="1; URL=list_project.php">
	<?php
		}
	}
}