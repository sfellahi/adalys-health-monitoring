<?php
//This page let display the list of topics of a category
include('html/mainheader.php');
?>
 <div id="page-wrapper"> 
       <div class="main-page">
    <?php
if(isset($_GET['parent']))
{
	$id=$_GET['parent'];
	$dn1 = mysqli_query($link2,'select nom_onglet, id_onglet from onglet where id_formulaire = "'.$id.'" ORDER BY id_onglet ASC');
	
        
        $sql_liste_formulaire_plus_info_projet="SELECT etat_project, etat_formulaire FROM project_formulaire
LEFT JOIN projects ON projects.id_project = project_formulaire.id_project
LEFT JOIN formulaire ON formulaire.id_formulaire = project_formulaire.id_formulaire 
WHERE formulaire.id_formulaire=".$id."";
       $recup_etat = mysqli_query($link2,$sql_liste_formulaire_plus_info_projet); 
       $temp_etat=mysqli_fetch_array($recup_etat);
       
        ?>
	
          
    <table class="topics_table">
    <tr>
            <th class="forum_tops">Onglet</th>
    </tr>
    	<?php
    while($dnn1 = mysqli_fetch_array($dn1)){
      
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
                 <a href="new_onglet.php?parent=<?php echo $id; ?>" class="btn btn-primary">Nouvel Onglet</a>
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
     <?php include("html/mainfooter.html");?>