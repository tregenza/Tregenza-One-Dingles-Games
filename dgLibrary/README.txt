
Development Notes

November 2018


	------------------------------------------------------------

	Rule Systems

	The old $key_1 global has been replaced by the $meta array (see below)
	which has $meta['key_1'] doing the same job as $key_1. Valid values
	for key_1 are defined as constants- PATHFINDER, PATHFINDER2 and DD35
	(see dgDataFunctions for more).
	
	The rulse system defaults to Pathfinder (1st Ed) but can be set via hyperlink
	or passed via GET / POST forms.
	
	Hyperlinking to a specific rule system  e.g.

			href="<pageURL>"														-		Unspecific, defaults to Pathfinder 1st
			href="<pageURL>?key_1=dd35" 			-		Use DD35 rules / code
			
	------------------------------------------------------------

	All subfiles need to be in the theme/dgLibrary directory

	Sub-Files naming conventions:

	Prefix: 
			dg 			-			All Dingle Games files (not part of the theme / Wordpress ) 

	Tool:
		NPC								-				NPC / Monster genrator
		Encounter 	-				Encounter generator
		Treasure 		-				Treasure generator
		Maintain			-				Add / Edit monster types, treasure etc tto the database
		Utility				-				Used across several parts of the system
		Global					-				Always loaded via functions.php

	Purpose:
		Form  -  The form and logic for the tool 
		Data			-			Managing session data; passing data between forms; constants etc
		DB					-			Database handling	
		Select -		Selecting a monster / treasure (first screen of the generator)
		Generate		-		Editing an new / pre-existing monster (second screen)
		Result	-			Display only of the results of a generator 
		JS					-			Javascript handling
		HTML 		-			CSS / HTML handling
		Membership 	-		Accessing / updataing membership information

	Subtype:  
		[None]		-		Primary logic which calls functions defined elsewhere
		Functions - Helper code / functions to called by other parts of the system
		JS - 		Dynamicly generated Javascript

	Rule System:  (as required. See constants definded in dgData.php)
			path		-			Pathfinder 1st Edition
			path2 -		Pathfinder 2nd Edition
			dd35 	-			D&D 35
			
	Example file names:

			dgUtilityDataFunctions.php 				-				Default data handling		across a range of generators
			dgNPCSelectForm 											-				 Primary logic for the default select monster process
			dgNPCSelectFormFunctions 			-			Functions required only by the select monster form
			dgNPCSelectForm-path							-			Functions only needed by the select monster form for Pathfinder 1st edition

	------------------------------------------------------------

	File Loading

	All files should be loaded using the following:

			dgLoad($meta, "<<FILENAME>>");

	Note that the <<<FILENAME>> must only be the base filename with no extension ".php"
	or path "dgLibrary". e.g.:

			dgLoad($meta, "dgUtilityFunctions");

	IMPORTANT:  dgLoad will always load a rule specific version of the 
	file first if it can then the standard version. This allows for Function 
	Overloading (see below)

	e.g. If you pass it "dgUtilityFunctions" it will load for "dgUtilityFunctions-path.php" 
	first and then "dgUtilityFunctions.php" (assuming the $meta['key_1'] is set to Pathfinder.
	

	------------------------------------------------------------


	Function Overloading

	By loading files using dgLoad and the $meta array it is possible to have
	rule system specific functions when needed but share functions where 
	the rules are the same.

	The rule specific version is loaded first then the default version.

	IMPORTANT: Because a function might already exist (defined in the rule specific
	file), before defining a function, the function_exists (see php manual) function
	must be called or an error can arrise.


	------------------------------------------------------------

		Data handling  (see dgDataFunctions for more);

		All data needed by tools is in $dgTools array which is passed between the different parts of the code.

		$dgTools contains top level arrays 

		'meta'									-			Contains page flow, user data and other non-tool specific data
		'NPCsArray'				-			An array of NPCArrays, i.e. it stores multiple NPCs (for encounter generator)
		'treasureArray' -  ??????

		The 'NPCsArray' contains an array of 	'NPCArray'	which contains all data for a single NPC

		These variables are automatically passed between pages / sessions via code in ?????????

		No globals are used other than standard Wordpress and PHP globals
		 
	------------------------------------------------------------