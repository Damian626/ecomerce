<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['add_product'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);

   $image_01 = $_FILES['image_01']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['image_01']['size'];
   $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
   $image_folder_01 = '../uploaded_img/'.$image_01;

   $image_02 = $_FILES['image_02']['name'];
   $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
   $image_size_02 = $_FILES['image_02']['size'];
   $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
   $image_folder_02 = '../uploaded_img/'.$image_02;


   $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
   $select_products->execute([$name]);

   if($select_products->rowCount() > 0){
      $message[] = 'el nombre del producto ya existe';
   }else{

      $insert_products = $conn->prepare("INSERT INTO `products`(name, details, price, image_01, image_02) VALUES(?,?,?,?,?)");
      $insert_products->execute([$name, $details, $price, $image_01, $image_02]);

      if($insert_products){
         if($image_size_01 > 2000000 OR $image_size_02 > 2000000){
            $message[] = '¡error! Imagen demasiado grande';
         }else{
            move_uploaded_file($image_tmp_name_01, $image_folder_01);
            move_uploaded_file($image_tmp_name_02, $image_folder_02);
            $message[] = 'nuevo producto agregado';
         }

      }

   }  

};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/'.$fetch_delete_image['image_01']);
   unlink('../uploaded_img/'.$fetch_delete_image['image_02']);
   $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
   $delete_product->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE pid = ?");
   $delete_wishlist->execute([$delete_id]);
   header('location:products.php');
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>productos</title>
   <link rel="icon" href="../img/agreagar_producto.ico">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="añedir-productos">

   <h1 class="heading">Agregar producto</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <div class="flex">
         <div class="input-caja">
            <span>nombre del producto (requerido)</span>
            <input type="text" class="caja" required maxlength="100" placeholder="ingrese el nombre del producto" name="name">
         </div>
         <div class="input-caja">
            <span>precio del producto (requerido)</span>
            <input type="number" min="0" class="caja" required max="9999999999" placeholder="ingrese el precio del producto" onkeypress="if(this.value.length == 10) return false;" name="price">
         </div>
        <div class="input-caja">
            <span>imagen 01 (requerida)</span>
            <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="caja" required>
        </div>
        <div class="input-caja">
            <span>imagen 02 (requerida)</span>
            <input type="file" name="image_02" accept="image/jpg, image/jpeg, image/png, image/webp" class="caja" required>
        </div>
        <div class="input-caja">
            <span>detalles del prodcuto(requerido)</span>
            <textarea name="details" placeholder="ingrese los detalles del producto" class="caja" required maxlength="500" cols="30" rows="10"></textarea>
         </div>
      </div>
      
      </div>
      
      <input type="submit" value="agregar producto" class="btn" name="add_product">
   </form>

</section>

<section class="ver-productos">

   <h1 class="heading">productos agregados</h1>

   <div class="caja-container">

   <?php
      $select_products = $conn->prepare("SELECT * FROM `products`");
      $select_products->execute();
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <div class="caja">
      <img src="../uploaded_img/<?= $fetch_products['image_01']; ?>" alt="">
      <div class="nombre"><?= $fetch_products['name']; ?></div>
      <div class="precio">$<span><?= $fetch_products['price']; ?></span></div>
      <div class="detalles"><span><?= $fetch_products['details']; ?></span></div>
      <div class="flex-btn">
         <a href="update_products.php?update=<?= $fetch_products['id']; ?>" class="option-btn">actualizar</a>
         <a href="products.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('¿Seguro que desea eliminar este producto?');">eliminar</a>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">no hay productos agregados recientemente!</p>';
      }
   ?>
   
   </div>

</section>








<script src="../js/admin_script.js"></script>
   
</body>
</html>