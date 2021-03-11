<!doctype html>
<?php
//PREPARATION PANIER
session_start();

if (!isset ($_SESSION['idCdPanier'])) 	//Le mécanisme panier fonctionne comme suit : 
	$_SESSION['idCdPanier'] = '';		//une chaine idCdPanier contient la liste des id ajoutés au panier (espacés d'un '_')
										//le panier récupère ensuite cette chaine (passée en var de session) et la traite
										///ICI : on initialise juste l'idCdPanier à vide lors de l'arrivée sur le site

if (isset ($_POST['ajoutPanier']))
	$_SESSION['idCdPanier']=$_SESSION['idCdPanier'].$_POST['idCD'].'_'; //Si clique sur 'AJouter au panier' -> concatene '$idCd' + '_' à '$idCdPanier'
   
?>

<html lang="fr">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="styles.css" />
		<title>Notre jolie page de cd ♥UwU♥</title>
		
		<!--BOUTONS D'ACTION : 'Panier' & 'Je suis administrateur!' -->
		<aside><FORM ACTION="panier.php" method="post"><INPUT type="submit" value="Panier"></FORM></aside>
		<absolute><FORM ACTION="login_adminRoom.php"> <INPUT type="submit" value="Je suis administrateur!"></FORM></absolute>
	</head>
	<body>
		<h1>Une sélection d'album spécialement crée par notre équipe d'experts♥</h1>
		<h2>♥Laissez vous tenter♥...</h2> <br>
		
		<table><?php
		//AFFICHAGE - dynamique - DES CDs & DES BTNs 'Ajouter au panier' (associés aux CDs)
			//préparation
			$objetXML = simplexml_load_file('stockage.xml'); 	//On charge l'objet XML depuis notre stockage
			$largeurIMG = 100; $hauteurIMG = $largeurIMG;		// largeur des images à afficher
			
			foreach ($objetXML->listeCD as $niv1){ 	//les niveaux représentes les différents niveaux du fichier XML, plus on plonge en profondeur dans les données, plus le niv augmente
				foreach ($niv1 as $niv2){ 			//niv1 = <listeCD> / niv2 = <CD> 
					echo "<tr>";
						$id = $niv2->attributes(); //id du CD courant
						
						?><form action="" method="post"> <!--bouton 'ajouter au panier'-->
							<input type="hidden" name="idCD" value="<?php echo $id?>">
							<input type="hidden" name="idCdPanier" value="<?php echo $_SESSION['idCdPanier']?>">
							<input type="submit" name="ajoutPanier" value="Ajouter au panier">
						</form><br><?php
						 	
						///TEST d'affichage d'une image redimensionnée ... ECHEC	
								// $imageDorigine = 'imagetest.jpg';
								// header('Content-Type: image/jpeg');
								
								// list($largeurIMGDorigine, $hauteurIMGDorigine) = getimagesize($imageDorigine);
								
								// $image_rszd = imagecreatetruecolor($largeurIMG, $hauteurIMG);
								// $image = imagecreatefromjpeg($imageDorigine);
								// imagecopyresampled($image_rszd, $image, 0, 0, 0, 0, $largeurIMG, $hauteurIMG, $largeurIMGDorigine, $hauteurIMGDorigine);
							
								// imagejpeg($image_rszd, null, 100);
								//echo $image_rszd;
						
						//affichage des données du CD courant
						echo "<a href=album.php?id=$id> <img src=$niv2->pochette height=$largeurIMG width=$hauteurIMG class = 'miniature'> </a>";
						echo ' '.$niv2->titre.' : '.$niv2->prix.'€'; echo'<br>'; echo'<br>'; 
						
					echo "</tr>";
				}
			}
		?></table>
	</body>