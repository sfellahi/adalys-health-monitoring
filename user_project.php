<?php
//This page let display the list of topics of a category
include('html/mainheader.php');
if(isset($_GET['parent']))
{
$id = intval($_GET['parent']);
if(isset($_POST['medecin']))
{
	$medecin = $_POST['medecin'];
	if(mysqli_query($link,'insert into project_user (id_project, id_user, user_read) VALUES ("'.$id.'", "'.$medecin.'", "no")'))
	{
			?>
			<div id="page-wrapper">
			<div class="main-page">
				<div class="message">Le medecin est lié au projet.<br />
				</div></div></div>
     <?php include("html/mainfooter.html");?>
				<meta http-equiv="refresh" content="2; URL=list_project.php?parent=<?php echo $id; ?>">
	<?php
		}
	}
}
include("html/mainfooter.html");?>