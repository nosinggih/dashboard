import './bootstrap';
import Alpine from 'alpinejs';
import { createFocusTrap } from 'focus-trap';

window.Alpine = Alpine;

Alpine.directive('focus-trap', (el, { expression }, { evaluateLater, effect, cleanup }) => {
    const evaluate = evaluateLater(expression);
    let active = false;

    const trap = createFocusTrap(el, {
        escapeDeactivates: false,
        clickOutsideDeactivates: false,
        fallbackFocus: el,
    });

    effect(() => {
        evaluate((value) => {
            if (value && ! active) {
                active = true;
                document.body.style.overflow = 'hidden';
                trap.activate();
            } else if (! value && active) {
                active = false;
                document.body.style.overflow = '';
                trap.deactivate();
            }
        });
    });

    cleanup(() => {
        document.body.style.overflow = '';
        if (active) trap.deactivate();
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

Alpine.data('selectSearch', ({ options = [], selected = '' } = {}) => ({
    enhanced: false,
    open: false,
    query: '',
    options,
    selected,
    activeIndex: -1,

    init() {
        this.enhanced = true;
        this.$watch('query', () => (this.activeIndex = this.filtered.length ? 0 : -1));
    },

    get filtered() {
        const q = this.query.trim().toLowerCase();
        return q ? this.options.filter((opt) => opt.label.toLowerCase().includes(q)) : this.options;
    },

    get selectedLabel() {
        return this.options.find((opt) => opt.value === this.selected)?.label ?? '';
    },

    toggle() {
        this.open ? this.close() : this.openAndFocus();
    },

    openAndFocus() {
        this.open = true;
        this.activeIndex = Math.max(0, this.filtered.findIndex((opt) => opt.value === this.selected));
        this.$nextTick(() => this.$refs.search?.focus());
    },

    close() {
        this.open = false;
        this.query = '';
        this.activeIndex = -1;
    },

    highlightNext() {
        if (! this.open) return this.openAndFocus();
        this.activeIndex = Math.min(this.activeIndex + 1, this.filtered.length - 1);
        this.scrollActiveIntoView();
    },

    highlightPrev() {
        if (! this.open) return;
        this.activeIndex = Math.max(this.activeIndex - 1, 0);
        this.scrollActiveIntoView();
    },

    scrollActiveIntoView() {
        this.$nextTick(() => this.$refs.list?.children[this.activeIndex]?.scrollIntoView({ block: 'nearest' }));
    },

    selectHighlighted() {
        const opt = this.filtered[this.activeIndex];
        if (opt) this.choose(opt);
    },

    choose(opt) {
        this.selected = opt.value;
        this.$refs.native.value = opt.value;
        this.$refs.native.dispatchEvent(new Event('change', { bubbles: true }));
        this.close();
    },
}));

Alpine.store('loadingBar', {
    active: false,
    start() {
        this.active = true;
    },
    done() {
        this.active = false;
    },
});

Alpine.store('loadingOverlay', {
    active: false,
    message: 'Memuat...',
    start(message = 'Memuat...') {
        this.message = message;
        this.active = true;
    },
    done() {
        this.active = false;
    },
});

Alpine.store('pageTransition', {
    active: false,
    start() {
        this.active = true;
    },
    done() {
        this.active = false;
    },
});

Alpine.start();
