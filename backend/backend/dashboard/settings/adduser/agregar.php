<?php
// *************************************************************************
// *                                                                       *
// * DEPRIXA -  logistics Worldwide Software                               *
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
session_start();
require_once('../../database.php');
require_once('../../config.php');


	$name_parson = $_POST['name_parson'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$office = $_POST['office'];
	$role = $_POST['role'];
	$password = $_POST['pwd'];
	$pwdmd5 = md5($password);
	$imagen = $_POST['imagen'];
	$tipo_imagen = $_POST['tipo_imagen'];
	
	// verificamos si esta marcado el check box activo
	if(isset($_POST['estado']))
	$estado = $_POST['estado'];
	else
	$estado = 0;

	if(isset($_POST['type']))
	$type = $_POST['type'];
	else
	$type = 0;

		#
	## Cargo la imagen por defecto
	$tipo_imagen = "image/png";
	$url = APP_URL."/img/user_image.png";

	$imagen = imagecreatefromstring(file_get_contents($url));
	imagealphablending($imagen, true);
	imagesavealpha($imagen, true);

	ob_start();
	imagepng($imagen);
	$string = ob_get_contents();
	ob_end_clean();
	
		
	$sql1 =dbQuery("SELECT email,name FROM manager_user WHERE email='$email' OR name='$name'");
			if($row=dbFetchArray($sql1)){							
				 echo "<script type=\"text/javascript\">
						alert(\"The email $email and name of user $name already is are registered in the database, by Please enter data different, thank you.\");
						window.location = \"../../add-new-users.php\"
					</script>"; 							
			}else{
				$sql1="INSERT INTO manager_user (name_parson,name,email,phone,office,role,pwd,estado,type,date,imagen, tipo_imagen) VALUES 	
				('$name_parson','$name','$email','$phone','$office','$role','$pwdmd5','$estado','$type',curdate(),'".dbRealEscape($string)."', '$tipo_imagen')";
			}
	dbQuery($sql1);
	
	echo "<script type=\"text/javascript\">
						alert(\"Thank you for your registration.\");
						window.location = \"../../add-new-users.php\"
					</script>"; 

?>