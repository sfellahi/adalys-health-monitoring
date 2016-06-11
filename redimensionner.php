<?php
// Cacher les warnings
ini_set("display_errors",0);error_reporting(0);
function modif_taille_img($photo,$hauteur,$largeur, $rep_Dst, $img_Dst){
				
$chemin="$rep_Dst/$img_Dst";

        $ListeExtension = array('jpg' => 'image/jpeg', 'jpeg'=>'image/jpeg');
        $ListeExtensionIE = array('jpg' => 'image/pjpeg', 'jpeg'=>'image/pjpeg');
        if (!empty($_FILES[$photo]))
        {
                if ($_FILES[$photo]['error'] <= 0)
                {
                        if ($_FILES[$photo]['size'] <= 20971520)
                        {
                            $ImageNews = $_FILES[$photo]['name'];
 
                            $ExtensionPresumee = "jpg";
                            
                              $ImageNews = getimagesize($_FILES[$photo]['tmp_name']);
                              if($ImageNews['mime'] == $ListeExtension[$ExtensionPresumee]  || $ImageNews['mime'] == $ListeExtensionIE[$ExtensionPresumee])
{
 
                                              $ImageChoisie = imagecreatefromjpeg($_FILES[$photo]['tmp_name']);
                                              $TailleImageChoisie = getimagesize($_FILES[$photo]['tmp_name']);
											  $NouvelleLargeur = $largeur; //Largeur choisie à 350 px mais modifiable
											  $NouvelleHauteur =( ($TailleImageChoisie[1] * (($NouvelleLargeur)/$TailleImageChoisie[0])) );   
 
                                              $NouvelleImage = imagecreatetruecolor($NouvelleLargeur , $NouvelleHauteur) or die ("Erreur");
 
                                              imagecopyresampled($NouvelleImage , $ImageChoisie  , 0,0, 0,0, $NouvelleLargeur, $NouvelleHauteur, $TailleImageChoisie[0],$TailleImageChoisie[1]);
                                              imagedestroy($ImageChoisie);
                                              $NomImageChoisie = "new.jpg";
                                              
                                              imagejpeg($NouvelleImage ,$chemin, 100);
										}
                                        else if($ImageNews['mime'] == "png"  || $ImageNews['mime'] == "png")
{
                                              $ImageChoisie = imagecreatefrompng($_FILES[$photo]['tmp_name']);
                                              $TailleImageChoisie = getimagesize($_FILES[$photo]['tmp_name']);
											  $NouvelleLargeur = $largeur; //Largeur choisie à 350 px mais modifiable
											  $NouvelleHauteur =( ($TailleImageChoisie[1] * (($NouvelleLargeur)/$TailleImageChoisie[0])) );   
 
                                              $NouvelleImage = imagecreatetruecolor($NouvelleLargeur , $NouvelleHauteur) or die ("Erreur");
 
                                              imagecopyresampled($NouvelleImage , $ImageChoisie  , 0,0, 0,0, $NouvelleLargeur, $NouvelleHauteur, $TailleImageChoisie[0],$TailleImageChoisie[1]);
                                              imagedestroy($ImageChoisie);
                                              $NomImageChoisie = "new.jpg";
                                              
                                              imagejpeg($NouvelleImage ,$chemin, 100);
										}
                                        else 
                                        {
                                                echo 'Le type MIME de l\'image n\'est pas bon';
                                        }                 
                                 
                        }
                        else
                        {
                                echo 'L\'image est trop lourde';
                        }
                }
                else
                {
                        echo 'Erreur lors de l\'upload image';
                }
        }


fctcropimage($largeur,$hauteur,0,0, $rep_Dst, $img_Dst);
}


