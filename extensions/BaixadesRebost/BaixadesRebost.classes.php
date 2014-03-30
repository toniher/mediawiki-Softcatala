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

		global $wgBaixadesRebostDB;

		$db = DatabaseBase::factory( $wgBaixadesRebostDB["type"],
				array(
				'host' => $wgBaixadesRebostDB["server"],
				'user' => $wgBaixadesRebostDB["username"],
				'password' => $wgBaixadesRebostDB["password"],
				// Both 'dbname' and 'dbName' have been
				// used in different versions.
				'dbname' => $wgBaixadesRebostDB["name"],
				'dbName' => $wgBaixadesRebostDB["name"],
				'flags' => $wgBaixadesRebostDB["flags"],
				'tablePrefix' => $wgBaixadesRebostDB["tableprefix"],
				)
		);
		
		// Default current page
		$pageid =  $parser->getTitle()->getArticleID();
		// No interval --> all
		$interval = "";
		
		if ( isset( $args[0] ) ) {
			if ( ! empty( $args[0] ) ) {
				$page = trim( $frame->expand( $args[0] ) );
				$title = Title::newFromText( $page );
				if ( $title ) {
					$pageid = $title->getArticleID();
				}
			}
		}
		
		if ( isset( $args[1] ) ) {
			$interval = trim( $frame->expand( $args[1] ) );
		}

		if ( ! is_numeric( $pageid ) ) {
			$pageid = 0;
		}

		$from = array('baixades');
		$columns = array('count(*)');
		
		if ( !empty( $interval ) ) {
			// Need a switch here! -> dia, mes, any
			$where = array('idrebost = '.$pageid );
		} else {
			$where = array('idrebost = '.$pageid );
		}
		
		$options = array();
		
		$num_baixades = 0;
		
		$rows = self::searchDB( $db, $from, $columns, $where, $options );

		if ( $rows ) {

			foreach ( $rows as $row ) {
				$num_baixades = $row['count(*)'];
			}
		
		}

		return $num_baixades; // Avoiding breaking
		//return $parser->insertStripItem( $num_baixades, $parser->mStripState );
		
	
	}

	private static function searchDB( $db, $table, $vars, $conds, $options, $condoptions=array() ) {
	
		// Add on a space at the beginning of $table so that
		// $db->select() will treat it as a literal, instead of
		// putting quotes around it or otherwise trying to parse it.
		
		$result = $db->select( $table, $vars, $conds, 'BaixadesRebost::searchDB', $options, $condoptions );
		
		if ( !	$result ) {
			return false;
		} else {
		
			$rows = array();
			while ( $row = $db->fetchRow( $result ) ) {
				// Create a new row object, that uses the
				// passed-in column names as keys, so that
				// there's always an exact match between
				// what's in the query and what's in the
				// return value (so that "a.b", for instance,
				// doesn't get chopped off to just "b").
				$new_row = array();
				
				foreach ( $vars as $i => $column_name ) {
					// Convert the encoding to UTF-8
					// if necessary - based on code at
					// http://www.php.net/manual/en/function.mb-detect-encoding.php#102510
					$dbField = $row[$i];
					if ( !function_exists( 'mb_detect_encoding' ) || mb_detect_encoding( $dbField, 'UTF-8', true ) == 'UTF-8' ) {
						$new_row[$column_name] = $dbField;
					} else {
						$new_row[$column_name] = utf8_encode( $dbField );
					}
				}
				
				$rows[] = $new_row;
			}
			return $rows;
		}
	}

}

