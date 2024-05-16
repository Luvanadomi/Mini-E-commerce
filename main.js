let hamburgerMenu = document.getElementById('hamburger');
let leftSide = document.querySelector('.left-side');

hamburgerMenu.addEventListener('click', () => {
    leftSide.classList.toggle('active'); 
  });