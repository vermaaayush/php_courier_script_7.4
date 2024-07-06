<?php
require_once("../database.php");
header('Content-Type: application/json');
 $cid = $_GET['cid'];
 $consulta_mysql="SELECT * FROM courier WHERE  cid=$cid";
$resultado_consulta_mysql=dbQuery($consulta_mysql);	
if (dbNumRows($resultado_consulta_mysql) > 0) {
    $data =dbFetchAssoc($resultado_consulta_mysql);
    echo json_encode($data);
} else {
    echo json_encode(['error' => 'No data found']);
}

?>