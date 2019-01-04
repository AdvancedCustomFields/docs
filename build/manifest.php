<?php

// Config.
define('BUILD_PATH', dirname(__FILE__));
define('DOCS_PATH', dirname(BUILD_PATH));

// Include dependancies.
include_once( BUILD_PATH . '/composer/vendor/autoload.php');

// Globals.
global $docs, $parser;

// Vars.
$docs = array();
$parser = new Mni\FrontYAML\Parser();

/**
*  walk
*
*  Walker function to walk through folders and generate manifest.
*
*  @date	4/1/19
*  @since	5.8.0
*
*  @param	string $path The current path.
*  @return	void
*/
function walk( $path ) {
	
	// Globals.
	global $docs;
	
	// Get list of files in this folder.
	$entries = scandir( $path );
	
	// Loop over files.
	foreach( $entries as $entry ) {
		
		// Vars.
		$item = $path . '/' . $entry;
		
		// Bail early if is hidden.
		if( substr($entry, 0, 1) === '.' ) {
			continue;
		
		// Ignore some files.
		} if( $entry === 'build' || $entry === 'README.md' ) {
			continue;
			
		// Walk inside folder.
		} elseif( is_dir($item) ) {
			walk( $item );
		
		// Append doc meta.
		} elseif( substr($entry, -3) === '.md' ) {
			$docs[] = read_meta( $item );
		}
	}
}

/**
*  read_meta
*
*  Returns an array of meta for the given file.
*
*  @date	4/1/19
*  @since	5.8.0
*
*  @param	string $file_path The file to read.
*  @return	array
*/
function read_meta( $file_path ) {
	
	// Globals.
	global $parser;
	
	// Read file.
	$file_contents = file_get_contents( $file_path );
	
	// Parse YAML.
	$document = $parser->parse( $file_contents, false );
	$meta = $document->getYAML();
	
	// Apply defaults.
	$meta = array_merge(array(
		'title'			=> '',
		'description'	=> '',
		'category'  	=> '',
		'keywords'  	=> array(),
		'slug'      	=> basename( $file_path, '.md' ),
		'raw_url'      	=> str_replace( DOCS_PATH, 'https://raw.githubusercontent.com/AdvancedCustomFields/docs/master', $file_path),
	), $meta);
		
	// Return.
	return $meta;
}

// Walk docs.
walk( DOCS_PATH );

// Write JSON.
file_put_contents( DOCS_PATH . '/manifest.json', json_encode($docs, JSON_PRETTY_PRINT));

// Display JSON
header('Content-Type: application/json');
echo json_encode( $docs );
