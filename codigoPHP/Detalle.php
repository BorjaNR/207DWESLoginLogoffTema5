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
//Si le da al boton volver vuelve a la pagina de programa.php
if (isset($_REQUEST['volver'])) {
    header('Location:Programa.php'); 
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>ejercicio03</title>
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
                echo "<p>Bienvenido, {$_SESSION['usuarioDAW207LoginLogOffTema5']}</p><br>";
                echo "<p>Esta es tu {$_SESSION['numConexiones']} vez que te conectas</p><br>";
                echo $ultimaConexion;
            ?>
            <form method="post" action="">
                <input class="btn btn-primary"" type="submit" name="cerrar_sesion" value="Cerrar Sesión">
                <input class="btn btn-primary" type="submit" name="detalle" value="Detalle">
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

