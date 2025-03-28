// SECCION CARROUSEL PLATOS
const track = document.querySelector('.carousel-track');
const items = document.querySelectorAll('.carousel-item');
let itemWidth = items[0].clientWidth;
let totalWidth = itemWidth * items.length;

// IMAGENES DUPLICADAS
for (let i = 0; i < items.length; i++) {
    const clone = items[i].cloneNode(true);
    track.appendChild(clone);
}

let currentPosition = 0;
const moveCarousel = () => {
    currentPosition += itemWidth;
    track.style.transform = `translateX(-${currentPosition}px)`;

    if (currentPosition >= totalWidth) {
        currentPosition = 0;
        track.style.transition = 'none'; 
        track.style.transform = `translateX(0)`;
        setTimeout(() => {
            track.style.transition = 'transform 0.5s ease';
        }, 50);
    }
};

setInterval(moveCarousel, 2000);

// SECCION CARRUSEL RESENAS
const carousel = document.querySelector('.carousel');
let isDragging = false;
let startX, scrollLeft;

// ARRASTRE
carousel.addEventListener('mousedown', (e) => {
    isDragging = true;
    startX = e.pageX - carousel.offsetLeft;
    scrollLeft = carousel.scrollLeft;
    carousel.style.cursor = 'grabbing';
});
carousel.addEventListener('mouseleave', () => {
    isDragging = false;
    carousel.style.cursor = 'grab';
});
carousel.addEventListener('mouseup', () => {
    isDragging = false;
    carousel.style.cursor = 'grab';
});
carousel.addEventListener('mousemove', (e) => {
    if (!isDragging) return;
    e.preventDefault();
    const x = e.pageX - carousel.offsetLeft;
    const walk = (x - startX) * 1; 
    carousel.scrollLeft = scrollLeft - walk;
});

// SECCION DUDAS
function toggleCollapse(id) {
    const collapse = document.getElementById(id);
    const icon = document.getElementById('icon' + id.slice(-1));
    collapse.classList.toggle('hidden');
    icon.classList.toggle('rotate-180');
}