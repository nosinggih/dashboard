# DASHBOARD — Template Repository

> A modern web application template with complete design system, UI components, and best practices for building scalable Laravel applications.

**Status:** ✅ MVP 1 Complete (Fase 1–6)  
**Template:** Yes — Use as starting point for your next web application  
**Keep Original:** Yes — This repository is maintained for future updates (Dashboard v2, v3, etc.)

---

## 🚀 Quick Start

### Option 1: Use as Template (Recommended for New Projects)

1. Click **"Use this template"** button on GitHub
2. Create a new repository from this template
3. Clone your new repository and start developing

### Option 2: Clone (for Development)

```bash
git clone https://github.com/nosinggih/dashboard.git my-app
cd my-app
npm install
php artisan migrate:refresh
npm run dev
```

---

## 📋 What's Included

### Design System
- **Complete design tokens** (colors, typography, spacing, shadows, motion)
- **WCAG AA compliant** color system for accessibility
- **Responsive design** system (6 breakpoints: mobile, tablet, desktop)
- **Dark mode** support built-in via CSS custom properties

### UI Components
- 30+ reusable Blade components
- All component variants (primary, secondary, ghost, danger, link, etc.)
- Form elements with full accessibility (input, select, checkbox, radio, toggle)
- Data display (table, badge, avatar, breadcrumb, pagination)
- Feedback (alert, toast, tooltip, empty state)
- Navigation (tabs, dropdown, modal, carousel)
- Complex components with Alpine.js enhancement

### Best Practices
- ✅ Keyboard navigation (Tab, Enter, Escape)
- ✅ Screen reader support (semantic HTML, ARIA)
- ✅ No JavaScript required (graceful degradation)
- ✅ Self-hosted assets (no CDN dependencies)
- ✅ Performance optimized (CSS <30KB gzip, JS <40KB gzip)
- ✅ Dark mode support

---

## 🛠 Tech Stack

| Technology | Version | Purpose |
|---|---|---|
| **Laravel** | 11.x | Backend framework, Blade templating |
| **Tailwind CSS** | 3.4.x | Utility-first CSS (JANGAN v4) |
| **Alpine.js** | 3.x | Lightweight interactivity |
| **Vite** | 6.x | Asset bundler & dev server |
| **PostCSS** | 8.x | CSS processing + Autoprefixer |
| **Tabler Icons** | latest | SVG icon library (self-hosted) |
| **Plus Jakarta Sans** | 600, 700 | Primary font (self-hosted) |
| **Inter** | 400–600 | Secondary font (self-hosted) |

---

## 📁 Project Structure

```
dashboard/
├── CLAUDE.md                    ← Development instructions (READ FIRST)
├── DESIGN_SYSTEM.md             ← Design token & component specs
├── BACKLOG.md                   ← Future tasks & improvements
│
├── resources/
│   ├── css/
│   │   ├── app.css              # Entry point
│   │   ├── tokens.css           # Design tokens
│   │   ├── base.css             # Reset + typography
│   │   └── components.css       # Extracted component classes
│   │
│   ├── js/
│   │   ├── app.js               # Alpine.js initialization
│   │   └── modules/             # Feature-specific JS
│   │
│   ├── views/
│   │   ├── components/ui/       # Reusable UI components
│   │   ├── layouts/             # Page layouts
│   │   ├── partials/            # Layout fragments
│   │   └── pages/               # Page templates
│   │
│   └── svg/icons/               # Self-hosted Tabler Icons
│
├── public/
│   ├── fonts/                   # Self-hosted web fonts
│   └── images/                  # Static images
│
├── tailwind.config.js           # Token → Tailwind mapping
├── postcss.config.js            # CSS processing
├── vite.config.js               # Asset bundler config
└── package.json
```

---

## 🎨 Customization

### Change Color Scheme
Edit `resources/css/tokens.css` to swap color values. All components automatically use the new palette.

### Add New Component
1. Create `resources/views/components/ui/component-name.blade.php`
2. Follow the template structure in `CLAUDE.md` section "Template Blade Component"
3. Add to `/styleguide` for documentation
4. Test all variants and responsive breakpoints

### Dark Mode
Dark mode is pre-configured. Use `prefers-color-scheme` media queries or implement toggle via `[data-theme="dark"]`.

---

## 📖 Documentation

- **`CLAUDE.md`** — Development rules, best practices, execution roadmap
- **`DESIGN_SYSTEM.md`** — Complete design specifications (colors, typography, components)
- **`BACKLOG.md`** — Future enhancements and planned features
- **`/styleguide`** — Live component documentation

Read `CLAUDE.md` before making any changes.

---

## ✅ Checklist Before Deploying

- [ ] All text passes WCAG AA contrast check (4.5:1 for body, 3:1 for large)
- [ ] Keyboard navigation works (Tab through all interactive elements)
- [ ] No JavaScript required (disable JS and verify core functionality)
- [ ] Responsive at 360px, 768px, 1024px, 1920px
- [ ] All images are optimized
- [ ] No external CDN dependencies
- [ ] CSS gzip size < 30KB
- [ ] JavaScript gzip size < 40KB
- [ ] Lighthouse score > 90
- [ ] Mobile performance on 3G throttling

---

## 🔄 Update from Original Template

If this repository gets updates to the design system:

```bash
# Add upstream (original template)
git remote add upstream https://github.com/nosinggih/dashboard.git

# Fetch latest template updates
git fetch upstream main

# Merge template updates into your branch
git merge upstream/main
```

---

## 📝 License

[License info here]

---

## 👤 Contributing

To contribute improvements back to the original template:

1. Fork this repository
2. Create a feature branch (`git checkout -b feature/improvement`)
3. Commit your changes (`git commit -m "description"`)
4. Push to branch (`git push origin feature/improvement`)
5. Open a Pull Request

---

**Last Updated:** 2026-07-22 (Fase 6 complete)
