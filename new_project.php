 <?php
 // Cacher les warnings
 ini_set("display_errors",0);error_reporting(0);
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
          mysqli_set_charset($link, "utf8");
        echo $insert_new_project="INSERT INTO projects (nom_project, date_debut,date_fin,nombre_patient,etat_project) VALUES ('".$projet."', '".$date."',NULL,'0','En création')";
 	if(mysqli_query($link,$insert_new_project))
 	{
 		?>
 		<div id="page-wrapper">
 			<div class="main-page">
 				<div class="row">
 					<div class="flat-table" style="margin:0 auto;margin-top:15%;width:18%;height:200px">
 						<div class="message" style="text-align:center ; font-weight:600;font-size:16px">Le projet est en cours de création.<br /><br />
 							<div class="showbox">
 								<div class="loader">
 									<svg class="circular" viewBox="25 25 50 50">
 										<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
 									</svg>
 								</div>
 							</div>
 						</div>
 					</div>
 				</div>
 			</div>
 		</div>
 		<?php include("html/mainfooter.html");?>
 		<meta http-equiv="refresh" content="2; URL=list_project.php">
 		<?php
 	}
        else{
            
            ?>un pb rencontrer<?php
        }
 }
 else {


 	?>
 	<div id="page-wrapper">
 		<div class="main-page">
 			<div class="row">
 				<div class="flat-table" style="margin:0 auto;margin-top:15%;width:15%;height:150px">

 					<form action="new_project.php" method="post">

 						<div style="text-align:center">
 							<br />
 							<label for="projet" style="font-weight:600;font-size:16px" >Nom du projet:</label>
 							<input type="text" required name="projet" />
 						</div>


 						<div style="text-align:center">
 							<br />
 							<input  class="button" value="Créer le projet" type="submit"> 
 						</div>

 					</form>
 				</div> 
                        </div>
 		</div>
 	</div>
 				<?php	} include("html/mainfooter.html");?>