 <?php
//This page displays the list of the forum's categories
include('html/mainheader.php');
?>
 
<link href="styleflo.css" rel="stylesheet" type="text/css">
<div id="page-wrapper">
            <div class="main-page">
<body>
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
   <INPUT TYPE="hidden" NAME="value1">
   <input type="submit" style="" value="soumettre"/>
</form>
</body></div></div>
 <script>
 var arraybasededonnee = ["type","name","reponses","questions"];
 var arrayname= [];
 function in_array(string, array){
    var result = false;
    for(i=0; i<array.length; i++){
        if(array[i] == string){
            result = true;
        }
    }
    return result;
}

// suppression des champs inutiles 
function Formulaireadaptatif(choixdutype){
if((choixdutype=='texte')||(choixdutype=='number')||(choixdutype=='textarea')){
document.getElementById('reponses').disabled = true;
}
else{
document.getElementById('reponses').disabled = false;
}
if(choixdutype=='checkbox'){
document.getElementById('oui').disabled = true;
document.getElementById('non').disabled = true;
}
else{
document.getElementById('oui').disabled = false;
document.getElementById('non').disabled = false;
}
}
 function ajout(element){
	  var formulaire = window.document.formulaireDynamique;
	// On recuperer les data : name reponses question 
	  var question = document.getElementById("question").value;
	  var name = document.getElementById("name").value;
	  // test si le nominatif est présent et unique 
	  // test si la question est non null 
	  if(in_array(name, arrayname) || name=="" || question==""){
	  alert('Une question et une nominatif unique sont n\351c\351ssaire');
	  }
	  else{
	  var reponses = document.getElementById("reponses").value;
	  // On separes les réponses pour pouvoir créer les radio ou checkbox
	  var res = reponses.split(";");
	  // on recupere le nombre de reponse 
	  var taillereponses = res.length;
	   // On crée le bloc
      var bloc = document.createElement("p");
// On initialise le type 
	  var typechamp="input";
	  //  Mise en place des differents pattern 
	  // IL FAUT CREER UNE FONCTION QUI RETOURNE LE PATERN
	 var  patterndate="(0[1-9]|[12][0-9]|3[01])/(0[1-9]|1[012])/(19|20)[0-9]{2}";
	 var  patternchiffre="[0-9]";
// initialisation d'un saut de ligne 
	  var sautligne = document.createElement('br');
	  
	  // On crée une ligne avec la question
	  var nominatifquestion = document.createTextNode(question);
  
	  // On recupere le type de question
	  var e= document.getElementById("typequestion");
	  
	  // Si jamais le type est textarea on change le type crée
	  var type = e.options[e.selectedIndex].value;
	  	    // condition obligatoire 
	  if(document.getElementById("oui").checked){  var required = "oui";}
	  else{ var required = "non";}
	  
	  
	  // A PARTIR DE LA ON SEPARER LES TPES DE QUESTION
	  
	  
	  
	  if(type=='textarea'){
	  var typechamp="textarea";
	  }
	  // Si jamais c'est un checkbox ou une radio 
	  if(type=="radio" || type=="checkbox"){
	  if(reponses==""){
	  alert('des r\351ponses sont n\351c\351ssaires');
	  }
	  else{
	  // On crée les differentes radio et checkbox 
	  for (var i = 0; i < taillereponses; i++) {  
	  
	        var champ = document.createElement(typechamp);
      // Les valeurs encodée dans le formulaire seront stockées dans un tableau
      champ.name = name;
      
      champ.type = type;
	  
 if(type=="checkbox"){
// mise en place d'ID
	   champ.id="checkbox"+i; 
	   champ.className = "checkbox";
	  }
	  else{
		  
		  champ.className = "radio";
	  // Si le bouton radio est requis
	  	  	  if(required=="oui"){
	  champ.required="required";
	  }
	  // mise en place d'ID 
	   champ.id="radio"+i;
  }
	
      champ.value = res[i];
	    var nominatifreponses = document.createTextNode(res[i]);
		if(i=='0'){ 
		// On initialise une question et un saut de ligne
		bloc.appendChild(nominatifquestion);
		bloc.appendChild(sautligne);
		
		}
		// Pour chaque itération on met la reponse et le champ associé 
		bloc.appendChild(champ);
	  bloc.appendChild(nominatifreponses);
      
        }      var sup = document.createElement("input");
      sup.value = "-";
      sup.className = "bouton_supprimer";
      sup.type = "image";
	  sup.id = name;
      // Ajout de l'événement onclick
      sup.onclick = function onclick(event)
         {suppression(this,type,name,question,reponses,required);};
        
	// on met en place la question 

      // On crée un nouvel élément de type "p" et on insère le champ l'intérieur.


    //  formulaire.insertBefore(ajout, element);
      formulaire.insertBefore(sup, element);
      formulaire.insertBefore(bloc, element);
	  arrayname.push(type,name,question,reponses,required);
		}
}
else if(type=="selection"){
	  if(reponses==""){
	  alert('des r\351ponses sont n\351c\351ssaires');
	  } 
	  else{
      var champ = document.createElement("select");
	  
	  champ.name = name;
var champdebase = document.createElement("option");
 champ.appendChild(champdebase);
for (var j = 0; j < taillereponses; j++) {
    var option = document.createElement("option");
    option.value = res[j];
    option.text = res[j];
    champ.appendChild(option);
}
	  	  if(required=="oui"){
	  champ.required="required";
	  }
bloc.appendChild(nominatifquestion);
		bloc.appendChild(sautligne);
      bloc.appendChild(champ);
	        var sup = document.createElement("input");
      sup.value = "-";
      sup.className = "bouton_supprimer";
      sup.type = "image";
	  sup.id = name;
      // Ajout de l'événement onclick
      sup.onclick = function onclick(event)
         {suppression(this,type,name,question,reponses,required);};
        
	// on met en place la question 

      // On crée un nouvel élément de type "p" et on insère le champ l'intérieur.


    //  formulaire.insertBefore(ajout, element);
      formulaire.insertBefore(sup, element);
      formulaire.insertBefore(bloc, element);
	   arrayname.push(type,name,question,reponses,required);
}   }
	 else{
      var champ = document.createElement(typechamp);
      // Les valeurs encodée dans le formulaire seront stockées dans un tableau
      champ.name = name;
      champ.type = type;
	  champ.className = "input_text";
	  if(required=="oui"){ champ.required="required"; }
	
	  
// On ajoute les reponses possible dans le paragraphe 
		bloc.appendChild(nominatifquestion);
		bloc.appendChild(sautligne);
      bloc.appendChild(champ);
              var sup = document.createElement("input");
      sup.value = "-";
      sup.id = name;
      sup.className = "bouton_supprimer";
      sup.type = "image";
      // Ajout de l'événement onclick
      sup.onclick = function onclick(event)
	  
	  // ici on recupere le name de l'input pour pouvoir supprimer la ligne dans la bdd
         {suppression(this,type,name,question,reponses,required);};
// On insere la question dans le bloc avec le bouton de suppression
      formulaire.insertBefore(sup, element);
      formulaire.insertBefore(bloc, element);
	   arrayname.push(type,name,question,reponses,required);
        }


 } 
 document.formulaireDynamique.value1.value = arrayname;
   }
function suppression(element,type,name,question,reponses,required){
   var formulaire = window.document.formulaireDynamique;
    arrayname.splice(arrayname.indexOf(type),1);
    arrayname.splice(arrayname.indexOf(name),1);
    arrayname.splice(arrayname.indexOf(question),1);
    arrayname.splice(arrayname.indexOf(reponses),1);
    arrayname.splice(arrayname.indexOf(required),1);
   // alert(name);
   formulaire.removeChild(element.nextSibling);
   // Supprime le bouton de suppression
  
   formulaire.removeChild(element);
   document.formulaireDynamique.value1.value = arrayname;
}

</script>