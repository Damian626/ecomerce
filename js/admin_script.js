let navbar = document.querySelector('.header .flex .navbar');
let profile = document.querySelector('.header .flex .profile');

document.querySelector('#menu-btn').onclick = () =>{
   navbar.classList.toggle('active');
   profile.classList.remove('active');
}

document.querySelector('#user-btn').onclick = () =>{
   profile.classList.toggle('active');
   navbar.classList.remove('active');
}

window.scroll = () => {
    profile.classList.remove('active');
    navbar.classList.remove('active');
}

subImages = document.querySelectorAll('.actualizar-producto .imagen-container .sub-imagenes img');
mainImage = document.querySelector('.actualizar-producto .imagen-container .imagen-main img');


subImages.forEach(images =>{
   images.onclick = () =>{
      src = images.getAttribute('src');
      mainImage.src = src;
   }
});