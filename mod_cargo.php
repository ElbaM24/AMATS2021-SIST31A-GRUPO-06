<?php
require_once("conexion/cnn.php");
$obj = new clsConexion();

if (isset($_POST["modificar"])) {  //si presionamos el boton para insertar
    $cargo = $_POST["cargo"];
    $sqlinsert = "
	update cargo set cargo='$cargo' where id_cargo='" . $_GET["id_cargo"] . "'
	";
    $rs=$obj->consultasql($sqlinsert);
    //$rs = $conn->query($sqlinsert);
    echo "<script>alert('Dato modificado');window.location='?pagina=cargo.php';	</script>";
}
$sql = "select * from cargo where id_cargo='" . $_GET["id_cargo"] . "'";
$rs = $obj->consultasql($sql);
$fila = $rs->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="col-sm-8">
        <h2>MODIFICAR CARGO</h2>
        <h5>fecha, <?php echo date("d-m-Y"); ?></h5>
        <form method="post">
            <div class="form-group">
                      <!-- id -->
                <label for="username"> ID
                <input readonly value="<?php echo $fila["id_cargo"]; ?>" type="text">
                <label for="cargo">CARGO</label>
                <input type="text" class="form-control" name="cargo" placeholder="Digite el nuevo nombre del cargo" id="cargo" value="<?php echo $fila["cargo"]; ?>">
            </div>
            <input type="submit" name="modificar" class="btn btn-primary" value="Guardar Modificación">
        </form>
        <br>
    </div>
</body>
</html>
