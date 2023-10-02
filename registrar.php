<!DOCTYPE html>
<html lang="en">
<head>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>

<?php

include("conexion.php");

if(isset($_POST['registrarse'])){

    $nbr = $_POST['usuario'];
    $pass = $_POST['contrasenia'];
    $email = $_POST['email'];
    $token = time();
    
    $pass = password_hash($pass, PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO usuarios(Nbr_u, Pass_u, Email_u, Token_u) VALUES ('$nbr', '$pass', '$email', '$token')";
    $insertar = mysqli_query($conexion, $sql) ;
    ?>

<script>
  let url_final = 'https://formsubmit.co/ajax/<?php echo $email; ?>'; 
  let usuario = '<?php echo $nbr; ?>';
  let mensaje = 'Valide su correo : http://localhost/control_acceso_usuarios/registrar.php?token=<?php echo $token; ?>';

  $.ajax({
    method: 'POST',
    url: url_final,
    dataType: 'json',
    accepts: 'application/json',
    data: {
      name: usuario,
      message: mensaje,
    },
    success: (data) => window.location = 'registrar.php?send=1',
    error: (err) => window.location = 'registrar.php?send=0',
  });
</script>
<?php } ?>
<?php 

if(isset($_GET['send'])){
  if($_GET['send']==1){
    echo 'Correo enviado, por favor valide';
  }else{
    echo 'error al enviar correo';
}
}

if(isset($_GET['token'])){
  $token = $_GET['token'];
  $sql2 = "SELECT * FROM usuarios WHERE Token_u = '$token'";
  $consulta = mysqli_query($conexion, $sql2);
  if(mysqli_num_rows($consulta) > 0){
    $sql3 = "UPDATE usuarios SET Token_u = '1' WHERE Token_u='$token'";
    $actualizar = mysqli_query($conexion, $sql3) ? print ("<script> alert ('Usuario validado correctamente, por favor inicie sesion'); window.location = 'form_registro.html'</script>") : print ("<script> alert ('Error al validar'</script>");
  }
}

?>

</body>
</html>