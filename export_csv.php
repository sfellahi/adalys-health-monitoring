<?php

include('html/mainheader.php');

if(isset($_POST['formulaire']) and isset($_POST['project'])){
$id_form = $_POST['formulaire'];
$id_projet = $_POST['project'];

$table = "donneeprojet".$id_projet."formulaire".$id_form;
    // fetch mysql table rows
    $sql = "select * from $table";
    $result = mysqli_query($link, $sql) or die("Selection Error " . mysqli_error($link));

    $fp = fopen('export/'.$table.'.csv', 'w');

    while($row = mysqli_fetch_assoc($result))
    {
        fputcsv($fp, $row);
    }
    
    fclose($fp);
    ?>
    
    <div id="page-wrapper">
    <div class="main-page">Le fichier <?php echo $table.'.csv';?> a été exporté<br>
    <a href="<?php echo 'export/'.$table.'.csv'?>" download >Cliquez ici pour le telecharger</a>
   
    </div></div>
    
    <?php
    mysqli_close($link);
 	
}    
include("html/mainfooter.html");?>