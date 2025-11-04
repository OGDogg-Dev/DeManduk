/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],
    theme: {
        extend: {},
    },
    plugins: [],
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