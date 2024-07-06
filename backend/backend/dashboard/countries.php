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
 
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require_once('../dashboard/database.php');

$query="SELECT id,nombre FROM paises ORDER BY nombre";
$result = dbQuery($query)
        or die("Ocurrio un error en la consulta SQL");
mysqli_close();
echo '<option value="0">Seleccionar</option>';
while (($fila = dbFetchArray($result)) != NULL) {
    echo '<option value="'.$fila["id"].'">'.$fila["nombre"].'</option>';
}
// Liberar resultados
dbFreeResult($result);

// Cerrar la conexión
mysqli_close($dbConn);

?>
