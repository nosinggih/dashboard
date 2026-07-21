# CLAUDE.md — Instruksi Permanen untuk Claude Code

> File ini WAJIB dibaca sebelum mengerjakan task apapun di project ini.
> Semua keputusan teknis dan visual sudah didokumentasikan — jangan improvisasi di luar aturan ini.

---

## Identitas Project

- **Nama kerja:** Ledgerly UI
- **Jenis:** Design system + tema untuk aplikasi web keuangan
- **Tech stack:** Laravel 11 + Blade Component + Tailwind CSS v3.4 + Alpine.js v3
- **Dokumen desain:** `DESIGN_SYSTEM.md` (single source of truth untuk semua keputusan visual)

---

## Aturan Absolut (Tidak Boleh Dilanggar)

### Kode & Arsitektur
1. **Tidak boleh inline PHP di Blade view.** Semua logika di Controller atau Blade Component Class. View hanya menerima data dan merender.
2. **Semua UI = Blade Component** dengan namespace `x-ui.*`. Contoh: `<x-ui.button>`, `<x-ui.card>`, `<x-ui.table.row>`. Jangan pernah pakai `@include` untuk komponen UI.
3. **Tidak boleh hardcode nilai warna, ukuran, radius, shadow.** Selalu gunakan CSS custom property (token) atau class Tailwind yang sudah dipetakan di `tailwind.config.js`.
4. **Tailwind v3.4, BUKAN v4.** Jangan install atau upgrade ke Tailwind v4 — v4 memakai `oklch()` dan `@property` yang tidak didukung browser target.
5. **Class Tailwind yang berulang > 3x dan panjang → ekstrak ke `components.css` pakai `@apply`.** Jangan copy-paste utility chain yang sama di banyak tempat.
6. **JS tidak boleh menarget class styling.** Gunakan `data-js="nama-hook"` untuk selector JavaScript. Class `.is-*` untuk state toggle.

### Visual & Desain
7. **Angka finansial WAJIB pakai class `.u-num`** (tabular-nums, lining-nums, rata kanan untuk kolom tabel).
8. **Hijau = uang masuk/naik, Merah = uang keluar/turun.** Tidak boleh dibalik. Tidak boleh dipakai untuk dekorasi. Selalu dampingi dengan ikon panah ↑/↓ atau tanda +/−.
9. **Tidak ada warna hardcode.** Semua warna lewat token: `text-ink`, `bg-surface`, `text-brand-500`, `bg-positive`, dsb.
10. **Kontras WCAG AA minimum** — 4.5:1 untuk body text, 3:1 untuk large text.

### Performa & Kompatibilitas
11. **Self-host semua aset.** Font (woff2), ikon (SVG inline), Alpine.js, Chart.js — jangan pakai CDN eksternal.
12. **Halaman harus fungsional tanpa JavaScript.** Form bisa submit, tabel terbaca, navigasi bisa diklik. JS hanya enhancement.
13. **Hormati `prefers-reduced-motion`.** Semua animasi/transisi harus dibungkus media query reduced-motion.

---

## Tech Stack & Versi

| Teknologi | Versi | Catatan |
|---|---|---|
| Laravel | 11.x | Blade component, bukan Livewire/Inertia (kecuali diminta) |
| Tailwind CSS | 3.4.x | JANGAN v4 |
| Alpine.js | 3.x | Untuk interaksi ringan (modal, dropdown, tabs, toggle) |
| PostCSS + Autoprefixer | latest | Wajib — untuk prefix vendor browser lama |
| Chart.js | 4.x | Hanya dimuat di halaman yang ada chart (lazy load) |
| Font: Plus Jakarta Sans | 600, 700 | Self-host, woff2, `font-display: swap` |
| Font: Inter | 400, 500, 600 | Self-host, woff2, `font-display: swap` |
| Ikon: Tabler Icons | latest | Inline SVG via Blade component, bukan icon-font |
| Node.js | 18+ | Untuk build tooling saja |
| Vite | default Laravel | Asset bundler |

### Target Browser (browserslist)

```
> 0.3%, last 4 versions, Chrome >= 70, Firefox >= 68, Safari >= 12, Edge >= 79, not dead
```

