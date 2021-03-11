<html>
	<head>
			<link rel="stylesheet" href="styles.css" />
	</head>
	 <?php
		session_start ();

		// On récupère nos variables de session
		if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) {

			afficherContenuCDs_EtBtnSuprr();
			?>
			<!--ajout cd-->
			<form action="ajout_stock.php"><INPUT TYPE="SUBMIT" VALUE="Ajouter un CD"></FORM>
			<!--se déconnecter-->
			<absolute><FORM ACTION="logout_adminRoom.php"> <INPUT TYPE="SUBMIT" VALUE="Je souhaite me déconnecter"></FORM></absolute>
			<?php
		}
		else {
			echo 'On se log peut-être ? Non ?'; echo '<br />';
			echo '<a href="./login_adminRoom.php">Se connecter</a>';
		}

		///fonctions
		function afficherContenuCDs_EtBtnSuprr(){
			$objetXML = simplexml_load_file('stockage.xml');
			// $id=0;

			foreach ($objetXML->listeCD as $niv1){
				foreach ($niv1 as $niv2){
					// $id++;
					foreach ($niv2 as $niv3){
						if ($niv3->getName() != 'pochette')
							 {	echo $niv3->getName(); echo': '; echo $niv3; echo'<br>'; }
					}
					echo "<img src=$niv2->pochette height='100' width='100'>";
					$id = $niv2->attributes();
					echo "
					<FORM ACTION='supprCD_adminRoom.php' METHOD='POST'>
						<INPUT TYPE='HIDDEN' NAME='id' VALUE=$id>
						<INPUT TYPE='SUBMIT' NAME='supprimer' VALUE='supprimer'>
					</FORM><br><br>";
				}
			}
		}
	?>
</html>
