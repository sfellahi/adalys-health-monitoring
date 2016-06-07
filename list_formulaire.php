<?php
//This page let display the list of topics of a category

if(isset($_GET['parent']))
{
    include('html/mainheader.php');
	$id=$_GET['parent'];
        

	$dn1 = mysqli_query($link,'select id_formulaire from project_formulaire where id_project = "'.$id.'"');

     $dn1 = mysqli_query($link,'select id_formulaire from project_formulaire where id_project = "'.$id.'"');
	?>
	<div id="page-wrapper"> 
            <div class="main-page">
                 <div class="row">
<table class="flat-table" border="0" id="tableformulaire" cellspacing="0">
    <tr>
            <th>Formulaire</th>
            <th>Etat du projet</th>
            <th>Etat du formulaire</th>
            <th>Nb d'onglet</th>
            <th style="width:21%">Onglets</th>
            <th >Nb question</th>
            <th>Etat</th>
            <th style="width:11%">Action</th>
    </tr>
    	<?php
    while($dnn1 = mysqli_fetch_array($dn1)){
             $sql_liste_formulaire_plus_info_projet="SELECT etat_project, etat_formulaire,nom_formulaire
FROM project_formulaire
LEFT JOIN projects ON projects.id_project = project_formulaire.id_project
LEFT JOIN formulaire ON formulaire.id_formulaire = project_formulaire.id_formulaire WHERE formulaire.id_formulaire=".$dnn1['id_formulaire']."";
    $dn2 = mysqli_query($link,$sql_liste_formulaire_plus_info_projet);	
    $dnn2 = mysqli_fetch_array($dn2);
       
        $sql_count_onglet="SELECT id_onglet from onglet where id_formulaire=".$dnn1['id_formulaire']."";
        $result_count_onglet=mysqli_query($link,$sql_count_onglet);
         $rowcountonglet=mysqli_num_rows($result_count_onglet);
        $sql_count_question="SELECT id_onglet from ordre_question where id_formulaire=".$dnn1['id_formulaire']."";
        $result_count_question=mysqli_query($link,$sql_count_question);
         $rowcountquestion=mysqli_num_rows($result_count_question);
    ?>
    <tr>
    	<td>
<?php echo $dnn2['nom_formulaire']; ?>
        </td>
        <td>
            <?php echo $dnn2['etat_project']; ?>
        </td>
        <td>
            <?php echo $dnn2['etat_formulaire']; ?>
        </td>
        <td>
        <?php echo $rowcountonglet;?> 
        </td>
         <td>
                         <a href="list_onglet.php?parent=<?php echo $dnn1['id_formulaire']; ?>" class="btn btn-info">
          <span class="glyphicon glyphicon-tasks"></span> Liste 
        </a>
            
            <a 
                <?php
                if($dnn2['etat_project']=='Cloturé'){
                ?>
                href="#" Onclick="alert('Le projet est cloturer il est impossible d\'ajouter des onglets');"
                <?php 
           
                } else 
                {
                  if($dnn2['etat_formulaire']=='En cours'){
                    ?>
                href="#" Onclick="alert('Le formulaire est en cours il est impossible d\'ajouter des onglets');"
                <?php }
                else if(($dnn2['etat_formulaire']=='Cloturé')){?>
                 href="#" Onclick="alert('Le formulaire est clos il est impossible d\'ajouter des onglets');"
               <?php }
                
                else{  ?>
                href="new_onglet.php?parent=<?php echo $dnn1['id_formulaire'];?>"<?php }}?> class="btn btn-primary">
                <span class="glyphicon glyphicon-wrench"></span> Nouveau</a></td>
           <!--
             <form action="list_onglet.php" style="display:inline;" method="POST" name="listeonglet">
                <input type="hidden" name="parent" value="<?php// echo $dnn1['id_formulaire']; ?>"/> 
                <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-tasks"></span> Liste</button>   
             </form>
          <form action="new_onglet.php" method="POST" style="display:inline;" name="newonglet">
                <input type="hidden" name="parent" value="<?php //echo $dnn1['id_formulaire']; ?>"/> 
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-wrench"></span> Nouveau</button>   
             </form>
             -->
                
            <td>
           <?php echo $rowcountquestion;?> 
               
        </td>
        <td>
           <form action="change_etat.php" name="changeretat" id="changeretat"  method="post">
               <input type="hidden" value="<?php echo $dnn1['id_formulaire']; ?>" name="parentformulaire">
			<div>
                        <select name="etat"  id="etat" onChange="changerEtat('<?php echo $dnn2['nom_formulaire']; ?>')" >
		  		<option value="<?php echo $dnn2['etat_formulaire']; ?>" selected ><?php echo $dnn2['etat_formulaire']; ?></option>
				<option value="En création">En création</option>
				<option value="En cours">En cours</option>
				<option value="Cloturé">Cloturé</option>
			</select>
		    </div>
		 	</form> 
        </td>
                 <td>
                    <form action="supp_formulaire.php"  method="POST" name="suppformulaire">
                <input type="hidden" name="parent" value="<?php echo $dnn1['id_formulaire']; ?>"/> 
                <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Supprimer</button>   
             </form>
                     <!--
            <a href="new_onglet.php?parent=<?php// echo $dnn1['id_formulaire'];?>" class="btn btn-danger">
                <span class="glyphicon glyphicon-remove"></span> Supprimer</a></td>-->
    </tr>
    <?php

    }
    ?>
                    </table>
                 </div>
                      <?php  $sql_recup_etat_projet="SELECT etat_project FROM projects WHERE id_project=".$id."";
        $result_etat_projet = mysqli_query($link,$sql_recup_etat_projet);	
    $temp_projet = mysqli_fetch_array($result_etat_projet);?>
                <div style="margin-left:45%;margin-top:5%">
                    
              <a 
                  <?php if($temp_projet['etat_project']=='Cloturé'){
                      ?> 
                  href="#" Onclick="alert('Le projet est cloturer il est impossible d\'ajouter des onglets');"
              <?php } else{ ?> href="new_formulaire.php?parent=<?php echo $id; ?>"<?php } ?> class="btn btn-primary" >Nouveau Formulaire</a>
              
                </div>
       </div>
       </div> 
    
<?php
}
?>  
 <script>
function changerEtat(projet){
    var formulaire = window.document.changeretat;
    	  var e= document.getElementById("etat");
	  var etat = e.options[e.selectedIndex].value;
       
          if(etat==='En cours'){
                   if(confirm('Vous allez mettre en production le formulaire ' + projet +' souhaitez-vous donnez accès aux utilisateurs ?')){
  document.getElementById('changeretat').submit();
              }   
              
          }
          else if(etat==='Cloturé'){
              if(confirm('Vous allez clore le formulaire ' + projet +', le formulaire sera clos. Souhaitez vous r\351ellement clore le formulaire? ?')){
       document.getElementById('changeretat').submit();      
                  
        
              }
              
          }
          else{
     document.getElementById('changeretat').submit();
              
          }
    
    
}

</script>        
     <?php include("html/mainfooter.html");?>
