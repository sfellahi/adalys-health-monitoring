    <?php
include("html/mainheader.html");
include("html/menu.html");
?>
<div id="page-wrapper">
<div class="main-page">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Un syst&egrave;me d'onglet en javascript</title>
    <script type="text/javascript">
        //<!--
                function change_onglet(name)
                {
                        document.getElementById('onglet_'+anc_onglet).className = 'onglet_0 onglet';
                        document.getElementById('onglet_'+name).className = 'onglet_1 onglet';
                        document.getElementById('contenu_onglet_'+anc_onglet).style.display = 'none';
                        document.getElementById('contenu_onglet_'+name).style.display = 'block';
                        anc_onglet = name;
                }
        //-->
        </script>
    <style type="text/css">
        .onglet
        {
                display:inline-block;
                margin-left:3px;
                margin-right:3px;
                padding:3px;
                border:1px solid black;
                cursor:pointer;
        }
        .onglet_0
        {
                background:#bbbbbb;
                border-bottom:1px solid black;
        }
        .onglet_1
        {
                background:#dddddd;
                border-bottom:0px solid black;
                padding-bottom:4px;
        }
        .contenu_onglet
        {
                background-color:white;
                border:1px solid black;
                margin-top:-1px;
                padding:5px;
                display:none;
        }
        ul
        {
                margin-top:0px;
                margin-bottom:0px;
                margin-left:-10px
        }
        h1
        {
                margin:0px;
                padding:0px;
        }
        </style>
</head>
<body>
        <div class="systeme_onglets">
        <div class="onglets">
            <span class="onglet_0 onglet" id="onglet_identification" onclick="javascript:change_onglet('identification');">identification</span>
            <span class="onglet_0 onglet" id="onglet_horaire_maladie" onclick="javascript:change_onglet('horaire_maladie');">horaire_maladie</span>
            <span class="onglet_0 onglet" id="onglet_traitement_antérieur" onclick="javascript:change_onglet('traitement_antérieur');">traitement_antérieur</span>
        </div>
        <div class="contenu_onglets">
            <div class="contenu_onglet" id="contenu_onglet_identification">
                <h1>identification?</h1>
                Un simple syst&egrave;me d'onglet utilisant les technologies:<br />
                          <html>
    <head>
    <title>Accueil</title>
    </head>

    <body>
    Connexion à l'espace membre :<br />
    <form action="index_membre.php" method="post">
    Login : <input type="text" name="login" value="<?php if (isset($_POST['login'])) echo stripslashes(htmlentities(trim($_POST['login']))); ?>"><br />
    Mot de passe : <input type="password" name="pass" value="<?php if (isset($_POST['pass'])) echo stripslashes(htmlentities(trim($_POST['pass']))); ?>"><br />
    <input type="submit" name="connexion" value="Connexion">
    </form>
    <a href="inscription.php">Vous inscrire</a>
    <?php
    if (isset($erreur)) echo '<br /><br />',$erreur;
    ?>
    </body>
    </html>
            </div>
            <div class="contenu_onglet" id="contenu_onglet_horaire_maladie">
                <h1>horaire maladie?</h1>
   
            </div>
            <div class="contenu_onglet" id="contenu_onglet_traitement_antérieur">
                <h1>traitement antérieur?</h1>
                Pour simplifier la navigation et la diviser en parties
            </div>
        </div>
    </div>
    <script type="text/javascript">
        //<!--
                var anc_onglet = 'identification';
                change_onglet(anc_onglet);
        //-->
        </script>
</body>
</html>