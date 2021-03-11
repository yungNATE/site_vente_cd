<?php
  $objetXML = simplexml_load_file('stockage.xml');
  $niv1 = $objetXML -> listeCD; 	//récup le niv1
  $niv2 = $niv1 -> CD; 				//récup le niv2
  $identifiant = $niv2 -> count() + 1; //compte le nombre de CD additionne 1 et crée l'identifiant

  $nouveauCD = $niv1 -> addChild('CD');
  $nouveauCD -> addAttribute('id', $identifiant);
  $nouveauCD -> addChild('titre',$_POST['title']);
  $nouveauCD -> addChild('genre',$_POST['gender']);
  $nouveauCD -> addChild('auteur',$_POST['autor']);
  $nouveauCD -> addChild('prix',$_POST['price']);
  $nouveauCD -> addChild('pochette',$_POST['cover']);
  $objetXML -> asXML('stockage.xml');

  header('Location: ./adminRoom.php');
  exit();
?>
