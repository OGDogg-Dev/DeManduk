import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const toggles = document.querySelectorAll('[data-nav-toggle]');
    toggles.forEach((toggle) => {
        const nav = document.querySelector(toggle.getAttribute('aria-controls') ? `#${toggle.getAttribute('aria-controls')}` : '[data-nav-menu]');
        const menu = nav ?? document.querySelector('[data-nav-menu]');

        if (!menu) {
            return;
        }

        toggle.addEventListener('click', () => {
            const isExpanded = toggle.getAttribute('aria-expanded') === 'true';
            toggle.setAttribute('aria-expanded', String(!isExpanded));
            menu.classList.toggle('hidden');
        });
    });

    // Auto-slide hero carousel every 3 seconds
    const heroContainer = document.querySelector('.hero-carousel');
    if (heroContainer) {
        const slides = heroContainer.querySelectorAll('.hero-slide');
        let currentIndex = 0;
        let autoSlide;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.style.transform = `translateX(${100 * (i - index)}%)`;
            });
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % slides.length;
            showSlide(currentIndex);
        }

        // Initialize first slide
        showSlide(currentIndex);

        // Auto-slide every 3 seconds
        autoSlide = setInterval(nextSlide, 3000);

        // Pause on hover
        heroContainer.addEventListener('mouseenter', () => {
            clearInterval(autoSlide);
        });

        heroContainer.addEventListener('mouseleave', () => {
            autoSlide = setInterval(nextSlide, 3000);
        });
    }
});
