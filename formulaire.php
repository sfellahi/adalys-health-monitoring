<?php
include('html/mainheader.php');
mysqli_set_charset($link, "utf8");
$id=$_GET['id'];
$select_id_form="SELECT id_formulaire FROM ordre_question WHERE id_onglet=".$id."";
$result_id_form=  mysqli_query($link, $select_id_form);
$temp_id=mysqli_fetch_array($result_id_form);
$select_name="SELECT colonne_assoc FROM ordre_question WHERE id_onglet!=".$id." AND id_formulaire=".$temp_id['id_formulaire']."";
$othername=array();
if($request_name=  mysqli_query($link, $select_name)){

while($temp_name=  mysqli_fetch_array($request_name)){
    
    $othername[]=$temp_name['colonne_assoc'];
}
}
function php2js ($var) {
    if (is_array($var)) {
        $res = "[";
        $array = array();
        foreach ($var as $a_var) {
            $array[] = php2js($a_var);
        }
        return "[" . join(",", $array) . "]";
    }
    elseif (is_bool($var)) {
        return $var ? "true" : "false";
    }
    elseif (is_int($var) || is_integer($var) || is_double($var) || is_float($var)) {
        return $var;
    }
    elseif (is_string($var)) {
        return "\"" . addslashes(stripslashes($var)) . "\"";
    }
    // autres cas: objets, on ne les gère pas
    return FALSE;
}
  $js = php2js($othername); // [1,2,[3,4],5,'salut',true]
