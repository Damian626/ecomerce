<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['submit'])){
   /*declaracion de variables*/
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE name = ?");
   $select_admin->execute([$name]);
 /*condicional para mensajes sobre la creacion de nuevo admin*/
   if($select_admin->rowCount() > 0){
      $message[] = 'el nombre de usuario ya esta en uso';
   }else{
      if($pass != $cpass){
         $message[] = 'no coinciden las contraseñas';
      }else{
         $insert_admin = $conn->prepare("INSERT INTO `admin`(name, password) VALUES(?,?)");
         $insert_admin->execute([$name, $cpass]);
         $message[] = 'Registro exitoso';
      }
   }

}

?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Registrar admin</title>
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="icon" href="../img/agregar_usuario.ico">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="formulario-container">
<!--formulario para registrar un admin -->
   <form action="" method="post">
      <h3>Registrarse</h3>
      <input type="text" name="name" required placeholder="Ingrese su nombre de usuario" maxlength="20"  class="caja" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="Ingrese su contraseña" maxlength="20"  class="caja" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" required placeholder="Confirme su contraseña" maxlength="20"  class="caja" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="Registrar ahora" class="btn" name="submit">
   </form>

</section>

<script src="../js/admin_script.js"></script>
   
</body>
</html>