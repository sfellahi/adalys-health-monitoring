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
        <th>Lié un médecin</th>
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
        <td><form action="change_etat.php?parent=<?php echo $dnn1['id_project']; ?>" method="post">
			<div>
			<select name="etat" onChange='this.form.submit()'>
		  		<option value="<?php echo $dnn1['etat_project']; ?>" selected ><?php echo $dnn1['etat_project']; ?></option>
				<option value="En création">En création</option>
				<option value="En cours de prodution">En cours de prodution</option>
				<option value="Cloturé">Cloturé</option>
			</select>
		    </div>
		 	</form>
 		</td>
 		<?php
 		$dn2 = mysqli_query($link,'select id, nom, prenom from users where profil = "medecin"'); 
 		while($dnn2 = mysqli_fetch_array($dn2)){
 			?>

 		<form action="user_project.php?parent=<?php echo $dnn1['id_project']; ?>" method="post">
 			<td><select name="medecin">
		  		<option value="<?php echo $dnn2['id']; ?>"><?php echo $dnn2['nom'] ." ". $dnn2['prenom'] ; ?></option>
			</select>
			</td>
			<?php 
    	}
			?>
 			<td><button type="submit">Lié</button></td>
 		</form>			
    </tr>
    </div>
    </div>

<?php
    }
}
include("html/mainfooter.html");?>