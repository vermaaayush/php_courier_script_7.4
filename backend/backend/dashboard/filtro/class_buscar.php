<?php

class Consultar_Envio{
	private $consulta;
	private $fetch;
	
	function __construct($codigo,$guia){
		$this->consulta = dbQuery("SELECT * FROM envio WHERE id='$guia' and codigo='$codigo'");
		$this->fetch = dbFetchArray($this->consulta);
	}
	
	function consultar($campo){
		return $this->fetch[$campo];
	}
}


class Consultar_Usuario{
	private $consulta;
	private $fetch;
	
	function __construct($codigo){
		$this->consulta = dbQuery("SELECT * FROM username, persona WHERE username.usu=persona.doc and username.usu='$codigo'");
		$this->fetch = dbFetchArray($this->consulta);
	}
	
	function consultar($campo){
		return $this->fetch[$campo];
	}
}

class Consultar_Departamento{
	private $consulta;
	private $fetch;
	
	function __construct($codigo){
		$this->consulta = dbQuery("SELECT * FROM dpto WHERE id='$codigo'");
		$this->fetch = dbFetchArray($this->consulta);
	}
	
	function consultar($campo){
		return $this->fetch[$campo];
	}
}

class Consultar_Vehiculo{
	private $consulta;
	private $fetch;
	
	function __construct($codigo){
		$this->consulta = dbQuery("SELECT * FROM vehiculo WHERE id='$codigo' or vehiculo='$codigo'");
		$this->fetch = dbFetchArray($this->consulta);
	}
	
	function consultar($campo){
		return $this->fetch[$campo];
	}
}
?>