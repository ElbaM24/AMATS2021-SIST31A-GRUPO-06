<?php

require_once("cnn.php");

use PHPUnit\Framework\TestCase;

final class testinsert extends TestCase
{

	public function insertar()
	{
		$obj= new clsConexion();
		$this->assertEquals("INSERT INTO $tabla ($campos)VALUES ($valores)",$obj->insertarSQL($tabla,$cam,$val));
	}

}

?>