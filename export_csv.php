<?php
include('html/mainheader.php');

$id_form = $_POST['formulaire'];
$id_projet = $_POST['project'];

$table = "donneeprojet".$id_projet."formulaire".$id_form;
    // fetch mysql table rows
    $sql = "select * from $table";
    $result = mysqli_query($link, $sql) or die("Selection Error " . mysqli_error($link));

    $fp = fopen($table.'.csv', 'w');

    while($row = mysqli_fetch_assoc($result))
    {
        fputcsv($fp, $row);
    }
    
    fclose($fp);
    ?>
    <div id="page-wrapper">
    <div class="main-page">Le fichier <?php echo $table.'.csv';?> a été exporté </div></div>
    <?php
    //close the db connection
    mysqli_close($link);
?>