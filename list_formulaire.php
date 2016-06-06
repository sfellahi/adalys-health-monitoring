<?php
//This page let display the list of topics of a category
include('html/mainheader.php');
?>
 <div id="page-wrapper"> 
       <div class="main-page">
           <div class="row">
    <?php
if(isset($_GET['parent']))
{
	$id=$_GET['parent'];
	$dn1 = mysqli_query($link,'select id_formulaire from project_formulaire where id_project = "'.$id.'"');
     
	?>
	
          <a href="new_formulaire.php?parent=<?php echo $id; ?>" class="btn btn-primary">Nouveau Formulaire</a>
                    <table class="topics_table">
    <tr>
            <th class="forum_tops">Formulaire</th>
            <th class="forum_tops">Nb d'onglet</th>
            <th class="forum_tops">Onglets</th>
            <th class="forum_tops">Nb question</th>
            <th class="forum_tops">Etat</th>
            <th class="forum_tops">&nbsp;</th>
    </tr>
    	<?php
    while($dnn1 = mysqli_fetch_array($dn1)){
    $dn2 = mysqli_query($link,'select nom_formulaire,etat_formulaire from formulaire where id_formulaire = "'.$dnn1['id_formulaire'].'"');	
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
            <a href="list_onglet.php?parent=<?php echo $dnn1['id_formulaire']; ?>"><?php echo $dnn2['nom_formulaire']; ?>
        </td>
        <td>
        <?php echo $rowcountonglet;?> 
        </td>
         <td>
           <!--                <a href="list_onglet.php?parent=<?php// echo $dnn1['id_formulaire']; ?>" class="btn btn-info">
          <span class="glyphicon glyphicon-tasks"></span> Liste 
        </a>
            
            <a href="new_onglet.php?parent=<?php //echo $dnn1['id_formulaire'];?>" class="btn btn-primary">
                <span class="glyphicon glyphicon-wrench"></span> Nouveau</a></td> -->  
           
             <form action="list_onglet.php" style="display:inline;" method="POST" name="listeonglet">
                <input type="hidden" name="parent" value="<?php echo $dnn1['id_formulaire']; ?>"/> 
                <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-tasks"></span> Liste</button>   
             </form>
          <form action="new_onglet.php" method="POST" style="display:inline;" name="newonglet">
                <input type="hidden" name="parent" value="<?php echo $dnn1['id_formulaire']; ?>"/> 
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-wrench"></span> Nouveau</button>   
             </form>
             
                
            <td>
           <?php echo $rowcountquestion;?> 
               
        </td>
        <td>
           <form action="change_etat.php" name="changeretat" id="changeretat" method="post">
               <input type="hidden" value="<?php echo $dnn1['id_formulaire']; ?>" name="parentformulaire">
			<div>
			<select name="etat" id="etat" onChange="changerEtat('<?php echo $dnn2['nom_formulaire']; ?>')">
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
	
            
    
<?php
}
?>  
           </div>
       </div>
       </div>
     <?php include("html/mainfooter.html");?>
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