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
    </div>
</body>
</html>
