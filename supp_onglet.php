<?php
//This page let display the list of topics of a category
include('html/mainheader.php');


$recup_question_onglet="SELECT * FROM ordre_question where id_onglet=".$id."";
$result_question_onglet = mysqli_query($link,$recup_question_onglet);
while($temp_question_onglet = mysqli_fetch_array($result_question_onglet))
    {
 $sql_delete_ancienne_question="DELETE FROM ".$temp_question_onglet['type_question']." WHERE id_".$temp_question_onglet['type_question']."=".$temp_question_onglet['id_type']."";
 $result_delete_ancienne_question=mysqli_query($link,$sql_delete_ancienne_question);   
}    
$sql_delete_ancienne_question2="DELETE FROM ordre_question WHERE id_onglet=".$id."";
 mysqli_query($link,$sql_delete_ancienne_question2);     
    
?>

<div id="page-wrapper">
            <div class="main-page">
                <div class="row">
                   <?php
    $supp_onglet_lie="";
    $supp_formulaire="";
    $supp_table_associe="";
    $supp_question="";
         
                   
                   ?>
                    
                    
                    
                    
                </div></div></div>



<?php
include('html/mainfooter.html');
?>