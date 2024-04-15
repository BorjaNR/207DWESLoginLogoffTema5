<?php
// Si la cookie de idioma no está establecida, la creamos por defecto como español
if (!isset($_COOKIE['idioma'])) {
    setcookie("idioma", "es", time() + 86400);
}

// Comprobamos si pulsa el botón login
if (isset($_REQUEST['login'])) {
    // Redirige a la página de login
    header('Location: codigoPHP/Login.php');
    exit();
}

// Comprobamos si se ha pulsado un botón para cambiar el idioma
if (isset($_REQUEST['espanol'])) {
    // Cambiamos la cookie al idioma seleccionado y refrescamos la página
    setcookie("idioma", "es", time() + 86400);
    header('Location: indexLoginLogoffTema5.php');
    exit();
} elseif (isset($_REQUEST['ingles'])) {
    // Cambiamos la cookie al idioma seleccionado y refrescamos la página
    setcookie("idioma", "en", time() + 86400);
    header('Location: indexLoginLogoffTema5.php');
    exit();
} elseif (isset($_REQUEST['portugues'])) {
    // Cambiamos la cookie al idioma seleccionado y refrescamos la página
    setcookie("idioma", "pt", time() + 86400);
    header('Location: indexLoginLogoffTema5.php');
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
            <img src="./webroot/images/imgLogin.png" class="img-fluid" alt="Mapeo de la Aplicación">
            <form class="position-absolute top-0 end-0" style="margin-top: 60px; margin-right: 15px" method="post">
                <input class="btn btn-primary" name="login" type="submit" value="Login">
            </form>
            <form class="position-absolute top-0 start-0" method="post">
                <button type="submit" name="espanol" class="btn btn-secundary">
                    <img src="webroot/images/español.png" alt="es" width="40" height="40">
                </button>
                <button type="submit" name="ingles" class="btn btn-secundary">
                    <img src="webroot/images/ingles.png" alt="en" width="40" height="40"">
                </button>
                <button type="submit" name="portugues" class="btn btn-secundary">
                    <img src="webroot/images/portugues.png" alt="pt" width="40" height="40">
                </button>
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
                        <a title="GitHub" href="https://github.com/BorjaNR/207DWESLoginLogoffTema5" target="blank"><img src="./webroot/images/git.png" width="40" height="40" alt="GitHub"/></a>
                    </div>
                </div>
            </div>
        </footer>
        <script src="./webroot/js/mainjs.js" ></script>
    </body>
</html>
