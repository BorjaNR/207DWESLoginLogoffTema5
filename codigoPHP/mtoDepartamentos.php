<?php
/**
    * @author Borja Nuñez Refoyo
    * @version 2.0 
    * @since 15/04/2024
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
        <title>Mto.Departamentos</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../webroot/css/main.css"/>
    </head>
    <body>
        <header class="text-center bg-secondary text-white" style="height: 75px;">
            <h3>Mto. Departamentos</h3>
        </header>
        <main style="margin-bottom: 75px; margin-top: 20px;" class="fs-5 text-center">
            <form class="position-absolute top-0 end-0" style="margin-top: 85px; margin-right: 15px" name="fomrulario" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input class="btn btn-primary" name="volver" type="submit" value="Volver">
            </form>
            <?php
                    //Incluimos el archivo de configuración de la conexión a la base de datos
            require_once '../config/confDBPDO.php';

            //Utilizamos el bloque try catch para intentar la conexión a la base de datos
            try {
                //Intentamos establecer la conexión con la base de datos
                $miDB = new PDO(DSN, USERNAME, PASSWORD);

                //Preparamos la consulta y la ejecutamos
                $consultaPreparada = $miDB->prepare("SELECT * FROM T02_Departamento");
                $consultaPreparada->execute();

                //Creamos la tabla
            ?>
                <div class="container t-container">
                    <table class="table table-striped table-bordered" style="margin-bottom: 75px;"> 
                        <tr class="table-secondary">
                            <th>Codigo de Departamento</th>
                            <th>Descripcion de Departamento</th>
                            <th>Fecha de Creacion</th>
                            <th>Volumen de Negocio</th>
                            <th>Fecha de Baja</th>
                        </tr>
                        <?php
                        /* Aqui recorremos todos los valores de la tabla, columna por columna, usando el parametro 'PDO::FETCH_ASSOC' , 
                         * el cual nos indica que los resultados deben ser devueltos como un array asociativo, donde los nombres de las columnas de 
                         * la tabla se utilizan como claves (keys) en el array.*/
                        while ($oDepartamento = $consultaPreparada->fetchObject()) {
                            echo '<tr>';
                                echo "<td>" . $oDepartamento->T02_CodDepartamento . "</td>";
                                echo "<td>" . $oDepartamento->T02_DescDepartamento . "</td>";
                                echo "<td>" . $oDepartamento->T02_FechaCreacionDepartamento . "</td>";
                                echo "<td>" . $oDepartamento->T02_VolumenDeNegocio . "</td>";
                                echo "<td>" . $oDepartamento->T02_FechaBajaDepartamento . "</td>";
                            echo '</tr>';
                        }
                        ?>
                        <tr>
                            <td colspan="5"><?php echo "Numero de registros en la tabla departamentos: " . $consultaPreparada->rowCount(); ?></td>
                        </tr>
                    </table>
                </div>
            <?php
                } catch (PDOException $pdoe) {
                    echo ('<p style="color:red">EXCEPCION PDO</p>' . $pdoe->getMessage());
                }finally{
                    unset($miDB); //Para cerrar la conexión
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
                        <a title="Inicio" href="./Programa.php"><img src="../webroot/images/casa.png" width="40" height="40" alt="Inicio"/></a>
                        <a title="GitHub" href="https://github.com/BorjaNR/207DWESLoginLogoffTema5" target="blank"><img src="../webroot/images/git.png" width="40" height="40" alt="GitHub"/></a>
                    </div>
                </div>
            </div>
        </footer>
        <script src="./webroot/js/mainjs.js" ></script>
    </body>
</html>

