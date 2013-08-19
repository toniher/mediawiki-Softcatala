<?php
/*
 * Definition of resources (CSS and Javascript) required for this skin.
 * This file must be included from LocalSettings.php since that is the only way
 * that this file is included by loader.php
 */
global $wgResourceModules, $wgStylePath, $wgStyleDirectory;
$wgResourceModules['skins.softcatala'] = array(
   'styles' => array( 'softcatala/css/main.css' => array( 'media' => 'screen'),
                     'softcatala/css/sc.css' => array('media' => 'screen' ),
                     'softcatala/css/rebost.css' => array('media' => 'screen' ),
                ),
   'scripts' => array('softcatala/js/softcatala.js',  'softcatala/js/rebost.js'),
   'remoteBasePath' => $wgStylePath,
   'localBasePath' => $wgStyleDirectory,
);

?>