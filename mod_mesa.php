<?php
require_once("conexion/cnn.php");
$obj = new clsConexion();

if (isset($_POST["modificar"])) {  //si presionamos el boton para insertar
    $mesa = $_POST["mesa"];
    $sqlinsert = "
	update mesa set detalle_mesa='$mesa' where id_mesa='" . $_GET["id_mesa"] . "'
	";
    $rs=$obj->consultasql($sqlinsert);
    //$rs = $conn->query($sqlinsert);
    echo "<script>alert('Dato modificado');window.location='?pagina=mesa.php';	</script>";
}
$sql = "select * from mesa where id_mesa='" . $_GET["id_mesa"] . "'";
$rs = $obj->consultasql($sql);
$fila = $rs->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="col-sm-8">
        <h2>MODIFICAR MESA</h2>
        <h5>fecha, <?php echo date("d-m-Y"); ?></h5>
        <form method="post">
            <div class="form-group">
                      <!-- id -->
                <label for="username"> ID
                <input readonly value="<?php echo $fila["id_mesa"]; ?>" type="text">
                <label for="mesa">mesa</label>
                <input type="text" class="form-control" name="mesa" placeholder="Digite el nuevo nombre del mesa" id="mesa" value="<?php echo $fila["detalle_mesa"]; ?>">
            </div>
            <input type="submit" name="modificar" class="btn btn-primary" value="Guardar Modificación">
        </form>
        <br>
    </div>
</body>
</html>
