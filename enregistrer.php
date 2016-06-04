 <?php
//This page displays the list of the forum's categories
include('html/mainheader.php');

$id=$_GET['id'];
$onglet = $_POST['onglet'];
mysqli_query($link2,'insert into onglet (id_formulaire, nom_onglet) VALUES ("'.$id.'","'.$onglet.'")');

$dn2 = mysqli_query($link2,'select id_onglet from onglet where nom_onglet= "'.$onglet.'"');
$dnn2 = mysqli_fetch_array($dn2);

$str = $_POST['value1'];
$pieces = explode(",", $str);
$nb = count($pieces)-5;
$i = 0;

while ($i <= $nb ) {
    if($pieces[$i] == "texte"){
    	mysqli_query($link2,'insert into text (question, reponse_text) VALUES ("'.$pieces[$i+2].'","'.$pieces[$i].'")');
        $result = mysqli_query($link2,'select max(id_text) as maxi from text');
        $row = mysqli_fetch_array($result);
        if (!mysqli_query($link2,'insert into ordre_question (type_question, id_type, colonne_assoc, id_formulaire, id_onglet) VALUES ("'.$pieces[$i].'","'.$row["maxi"].'","test","'.$id.'","'.$dnn2['id_onglet'].'")'))
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
        if (!mysqli_query($link2,'insert into ordre_question (type_question, id_type, colonne_assoc,id_formulaire, id_onglet) VALUES ("'.$pieces[$i].'","'.$row["maxi"].'","test","'.$id.'","'.$dnn2['id_onglet'].'")'))
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
        if (!mysqli_query($link2,'insert into ordre_question (type_question, id_type, colonne_assoc,id_formulaire, id_onglet) VALUES ("'.$pieces[$i].'","'.$row["maxi"].'","test","'.$id.'","'.$dnn2['id_onglet'].'")'))
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
        if (!mysqli_query($link2,'insert into ordre_question (type_question, id_type, colonne_assoc,id_formulaire, id_onglet) VALUES ("'.$pieces[$i].'","'.$row["maxi"].'","test","'.$id.'","'.$dnn2['id_onglet'].'")'))
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
        if (!mysqli_query($link2,'insert into ordre_question (type_question, id_type, colonne_assoc,id_formulaire, id_onglet) VALUES ("'.$pieces[$i].'","'.$row["maxi"].'","test","'.$id.'","'.$dnn2['id_onglet'].'")'))
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
}
?><div id="page-wrapper">
            <div class="main-page">
Le formulaire a bien ete cree
</div></div>
<?php include("html/mainfooter.html"); ?>
