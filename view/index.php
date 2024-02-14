<?php
ob_start();
include_once '../controller/SessionController.php';

if (isset($_GET['clSession']) && $_GET['clSession'] == true && isset($_SESSION['userSession'])) {
    session_unset();
    session_destroy();
}

if (isset($_SESSION['userSession'])) {
    header('Location: menu.php');
}

if (isset($_POST['itsLogin'])) {
    $user = UsuarioController::findByUser($_POST['ittName']);
    $password = password_hash($_POST['itpPass'], PASSWORD_DEFAULT);
   // if (hash_equals($user->pass, $password)) {
    if ($_POST['ittName'] == $_POST['itpPass']) {
        $_SESSION['userSession'] = $user;
        header('Location: menu.php');
    } else {
        echo'<p>Usuario o clave incorrecta</p>';
    }
}
?>
<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        <h1>Gestion de citas ITV Andalucía</h1>

        <form action="" method="POST">
            Usuario: <input type="text" name="ittName"> <br>
            Contraseña: <input type="password" name="itpPass"> <br>
            <input type="submit" name="itsLogin" value="Acceder"> <br>
        </form>

    </body>
</html>
<?php
ob_end_flush();
?>
