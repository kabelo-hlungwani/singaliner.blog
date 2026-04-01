(function () {
    // Sub-pages that belong to a parent nav item
    var PAGE_PARENT = {
        'category.php': 'blog.php',
        'read.php': 'blog.php'
    };

    function normalizePath(path) {
        var last = path.split('/').pop();
        return last || 'index.php';
    }

    function setActiveNav() {
        var rawPage = normalizePath(window.location.pathname);
        var page = PAGE_PARENT[rawPage] || rawPage;
        var links = document.querySelectorAll('.modern-nav .nav-link');
        var sectionLinks = [];

        links.forEach(function (link) {
            var href = link.getAttribute('href') || '';
            if (!href) {
                return;
            }

            if (href.charAt(0) === '#') {
                sectionLinks.push(link);
                link.classList.remove('active');
                return;
            }

            var target = normalizePath(href.split('?')[0].split('#')[0]);
            if (target === page) {
                link.classList.add('active');
                link.setAttribute('aria-current', 'page');
            } else {
                link.classList.remove('active');
                link.removeAttribute('aria-current');
            }
        });

        if (sectionLinks.length === 0 || rawPage !== 'index.php') {
            return;
        }

        var sectionMap = sectionLinks
            .map(function (link) {
                var id = (link.getAttribute('href') || '').replace('#', '');
                return { link: link, section: document.getElementById(id) };
            })
            .filter(function (item) {
                return item.section;
            });

        if (sectionMap.length === 0) {
            return;
        }

        var updateActiveSection = function () {
            var offset = window.scrollY + 130;
            var chosen = sectionMap[0];

            sectionMap.forEach(function (item) {
                if (item.section.offsetTop <= offset) {
                    chosen = item;
                }
            });

            sectionMap.forEach(function (item) {
                item.link.classList.toggle('active', item === chosen);
                if (item === chosen) {
                    item.link.setAttribute('aria-current', 'page');
                } else {
                    item.link.removeAttribute('aria-current');
                }
            });
        };

        updateActiveSection();
        window.addEventListener('scroll', updateActiveSection, { passive: true });
    }

    function setupReveal() {
        var targets = document.querySelectorAll(
            '.panel, .blog-panel, .story-card, .article-shell, .related-box, .service-card, .feature-callout, .gallery-item, .gallery-section-title, .contact-map, .why-card, .blog-preview-card, .stats-strip, .cta-band'
        );

        if (targets.length === 0) {
            return;
        }

        targets.forEach(function (el, index) {
            el.classList.add('reveal');
            el.style.transitionDelay = Math.min(index * 35, 260) + 'ms';
        });

        if (!('IntersectionObserver' in window)) {
            targets.forEach(function (el) {
                el.classList.add('is-visible');
            });
            return;
        }

        var observer = new IntersectionObserver(
            function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.15, rootMargin: '0px 0px -30px 0px' }
        );

        targets.forEach(function (el) {
            observer.observe(el);
        });
    }

    function setupScrollTopButton() {
        var button = document.getElementById('scrollTopBtn');
        if (!button) {
            return;
        }

        var onScroll = function () {
            if (window.scrollY > 320) {
                button.classList.add('show');
            } else {
                button.classList.remove('show');
            }
        };

        button.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        onScroll();
        window.addEventListener('scroll', onScroll, { passive: true });
    }

    function setupScrolledNav() {
        var nav = document.querySelector('.modern-nav');
        if (!nav) {
            return;
        }

        var onScroll = function () {
            if (window.scrollY > 60) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }
        };

        onScroll();
        window.addEventListener('scroll', onScroll, { passive: true });
    }

    document.addEventListener('DOMContentLoaded', function () {
        setActiveNav();
        setupReveal();
        setupScrollTopButton();
        setupScrolledNav();
    });
})();