### Fitur CSS yang BOLEH dipakai
- Flexbox, CSS Grid dasar
- CSS Custom Properties (variabel)
- `position: sticky` (dengan fallback graceful)
- `scroll-snap-type` (untuk carousel)
- `font-variant-numeric: tabular-nums`
- Transisi dan animasi sederhana

### Fitur CSS yang DILARANG (tidak support browser target)
- `subgrid`
- `container queries` (`@container`)
- `:has()` selector
- `oklch()`, `color-mix()`
- `backdrop-filter` tanpa fallback background solid
- `@property`
- CSS Nesting native (pakai PostCSS nesting sebagai gantinya)

---

## Konvensi Penamaan

### Blade Component
```
x-ui.{komponen}           → x-ui.button, x-ui.card, x-ui.modal
x-ui.{komponen}.{child}   → x-ui.table.head, x-ui.table.row, x-ui.table.cell
```
- Nama: kata benda tunggal, bahasa Inggris, huruf kecil
- Sub-komponen: pakai titik sebagai separator

### Prop Komponen (kontrak standar)
Setiap komponen yang punya variasi WAJIB menerima prop berikut (bila relevan):

```php
@props([
    'variant' => 'default',  // tampilan: primary, secondary, ghost, danger, dll
    'size'    => 'md',        // ukuran: sm, md, lg
])
```

Sisa atribut HTML diteruskan via `{{ $attributes->merge([...]) }}`.

### CSS Class
```
.c-{komponen}              → .c-btn, .c-card, .c-table
.c-{komponen}--{modifier}  → .c-btn--primary, .c-card--flat
.c-{komponen}__{element}   → .c-card__header, .c-card__body
.is-{state}                → .is-active, .is-loading, .is-invalid
.u-{utility}               → .u-num, .u-truncate-2
```

### File Naming
```
resources/views/components/ui/button.blade.php      → <x-ui.button>
resources/views/components/ui/table/row.blade.php   → <x-ui.table.row>
```

---

## Struktur Folder

```
project-root/
├── CLAUDE.md                          ← FILE INI
├── DESIGN_SYSTEM.md                   ← Sumber kebenaran desain
│
├── resources/
│   ├── css/
│   │   ├── app.css                    # Entry point: @import tokens → base → components
│   │   ├── tokens.css                 # SEMUA design token (file rebrand)
│   │   ├── base.css                   # Reset, tipografi dasar, .u-* utilities
│   │   └── components.css             # Class .c-* hasil @apply
│   │
│   ├── js/
│   │   ├── app.js                     # Alpine.js init + register komponen global
│   │   └── modules/                   # Per-page: chart-loader.js, dsb
│   │
│   ├── views/
│   │   ├── layouts/
│   │   │   ├── guest.blade.php        # Layout: landing, login, register
│   │   │   ├── app-sidebar.blade.php  # Dashboard layout: sidebar
│   │   │   ├── app-topbar.blade.php   # Dashboard layout: topbar
│   │   │   └── app-mix.blade.php      # Dashboard layout: sidebar + topbar
│   │   │
│   │   ├── components/ui/             # SEMUA komponen reusable
│   │   │   ├── button.blade.php
│   │   │   ├── card.blade.php
│   │   │   ├── modal.blade.php
│   │   │   ├── badge.blade.php
│   │   │   ├── alert.blade.php
│   │   │   ├── icon.blade.php
│   │   │   ├── input.blade.php
│   │   │   ├── input-money.blade.php
│   │   │   ├── select.blade.php
│   │   │   ├── checkbox.blade.php
│   │   │   ├── toggle.blade.php
│   │   │   ├── tooltip.blade.php
│   │   │   ├── dropdown.blade.php
│   │   │   ├── tabs.blade.php
│   │   │   ├── toast.blade.php
│   │   │   ├── pagination.blade.php
│   │   │   ├── breadcrumb.blade.php
│   │   │   ├── avatar.blade.php
│   │   │   ├── skeleton.blade.php
│   │   │   ├── empty-state.blade.php
│   │   │   ├── progress.blade.php
│   │   │   ├── stepper.blade.php
│   │   │   ├── carousel.blade.php
│   │   │   ├── trend.blade.php        # Badge hijau/merah + panah untuk stat
│   │   │   └── table/
│   │   │       ├── index.blade.php    # <x-ui.table>
│   │   │       ├── head.blade.php
│   │   │       ├── row.blade.php
│   │   │       └── cell.blade.php
│   │   │
│   │   └── partials/                  # Fragment non-reusable (navbar, footer, sidebar-nav)
│   │       ├── navbar.blade.php
│   │       ├── footer.blade.php
│   │       └── sidebar-nav.blade.php
│   │
│   │   └── pages/
│   │       ├── landing.blade.php
│   │       ├── styleguide.blade.php   # Dokumentasi hidup semua komponen
│   │       ├── auth/
│   │       │   ├── login.blade.php
│   │       │   └── register.blade.php
│   │       └── dashboard/
│   │           └── index.blade.php
│   │
│   └── svg/
│       └── icons/                     # Subset Tabler Icons yang dipakai (file .svg)
│
├── tailwind.config.js
├── postcss.config.js
├── vite.config.js
└── package.json
```

