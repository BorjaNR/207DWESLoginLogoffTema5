<?php

/**
 * @author Borja Nuñez Refoyo
 * @version 2.0 
 * @since 11/04/2024
 */
// Recuperar la sesión
session_start();

//Si se intenta acceder a la pagina sin iniciar sesion redirige a la pagina de inicio de la aplicación
if (empty($_SESSION['usuarioDAW207LoginLogOffTema5'])) {
    // Redirige a la página de inicio
    header("Location:../indexLoginLogoffTema5.php");
    exit();
}
// Cerrar sesión al hacer clic en el botón
if (isset($_REQUEST['cerrar_sesion'])) {
    session_unset(); // Desvincula todas las variables de sesión
    session_destroy(); // Destruye la sesión
    header("Location:../indexLoginLogoffTema5.php"); // Redirige a la página de inicio de sesión
    exit();
}

// Ir a detalle al pulsar el boton
if (isset($_REQUEST['detalle'])) {
    header('Location:Detalle.php'); // Redirige a la página
    exit();
}

// Ir a mantenimiento departamentos
if (isset($_REQUEST['mto_departamentos'])) {
    header('Location:mtoDepartamentos.php'); // Redirige a la página
    exit();
}

// Define los mensajes según el idioma
if ($_COOKIE['idioma'] == 'es') {
    $bienvenida = "Bienvenido, {$_SESSION['usuarioDAW207LoginLogOffTema5']}.<br>";
    $numConexiones = "Esta es tu {$_SESSION['numConexionActual']} vez conectándote.<br>";
    if ($_SESSION['numConexionActual'] == 1) {
        $ultimaConexion = "Esta es la primera vez que te conectas";
    } else {
        $ultimaConexion = "Te conectaste por última vez {$_SESSION['fechaUltimaConexionAnterior']}.";
    }
} elseif ($_COOKIE['idioma'] == 'en') {
    $bienvenida = "Welcome, {$_SESSION['usuarioDAW207LoginLogOffTema5']}.<br>";
    $numConexiones = "This is your {$_SESSION['numConexionActual']} time logging in.<br>";
    if ($_SESSION['numConexionActual'] == 1) {
        $ultimaConexion = "This is the first time you connect";
    } else {
        $ultimaConexion = "You last logged in on {$_SESSION['fechaUltimaConexionAnterior']}.";
    }
}elseif ($_COOKIE['idioma'] == 'pt') {
    $bienvenida = "Bem-vindo, {$_SESSION['usuarioDAW207LoginLogOffTema5']}.<br>";
    $numConexiones = "Este é o seu login de  {$_SESSION['numConexionActual']} vezes.<br>";
    if ($_SESSION['numConexionActual'] == 1) {
        $ultimaConexion = "Esta é a primeira vez que você se conecta";
    } else {
        $ultimaConexion = "Você fez login pela última vez em {$_SESSION['fechaUltimaConexionAnterior']}.";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Programa</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../webroot/css/main.css"/>
    </head>
    <body>
        <header class="text-center bg-secondary text-white" style="height: 75px">
            <h3>Programa</h3>
        </header>
        <main style="margin-bottom: 75px" class="fs-5 text-center">
            <?php            
                //Muestro los mensajes
                echo "<p>$bienvenida, $numConexiones, $ultimaConexion<br>";
            ?>
            <img src="../webroot/images/imgLogin.png" class="img-fluid" alt="Mapeo de la Aplicación">
            <form class="position-absolute top-0 end-0" style="margin-top: 85px; margin-right: 15px" method="post" action="">
                <input class="btn btn-primary d-block"" type="submit" name="cerrar_sesion" value="Cerrar Sesión">
                <input class="btn btn-primary d-block" style="margin-top: 10px" type="submit" name="detalle" value="Detalle">
                <input class="btn btn-primary d-block" style="margin-top: 10px" type="submit" name="mto_departamentos" value="Mto. Departamentos">
            </form>          
        </main>
        <footer class="text-center bg-secondary fixed-bottom py-3">
            <div class="container">
                <div class="row">
                    <div class="col text-center text-white">
                        <p>&copy;2023-24 IES los Sauces. Todos los derechos reservados. <a href="../../index.html" style="color: white; text-decoration: none">Borja Nuñez Refoyo</a></p>
                    </div>
                    <div class="col text-end">
                        <a title="Inicio" href="./Login.php"><img src="../webroot/images/casa.png" width="40" height="40" alt="Inicio"/></a>
                        <a title="GitHub" href="https://github.com/BorjaNR/207DWESLoginLogoffTema5" target="blank"><img src="../webroot/images/git.png" width="40" height="40" alt="GitHub"/></a>
                    </div>
                </div>
            </div>
        </footer>
        <script src="./webroot/js/mainjs.js" ></script>
    </body>
</html>