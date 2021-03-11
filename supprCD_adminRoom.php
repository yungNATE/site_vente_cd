<?php
$objetXML = new DOMDocument;
$objetXML->load('stockage.xml');
$niv1 = $objetXML -> documentElement; //récup le niv1
$niv2 = $niv1 -> getElementsByTagName('CD'); //récup le niv2
$identifiant = $_POST['id'];
echo $identifiant;

//parcours liste
foreach ($niv2 as $CD) 
{
    $attribut = $CD->getAttribute('id'); //recupere numero id
    if ($attribut == $identifiant) 		//si id correspond a celui choisi, on supprime
    {
      $parent = $CD->parentNode;
      $parent -> removeChild($CD);
	}
}

//parse le fichier XML et remet un ID incrémental : permet d'avoir des ID plus propres que des nombres aléatoires
$i=1;
foreach ($niv2 as $CD) { 
	if( !empty( $CD->getAttribute('id') ) ){
		$CD->setAttribute('id',$i);
		$i++;
	}
}
$objetXML->save('stockage.xml');

header('Location: ./adminRoom.php');
exit();

?>