**Jangan buat file di luar struktur ini** kecuali diminta secara eksplisit.

---

## Roadmap Eksekusi (Kerjakan Berurutan)

### Fase 1 — Fondasi
**Perintah:** `Kerjakan Fase 1`

Tugas:
1. Install dependencies: `tailwindcss@3.4`, `postcss`, `autoprefixer`, `@tailwindcss/forms`, `alpinejs`
2. Buat `resources/css/tokens.css` — semua CSS custom properties sesuai DESIGN_SYSTEM.md bab 2
3. Buat `tailwind.config.js` — mapping token ke Tailwind sesuai DESIGN_SYSTEM.md bab 5
4. Buat `postcss.config.js` dengan autoprefixer + browserslist
5. Buat `resources/css/base.css` — reset minimal, setup font-face (self-host), class `.u-num`, `prefers-reduced-motion`
6. Buat `resources/css/app.css` — import urut: tokens → base → components
7. Buat `resources/css/components.css` — kosong dulu, siap diisi
8. Download & simpan font Plus Jakarta Sans (600,700) dan Inter (400,500,600) ke `public/fonts/` sebagai woff2
9. Download subset Tabler Icons yang dipakai ke `resources/svg/icons/`
10. Buat `resources/views/components/ui/icon.blade.php` — komponen ikon inline SVG
11. Buat halaman `/styleguide` — layout sederhana yang menampilkan: palet warna, skala tipografi, token spacing, contoh ikon
12. Pastikan `vite.config.js` benar dan `npm run build` berhasil tanpa error

**Output yang harus bisa direview:**
- Buka browser → `/styleguide` → terlihat semua token terdemo rapi
- Tidak ada error di console
- `npm run build` sukses

---

### Fase 2 — Komponen Inti
**Perintah:** `Kerjakan Fase 2`

Tugas:
1. `<x-ui.button>` — variant: primary, secondary, ghost, danger, link. Size: sm, md, lg. Props: icon, iconRight, loading, disabled. Lihat DESIGN_SYSTEM.md 7.1
2. `<x-ui.input>` — dengan label, helper text, error state. Size: sm, md, lg
3. `<x-ui.input-money>` — prefix mata uang, auto `.u-num`, rata kanan
4. `<x-ui.select>` — sama dengan input (label, helper, error)
5. `<x-ui.textarea>` — sama
6. `<x-ui.checkbox>`, `<x-ui.radio>`, `<x-ui.toggle>`
7. `<x-ui.card>` — variant: default, flat, stat. Slot: header, default, footer. Lihat DESIGN_SYSTEM.md 7.2
8. `<x-ui.trend>` — badge hijau/merah + panah ↑/↓ untuk stat card
9. `<x-ui.badge>` — variant: positive, negative, warning, info, neutral. Size: sm, md
10. `<x-ui.icon>` — sudah ada dari Fase 1, pastikan support size 16/20/24
11. `<x-ui.alert>` — 4 varian semantik, dismissible via Alpine
12. Ekstrak class berulang ke `components.css` pakai `@apply`
13. Tambahkan SEMUA komponen di atas ke halaman `/styleguide` dengan semua varian & ukuran

**Output yang harus bisa direview:**
- `/styleguide` menampilkan setiap komponen dalam semua variannya
- Semua tombol bisa diklik, focus ring terlihat saat Tab
- Form elements punya state: default, focus, error, disabled

---

### Fase 3 — Komponen Kompleks
**Perintah:** `Kerjakan Fase 3`

