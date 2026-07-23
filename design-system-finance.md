# 📘 Perencanaan Design System — "Ledgerly UI"
### Tema Aplikasi Web Keuangan (Tailwind-based, Laravel-ready)

> Dokumen ini adalah **blueprint eksekusi**. Junior programmer atau AI agent (Claude Code, dsb.) harus bisa membaca dokumen ini dari atas ke bawah dan langsung membangun tema tanpa perlu bertanya banyak hal.

---

## Daftar Isi

1. [Filosofi & Prinsip Desain](#1-filosofi--prinsip-desain)
2. [Design Tokens](#2-design-tokens)
3. [Tipografi](#3-tipografi)
4. [Warna](#4-warna)
5. [Setup Teknis (Tailwind + Laravel)](#5-setup-teknis)
6. [Konvensi Penamaan Komponen](#6-konvensi-penamaan-komponen)
7. [Katalog Komponen](#7-katalog-komponen)
8. [Tabel (Varian & Ukuran)](#8-tabel)
9. [Halaman Ready-to-Use](#9-halaman-ready-to-use)
10. [Varian Layout Dashboard](#10-varian-layout-dashboard)
11. [Micro-interactions](#11-micro-interactions)
12. [Responsive Rules](#12-responsive-rules)
13. [Ikon](#13-ikon)
14. [Kompatibilitas Browser Lama & Performa](#14-kompatibilitas--performa)
15. [Struktur Folder](#15-struktur-folder)
16. [Roadmap Eksekusi](#16-roadmap-eksekusi)
17. [Definition of Done](#17-definition-of-done)

---

## 1. Filosofi & Prinsip Desain

Aplikasi keuangan = **kepercayaan + ketelitian + waktu layar yang lama**. Semua keputusan desain diturunkan dari 4 prinsip:

| Prinsip | Artinya dalam praktik |
|---|---|
| **Clarity first** | Angka dan status selalu paling menonjol. Dekorasi tidak boleh bersaing dengan data. Satu layar = satu tujuan utama. |
| **Calm for long sessions** | Background tidak pernah putih murni (`#FFFFFF`), kontras cukup tapi tidak menyilaukan, warna semantik (hijau/merah) versi *muted*. |
| **Angka adalah bintang utama** | Semua angka finansial memakai `tabular-nums` agar rata kolom, dengan font yang tegas tapi tetap humanis. |
| **Boring is a feature** | Micro-interaction hanya untuk *feedback* (hover, loading, sukses), bukan untuk pamer. Maksimal durasi animasi 200ms. |

**Aturan emas untuk yang mengeksekusi:** kalau ragu antara "lebih cantik" atau "lebih jelas" → pilih **lebih jelas**.

---

## 2. Design Tokens

Semua nilai visual **wajib** didefinisikan sebagai CSS Custom Properties (variabel), lalu dipetakan ke Tailwind. Tujuannya: saat brand guideline klien datang nanti, kita hanya mengubah **satu file** (`tokens.css`) tanpa menyentuh komponen.

```css
/* resources/css/tokens.css */
:root {
  /* ===== BRAND (satu-satunya bagian yang diubah saat rebranding) ===== */
  --color-brand-50:  #EEF6F5;
  --color-brand-100: #D5EAE7;
  --color-brand-300: #7FBFB8;
  --color-brand-500: #2E7D74;   /* primary — teal tenang, kesan "trust" */
  --color-brand-600: #256A62;
  --color-brand-700: #1D554E;
  --color-brand-900: #10312D;

  /* ===== NEUTRAL (permukaan & teks) ===== */
  --color-surface:      #F6F7F9;  /* background utama, BUKAN putih murni */
  --color-surface-card: #FFFFFF;  /* kartu boleh putih karena area kecil */
  --color-surface-sunken: #EEF0F3;/* area input / zebra table */
  --color-border:       #E2E5EA;
  --color-border-strong:#C9CED6;
  --color-text-primary:  #1C2430; /* bukan hitam pekat — lebih nyaman */
  --color-text-secondary:#5A6472;
  --color-text-muted:    #8B94A3;

  /* ===== SEMANTIC (versi muted, bukan neon) ===== */
  --color-positive: #2F8A56;  --color-positive-bg: #E9F5EE;
  --color-negative: #C24A4A;  --color-negative-bg: #FBEEEE;
  --color-warning:  #B07A2A;  --color-warning-bg:  #FBF3E4;
  --color-info:     #3C6EAF;  --color-info-bg:     #EBF2FA;

  /* ===== SPACING & SHAPE ===== */
  --radius-sm: 6px;
  --radius-md: 10px;
  --radius-lg: 14px;
  --shadow-card: 0 1px 2px rgba(16,24,40,.05), 0 1px 3px rgba(16,24,40,.08);
  --shadow-modal: 0 8px 24px rgba(16,24,40,.16);

  /* ===== MOTION ===== */
  --ease-standard: cubic-bezier(.2,.6,.3,1);
  --duration-fast: 120ms;
  --duration-base: 180ms;
}

/* Dark mode disiapkan sejak awal (opsional diaktifkan) */
[data-theme="dark"] {
  --color-surface:      #14181F;
  --color-surface-card: #1B212B;
  --color-surface-sunken:#10141A;
  --color-border:       #2A3240;
  --color-text-primary: #E8ECF1;
  --color-text-secondary:#A6B0BE;
}
```

> ⚠️ **Larangan:** komponen tidak boleh memakai nilai hex langsung. Selalu lewat token / class Tailwind yang sudah dipetakan.

---

## 3. Tipografi

### Pilihan font (semua gratis, Google Fonts, bisa self-host)

| Peran | Font | Alasan |
|---|---|---|
| **Heading / Display** | **Plus Jakarta Sans** (600, 700) | Tegas, geometris, tapi sudutnya ramah — tidak kaku. Bonus: karya desainer Indonesia. |
| **Body / UI** | **Inter** (400, 500, 600) | Standar emas untuk keterbacaan UI di ukuran kecil. |
| **Angka finansial** | **Inter + `font-variant-numeric: tabular-nums`** | Semua digit berlebar sama → kolom angka rata sempurna, terlihat tegas tanpa perlu font monospace yang kaku. |

```css
/* utility wajib untuk semua angka uang/persentase */
.u-num {
  font-variant-numeric: tabular-nums lining-nums;
  font-feature-settings: "tnum" 1, "lnum" 1; /* fallback browser lama */
  letter-spacing: -0.01em;
}
```

### Skala tipe (rem, base 16px)

| Token | Ukuran | Pemakaian |
|---|---|---|
| `text-display` | 2.25rem / 700 | Angka besar di stat card, hero |
| `text-h1` | 1.5rem / 700 | Judul halaman |
| `text-h2` | 1.25rem / 600 | Judul section/card |
| `text-body` | 0.9375rem / 400 | Teks default (15px — nyaman untuk screentime lama) |
| `text-sm` | 0.8125rem / 400 | Meta, helper text |
| `text-xs` | 0.75rem / 500 | Label, badge, header tabel (uppercase + tracking-wide) |

**Aturan:** heading tidak pernah lebih dari 2 level dalam satu card. Line-height body minimal `1.6`.

---

## 4. Warna

### Rasio pemakaian: **80 / 15 / 5**
- **80%** — neutral (surface, border, teks)
- **15%** — brand teal (tombol utama, link, item menu aktif, chart utama)
- **5%** — semantik (hijau/merah/kuning) **hanya** untuk makna finansial

### Aturan semantik keuangan (tidak boleh dilanggar)
1. **Hijau = uang masuk / naik**, **Merah = uang keluar / turun**. Jangan pernah dibalik atau dipakai untuk hal dekoratif.
2. Warna semantik tidak boleh jadi warna teks tunggal penyampai informasi — selalu dampingi dengan ikon panah (↑/↓) atau tanda +/− (aksesibilitas & buta warna).
3. Kontras teks minimal **WCAG AA (4.5:1)** untuk body, 3:1 untuk teks besar. Semua token di atas sudah lolos.

---

## 5. Setup Teknis

### Versi & alasan
- **Tailwind CSS v3.4** — ❗ *bukan v4*. Tailwind v4 memakai `oklch()` dan `@property` yang gagal di browser lama. v3.4 menghasilkan hex/rgb biasa.
- **PostCSS + Autoprefixer** dengan target browser di bawah.
- **Tanpa framework JS wajib.** Interaksi ringan pakai **Alpine.js** (15KB, resmi didukung ekosistem Laravel) — tapi setiap komponen harus punya fallback "tetap terbaca tanpa JS".

```json
// package.json → browserslist (kunci kompatibilitas browser lama)
"browserslist": [
  "> 0.3%",
  "last 4 versions",
  "Chrome >= 70",
  "Firefox >= 68",
  "Safari >= 12",
  "Edge >= 79",
  "not dead"
]
```

### tailwind.config.js — memetakan token

```js
/** tailwind.config.js */
module.exports = {
  content: ["./resources/**/*.blade.php", "./resources/**/*.js"],
  darkMode: ["selector", '[data-theme="dark"]'],
  theme: {
    extend: {
      colors: {
        brand: {
          50:"var(--color-brand-50)", 100:"var(--color-brand-100)",
          300:"var(--color-brand-300)", 500:"var(--color-brand-500)",
          600:"var(--color-brand-600)", 700:"var(--color-brand-700)",
          900:"var(--color-brand-900)",
        },
        surface: {
          DEFAULT:"var(--color-surface)",
          card:"var(--color-surface-card)",
          sunken:"var(--color-surface-sunken)",
        },
        line: {
          DEFAULT:"var(--color-border)",
          strong:"var(--color-border-strong)",
        },
        ink: {
          DEFAULT:"var(--color-text-primary)",
          soft:"var(--color-text-secondary)",
          muted:"var(--color-text-muted)",
        },
        positive:{ DEFAULT:"var(--color-positive)", bg:"var(--color-positive-bg)" },
        negative:{ DEFAULT:"var(--color-negative)", bg:"var(--color-negative-bg)" },
        warning: { DEFAULT:"var(--color-warning)",  bg:"var(--color-warning-bg)" },
        info:    { DEFAULT:"var(--color-info)",     bg:"var(--color-info-bg)" },
      },
      fontFamily: {
        display: ['"Plus Jakarta Sans"', "Inter", "system-ui", "sans-serif"],
        sans: ["Inter", "system-ui", "-apple-system", "sans-serif"],
      },
      borderRadius: {
        sm:"var(--radius-sm)", md:"var(--radius-md)", lg:"var(--radius-lg)",
      },
      boxShadow: {
        card:"var(--shadow-card)", modal:"var(--shadow-modal)",
      },
    },
  },
  plugins: [require("@tailwindcss/forms")],
};
```

### Aturan Laravel (WAJIB)
1. **Tanpa inline PHP di view.** Semua logika di controller/component class. View hanya menerima data.
2. Semua komponen UI = **Blade Component** (`<x-ui.button>`, `<x-ui.card>` …). Bukan `@include` dengan variabel bebas.
3. Class Tailwind yang berulang > 3x dan panjang → ekstrak jadi class komponen di `components.css` pakai `@apply` (best practice CSS, bukan copy-paste utility di mana-mana).

```blade
{{-- ❌ SALAH --}}
<button class="px-4 py-2 bg-teal-600 ..."><?php echo $label; ?></button>

{{-- ✅ BENAR --}}
<x-ui.button variant="primary" size="md">{{ $label }}</x-ui.button>
```

---

## 6. Konvensi Penamaan Komponen

Pola: **`c-[komponen]`** untuk class CSS terekstrak, **`x-ui.[komponen]`** untuk Blade, modifier via prop.

| Layer | Contoh | Aturan |
|---|---|---|
| Blade component | `<x-ui.button>`, `<x-ui.table.row>` | Nama = kata benda tunggal, bahasa Inggris, huruf kecil, sub-komponen pakai titik. |
| CSS class (extracted) | `.c-btn`, `.c-btn--primary`, `.c-card__header` | BEM ringan: `c-` prefix, `--` modifier, `__` element. |
| State | `.is-active`, `.is-loading`, `.is-invalid` | Prefix `is-`, di-toggle oleh JS/Alpine. |
| Utility custom | `.u-num`, `.u-truncate-2` | Prefix `u-`. |
| JS hook | `data-js="modal-trigger"` | JS **tidak boleh** menarget class styling. |

Kenapa begini: junior/AI agent bisa langsung tahu fungsi sebuah class hanya dari prefiksnya, dan styling tidak pecah saat JS di-refactor.

---

## 7. Katalog Komponen

Setiap komponen dibangun dengan **kontrak prop yang seragam**: `variant`, `size`, dan `attributes` diteruskan (`{{ $attributes }}`).

### 7.1 Button — `<x-ui.button>`
| Prop | Nilai |
|---|---|
| `variant` | `primary` (brand-600, teks putih) · `secondary` (surface-card + border) · `ghost` (transparan) · `danger` (negative) · `link` |
| `size` | `sm` (h-8, text-xs) · `md` (h-10, text-sm) — default · `lg` (h-12, text-body) |
| `icon` / `iconRight` | nama ikon (opsional) |
| `loading` | boolean → spinner + disabled |

Detail wajib: `focus-visible:ring-2 ring-brand-300`, `disabled:opacity-50`, transisi `background var(--duration-fast)`.

### 7.2 Card — `<x-ui.card>`
- Slot: `header` (judul + action), `default` (body), `footer`.
- Varian: `default` (shadow-card) · `flat` (border saja, untuk area padat) · `stat` (khusus KPI).
- **Stat card** (komponen khas finance): label kecil di atas, angka besar `.u-num font-display`, delta di bawah dengan `<x-ui.trend>` (badge hijau/merah + panah).

### 7.3 Modal — `<x-ui.modal>`
- Ukuran: `sm` (400px) · `md` (560px) · `lg` (760px) · `full` (mobile: full-screen otomatis).
- Alpine: `x-data="{ open: false }"`, tutup via ESC, klik overlay, dan tombol ✕.
- Fokus terkunci di dalam modal (focus trap sederhana), `role="dialog" aria-modal="true"`.
- Varian khusus: `confirm` (aksi destruktif → tombol danger di kanan).

### 7.4 Form controls
`<x-ui.input>`, `<x-ui.select>`, `<x-ui.textarea>`, `<x-ui.checkbox>`, `<x-ui.radio>`, `<x-ui.toggle>`
- Ukuran: `sm` / `md` / `lg` (tinggi sama dengan button agar sejajar).
- Struktur wajib: label di atas → input → helper/error di bawah. Error = border negative + teks + ikon (bukan warna saja).
- Varian khas finance: `<x-ui.input-money>` — prefix mata uang (Rp), auto `tabular-nums`, rata kanan.

### 7.5 Badge & Status — `<x-ui.badge>`
- Varian semantik: `positive` (Lunas/Berhasil), `negative` (Gagal/Jatuh tempo), `warning` (Pending), `info`, `neutral`.
- Selalu: bg muted + teks pekat + dot/ikon kecil. Ukuran `sm`/`md`.

### 7.6 Carousel — `<x-ui.carousel>`
- Basis: **CSS scroll-snap** (`scroll-snap-type: x mandatory`) → jalan tanpa JS, ringan, aman di browser lama.
- JS (Alpine) hanya menambah tombol prev/next dan dot indicator (progressive enhancement).
- Pemakaian: testimonial landing page, slider kartu promo, onboarding.

### 7.7 Komponen lain (daftar build)
| Komponen | Catatan singkat |
|---|---|
| `<x-ui.alert>` | 4 varian semantik, bisa dismiss |
| `<x-ui.toast>` | pojok kanan-bawah, auto-hide 4s, max 3 antrian |
| `<x-ui.dropdown>` | Alpine, untuk menu aksi & user menu |
| `<x-ui.tabs>` | underline style, roving tabindex |
| `<x-ui.breadcrumb>` | otomatis dari array |
| `<x-ui.pagination>` | server-side friendly (Laravel paginator) |
| `<x-ui.avatar>` | ukuran xs–lg, fallback inisial |
| `<x-ui.tooltip>` | CSS-only (hover/focus), tanpa JS |
| `<x-ui.skeleton>` | shimmer halus untuk loading data |
| `<x-ui.empty-state>` | ikon + judul + 1 kalimat + 1 CTA |
| `<x-ui.progress>` | bar & ring (untuk budget usage) |
| `<x-ui.stepper>` | untuk wizard sign-up / KYC |

---

## 8. Tabel

Tabel adalah komponen paling penting di aplikasi keuangan — dapat bab sendiri.

### Struktur Blade
```
<x-ui.table :variant :size :sticky>
  <x-ui.table.head> … </x-ui.table.head>
  <x-ui.table.row>
    <x-ui.table.cell> … </x-ui.table.cell>
    <x-ui.table.cell type="number"> … </x-ui.table.cell>
  </x-ui.table.row>
</x-ui.table>
```

### Aturan baku (berlaku di semua varian)
1. **Kolom angka selalu rata kanan + `.u-num`**. Kolom teks rata kiri. Tidak ada rata tengah kecuali status badge.
2. Header: `text-xs uppercase tracking-wide text-ink-muted`, background `surface-sunken`.
3. Nilai negatif: warna negative + tanda minus (contoh: `−1.250.000`), bukan tanda kurung.
4. Baris hover: `bg-surface-sunken` transisi 120ms.
5. Mobile: bungkus dengan `.c-table-wrap { overflow-x: auto }` — **jangan** sembunyikan kolom penting.

### Varian
| Varian | Ciri | Pemakaian |
|---|---|---|
| `default` | border bawah tiap baris | umum |
| `striped` | zebra `surface-sunken` | daftar panjang transaksi |
| `bordered` | grid penuh | laporan formal / export-look |
| `compact` | padding rapat | data padat (buku besar) |
| `card` | tiap baris seperti kartu (mobile-first) | daftar di layar kecil |

### Ukuran (density)
| Size | Tinggi baris | Teks |
|---|---|---|
| `sm` | 36px | text-xs |
| `md` (default) | 44px | text-sm |
| `lg` | 52px | text-body |

### Jenis (fitur komposit)
1. **Data table** — sort per kolom (ikon panah), pagination, checkbox bulk-select, kolom aksi sticky kanan.
2. **Transaction table** — kolom baku: Tanggal · Deskripsi+kategori · Status badge · Nominal (hijau/merah).
3. **Summary table** — baris `<tfoot>` total dengan `font-semibold` + border-top tebal.
4. **Sticky header table** — `position: sticky; top: 0` untuk daftar panjang (fallback: tetap normal di browser sangat lama, tidak merusak apa pun).
5. **Comparison table** — untuk halaman pricing di landing page.

---

## 9. Halaman Ready-to-Use

Setiap halaman dirakit **hanya dari komponen bab 7–8** (dogfooding — bukti design system-nya berfungsi).

### 9.1 Landing Page (`/`)
Susunan section:
1. **Navbar** — logo kiri, menu tengah, `Login` (ghost) + `Daftar` (primary) kanan. Sticky, background blur ringan *dengan fallback solid*.
2. **Hero** — headline `font-display`, subheadline, 2 CTA, dan **mock dashboard mini** (screenshot/komponen asli) sebagai bukti produk. Tanpa gradient norak.
3. **Trust bar** — logo klien/bank (grayscale).
4. **Fitur** — grid 3 kolom `<x-ui.card variant="flat">` + ikon.
5. **Angka sosial-proof** — stat card (`Rp 2,4 M dikelola`, dll.) dengan `.u-num`.
6. **Testimonial** — `<x-ui.carousel>`.
7. **Pricing** — comparison table.
8. **CTA akhir + Footer** — footer 4 kolom, background `brand-900`.

### 9.2 Login Page (`/login`)
- Layout **split**: kiri = form (max-w 400px, tengah vertikal), kanan = panel brand-900 dengan kutipan/ilustrasi (disembunyikan < `lg`).
- Isi form: email, password (dengan toggle lihat/sembunyi), checkbox "Ingat saya", link lupa password, tombol primary full-width, divider "atau", tombol SSO secondary.
- Error login → `<x-ui.alert variant="negative">` di atas form.

### 9.3 Sign Up Page (`/register`)
- Layout sama dengan login (konsistensi).
- Pakai `<x-ui.stepper>` bila butuh multi-langkah (Akun → Profil Usaha → Verifikasi).
- Indikator kekuatan password = `<x-ui.progress>`.
- Checkbox persetujuan S&K wajib sebelum tombol aktif.

### 9.4 Dashboard (`/dashboard`)
Grid 12 kolom:
1. Baris 1 — **4 stat card**: Saldo, Pemasukan bulan ini, Pengeluaran bulan ini, Tagihan jatuh tempo. Masing-masing dengan trend badge.
2. Baris 2 — **Chart utama** (8 kol) + **Ringkasan kategori** (4 kol). Chart pakai **Chart.js** (gratis, ringan, support browser lama) — warna diambil dari token.
3. Baris 3 — **Transaction table** (10 terbaru) + tombol "Lihat semua".
4. State kosong setiap widget → `<x-ui.empty-state>`. Loading → `<x-ui.skeleton>`.

---

## 10. Varian Layout Dashboard

Tiga layout, satu prinsip: **konten sama, cangkang beda**. Dibuat sebagai 3 Blade layout: `layouts/app-sidebar`, `layouts/app-topbar`, `layouts/app-mix`.

### A. Sidebar (default — untuk menu banyak)
```
┌──────┬───────────────────────────┐
│ LOGO │ header: search | 🔔 | 👤 │
│ nav  ├───────────────────────────┤
│ ...  │                           │
│      │        KONTEN             │
│ ⚙️   │                           │
└──────┴───────────────────────────┘
```
- Lebar 260px; bisa **collapse** ke 72px (ikon saja + tooltip). Preferensi disimpan (cookie/localStorage).
- Item aktif: background `brand-50` + teks `brand-700` + indikator garis kiri 3px.
- < `lg`: berubah jadi drawer (overlay) dengan tombol hamburger.

### B. Topbar (untuk menu sedikit / apl. sederhana)
- Semua navigasi horizontal di atas, konten max-w `7xl` di tengah.
- Menu overflow masuk ke dropdown "Lainnya".
- < `md`: menu masuk hamburger drawer.

### C. Mix (untuk aplikasi besar/multi-modul)
- **Topbar** = navigasi level-1 (modul: Keuangan · Laporan · Pengaturan).
- **Sidebar** = navigasi level-2 milik modul aktif.
- Sidebar berubah isi saat modul ganti; breadcrumb wajib tampil.

---

## 11. Micro-interactions

**Filosofi: setiap animasi harus menjawab pertanyaan user, bukan menghibur.** Durasi maks 200ms, easing `var(--ease-standard)`.

| Interaksi | Implementasi | Menjawab apa |
|---|---|---|
| Hover button/row | perubahan background 120ms | "ini bisa diklik" |
| Focus | ring brand-300 | "saya sedang di sini" (keyboard) |
| Tombol loading | spinner + teks "Menyimpan…" | "sistem sedang bekerja" |
| Sukses simpan | toast + ikon centang | "berhasil" |
| Angka stat berubah | count-up singkat ≤ 600ms, sekali saat load | "data baru masuk" |
| Modal buka/tutup | fade + scale 0.98→1, 180ms | orientasi spasial |
| Skeleton | shimmer pelan | "sedang memuat, bukan rusak" |
| Input error | teks error muncul + border merah (tanpa shake berlebihan) | "ada yang perlu diperbaiki" |

**Dilarang:** parallax, animasi scroll berlebihan, hover yang menggeser layout, animasi looping tanpa henti, konfeti.

**Wajib:** hormati preferensi aksesibilitas:
```css
@media (prefers-reduced-motion: reduce) {
  *, *::before, *::after { animation-duration: .01ms !important; transition-duration: .01ms !important; }
}
```

---

## 12. Responsive Rules

Breakpoint Tailwind standar. Pendekatan **mobile-first**.

| Breakpoint | Perilaku kunci |
|---|---|
| `< sm` (mobile) | Stat card jadi 1 kolom, tabel → varian `card` atau scroll-x, sidebar → drawer, modal → full-screen, tombol utama full-width. |
| `sm–md` (tablet) | Stat card 2 kolom, form 1 kolom. |
| `lg` | Sidebar muncul, grid dashboard 12 kolom aktif, layout split login tampil. |
| `xl+` | Konten dibatasi `max-w-screen-2xl` di tengah — jangan biarkan tabel melebar tak terbaca di monitor lebar. |

Target sentuh minimal **44×44px** untuk semua elemen interaktif di mobile.

---

## 13. Ikon

- **Pilihan: [Tabler Icons](https://tabler.io/icons)** — gratis (MIT), 5.000+ ikon, stroke konsisten 2px, banyak ikon finance (wallet, invoice, cash, chart).
- Alternatif setara bila diperlukan: Lucide (MIT).
- **Cara pakai: inline SVG via Blade component** `<x-ui.icon name="wallet" size="20" />` — bukan icon-font (berat, buruk untuk aksesibilitas) dan bukan CDN (limit koneksi internet biasa).
- SVG memakai `stroke="currentColor"` → warna otomatis ikut teks/token.
- Ukuran baku: `16` (dalam badge/input) · `20` (default, tombol & menu) · `24` (empty state, header).

---

## 14. Kompatibilitas & Performa

Konteks: **browser lama + koneksi internet biasa** → anggaran performa ketat.

### Aturan kompatibilitas
| Boleh | Hindari / beri fallback |
|---|---|
| Flexbox, CSS Grid dasar | `subgrid`, `container queries`, `:has()` |
| CSS variables (Chrome 49+, aman) | `oklch()`, `color-mix()` |
| `position: sticky` (dengan fallback normal) | `backdrop-filter` tanpa fallback solid |
| scroll-snap | Web Animations API |
| Alpine.js v3 (ES6) | fitur ES2020+ tanpa build/transpile |

### Anggaran performa (hard limit)
| Aset | Budget |
|---|---|
| CSS (purged + minified + gzip) | ≤ 30 KB |
| JS total (Alpine + custom) | ≤ 45 KB |
| Font (2 keluarga, subset latin, `woff2`, self-host) | ≤ 120 KB |
| Halaman dashboard total first-load | ≤ 300 KB |
| Gambar landing | WebP + fallback JPEG, `loading="lazy"` |

### Praktik wajib
1. **Self-host semua aset** (font, ikon, Alpine, Chart.js) — jangan bergantung CDN eksternal.
2. `font-display: swap` agar teks langsung tampil di koneksi lambat.
3. Chart.js hanya dimuat di halaman yang punya chart (per-page bundle).
4. Semua halaman harus **tetap fungsional tanpa JavaScript** (form submit biasa, tabel terbaca, navigasi jalan). JS = enhancement.

---

## 15. Struktur Folder

```
resources/
├── css/
│   ├── app.css            # entry: import tokens → base → components
│   ├── tokens.css         # SEMUA design token (satu-satunya file rebrand)
│   └── components.css     # class .c-* hasil @apply
├── js/
│   ├── app.js             # Alpine init + register komponen
│   └── modules/           # chart.js loader, dsb (per halaman)
├── views/
│   ├── layouts/
│   │   ├── guest.blade.php        # landing, login, register
│   │   ├── app-sidebar.blade.php
│   │   ├── app-topbar.blade.php
│   │   └── app-mix.blade.php
│   ├── components/ui/     # SEMUA komponen bab 7–8
│   │   ├── button.blade.php
│   │   ├── card.blade.php
│   │   ├── modal.blade.php
│   │   ├── icon.blade.php
│   │   └── table/ (index, head, row, cell)
│   └── pages/
│       ├── landing.blade.php
│       ├── auth/ (login, register)
│       └── dashboard/index.blade.php
└── svg/icons/             # subset Tabler yang dipakai saja
```

---

## 16. Roadmap Eksekusi

Kerjakan **berurutan** — tiap fase punya output yang bisa direview.

| Fase | Output | Estimasi |
|---|---|---|
| **1. Fondasi** | `tokens.css`, `tailwind.config.js`, setup font & ikon, halaman *styleguide* internal (`/styleguide`) yang menampilkan token | 1–2 hari |
| **2. Komponen inti** | button, input+form, card, badge, icon, alert | 2–3 hari |
| **3. Komponen kompleks** | table (semua varian), modal, dropdown, tabs, pagination, toast, skeleton, carousel | 3–4 hari |
| **4. Layout** | 3 varian shell dashboard + navbar/footer guest | 2 hari |
| **5. Halaman** | landing, login, register, dashboard (rakit dari komponen) | 3 hari |
| **6. QA** | uji responsive, browser lama, koneksi lambat (throttling), keyboard-only, purge CSS, cek budget performa | 2 hari |

> Halaman `/styleguide` bersifat permanen: setiap komponen baru wajib didemokan di sana lengkap dengan semua varian & ukurannya. Ini dokumentasi hidup untuk developer berikutnya.

---

## 17. Definition of Done

Sebuah komponen/halaman dianggap **selesai** jika lolos checklist ini:

- [ ] Hanya memakai token (tidak ada hex/hardcode nilai).
- [ ] Punya semua varian & ukuran yang didefinisikan di dokumen ini.
- [ ] Terdaftar dan terdemo di `/styleguide`.
- [ ] Tidak ada inline PHP di Blade; logika di class component/controller.
- [ ] Responsive di 360px, 768px, 1280px, 1920px.
- [ ] Bisa dioperasikan penuh dengan keyboard; focus terlihat.
- [ ] Kontras warna lolos WCAG AA.
- [ ] Angka finansial memakai `.u-num` dan rata kanan.
- [ ] Berfungsi (minimal terbaca & tersubmit) saat JavaScript mati.
- [ ] Menghormati `prefers-reduced-motion`.
- [ ] Lolos budget performa bab 14.

---

*Versi 1.0 — dokumen ini adalah sumber kebenaran tunggal (single source of truth). Perubahan token/aturan harus diperbarui di sini terlebih dahulu sebelum diimplementasikan.*
