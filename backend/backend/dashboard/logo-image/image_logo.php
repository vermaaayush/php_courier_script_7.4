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

ob_start();

session_start();

require_once('../database.php');



if ($_GET['id'] > 0)

{

    // Consulta de búsqueda de la imagen.

    $consulta = "SELECT imagen, tipo FROM subir_imagen WHERE id={$_GET['id']}";

    $resultado = dbQuery($consulta);

    $datos = dbFetchAssoc($resultado);



    $imagen = $datos['imagen']; // Datos binarios de la imagen.

    $tipo = $datos['tipo'];  // Mime Type de la imagen.

    ob_clean();

    header("Content-type: $tipo");

    echo $imagen;

}

?>

session_start();

require_once('../database.php');



if ($_GET['id'] > 0)

{

    // Consulta de búsqueda de la imagen.

    $consulta = "SELECT imagen, tipo FROM subir_imagen WHERE id={$_GET['id']}";

    $resultado = dbQuery($consulta);

    $datos = dbFetchAssoc($resultado);



    $imagen = $datos['imagen']; // Datos binarios de la imagen.

    $tipo = $datos['tipo'];  // Mime Type de la imagen.

    ob_clean();

    header("Content-type: $tipo");

    echo $imagen;

}

?>