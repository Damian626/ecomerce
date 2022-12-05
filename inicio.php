<?php
include 'components/connect.php';

session_start();


if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    <title>Inicio</title>
</head>

<body>


    <?php include 'components/usuario_header.php'; ?>

    <div class="inicio-bg">
        <section class="swiper inicio">
            <div class="swiper-slide swiper-wrapper">
                <div class="swiper-slide  slide">
                    <div class="imagen">
                        <img src="/img/maradona.png" alt="">
                    </div>
                    <div class="contenido">
                        <span>25% de descuento</span>
                        <h3>Replica Remera de maradona mundial 86</h3>
                        <a href="/compra.php" class="btn">comprar</a>
                    </div>
                </div>


                <div class="swiper-slide slide">
                    <div class="imagen">
                        <img src="/img/maradona2.jpg" alt="">
                    </div>
                    <div class="contenido">
                        <span>25% de descuento</span>
                        <h3>Replica Remera de maradona mundial 86</h3>
                        <a href="/compra.php" class="btn">comprar</a>
                    </div>
                </div>


                <div class="swiper-slide slide">
                    <div class="imagen">
                        <img src="/img/argetina.png" alt="">
                    </div>
                    <div class="contenido">
                        <span>25% de descuento</span>
                        <h3>Remera de la selección Argentina</h3>
                        <a href="/compra.php" class="btn">comprar</a>
                    </div>
                </div>
            </div>

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </section>
    </div>


    <section class="inicio-categoria">
       <div class="swiper categoria-slider">
        <div class="swiper-wrapper">
            <a href="categoria.php?categoria=botines" class="swiper-slide slide">
                <img src="/img/botines1.png" alt="">
                <h3>Botines</h3>
            </a>
            <a href="categoria.php?categoria=remeras" class="swiper-slide slide">
                <img src="/img/remeras1.png" alt="">
                <h3>Remeras</h3>
            </a>
            <a href="categoria.php?categoria=zapatillas" class="swiper-slide slide">
                <img src="/img/zapatillas1.png" alt="">
                <h3>Zapatillas</h3>
            </a>
            <a href="categoria.php?categoria=calzas1" class="swiper-slide slide">
                <img src="/img/calzas1.png" alt="">
                <h3>Calzas</h3>
            </a>
            <a href="categoria.php?categoria=pantalones" class="swiper-slide slide">
                <img src="/img/pantalones1.png" alt="">
                <h3>Pantalones</h3>
            </a>
            <a href="categoria.php?categoria=buzos" class="swiper-slide slide">
                <img src="/img/buzos1.png" alt="">
                <h3>Buzos</h3>
            </a>
            <a href="categoria.php?categoria=top" class="swiper-slide slide">
                <img src="/img/top1.png" alt="">
                <h3>Tops</h3>
            </a>
            <a href="categoria.php?categoria=campera" class="swiper-slide slide">
                <img src="/img/campera1.png" alt="">
                <h3>Camperas</h3>
            </a>
        </div>
        <div class="swiper-pagination"></div>
       </div> 

    </section>












    <?php include 'components/footer.php'; ?>
    <script src="js/script.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script>
      var swiper = new Swiper(".inicio", {
        spaceBetween: 30,
        centeredSlides: true,
        autoplay: {
          delay: 2500,
          disableOnInteraction: false,
        },
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });

      var swiper = new Swiper(".categoria-slider", {
        loop:true,
        grabCursor:true,
        spaceBetween: 20,
        pagination: {
          el: ".swiper-pagination",
        },
        breakpoints:{
            0:{
                slidesPerView: 2,
            },
            640:{
                slidesPerView: 3,
            },
            768:{
                slidesPerView: 4,
            },
            1024:{
                slidesPerView: 5,
            },
        },
      });
    </script>
</body>

</html>