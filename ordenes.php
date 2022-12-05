<?php
 include 'components/connect.php';

 session_start();


if (isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{

    $user_id = '';

}

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <script src="https://kit.fontawesome.com/213b3051c5.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <title>Inicio</title>
</head>
<body>
    

<?php include 'components/usuario_header.php'; ?>

















<?php	 include'components/footer.php';?>
<script src="js/script.js"></script>
</body>
</html>