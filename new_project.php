 <?php
//This page displays the list of the forum's categories
include('html/mainheader.php');

if(isset($_POST['projet']))
{
	$projet = $_POST['projet'];
	$date = date("Y-m-d");
	if(get_magic_quotes_gpc())
	{
		$projet = stripslashes($projet);
	}
	$projet = mysqli_real_escape_string($link,$projet);
	if(mysqli_query($link,'insert into projects (nom_project, date_debut) VALUES ("'.$projet.'", "'.$date.'")'))
	{
		?>
	<div id="page-wrapper">
			<div class="main-page">
				<div class="message">Le projet a ete cree.<br />
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
<form action="new_project.php" method="post">

	<div>
        <label for="projet">Nom du projet:</label>
        <input type="text" name="projet" />
    </div>

    
    <div class="button">
        <button type="submit">Créer le projet</button>
    </div>

 </form>
 <?php
 }?>
                        </div>
</div>
                                     <?php include("html/mainfooter.html");?>