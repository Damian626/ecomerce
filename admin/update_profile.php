<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   
   /*actualizacion del usuario*/
   $update_profile_name = $conn->prepare("UPDATE `admin` SET name = ? WHERE id = ?");
   $update_profile_name->execute([$name, $admin_id]);


   /*declaracion de variables, para contraseña actual, nueva y confirmacion de contraseña*/
   $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
   $prev_pass = $_POST['prev_pass'];
   $old_pass = sha1($_POST['old_pass']);
   $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
   $new_pass = sha1($_POST['new_pass']);
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   $confirm_pass = sha1($_POST['confirm_pass']);
   $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

   /*condicional para mensajes sobre la actualizacion de contraseña*/
   if($old_pass == $empty_pass){
      $message[] = 'Ingrese su contraseña actual'; 
   }elseif($old_pass != $prev_pass){
      $message[] = 'La contraseña actual no coincide';
   }elseif($new_pass != $confirm_pass){
      $message[] = 'Las contraseñas no coinciden';
   }else{
      if($new_pass != $empty_pass){
         $update_admin_pass = $conn->prepare("UPDATE `admin` SET password = ? WHERE id = ?");
         $update_admin_pass->execute([$confirm_pass, $admin_id]);
         $message[] = '¡Contraseña actualizada!';
      }else{
         $message[] = 'Por favor ingrese una nueva contraseña';
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
   <title>Actualizar Perfil</title>
   <link rel="icon" href="../img/actualizar.ico">
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="formulario-container">
   <!--Formulario para actualizar perfil-->
   <form action="" method="post">
      <h3>Actualizar Perfil</h3>
      <input type="hidden" name="prev_pass" value="<?= $fetch_profile['password']; ?>">
      <input type="text" name="name" value="<?= $fetch_profile['name']; ?>" required placeholder="Ingresa tu nombre de usuario" maxlength="20"  class="caja" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="old_pass" placeholder="Ingrese su contraseña actual" maxlength="20"  class="caja" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="new_pass" placeholder="Ingrese una nueva contraseña" maxlength="20"  class="caja" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="confirm_pass" placeholder="Ingrese nuevamente la contraseña" maxlength="20"  class="caja" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="Actualizar" class="btn" name="submit">
   </form>

</section>

<script src="../js/admin_script.js"></script>
   
</body>
</html>