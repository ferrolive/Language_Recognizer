<?php
/** 
	Language Recognizer 0.1a
	Just a function to help recognize languages
**/

function getLanguage($text, $default) {
	$supported_languages = array(
	  'en','de','it','es','fr'
	);

	$wordList['de'] = array('der', 'die', 'und', 'den', 'von', 'zu', 'das', 'mit', 'sich', 'als','des', 'auf', 'für', 
		'ist', 'im', 'dem', 'nicht', 'ein', 'Die', 'eine','mehr','einem','mir','hier','hat','sind','dich','danke','ich');

	$wordList['en'] = array('the', 'be', 'to', 'of', 'and', 'a', 'in', 'that', 'have', 'I', 'it', 'for', 'not', 
		'on', 'with', 'he', 'good', 'you', 'do', 'at','much','sorry','she','thank','is','had','me','great','always');

	$wordList['it'] = array('non', 'di', 'che', 'è', 'il', 'un', 'per', 'una', 'mi', 'sono', 'ho', 'Io', 'ma','mille','molto', 
		'lo', 'ha','richieste','studenti','chesto','si','io','grazie', 'avere','ci','essere','mio','perché','questa');

	$wordList['es'] = array('si', 'mucho', 'gusto', 'és', 'Hola', 'el', 'del', 'que', 'y', 'en', 'un', 'una', 'hablas', 'haber', 
		'con', 'su','hacer','pero','otro','cuando','muchas','gracias','asta','año','primero','bien','ahora','siempre','muy');

	$wordList['fr'] = array('le', 'à', 'et', 'être', 'avoir', 'pour', 'dans', 'ce', 'qui', 'ne', 'sur', 'plus', 'pas', 'pouvoir', 
		'par', 'je','avec','tout','un','autre','comme','elle','aussi','vous','merci','mon','en','nous','tres');


	$text = strtolower(preg_replace("/[^A-Za-z]/", ' ', $text));

	foreach ($supported_languages as $language) {
		$counter[$language]=0;
	}
	
	$total = 0;
	for ($i = 0; $i < 30; $i++) {
		foreach ($supported_languages as $language) {
		    $string = "/\b(".$wordList[$language][$i].")\b/";

		    if ( preg_match_all($string,$text) ) {
		    	$counter[$language] = $counter[$language] + 1;
		    }
		}
	}
	$max = max($counter);
	$maxs = array_keys($counter, $max);

	if (count($maxs) == 1) {
		$winner = $maxs[0];
		$second = 0;
		
		foreach ($supported_languages as $language) {
			if ($language <> $winner) {
				if ($counter[$language]>$second) {
					$second = $counter[$language];
				}
			}
		}
		if (($second / $max) < 0.20) {
			return $winner;
		} 
	}
	return $default;
}
?>