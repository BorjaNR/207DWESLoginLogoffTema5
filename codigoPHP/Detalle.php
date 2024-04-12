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
        <title>Detalle</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../webroot/css/main.css"/>
    </head>
    <body>
        <header class="text-center bg-secondary text-white" style="height: 75px">
            <h3>Detalle</h3>
        </header>
        <main style="margin-bottom: 75px" class="fs-5 text-center">
            <form class="position-absolute top-0 end-0" style="margin-top: 85px; margin-right: 15px" name="fomrulario" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input class="btn btn-primary" name="volver" type="submit" value="Volver">
            </form>
            <?php
            /**
             * @author Borja Nuñez Refoyo
             * @version 2.0 
             * @since 09/04/2024
             */
            //Mostramos la variable $_SESSION
            if (isset($_SESSION)) {
                echo '<h3>Variable $_SESSION</h3>';
                foreach ($_SESSION as $key => $value) {
                    echo "<span class=\"fw-bolder\">$key:</span> $value<br>";
                }
            } else {
                echo('<h3>La variable $_SESSION no esta definida</h3>');
            }
            
            //Mostramos la variable $_COOKIE
            echo '<h3>Variable $_COOKIE</h3>';
            foreach ($_COOKIE as $key => $value) {
                echo "<span class=\"fw-bolder\">$key:</span> $value<br>";
            }
            
            //Mostramos la variable $_SERVER
            echo '<h3>Variable $_SERVER</h3>';
            foreach ($_SERVER as $key => $value) {
                echo "<span class=\"fw-bolder\">$key:</span> $value<br>";
            }
            
            //Mostramos la variable $_GET
            echo '<h3>Variable $_GET</h3>';
            foreach ($_GET as $key => $value) {
                echo "<span class=\"fw-bolder\">$key:</span> $value<br>";
            }
            
            //Mostramos la variable $_POST
            echo '<h3>Variable $_POST</h3>';
            foreach ($_POST as $key => $value) {
                echo "<span class=\"fw-bolder\">$key:</span> $value<br>";
            }
            
            //Mostramos la variable $_REQUEST
            echo '<h3>Variable $_REQUEST</h3>';
            foreach ($_REQUEST as $key => $value) {
                echo "<span class=\"fw-bolder\">$key:</span> $value<br>";
            }
            
            //Mostramos la variable $_FILES
            echo '<h3>Variable $_FILES</h3>';
            foreach ($_FILES as $key => $value) {
                echo "<span class=\"fw-bolder\">$key:</span> $value<br>";
            }
            
            //Mostramos la variable $_ENV
            echo '<h3>Variable $_ENV</h3>';
            foreach ($_ENV as $key => $value) {
                echo "<span class=\"fw-bolder\">$key:</span> $value<br>";
            }
            
            //Mostramos la variable $_GLOBALS
            echo '<h3>Variable $GLOBALS</h3>';
            foreach ($GLOBALS as $value) {
                var_dump($value);
                echo ("<br>");
            }
            phpinfo();
            ?>
        </main>
        <footer class="text-center bg-secondary fixed-bottom py-3">
            <div class="container">
                <div class="row">
                    <div class="col text-center text-white">
                        <p>&copy;2023-24 IES los Sauces. Todos los derechos reservados. <a href="../../index.html" style="color: white; text-decoration: none">Borja Nuñez Refoyo</a></p>
                    </div>
                    <div class="col text-end">
                        <a title="Inicio" href="./Programa.php"><img src="../webroot/images/casa.png" width="40" height="40" alt="Inicio"/></a>
                        <a title="GitHub" href="https://github.com/BorjaNR/207DWESLoginLogoffTema5" target="blank"><img src="../webroot/images/git.png" width="40" height="40" alt="GitHub"/></a>
                    </div>
                </div>
            </div>
        </footer>
        <script src="./webroot/js/mainjs.js" ></script>
    </body>
</html>

