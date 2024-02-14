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
        <title>Ficha ITV</title>
    </head>
    <body>

        <h1>
            Hola Administrador de <?php echo $_SESSION['userSession']->provincia; ?>
        </h1>
        <p>Teléfono: <?php echo $_SESSION['userSession']->telefono; ?></p>
        <a href="index.php?clSession=true">Cerrar sesión</a>
        <br>

        <h1>
            Ficha
        </h1>
        <img src="<?php echo $_GET['fPath']; ?>" alt="Ficha itv" width="500"/>
    </body>
</html>
