 <?php
//This page displays the list of the forum's categories
include('html/mainheader.php');

$id=$_POST['id'];


$dn2 = mysqli_query($link,'select onglet.id_formulaire,id_project from onglet LEFT JOIN project_formulaire ON project_formulaire.id_formulaire=onglet.id_formulaire  where id_onglet= "'.$id.'"');
$dnn2 = mysqli_fetch_array($dn2);


$str = $_POST['value1'];
if(empty($str)){
    ?>
             <div id="page-wrapper">
                <div class="main-page">
                Aucune modification n'a été réalisé
            </div></div>
<?php
}
else{
    

$recup_question_onglet="SELECT * FROM ordre_question where id_onglet=".$id."";
$result_question_onglet = mysqli_query($link,$recup_question_onglet);
while($temp_question_onglet = mysqli_fetch_array($result_question_onglet))
    {
 $sql_delete_ancienne_question="DELETE FROM ".$temp_question_onglet['type_question']." WHERE id_".$temp_question_onglet['type_question']."=".$temp_question_onglet['id_type']."";
 $result_delete_ancienne_question=mysqli_query($link,$sql_delete_ancienne_question);   
}    
$sql_delete_ancienne_question2="DELETE FROM ordre_question WHERE id_onglet=".$id."";
 mysqli_query($link,$sql_delete_ancienne_question2);     
    
    
$pieces = explode(",", $str);
$nb = count($pieces)-5;
$i = 0;
$name=array();
while ($i <= $nb ) {
    if($pieces[$i] == "text"){
    	mysqli_query($link2,'insert into text (question, reponse_text) VALUES ("'.$pieces[$i+2].'","'.$pieces[$i].'")');
        $result = mysqli_query($link2,'select max(id_text) as maxi from text');
        $row = mysqli_fetch_array($result);
        if (!mysqli_query($link2,'insert into ordre_question (type_question, id_type, colonne_assoc, id_onglet, id_formulaire) VALUES ("'.$pieces[$i].'","'.$row["maxi"].'","'.$pieces[$i+1].'","'.$id.'","'.$dnn2['id_formulaire'].'")'))
        {
            ?>
            <div id="page-wrapper">
                <div class="main-page">
                An error occured while creating the forms
            </div></div>

            <?php
            include("html/mainfooter.html");
        break;
        }        
    }
        if($pieces[$i] == "selection"){
    	mysqli_query($link2,'insert into selection (question, reponse_selection) VALUES ("'.$pieces[$i+2].'","'.$pieces[$i+3].'")');
        $result = mysqli_query($link2,'select max(id_selection) as maxi from selection');
        $row = mysqli_fetch_array($result);
        if (!mysqli_query($link2,'insert into ordre_question (type_question, id_type, colonne_assoc, id_onglet, id_formulaire) VALUES ("'.$pieces[$i].'","'.$row["maxi"].'","'.$pieces[$i+1].'","'.$id.'","'.$dnn2['id_formulaire'].'")'))
        {
            ?>
            <div id="page-wrapper">
                <div class="main-page">
                An error occured while creating the forms
            </div></div>

            <?php
            include("html/mainfooter.html");
        break;
        }        
    }
    if($pieces[$i] == "number"){
    	mysqli_query($link2,'insert into text (question, reponse_text) VALUES ("'.$pieces[$i+2].'","'.$pieces[$i].'")');
        $result = mysqli_query($link2,"SELECT MAX(id_text) as maxi FROM text");
        $row = mysqli_fetch_array($result);
        if (!mysqli_query($link2,'insert into ordre_question (type_question, id_type, colonne_assoc,id_onglet, id_formulaire) VALUES ("'.$pieces[$i].'","'.$row["maxi"].'","'.$pieces[$i+1].'","'.$id.'","'.$dnn2['id_formulaire'].'")'))
        {
            ?>
            <div id="page-wrapper">
                <div class="main-page">
                An error occured while creating the forms
            </div></div>
            <?php     
            include("html/mainfooter.html");
            break;
        }
    }
    
    if($pieces[$i] == "textarea"){
    	mysqli_query($link2,'insert into textarea (question) VALUES ("'.$pieces[$i+2].'")');
        $result = mysqli_query($link2,"SELECT MAX(id_textarea) as maxi FROM textarea");
        $row = mysqli_fetch_array($result);
        if (!mysqli_query($link2,'insert into ordre_question (type_question, id_type, colonne_assoc,id_onglet, id_formulaire) VALUES ("'.$pieces[$i].'","'.$row["maxi"].'","'.$pieces[$i+1].'","'.$id.'","'.$dnn2['id_formulaire'].'")'))
        {
           ?>
            <div id="page-wrapper">
                <div class="main-page">
                An error occured while creating the forms
            </div></div>
            <?php include("html/mainfooter.html");
        break; 
        }
    }
    
    if($pieces[$i] == "checkbox"){
    	mysqli_query($link2,'insert into checkbox (question,reponse_checkbox) VALUES ("'.$pieces[$i+2].'","'.$pieces[$i+3].'")');
        $result = mysqli_query($link2,"SELECT MAX(id_checkbox) as maxi FROM checkbox");
        $row = mysqli_fetch_array($result);
        if (!mysqli_query($link2,'insert into ordre_question (type_question, id_type, colonne_assoc,id_onglet, id_formulaire) VALUES ("'.$pieces[$i].'","'.$row["maxi"].'","'.$pieces[$i+1].'","'.$id.'","'.$dnn2['id_formulaire'].'")'))
        {
            ?>
            <div id="page-wrapper">
                <div class="main-page">
                An error occured while creating the forms
            </div></div>
            <?php include("html/mainfooter.html");
        break;
        }
    }
    
    if($pieces[$i] == "radio"){
        mysqli_query($link2,'insert into radio (question,reponse_radio) VALUES ("'.$pieces[$i+2].'","'.$pieces[$i+3].'")');
        $result = mysqli_query($link2,"SELECT MAX(id_radio) as maxi FROM radio");
        $row = mysqli_fetch_array($result);
        if (!mysqli_query($link2,'insert into ordre_question (type_question, id_type, colonne_assoc,id_onglet, id_formulaire) VALUES ("'.$pieces[$i].'","'.$row["maxi"].'","'.$pieces[$i+1].'","'.$id.'","'.$dnn2['id_formulaire'].'")'))
        {
            ?>
            <div id="page-wrapper">
                <div class="main-page">
                An error occured while creating the forms
            </div></div>
            <?php
            include("html/mainfooter.html");
        break;
        }
    }
   
    $i = $i+5;



    if($i>$nb){
 
       
     echo   $sql_supprimer="DROP TABLE IF EXISTS `".$nom_table."`;";
       mysqli_query($link, $sql_supprimer);
  
       
               $nom_table="donneeprojet".$dnn2['id_project']."formulaire".$dnn2['id_formulaire'];
       $sql_name_table_formulaire="SELECT colonne_assoc FROM ordre_question WHERE id_formulaire=".$dnn2['id_formulaire']."";
       $result_table_formulaire=  mysqli_query($link, $sql_name_table_formulaire);
       
        $create_table="CREATE TABLE donneeprojet".$dnn2['id_project']."formulaire".$dnn2['id_formulaire']." (id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,";
        while($temp_name=  mysqli_fetch_array($result_table_formulaire)){
            
         $create_table.="`".$temp_name['colonne_assoc']."` VARCHAR (255),";   
            
        }
        $create_table.="time_modification TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP";
        $create_table.=")";
        echo $create_table;
        mysqli_query($link, $create_table);
        
    }
    }
?><div id="page-wrapper">
            <div class="main-page">
        
Le formulaire a bien été crée
</div></div>
<?php } include("html/mainfooter.html"); ?>
