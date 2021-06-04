<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Empleado</title>
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/cuerpo.css">
    
</head>
<body>
    <article>
    <nav  >
        <ul>
            <li><a href="empleado.php?pagina=pedidos.php">Pedidos</a></li>
            <li><a href="empleado.php?pagina=cliente.php">Clientes</a></li>
            <li><a href="empleado.php?pagina=congfi.php">Configuraciones</a></li>
         
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