function fctcropimage($W_fin, $H_fin, $rep_Dst, $img_Dst, $rep_Src, $img_Src) {
 // ---------------------
 $condition = 0;
 // Si certains paramètres ont pour valeur '' :
   if ($rep_Dst=='') { $rep_Dst = $rep_Src; } // (même répertoire)
   if ($img_Dst=='') { $img_Dst = $img_Src; } // (même nom)
 // ---------------------
 // si le fichier existe dans le répertoire, on continue...
 if (file_exists("$rep_Src/$img_Src")) { 
   // ----------------------
   // extensions acceptées : 
	$extension_Allowed = 'jpg,jpeg,png';	// (sans espaces)
   // extension fichier Source
	$extension_Src = strtolower(pathinfo($img_Src,PATHINFO_EXTENSION));
   // ----------------------
   // extension OK ? on continue ...
   if(in_array($extension_Src, explode(',', $extension_Allowed))) {
      // ------------------------
      // récupération des dimensions de l'image Source
      $img_size = getimagesize("$rep_Src/$img_Src");
      $W_Src = $img_size[0]; // largeur
      $H_Src = $img_size[1]; // hauteur
      // ------------------------------------------------
      // condition de crop et dimensions de l'image finale
      // ------------------------------------------------
      // A- crop aux dimensions indiquées
      if ($W_fin!=0 && $H_fin!=0) {
         $W = $W_fin;
         $H = $H_fin;
      }      // ------------------------
      // B- crop en HAUTEUR (meme largeur que la source)
      if ($W_fin==0 && $H_fin!=0) {
         $H = $H_fin;
         $W = $W_Src;
      }
      // ------------------------
      // C- crop en LARGEUR (meme hauteur que la source)
      if ($W_fin!=0 && $H_fin==0) {
         $W = $W_fin;
         $H = $H_Src;         
      }
      // D- crop "carre" a la plus petite dimension de l'image source
      if ($W_fin==0 && $H_fin==0) {
        if ($W_Src >= $H_Src) {
         $W = $H_Src;
         $H = $H_Src;
        } else {
         $W = $W_Src;
         $H = $W_Src;
        }   
      }
      // ------------------------
      // creation de la ressource-image "Src" en fonction de l extension
      switch($extension_Src) {
      case 'jpg':
      case 'jpeg':
         $Ress_Src = imagecreatefromjpeg("$rep_Src/$img_Src");
         break;
      case 'png':
         $Ress_Src = imagecreatefrompng("$rep_Src/$img_Src");
         break;
      }
      // ---------------------
      // creation d une ressource-image "Dst" aux dimensions finales
      // fond noir (par defaut)
      switch($extension_Src) {
      case 'jpg':
      case 'jpeg':
         $Ress_Dst = imagecreatetruecolor($W,$H);
         // fond blanc
         $blanc = imagecolorallocate ($Ress_Dst, 255, 255, 255);
         imagefill ($Ress_Dst, 0, 0, $blanc);
         break;
      case 'png':
         $Ress_Dst = imagecreatetruecolor($W,$H);
         // fond transparent (pour les png avec transparence)
         imagesavealpha($Ress_Dst, true);
         $trans_color = imagecolorallocatealpha($Ress_Dst, 0, 0, 0, 127);
         imagefill($Ress_Dst, 0, 0, $trans_color);
         break;
      }
      // ------------------------
      // CENTRAGE du crop
      // coordonnees du point d origine Scr : $X_Src, $Y_Src
      // coordonnees du point d origine Dst : $X_Dst, $Y_Dst
      // dimensions de la portion copiee : $W_copy, $H_copy
      // ------------------------
      // CENTRAGE en largeur
      if ($W_fin==0) {
         if ($H_fin==0 && $W_Src < $H_Src) {
            $X_Src = 0;
            $X_Dst = 0;
            $W_copy = $W_Src;
         } else {
            $X_Src = 0;
            $X_Dst = ($W - $W_Src) /2;
            $W_copy = $W_Src;
         }
      } else {
         if ($W_Src > $W) {
            $X_Src = ($W_Src - $W) /2;
            $X_Dst = 0;
            $W_copy = $W;
         } else {
            $X_Src = 0;
            $X_Dst = ($W - $W_Src) /2;
            $W_copy = $W_Src;
         }
      }
      // ------------------------
      // CENTRAGE en hauteur
      if ($H_fin==0) {
         if ($W_fin==0 && $H_Src < $W_Src) {
            $Y_Src = 0;
            $Y_Dst = 0;
            $H_copy = $H_Src;
         } else {
            $Y_Src = 0;
            $Y_Dst = ($H - $H_Src) /2;
            $H_copy = $H_Src;
         }
      } else {
         if ($H_Src > $H) {
            $Y_Src = ($H_Src - $H) /2;
            $Y_Dst = 0;
            $H_copy = $H;
         } else {
            $Y_Src = 0;
            $Y_Dst = ($H - $H_Src) /2;
            $H_copy = $H_Src;
         }
      }
      // ------------------------------------------------
      // CROP par copie de la portion d image selectionnee
		imagecopyresampled($Ress_Dst,$Ress_Src,$X_Dst,$Y_Dst,$X_Src,$Y_Src,$W_copy,$H_copy,$W_copy,$H_copy);
      // ------------------------------------------------
      // ENREGISTREMENT dans le repertoire (avec la fonction appropriee)
      switch ($extension_Src) { 
      case 'jpg':
      case 'jpeg':
         imagejpeg ($Ress_Dst, "$rep_Dst/$img_Dst");
         break;
      case 'png':
         imagepng ($Ress_Dst, "$rep_Dst/$img_Dst");
         break;
      }
      // ---------------------
      // liberation des ressources-image
      imagedestroy ($Ress_Src);
      imagedestroy ($Ress_Dst);
      // ---------------------
      $condition = 1;
   }
 }
 // ---------------------------------------------------
 // retourne : true si le redimensionnement et l'enregistrement ont bien eu lieu, sinon false
 if ($condition==1 && file_exists( "$rep_Dst/$img_Dst")) { return true; }
 else { return false; }
 // ---------------------------------------------------
};
?>