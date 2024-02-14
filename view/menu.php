<?php
include_once '../controller/SessionController.php';

if (!isset($_SESSION['userSession'])) {
    header('Location: index.php');
}

if (isset($_GET['clSession']) && $_GET['clSession'] == true) {
    session_unset();
    session_destroy();
}
?>
<html>
    <head>
        <title>Menu</title>
    </head>
    <body>
        <h1>
            Hola Administrador de <?php echo $_SESSION['userSession']->provincia; ?>
        </h1>
        <p>Teléfono: <?php echo $_SESSION['userSession']->telefono; ?></p>
        <a href="index.php?clSession=true">Cerrar sesión</a>
        <h1>
            Gestion de citas de las ITV de  <?php echo $_SESSION['userSession']->provincia; ?>
        </h1>
        
        <a href="nuevacita.php">Registrar nueva cita</a>
        <br>
        <a href="listasITV.php">Listado sedes ITV</a>
    </body>
</html>
