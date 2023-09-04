<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$database = "control_acceso_usuario";


$conexion = mysqli_connect($servername, $username, $password, $database):  or die  ($conexion->conexion_error) {
    die("Error de conexión: " . $conexion->conexion_error);
}



?>
