<?php
session_start();
?>

<html>  
	<head>
		<title>Paiement en cours</title>
		<link rel="stylesheet" href="main.css"/>
	</head>
	<body>
		<form name="infoCB" action="paiementTraitement.php" method="post">		
			Entrez votre numero de carte bancaire:	<input type="text" name="numCB"/>	<br/>
			Entrez la date d'expiration (mm/yy): 	<input type="text" name="dateExpi"/><br/><br/>
			<input type="submit" name="Validement le payement" value="valider"/>
		</form>
	</body>
</html>