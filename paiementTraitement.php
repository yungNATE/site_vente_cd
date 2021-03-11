<?php
session_start();
?>

<html>  
	<head>
		<title>Paiement en cours</title>
		<link rel="stylesheet" href="main.css"/>
	</head>
	<body>
		<?php
		$etatPayement = ''; //On initalise l'état du payement
		$longueur_numCB = strlen( $_POST['numCB'] );
		
		//on passe par des objets de date afin de faciliter l'ajout d'un interval de temps
		$dateActuelle = new DateTime( date('m/y') ); 
		$dateActuelleP3M = $dateActuelle->add( new DateInterval('P3M') );
		$dateEntree = new DateTime( $_POST['dateExpi'] );

		$dateActuelleP3M = $dateActuelleP3M->format('m-y'); 
		$dateEntree = $dateEntree->format('m-y'); //permet de normaliser l'input de l'utilisateur


		if ( $longueur_numCB == 16 ){ 										//on vérifie si l'utilisateur à bien entré 16 caractères : permet d'éviter toute erreur si l'utilisateur laisse le champs vide
			if ( $_POST['numCB']{0} == $_POST['numCB']{$longueur_numCB-1}){ //premier caract = dernier caract de numCB
				if ( $dateEntree > $dateActuelleP3M ){
					$etatPayement = 'valide';
				}
				//on indique les différents états d'erreur
				else 
					$etatPayement = 'dateExpi_invalide';
			}	
			else
				$etatPayement = 'premCharEqualDernChar_numCD_invalide';		
		}
		else 
			$etatPayement = 'nbChar_numCD_invalide';



		//réussite du paiement
		if ($etatPayement == 'valide') {
		echo '<strong>Votre paiement a été validé.</strong><br>';
		$_SESSION['idCdPanier'] = '';
		echo '<FORM ACTION="homepage.php"> <INPUT TYPE="SUBMIT" VALUE="← Retour à la page daccueil"></FORM>';

		}

		//famille des echecs du paiement
		else if ($etatPayement == 'nbChar_numCD_invalide'){
		echo '<strong>Votre paiement a échoué.</strong><br>';
		echo 'Erreur : Entrez exactement 16 chiffres pour le numéro de carte bancaire';
		echo '<FORM ACTION="paiementEnCours.php"> <INPUT TYPE="SUBMIT" VALUE="← Retour au formulaire de payement"></FORM>';
		}

		else if ($etatPayement == 'premCharEqualDernChar_numCD_invalide'){
		echo '<strong>Votre paiement a échoué.</strong><br>';
		echo 'Erreur : Le premier et dernier chiffre du numéro de carte bancaire doivent etre identiques';
		echo '<FORM ACTION="paiementEnCours.php"> <INPUT TYPE="SUBMIT" VALUE="← Retour au formulaire de payement"></FORM>';
		}

		else if ($etatPayement == 'dateExpi_invalide'){
		echo '<strong>Votre paiement a échoué.</strong><br>';
		echo 'Erreur : Date d expiration invalide';
		echo '<FORM ACTION="paiementEnCours.php"> <INPUT TYPE="SUBMIT" VALUE="← Retour au formulaire de payement"></FORM>';
		}

		else 
		echo '<strong>Votre paiement est dans un etat incertain.</strong>'; //si ajout d'un|d' état(s) supplémentaire(s) dans le futur, inutile dans notre cas

		?>
	</body>
</html>