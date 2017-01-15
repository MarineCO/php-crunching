<?php 

	$string = file_get_contents("dictionnaire.txt", FILE_USE_INCLUDE_PATH);
	$dico = explode("\n", $string);

	// Nombre de mots contenus dans le tableau correspondant au dictionnaire
	var_dump(count($dico));

	// Nombre de mots de 15 caractères 
	function fifteenCharacter($tab) {

		foreach ($tab as $value) {

			$wordLength = strlen($value); 
			/* Si ds le tableau est rencontré la taille de 15 caractères le compteur s'incrémente de 1 */
			if ($wordLength === 15) {

				$count++;
			}
		}
		/* retourner le total du compteur après avoir passé tout le tableau en revue */
		return $count;
	}
	var_dump(fifteenCharacter($dico));

?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Exercice PHP Crunching : Dictionnaire</title>
</head>
<body>
	
	<h1>Dictionnaire</h1>

	<div>Question 1 : Ce dictionnaire comprend <?= count($dico) ?> mots.</div>
	<div>Question 2 : <?= fifteenCharacter($dico) ?> mots font exactement 15 caractères.</div>

</body>
</html>