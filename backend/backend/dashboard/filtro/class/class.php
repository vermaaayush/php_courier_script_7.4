<?php

class Consultar_Tarifas{
	private $consulta;
	private $fetch;
	
	function __construct($codigo){
		$this->consulta = dbQuery("SELECT * FROM tarifas WHERE descrip LIKE '%$codigo%'");
		$this->fetch = dbFetchArray($this->consulta);
	}
	
	function consultar($campo){
		return $this->fetch[$campo];
	}
}
?>