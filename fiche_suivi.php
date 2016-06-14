<?php
include("html/mainheader.php");

$result = mysqli_query($link2,"SELECT MAX(id_formulaire) as maxi FROM formulaire");
$row = mysqli_fetch_array($result);

$result2 = mysqli_query($link2,"SELECT MAX(id_project) as max FROM projects");
$row2 = mysqli_fetch_array($result2);

?>
<div id="page-wrapper">
    <div class="main-page">
<table><tr>
<th>Nom Complet</th>
<th>Action</th>
</tr>
<tr>
<?php 
$a = 0;
$b =0;
for($i=1;$i<= $row2['max'];$i++){
	for($y=1;$y<= $row['maxi'];$y++){
		$table = "donneeprojet".$i."formulaire".$y;
		$s = mysqli_query($link,"SHOW TABLES LIKE '".$table."'");
		if (mysqli_num_rows($s) == 1) {		
					$arry[$a] = $table;			
					$req= mysqli_query($link,"select nom,prenom from $table");				
					while($data = mysqli_fetch_array($req))
					{
						$nom_complet = $data['nom']."  ".$data['prenom'];				
						$ary[$b] = $nom_complet;
						$b++;
					
					}	
				}
			$a++;
			}
		}

$result = array_unique($ary);
foreach ($result as &$value) {
?>
	<form action="recherche.php" method="post">
	<input type="hidden" value="<?php echo implode(',', $arry); ?>" name="result">
	<td><input type="hidden" value="<?php echo $value; ?>" name="nom"><?php echo $value; ?></td>

	<td><button class="button" type="submit">Voir le suivie</button></td></tr>
	</form>
	<?php	
}

?>

</table></div></div>
<?php include("html/mainfooter.html");?>