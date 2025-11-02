@once
    @push('scripts')
        <script>
            (() => {
                const prefersReduced = window.matchMedia?.('(prefers-reduced-motion: reduce)').matches ?? false;

                const initCarousels = () => {
                    const clamp = (value, min, max) => Math.max(min, Math.min(max, value));

                    document.querySelectorAll('[data-carousel]').forEach((carousel) => {
                        const viewport = carousel.querySelector('[data-viewport]');
                        const track = carousel.querySelector('[data-slides]');
                        const slides = track ? Array.from(track.querySelectorAll('[data-slide]')) : [];
                        if (!viewport || !slides.length) {
                            return;
                        }

                        let index = slides.findIndex((slide) => slide.getAttribute('aria-current') === 'true');
                        index = index < 0 ? 0 : index;

                        const intervalMs = Number(carousel.dataset.interval || '6000');
                        const autoplay = carousel.dataset.autoplay !== 'false';
                        let timer = null;

                        const setAria = (current) => {
                            slides.forEach((slide, slideIndex) => {
                                if (slideIndex === current) {
                                    slide.setAttribute('aria-current', 'true');
                                } else {
                                    slide.removeAttribute('aria-current');
                                }
                            });
                        };

                        const scrollToIndex = (target, smooth = true) => {
                            index = clamp(target, 0, slides.length - 1);
                            const left = slides[index].offsetLeft - (track?.offsetLeft ?? 0);
                            viewport.scrollTo({
                                left,
                                behavior: smooth && !prefersReduced ? 'smooth' : 'auto',
                            });
                            setAria(index);
                        };

                        const syncOnScroll = () => {
                            const center = viewport.scrollLeft + viewport.clientWidth / 2;
                            let nearestIndex = index;
                            let nearestDistance = Number.POSITIVE_INFINITY;

                            slides.forEach((slide, slideIndex) => {
                                const midpoint = slide.offsetLeft + slide.clientWidth / 2;
                                const distance = Math.abs(midpoint - center);
                                if (distance < nearestDistance) {
                                    nearestDistance = distance;
                                    nearestIndex = slideIndex;
                                }
                            });

                            if (nearestIndex !== index) {
                                index = nearestIndex;
                                setAria(index);
                            }
                        };

                        const startAutoplay = () => {
                            if (!autoplay || prefersReduced) {
                                return;
                            }
                            stopAutoplay();
                            timer = window.setInterval(() => scrollToIndex(index + 1), intervalMs);
                        };

                        const stopAutoplay = () => {
                            if (timer) {
                                window.clearInterval(timer);
                                timer = null;
                            }
                        };

                        viewport.addEventListener('scroll', () => {
                            window.requestAnimationFrame(syncOnScroll);
                        }, { passive: true });

                        carousel.addEventListener('mouseenter', stopAutoplay);
                        carousel.addEventListener('mouseleave', startAutoplay);
                        carousel.addEventListener('focusin', stopAutoplay);
                        carousel.addEventListener('focusout', startAutoplay);

                        document.addEventListener('keydown', (event) => {
                            if (!carousel.contains(document.activeElement)) {
                                return;
                            }
                            if (event.key === 'ArrowLeft') {
                                scrollToIndex(index - 1);
                            }
                            if (event.key === 'ArrowRight') {
                                scrollToIndex(index + 1);
                            }
                        });

                        window.addEventListener('resize', () => scrollToIndex(index, false));

                        scrollToIndex(index, false);
                        startAutoplay();
                    });
                };

                const initScrollSpy = () => {
                    const links = Array.from(document.querySelectorAll('[data-spy-link]'));
                    if (!links.length) {
                        return;
                    }

                    const header = document.querySelector('header');
                    const headerHeight = () => (header?.offsetHeight ?? 72) + 8;

                    links.forEach((link) => {
                        link.addEventListener('click', (event) => {
                            event.preventDefault();
                            const targetSelector = link.getAttribute('href');
                            if (!targetSelector) {
                                return;
                            }
                            const target = document.querySelector(targetSelector);
                            if (!target) {
                                return;
                            }

                            const top = target.getBoundingClientRect().top + window.scrollY - headerHeight() - 40;
                            window.scrollTo({
                                top,
                                behavior: prefersReduced ? 'auto' : 'smooth',
                            });
                        });
                    });

                    if (!('IntersectionObserver' in window)) {
                        return;
                    }

                    const observer = new IntersectionObserver((entries) => {
                        entries.forEach(({ target, isIntersecting }) => {
                            const link = links.find((candidate) => candidate.getAttribute('href') === `#${target.id}`);
                            if (link) {
                                link.dataset.active = isIntersecting ? 'true' : 'false';
                            }
                        });
                    }, {
                        rootMargin: `-${headerHeight() + 56}px 0px -60% 0px`,
                        threshold: 0.1,
                    });

                    links
                        .map((link) => link.getAttribute('href'))
                        .filter(Boolean)
                        .forEach((selector) => {
                            const section = document.querySelector(selector);
                            if (section) {
                                observer.observe(section);
                            }
                        });
                };

                const initCounters = () => {
                    const formatNumber = (value) => new Intl.NumberFormat('id-ID').format(value);

                    const animate = (element) => {
                        const targetValue = Number.parseInt(element.dataset.counterTo || '0', 10);
                        if (!Number.isFinite(targetValue)) {
                            return;
                        }

                        const duration = prefersReduced ? 0 : 1200;
                        if (!duration) {
                            element.textContent = formatNumber(targetValue);
                            return;
                        }

                        const startTime = performance.now();

                        const step = (timestamp) => {
                            const progress = Math.min(1, (timestamp - startTime) / duration);
                            const eased = progress < 0.5
                                ? 2 * progress * progress
                                : -1 + (4 - 2 * progress) * progress;
                            const currentValue = Math.floor(targetValue * eased);
                            element.textContent = formatNumber(currentValue);
                            if (progress < 1) {
                                window.requestAnimationFrame(step);
                            } else {
                                element.textContent = formatNumber(targetValue);
                            }
                        };

                        window.requestAnimationFrame(step);
                    };

                    const counters = Array.from(document.querySelectorAll('[data-counter]'));
                    if (!counters.length) {
                        return;
                    }

                    if ('IntersectionObserver' in window) {
                        const observer = new IntersectionObserver((entries, observerInstance) => {
                            entries.forEach(({ target, isIntersecting }) => {
                                if (isIntersecting && !target.dataset.done) {
                                    animate(target);
                                    target.dataset.done = '1';
                                    observerInstance.unobserve(target);
                                }
                            });
                        }, { threshold: 0.5 });

                        counters.forEach((counter) => observer.observe(counter));
                        return;
                    }

                    counters.forEach(animate);
                };

                const initBackToTop = () => {
                    const trigger = document.querySelector('[data-backtotop]');
                    if (!trigger) {
                        return;
                    }

                    const updateState = () => {
                        trigger.style.display = window.scrollY > 600 ? 'inline-flex' : 'none';
                    };

                    window.addEventListener('scroll', updateState, { passive: true });
                    updateState();

                    trigger.addEventListener('click', () => {
                        window.scrollTo({
                            top: 0,
                            behavior: prefersReduced ? 'auto' : 'smooth',
                        });
                    });
                };

                document.addEventListener('DOMContentLoaded', () => {
                    initCarousels();
                    initScrollSpy();
                    initCounters();
                    initBackToTop();
                });
            })();
        </script>
    @endpush
@endonce
