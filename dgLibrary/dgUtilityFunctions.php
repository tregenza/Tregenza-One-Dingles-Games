<?php
/*

	dgUtilityFunctions - General functions which need to be loaded before anything else

*/


/* Check file exists - returns true or false */
if (!function_exists("templateExists") ) {

	function templateExists($fullPath ) {
		$result = FALSE;
		$located = locate_template( $fullPath );
		if ($located !== '' ) {
					$result = TRUE;
		}
	
		return $result;
	}

}	

/* 
		dgLoad - returns nothing but throws an error if file cannot be loaded 

		Important -  filename must only be the basic filename without exentsion or path.
		e.g pass "dgUtilityFunctions"  not  "dgUtilityFunctions.php" or "dgLibrary/dgUtlityFunctions.php" 

 */
if (!function_exists("dgLoad") ) {

	function dgLoad($dgTools, $baseFilename ) {
		
		$result = FALSE;

		$path = "dgLibrary/";
		$suffix = ".php";

		if ( isset($dgTools['meta']) && isset($dgTools['meta']['key_1']) ) {
			$key_1 = $dgTools['meta']['key_1'];
		}

		/* Load rule specific version first if it exists*/
		if ( isset($key_1) ) {
			$workingFilename = $path.$baseFilename."-".$key_1.$suffix;
			if ( templateExists($workingFilename) ) {		
		
				/* load file */
				require_once(locate_template($workingFilename));
				$result = TRUE;
				
			} 
		}	

		/* Load default version  */
		$workingFilename = $path.$baseFilename.$suffix;
		if ( templateExists($workingFilename)) {
				/* load file */
				require_once(locate_template($workingFilename));
				$result = TRUE;
		}

		if ( !$result ) {
				/* Throw error and die */
				$error = "dgUtilityFunction unable to find / load file:  ".$workingFilename;
				die($error);
		}

		return $result;


	}


}


/* 
*		Load JS which is in a PHP file which needs running to generate correct JS 
*/
if (!function_exists("loadDynamicJSFile") ) {

	function loadDynamicJSFile($dgTools, $fullPath) {
			/* Load dynamically generated JS */
			/* Capture dynmically generated JS*/
			$path = locate_template($fullPath);

			/* Note that errors in the loaded file will produce unpredictable results */
			ob_start();
			include $path;
			$dynamicJS = ob_get_clean();

			$result = 	wp_add_inline_script( 'dgJS', $dynamicJS);			/* add it to static JS loaded via the functions.php */
		
			if ( ! $result ) {
				error_log("dgUtilityFunctions.php failed to load Javascript - ".$fullPath);	
				die("dgUtilityFunctions.php failed to load Javascript - ".$fullPath);
			}
	}
	
}

/*
*			get current NPC number
*/
if (!function_exists("getCurrentNPCNo") ) {

	function getCurrentNPCNo($dgTools) {
			return $dgTools['meta']['currentNPCNo'];
	}
}	
?>