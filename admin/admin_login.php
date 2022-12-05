<?php

include '../components/connect.php';

session_start();

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE name = ? AND password = ?");
   $select_admin->execute([$name, $pass]);
   $row = $select_admin->fetch(PDO::FETCH_ASSOC);

   if($select_admin->rowCount() > 0){
      $_SESSION['admin_id'] = $row['id'];
      header('location:dashboard.php');
   }else{
      $message[] = 'Nombre de usuario o la contraseña son ¡incorrectos!';
   }

}

?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Ingresar</title>

   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="icon" href="../img/register.ico">

</head>
<body>

<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>

<section class="formulario-container">

   <form action="" method="post">
      <h3>Iniciar sesión </h3>
      <p>el nombre por defecto = <span>admin</span> y la contraseña = <span>111</span></p>
      <input type="text" name="name" required placeholder="Ingrese su nombre de usuario" maxlength="20"  class="caja" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="Ingrese su contraseña" maxlength="20"  class="caja" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="Iniciar sesión" class="btn" name="submit">
   </form>

</section>
   
</body>
</html>