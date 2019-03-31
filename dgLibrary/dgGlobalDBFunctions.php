<?php
/*

		dgGlobalDBDunctions - Sitewide database functions autoloaded by functions.php

*/


/* 
---------- Dingles Games database connection function ----------- 
*/
function getDBLink() {

	$connect = false;

	$host = gethostname();
	$ip = gethostbyname($host);
	$sqlAcc = "rootdd";
	$sqlPW = "";
	$sqlDB = "dd";
	$sqlHost = "localhost";

	/* Quick and dirty way to split be CT's development / Dingle's Test and Dingles Live environments */
	switch ($host) {
		case "ChrisMacPro.local":
			/* Chris Local Development */
			$sqlPW = "6d6rpg";
			break;
		case "dinglesgames.default.paulsingleton.uk0.bigv.io":
			/* Chris Local Development */
			$sqlPW = "8jXXgB=L5z";
			break;
	}
	
	$connect = mysqli_connect($sqlHost,$sqlAcc,$sqlPW,$sqlDB) ;
	
	/*  Test.dinglesgames */
//	$connect = mysqli_connect('localhost','rootdd','8jXXgB=L5z','dd') ;

	if (!$connect || is_bool($connect) || $connect->connect_error) {
		error_log("Error: Unable to connect to MySQL");
		error_log("Host ".$host." IP ".$ip);
		error_log("Error No ".var_export(mysqli_connect_errno(),1));
		error_log("Error Message ".var_export(mysqli_connect_error(),1));
		echo "<br/>ERROR - Database connection problem</br>";

		die;
	}

	return $connect;
}


/* Runs any SQL passed to it handling errors gracefully. 
Returns NULL is SQL fails, otherwise whatever the DB returns */
function runSQL($sql) {

		$link = getDBLink();

		$dbResult = mysqli_query($link, $sql) ;

		if ( !$dbResult ) {
				/* Query Failed - Log it and carry on*/
				error_log("dgGlobalDBFunctions -> runSQL : ".$sql);
				error_log("dgGlobalDBFunctions -> runSQL ERROR : ".$link->error);
		}		else {
				/* Query worked */
				error_log("dgGlobalDBFunctions -> runSQL : ".$sql); /*   <-- DEBUG CODE - remove from live */
				error_log("dgGlobalDBFunctions -> runSQL Rows : ".$dbResult->num_rows); /*   <-- DEBUG CODE - remove from live */
				error_log(var_export($dbResult,1)); /*   <-- DEBUG CODE - remove from live */
		}		

		return $dbResult;

}

/* Builds and runs a Select statement, returning an array of results or NULL 
			FIELDLIST and JOINS can be supplied as strings or arrays
			RAWSQL will be appended to the end of the SQL without check so can be used for unusual selects
*/ 
function runSQLSelect($fromTable, $fieldList = "*", $where = NULL, $sort = NULL, $joins = NULL, $rawSQL = "") {

			$result = NULL;

		if (empty($fromTable)) {
				error_log("dgGlobalDBFunctions -> runSQLSelect : No $from table provided "); /*   <-- DEBUG CODE - remove from live */
				die("dgGlobalDBFunctions -> runSQLSelect : No $from table provided ");
		}	

		if (is_array($fieldList) ) {
				$fieldList = implode(", ", $fieldList);
		}

		$sql = "SELECT ";
		$sql .= $fieldList;
		$sql .= " FROM ";
		$sql .= $fromTable;
		$sql .= " ";

		if (!empty($joins) ) {
				$joinSQL= "";
				if (is_array($joins) ) {
						foreach($joins as $join) {
								$joinSQL .= "LEFT JOIN ".$join;
						}
				} else {
						$joinSQL .= "LEFT JOIN ".$joins;
				}
				$sql .= " ".$joinSQL;
				$sql .= " ";
		}

		if (!empty($where) ) {
				$sql .= " WHERE ".$where;
		}

		if (!empty($sort) ) {
				$sql .= " ORDER BY ".$sort;
		}

		if (!empty($rawSQL) ) {
				$sql .= " ".$rawSQL;
		}

		$sql .= " ;";
		$dbResult = runSQL($sql);

		$result =  array();
		while ($row = mysqli_fetch_array($dbResult, MYSQLI_ASSOC)) {
				$result[] = $row;
		}				

//		error_log(var_export($result,1)); /*   <-- DEBUG CODE - remove from live */

		return $result;
}