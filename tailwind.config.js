import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './app/**/*.php',
  ],
  darkMode: ['selector', '[data-theme="dark"]'],
  theme: {
    extend: {
      colors: {
        brand: {
          50: 'var(--color-brand-50)', 100: 'var(--color-brand-100)',
          300: 'var(--color-brand-300)', 500: 'var(--color-brand-500)',
          600: 'var(--color-brand-600)', 700: 'var(--color-brand-700)',
          900: 'var(--color-brand-900)',
        },
        surface: {
          DEFAULT: 'var(--color-surface)',
          card: 'var(--color-surface-card)',
          sunken: 'var(--color-surface-sunken)',
        },
        line: {
          DEFAULT: 'var(--color-border)',
          strong: 'var(--color-border-strong)',
        },
        ink: {
          DEFAULT: 'var(--color-text-primary)',
          soft: 'var(--color-text-secondary)',
          muted: 'var(--color-text-muted)',
        },
        overlay: 'var(--color-overlay)',
        positive: { DEFAULT: 'var(--color-positive)', bg: 'var(--color-positive-bg)' },
        negative: { DEFAULT: 'var(--color-negative)', bg: 'var(--color-negative-bg)' },
        warning: { DEFAULT: 'var(--color-warning)', bg: 'var(--color-warning-bg)' },
        info: { DEFAULT: 'var(--color-info)', bg: 'var(--color-info-bg)' },
      },
      fontFamily: {
        display: ['"Plus Jakarta Sans"', 'Inter', 'system-ui', 'sans-serif'],
        sans: ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
      },
      fontSize: {
        display: ['2.25rem', { fontWeight: '700' }],
        h1: ['1.5rem', { fontWeight: '700' }],
        h2: ['1.25rem', { fontWeight: '600' }],
        body: ['0.9375rem', { fontWeight: '400', lineHeight: '1.6' }],
        sm: ['0.8125rem', { fontWeight: '400' }],
        xs: ['0.75rem', { fontWeight: '500' }],
      },
      borderRadius: {
        sm: 'var(--radius-sm)', md: 'var(--radius-md)', lg: 'var(--radius-lg)',
      },
      boxShadow: {
        card: 'var(--shadow-card)', modal: 'var(--shadow-modal)',
      },
      transitionDuration: {
        fast: 'var(--duration-fast)',
        base: 'var(--duration-base)',
      },
      transitionTimingFunction: {
        standard: 'var(--ease-standard)',
      },
      backgroundImage: {
        'positive-gradient': 'var(--gradient-positive)',
        'negative-gradient': 'var(--gradient-negative)',
        'warning-gradient':  'var(--gradient-warning)',
        'info-gradient':     'var(--gradient-info)',
        'brand-gradient':    'var(--gradient-brand)',
      },
    },
  },
  plugins: [forms],
};