Tugas:
1. `<x-ui.table>` — SEMUA varian (default, striped, bordered, compact, card) dan ukuran (sm, md, lg). Lihat DESIGN_SYSTEM.md bab 8 secara mendetail
2. `<x-ui.table.head>`, `<x-ui.table.row>`, `<x-ui.table.cell>` — cell type="number" otomatis `.u-num` + rata kanan
3. Contoh tabel: data table (sortable), transaction table, summary table (tfoot), sticky header
4. `<x-ui.modal>` — ukuran sm/md/lg/full. Alpine: buka/tutup, ESC, klik overlay, focus trap. Varian confirm
5. `<x-ui.dropdown>` — Alpine, posisi otomatis
6. `<x-ui.tabs>` — underline style, Alpine, roving tabindex
7. `<x-ui.pagination>` — kompatibel dengan Laravel paginator
8. `<x-ui.toast>` — pojok kanan bawah, auto-hide, max 3 antrian
9. `<x-ui.breadcrumb>` — dari array
10. `<x-ui.avatar>` — ukuran xs-lg, fallback inisial
11. `<x-ui.tooltip>` — CSS-only (hover + focus)
12. `<x-ui.skeleton>` — shimmer loading
13. `<x-ui.empty-state>` — ikon + judul + kalimat + CTA
14. `<x-ui.progress>` — bar dan ring
15. `<x-ui.stepper>` — untuk wizard multi-step
16. `<x-ui.carousel>` — CSS scroll-snap + Alpine enhancement
17. Tambahkan SEMUA ke `/styleguide`

**Output yang harus bisa direview:**
- Semua komponen interaktif berfungsi (modal buka/tutup, tab berpindah, dropdown terbuka)
- Tabel responsif: bisa di-scroll horizontal di mobile
- Modal full-screen di breakpoint kecil

---

### Fase 4 — Layout
**Perintah:** `Kerjakan Fase 4`

Tugas:
1. `layouts/guest.blade.php` — untuk landing, login, register. Navbar + footer
2. `layouts/app-sidebar.blade.php` — sidebar 260px, collapse ke 72px, drawer di mobile. Lihat DESIGN_SYSTEM.md 10.A
3. `layouts/app-topbar.blade.php` — navigasi horizontal, max-w 7xl. Lihat DESIGN_SYSTEM.md 10.B
4. `layouts/app-mix.blade.php` — topbar level-1 + sidebar level-2. Lihat DESIGN_SYSTEM.md 10.C
5. `partials/navbar.blade.php` — sticky, blur + fallback solid
6. `partials/footer.blade.php` — 4 kolom, bg brand-900
7. `partials/sidebar-nav.blade.php` — item aktif: bg brand-50 + teks brand-700 + garis kiri
8. Tambahkan demo layout ke `/styleguide` (atau buat `/styleguide/layouts`)

**Output yang harus bisa direview:**
- Ketiga layout bisa diakses dan bekerja
- Sidebar collapse/expand berfungsi
- Responsive: sidebar jadi drawer di mobile, topbar menu masuk hamburger

---

### Fase 5 — Halaman
**Perintah:** `Kerjakan Fase 5`

Tugas:
1. **Landing page** (`/`) — hero, trust bar, fitur, angka sosial-proof, testimonial carousel, pricing table, CTA + footer. Lihat DESIGN_SYSTEM.md 9.1
2. **Login** (`/login`) — split layout, form lengkap. Lihat DESIGN_SYSTEM.md 9.2
3. **Register** (`/register`) — split layout, stepper jika multi-step. Lihat DESIGN_SYSTEM.md 9.3
4. **Dashboard** (`/dashboard`) — stat cards, chart, transaction table. Lihat DESIGN_SYSTEM.md 9.4. Pakai layout `app-sidebar` sebagai default
5. Isi dengan **data dummy yang realistis** — nama Indonesia, nominal Rupiah, tanggal lokal
6. Semua halaman HANYA merakit komponen dari Fase 2-3 (dogfooding)

**Data dummy contoh:**
- Saldo: Rp 47.250.000
- Pemasukan bulan ini: Rp 12.800.000 (+8,2%)
- Pengeluaran bulan ini: Rp 9.350.000 (−3,1%)
- Transaksi: "Pembayaran invoice PT Maju Bersama", "Gaji karyawan bulan Juli", "Biaya server cloud"

