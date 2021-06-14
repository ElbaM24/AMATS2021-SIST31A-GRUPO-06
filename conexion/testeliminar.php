<?php

require_once("cnn.php");

use PHPUnit\Framework\TestCase;

final class testeliminar extends TestCase
{

	public function eliminar()
	{
		$obj= new clsConexion();
		$this->assertEquals("delete from $tabla where $condicion ",$obj->eliminarSQL($tabla,$condicion));
	}

}

?>