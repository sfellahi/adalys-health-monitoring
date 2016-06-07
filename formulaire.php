<?php
include('html/mainheader.php');
$id=$_GET['id'];?> 

<script>
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
		if(i==='0'){ 
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
</script>
<style>
   #question_formulaire{
        background-color:#EEEEEE;
        border-radius:10px;
        padding-left:5px;
        padding-top:5px;
        padding-bottom:5px;
        width:50%; 
        display:block;
    
    }
    .formuajout{
float:left;
margin-left:50%;
	min-width: 150px;
position:fixed;
width:20%;

}
.questiontype{
color:white;
}

.typeselect{
margin-top:30px;

}
.questionname{
margin-top:60px;
color:white;
}
.reponsename{
margin-top:90px;
}
.questionquestion{
margin-top:120px;
color:white;
}
.reponsequestion{
margin-top:150px;
}
.questionreponse{
margin-top:180px;
color:white;
}
.reponsereponse{
margin-top:210px;
}

.bouton_ajouter{
    
    top:450px;
}
.bouton_supprimer{
position:absolute;
margin-top:25px;
margin-left:250px;


}
.questionobligatoire{
margin-top:240px;

 }

.reponseobligatoire1{
top:375px;
padding-left:50%;
 }
 .reponseobligatoire2{
top:375px;

 }
 .questionobligatoiretext1{
margin-top:270px;
	font-family: 'Roboto Condensed', sans-serif;
    font-size: 100%;
 }
 .questionobligatoiretext2{
margin-top:270px;
	font-family: 'Roboto Condensed', sans-serif;
    font-size: 100%;
  padding-left:75px;
 }

 #blockdequestion{

margin-left:50%;
	min-width: 170px;
position:fixed;
width:25%;
height:440px;
border:8px solid #2a2f43;
margin-left:48%;
margin-top:-20px;
background-color:#65709D;
}

 *[class*="entypo-"]:before {
  font-family: 'entypo', sans-serif;
}

.buka {
  text-align:center;
  font-weight: bold;
  letter-spacing:1px;
  color:#fff;
  opacity:0;
  -webkit-transition: .5s;
  -ms-transition: .5s;
  -o-transition: .5s;
  transition:.5s ;
}
.buka a {
  color:#6fcbed;
  text-decoration:none;
}
#oui:checked ~ .buka{
  opacity:1;
  letter-spacing:2px;
}
input[type="checkbox"] {
  display:none;
}
#loadcheck {
  position:absolute;
  left:0;
  right:0;
  margin:30px auto;
}

.loadcheck {
  width:165px;
  height:40px;
  font-size:35px;
}
.loadcheck span {float:left;}
.load {
  display:block;
  width:7px;
  height:7px;
  margin:20px 5px;
  border-radius:10px;
  transition:.5s;
  cursor:pointer;
}
.load:nth-child(2){
  background:#db1536;
}
.load:nth-child(3){
  background:rgba(219, 21, 54,.7);
}
.load:nth-child(4){
  background:rgba(219, 21, 54,.5);
}
.load:nth-child(5){
  background:rgba(219, 21, 54,.3);
}
.load:nth-child(6){
  background:rgba(219, 21, 54,.1);
}
span[class*="entypo"]{cursor:pointer;}
span[class*="cancel"]{
  font-size:40px;
  color:#db1536;
  transition:.5s;
  transition-delay:.1s;
}
span[class*="oui"]{
  color:rgba(0,0,0,.1);
  transition:.5s;
  transition-delay:.1s;
}
#oui:checked + .loadcheck .entypo-check{
  color:#58d37b;
}
#oui:checked + .loadcheck .entypo-cancel{
  color:rgba(0,0,0,.1);
}
#oui:checked + .loadcheck .load:nth-child(2){
  background:rgba(88, 211, 123,.1);
}
#oui:checked + .loadcheck .load:nth-child(3){
  background:rgba(88, 211, 123,.3);
}
#oui:checked + .loadcheck .load:nth-child(4){
  background:rgba(88, 211, 123,.5);
}
#oui:checked + .loadcheck .load:nth-child(5){
  background:rgba(88, 211, 123,.7);
}
#oui:checked + .loadcheck .load:nth-child(6){
  background:#58d37b;
}

</style>

 
<link href="styleflo.css" rel="stylesheet" type="text/css">
<div id="page-wrapper" >
            <div class="main-page" >
                <div class="row">
<body >

    <div>
        <div id="blockdequestion"></div>     
<form name="formulaireDynamique" style="" id="formulaireDynamique" method="POST" action="enregistrer.php">
<span class="formuajout questiontype">Type :</span>
<select id="typequestion" class="formuajout typeselect" style="color:black;" Onchange="Formulaireadaptatif(this.value);">
<option value="selection">Selection</option>
<option value="text">texte</option>
<option value="textarea">textarea</option>
<option value="number">nombre</option>
<option value="checkbox">checkbox</option>
<option value="radio">radio</option>
</select>
<input type="hidden" value="<?php echo $id; ?>" name="id">
<span class="formuajout questionname">Identifiant (unique et sans espace) :</span>
 <input type="text" class="formuajout reponsename " id="name">

<span class="formuajout questionquestion">Question :</span>
 <input type="text" class="formuajout reponsequestion" id="question">

<span class="formuajout questionreponse">Reponses s&eacute;parer par ";" : </span>
<input type="text"  class="formuajout reponsereponse" id="reponses">

<span class="formuajout questionobligatoire">Champ obligatoire : </span>

<input type="checkbox" class=""  name="required" id="oui" value="oui">
<label for="oui" class="loadcheck miseenplace" style="margin-top:270px;margin-left:56%;" id="loadcheck">
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
   <input type="submit" style="" value="soumettre"/>
</form>       

    </div>

</body>
            </div>
</div></div>

<script src="fonctionjs.js"></script>
  <?php include('html/mainfooter.html');?>  

