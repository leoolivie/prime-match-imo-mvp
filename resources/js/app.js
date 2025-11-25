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
            this.hoverPauseEnabled = root.dataset.carouselHoverPause === 'true';
            this.currentIndex = 0;
            this.autoAdvanceId = null;

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

            if (this.hoverPauseEnabled) {
                this.root.addEventListener('pointerenter', () => this.stopAutoAdvance());
                this.root.addEventListener('pointerleave', () => this.startAutoAdvance());
            }

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
            if (this.isStatic || this.autoAdvanceId) {
                return;
            }

            this.autoAdvanceId = window.setTimeout(() => {
                this.goToSlide(this.currentIndex + 1);
                this.autoAdvanceId = null;
                this.startAutoAdvance();
            }, this.interval);
        }

        stopAutoAdvance() {
            if (this.autoAdvanceId) {
                window.clearTimeout(this.autoAdvanceId);
                this.autoAdvanceId = null;
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

    // Modal de destaque (Prime)
    const modal = document.getElementById('featuredPrimeModal');
    if (modal) {
        const els = {
            title: modal.querySelector('[data-modal-title]'),
            location: modal.querySelector('[data-modal-location]'),
            status: modal.querySelector('[data-modal-status]'),
            price: modal.querySelector('[data-modal-price]'),
            chips: modal.querySelector('[data-modal-chips]'),
            description: modal.querySelector('[data-modal-description]'),
            conciergeBtn: modal.querySelector('[data-modal-concierge-btn]'),
            conciergeSticky: modal.querySelector('[data-modal-concierge-sticky]'),
            video: modal.querySelector('#modalVideo'),
            hero: modal.querySelector('#modalHero'),
            thumbs: modal.querySelector('#modalThumbs'),
            thumbPrev: modal.querySelector('[data-thumbs-prev]'),
            thumbNext: modal.querySelector('[data-thumbs-next]'),
            closeBtns: modal.querySelectorAll('[data-modal-close]'),
        };

        let gallery = [];
        let currentIndex = 0;
        let hasVideo = false;
        let videoUrl = '';

        const markActive = (key) => {
            Array.from(els.thumbs.children || []).forEach((btn) => {
                btn.classList.remove('ring-2', 'ring-[#cba135]');
                btn.setAttribute('aria-current', 'false');
            });
            const selector = key === 'video' ? '[data-thumb-video]' : `[data-thumb-index="${key}"]`;
            const target = els.thumbs.querySelector(selector);
            if (target) {
                target.classList.add('ring-2', 'ring-[#cba135]');
                target.setAttribute('aria-current', 'true');
            }
        };

        const showImage = (index) => {
            currentIndex = index;
            const src = gallery[index];
            if (!src) return;
            if (els.video) {
                els.video.pause();
                els.video.classList.add('hidden');
            }
            if (els.hero) {
                els.hero.src = src;
                els.hero.classList.remove('hidden');
            }
            markActive(index);
        };

        const showVideo = () => {
            if (!hasVideo || !els.video) return;
            if (els.hero) els.hero.classList.add('hidden');
            els.video.classList.remove('hidden');
            els.video.src = videoUrl;
            els.video.load();
            els.video.play().catch(() => {});
            markActive('video');
        };

        const buildThumbs = () => {
            if (!els.thumbs) return;
            els.thumbs.innerHTML = '';

            if (hasVideo) {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.dataset.thumbVideo = '1';
                btn.className = 'relative h-20 w-28 flex-shrink-0 overflow-hidden rounded-xl border border-white/10 bg-black/60 transition hover:border-[#cba135]/70 focus:outline-none focus:ring-2 focus:ring-[#cba135]';
                btn.innerHTML = '<div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-black via-[#0b0b0b] to-black"><span class="text-[10px] uppercase tracking-[0.35em] text-white/80">Vídeo</span></div>';
                btn.addEventListener('click', showVideo);
                els.thumbs.appendChild(btn);
            }

            gallery.forEach((src, idx) => {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.dataset.thumbIndex = String(idx);
                btn.className = 'relative h-20 w-28 flex-shrink-0 overflow-hidden rounded-xl border border-white/10 bg-black/40 transition hover:border-[#cba135]/70 focus:outline-none focus:ring-2 focus:ring-[#cba135]';
                btn.innerHTML = `<img src="${src}" class="h-full w-full object-cover" alt="Foto ${idx + 1}">`;
                btn.addEventListener('click', () => showImage(idx));
                els.thumbs.appendChild(btn);
            });
        };

        const openModal = (data) => {
            const galleryData = (() => {
                try {
                    return data.gallery ? JSON.parse(data.gallery) : [];
                } catch (e) {
                    return [];
                }
            })();

            gallery = Array.isArray(galleryData) ? galleryData.filter(Boolean) : [];
            if (data.hero) {
                gallery = [data.hero, ...gallery];
            }

            hasVideo = !!data.video;
            videoUrl = data.video || '';

            if (els.title) els.title.textContent = data.title || 'Imóvel Prime';
            if (els.location) els.location.textContent = [data.city, data.state].filter(Boolean).join(' • ');
            if (els.status) els.status.textContent = data.status || 'DISPONÍVEL';
            if (els.price) els.price.textContent = data.price || '';

            if (els.chips) {
                const chips = [];
                if (data.area) chips.push(data.area);
                if (data.bedrooms) chips.push(`${data.bedrooms} quartos`);
                if (data.parking) chips.push(`${data.parking} vagas`);
                els.chips.innerHTML = chips.map((t) => `<span class="rounded-full border border-white/10 bg-[#111111] px-3 py-1 text-xs uppercase tracking-[0.25em] text-white/90">${t}</span>`).join('');
            }

            if (els.description) {
                els.description.textContent = data.description || 'Experiência prime com concierge dedicado e documentação completa sob demanda.';
            }

            if (els.conciergeBtn) els.conciergeBtn.href = data.concierge || '#';
            if (els.conciergeSticky) els.conciergeSticky.href = data.concierge || '#';

            buildThumbs();
            if (hasVideo) {
                showVideo();
                if (!gallery.length && els.hero) {
                    els.hero.classList.add('hidden');
                } else if (gallery.length) {
                    els.hero.src = gallery[0];
                }
            } else {
                showImage(0);
            }

            modal.classList.remove('hidden');
            modal.setAttribute('aria-hidden', 'false');
            document.documentElement.classList.add('overflow-hidden');
        };

        const closeModal = () => {
            modal.classList.add('hidden');
            modal.setAttribute('aria-hidden', 'true');
            document.documentElement.classList.remove('overflow-hidden');
            if (els.video) {
                els.video.pause();
                els.video.removeAttribute('src');
            }
        };

        document.querySelectorAll('[data-featured-open-modal]').forEach((btn) => {
            btn.addEventListener('click', () => openModal(btn.dataset));
        });

        els.closeBtns?.forEach((btn) => btn.addEventListener('click', closeModal));
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && modal.getAttribute('aria-hidden') === 'false') {
                closeModal();
            }
        });

        if (els.thumbPrev) {
            els.thumbPrev.addEventListener('click', () => {
                if (!gallery.length) return;
                currentIndex = (currentIndex - 1 + gallery.length) % gallery.length;
                showImage(currentIndex);
            });
        }

        if (els.thumbNext) {
            els.thumbNext.addEventListener('click', () => {
                if (!gallery.length) return;
                currentIndex = (currentIndex + 1) % gallery.length;
                showImage(currentIndex);
            });
        }
    }
});
