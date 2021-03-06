<?php 

// DICTIONNAIRE

$string = file_get_contents("dictionnaire.txt", FILE_USE_INCLUDE_PATH);
$dico = explode("\n", $string);


	// Nombre de mots contenus dans le tableau correspondant au dictionnaire
	$allWords = count($dico);


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


	// Nombre de mots finissant par la lettre "q"
	function qLetter ($tab) {
		$count = 0;
		foreach($tab as $value) {
			$searchQ = substr($value, -1);

			if ($searchQ === "q") {
				$count++;
			}
		}
		return $count;
	}


// FILMS

$string = file_get_contents("films.json", FILE_USE_INCLUDE_PATH);
$brut = json_decode($string, true);
$top = $brut["feed"]["entry"];

	// Affichage du top 10 de la liste
	function top10($tab) {
		for ($i = 0; $i < 10; $i++) {
			$ii = $i + 1;
			echo '<div>'.$ii.'. '.$tab[$i]['im:name']['label'].'</div>';
		}
	}


	//Classement du film Gravity
	function gravity($tab) {
		for ($i = 0; $i < count($tab); $i++) {
			if ($tab[$i]['im:name']['label'] === 'Gravity') {
				return $i + 1;
			}
		}
	}


	//Réalisateur du film "The LEGO Movie"
	function realisateur($tab) {
		for ($i = 0; $i < count($tab); $i++) {
			if ($tab[$i]['im:name']['label'] === 'The LEGO Movie') {
				return $tab[$i]['im:artist']['label'];
			} 
		}
	}


	//Nb de films sortis avant 2000
	function before2000($tab) {
		$count = 0;
		foreach ($tab as $value) {
			$releaseDate = $value['im:releaseDate']['label'];
			$timestampReleaseDate = strtotime($releaseDate);
			$timestampToCompare = strtotime('2000-01-01');
			
			if ($timestampReleaseDate < $timestampToCompare) {
				$count++;
			} 
		}
		return $count;
	}


	//Film le + récent
	function mostRecentMovie($tab) {
		foreach ($tab as $key => $value) {
			$movie = $value['im:name']['label'];
			$movies = explode('/', $movie);
			//print_r($movies);
			$title = $movies[0];
			$releaseDate = $value['im:releaseDate']['label'];
			$tabDate[$releaseDate] =  $title;
		}
			krsort($tabDate);
			
			//print_r($tabDate);
			$mostRecentMovie = current($tabDate);
			echo '<div>Le plus récent : '.$mostRecentMovie.'</div>';

	//Film le + vieux
			$oldestMovie = end($tabDate);	
			echo '<div>Le plus vieux : '.$oldestMovie.'</div>';	
	}


	//Catégorie de films la plus représentée
	function category($tab) {
		$tabCategory = array();
		foreach ($tab as $key => $value) {
			$category = $value['category']['attributes']['label'];
			array_push($tabCategory, $category);
		}
			$nbOfRecurrence = array_count_values($tabCategory);
			$recurrenceMax = max($nbOfRecurrence);
		foreach ($nbOfRecurrence as $key => $value) {
			if ($value === $recurrenceMax) {
				echo $key;
			}
		}
	}


	//Réalisateur le plus présent dans le top 100
	function filmmaker($tab) {
		$tabDirector = array();
		foreach ($tab as $key => $value) {
			$filmmaker = $value['im:artist']['label'];
			array_push($tabDirector, $filmmaker);
		}
			$nbOfReccurence = array_count_values($tabDirector);
			$recurrenceMax = max($nbOfReccurence);
		foreach ($nbOfReccurence as $key => $value) {
			if ($value === $recurrenceMax) {
				echo $key;
			}
		}
	}


	//Prix d'achat du top 10 sur iTunes
	function buy($tab) {
		$total = 0;
		for ($i = 0; $i < 10; $i++) {
			$price = $tab[$i]['im:price']['attributes']['amount'];
			$total = $total + $price;
		}
		return $total;
	}


	//Prix de location du top 10 sur Itunes
	function rental($tab) {
		$total = 0;
		for ($i = 0; $i < 10; $i++) {
			if (isset($tab[$i]['im:rentalPrice'])){
				$price = $tab[$i]['im:rentalPrice']['attributes']['amount'];
				$total = $total + $price;
			}
		}
		//print_r($total);
		return $total;
	}

?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Exercice PHP Crunching : Dictionnaire</title>
</head>
<body>
	
	<h2>Dictionnaire</h2>

	<div>Question 1 : Ce dictionnaire comprend <?= $allWords ?> mots.</div>
	<div>Question 2 : <?= fifteenCharacter($dico) ?> mots font exactement 15 caractères.</div>
	<div>Question 3 : <?= wLetter($dico) ?> mots contiennent la lettre "w".</div>
	<div>Question 4 : <?= qLetter($dico) ?> mots finissent par la lettre "q".</div>
	

	<h2>Liste de films</h2>
	
	<div>
		<h3>Top 10 : </h3>
		<?= top10($top); ?>
	</div>

	<div><h3>Classement du film Gravity : </h3><?= gravity($top) ?>ème position</div>

	<div><h3>Réalisateur du film "The LEGO Movie" : </h3><?= realisateur($top); ?></div>

	<div><h3>Nombre de films sortis avant 2000 : </h3><?= before2000($top); ?> films</div>

	<div><h3>Film le plus récent et film le plus vieux : </h3><?php mostRecentMovie($top); ?></div>

	<div><h3>Catégorie de films la plus représentée : </h3><?php category($top); ?></div>

	<div><h3>Réalisateur le plus présent dans le top 100 : </h3><?php filmmaker($top); ?></div>

	<div><h3>Prix d'achat du top 10 sur iTunes : </h3><?= buy($top); ?> euros</div>

	<div><h3>Prix de location du top 10 sur iTunes : </h3><?= rental($top); ?> euros</div>

</body>
</html>

