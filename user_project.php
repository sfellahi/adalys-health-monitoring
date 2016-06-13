<?php
//This page let display the list of topics of a category
include('html/mainheader.php');
if(isset($_GET['parent']))
{
	$id = intval($_GET['parent']);
	if(isset($_POST['id_medecin']))
	{
	$id_medecin = $_POST['id_medecin'];
	
	$result = mysqli_num_rows(mysqli_query($link,'SELECT id_project_user FROM project_user WHERE id_user="'.$id_medecin.'" and id_project="'.$id.'" and user_read="no"'));
	
	if($result == 0) {
		
		$result2 = mysqli_num_rows(mysqli_query($link,'SELECT id_project_user FROM project_user WHERE id_user="'.$id_medecin.'" and id_project="'.$id.'" and user_read="yes" and user_accept ="yes"'));
		if($result2 == 0) {
		
		if(mysqli_query($link,'insert into project_user (id_project, id_user, user_read) VALUES ("'.$id.'", "'.$id_medecin.'", "no")'))
		{
			?>
					<div id="page-wrapper">
					<div class="main-page">
						<div class="message">La demande d'association du projet a été soumise au médecin.<br />
						</div></div></div>
		     <?php include("html/mainfooter.html");?>
						<meta http-equiv="refresh" content="2; URL=list_project.php">
			<?php
			}
		}
		else {
			?>
			<div id="page-wrapper">
			<div class="main-page">
			<div class="message">Le médecin a déjà accepté le projet.<br />
		</div></div></div>
		<?php 
		}
	} 
	else {
		?>
		<div id="page-wrapper">
		<div class="main-page">
		<div class="message">Le médecin est déjà en attente d'association.<br />
		</div></div></div>
		<?php
			}
		}
}
include("html/mainfooter.html");?>