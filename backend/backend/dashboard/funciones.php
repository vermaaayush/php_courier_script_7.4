<?php
// *************************************************************************
// *                                                                       *
// * DEPRIXA - Integrated Web system v3.2.1                                *
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
 


function getParam($param, $default) {
	$result = $default;
	if (isset($param)) {
  		$result = (get_magic_quotes_gpc()) ? $param : addslashes($param);
	}
	return $result;
}
function sqlValue($value, $type) {
  $value = get_magic_quotes_gpc() ? stripslashes($value) : $value;
 $value = function_exists("dbRealEscape") ? dbRealEscape($value) : dbRealEscape($value);
  switch ($type) {
    case "text":
      $value = ($value != "") ? "'" . $value . "'" : "NULL";
      break;
    case "int":
      $value = ($value != "") ? intval($value) : "NULL";
      break;
    case "double":
      $value = ($value != "") ? "'" . doubleval($value) . "'" : "NULL";
      break;
    case "date":
      $value = ($value != "") ? "'" . $value . "'" : "NULL";
      break;
  }
  return $value;
}

function nombre($doc){
	$sql=dbQuery("SELECT name_parson FROM manager_admin WHERE pwd='$doc'");
	if($row=dbFetchArray($sql)){
		return $row['name_parson'];
	}else{
		return 'ERROR';	
	}
}

function nombre1($doc){
	$sql=dbQuery("SELECT name_parson FROM manager_user WHERE name = '$user' AND pwd = '$doc'");
	if($row=dbFetchArray($sql)){
		return $row['name_parson'];
	}else{
		return 'ERROR';	
	}
}												

function consultar($campo,$tabla,$where){
	$sql=dbQuery("SELECT * FROM $tabla WHERE $where");
	if($row=dbFetchArray($sql)){
		return $row[$campo];
	}else{
		return '';	
	}
}

function claves($pwd){
	$llave1='Gbj49j4jljdh2323n5nNnHHnFFG5JJ';
	$llave2='HNFkkstjotBhrMi489ndVjdllu75jH';
	$pwd2=strrev($pwd);
	return sha1($llave1.$llave2.$pwd.$llave1.$pwd2.$pwd.$llave2.$pwd2.$llave2.$llave1.$pwd2);
}


function mensajes($mensaje,$tipo){
	if($tipo=='verde'){
		$tipo='alert alert-success';
	}elseif($tipo=='rojo'){
		$tipo='alert alert-error';
	}elseif($tipo=='azul'){
		$tipo='alert alert-info';
	}
	return '<div class="'.$tipo.'" align="center">
		  <button type="button" class="close" data-dismiss="alert">×</button>
		  <strong>'.$mensaje.'</strong>
		</div>';
}

function formato($valor){
	return number_format($valor,2, '.', ',');
}

function countries($doc){
	$sql=dbQuery("SELECT country_name FROM countries WHERE 	country_id='$doc'");
	if($row=dbFetchArray($sql)){
		return $row['country_name'];
	
	}
}

function department($doc){
	$sql=dbQuery("SELECT state_name FROM states WHERE 	state_id='$doc'");
	if($row=dbFetchArray($sql)){
		return $row['state_name'];
	
	}
}

function city($doc){
	$sql=dbQuery("SELECT city_name FROM cities WHERE city_id='$doc'");
	if($row=dbFetchArray($sql)){
		return $row['city_name'];
	
	}
}

function limpiar($tags){
		$tags = strip_tags($tags);
		return $tags;
	}

?>