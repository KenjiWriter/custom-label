document.addEventListener('DOMContentLoaded', function () {
    // Initialize theme system
    if (window.ThemeManager) {
        window.ThemeManager.init();
    }
});

// Also initialize when Livewire navigates
document.addEventListener('livewire:navigated', function () {
    if (window.ThemeManager) {
        window.ThemeManager.init();
    }
});

document.addEventListener('DOMContentLoaded', function () {

    // Animacja liczb w sekcji cenowej
    const priceCounters = document.querySelectorAll('.price-counter [data-target-price]');

    function animatePrice(counter) {
        const target = parseFloat(counter.getAttribute('data-target-price'));
        const text = counter.textContent;
        const currentPrice = parseFloat(text.replace('$', ''));

        if (currentPrice < target) {
            counter.textContent = '$' + (Math.min(currentPrice + 0.01, target)).toFixed(2);
            setTimeout(() => animatePrice(counter), 30);
        }
    }

    // Observer dla elementów, które wjeżdżają w viewport
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                if (entry.target.classList.contains('price-counter')) {
                    const counter = entry.target.querySelector('[data-target-price]');
                    counter.textContent = '$0.00';
                    animatePrice(counter);
                }

                if (entry.target.classList.contains('testimonial-card')) {
                    entry.target.style.opacity = '0';
                    entry.target.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        entry.target.style.transition = 'all 0.5s ease-out';
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }, 100);
                }

                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    // Obserwuj elementy cenowe
    document.querySelectorAll('.price-counter').forEach(counter => {
        observer.observe(counter);
    });

    // Obserwuj testimoniale
    document.querySelectorAll('.testimonial-card').forEach(card => {
        observer.observe(card);
    });

    // Parallax dla kart szablonów
    const cards = document.querySelectorAll('.parallax-card');

    cards.forEach(card => {
        card.addEventListener('mousemove', handleParallax);
        card.addEventListener('mouseleave', resetParallax);
    });

    function handleParallax(e) {
        const card = this;
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        const centerX = rect.width / 2;
        const centerY = rect.height / 2;

        const angleY = (x - centerX) / 30;
        const angleX = (y - centerY) / -30;

        card.style.transform = `perspective(1000px) rotateY(${angleY}deg) rotateX(${angleX}deg) scale3d(1.05, 1.05, 1.05)`;
    }

    function resetParallax() {
        this.style.transform = 'perspective(1000px) rotateY(0) rotateX(0) scale3d(1, 1, 1)';
    }
});
