@once
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const toggle = document.querySelector('[data-admin-toggle="sidebar"]');
                const sidebar = document.getElementById('admin-sidebar');
                if (!toggle || !sidebar) {
                    return;
                }

                const openClass = 'translate-x-0';
                const closedClass = '-translate-x-full';

                sidebar.classList.add('flex', 'flex-col', 'transition', 'duration-200', 'ease-out', closedClass, 'fixed', 'top-0', 'left-0', 'h-full', 'max-w-xs', 'z-50', 'bg-white', 'lg:static', 'lg:max-w-none', 'lg:translate-x-0');
                sidebar.classList.remove('hidden');
                toggle.setAttribute('aria-expanded', 'false');

                const closeSidebar = () => {
                    sidebar.classList.remove(openClass);
                    sidebar.classList.add(closedClass);
                    toggle.setAttribute('aria-expanded', 'false');
                };

                const openSidebar = () => {
                    sidebar.classList.add(openClass);
                    sidebar.classList.remove(closedClass);
                    toggle.setAttribute('aria-expanded', 'true');
                };

                document.addEventListener('click', (event) => {
                    if (
                        !window.matchMedia('(max-width: 1023px)').matches ||
                        sidebar.contains(event.target) ||
                        toggle.contains(event.target)
                    ) {
                        return;
                    }
                    closeSidebar();
                });

                document.addEventListener('keydown', (event) => {
                    if (event.key === 'Escape') {
                        closeSidebar();
                    }
                });

                toggle.addEventListener('click', () => {
                    const isClosed = sidebar.classList.contains(closedClass);
                    if (isClosed) {
                        openSidebar();
                    } else {
                        closeSidebar();
                    }
                });
            });
        </script>
    @endpush
@endonce
