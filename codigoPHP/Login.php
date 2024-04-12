<?php
/**
    * @author Borja Nuñez Refoyo
    * @version 2.0 
    * @since 11/04/2024
    */
//Comprobamos si pulsa el boton volver
if (isset($_REQUEST['volver'])) {
    // Redirige al index
    header('Location: ../indexLoginLogoffTema5.php');
    exit();
}

//Incluimos la libreria de validacion de formularios
require_once '../core/231018libreriaValidacion.php';
//Configuración de conexión a la base de datos
require_once '../config/confDBPDO.php';

//Creamos e inicializamos las variables imprescindibles para este ejercicio
$entradaOK = true; //Variable que nos indica que todo va bien
//Array donde recogemos los mensajes de error
$aErrores = [
    'usuario' => '',
    'pass' => ''
];
$_REQUEST['fechaCreacion'] = date('Y-m-d H:i:s'); //Inicializamos la fecha actual ya que es un campo desabilitado
//Cargar valores por defecto en los campos del formulario
//Para cada campo del formulario: Validar entrada y actuar en consecuencia
if (isset($_REQUEST['enviar'])) {
    try {
        // Conexion a la base de datos
        $miDB = new PDO(DSN, USERNAME, PASSWORD);

        //Almacenamos el usuario y el resumen de la contraseña
        $usuario = $_REQUEST['usuario'];
        $hashResumen = hash('sha256', $_REQUEST['usuario'] . $_REQUEST['pass']);
        
        // Hacemos una consulta preparada para verificar las credenciales
        $consultaPreparada = $miDB->prepare("SELECT * FROM T01_Usuario WHERE T01_CodUsuario = '$usuario' AND T01_Password = '$hashResumen'");
        // Ejecutamos la consulta
        $consultaPreparada->execute();

        // Almacenamos el resultado de la query como objeto mediante FETCH_OBJ
        $oUsuarioActivo = $consultaPreparada->fetch(PDO::FETCH_OBJ);
        // Validar los campos
        $aErrores = [
            'usuario' => (!$oUsuarioActivo) ? 'Error de autentificacion. Vuelve a introducir las credenciales.' : validacionFormularios::comprobarAlfaNumerico($_REQUEST['usuario'], 32, 4, 1),
            'pass' => (!$oUsuarioActivo) ? 'Error de autentificacion. Vuelve a introducir las credenciales.' : validacionFormularios::validarPassword($_REQUEST['pass'], 32, 4, 2, 1)
        ];
        // Recorre aErrores para ver si hay alguno
        foreach ($aErrores as $campo => $valor) {
            if ($valor != null) {
                $entradaOK = false;
                // Limpiamos el campo
                $_REQUEST[$campo] = '';
            }
        }
    } catch (PDOException $pdoe) {
        echo ('<p style="color:red">EXCEPCION PDO</p>' . $pdoe->getMessage());
    } finally {
        unset($miDB); //Para cerrar la conexión
    }
} else {
    $entradaOK = false;
}

//Tratamiento del formulario
if ($entradaOK) {
    //Utilizamos el bloque try catch
    try{
        // Conexion a la base de datos
        $miDB = new PDO(DSN, USERNAME, PASSWORD);
        
        // Iniciar la sesión
        // Actualizamos la fecha y hora de la última conexión
        $fechaHoraUltimaConexionAnterior = $oUsuarioActivo->T01_FechaHoraUltimaConexion;
        
        // Incrementamos el número de conexiones
        $numConexionesActual = $oUsuarioActivo->T01_NumConexiones + 1;
        
        // Configuramos sesiones para almacenar la información del usuario
        session_start();
        $_SESSION['usuarioDAW207LoginLogOffTema5'] = $oUsuarioActivo->T01_DescUsuario;
        $_SESSION['numConexionActual'] = $numConexionesActual;
        $_SESSION['fechaUltimaConexionAnterior'] = $fechaHoraUltimaConexionAnterior;

        // Preparar la consulta SQL para actualizar los datos
        $consultaPreparada = $miDB->prepare("UPDATE T01_Usuario SET T01_NumConexiones = $numConexionesActual, T01_FechaHoraUltimaConexion = CURRENT_TIMESTAMP WHERE T01_CodUsuario = '$usuario'");
        
        // Ejecutamos la consulta
        $consultaPreparada->execute();
        
        // Redirigir a programa.php
        header("Location:Programa.php");
        
        // Asegurarse de que el script se detenga después de la redirección
        exit();
    } catch (PDOException $pdoe) {
        echo ('<p style="color:red">EXCEPCION PDO</p>' . $pdoe->getMessage());
    } finally {
        unset($miDB); //Para cerrar la conexión
    }
} else {
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../webroot/css/main.css"/>
    </head>
    <body>
        <header class="text-center bg-secondary text-white" style="height: 75px">
            <h3>Login</h3>
        </header>
        <main style="margin-bottom: 75px" class="fs-5 text-center">
            <form class="w-40 position-absolute top-50 start-50 translate-middle" name="fomrulario" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="mb-3">
                    <label class="form-label">Usuario</label>
                    <input type="text" class="form-control bg-warning" name="usuario" value="<?php echo (isset($_REQUEST['usuario']) ? $_REQUEST['usuario'] : ''); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input type="password" class="form-control bg-warning" name="pass" value="<?php echo (isset($_REQUEST['pass']) ? $_REQUEST['pass'] : ''); ?>">
                </div>
                <input class="btn btn-primary" name="enviar" type="submit" value="Inciar Sesion">
                <input class="btn btn-primary" name="volver" type="submit" value="Volver">
            </form>
            <?php
            }
            ?>
        </main>
        <footer class="text-center bg-secondary fixed-bottom py-3">
            <div class="container">
                <div class="row">
                    <div class="col text-center text-white">
                        <p>&copy;2023-24 IES los Sauces. Todos los derechos reservados. <a href="../../index.html" style="color: white; text-decoration: none">Borja Nuñez Refoyo</a></p>
                    </div>
                    <div class="col text-end">
                        <a title="Inicio" href="../indexLoginLogoffTema5.php"><img src="../webroot/images/casa.png" width="40" height="40" alt="Inicio"/></a>
                        <a title="GitHub" href="https://github.com/BorjaNR/207DWESLoginLogoffTema5" target="blank"><img src="../webroot/images/git.png" width="40" height="40" alt="GitHub"/></a>
                    </div>
                </div>
            </div>
        </footer>
        <script src="./webroot/js/mainjs.js" ></script>
    </body>
</html>