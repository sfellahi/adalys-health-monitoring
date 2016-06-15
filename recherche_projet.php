<?php
include("html/mainheader.php");
$name = $_POST['nom'];
$nom_c = explode("  ", $name);
$nom = $nom_c[0];
$prenom = $nom_c[1];

$nb_proj = $_POST['projet'];

$result = mysqli_query($link2,"SELECT MAX(id_formulaire) as maxi FROM formulaire");
$row = mysqli_fetch_array($result);?>
<div id="page-wrapper">
    <div class="main-page">
        <table><tr>
                <th>Nom</th>
<?php
	$sql_formulaire = "SELECT project_formulaire.id_formulaire,project_formulaire.id_project, formulaire.nom_formulaire,etat_formulaire ";
	$sql_formulaire .= "FROM project_formulaire LEFT JOIN formulaire ";
	$sql_formulaire .= "ON project_formulaire.id_formulaire=formulaire.id_formulaire AND project_formulaire.id_project = ".$nb_proj."";
	$requete = mysqli_query ( $link, $sql_formulaire );
	while ( $row2 = mysqli_fetch_array ( $requete ) ) {
        if($row2['nom_formulaire']==''){}
        else { 
                    ?><th><?php echo $row2['nom_formulaire'];?></th><?php } 		
	}
	?>
</tr>

<tr>
    <td><?php echo $name;?></td>
<?php
for($y=1;$y<= $row['maxi'];$y++){
	$table = "donneeprojet".$nb_proj."formulaire".$y;
	$s = mysqli_query($link,"SHOW TABLES LIKE '".$table."'");
	if (mysqli_num_rows($s) == 1) {
		$query = mysqli_query($link,"SELECT id FROM $table WHERE prenom LIKE '%$prenom%' AND nom LIKE'%$nom%'");
		$nb_resultats = mysqli_num_rows($query);
		if($nb_resultats != 0)
		{
			?><td><i class="fa fa-check-square-o" aria-hidden="true"></i></td><?php
		}
	}
}

?></table></div></div>
<?php include("html/mainfooter.html");?>