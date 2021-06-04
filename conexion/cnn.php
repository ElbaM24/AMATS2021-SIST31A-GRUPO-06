<?php
//ahora
date_default_timezone_set("America/El_Salvador");
define("SERVIDOR","localhost");
define("USUARIO","root");
define("CLAVE","");
define("BASEDATOS","pupuseria");
class clsConexion{
	private $conn;
	public function __construct(){
		try{
			$this->conn=new mysqli(SERVIDOR,USUARIO,CLAVE,BASEDATOS);
		}catch(Exception $e){
			echo $e->errorMessage();
            //die("Error reportar al administrador ");
		}
	}
	public function consultasql($sentencia){
		$respuesta=$this->conn->query($sentencia);
		return $respuesta;
	}
	public function consultaGeneral($tabla,$campos,$condicion=null){
		if(!(is_null($condicion))){
			$condicion= " where $condicion";
		}
		$sql="select $campos from $tabla $condicion ";
		$respuesta=$this->conn->query($sql);
		return $respuesta;
	}
	
	public function insertarSQL($tabla,$cam,$val){
		$campos=implode(",",$cam);
		$valores="'".implode("','",$val)."'";
		$sql="INSERT INTO $tabla ($campos)VALUES ($valores)";
		$respuesta=$this->conn->query($sql);
		return 1;
	}
	
	public function eliminarSQL($tabla,$condicion){
		$sql="delete from $tabla where $condicion ";
		$respuesta=$this->conn->query($sql);
		return 1;
	}
    public function encriptar_desencriptar($accion,$string){
        $encriptarmetodo="AES-256-CBC";
        $palabrasecreta="pupuseriaencript";
        $iv='C9Bxl1EWtYTL1/M8jfstw=="';
        $key=hash('sha256',$palabrasecreta);
        $siv=substr(hash('sha256',$iv),0,16);
        if($accion=="encriptar"){
            $salida=openssl_encrypt($string,$encriptarmetodo,$key,0,$siv);
            $salida=base64_encode($salida);
        }elseif($accion=="desencriptar"){
			$a=base64_decode($string);
			$salida=openssl_decrypt($a,$encriptarmetodo,$key,0,$siv);
		}
        return $salida;
    }
	
} 

?>