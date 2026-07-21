# Fase 1 — Fondasi

> Sumber: `CLAUDE.md` § Roadmap Eksekusi → Fase 1
> Perintah pemicu: `Kerjakan Fase 1`

## Deskripsi

Membangun fondasi teknis project Ledgerly UI: dependencies, design tokens, konfigurasi Tailwind/PostCSS, base styles, aset font & ikon self-hosted, serta halaman `/styleguide` awal sebagai bukti bahwa seluruh token termanifestasi dengan benar.

Belum ada scaffolding Laravel di repo ini — task ini mencakup setup awal sebelum lanjut ke Fase 2 (Komponen Inti).

## Task List

- [ ] **1. Install dependencies**
  `tailwindcss@3.4`, `postcss`, `autoprefixer`, `@tailwindcss/forms`, `alpinejs`
  ⚠️ Jangan install Tailwind v4.

- [ ] **2. `resources/css/tokens.css`**
  Semua CSS custom properties (warna brand, neutral, semantic, spacing, radius, shadow, motion) sesuai DESIGN_SYSTEM.md bab 2.

- [ ] **3. `tailwind.config.js`**
  Mapping token → Tailwind theme sesuai DESIGN_SYSTEM.md bab 5.

- [ ] **4. `postcss.config.js`**
  Autoprefixer + browserslist:
  `> 0.3%, last 4 versions, Chrome >= 70, Firefox >= 68, Safari >= 12, Edge >= 79, not dead`

- [ ] **5. `resources/css/base.css`**
  Reset minimal, `@font-face` self-host, class `.u-num` (tabular-nums, lining-nums, rata kanan), `prefers-reduced-motion`.

- [ ] **6. `resources/css/app.css`**
  Entry point, urutan import: `tokens.css` → `base.css` → `components.css`.

- [ ] **7. `resources/css/components.css`**
  Buat file kosong, siap diisi di Fase 2.

- [ ] **8. Font self-host**
  Download Plus Jakarta Sans (600, 700) dan Inter (400, 500, 600), simpan sebagai `.woff2` di `public/fonts/`.

- [ ] **9. Ikon Tabler**
  Download subset Tabler Icons yang dipakai ke `resources/svg/icons/` (inline SVG, bukan icon-font).

- [ ] **10. `<x-ui.icon>` component**
  `resources/views/components/ui/icon.blade.php` — render inline SVG dari `resources/svg/icons/`.

- [ ] **11. Halaman `/styleguide`**
  Layout sederhana menampilkan: palet warna, skala tipografi, token spacing, contoh ikon.

- [ ] **12. Verifikasi build**
  `vite.config.js` benar, `npm run build` sukses tanpa error.

## Referensi Desain

- DESIGN_SYSTEM.md **bab 2** — Design Tokens (warna, spacing, shadow, motion)
- DESIGN_SYSTEM.md **bab 3** — Font & skala tipe
- DESIGN_SYSTEM.md **bab 5** — Setup Teknis (Tailwind + Laravel)
- DESIGN_SYSTEM.md **bab 13** — Ikon
- DESIGN_SYSTEM.md **bab 15** — Struktur Folder

## Aturan yang Berlaku (dari CLAUDE.md)

- Tidak boleh hardcode warna/ukuran/radius/shadow — selalu lewat token.
- Tidak boleh pakai CDN eksternal (font, ikon, JS) — self-host semua.
- Tailwind v3.4, **bukan** v4 (v4 pakai `oklch()`/`@property` yang tidak didukung browser target).
- Hormati `prefers-reduced-motion`.

## Definition of Done

- [ ] Buka `/styleguide` di browser → semua token (warna, tipografi, spacing, ikon) terdemo rapi.
- [ ] Tidak ada error di console.
- [ ] `npm run build` sukses.
