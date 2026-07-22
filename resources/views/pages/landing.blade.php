@extends('layouts.guest')

@section('title', 'Ledgerly — Keuangan Bisnis, Beres Tanpa Ribet')

@section('content')
    {{-- ===== HERO ===== --}}
    <section class="c-hero">
        <div class="c-section__container c-hero__grid">
            <div>
                <h1 class="text-display font-display text-ink">Keuangan bisnis Anda, beres tanpa ribet.</h1>
                <p class="mt-4 max-w-md text-body text-ink-soft">
                    Ledgerly merapikan pembukuan, invoice, dan rekonsiliasi bank dalam satu dasbor — supaya Anda bisa fokus mengembangkan bisnis, bukan mengurus spreadsheet.
                </p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('register') }}" class="c-btn c-btn--primary c-btn--lg">Mulai Gratis</a>
                    <a href="{{ route('dashboard') }}" class="c-btn c-btn--secondary c-btn--lg">Lihat Demo</a>
                </div>
            </div>

            <div class="c-hero__mock" aria-hidden="true">
                <div class="mb-4 grid grid-cols-2 gap-3">
                    <x-ui.card variant="stat" label="Saldo" value="Rp 47.250.000">
                        <x-slot:trend><x-ui.trend direction="up" value="+8,2%" /></x-slot:trend>
                    </x-ui.card>
                    <x-ui.card variant="stat" label="Pemasukan" value="Rp 12.800.000">
                        <x-slot:trend><x-ui.trend direction="up" value="+8,2%" /></x-slot:trend>
                    </x-ui.card>
                </div>
                <x-ui.table variant="striped" size="sm">
                    <x-ui.table.head>
                        <x-ui.table.cell header>Deskripsi</x-ui.table.cell>
                        <x-ui.table.cell header type="number">Nominal</x-ui.table.cell>
                    </x-ui.table.head>
                    <x-ui.table.row>
                        <x-ui.table.cell>Invoice PT Maju Bersama</x-ui.table.cell>
                        <x-ui.table.cell type="number"><span class="text-positive">+12.800.000</span></x-ui.table.cell>
                    </x-ui.table.row>
                    <x-ui.table.row>
                        <x-ui.table.cell>Gaji karyawan Juli</x-ui.table.cell>
                        <x-ui.table.cell type="number"><span class="text-negative">−9.350.000</span></x-ui.table.cell>
                    </x-ui.table.row>
                </x-ui.table>
            </div>
        </div>
    </section>

    {{-- ===== TRUST BAR + SOSIAL PROOF ===== --}}
    <section id="tentang" class="c-section">
        <div class="c-section__container">
            <p class="text-center text-xs font-medium uppercase tracking-wide text-ink-muted">Dipercaya oleh bisnis di seluruh Indonesia</p>
            <div class="c-trust-bar">
                @foreach ($trustLogos as $logo)
                    <span class="c-trust-bar__item">{{ $logo }}</span>
                @endforeach
            </div>

            <div class="mt-12 grid gap-6 sm:grid-cols-3">
                @foreach ($stats as $stat)
                    <div class="text-center">
                        <p class="text-display font-display text-brand-700 u-num">{{ $stat['value'] }}</p>
                        <p class="mt-1 text-sm text-ink-soft">{{ $stat['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== FITUR ===== --}}
    <section id="fitur" class="c-section">
        <div class="c-section__container">
            <div class="mx-auto max-w-2xl text-center">
                <h2 class="text-h1 font-display text-ink">Semua yang Anda butuhkan untuk mengelola keuangan</h2>
                <p class="mt-3 text-body text-ink-soft">Dari pencatatan harian sampai laporan bulanan, semuanya dalam satu alur kerja yang rapi.</p>
            </div>

            <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($features as $feature)
                    <x-ui.card variant="flat">
                        <x-ui.icon :name="$feature['icon']" :size="24" class="text-brand-600" />
                        <h3 class="mt-4 text-h2 font-display text-ink">{{ $feature['title'] }}</h3>
                        <p class="mt-2 text-sm text-ink-soft">{{ $feature['description'] }}</p>
                    </x-ui.card>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== TESTIMONIAL ===== --}}
    <section class="c-section">
        <div class="c-section__container">
            <h2 class="text-center text-h1 font-display text-ink">Kata mereka yang sudah pakai Ledgerly</h2>

            <div class="mx-auto mt-10 max-w-2xl">
                <x-ui.carousel :slides="count($testimonials)">
                    @foreach ($testimonials as $testimonial)
                        <div class="c-testimonial">
                            <p class="text-h2 font-display text-ink">&ldquo;{{ $testimonial['quote'] }}&rdquo;</p>
                            <div class="mt-4 flex items-center gap-3">
                                <x-ui.avatar :name="$testimonial['name']" size="sm" />
                                <div>
                                    <p class="text-sm font-medium text-ink">{{ $testimonial['name'] }}</p>
                                    <p class="text-xs text-ink-muted">{{ $testimonial['role'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </x-ui.carousel>
            </div>
        </div>
    </section>

    {{-- ===== PRICING ===== --}}
    <section id="harga" class="c-section">
        <div class="c-section__container">
            <div class="mx-auto max-w-2xl text-center">
                <h2 class="text-h1 font-display text-ink">Paket yang sesuai skala bisnis Anda</h2>
                <p class="mt-3 text-body text-ink-soft">Mulai gratis, upgrade kapan saja saat bisnis Anda berkembang.</p>
            </div>

            <div class="mt-10 grid gap-6 lg:grid-cols-3">
                @foreach ($pricingPlans as $plan)
                    <x-ui.card
                        :variant="$plan['highlighted'] ? 'default' : 'flat'"
                        :class="$plan['highlighted'] ? 'c-pricing-card--highlight' : ''"
                    >
                        <x-slot:header>
                            <div>
                                <p class="text-h2 font-display text-ink">{{ $plan['name'] }}</p>
                                <p class="mt-1 text-sm text-ink-soft">{{ $plan['description'] }}</p>
                            </div>
                        </x-slot:header>

                        <p class="text-display font-display text-ink u-num">
                            {{ $plan['price'] }}
                            @if ($plan['period'])
                                <span class="text-sm font-normal text-ink-muted">{{ $plan['period'] }}</span>
                            @endif
                        </p>

                        <ul class="mt-6 flex flex-col gap-3">
                            @foreach ($plan['features'] as $feature)
                                <li class="flex items-center gap-2 text-sm text-ink-soft">
                                    <x-ui.icon name="circle-check" :size="18" class="shrink-0 text-positive" />
                                    {{ $feature }}
                                </li>
                            @endforeach
                        </ul>

                        <x-slot:footer>
                            <a
                                href="{{ route('register') }}"
                                class="c-btn c-btn--md w-full justify-center {{ $plan['highlighted'] ? 'c-btn--primary' : 'c-btn--secondary' }}"
                            >{{ $plan['cta'] }}</a>
                        </x-slot:footer>
                    </x-ui.card>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== CTA AKHIR ===== --}}
    <section class="c-cta-banner">
        <div class="c-section__container text-center">
            <h2 class="text-h1 font-display text-white">Siap merapikan keuangan bisnis Anda?</h2>
            <p class="mx-auto mt-3 max-w-md text-brand-100">Gratis 14 hari, tanpa kartu kredit. Batalkan kapan saja.</p>
            <a href="{{ route('register') }}" class="c-btn c-btn--primary c-btn--lg mt-6">Mulai Gratis Sekarang</a>
        </div>
    </section>
@endsection
