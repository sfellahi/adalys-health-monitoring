<?php
//This page let display the list of topics of a category
include('html/mainheader.php');
if(isset($_POST['parent'])){
    $id=$_POST['parent'];
}
$recup_nb_form_onglet="SELECT formulaire.id_formulaire,project_formulaire.id_project,onglet.id_onglet FROM onglet LEFT JOIN formulaire ON formulaire.id_formulaire=onglet.id_formulaire LEFT JOIN project_formulaire ON formulaire.id_formulaire=project_formulaire.id_formulaire where id_onglet=".$id."";
$result_nb = mysqli_query($link,$recup_nb_form_onglet);
$temp_nb= mysqli_fetch_array($result_nb);
$recup_question_onglet="SELECT * FROM ordre_question where id_onglet=".$id."";
$result_question_onglet = mysqli_query($link,$recup_question_onglet);
while($temp_question_onglet = mysqli_fetch_array($result_question_onglet))
    {
 $sql_delete_ancienne_question="DELETE FROM ".$temp_question_onglet['type_question']." WHERE id_".$temp_question_onglet['type_question']."=".$temp_question_onglet['id_type']."";
 $result_delete_ancienne_question=mysqli_query($link,$sql_delete_ancienne_question);   
}    
$sql_delete_ancienne_question2="DELETE FROM ordre_question WHERE id_onglet=".$id."";
 mysqli_query($link,$sql_delete_ancienne_question2); 
 
 $sql_delete_onglet="DELETE FROM onglet WHERE id_onglet=".$id."";
 mysqli_query($link, $sql_delete_onglet);

$nom_table="donneeprojet".$temp_nb['id_project']."formulaire".$temp_nb['id_formulaire'];
     echo   $sql_supprimer="DROP TABLE IF EXISTS `".$nom_table."`;";
       mysqli_query($link, $sql_supprimer);
   
       $sql_name_table_formulaire="SELECT colonne_assoc FROM ordre_question WHERE id_formulaire=".$temp_nb['id_formulaire']."";
       $result_table_formulaire=  mysqli_query($link, $sql_name_table_formulaire);
       
        $create_table="CREATE TABLE donneeprojet".$temp_nb['id_project']."formulaire".$temp_nb['id_formulaire']." (id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,";
        while($temp_name=  mysqli_fetch_array($result_table_formulaire)){
            
         $create_table.="`".$temp_name['colonne_assoc']."` VARCHAR (255),";   
            
        }
        $create_table.="time_modification TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP";
        $create_table.=")";
        echo $create_table;
        mysqli_query($link, $create_table);
?>

<div id="page-wrapper">
            <div class="main-page">
                <div class="row">
                   <?php           
                   ?>
                    
                    
                    
                    
                </div></div></div>



<?php
include('html/mainfooter.html');
?>