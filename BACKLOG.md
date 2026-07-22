# BACKLOG.md — Post-MVP 1

> Fase 1–6 sudah selesai. File ini berisi sisa pekerjaan.
> Aturan teknis tetap mengacu `CLAUDE.md`. Detail visual tetap mengacu `DESIGN_SYSTEM.md`.
> Baca file-file itu HANYA jika butuh detail spesifik — jangan baca ulang seluruhnya.

---

## Status MVP 1 (selesai)

✅ Fondasi (token, config, font, ikon)
✅ Komponen inti (button, input, card, badge, alert, dsb)
✅ Komponen kompleks (table, modal, dropdown, tabs, dsb)
✅ 3 varian layout dashboard
✅ 4 halaman (landing, login, register, dashboard)
✅ Halaman /styleguide
✅ Responsive
✅ QA dasar

---

## Hutang Teknis — Animasi & Interaksi JS

Yang belum diimplementasi dari DESIGN_SYSTEM.md bab 11:

### Prioritas 1 (harus ada, UX terasa cacat tanpa ini)
| ID | Fitur | Komponen | Detail |
|---|---|---|---|
| A1 | Toast auto-hide + antrian | `<x-ui.toast>` | Muncul pojok kanan bawah, hilang setelah 4s, max 3 stack. Alpine. |
| A2 | Modal transisi buka/tutup | `<x-ui.modal>` | Fade + scale 0.98→1, 180ms, `var(--ease-standard)`. Focus trap. |
| A3 | Dropdown posisi & tutup otomatis | `<x-ui.dropdown>` | Klik luar = tutup. ESC = tutup. Posisi flip jika mepet bawah viewport. |
| A4 | Sidebar collapse/expand | Layout sidebar | Toggle 260px ↔ 72px. Simpan preferensi di localStorage. Drawer di mobile. |
| A5 | Tombol loading state | `<x-ui.button>` | Prop `loading` → spinner SVG kecil + teks "Menyimpan…" + disabled. |

### Prioritas 2 (nice-to-have, polish)
| ID | Fitur | Komponen | Detail |
|---|---|---|---|
| B1 | Count-up angka stat | `<x-ui.card variant="stat">` | Angka naik dari 0 ke nilai akhir, ≤600ms, sekali saat pertama tampil. Vanilla JS, IntersectionObserver. |
| B2 | Skeleton shimmer | `<x-ui.skeleton>` | CSS animation `@keyframes shimmer` gradient bergerak. Sudah ada class, butuh keyframe. |
| B3 | Carousel prev/next + dot | `<x-ui.carousel>` | Tombol navigasi + dot indicator. Basis scroll-snap sudah jalan, ini enhancement Alpine. |
| B4 | Tabs transisi panel | `<x-ui.tabs>` | Fade panel saat ganti tab, 120ms. |
| B5 | Alert dismiss animasi | `<x-ui.alert>` | Fade-out + collapse height saat ditutup, lalu `remove()`. |
| B6 | Navbar scroll-aware | `partials/navbar` | Background solid muncul saat scroll > 20px. Landing page only. |

### Aturan implementasi (ringkasan — detail lengkap di CLAUDE.md)
- Semua animasi ≤ 200ms, easing `var(--ease-standard)`
- Wajib `@media (prefers-reduced-motion: reduce)` → durasi 0
- Alpine.js untuk interaksi, vanilla JS untuk efek visual (count-up)
- Tidak boleh pakai library animasi tambahan
- Setiap item selesai → update `/styleguide`

---

## Cara Mengerjakan

Perintah ke Claude Code:

```
Kerjakan backlog A1-A5
```

atau satu per satu:

```
Kerjakan backlog A3
```

atau semua prioritas 2:

```
Kerjakan backlog B1-B6
```

Setelah selesai, pindahkan item dari tabel ke bagian "Selesai" di bawah ini.

---

## Selesai

| ID | Fitur | Tanggal |
|---|---|---|
| — | — | — |

---

## Backlog Fitur Baru (isi nanti)

Tambahkan fitur baru di sini saat muncul kebutuhan. Format sama: ID, fitur, komponen, detail.

| ID | Fitur | Komponen | Detail |
|---|---|---|---|
| C1 | — | — | — |
