# Fase 6 — QA & Polish

> Sumber: `CLAUDE.md` § Roadmap Eksekusi → Fase 6
> Perintah pemicu: `Kerjakan Fase 6`
> Prasyarat: Fase 1 (#1, PR #2), Fase 2 (#3, PR #4), Fase 3 (#5, PR #6), Fase 4 (#7, PR #8), Fase 5 (#9, PR #10) selesai — token, seluruh komponen dasar & kompleks, keempat layout, dan keempat halaman (`/`, `/login`, `/register`, `/dashboard`) sudah ada dan berfungsi.

## Deskripsi

Fase terakhir sebelum project dianggap production-ready: audit menyeluruh terhadap semua yang sudah dibangun di Fase 1–5 (bukan menambah fitur baru), lalu perbaiki setiap temuan. Cakupannya: responsive di 6 breakpoint, navigasi keyboard-only, halaman tanpa JavaScript, budget performa (CSS/JS/font), kontras warna WCAG AA, `prefers-reduced-motion`, serta audit kode untuk hex hardcode dan inline PHP. Referensi kelulusan: checklist Definition of Done di `design-system-finance.md` bab 17.

## Baseline Saat Ini (hasil pengecekan awal, per 2026-07-22)

Supaya tidak perlu diverifikasi ulang dari nol — ini kondisi terukur sebelum Fase 6 dimulai:

- **CSS**: `app-*.css` 10.81 KB gzip (budget ≤ 30 KB) — **lolos dengan margin besar**.
- **JS inti** (`app.js` — Alpine + custom directives): 34.29 KB gzip (budget ≤ 40 KB) — **lolos, tapi mepet** (~85% dari budget). Jangan tambah dependency baru ke `app.js` tanpa cek ulang angka ini.
- **JS Chart.js** (`chart-loader.js`, lazy, hanya di `/dashboard`): 53.24 KB gzip — **melebihi 40 KB jika dihitung gabung dengan app.js**, tapi `design-system-finance.md` bab 14 secara eksplisit mengizinkan Chart.js sebagai *per-page bundle* terpisah ("Chart.js hanya dimuat di halaman yang punya chart"). **Task eksplisit di fase ini**: putuskan dan dokumentasikan apakah budget "JS total ≤ 40 KB" dimaksud hanya untuk `app.js`, atau harus dihitung per-halaman termasuk chart. Cek juga angka "halaman dashboard total first-load ≤ 300 KB" (app.css + app.js + chart-loader.js gzip ≈ 98 KB — harusnya masih lolos, tapi verifikasi dengan devtools network tab sungguhan termasuk HTML+font).
- **Font**: 5 file woff2 (Inter 400/500/600, Plus Jakarta Sans 600/700) = 96 KB total (budget ≤ 120 KB) — **lolos**.
- **Hex/rgb hardcode**: tidak ditemukan di `resources/views/**/*.blade.php` (sudah di-grep, bersih).
- **Inline PHP**: tidak ada `<?php` di Blade manapun. Satu penggunaan `{!! !!}` di `components/ui/icon.blade.php` — ini legitimate (merender SVG path dari file lokal terpercaya di `resources/svg/icons/`, bukan input user), bukan pelanggaran.
- **`prefers-reduced-motion`**: sudah ada guard global di `resources/css/base.css` dan secara eksplisit dihormati di `resources/js/modules/chart-loader.js` (animasi chart dimatikan bila preferensi aktif). Belum diverifikasi manual dengan OS setting aktif.
- **`focus-visible`**: 9 kelas komponen di `components.css` sudah punya ring eksplisit (button, input, checkbox, dsb). Link biasa (navbar/footer/sidebar-nav) mengandalkan outline default browser — **belum diverifikasi visual** apakah cukup terlihat di semua tempat.

Yang **belum** diverifikasi sama sekali dan jadi fokus utama fase ini: responsive visual di 6 breakpoint untuk 4 halaman baru dari Fase 5 (terutama setelah 3 fix mobile yang sudah masuk — hamburger drawer, hero overflow, stat card font), keyboard-only navigation end-to-end, matikan JS lalu coba semua form, kontras warna aktual (bukan cuma baca token), dan load time di throttled 3G.

## Task List

- [ ] **1. Test responsive 6 breakpoint** (360px, 390px, 768px, 1024px, 1280px, 1920px)
  Semua 8 halaman: `/`, `/login`, `/register`, `/dashboard`, `/styleguide`, dan 4 preview layout (`/styleguide/layouts/*`). Fokus khusus: hero landing (baru saja diperbaiki dari overflow horizontal), stat card di hero & dashboard (baru saja diperbaiki font-nya), sidebar drawer & topbar drawer di breakpoint `< lg`/`< md`, tabel yang mestinya scroll-x sendiri (bukan mendorong halaman).

- [ ] **2. Test keyboard-only navigation**
  Tab melalui semua elemen interaktif di tiap halaman (termasuk form login/register, modal & dropdown demo di `/styleguide`, carousel testimonial, password show/hide toggle). Pastikan focus ring selalu terlihat, urutan tab logis, tidak ada focus trap yang salah (modal sudah punya `x-focus-trap` — cek ESC & klik overlay juga masih jalan).

- [ ] **3. Test tanpa JavaScript**
  Disable JS di browser, buka tiap halaman: navigasi (`<a href>`) harus bisa diklik, tabel harus terbaca, form login/register harus bisa submit (sudah ada POST route dummy yang redirect ke `/dashboard` — pastikan itu masih berfungsi), checkbox S&K di register tetap mem-block submit lewat native `required` (bukan JS).

- [ ] **4. Ukuran CSS akhir**
  `npx tailwindcss --minify` atau `npm run build`, konfirmasi ulang CSS ≤ 30 KB gzip (baseline: 10.81 KB — cek tidak naik signifikan setelah fix apapun di fase ini).

- [ ] **5. Ukuran JS total**
  Putuskan interpretasi budget "≤ 40 KB" untuk Chart.js per catatan di bagian Baseline di atas, lalu dokumentasikan keputusannya (di PR description atau komentar di kode). Jika keputusannya chart.js harus lebih kecil, evaluasi alternatif: kurangi modul Chart.js yang di-register, atau chart alternatif yang lebih ringan.

- [ ] **6. Ukuran font**
  Konfirmasi ulang total ≤ 120 KB (baseline: 96 KB, sudah lolos — cukup re-check kalau ada perubahan font).

- [ ] **7. Audit kontras warna**
  Semua kombinasi teks/background lolos WCAG AA (4.5:1 body text, 3:1 large text) — cek khususnya: `text-ink-muted`/`text-ink-soft` di atas `bg-surface`/`bg-surface-card`, teks `brand-100`/`brand-300` di atas `bg-brand-900` (footer, CTA banner, auth aside), warna semantic (`positive`/`negative`/`warning`/`info`) di atas `*-bg` masing-masing. Pakai devtools contrast checker atau axe DevTools.

- [ ] **8. Verifikasi `prefers-reduced-motion`**
  Aktifkan setting di OS/browser, cek semua transisi (modal, dropdown, carousel, sidebar collapse, drawer, toast, chart) benar-benar mengabaikan animasi — bukan cuma dipercepat.

- [ ] **9. Re-audit hex/rgb hardcode & inline PHP**
  Baseline sudah bersih (lihat bagian Baseline) — jalankan ulang grep setelah semua fix di fase ini untuk pastikan tidak ada regresi.

- [ ] **10. Load time di simulasi 3G**
  Chrome DevTools Network throttling "Slow 3G"/"Fast 3G", target < 3 detik untuk tiap halaman. `/dashboard` paling berat (Chart.js) — jadi prioritas pengujian.

- [ ] **11. Fix semua temuan**
  Setiap temuan dari task 1–10 diperbaiki di branch yang sama sebelum PR dibuka.

## Referensi Desain

- `design-system-finance.md` **bab 11** — Micro-interactions (aturan durasi ≤200ms & `prefers-reduced-motion`)
- `design-system-finance.md` **bab 12** — Responsive Rules (breakpoint & perilaku per breakpoint)
- `design-system-finance.md` **bab 14** — Kompatibilitas & Performa (budget performa, hard limit)
- `design-system-finance.md` **bab 17** — Definition of Done (checklist kelulusan final)

## Aturan yang Berlaku (dari CLAUDE.md)

- Fase ini murni audit + fix, bukan fitur baru — jangan menambah komponen atau halaman baru.
- Semua fix tetap harus mengikuti aturan absolut CLAUDE.md (token only, `x-ui.*` component, `data-js` untuk JS hook, dsb.) — tidak ada pengecualian untuk "quick fix".
- Kalau ada temuan yang butuh keputusan desain (misal budget Chart.js di task 5), dokumentasikan keputusan & alasannya, jangan diam-diam diabaikan.

## Definition of Done

- [ ] Semua 12 checklist di `design-system-finance.md` bab 17 terpenuhi untuk seluruh komponen & halaman.
- [ ] Responsive terverifikasi di 360px, 390px, 768px, 1024px, 1280px, 1920px — tanpa scroll horizontal yang tidak disengaja di manapun.
- [ ] Navigasi keyboard-only berfungsi penuh, focus selalu terlihat.
- [ ] Semua halaman fungsional (baca + submit) dengan JavaScript mati.
- [ ] CSS ≤ 30 KB gzip, font ≤ 120 KB total, keputusan budget JS (termasuk Chart.js) didokumentasikan dan dipatuhi.
- [ ] Kontras warna lolos WCAG AA di semua kombinasi teks/background yang dipakai.
- [ ] `prefers-reduced-motion` dihormati di semua animasi/transisi.
- [ ] Tidak ada hex/rgb hardcode atau inline PHP di Blade manapun.
- [ ] Semua halaman load < 3 detik di simulasi 3G.
- [ ] Laporan ringkas QA (apa yang dites, apa yang ditemukan, apa yang di-fix) tersedia di PR description.
