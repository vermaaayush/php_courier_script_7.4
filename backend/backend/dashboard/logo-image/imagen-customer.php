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
 
ob_start();
//conexion a la base de datos
require '../database.php';
 
//si la variable imagen no ha sido definida nos dara un advertencia.
$id = $_GET['id'];
 
if ($id > 0){
    //vamos a crear nuestra consulta SQL
    $consulta = "SELECT imagen, tipo_imagen FROM  tbl_clients WHERE id = $id ";
    //con dbQuery la ejecutamos en nuestra base de datos indicada anteriormente
    //de lo contrario mostraremos el error que ocaciono la consulta y detendremos la ejecucion.
    $resultado= dbQuery($consulta);
 
    //si el resultado fue exitoso
    //obtendremos el dato que ha devuelto la base de datos
    $datos = dbFetchAssoc($resultado);
 
    //ruta va a obtener un valor parecido a "imagenes/nombre_imagen.jpg" por ejemplo
    $imagen = $datos['imagen'];
    $tipo = $datos['tipo_imagen'];
     
    //ahora colocamos la cabeceras correcta segun el tipo de imagen
    ob_clean();
    header("Content-type: $tipo");
    echo $imagen;
}
 
?>