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
        

	$dn1 = mysqli_query($link2,'select nom_onglet, id_onglet from onglet where id_formulaire = "'.$id.'" ORDER BY id_onglet ASC');
	
        
        $sql_liste_formulaire_plus_info_projet="SELECT etat_project,etat_formulaire,nom_formulaire FROM project_formulaire
LEFT JOIN projects ON projects.id_project = project_formulaire.id_project
LEFT JOIN formulaire ON formulaire.id_formulaire = project_formulaire.id_formulaire 
WHERE formulaire.id_formulaire=".$id."";
       $recup_etat = mysqli_query($link2,$sql_liste_formulaire_plus_info_projet); 
       $temp_etat=mysqli_fetch_array($recup_etat);
       
        ?>
	
          
    <table class="flat-table" id="tableonglet">
    <tr>
            <th>Onglet</th>
            <th>Formulaire</th>
            <th>Question</th>
            <th style="width:15%;">Nb question</th>
            <th>&nbsp;</th>
    </tr>
    	<?php
    while($dnn1 = mysqli_fetch_array($dn1)){
                      $sql_count_question="SELECT id_question from ordre_question where id_onglet=".$dnn1['id_onglet']."";
        $result_count_question=mysqli_query($link,$sql_count_question);
         $rowcountquestion=mysqli_num_rows($result_count_question);
        ?>
    <tr>
    	<td>
       <?php 
       if($temp_etat['etat_project']=="Cloturé"){
        ?>
            <a href="" Onclick="alert('Le projet est clotur\351 aucune question ne peux etre ajouter')"><?php echo $dnn1['nom_onglet']; ?></a>
      
          <?php 
       }
       else{
           if($temp_etat['etat_formulaire']=="Cloturé" || $temp_etat['etat_formulaire']=='En cours'){
             ?>  <a href="" Onclick="alert('Le formulaire est en production ou bien clotur\351 aucune question ne peux etre ajouter')"><?php echo $dnn1['nom_onglet']; ?></a>
       
           <?php    
           }else{
       ?>    
                 <a href="formulaire.php?id=<?php echo $dnn1['id_onglet']; ?>"><?php echo $dnn1['nom_onglet']; ?></a>
       <?php    
           } }
       ?>     
            
         </td>
         <td><?php echo $temp_etat['nom_formulaire']; ?></td>
         <td>
                    <?php 
       if($temp_etat['etat_project']=="Cloturé"){
        ?>
            <a href="" Onclick="alert('Le projet est clotur\351 aucune question ne peux etre ajouter')"  class="btn btn-info">Ajouter</a>
      
          <?php 
       }
       else{
           if($temp_etat['etat_formulaire']=="Cloturé" || $temp_etat['etat_formulaire']=='En cours'){
             ?>  <a href="" Onclick="alert('Le formulaire est en production ou bien clotur\351 aucune question ne peux etre ajouter')" class="btn btn-info">Ajouter</a>
       
           <?php    
           }else{
       ?>    
                 <a href="formulaire.php?id=<?php echo $dnn1['id_onglet']; ?>" class="btn btn-info">Ajouter</a>
       <?php    
           } }
       ?>     
            
         </td>
          <td><?php echo $rowcountquestion; ?></td>
           <td>
             <form action="supp_onglet.php"  method="POST" name="suppformulaire">
                <input type="hidden" name="parent" value="<?php echo $dnn1['id_onglet']; ?>"/> 
                <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Supprimer</button>   
             </form>
           </td>
    </tr>
    <?php
    }
    ?>
    </table>
           <?php $sql_formulaire_clos="SELECT etat_formulaire FROM formulaire WHERE id_formulaire=".$id."";
           
           ?>
	
              <?php 
       if($temp_etat['etat_project']=="Cloturé"){
        ?>
            <a href="" Onclick="alert('Le projet est clotur\351 aucun onglet ne peux etre ajouter')"class="btn btn-primary">Nouvel Onglet</a>
      
          <?php 
       }
       else{
           if($temp_etat['etat_formulaire']=="Cloturé" || $temp_etat['etat_formulaire']=='En cours'){
             ?>  <a href="" Onclick="alert('Le formulaire est en production ou bien clotur\351 aucun onglet ne peux etre ajouter')" class="btn btn-primary">Nouvel Onglet</a>
       
           <?php    
           }else{
       ?>    
                 <a href="new_onglet.php?parent=<?php echo $id; ?>" style="margin-left:45%;" class="btn btn-primary">Nouvel Onglet</a>
       <?php    
           } }
       ?>       
    
<?php
}
else{
    ?>
Aucun formulaire n\'a été séléctionner    
   <?php 
}
?>  
           </div>
       </div>
       </div>
     <?php include("html/mainfooter.html");?>