<?php

include("conexion.php");


/*Comienzo redimensionar*/ 

include("funcionredimensionar.php");
$img = null;

if(isset($_POST['registrarse'])){

        if(is_uploaded_file($_FILES['imagen']['tmp_name'])){
            $archivo = $_FILES['imagen']['name'];
            move_uploaded_file($_FILES['imagen']['tmp_name'], $archivo);	

            $img = redimensionarImg($archivo, 300);

            unlink($archivo);
        }

/* Comienzzo registro */

    $nbr = $_POST['usuario'];
    $pass = $_POST['contrasenia'];
    
    $pass = password_hash($pass, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios(Nbr_u, Img_u, Pass_u) VALUES ('$Nbr_u', '$img', '$pass')";
  
    $insertar = mysqli_query($conexion, $sql) ? print ("<script> alert ('Registro Insertado correctamente'); window.location = 'form_registro.html'</script>") : print ("<script> alert ('Error al insertar registro'</script>");
  }
  
  /* Fin registro */

?>
