<?php
include("html/mainheader.php");
if(isset($_POST['formulaire'])){
    $formulaire=$_POST['formulaire'];
    
}

?>
<div id="page-wrapper">
			<div class="main-page">
                            <div class="row">
				<?php

$sql_num_projet="SELECT id_project FROM project_formulaire WHERE id_formulaire=".$formulaire."";
$req_num_projet=  mysqli_query($link, $sql_num_projet);
$temp_num_projet = mysqli_fetch_assoc($req_num_projet);
?> 
<form method="POST" action="enregistrer_patient.php">
    <input type="hidden" name="formulaire" id="formulaire" value="<?php echo $formulaire;?>" >
   <input type="hidden" name="projet" id="projet" value="<?php echo $temp_num_projet['id_project'];?>" >
 <?php
 $select_onglet="SELECT nom_onglet,id_onglet FROM onglet WHERE id_formulaire=".$formulaire."";
 $recup_onglet=  mysqli_query($link, $select_onglet);
  while($temp_onglet = mysqli_fetch_assoc($recup_onglet)){
 echo $temp_onglet['nom_onglet'];echo "<br/>";
 $recup_question="SELECT id_question,type_question,id_type,colonne_assoc FROM ordre_question WHERE ordre_question.id_onglet=".$temp_onglet['id_onglet']." ORDER BY id_question ASC";
$resultat_recup_question=mysqli_query($link,$recup_question) or die(mysqli_error($link)); 
 while($temp_recup_question = mysqli_fetch_assoc($resultat_recup_question)){

 
 $select_question="SELECT *  FROM ".$temp_recup_question['type_question']." WHERE id_".$temp_recup_question['type_question']."=".$temp_recup_question['id_type']." ";
 $resultat_slect_question=mysqli_query($link,$select_question) or die(mysqli_error($link)); 
 
		while($temp_select_question = mysqli_fetch_assoc($resultat_slect_question)){
		if($temp_recup_question['type_question']=='checkbox'){
	
		$aa="reponse_".$temp_recup_question['type_question']."";
		$solution_checkbox = explode(";", $temp_select_question[$aa]);
	$i=0;
	$k=count($solution_checkbox);
		echo $temp_select_question['question'];?><br/><?php
	while($i<$k){
?>
	<input type="checkbox" class="" name="<?php echo $temp_recup_question['colonne_assoc']; ?>" id="<?php echo $temp_recup_question['colonne_assoc'].$i; ?>" value="<?php echo $solution_checkbox[$i];?>"/><label for="<?php echo $temp_recup_question['colonne_assoc'].$i; ?>"><?php echo $solution_checkbox[$i];?></label>
	<?php $i++;
	}
	echo "<br/>";
		}
		elseif($temp_recup_question['type_question']=='radio'){
			$aa="reponse_".$temp_recup_question['type_question']."";

		$solution_radio = explode(";", $temp_select_question[$aa]);
	$i2=0;
	$k2=count($solution_radio);	
	echo $temp_select_question['question'];?><br/><?php
	while($i2<$k2){
?>
	<input type="radio" name="<?php echo $temp_recup_question['colonne_assoc']; ?>" id="<?php echo $temp_recup_question['colonne_assoc'].$i2; ?>" value="<?php echo $solution_radio[$i2];?>"/><label for="<?php echo $temp_recup_question['colonne_assoc'].$i2; ?>"><?php echo $solution_radio[$i2];?></label>
	<?php $i2++;
	}	echo "<br/>";
		}
		
		elseif($temp_recup_question['type_question']=='text'){
			echo $temp_select_question['question'];?><br/><?php
		$aa="reponse_".$temp_recup_question['type_question']."";
		if($temp_select_question[$aa]=='date'){
		?><input type="<?php echo $temp_select_question[$aa]; ?>" name="<?php echo $temp_recup_question['colonne_assoc']; ?>" placeholder="YYYY-MM-JJ" id="<?php echo $temp_recup_question['colonne_assoc']; ?>"/><?php
		}
		else
		{
		?><input type="<?php echo $temp_select_question[$aa]; ?>" name="<?php echo $temp_recup_question['colonne_assoc']; ?>" id="<?php echo $temp_recup_question['colonne_assoc']; ?>"/><?php 
		}
		echo "<br/>";
		
		}				
		elseif($temp_recup_question['type_question']=='textarea'){
		
		$aa="reponse_".$temp_recup_question['type_question']."";
		echo $temp_select_question[$aa];
		?> 
		<br/>
		<textarea name="<?php echo $temp_recup_question['colonne_assoc']; ?>" id="<?php echo $temp_recup_question['colonne_assoc']; ?>"></textarea>
		<?php
		echo "<br/>";
		}
				elseif($temp_recup_question['type_question']=='selection'){
		$aa="reponse_".$temp_recup_question['type_question']."";
		$solution_select = explode(";", $temp_select_question[$aa]);
	$i3=0;
	$k3=count($solution_select);	
	echo $temp_select_question['question'];?><br/>
	<select name="<?php echo $temp_recup_question['colonne_assoc']; ?>" id="<?php echo $temp_recup_question['colonne_assoc']; ?>">
	<?php
	while($i3<$k3){
?>
<option value="<?php echo $solution_select[$i3];?>"><?php echo $solution_select[$i3];?></option>
	<?php $i3++;
	}	echo "</select><br/>";
		}
		
		}
     
  }} ?>
<input type="submit" value="enregistrer">
 </form>
                            </div>
</div>
</div>
 <?php
 include("html/mainfooter.html");
 ?>