<?php
//Comprobamos si pulsa el boton login
if (isset($_REQUEST['login'])) {
    // Redirige a la página de login
    header('Location: codigoPHP/Login.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>ProyectoLoginLogoffTema5</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="webroot/css/main.css"/>
    </head>
    <body>
        <header class="text-center bg-secondary text-white">
            <h1>LoginLogoff Tema 5</h1>
        </header>
        <main style="margin-bottom: 75px" class="fs-5 text-center">
            <img src="./webroot/images/ProyectoLoginLogoff1.PNG" class="img-fluid" alt="Mapeo de la Aplicación">
            <form name="fomrulario" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input class="btn btn-primary" name="login" type="submit" value="Login">
            </form>
        </main>
        <footer class="text-center bg-secondary fixed-bottom py-3">
            <div class="container">
                <div class="row">
                    <div class="col text-center text-white">
                        <p>&copy;2023-24 IES los Sauces. Todos los derechos reservados. <a href="../index.html" style="color: white; text-decoration: none">Borja Nuñez Refoyo</a></p>
                    </div>
                    <div class="col text-end">
                        <a title="Inicio" href="../207DWESProyectoDWES/indexProyectoDWES.html"><img src="./webroot/images/casa.png" width="40" height="40" alt="Inicio"/></a>
                        <a title="GitHub" href="https://github.com/BorjaNR/207DWESProyectoTema4" target="blank"><img src="./webroot/images/git.png" width="40" height="40" alt="GitHub"/></a>
                    </div>
                </div>
            </div>
        </footer>
        <script src="./webroot/js/mainjs.js" ></script>
    </body>
</html>
