import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

const FOCUSABLE_SELECTOR = 'a[href], button:not([disabled]), textarea:not([disabled]), input:not([disabled]), select:not([disabled]), [tabindex]:not([tabindex="-1"])';

Alpine.directive('focus-trap', (el, { expression }, { evaluateLater, effect, cleanup }) => {
    const evaluate = evaluateLater(expression);
    let active = false;
    let previouslyFocused = null;

    const handleKeydown = (event) => {
        if (event.key !== 'Tab') return;

        const focusable = Array.from(el.querySelectorAll(FOCUSABLE_SELECTOR));
        if (focusable.length === 0) return;

        const first = focusable[0];
        const last = focusable[focusable.length - 1];

        if (event.shiftKey && document.activeElement === first) {
            event.preventDefault();
            last.focus();
        } else if (! event.shiftKey && document.activeElement === last) {
            event.preventDefault();
            first.focus();
        }
    };

    effect(() => {
        evaluate((value) => {
            if (value && ! active) {
                active = true;
                previouslyFocused = document.activeElement;
                document.body.style.overflow = 'hidden';
                queueMicrotask(() => (el.querySelector(FOCUSABLE_SELECTOR) || el).focus());
                document.addEventListener('keydown', handleKeydown);
            } else if (! value && active) {
                active = false;
                document.body.style.overflow = '';
                document.removeEventListener('keydown', handleKeydown);
                previouslyFocused?.focus();
            }
        });
    });

    cleanup(() => {
        document.removeEventListener('keydown', handleKeydown);
        document.body.style.overflow = '';
    });
});

Alpine.data('sidebarShell', () => ({
    collapsed: localStorage.getItem('ui-sidebar-collapsed') === '1',
    mobileOpen: false,
    toggleCollapse() {
        this.collapsed = ! this.collapsed;
        localStorage.setItem('ui-sidebar-collapsed', this.collapsed ? '1' : '0');
    },
}));

Alpine.data('topbarNav', () => ({
    mobileOpen: false,
}));

Alpine.start();
