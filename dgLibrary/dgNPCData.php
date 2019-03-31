<?php
/* 

	Collates and manages all data needed to output an NPC

	CT - Currently Pathfinder only

*/




/* Return the data */
function getNPCData() {

	/* 
		We could just use $GLOBALS in our code but it is better practic to
		dump it into a variable if we are just referencing rather than changing the data.
		Also it will make it easier to switch to a non-global variable approach at a later date */
	$NPCData = $GLOBALS["_POST"];	
/*foreach ($NPCData as $a =>$d ) {
echo "<div>";
echo "<h3>".$a."</h3>";
if ( isset($d['mon_type'])) {
var_dump($d);
}
echo "</div>";
}
*/
	return $NPCData;

}