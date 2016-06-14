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
?>
<div id="page-wrapper">
    <div class="main-page">
<table><tr>
<th>Projet</th>
<th>Action</th>
</tr>
<tr>
<?php
foreach ($result as &$value) {
$result3 = mysqli_query($link2,"SELECT nom_project FROM projects WHERE id_project = ".$value."");
$row3 = mysqli_fetch_array($result3);
?>
	<form action="recherche_projet.php" method="post">
	<input type="hidden" value="<?php echo $name; ?>" name="nom">
	<input type="hidden" value="<?php echo implode(',', $result2); ?>" name="form">
	<td><input type="hidden" value="<?php echo $value; ?>" name="projet"><?php echo $row3['nom_project']; ?></td>
	<td><button class="button" type="submit">Voir</button></td></tr>
	</form>
	<?php	
}
?>
</table></div></div>
<?php include("html/mainfooter.html");?>