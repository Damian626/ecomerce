<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo '
         <div class="message">
            <span>' . $message . '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
    }
}
?>

<header class="header">

    <section class="flex">

        <a href="../inicio.php" class="logo">Sport <span>Replik</span></a>

        <nav class="navbar">
            <a href="../admin/dashboard.php">Inicio</a>
            <a href="../admin/products.php">Sobre Nosotros</a>
            <a href="../admin/placed_orders.php">Ordenes</a>
            <a href="../admin/admin_accounts.php">Compras</a>
            <a href="../admin/users_accounts.php">Contacto</a>

        </nav>

        <div class="icons">
            <?php
                $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE   `user_id` = ? ");
                $count_wishlist_items->execute([$user_id]);
                $total_wishlist_items = $count_wishlist_items->rowCount();

                $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE   `user_id` = ? ");
                $count_cart_items->execute([$user_id]);
                $total_cart_items = $count_cart_items->rowCount();
            ?>
            <div id="menu-btn" class="fa fa-bars"></div>
            <a href="../buscar.php"><i class="fas fa-search"></i></a>
            <a href="../lista_deseos.php"><i class="fa-solid fa-heart"></i><span>(<?= $total_wishlist_items; ?>)</span></a>
            <a href="../lista_deseos.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_items; ?>)</span></a>
            <div id="user-btn" class="fas fa-user"></div>
        </div>

        <div class="profile">
            <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if ($select_profile->rowCount()<0){
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
   
            ?>
            <p><?= $fetch_profile['name']; ?></p>
            <a href="../admin/update_profile.php" class="btn">Actualizar Perfil</a>
            <div class="flex-btn">
                <a href="../admin/register_admin.php" class="option-btn">Registrarse</a>
                <a href="../admin/admin_login.php" class="option-btn">Ingresar</a>
            </div>
            <a href="../components/admin_logout.php" onclick="return confirm('¿Seguro que desea salir?');" class="delete-btn" onclick="return confirm('¿Estas seguro que quieres cerrar sesión?');">Cerrar sesión</a>
            <?php
               }else{
            ?>
            <p>Por favor Inicie Sesión Primero</p>
            <div class="flex-btn">
                <a href="../admin/register_admin.php" class="option-btn">Registrarse</a>
                <a href="../admin/admin_login.php" class="option-btn">Ingresar</a>
            </div>
            <?php 
              }
            ?>
        </div>

    </section>

</header>