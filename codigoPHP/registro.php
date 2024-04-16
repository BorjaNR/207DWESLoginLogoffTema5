<?php
/**
 * @author Borja Nuñez Refoyo
 * @version 2.0 
 * @since 15/04/2024
 */
// Estructura del boton cancelar, si el ususario pulsa el botón
if (isset($_REQUEST['volver'])) {
    header('Location: Login.php'); // Llevo al usuario a la pagina 'login.php'
    exit();
}

//Incluimos el archivo de configuración de la conexión a la base de datos
require_once '../config/confDBPDO.php';
//Incluimos la libreria de validación de formularios
require_once '../core/231018libreriaValidacion.php';

//Creamos e inicializamos las variables imprescindibles para este ejercicio
$entradaOK = true; //Variable que nos indica que todo va bien
//Array donde recogemos los mensajes de error
$aErrores = [
    'codUsuario' => '',
    'password' => '',
    'descUsuario'
];
//Array donde recogeremos la respuestas correctas (si $entradaOK)
$aRespuestas = [
    'codUsuario' => '',
    'password' => '',
    'descUsuario'
];
$_REQUEST['fechaCreacion'] = date('Y-m-d H:i:s'); //Inicializamos la fecha actual ya que es un campo desabilitado
//Cargar valores por defecto en los campos del formulario
//Para cada campo del formulario: Validar entrada y actuar en consecuencia
if (isset($_REQUEST['enviar'])) {
    //Valido la entrada de codigo departamento
    $aErrores['codUsuario'] = validacionFormularios::comprobarAlfabetico($_REQUEST['codUsuario'], 8, 3, 1);
    $aErrores['password'] = validacionFormularios::comprobarAlfabetico($_REQUEST['password'], 8, 3, 1);
    $aErrores['descUsuario'] = validacionFormularios::comprobarAlfabetico($_REQUEST['descUsuario'], 255, 3, 1);

    // Ahora validamos que el codigo introducido no exista en la BD, haciendo una consulta 
    if ($aErrores['codUsuario'] == null) {
        try {
            $miDB = new PDO(DSN, USERNAME, PASSWORD);
            // CONSULTA
            // Utilizamos una consulta simple para comprobar el codigo del usuario
            $consultaComprobarCodUsuario = $miDB->prepare("SELECT * FROM T01_Usuario WHERE T01_CodUsuario = ?");
            $consultaComprobarCodUsuario->execute([$_REQUEST['codUsuario']]);
            // Y obtenemos el resultado de la consulta como un objeto.
            $oUsuarioExistente = $consultaComprobarCodUsuario->fetchObject();
            // COMPROBACION DE ERRORES
            // Caso de que el usuario exista
            if ($oUsuarioExistente) {
                $aErrores['T01_CodUsuario'] = "El usuario ya existe";
            }
        } catch (PDOException $pdoe) {
            echo ('<p style="color:red">EXCEPCION PDO</p>' . $pdoe->getMessage());
        } finally {
            unset($miDB); //Para cerrar la conexión
        }
    }
    //Recorremos los errores para ver si hay alguno
    foreach ($aErrores as $campo => $error) {
        if ($error == !null) {
            $entradaOK = false;
            //Limpiar campos malos
            $_REQUEST[$campo] = '';
        }
    }
} else {
    $entradaOK = false;
}

//Tratamiento del formulario
if ($entradaOK) {
    $aRespuestas['codUsuario'] = $_REQUEST['codUsuario'];
    $aRespuestas['password'] = $_REQUEST['password'];
    $aRespuestas['descUsuario'] = $_REQUEST['descUsuario'];
    
    $hashResumen = hash("sha256", ($aRespuestas['codUsuario'] . $aRespuestas['password']));
    try {
        $smnt = "INSERT INTO T01_Usuario (T01_CodUsuario, T01_Password, T01_DescUsuario) VALUES ('"
                . $aRespuestas['codUsuario'] . "','" . $hashResumen . "','" . $aRespuestas['descUsuario'] . "');";
        $consultaInsertarUsuario = $miDB->prepare($smnt);
        $consultaInsertarUsuario->execute();
        
        // Configuramos sesiones para almacenar la información del usuario
        session_start();
        $_SESSION['usuarioDAW207LoginLogOffTema5'] = $aRespuestas['codUsuario'];
        $_SESSION['numConexionActual'] = $numConexionesActual;
        $_SESSION['fechaUltimaConexionAnterior'] = $fechaHoraUltimaConexionAnterior;
        

        // Preparar la consulta SQL para actualizar los datos
        $consultaPreparada = $miDB->prepare("UPDATE T01_Usuario SET T01_NumConexiones = $numConexionesActual, T01_FechaHoraUltimaConexion = CURRENT_TIMESTAMP WHERE T01_CodUsuario = ".$aRespuestas['T01_CodUsuario']."");
            
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
            <title>registro</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../webroot/css/main.css"/>
        </head>
        <body>
            <header class="text-center bg-secondary text-white" style="height: 75px">
                <h3>Registro</h3>
            </header>
            <main style="margin-bottom: 75px" class="fs-5 text-center">
                <form class="w-40 position-absolute top-50 start-50 translate-middle" name="fomrulario" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="mb-3">
                        <label class="form-label">Codigo de Usuario</label>
                        <input type="text" class="form-control bg-warning" name="codUsuario" value="<?php echo (isset($_REQUEST['codUsuario']) ? $_REQUEST['codUsuario'] : ''); ?>">
                        <?php echo (!empty($aErrores["codUsuario"]) ? '<span style="color: red;">' . $aErrores["codUsuario"] . '</span>' : ''); //Esto es para mostrar el mensaje de error en color rojo  ?>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="password" class="form-control bg-warning" name="password" value="<?php echo (isset($_REQUEST['password']) ? $_REQUEST['password'] : ''); ?>">
                        <?php echo (!empty($aErrores["password"]) ? '<span style="color: red;">' . $aErrores["password"] . '</span>' : ''); //Esto es para mostrar el mensaje de error en color rojo  ?>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Decripcion Usuario</label>
                        <input type="text" class="form-control bg-warning" name="descUsuario" value="<?php echo (isset($_REQUEST['descUsuario']) ? $_REQUEST['descUsuario'] : ''); ?>">
                        <?php echo (!empty($aErrores["descUsuario"]) ? '<span style="color: red;">' . $aErrores["descUsuario"] . '</span>' : ''); //Esto es para mostrar el mensaje de error en color rojo  ?>
                    </div>
                    <input class="btn btn-primary" name="enviar" type="submit" value="Registrarse">
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
                        <a title="Inicio" href="./Login.php"><img src="../webroot/images/casa.png" width="40" height="40" alt="Inicio"/></a>
                        <a title="GitHub" href="https://github.com/BorjaNR/207DWESLoginLogoffTema5" target="blank"><img src="../webroot/images/git.png" width="40" height="40" alt="GitHub"/></a>
                    </div>
                </div>
            </div>
        </footer>
        <script src="./webroot/js/mainjs.js" ></script>
    </body>
</html>

