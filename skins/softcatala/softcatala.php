<?php
/**
 * Initialisation file for Softcatala skin
 * 
 * @file
 * @ingroup Skins
 * @authors Toni Hermoso, Softcatalà
 */

if( !defined( 'MEDIAWIKI' ) ) die( "This is an extension to the MediaWiki package and cannot be run standalone." );


$wgExtensionCredits['skin'][] = array(
    'path' => __FILE__,
    'name' => 'Softcatala',
    'url' => "https://www.softcatala.org",
    'author' => 'Toni Hermoso',
    'descriptionmsg' => 'Softcatala skin',
    'version' => '1.0'
);

$wgValidSkinNames['softcatala'] = 'Softcatala';
$wgAutoloadClasses['SkinSoftcatala'] = dirname(__FILE__).'/Softcatala.skin.php';
 
$wgResourceModules['skins.softcatala'] = array(
		'styles' => array( 'softcatala/css/main.css' => array( 'media' => 'screen' ),
		'softcatala/css/cookies/cookiecuttr.css' => array(  'media' => 'screen' ),
		'softcatala/css/sc.css' => array('media' => 'screen' ),
		'softcatala/css/rebost.css' => array('media' => 'screen' ),
		),
		'scripts' => array( 'softcatala/js/cookies/jquery.cookie.js', 'softcatala/js/cookies/jquery.cookiecuttr.js', 'softcatala/js/softcatala.js',  'softcatala/js/rebost.js' ),
        'remoteBasePath' => &$GLOBALS['wgStylePath'],
        'localBasePath' => &$GLOBALS['wgStyleDirectory']
);


//$wgFooterIcons['poweredby']['xxx'] = array(
//              "src" => "",
//              "url" => "",
//              "alt" => "",
//          );