?>
<link href="css/formulaire.css" rel="stylesheet"> 
<script>
  var tableau_anc_name =<?php echo $js; ?>;
 function no_accent(my_string)
{
// tableau accents
		var pattern_accent = new Array(/À/g, /Á/g, /Â/g, /Ã/g, /Ä/g, /Å/g, /Æ/g, /Ç/g, /È/g, /É/g, /Ê/g, /Ë/g,
		/Ì/g, /Í/g, /Î/g, /Ï/g, /Ð/g, /Ñ/g, /Ò/g, /Ó/g, /Ô/g, /Õ/g, /Ö/g, /Ø/g, /Ù/g, /Ú/g, /Û/g, /Ü/g, /Ý/g,
		/Þ/g, /ß/g, /à/g, /á/g, /â/g, /ã/g, /ä/g, /å/g, /æ/g, /ç/g, /è/g, /é/g, /ê/g, /ë/g, /ì/g, /í/g, /î/g,
		/ï/g, /ð/g, /ñ/g, /ò/g, /ó/g, /ô/g, /õ/g, /ö/g, /ø/g, /ù/g, /ú/g, /û/g, /ü/g, /ý/g, /ý/g, /þ/g, /ÿ/g);
 
		// tableau sans accents
		var pattern_replace_accent = new Array("A","A","A","A","A","A","A","C","E","E","E","E",
		"I","I","I","I","D","N","O","O","O","O","O","O","U","U","U","U","Y",
		"b","s","a","a","a","a","a","a","a","c","e","e","e","e","i","i","i",
		"i","d","n","o","o","o","o","o","o","u","u","u","u","y","y","b","y");
 
		//pour chaque caractere si accentué le remplacer par un non accentué
		for(var i=0;i<pattern_accent.length;i++)
		{
			my_string = my_string.replace(pattern_accent[i],pattern_replace_accent[i]);
		}
		return my_string;
}

    var arrayname= []; 
    function appelFonction(type1,name1,question1,reponse1,required1){

    var element= document.getElementById("ajouter");
    var formulaire = window.document.formulaireDynamique;
    var type= type1;
    var name= name1;
    var question= question1;
    var reponses= reponse1;
    var required= required1;
    
	  var res = reponses.split(";");
	  // on recupere le nombre de reponse 
	  var taillereponses = res.length;
	   // On crée le bloc
      var bloc = document.createElement("p");
      bloc.id = "question_formulaire";
// On initialise le type 
	  var typechamp="input";
	  //  Mise en place des differents pattern 
	  // IL FAUT CREER UNE FONCTION QUI RETOURNE LE PATERN
	// var  patterndate="(0[1-9]|[12][0-9]|3[01])/(0[1-9]|1[012])/(19|20)[0-9]{2}";
	// var  patternchiffre="[0-9]";
// initialisation d'un saut de ligne 
	  var sautligne = document.createElement('br');
          var espace = document.createTextNode('aaa');
	  
	  // On crée une ligne avec la question
	  var nominatifquestion = document.createTextNode(question);	  
	  // A PARTIR DE LA ON SEPARER LES TPES DE QUESTION	  
	  if(type==='textarea'){
	  var typechamp='textarea';	  }
	  // Si jamais c'est un checkbox ou une radio 
	  if(type==='radio' || type==='checkbox'){
	
	  // On crée les differentes radio et checkbox 
	  for (var i = 0; i < taillereponses; i++) {  
	  
	        var champ = document.createElement(typechamp);
      // Les valeurs encodée dans le formulaire seront stockées dans un tableau
      champ.name = name;
      
      champ.type = type;
	  
 if(type==='checkbox'){
// mise en place d'ID
	   champ.id="checkbox"+i; 
	   champ.className = "stylecheckbox";
	  }
	  else{
		  
		  champ.className = 'styleradio';
	  // Si le bouton radio est requis
	  	  	  if(required==='oui'){
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
               
      
        }      var sup = document.createElement("button");
      sup.value = "";
      sup.className = "bouton_supprimer";
      // sup.type = "image";
	  sup.id = name;
      // Ajout de l'événement onclick
      sup.onclick = function onclick(event)
         {suppression(this,type,name,question,reponses,required);};
      formulaire.insertBefore(sup, element);
      formulaire.insertBefore(bloc, element);
        arrayname.push(type,name,question,reponses,required);
		
}
else if(type==="selection"){
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
	  	  if(required==="oui"){
	  champ.required="required";
	  }
bloc.appendChild(nominatifquestion);
		bloc.appendChild(sautligne);
      bloc.appendChild(champ);
	        var sup = document.createElement("button");
      sup.value = "";
      sup.className = "bouton_supprimer";
      //sup.type = "image";
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
	 else{
      var champ = document.createElement(typechamp);
      // Les valeurs encodée dans le formulaire seront stockées dans un tableau
      champ.name = name;
      champ.type = type;
	  champ.className = "input_text";
	  if(required==="oui"){ champ.required="required"; }
	
	  
// On ajoute les reponses possible dans le paragraphe 
		bloc.appendChild(nominatifquestion);
		bloc.appendChild(sautligne);
      bloc.appendChild(champ);
              var sup = document.createElement("button");
      sup.value = "";
      sup.id = name;
      sup.className = "bouton_supprimer";
    //  sup.type = "image";
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
</script>
<style>

</style>

 
<link href="styleflo.css" rel="stylesheet" type="text/css">
<div id="page-wrapper" >
            <div class="main-page" >
                <div class="row">
<body >

    <div>
        <div id="blockdequestion"></div>     
<form name="formulaireDynamique" style="" id="formulaireDynamique" method="POST" onkeypress="refuserToucheEntree(event);" action="enregistrer.php">
<span class="formuajout questiontype">Type :</span>
<select id="typequestion" class="formuajout typeselect" style="color:black;" Onchange="Formulaireadaptatif(this.value);">
<option value="selection">Selection</option>
<option value="text">Champ de caractère</option>
<option value="textarea">Grand champ de caractère</option>
<option value="number">Champ de nombre uniquement</option>
<option value="checkbox">Case à cocher</option>
<option value="radio">Une seule réponse parmi plusieurs</option>
</select>
<input type="hidden" value="<?php echo $id; ?>" name="id">
<span class="formuajout questionname">Id (unique, sans espace, sans accents) :</span>
<input type="text" class="formuajout reponsename " id="name" onkeydown="this.value=no_accent(this.value);this.value=this.value.replace(/ /g, '_');"  onkeyup="this.value=no_accent(this.value);this.value=this.value.replace(/ /g, '_');">

<span class="formuajout questionquestion">Question :</span>
 <input type="text" class="formuajout reponsequestion" id="question">

<span class="formuajout questionreponse">Reponses s&eacute;parer par ";" : </span>
<input type="text"  class="formuajout reponsereponse" id="reponses">

<span class="formuajout questionobligatoire">Champ obligatoire : </span>

<input type="checkbox" class="boutoncheckbox"  name="required" id="oui" value="oui">
<label for="oui" class="loadcheck miseenplace" style="margin-top:360px;margin-left:11%;" id="loadcheck">
  <span class="entypo-cancel">&#10008;</span>
  <span class="load"></span>
  <span class="load"></span>
  <span class="load"></span>
  <span class="load"></span>
  <span class="load"></span>
  <span class="entypo-check">&#10004;</span>
</label>
<!--
<input type="radio"  class="formuajout reponseobligatoire1 " name="required" id="oui" value="oui">
<label for="oui" class="formuajout questionobligatoiretext1">Oui&nbsp;&nbsp;</label>

<input type="radio"  class="formuajout reponseobligatoire2" name="required" checked selected id="non" value="non">
  <label for="non" class="formuajout questionobligatoiretext2">Non&nbsp;&nbsp;</label> -->
<input type="button" class="formuajout bouton_ajouter btn btn-success" id="ajouter" name="ajouter" onClick="ajout(this);" style="" value="ajouter un champ"/>

   <br /><br />
    <?php 
$sql_recup_question="SELECT id_question, type_question, id_type, colonne_assoc, qrequired FROM ordre_question WHERE id_onglet=".$id."";
$result_question = mysqli_query($link2,$sql_recup_question);
if ($result_question) {

while($temp_question = mysqli_fetch_array($result_question))
    {
    $typequestion=$temp_question['type_question'];
    if($temp_question['type_question']=="number"){
     $typequestion="text" ;
    }
    $colonne_assoc=$temp_question['colonne_assoc']; 
   $qrequired=$temp_question['qrequired'];
    if($typequestion=="checkbox" || $typequestion=="radio" || $typequestion=="select"){
    $sql_recup_question_reponses="SELECT question,reponse_".$typequestion." FROM ".$typequestion." WHERE id_".$typequestion."=".$temp_question['id_type']."";
    $result_recup_question_reponses = mysqli_query($link2,$sql_recup_question_reponses);
    while($temp_recup_question_reponses = mysqli_fetch_array($result_recup_question_reponses))
    {
     $question=$temp_recup_question_reponses['question']; 
     $a="reponse_".$typequestion."";
     $reponses=$temp_recup_question_reponses[$a];     
    }
    }
    else{
    $sql_recup_question="SELECT question FROM ".$typequestion." WHERE id_".$typequestion."=".$temp_question['id_type']."";
    $result_recup_question = mysqli_query($link2,$sql_recup_question);
    while($temp_recup_question = mysqli_fetch_array($result_recup_question))
    {
       $question=$temp_recup_question['question']; 
           if($temp_question['type_question']=="number"){
     $reponses="number" ;
    }
       $reponses="NULL"; 
    }
    }
echo "<script>appelFonction('".$typequestion."','".$colonne_assoc."','".$question."','".$reponses."','".$qrequired."');</script>";
}
    }
?>

   <INPUT TYPE="hidden" NAME="value1">
   <input type="submit" class="btn btn-info" style="margin-left:65%" value="soumettre"/>
   <div class="blocvide">&nbsp;</div>
</form>       

    </div>

</body>
            </div>
</div></div>


<script src="fonctionjs.js"></script>
  <?php include('html/mainfooter.html');?>  

<script>
    
    function refuserToucheEntree(event)
{
    // Compatibilité IE / Firefox
    if(!event && window.event) {
        event = window.event;
    }
    // IE
    if(event.keyCode == 13) {
        event.returnValue = false;
        event.cancelBubble = true;
    }
    // DOM
    if(event.which == 13) {
        event.preventDefault();
        event.stopPropagation();
    }
}

    </script>