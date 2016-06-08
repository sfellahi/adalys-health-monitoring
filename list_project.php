<?php
include('html/mainheader.php');
?>
<div id="page-wrapper">
            <div class="main-page">
                <div class="row">
<table class="flat-table" border="0" id="tableprojet" cellspacing="0">
    <tr>
        <th>Nom du projet</th>
        <th style="width:10%">Date de creation</th>
        <th style="width:10%">Nb de patient</th>
        <th>Formulaires</th>
        <th>Etat du projet</th>
        <th>Lié un médecin</th>
        <th>Action</th>
    </tr>   
<?php
$dn1 = mysqli_query($link,'select id_project, nom_project, date_debut, nombre_patient, etat_project from projects');
if ($dn1) {
while($dnn1 = mysqli_fetch_array($dn1))
    {
    ?>
    <tr>
        <td class="forum_cat"><a href="info_project.php?parent=<?php echo $dnn1['id_project']; ?>"</a><?php echo $dnn1['nom_project']; ?></td>
        <td><?php echo $dnn1['date_debut']; ?></td>
        <td ><span style=""><?php echo $dnn1['nombre_patient']; ?></span></td>
        <td>
                 <!--   <form action="list_formulaire.php" style="display:inline;" method="POST" name="listeformulaire">
                <input type="hidden" name="parent" value="<?php //echo $dnn1['id_project']; ?>"/> 
                <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-tasks"></span> Liste</button>   
             </form>
              <form action="new_formulaire.php" method="POST" style="display:inline;" name="newformulaire">
                <input type="hidden" name="parent" value="<?php //echo $dnn1['id_project']; ?>"/> 
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-wrench"></span> Nouveau</button>   
             </form> -->
                 <a href="list_formulaire.php?parent=<?php  echo $dnn1['id_project']; ?>" class="btn btn-info">
          <span class="glyphicon glyphicon-tasks"></span> Liste 
        </a>
            
            <a <?php if($dnn1['etat_project']=='Cloturé'){?>
                href="#" Onclick="alert('Le projet est cloturer il est impossible d\'ajouter des formulaires');"
                <?php } else { ?>
                    href="new_formulaire.php?parent=<?php  echo $dnn1['id_project'];?>"
                    <?php } ?> class="btn btn-primary"><span class="glyphicon glyphicon-wrench"></span> Nouveau</a>
               
                </td>
                
        <td><form action="change_etat.php" name="changeretat" id="changeretat" method="POST">
               	<div>
                   
                     <input type="hidden" name="parentprojet" id="parentprojet" value="<?php echo $dnn1['id_project']; ?>" value="a">
			<select name="etat2" onChange="changerEtat('<?php echo $dnn1['nom_project']; ?>','<?php echo $dnn1['id_project']; ?>')" id="<?php echo $dnn1['id_project'];?>">
		  		<option value="<?php echo $dnn1['etat_project']; ?>" selected ><?php echo $dnn1['etat_project']; ?></option>
				<option value="En création">En création</option>
				<option value="En cours">En cours</option>
				<option value="Cloturé">Cloturé</option>
			</select>
                     
		
		    </div>
		 	</form>
 		</td>
 		
 		<form action="user_project.php?parent=<?php echo $dnn1['id_project']; ?>" method="post">
 			<td><select name="medecin">
 			<?php
 		$dn2 = mysqli_query($link,'select id, nom, prenom from users where profil = "medecin"'); 
 		while($dnn2 = mysqli_fetch_array($dn2)){
 			?>
		  	<option value="<?php echo $dnn2['id']; ?>"><?php echo $dnn2['nom'] ." ". $dnn2['prenom'] ; ?></option>
		  	<?php 
    		}
			?>
			</select>
			</td>
		
 			<td><button type="submit">Lié</button></td>
 			
 	<script>
function changerEtat(projet,num){
    var formulaire = window.document.changeretat;
    document.getElementById("parentprojet").value=num;
     
   	  var e= document.getElementById(num);
	  var etat = e.options[e.selectedIndex].value;
         
        

var input = document.createElement("input");

input.setAttribute("type", "hidden");

input.setAttribute("name", "etat");

input.setAttribute("value", etat);

//append to form element that you want .
document.getElementById("changeretat").appendChild(input);


          if(etat==='En cours'){
                   if(confirm('Vous allez mettre en production le projet ' + projet +' souhaitez-vous donnez accès aux utilisateurs ?')){
                    
                     document.getElementById('changeretat').submit();
              }   
              
          }
          else if(etat==='Cloturé'){
              if(confirm('Vous allez clore le projet ' + projet +' souhaitez-vous supprimer l\'acces de ce projet ?')){
          
                     document.getElementById('changeretat').submit();      
                  
        
              }
              
          }
          else{
         document.getElementById('changeretat').submit();
              
          }
    
    
}

</script>	

 		
    <?php
    }
    ?>
</table>
                </div>
    </div>
    </div>

<?php
}
 include("html/mainfooter.html");?>

