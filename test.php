

<form name="formulaireDynamique"  id="formulaireDynamique" method="POST" action="enregistrer.php">

<span class="formuajout questiontype">Type :</span>
<select id="typequestion" class="formuajout typeselect" Onchange="Formulaireadaptatif(this.value);">
<option value="selection">Selection</option>
<option value="texte">texte</option>
<option value="textarea">textarea</option>
<option value="number">nombre</option>
<option value="checkbox">checkbox</option>
<option value="radio">radio</option>
</select>

<span class="formuajout questionname">Nominatif (unique et sans espace) :</span>
 <input type="text" class="formuajout reponsename " id="name">

<span class="formuajout questionquestion">Question :</span>
 <input type="text" class="formuajout reponsequestion" id="question">

<span class="formuajout questionreponse">Reponses possibles<br/>(s&eacute;parer les r&eacute;ponses par ;) : </span>
<input type="text"  class="formuajout reponsereponse" id="reponses">

<span class="formuajout questionobligatoire">Champ obligatoire : </span>
<input type="radio"  class="formuajout reponseobligatoire1" name="required" id="oui" value="oui">
<span class="formuajout questionobligatoiretext1">Oui</span>
<input type="radio"  class="formuajout reponseobligatoire2" name="required" checked selected id="non" value="non">
<span class="formuajout questionobligatoiretext2">Non</span>

   <input type="button" onClick="ajout(this);" style="position:fixed;top:500px;left:530px;" value="ajouter un champ"/>

   <br /><br />
   <INPUT TYPE="text" NAME="value1">
   <input type="submit" style="" value="soumettre"/>
</form>
<SCRIPT LANGUAGE="javascript">

var locate = "test"
document.formulaireDynamique.value1.value = locate

</SCRIPT> 
