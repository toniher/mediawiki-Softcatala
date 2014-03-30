<?php

if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'This file is a MediaWiki extension, it is not a valid entry point' );
}

/** REGISTRATION */
$wgExtensionCredits['parserhook'][] = array(
	'path' => __FILE__,
	'name' => 'BaixadesRebost',
	'version' => '0.1',
	'url' => 'https://www.softcatala.org',
	'author' => array( 'Toniher' ),
	'descriptionmsg' => 'Baixades del Rebost',
);


#Local DB
$wgBaixadesRebostDB = array(
	"server" => "127.0.0.1",
	"type" => "mysql",
	"name" => "rebost",
	"username" => "rebost",
	"password" => "rebost",
	"flags" => "",
	"tableprefix" => ""
);


/** LOADING OF CLASSES **/
// https://www.mediawiki.org/wiki/Manual:$wgAutoloadClasses
$wgAutoloadClasses['BaixadesRebost'] = __DIR__ . '/BaixadesRebost.classes.php';


/** STRINGS AND THEIR TRANSLATIONS **/
$wgExtensionMessagesFiles['BaixadesRebostMagic'] = __DIR__ . '/BaixadesRebost.i18n.magic.php';

/** HOOKS **/

#http://www.mediawiki.org/wiki/Manual:Parser_functions
$wgHooks['ParserFirstCallInit'][] = 'BaixadesRebostSetupParserFunction';


// Hook our callback function into the parser
function BaixadesRebostSetupParserFunction( $parser ) {
	// When the parser sees the {{#userprofile:}} function, it executes 
	// the printFunction function (see below)
	$parser->setFunctionHook( 'baixades', 'BaixadesRebost::printFunction', SFH_OBJECT_ARGS );
	// Always return true from this function. The return value does not denote
	// success or otherwise have meaning - it just must always be true.
	return true;
}

