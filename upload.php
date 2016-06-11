<?php include("html/mainheader.php");
// Cacher les warnings
ini_set("display_errors",0);error_reporting(0);

      if(!empty($_FILES['fichier_upload']['name']))
      {
        // on récupère les infos du fichier à uploader
        $fichier_temp = $_FILES['fichier_upload']['tmp_name'];
        $fichier_nom = $_FILES['fichier_upload']['name'];

        // on défini les dimensions et le type du fichier
        list($fichier_larg, $fichier_haut, $fichier_type, $fichier_attr)=getimagesize($fichier_temp);

        // infos de contrôle du fichier
        $fichier_poids_max = 500000;
        $fichier_h_max = 2448;
        $fichier_l_max = 3264;

        // dossier de destination
        $fichier_dossier = 'upload/users/';

        // extension du fichier
        $fichier_ext = "jpg";

        // on renomme le fichier
        $fichier_n_nom = $_SESSION['userid'].".".$fichier_ext;

        // on vérifie s'il y a bien un fichier à uploader
        if (!empty($fichier_temp) && is_uploaded_file($fichier_temp))
        {
          // on vérifie le poids du fichier
          if (filesize($fichier_temp)<$fichier_poids_max)
          {
            // types de fichiers autorises 1=gif / 2=jpg / 3=png
            if (($fichier_type===1) || ($fichier_type===2) || ($fichier_type===3))
            {
              // on vérifie si l'image n'est pas trop grande
              if (($fichier_larg<=$fichier_l_max) && ($fichier_haut<=$fichier_h_max))
              {
                // si le fichier est ok, on l'upload sur le serveur
                if (move_uploaded_file($fichier_temp, $fichier_dossier.$fichier_n_nom))
                {
                	$filename = $fichier_dossier.$fichier_n_nom;
                	
                	// Définition de la largeur et de la hauteur maximale
                	$width = 80;
                	$height = 50;
                	
                	// Cacul des nouvelles dimensions
                	list($width_orig, $height_orig) = getimagesize($filename);
                	
                	$ratio_orig = $width_orig/$height_orig;
                	
                	if ($width/$height > $ratio_orig) {
                		$width = $height*$ratio_orig;
                	} else {
                		$height = $width/$ratio_orig;
                	}
                	
                	// Redimensionnement
                	$image_p = imagecreatetruecolor($width, $height);
                	$image = imagecreatefromjpeg($filename);
                	imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
                	
                	// Affichage
                	imagejpeg($image_p, $fichier_dossier.$fichier_n_nom, 100);
                	?><div id="page-wrapper">
                	<div class="main-page">Le fichier a bient été uploadé.
                	</div></div><?php
                }
                else
                  echo "Le fichier n'a pas pu être uploadé<br />";
              }
              else
                echo "Le fichier est trop grand<br />";
            }
            else
              echo "Le fichier n'a pas le bon format<br />";
          }
          else
            echo "Le fichier est trop lourd<br />";
        }
        else
          echo "Pas de fichier à uploader<br />";
      }
?>
<?php include("html/mainfooter.html");?>