<?php
session_start();
?>
<html>  
	<head>
		<title>Panier</title>
		<FORM ACTION="homepage.php"> <INPUT type="submit" value="← Retour à la page d'accueil"></FORM>
	</head>
	<body>


	<strong>Votre panier</strong><br>

	<!-- Gestion de panier -->
	<?php

	$objetXML = simplexml_load_file('stockage.xml');

	if (isset ($_SESSION['idCdPanier']))
		$idCdPanier = $_SESSION['idCdPanier']; //on copie idCdPanier dans une variable tampon sur laquelle on travaillera

	if( !empty( $idCdPanier ) ) { 	//si le panier n'est pas vide

	   $iterateur = 0;			//iterateur qui permet de se balader dans un tableau d'ID
	   $sommePrixCD=0;
	   $sommePrix = 0;
	   


	   $tab_nbIDs = array_count_values(explode('_', "$idCdPanier")); //on récupère les IDs depuis la chaine et on compte le nbr d'occurence de chacun
	   foreach($objetXML->listeCD as $niv1){
		foreach ($niv1 as $niv2){  
			$iterateur++;

			if (isset ($tab_nbIDs[$iterateur])) {

			$titre=$niv2->titre;
			$auteur=$niv2->auteur;
			$prix=$niv2->prix;

			$occurrence = $tab_nbIDs[$iterateur];

			$sommePrixCD = $niv2->prix * $occurrence; 	//prix total par type de CD
			$sommePrix += $sommePrixCD;					//prix total panier
			
			//affichage des CDs du panier
			echo "</br>" . $occurrence. 'x '."</br>";
			echo $titre." (par : " . $auteur . ")".' : '.$sommePrixCD.'€'."</br>";


			$sommePrixCD=0;
			}
		}
	   }
				echo "<strong></br></br> Montant total à payer : </strong>" . $sommePrix . "€";
	}
	else 						//si le panier est vide
		echo "<strong> est vide.</strong>";


	echo "<hr/>";
	?>
		<form action="paiementEnCours.php" method="post">
		  <input type="submit" name="recapPanier" value="Accéder au paiement →">
		</form>

	</body>
	
	<!--RENDONS A CESAR : Merci à Alexandre Zanni pour son aide sur le panier-->

</html>

