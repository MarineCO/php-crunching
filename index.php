<?php 

	$string = file_get_contents("dictionnaire.txt", FILE_USE_INCLUDE_PATH);
	$dico = explode("\n", $string);


	// Nombre de mots contenus dans le tableau correspondant au dictionnaire
	$allWords = count($dico);
	var_dump(count($dico));


	// Nombre de mots de 15 caractères 
	function fifteenCharacter($tab) {

		$count = 0;

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


	//Nombre de mots contenant la lettre "w"
	function wLetter ($tab) {

		$count = 0;

		foreach ($tab as $value) {

			$findMe = "w";
			$search = stripos($value, $findMe);

			if (!$search === false) {
				$count++;
			}
		}
		return $count;
	}
	var_dump(wLetter($dico));


	// Nombre de mots finissant par la lettre "q"
	function qLetter ($tab) {

		$count = 0;

		foreach($tab as $value) {

			$findLastLetter = "q";
			$searchQ = strripos($value, $findLastLetter);

			if (!$searchQ === false) {
				$count++;
			}
		}
		return $count;
	}

	var_dump(qLetter($dico));



?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Exercice PHP Crunching : Dictionnaire</title>
</head>
<body>
	
	<h1>Dictionnaire</h1>

	<div>Question 1 : Ce dictionnaire comprend <?= $allWords ?> mots.</div>
	<div>Question 2 : <?= fifteenCharacter($dico) ?> mots font exactement 15 caractères.</div>
	<div>Question 3 : <?= wLetter($dico) ?> mots contiennent la lettre "w".</div>
	<div>Question 4 : <?= qLetter($dico) ?> mots finissent par la lettre "q".</div>
	
</body>
</html>

