<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Registrar</title>
   <link rel="icon" href="../img/engranaje.ico">
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>








<script src="../js/admin_script.js"></script>
   
</body>
</html>