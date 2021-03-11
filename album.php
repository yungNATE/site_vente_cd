 <html lang="fr">
	
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="styles.css" />
		<title>Album selectionné</title>
		<FORM ACTION="homepage.php"> <INPUT type="submit" value="← Retour à la page d'accueil"></FORM>
	</head>
	<?php 
		session_start();
		
		$objetXML = simplexml_load_file('stockage.xml');
		
		foreach ($objetXML->listeCD as $niv1){
					foreach ($niv1 as $niv2){
						
						if ($niv2->attributes() == $_GET['id']) {	
							
							foreach ($niv2 as $niv3){
								if ( $niv3->getName() != 'pochette'){ 
									if ( $niv3->getName() != 'prix' )  
										{ echo $niv3->getName().': '.$niv3; echo "</br>"; }
									else 
										{ echo $niv3->getName().': '.$niv3.'€'; echo "</br>"; }
								}
							}
							echo "<img src=$niv2->pochette>";echo "</br>";
							echo "<a href = $niv2->pochette> Lien vers l'image d'origine </a>";
						}
					}
				}
	?>
</html>