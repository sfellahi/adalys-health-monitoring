<?php
include("html/mainheader.php");
if(isset($_POST['formulaire'])){
    $formulaire=$_POST['formulaire'];
    
}

?>
<style media="print" type="text/css">
    .noImpr {   display:none;   } </style>
<style>
    .formulaire{
       margin:0 auto;
       width:70%;
       border:0px solid #2a2f43;
       border-radius: 10px;
       max-height:620px;
       overflow:auto;
    }
    .onglet{
        color:white;
   width:100%;
    height:50px;
    border-radius: 10px;
    text-align: center;
    border:3px solid #2a2f43;
    background-color:#65709D; 
    padding-top:7px;
    font-size:120%;
    text-decoration: underline;
    }   
    .videform{
    height:30px;
        
    }
    .videform2{
        
        height:20px;
    }
    .submit{
        border:none;
        border-radius:15px;
        margin-left:41%;
        width:15%;
        height:40px;
        min-width: 150px;
        background-color:#2a2f43;
        color:white;
        font-weight: 600;
        font-size:110%;
    }
    .submit:hover{
        background-color:#65709D;
    }#ajoutpatient.label{
        margin-left:40px;
    }
    .question{
        text-decoration: underline;
        height:30px;
    }
    .checkboxajout{
        margin-left:5%;
    }
    </style>
<div id="page-wrapper">
			<div class="main-page" onload="window.print()">
                            <div class="row">
                                
                                <div class="formulaire">
                                    
                                    
                              
				<?php

$sql_num_projet="SELECT id_project FROM project_formulaire WHERE id_formulaire=".$formulaire."";
$req_num_projet=  mysqli_query($link, $sql_num_projet);
$temp_num_projet = mysqli_fetch_assoc($req_num_projet);
?> 
<form method="POST" name="ajoutpatient" id="ajoutpatient" action="enregistrer_patient.php">
    <input type="hidden" name="formulaire" id="formulaire" value="<?php echo $formulaire;?>" >
   <input type="hidden" name="projet" id="projet" value="<?php echo $temp_num_projet['id_project'];?>" >
 <?php
 $select_onglet="SELECT nom_onglet,id_onglet FROM onglet WHERE id_formulaire=".$formulaire." ORDER BY id_onglet ASC";
 $recup_onglet=  mysqli_query($link, $select_onglet);
  while($temp_onglet = mysqli_fetch_assoc($recup_onglet)){
      ?>
   <div class="onglet"><?php echo $temp_onglet['nom_onglet']; ?></div>
   <div class="videform2" ></div>
 <?php
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
        ?><span class="question"><?php echo $temp_select_question['question'];?></span>&nbsp;<?php
	while($i<$k){
?>
        <span class="reponsesajout checkboxajout"><input type="checkbox" class="question_push" name="<?php echo $temp_recup_question['colonne_assoc']; ?>" id="<?php echo $temp_recup_question['colonne_assoc'].$i; ?>" value="<?php echo $solution_checkbox[$i];?>"/><label for="<?php echo $temp_recup_question['colonne_assoc'].$i; ?>"><?php echo $solution_checkbox[$i];?></label></span>
	<?php $i++;
	}
	echo "<br/>";
		}
		elseif($temp_recup_question['type_question']=='radio'){
			$aa="reponse_".$temp_recup_question['type_question']."";

		$solution_radio = explode(";", $temp_select_question[$aa]);
	$i2=0;
	$k2=count($solution_radio);	
	?><span class="question"><?php echo $temp_select_question['question'];?></span>&nbsp;<?php
	while($i2<$k2){
?>
	<span class="reponsesajout checkboxajout"><input type="radio" class="question_push" name="<?php echo $temp_recup_question['colonne_assoc']; ?>" id="<?php echo $temp_recup_question['colonne_assoc'].$i2; ?>" value="<?php echo $solution_radio[$i2];?>"/><label for="<?php echo $temp_recup_question['colonne_assoc'].$i2; ?>"><?php echo $solution_radio[$i2];?></label>
        </span>
            <?php $i2++;
	}	echo "<br/>";echo "<br/>";
		}
		
		elseif($temp_recup_question['type_question']=='text'){
		?><span class="question"><?php echo $temp_select_question['question'];?></span>&nbsp;<?php
	$aa="reponse_".$temp_recup_question['type_question']."";
		if($temp_select_question[$aa]=='date'){
		?><input type="<?php echo $temp_select_question[$aa]; ?>" class="question_push" name="<?php echo $temp_recup_question['colonne_assoc']; ?>" placeholder="YYYY-MM-JJ" id="<?php echo $temp_recup_question['colonne_assoc']; ?>"/><?php
		}
		else
		{
		?><input type="<?php echo $temp_select_question[$aa]; ?>" class="question_push" name="<?php echo $temp_recup_question['colonne_assoc']; ?>" id="<?php echo $temp_recup_question['colonne_assoc']; ?>"/><?php 
		}
		echo "<br/>";echo "<br/>";
		
		}				
		elseif($temp_recup_question['type_question']=='textarea'){
		
		$aa="reponse_".$temp_recup_question['type_question']."";
                ?><span><?php echo $temp_select_question['question'];?> </span>
               
	
		&nbsp;
		<textarea name="<?php echo $temp_recup_question['colonne_assoc']; ?>" id="<?php echo $temp_recup_question['colonne_assoc']; ?>"></textarea>
		<?php
		echo "<br/>";echo "<br/>";
		}
				elseif($temp_recup_question['type_question']=='selection'){
		$aa="reponse_".$temp_recup_question['type_question']."";
		$solution_select = explode(";", $temp_select_question[$aa]);
	$i3=0;
	$k3=count($solution_select);	
        ?><span class="question"><?php echo $temp_select_question['question'];?></span>&nbsp;
	<select name="<?php echo $temp_recup_question['colonne_assoc']; ?>" id="<?php echo $temp_recup_question['colonne_assoc']; ?>">
	<?php
	while($i3<$k3){
?>
<option value="<?php echo $solution_select[$i3];?>"><?php echo $solution_select[$i3];?></option>
	<?php $i3++;
	}	echo "</select><br/>";echo "<br/>";
		}
		
		}
     
  }  ?>
  
  <div class="videform" ></div>
  
  <?php      } ?>
<input type="submit" class="submit noImpr" value="Enregistrer">
<div class="videform" ></div>
 </form>
 <a href="edition.php" onclick="edition();return false;" class="button noImpr">Imprimer ce formulaire</a>                                   
                             </div>
                                </div>
</div>
</div>
<script type="text/javascript">
function edition()
{
	options = "Width=700,Height=700" ;
	window.print() ;
}

</script>

 <?php
 include("html/mainfooter.html");
 ?>