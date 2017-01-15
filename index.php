<?php 

	$string = file_get_contents("dictionnaire.txt", FILE_USE_INCLUDE_PATH);
	$dico = explode("\n", $string);

	// Nombre de mots contenus dans le tableau correspondant au dictionnaire
	var_dump(count($dico));


?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Exercice PHP Crunching : Dictionnaire</title>
</head>
<body>
	
	<h1>Dictionnaire</h1>

	<div>Ce dictionnaire comprend <?= count($dico) ?> mots.</div>

</body>
</html>