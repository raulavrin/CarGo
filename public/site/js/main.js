(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();
    
    
    // Initiate the wowjs
    new WOW().init();


    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 45) {
            $('.nav-bar').addClass('sticky-top');
        } else {
            $('.nav-bar').removeClass('sticky-top');
        }
    });
    
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Header carousel
    $(".header-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1500,
        items: 1,
        dots: true,
        loop: true,
        nav : true,
        navText : [
            '<i class="bi bi-chevron-left"></i>',
            '<i class="bi bi-chevron-right"></i>'
        ]
    });


    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        margin: 24,
        dots: false,
        loop: true,
        nav : true,
        navText : [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
        responsive: {
            0:{
                items:1
            },
            992:{
                items:2
            }
        }
    });
    
   // Enhanced Theme Toggle with Smooth Transitions and Persistence
(function() {
    'use strict';

    // Theme configuration
    const THEME_KEY = 'cargo_theme_preference';
    const DARK_THEME = 'dark';
    const LIGHT_THEME = 'light';

    // Get theme from localStorage or system preference
    const getTheme = () => {
        const storedTheme = localStorage.getItem(THEME_KEY);
        if (storedTheme) {
            return storedTheme;
        }
        
        // Check system preference
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            return DARK_THEME;
        }
        
        return LIGHT_THEME;
    };

    // Apply theme with smooth transition
    const setTheme = (theme, animate = true) => {
        // Add transition class if animating
        if (animate) {
            document.documentElement.style.transition = 'background-color 0.3s ease, color 0.3s ease';
        }

        // Set theme attribute
        document.documentElement.setAttribute('data-theme', theme);
        localStorage.setItem(THEME_KEY, theme);
        
        // Update icon
        updateThemeIcon(theme);

        // Remove transition after animation
        if (animate) {
            setTimeout(() => {
                document.documentElement.style.transition = '';
            }, 300);
        }

        // Dispatch custom event for other scripts to listen
        window.dispatchEvent(new CustomEvent('themeChanged', { detail: { theme } }));
    };

    // Update theme toggle icon
    const updateThemeIcon = (theme) => {
        const themeIcon = document.getElementById('themeIcon');
        if (!themeIcon) return;

        if (theme === DARK_THEME) {
            themeIcon.classList.remove('fa-moon');
            themeIcon.classList.add('fa-sun');
        } else {
            themeIcon.classList.remove('fa-sun');
            themeIcon.classList.add('fa-moon');
        }
    };

    // Toggle between themes
    const toggleTheme = () => {
        const currentTheme = getTheme();
        const newTheme = currentTheme === LIGHT_THEME ? DARK_THEME : LIGHT_THEME;
        setTheme(newTheme, true);

        // Add ripple effect
        createRippleEffect();
    };

    // Create ripple effect on toggle
    const createRippleEffect = () => {
        const button = document.getElementById('themeToggle');
        if (!button) return;

        const ripple = document.createElement('span');
        ripple.style.position = 'absolute';
        ripple.style.borderRadius = '50%';
        ripple.style.background = 'rgba(49, 130, 206, 0.5)';
        ripple.style.width = '20px';
        ripple.style.height = '20px';
        ripple.style.left = '50%';
        ripple.style.top = '50%';
        ripple.style.transform = 'translate(-50%, -50%) scale(0)';
        ripple.style.animation = 'ripple 0.6s ease-out';
        ripple.style.pointerEvents = 'none';

        button.style.position = 'relative';
        button.appendChild(ripple);

        setTimeout(() => ripple.remove(), 600);
    };

    // Add ripple animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple {
            to {
                transform: translate(-50%, -50%) scale(4);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);

    // Initialize theme on page load (before DOM)
    const initialTheme = getTheme();
    document.documentElement.setAttribute('data-theme', initialTheme);

    // Wait for DOM to be ready
    const initThemeToggle = () => {
        // Set initial theme without animation
        setTheme(initialTheme, false);

        // Add event listener to toggle button
        const themeToggle = document.getElementById('themeToggle');
        if (themeToggle) {
            themeToggle.addEventListener('click', toggleTheme);
            
            // Add keyboard support
            themeToggle.addEventListener('keypress', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    toggleTheme();
                }
            });
        }

        // Listen for system theme changes
        if (window.matchMedia) {
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
                // Only auto-switch if user hasn't manually set preference
                const storedTheme = localStorage.getItem(THEME_KEY);
                if (!storedTheme) {
                    setTheme(e.matches ? DARK_THEME : LIGHT_THEME, true);
                }
            });
        }
    };

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initThemeToggle);
    } else {
        initThemeToggle();
    }

    // Expose theme API globally (optional)
    window.CarGoTheme = {
        get: getTheme,
        set: setTheme,
        toggle: toggleTheme
    };

})();
    
})(jQuery);

