<?php

//This page let display the list of topics of a category
include('html/mainheader.php');
if(isset($_GET['parent']))
{
	$id = intval($_GET['parent']);
	if(isset($_POST['formulaire']))
	{
		$nom = $_POST['formulaire'];
                  mysqli_set_charset($link, "utf8");
               $insert_formulaire="insert into formulaire (nom_formulaire,etat_formulaire) VALUES ('".$nom."','En création')";
		if(mysqli_query($link2,$insert_formulaire))
		{
			$dn2 = mysqli_query($link,'select id_formulaire from formulaire where nom_formulaire = "'.$nom.'"');
			$dnn2 = mysqli_fetch_array($dn2);
			if(mysqli_query($link,'insert into project_formulaire (id_project, id_formulaire) VALUES ("'.$id.'", "'.$dnn2['id_formulaire'].'")'))

			{
                            
                            $create_onglet_init="INSERT INTO `onglet` (`id_formulaire`, `nom_onglet`) VALUES ('".$dnn2['id_formulaire']."', 'Initialisation')";
                            mysqli_query($link, $create_onglet_init);
                            
                            
                            // Recuperation dernier onglet
                            
                               $result_onglet = mysqli_query($link,'select max(id_onglet) as maxi from onglet');
                                $dernier_onglet = mysqli_fetch_array($result_onglet);
                         
                                
                                // Ajout nom 
                            $insert_question1_init_text="INSERT INTO `text` (`id_text`, `question`, `reponse_text`) VALUES (NULL, 'Nom du patient :', 'text')";
                            mysqli_query($link, $insert_question1_init_text);
                            
                         
                               $result_text1 = mysqli_query($link,'select max(id_text) as maxi1 from text');
                                $dernier_text1 = mysqli_fetch_array($result_text1);
                         
                           $insert_question1_init_ordre_question="INSERT INTO `ordre_question` (`type_question`, `id_type`, `colonne_assoc`, `qrequired`, `id_formulaire`, `id_onglet`)";
                           echo   $insert_question1_init_ordre_question.="VALUES ('text', '".$dernier_text1['maxi1']."', 'nom', 'oui','".$dnn2['id_formulaire']."', '".$dernier_onglet['maxi']."')";
                            mysqli_query($link, $insert_question1_init_ordre_question);
                            
                              // Ajout prenom      
                            $insert_question2_init_text="INSERT INTO `text` (`question`, `reponse_text`) VALUES ('Prenom du patient :', 'text')";
                            mysqli_query($link, $insert_question2_init_text);
                            
                         
                               $result_text2 = mysqli_query($link,'select max(id_text) as maxi2 from text');
                                $dernier_text2 = mysqli_fetch_array($result_text2);
                         
                           $insert_question1_init_ordre_question="INSERT INTO `ordre_question` (`type_question`, `id_type`, `colonne_assoc`, `qrequired`, `id_formulaire`, `id_onglet`)";
                           echo   $insert_question1_init_ordre_question.="VALUES ('text', '".$dernier_text2['maxi2']."', 'nom', 'oui','".$dnn2['id_formulaire']."', '".$dernier_onglet['maxi']."')";
                            mysqli_query($link, $insert_question1_init_ordre_question);
                            
                            // Ajout adresse 
                            
                                 $insert_question3_init_text="INSERT INTO `text` (`question`, `reponse_text`) VALUES ('Adresse du patient :', 'text')";
                            mysqli_query($link, $insert_question3_init_text);
                            
                         
                               $result_text3 = mysqli_query($link,'select max(id_text) as maxi3 from text');
                                $dernier_text3 = mysqli_fetch_array($result_text3);
                         
                           $insert_question1_init_ordre_question="INSERT INTO `ordre_question` (`type_question`, `id_type`, `colonne_assoc`, `qrequired`, `id_formulaire`, `id_onglet`)";
                           echo   $insert_question1_init_ordre_question.="VALUES ('text', '".$dernier_text3['maxi3']."', 'nom', 'oui','".$dnn2['id_formulaire']."', '".$dernier_onglet['maxi']."')";
                            mysqli_query($link, $insert_question1_init_ordre_question);
                            
                            
                            
                            
				echo $sql_create_table_formulaire="CREATE TABLE donneeprojet".$id."formulaire".$dnn2['id_formulaire']." (id INT PRIMARY KEY NOT NULL,nom VARCHAR(255) CHARSET UTF8)";
				mysqli_query($link,$sql_create_table_formulaire);
				?>
				<div id="page-wrapper">
					<div class="main-page">
						<div class="row">
							<div class="flat-table" style="margin:0 auto;margin-top:15%;width:18%;height:200px">
								<div class="message" style="text-align:center ; font-weight:600;font-size:16px">Le formulaire est en cours de création <br /><br />
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
				<meta http-equiv="refresh" content="4; URL=list_project.php">
				<?php
			}
                }
	}

	?>
	<div id="page-wrapper">
		<div class="main-page">
			<div class="row">
				<div class="flat-table" style="margin:0 auto;margin-top:15%;width:15%;height:150px">
					
					<form action="new_formulaire.php?parent=<?php echo $id; ?>" method="post">
						<input type="hidden" value="<?php echo $id; ?>" name="parent">
						<div style="text-align:center">
							<label for="formulaire" style="font-weight:600;font-size:16px">Nom du formulaire:</label>
							<br />
							<input type="text" name="formulaire" />
						</div>


						<div style="text-align:center">
							<br />
							<button class="button" type="submit">Créer le formulaire</button>
						</div>

					</form>
<?php } ?>
				</div>
			</div>
		</div>
	</div>
		<?php include("html/mainfooter.html");?>