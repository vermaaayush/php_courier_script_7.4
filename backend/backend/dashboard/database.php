<?php

// *************************************************************************

// *                                                                       *

// * DEPRIXA -  Integrated Web system                                      *

// * Copyright (c) JAOMWEB. All Rights Reserved                            *

// *                                                                       *

// *************************************************************************

// *                                                                       *

// * Email: osorio2380@yahoo.es                                            *

// * Website: http://www.jaom.info                                         *

// *                                                                       *

// *************************************************************************

// *                                                                       *

// * This software is furnished under a license and may be used and copied *

// * only  in  accordance  with  the  terms  of such  license and with the *

// * inclusion of the above copyright notice.                              *

// * If you Purchased from Codecanyon, Please read the full License from   *

// * here- http://codecanyon.net/licenses/standard                         *

// *                                                                       *

// *************************************************************************

 





// database connection config



error_reporting(E_ERROR | E_WARNING | E_PARSE);
ob_start();
session_start();

require('config.php');

$dbConn = mysqli_connect($db_host, $db_user, $db_password, $db_name) or die('MySQL connect failed. ' . mysqli_connect_error());



function dbQuery($sql)

{

	global $dbConn;

	$result = mysqli_query($dbConn, $sql) or die(mysqli_error($dbConn));

	return $result;

}



function dbAffectedRows()

{

	global $dbConn;	

	return mysqli_affected_rows($dbConn);

}



function dbFetchArray($result, $resultType = MYSQLI_ASSOC)

{

	return mysqli_fetch_array($result, $resultType);

}



function dbFetchAssoc($result)

{

	return mysqli_fetch_assoc($result);

}



function dbFetchRow($result)

{

	return mysqli_fetch_row($result);

}



function dbFreeResult($result)

{

	return mysqli_free_result($result);

}

function dbRealEscape($result)

{   global $dbConn;	

	return mysqli_real_escape_string($dbConn,$result);

}



function dbNumRows($result)

{

	return mysqli_num_rows($result);

}



function dbSelect($dbName)

{

	global $dbConn;

	return mysqli_select_db($dbConn, $dbName);

}



function dbInsertId()

{

	global $dbConn;

	return mysqli_insert_id($dbConn);

}



?>