<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administrador</title>
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/cuerpo.css">
 
</head>
<body>
    <article>
    <nav>
        <ul>
            <li><a href="admin.php?pagina=cargo.php">Cargo</a></li>
            <li><a href="registro.php">Registro</a></li><!--agregue esto admin.php?-->
            <li><a href="admin.php?pagina=productos.php">Productos</a></li>
            <li><a href="admin.php?pagina=pedidos.php">Pedidos</a></li>
            <li><a href="admin.php?pagina=cliente.php">Clientes</a></li>
            <li><a href="admin.php?pagina=reportes.php">Reportes</a></li>
            <li><a href="admin.php?pagina=congfi.php">Configuraciones</a></li>

        </ul>
    </nav>
    <?php
        if(isset($_GET["pagina"])){
            include($_GET["pagina"]);
        }
        else{

        }
    ?>
</article>
</body>
</html>