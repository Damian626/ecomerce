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

<header class="header">

   <section class="flex">

      <a href="../admin/dashboard.php" class="logo">Panel <span>Administrador</span></a>

      <nav class="navbar">
         <a href="../admin/dashboard.php">Inicio</a>
         <a href="../admin/products.php">Productos</a>
         <a href="../admin/placed_orders.php">Ordenes</a>
         <a href="../admin/admin_accounts.php">Admin</a>
         <a href="../admin/users_accounts.php">Usuarios</a>
         
      </nav>

      <div class="icons">
         <div id="menu-btn"><img src="../img/Menu.ico"></div>
         <div id="user-btn"><img src="../img/user.ico"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile['name']; ?></p>
         <a href="../admin/update_profile.php" class="btn">Actualizar Perfil</a>
         <div class="flex-btn">
            <a href="../admin/register_admin.php" class="option-btn">Registrarse</a>
            <a href="../admin/admin_login.php" class="option-btn">Ingresar</a>
         </div>
         <a href="../components/admin_logout.php" onclick="return confirm('¿Seguro que desea salir?');" class="delete-btn" onclick="return confirm('¿Estas seguro que quieres cerrar sesión?');">Cerrar sesión</a> 
      </div>

   </section>

</header>