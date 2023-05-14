<?php
/** 
	Language Recognizer 0.1a
	Just a function to help recognize languages
**/

function getLanguage($text, $default='en') {

	$wordList['de'] = array('der', 'die', 'und', 'den', 'von', 'zu', 'das', 'mit', 'sich', 'als','des', 'auf', 'für', 'lektion','Vielen','Klasse',
		'ist', 'im', 'dem', 'nicht', 'ein', 'Die', 'eine','mehr','einem','mir','hier','wenn','hat','sind','dich','danke','ich','haben','klass','habe','wir');

	$wordList['en'] = array('the', 'be', 'to', 'of', 'and', 'enjoyed', 'in', 'that', 'have', 'I', 'it', 'for', 'not', 'talking','excellent',
		'on', 'with', 'he', 'good', 'you', 'do', 'at','much','sorry','she','thank','lesson','is','had','me','great','always','thanks','very','fantastic','sure','must');	

	$wordList['it'] = array('non', 'di', 'che', 'è', 'il', 'un', 'per', 'una', 'mi', 'sono', 'ho', 'Io', 'ma','mille','molto', 'parole','buon','oggi',
		'lo', 'ha','richieste','studenti','chesto','si','io','grazie', 'avere','ci','essere','mio','perché','questa','lezione','lezioni','presto','prossima','vediamo');

	$wordList['es'] = array('si', 'mucho', 'gusto', 'és', 'Hola', 'el', 'del', 'que', 'y', 'en', 'un', 'una', 'hablas', 'haber', 'clase','hoy','poco',
		'con', 'su','hacer','pero','otro','cuando','muchas','gracias','hasta','año','primero','bien','ahora','siempre','lección','muy','quiero','lecciones','sido','han');

	$wordList['fr'] = array('le', 'beaucoup', 'et', 'être', 'avoir', 'pour', 'dans', 'ce', 'qui', 'ne', 'sur', 'plus', 'pas','pouvoir', 
		'par', 'je','avec','tout','un','autre','comme','elle','aussi','vous','merci','mon','en','nous','leçon','tres','suis','à','étudié','agréable','progresse','voici','bonjour');

	$wordList['sv'] = array('idag','svenska','kan','bra','vacker','svårt','lätt','tack','tacker','jag','gej','ja','lärare','nästa','komma','och','lektion',
		'semester','studera','klass','förstar','huvuden','vecka','år','då','imorgon','igår','Kalender','sekund','timme','minut','göra','var','lextioner','mycket','hej','snalla');

	$wordList['pt'] = array('lição','aula','obrigado','obrigada','certeza','estudei','sim','não','certo','com','muito','gosto','olá','em','uma','palavra',
		'falar','fazer','outro','quando','muitas','nossa','nosso','até','amanhã','noite','dia','bem','bom','hora','sempre','pode','bela','professor','professora','gosto','boa');


	$text = strtolower(preg_replace("/[^A-Za-z]/", ' ', $text));
	$words = str_word_count($text, 1);
	$words = array_count_values($words);

	$scores = [];
	foreach ($wordList as $lang => $list) {
	$commonWords = array_intersect_key($words, array_flip($list));
	$scores[$lang] = array_sum($commonWords);
	}

	arsort($scores);

	// Get the keys of the scores array
	$scoreKeys = array_keys($scores);

	// Compare the first and the second scores
	if (isset($scoreKeys[1]) && $scores[$scoreKeys[0]] > $scores[$scoreKeys[1]] * 5) {
	return $scoreKeys[0];
	}

	return $default;
}
?>
