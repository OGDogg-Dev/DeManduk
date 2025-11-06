/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],
    theme: {
        screens: {
            'sm': '640px',
            // => @media (min-width: 640px) { ... }
      
            'md': '768px',
            // => @media (min-width: 768px) { ... }
      
            'lg': '1024px',
            // => @media (min-width: 1024px) { ... }
      
            'xl': '1280px',
            // => @media (min-width: 1280px) { ... }
      
            '2xl': '1536px',
            // => @media (min-width: 1536px) { ... }
        },
        extend: {
            container: {
                center: true,
                padding: {
                    DEFAULT: '1rem',
                    sm: '1.5rem',
                    lg: '2rem',
                    xl: '2.5rem',
                    '2xl': '3rem',
                },
            },
        },
    },
    plugins: [
        require('@tailwindcss/container-queries'),
    ],
    safelist: [
        // Add custom classes that are used but not detected by Tailwind
        'btn',
        'btn-primary', 
        'btn-ghost',
        'btn-danger',
        'card',
        'ring-subtle',
        'nav-pill-group',
        'nav-pill',
        'nav-pill--active',
        'container-app',
        'pill',
        'hero-panel',
        'wysiwyg',
        'note-info',
        'note-warn',
        'note-ok',
        'meter',
        'meter__fill',
        'text-balance',
        'navy-divider',
        'admin-surface',
        'ring-offset-surface',
        'glass-card',
    ]
}