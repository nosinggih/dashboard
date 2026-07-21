<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Styleguide — Ledgerly UI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface text-ink">
    <div class="mx-auto max-w-screen-2xl px-4 py-10 sm:px-6 lg:px-10">
        <header class="mb-12 border-b border-line pb-8">
            <p class="text-xs font-medium uppercase tracking-wide text-ink-muted">Ledgerly UI</p>
            <h1 class="text-h1 font-display text-ink mt-1">Styleguide</h1>
            <p class="text-body text-ink-soft mt-2 max-w-2xl">
                Dokumentasi hidup untuk semua design token dan komponen. Setiap komponen baru wajib
                didemokan di halaman ini lengkap dengan varian dan ukurannya.
            </p>
        </header>

        {{-- ===== WARNA ===== --}}
        <section class="mb-14" aria-labelledby="section-warna">
            <h2 id="section-warna" class="text-h2 font-display text-ink mb-1">Warna</h2>
            <p class="text-sm text-ink-soft mb-6">
                Rasio pemakaian 80% neutral / 15% brand / 5% semantik. Hijau = uang masuk/naik,
                merah = uang keluar/turun — tidak pernah dibalik.
            </p>

            @foreach ($colorGroups as $group)
                <div class="mb-8">
                    <h3 class="text-xs font-medium uppercase tracking-wide text-ink-muted mb-3">{{ $group['label'] }}</h3>
                    <div class="flex flex-wrap gap-4">
                        @foreach ($group['tokens'] as $token)
                            <div class="w-32">
                                <div class="{{ $token['class'] }} h-16 rounded-md border border-line shadow-card"></div>
                                <p class="text-xs text-ink mt-2 u-num">{{ $token['name'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </section>

        {{-- ===== TIPOGRAFI ===== --}}
        <section class="mb-14" aria-labelledby="section-tipografi">
            <h2 id="section-tipografi" class="text-h2 font-display text-ink mb-1">Tipografi</h2>
            <p class="text-sm text-ink-soft mb-6">
                Plus Jakarta Sans untuk heading/display, Inter untuk body &amp; UI. Line-height body
                minimal 1.6.
            </p>

            <div class="divide-y divide-line rounded-lg border border-line bg-surface-card shadow-card">
                @foreach ($typeScale as $type)
                    <div class="flex flex-col gap-1 px-6 py-5 sm:flex-row sm:items-baseline sm:justify-between">
                        <p class="{{ $type['class'] }} text-ink">{{ $type['sample'] }}</p>
                        <p class="text-xs text-ink-muted whitespace-nowrap u-num">{{ $type['token'] }} — {{ $type['meta'] }}</p>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 rounded-lg border border-line bg-surface-card p-6 shadow-card">
                <p class="text-xs uppercase tracking-wide text-ink-muted mb-2">Utility angka — <code>.u-num</code></p>
                <p class="text-display font-display u-num text-ink">Rp 47.250.000</p>
                <p class="text-sm text-ink-soft mt-1">tabular-nums, lining-nums — wajib untuk semua angka finansial.</p>
            </div>
        </section>

        {{-- ===== SPACING & SHAPE ===== --}}
        <section class="mb-14" aria-labelledby="section-spacing">
            <h2 id="section-spacing" class="text-h2 font-display text-ink mb-1">Spacing &amp; Shape</h2>
            <p class="text-sm text-ink-soft mb-6">Radius, shadow, dan token motion untuk transisi &amp; animasi.</p>

            <div class="grid grid-cols-2 gap-6 sm:grid-cols-3 lg:grid-cols-5">
                @foreach ($radiusTokens as $radius)
                    <div class="rounded-lg border border-line bg-surface-card p-4 text-center shadow-card">
                        <div class="{{ $radius['class'] }} bg-brand-100 mx-auto mb-3 h-14 w-14 border border-brand-300"></div>
                        <p class="text-xs text-ink u-num">{{ $radius['name'] }}</p>
                        <p class="text-xs text-ink-muted u-num">{{ $radius['value'] }}</p>
                    </div>
                @endforeach

                @foreach ($shadowTokens as $shadow)
                    <div class="rounded-lg border border-line bg-surface-card p-4 text-center">
                        <div class="{{ $shadow['class'] }} mx-auto mb-3 h-14 w-14 rounded-md bg-surface-card"></div>
                        <p class="text-xs text-ink u-num">{{ $shadow['name'] }}</p>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 flex flex-wrap gap-6">
                @foreach ($motionTokens as $motion)
                    <div class="rounded-lg border border-line bg-surface-card px-4 py-3 shadow-card">
                        <p class="text-xs text-ink u-num">{{ $motion['name'] }}</p>
                        <p class="text-xs text-ink-muted u-num">{{ $motion['value'] }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- ===== IKON ===== --}}
        <section class="mb-14" aria-labelledby="section-ikon">
            <h2 id="section-ikon" class="text-h2 font-display text-ink mb-1">Ikon</h2>
            <p class="text-sm text-ink-soft mb-6">
                Tabler Icons, inline SVG via <code>&lt;x-ui.icon&gt;</code>, <code>stroke="currentColor"</code>.
                Ukuran baku: 16 / 20 / 24.
            </p>

            <div class="grid grid-cols-2 gap-4 sm:grid-cols-4 lg:grid-cols-6">
                @foreach ($icons as $icon)
                    <div class="flex flex-col items-center gap-2 rounded-lg border border-line bg-surface-card p-4 shadow-card">
                        <x-ui.icon :name="$icon" :size="24" class="text-ink" />
                        <p class="text-xs text-ink-muted text-center break-all">{{ $icon }}</p>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 flex items-center gap-8 rounded-lg border border-line bg-surface-card p-6 shadow-card">
                <div class="flex flex-col items-center gap-2">
                    <x-ui.icon name="wallet" :size="16" class="text-ink" />
                    <p class="text-xs text-ink-muted">16</p>
                </div>
                <div class="flex flex-col items-center gap-2">
                    <x-ui.icon name="wallet" :size="20" class="text-ink" />
                    <p class="text-xs text-ink-muted">20</p>
                </div>
                <div class="flex flex-col items-center gap-2">
                    <x-ui.icon name="wallet" :size="24" class="text-ink" />
                    <p class="text-xs text-ink-muted">24</p>
                </div>
            </div>
        </section>

        {{-- ===== BUTTON ===== --}}
        <section class="mb-14" aria-labelledby="section-button">
            <h2 id="section-button" class="text-h2 font-display text-ink mb-1">Button</h2>
            <p class="text-sm text-ink-soft mb-6">Variant &amp; ukuran — semua state fokus terlihat saat navigasi Tab.</p>

            <div class="rounded-lg border border-line bg-surface-card p-6 shadow-card">
                <p class="text-xs uppercase tracking-wide text-ink-muted mb-3">Variant</p>
                <div class="flex flex-wrap items-center gap-3 mb-6">
                    <x-ui.button variant="primary">Primary</x-ui.button>
                    <x-ui.button variant="secondary">Secondary</x-ui.button>
                    <x-ui.button variant="ghost">Ghost</x-ui.button>
                    <x-ui.button variant="danger">Danger</x-ui.button>
                    <x-ui.button variant="link">Link</x-ui.button>
                </div>

                <p class="text-xs uppercase tracking-wide text-ink-muted mb-3">Ukuran</p>
                <div class="flex flex-wrap items-center gap-3 mb-6">
                    <x-ui.button size="sm">Small</x-ui.button>
                    <x-ui.button size="md">Medium</x-ui.button>
                    <x-ui.button size="lg">Large</x-ui.button>
                </div>

                <p class="text-xs uppercase tracking-wide text-ink-muted mb-3">Ikon &amp; State</p>
                <div class="flex flex-wrap items-center gap-3">
                    <x-ui.button icon="wallet">Dengan ikon</x-ui.button>
                    <x-ui.button icon-right="chevron-down">Ikon kanan</x-ui.button>
                    <x-ui.button :loading="true">Menyimpan…</x-ui.button>
                    <x-ui.button disabled>Disabled</x-ui.button>
                </div>
            </div>
        </section>

        {{-- ===== FORM CONTROLS ===== --}}
        <section class="mb-14" aria-labelledby="section-form">
            <h2 id="section-form" class="text-h2 font-display text-ink mb-1">Form Controls</h2>
            <p class="text-sm text-ink-soft mb-6">Label di atas, input di tengah, helper/error di bawah. Error selalu didampingi ikon, bukan warna saja.</p>

            <div class="grid gap-6 rounded-lg border border-line bg-surface-card p-6 shadow-card sm:grid-cols-2 lg:grid-cols-3">
                <x-ui.input label="Nama lengkap" placeholder="Nama sesuai KTP" helper="Sesuai dokumen identitas." />
                <x-ui.input label="Email" type="email" size="sm" placeholder="nama@perusahaan.com" required />
                <x-ui.input label="Password" type="password" size="lg" error="Password minimal 8 karakter." value="1234" />

                <x-ui.input-money label="Nominal transfer" placeholder="0" helper="Masukkan tanpa titik/koma." />
                <x-ui.input-money label="Anggaran bulanan" size="sm" value="5.000.000" />
                <x-ui.input-money label="Nominal (error)" size="lg" error="Nominal melebihi saldo." value="999.000.000" />

                <x-ui.select label="Kategori transaksi" helper="Pilih kategori yang paling sesuai.">
                    <option value="">Pilih kategori</option>
                    <option value="operasional">Operasional</option>
                    <option value="gaji">Gaji</option>
                    <option value="lainnya">Lainnya</option>
                </x-ui.select>
                <x-ui.select label="Bank" size="sm" required>
                    <option value="">Pilih bank</option>
                    <option value="bca">BCA</option>
                    <option value="bri">BRI</option>
                </x-ui.select>
                <x-ui.select label="Status (error)" size="lg" error="Status wajib dipilih.">
                    <option value="">Pilih status</option>
                    <option value="lunas">Lunas</option>
                </x-ui.select>

                <x-ui.textarea label="Catatan" placeholder="Tambahkan catatan transaksi…" class="sm:col-span-2 lg:col-span-3" />
            </div>

            <div class="mt-6 grid gap-6 rounded-lg border border-line bg-surface-card p-6 shadow-card sm:grid-cols-3">
                <div>
                    <p class="text-xs uppercase tracking-wide text-ink-muted mb-3">Checkbox</p>
                    <div class="flex flex-col gap-3">
                        <x-ui.checkbox label="Ingat saya" checked />
                        <x-ui.checkbox label="Setuju S&amp;K" />
                        <x-ui.checkbox label="Wajib dicentang" error="Kolom ini wajib dicentang." />
                    </div>
                </div>

                <div>
                    <p class="text-xs uppercase tracking-wide text-ink-muted mb-3">Radio</p>
                    <div class="flex flex-col gap-3">
                        <x-ui.radio name="sg-periode" label="Bulanan" checked />
                        <x-ui.radio name="sg-periode" label="Tahunan" />
                    </div>
                </div>

                <div>
                    <p class="text-xs uppercase tracking-wide text-ink-muted mb-3">Toggle</p>
                    <div class="flex flex-col gap-3">
                        <x-ui.toggle label="Notifikasi email" checked />
                        <x-ui.toggle label="Mode gelap" helper="Belum aktif di Fase 2." />
                    </div>
                </div>
            </div>
        </section>

        {{-- ===== CARD & TREND ===== --}}
        <section class="mb-14" aria-labelledby="section-card">
            <h2 id="section-card" class="text-h2 font-display text-ink mb-1">Card &amp; Trend</h2>
            <p class="text-sm text-ink-soft mb-6">Stat card memakai <code>.u-num font-display</code> untuk angka, didampingi <code>&lt;x-ui.trend&gt;</code>.</p>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <x-ui.card variant="stat" label="Saldo" value="Rp 47.250.000">
                    <x-slot:trend>
                        <x-ui.trend direction="up" value="+8,2%" />
                    </x-slot:trend>
                </x-ui.card>

                <x-ui.card variant="stat" label="Pengeluaran bulan ini" value="Rp 9.350.000">
                    <x-slot:trend>
                        <x-ui.trend direction="down" value="−3,1%" />
                    </x-slot:trend>
                </x-ui.card>

                <x-ui.card variant="default">
                    <x-slot:header>
                        <p class="text-h2 font-display text-ink">Default</p>
                    </x-slot:header>
                    <p class="text-body text-ink-soft">Shadow-card, untuk konten umum.</p>
                    <x-slot:footer>
                        <x-ui.button size="sm" variant="link">Lihat detail</x-ui.button>
                    </x-slot:footer>
                </x-ui.card>

                <x-ui.card variant="flat">
                    <p class="text-h2 font-display text-ink mb-2">Flat</p>
                    <p class="text-body text-ink-soft">Border saja, untuk area padat/berdempetan.</p>
                </x-ui.card>
            </div>
        </section>

        {{-- ===== BADGE ===== --}}
        <section class="mb-14" aria-labelledby="section-badge">
            <h2 id="section-badge" class="text-h2 font-display text-ink mb-1">Badge</h2>
            <p class="text-sm text-ink-soft mb-6">Selalu bg muted + teks pekat + dot, bukan warna teks tunggal.</p>

            <div class="flex flex-wrap items-center gap-3 rounded-lg border border-line bg-surface-card p-6 shadow-card">
                <x-ui.badge variant="positive">Lunas</x-ui.badge>
                <x-ui.badge variant="negative">Jatuh tempo</x-ui.badge>
                <x-ui.badge variant="warning">Pending</x-ui.badge>
                <x-ui.badge variant="info">Info</x-ui.badge>
                <x-ui.badge variant="neutral">Draft</x-ui.badge>
                <x-ui.badge variant="positive" size="sm">Small</x-ui.badge>
            </div>
        </section>

        {{-- ===== ALERT ===== --}}
        <section class="mb-14" aria-labelledby="section-alert">
            <h2 id="section-alert" class="text-h2 font-display text-ink mb-1">Alert</h2>
            <p class="text-sm text-ink-soft mb-6">4 varian semantik, dismissible via Alpine — tetap terbaca tanpa JavaScript.</p>

            <div class="flex flex-col gap-4">
                <x-ui.alert variant="positive" title="Berhasil disimpan">Transaksi berhasil dicatat ke buku besar.</x-ui.alert>
                <x-ui.alert variant="negative" title="Gagal login" dismissible>Email atau password salah, silakan coba lagi.</x-ui.alert>
                <x-ui.alert variant="warning" title="Tagihan jatuh tempo">3 tagihan akan jatuh tempo dalam 7 hari.</x-ui.alert>
                <x-ui.alert variant="info">Fase 2 sedang dalam pengembangan aktif.</x-ui.alert>
            </div>
        </section>
    </div>
</body>
</html>
