<?php
include('html/mainheader.php');
?>
<div id="page-wrapper">
            <div class="main-page">
<table class="categories_table">
    <tr>
        <th>Nom du projet</th>
        <th>Date de creation</th>
        <th>Nombre de patient</th>
        <th>Action</th>
        <th>Etat du projet</th>
    </tr>   
<?php
$dn1 = mysqli_query($link,'select id_project, nom_project, date_debut, nombre_patient, etat_project from projects');
if ($dn1) {
while($dnn1 = mysqli_fetch_array($dn1))
    {
    ?>
    <tr>
        <td class="forum_cat"><a href="list_formulaire.php?parent=<?php echo $dnn1['id_project']; ?>" class="title"><?php echo $dnn1['nom_project']; ?></td>
        <td><?php echo $dnn1['date_debut']; ?></td>
        <td><?php echo $dnn1['nombre_patient']; ?></td>
        <td><a href="new_formulaire.php?parent=<?php echo $dnn1['id_project'];?>" class="btn btn-primary">Nouveau Formulaire</a></td>
        <td><?php echo $dnn1['etat_project']; ?></td>
    </tr></div></div>
<?php
    }
}
?>
<?php include("html/mainfooter.html");?>