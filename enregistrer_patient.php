<?php
include("html/mainheader.php");
if(isset($_POST['formulaire'])){ $formulaire=$_POST['formulaire'];}
if(isset($_POST['projet'])){ $projet=$_POST['projet'];}

$array_test=array();

echo $recup_question="SELECT id_question,type_question,id_type,colonne_assoc FROM ordre_question WHERE id_formulaire=".$formulaire." ORDER BY id_question ASC";

$resultat_recup_question=mysqli_query($link,$recup_question) or die(mysqli_error($link)); 
 while($temp_recup_question = mysqli_fetch_assoc($resultat_recup_question)){
 

	

	if($temp_recup_question['type_question']=='checkbox'){
		
		
	$array_test[]=$temp_recup_question['colonne_assoc'];	
	}
 else{

 	$array_test[]=$temp_recup_question['colonne_assoc']; 
 }
 
 }
 
$aaa=count($array_test);


$ajout_sql="INSERT INTO donneeprojet".$projet."formulaire".$formulaire." (".$array_test[0]."";
$test=1;
while($test<$aaa){
$ajout_sql.=",".$array_test[$test]."";

$test++;
}
$ajout_sql.=") VALUE ('".$_POST[$array_test[0]]."'";
$test2=1;
while($test2<$aaa){
    if(!isset($_POST[$array_test[$test2]])){$_POST[$array_test[$test2]]='';}
$ajout_sql.=",'".$_POST[$array_test[$test2]]."'";

$test2++;
}
$ajout_sql.=")";
echo $ajout_sql;
mysqli_query($link,$ajout_sql) or die(mysqli_error($link));
?>
<div id="page-wrapper">
<div class="main-page">
Les données ont bien été enregistré
</div></div>

<?php
include("html/mainfooter.html");
