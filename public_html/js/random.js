const carousel = document.querySelector('.carousel');
const arrowIcons = document.querySelectorAll('.random i');

arrowIcons.forEach(icon => {
  let firstImgWidth = 280;
  icon.addEventListener('click', () => {
      carousel.scrollLeft += icon.id === 'left' ? -firstImgWidth : firstImgWidth;
  });
});