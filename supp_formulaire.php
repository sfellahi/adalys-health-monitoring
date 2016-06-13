<meta http-equiv="refresh" content="2; URL=list_project.php">
<?php
//This page let display the list of topics of a category
include('html/mainheader.php');
if(isset($_POST['parent'])){
    $id=$_POST['parent'];
}



$recup_nb_projet_onglet="SELECT project_formulaire.id_project FROM project_formulaire where id_formulaire=".$id."";
$result_nb = mysqli_query($link,$recup_nb_projet_onglet);
$temp_nb= mysqli_fetch_array($result_nb);
$id_project=$temp_nb['id_project'];


$select_onglet_pour_supp="SELECT id_onglet FROM onglet WHERE id_formulaire=".$id."";
$result_onglet_for_supp=mysqli_query($link, $select_onglet_pour_supp);
while($temp_onglet=  mysqli_fetch_array($result_onglet_for_supp)){

$recup_question_onglet="SELECT * FROM ordre_question where id_onglet=".$temp_onglet['id_onglet']."";
$result_question_onglet = mysqli_query($link,$recup_question_onglet);
// Supp des question de l'onglet 
while($temp_question_onglet = mysqli_fetch_array($result_question_onglet))
    {
 $sql_delete_ancienne_question="DELETE FROM ".$temp_question_onglet['type_question']." WHERE id_".$temp_question_onglet['type_question']."=".$temp_question_onglet['id_type']."";
 $result_delete_ancienne_question=mysqli_query($link,$sql_delete_ancienne_question);   
}    
$sql_delete_ancienne_question2="DELETE FROM ordre_question WHERE id_onglet=".$temp_onglet['id_onglet']."";
 mysqli_query($link,$sql_delete_ancienne_question2); 
 
 $sql_delete_onglet="DELETE FROM onglet WHERE id_onglet=".$temp_onglet['id_onglet']."";
 mysqli_query($link, $sql_delete_onglet);
}
$supp_project_formulaire="DELETE FROM project_formulaire WHERE id_formulaire=".$id;
mysqli_query($link, $supp_project_formulaire);

$supp_formulaire_last="DELETE FROM formulaire WHERE id_formulaire=".$id;
mysqli_query($link, $supp_formulaire_last);

$nom_table="donneeprojet".$temp_nb['id_project']."formulaire".$id;
     echo   $sql_supprimer="DROP TABLE IF EXISTS `".$nom_table."`;";
       mysqli_query($link, $sql_supprimer);
   
 /*      $sql_name_table_formulaire="SELECT colonne_assoc FROM ordre_question WHERE id_formulaire=".$temp_nb['id_formulaire']."";
       $result_table_formulaire=  mysqli_query($link, $sql_name_table_formulaire);
       
        $create_table="CREATE TABLE donneeprojet".$temp_nb['id_project']."formulaire".$temp_nb['id_formulaire']." (id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,";
        while($temp_name=  mysqli_fetch_array($result_table_formulaire)){
            
         $create_table.="`".$temp_name['colonne_assoc']."` VARCHAR (255),";   
            
        }
        $create_table.="time_modification TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP";
        $create_table.=")";
        echo $create_table;
        mysqli_query($link, $create_table);*/
?>

<div id="page-wrapper">
					<div class="main-page">
						<div class="row">
							<div class="flat-table" style="margin:0 auto;margin-top:15%;width:18%;height:200px">
								<div class="message" style="text-align:center ; font-weight:600;font-size:16px">Le formulaire est en cours de suppression <br /><br />
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



<?php
include('html/mainfooter.html');
?>