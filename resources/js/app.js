import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const formatter = new Intl.NumberFormat('pt-BR');

    document.querySelectorAll('[data-price-input]').forEach((input) => {
        const formatValue = () => {
            const digits = input.value.replace(/\D/g, '');

            if (!digits) {
                input.value = '';
                return;
            }

            input.value = formatter.format(Number(digits));
        };

        formatValue();

        input.addEventListener('input', () => {
            const isFocused = document.activeElement === input;
            formatValue();
            if (isFocused && typeof input.selectionStart === 'number') {
                const end = input.value.length;
                input.setSelectionRange(end, end);
            }
        });

        input.form?.addEventListener('submit', () => {
            input.value = input.value.replace(/\D/g, '');
        });
    });

    class FeaturedCarousel {
        constructor(root) {
            this.root = root;
            this.slides = Array.from(root.querySelectorAll('[data-featured-slide]'));
            this.prevControls = Array.from(root.querySelectorAll('[data-carousel-nav="prev"]'));
            this.nextControls = Array.from(root.querySelectorAll('[data-carousel-nav="next"]'));
            this.interval = Number(root.dataset.carouselInterval) || 40000;
            this.isStatic = root.dataset.carouselStatic === 'true' || this.slides.length <= 1;
            this.currentIndex = 0;
            this.intervalId = null;

            this.init();
        }

        init() {
            if (!this.slides.length) {
                return;
            }

            this.updateSlides();
            this.bindEvents();
            this.startAutoAdvance();
        }

        bindEvents() {
            if (this.isStatic) {
                return;
            }

            [...this.prevControls, ...this.nextControls].forEach((control) => {
                control.addEventListener('click', () => {
                    const direction = control.dataset.carouselNav === 'prev' ? -1 : 1;
                    this.goToSlide(this.currentIndex + direction);
                    this.restartAutoAdvance();
                });
            });

            this.root.addEventListener('pointerenter', () => this.stopAutoAdvance());
            this.root.addEventListener('pointerleave', () => this.startAutoAdvance());

            document.addEventListener('visibilitychange', () => {
                if (document.hidden) {
                    this.stopAutoAdvance();
                } else {
                    this.startAutoAdvance();
                }
            });
        }

        goToSlide(index) {
            const total = this.slides.length;
            this.currentIndex = (index % total + total) % total;
            this.updateSlides();
        }

        updateSlides() {
            this.slides.forEach((slide, index) => {
                const isActive = index === this.currentIndex;
                slide.classList.toggle('hidden', !isActive);
                slide.classList.toggle('opacity-0', !isActive);
                slide.classList.toggle('pointer-events-none', !isActive);
                slide.setAttribute('aria-hidden', isActive ? 'false' : 'true');

                const media = slide.querySelector('[data-featured-media]');
                if (media?.tagName === 'VIDEO') {
                    const video = media;
                    if (isActive) {
                        video.play().catch(() => {});
                    } else {
                        video.pause();
                        video.currentTime = 0;
                    }
                }
            });
        }

        startAutoAdvance() {
            if (this.isStatic || this.intervalId) {
                return;
            }

            this.intervalId = window.setInterval(() => {
                this.goToSlide(this.currentIndex + 1);
            }, this.interval);
        }

        stopAutoAdvance() {
            if (this.intervalId) {
                window.clearInterval(this.intervalId);
                this.intervalId = null;
            }
        }

        restartAutoAdvance() {
            this.stopAutoAdvance();
            this.startAutoAdvance();
        }
    }

    document.querySelectorAll('[data-featured-carousel]').forEach((carousel) => {
        new FeaturedCarousel(carousel);
    });
});