**Output yang harus bisa direview:**
- 4 halaman lengkap, bisa diakses via route
- Semua data dummy terlihat realistis
- Responsive di semua breakpoint

---

### Fase 6 — QA & Polish
**Perintah:** `Kerjakan Fase 6`

Tugas:
1. Test responsive: 360px (mobile kecil), 390px (iPhone), 768px (tablet), 1024px, 1280px (laptop), 1920px (desktop)
2. Test keyboard-only navigation: Tab melalui semua elemen interaktif, focus ring selalu terlihat
3. Test tanpa JavaScript: disable JS di browser → halaman tetap terbaca, form tetap bisa submit
4. Jalankan `npx tailwindcss --minify` — cek ukuran CSS akhir ≤ 30KB gzip
5. Cek total JS (Alpine + custom) ≤ 40KB gzip
6. Cek font ≤ 120KB total
7. Audit kontras warna: semua teks lolos WCAG AA
8. Pastikan `prefers-reduced-motion` berfungsi
9. Cek tidak ada hex/rgb hardcode di Blade files (semuanya lewat token/class)
10. Cek tidak ada inline PHP di Blade files
11. Pastikan semua halaman load < 3 detik di koneksi 3G (simulated throttling)
12. Fix semua temuan

**Output yang harus bisa direview:**
- Laporan ringkas hasil QA (apa yang dites, apa yang difix)
- Semua checklist "Definition of Done" (DESIGN_SYSTEM.md bab 17) terpenuhi

---

## Referensi Cepat

### Cara baca DESIGN_SYSTEM.md
- **Bab 2** → semua token (warna, spacing, shadow, motion)
- **Bab 3** → font, skala tipe, aturan angka
- **Bab 4** → aturan warna semantik keuangan
- **Bab 7** → spesifikasi setiap komponen (prop, varian, ukuran)
- **Bab 8** → tabel (bab terpenting untuk finance app)
- **Bab 9** → susunan halaman ready-to-use
- **Bab 10** → 3 varian layout dashboard (dengan diagram ASCII)
- **Bab 11** → daftar micro-interaction yang dibolehkan
- **Bab 14** → budget performa (hard limit)

### Template Blade Component

Kalau membuat komponen baru, selalu mulai dari template ini:

```blade
{{-- resources/views/components/ui/nama-komponen.blade.php --}}
@props([
    'variant' => 'default',
    'size' => 'md',
])

@php
$baseClass = 'c-nama';
$variantClass = match($variant) {
    'primary' => 'c-nama--primary',
    'secondary' => 'c-nama--secondary',
    default => '',
};
$sizeClass = match($size) {
    'sm' => 'c-nama--sm',
    'lg' => 'c-nama--lg',
    default => '',
};
@endphp

<div {{ $attributes->merge(['class' => "$baseClass $variantClass $sizeClass"]) }}>
    {{ $slot }}
</div>
```

### Utility Wajib untuk Angka

```html
{{-- Setiap kali menampilkan angka uang: --}}
<span class="u-num">Rp 47.250.000</span>

{{-- Di tabel, kolom angka: --}}
<x-ui.table.cell type="number">12.800.000</x-ui.table.cell>
{{-- type="number" otomatis menambahkan .u-num + text-right --}}
```

### Perintah Build

```bash
npm run dev          # development dengan HMR
npm run build        # production build
php artisan serve    # jalankan Laravel
```

---

## Larangan Keras

1. ❌ Jangan install Tailwind v4
2. ❌ Jangan pakai CDN untuk font/ikon/library apapun
3. ❌ Jangan pakai `@include` untuk komponen UI — selalu Blade Component
4. ❌ Jangan tulis `<?php ?>` atau `{!! !!}` di view untuk logika — hanya `{{ }}` untuk output
5. ❌ Jangan hardcode hex warna — selalu token
6. ❌ Jangan buat animasi > 200ms atau animasi dekoratif tanpa fungsi
7. ❌ Jangan pakai `backdrop-filter` tanpa fallback
8. ❌ Jangan pakai `:has()`, `subgrid`, `container queries`, `oklch()`
9. ❌ Jangan buat komponen tanpa mendemokannya di `/styleguide`
10. ❌ Jangan abaikan `prefers-reduced-motion`

---

*File ini adalah instruksi permanen. Selalu baca sebelum mulai bekerja.*
