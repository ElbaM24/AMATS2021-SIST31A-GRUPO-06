<?php?

require_once("cnn.php");

use PHPUnit\Framework\TestCase;

final class testconsulta extends TestCase
{

public function tesconsu() 
	{
		$obj= new clsConexion();
		$this->assert(" where $condicion",$obj->consultaGeneral($tabla,$campos,$condicion=null));
	}

}

?>