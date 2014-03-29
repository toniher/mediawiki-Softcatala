<?php

if ( !defined( 'MEDIAWIKI' ) ) {
	echo( "This file is an extension to the MediaWiki software and cannot be used standalone.\n" );
	die();
}

class BaixadesRebost {


		/**
		* @param $parser Parser
		* @param $frame PPFrame
		* @param $args array
		* @return string
		*/

		public static function printFunction( $parser, $frame, $args ) {
	
			return 'NUM_BAIXADES';
		
		}


}

