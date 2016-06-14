<?php
include("html/mainheader.php");
$name = $_POST['nom'];

$nb_proj = $_POST['projet'];

$result = mysqli_query($link2,"SELECT MAX(id_formulaire) as maxi FROM formulaire");
$row = mysqli_fetch_array($result);?>
<div id="page-wrapper">
    <div class="main-page">
<table><tr><th>Nom</th>
<?php
	$sql_formulaire = "SELECT project_formulaire.id_formulaire,project_formulaire.id_project, formulaire.nom_formulaire,etat_formulaire ";
	$sql_formulaire .= "FROM project_formulaire LEFT JOIN formulaire ";
	$sql_formulaire .= "ON project_formulaire.id_formulaire=formulaire.id_formulaire AND project_formulaire.id_project = ".$nb_proj."";
	$a=0;
	$requete = mysqli_query ( $link, $sql_formulaire );
	while ( $row2 = mysqli_fetch_array ( $requete ) ) {
		?><th><?php echo $row2['nom_formulaire'];?></th><?php		
		$a++;
	}
	?>
</tr><tr><td><?php echo $name;?></td>
<?php
$a=0;
for($y=1;$y<= $row['maxi'];$y++){
	$table = "donneeprojet".$nb_proj."formulaire".$y;
	$s = mysqli_query($link,"SHOW TABLES LIKE '".$table."'");
	if (mysqli_num_rows($s) == 1) {
		$sql_formulaire = "SELECT formulaire.id_formulaire,formulaire.nom_formulaire,etat_formulaire ";
		$sql_formulaire .= "FROM formulaire WHERE id_formulaire= ".$y."";
		$requete = mysqli_query ( $link, $sql_formulaire );
		while ( $row = mysqli_fetch_array ( $requete ) ) {
				?><td><?php echo $row['nom_formulaire'];?></td></tr><td></td><?php
			}
	}
}

?></table></div></div>