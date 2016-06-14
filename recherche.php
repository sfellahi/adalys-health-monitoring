<?php

include("html/mainheader.php");


$name = $_POST['nom'];
$nom_c = explode("  ", $name);
$nom = $nom_c[0];
$prenom = $nom_c[1];

$tags = explode(',' , $_POST['result']);

$cn = count($tags);

?>
<div id="page-wrapper">
<div class="main-page"><?php
$a=0;
for($i=0; $i<=$cn; $i++){
	$query = mysqli_query($link,"SELECT id FROM $tags[$i] WHERE prenom LIKE '%$prenom%' AND nom LIKE'%$nom%'");
	$nb_resultats = mysqli_num_rows($query);
	if($nb_resultats != 0)
	{
		$str =  $tags[$i];
		$c1 = strlen($tags[$i]);
		$nb_form = substr($str, strrpos($str, 'e') + 1);
		$c2 = strlen($nb_form);
		$c3 = $c1-$c2-10; //10 = formulaire
		$chaine = substr($tags[$i],0,$c3);
		$chaine1 = substr($chaine,12);
		$nb_projet = $chaine1 ;
		$proj[$a] =$nb_projet;
		$form[$a] =$nb_form;
		$a++;
	}
}

$result = array_unique($proj);
$result2 = array_unique($form);

?><table><tr><th>Nom</th><th>Projet</th><?php
foreach ($result as &$value) {
	$sql_formulaire = "SELECT project_formulaire.id_formulaire,project_formulaire.id_project, formulaire.nom_formulaire,etat_formulaire ";
	$sql_formulaire .= "FROM project_formulaire LEFT JOIN formulaire ";
	$sql_formulaire .= "ON project_formulaire.id_formulaire=formulaire.id_formulaire AND project_formulaire.id_project = ".$value."";

$requete = mysqli_query ( $link, $sql_formulaire );
while ( $row = mysqli_fetch_array ( $requete ) ) {
	if($row['nom_formulaire'] !=' '){	
	?><th><?php echo $row['nom_formulaire'];?></th><?php
	}
}
	
}
?>
</tr><tr><td><?php echo $name;?></td><?php
foreach ($result2 as &$value2) {
	$sql_formulaire2 = "SELECT formulaire.id_formulaire,formulaire.nom_formulaire,etat_formulaire ";
	$sql_formulaire2 .= "FROM formulaire WHERE id_formulaire= ".$value2."";
	
	$requete2 = mysqli_query ( $link, $sql_formulaire2 );
	while ( $row2 = mysqli_fetch_array ( $requete2 ) ) {
		if($row2['nom_formulaire'] ==' '){
			?><td><?php echo " ";?></td><?php
		}
		else
		?><td><?php echo $row2['nom_formulaire'];?></td><?php
	}
}


?></tr></table>
</div></div>