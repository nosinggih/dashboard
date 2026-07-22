@extends('layouts.app-sidebar')

@section('title', 'Dashboard — Ledgerly')

@section('content')
    <div class="mb-6">
        <h1 class="text-h1 font-display text-ink">Dashboard</h1>
        <p class="text-sm text-ink-soft">Ringkasan keuangan bisnis Anda bulan ini.</p>
    </div>

    {{-- ===== BARIS 1: STAT CARDS ===== --}}
    <div class="mb-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        @foreach ($stats as $stat)
            <x-ui.card variant="stat" label="{{ $stat['label'] }}" value="{{ $stat['value'] }}">
                @if (isset($stat['trend']))
                    <x-slot:trend>
                        <x-ui.trend :direction="$stat['trend']['direction']" :value="$stat['trend']['value']" />
                    </x-slot:trend>
                @elseif (isset($stat['badge']))
                    <x-slot:trend>
                        <x-ui.badge :variant="$stat['badge']['variant']" size="sm">{{ $stat['badge']['label'] }}</x-ui.badge>
                    </x-slot:trend>
                @endif
            </x-ui.card>
        @endforeach
    </div>

    {{-- ===== BARIS 2: CHART + RINGKASAN KATEGORI ===== --}}
    <div class="mb-6 grid gap-4 lg:grid-cols-12">
        <x-ui.card class="lg:col-span-8">
            <x-slot:header>
                <p class="text-h2 font-display text-ink">Pemasukan vs Pengeluaran</p>
            </x-slot:header>
            <div class="c-chart-card">
                <canvas
                    id="cashflow-chart"
                    data-js="cashflow-chart"
                    data-chart="{{ json_encode($chart) }}"
                    role="img"
                    aria-label="Grafik pemasukan dan pengeluaran 6 bulan terakhir"
                ></canvas>
            </div>
        </x-ui.card>

        <x-ui.card class="lg:col-span-4">
            <x-slot:header>
                <p class="text-h2 font-display text-ink">Ringkasan Kategori</p>
            </x-slot:header>

            @if ($categories->isEmpty())
                <x-ui.empty-state icon="chart-bar" title="Belum ada data kategori">
                    Kategori pengeluaran akan muncul di sini setelah ada transaksi.
                </x-ui.empty-state>
            @else
                <div class="flex flex-col gap-4">
                    @foreach ($categories as $category)
                        <x-ui.progress variant="bar" :label="$category['label']" :value="$category['percent']" />
                    @endforeach
                </div>
            @endif
        </x-ui.card>
    </div>

    {{-- ===== BARIS 3: TRANSACTION TABLE ===== --}}
    <x-ui.card>
        <x-slot:header>
            <p class="text-h2 font-display text-ink">Transaksi Terbaru</p>
            <a href="#" class="c-btn c-btn--ghost c-btn--sm">Lihat Semua</a>
        </x-slot:header>

        @if ($transactions->isEmpty())
            <x-ui.empty-state icon="receipt-2" title="Belum ada transaksi">
                Transaksi yang Anda catat akan muncul di sini.
                <x-slot:cta>
                    <a href="#" class="c-btn c-btn--primary c-btn--sm">Tambah Transaksi</a>
                </x-slot:cta>
            </x-ui.empty-state>
        @else
            <x-ui.table variant="striped">
                <x-ui.table.head>
                    <x-ui.table.cell header>Tanggal</x-ui.table.cell>
                    <x-ui.table.cell header>Deskripsi</x-ui.table.cell>
                    <x-ui.table.cell header type="status">Status</x-ui.table.cell>
                    <x-ui.table.cell header type="number">Nominal</x-ui.table.cell>
                </x-ui.table.head>
                @foreach ($transactions as $trx)
                    <x-ui.table.row>
                        <x-ui.table.cell label="Tanggal">{{ $trx['date'] }}</x-ui.table.cell>
                        <x-ui.table.cell label="Deskripsi">
                            <p class="text-ink">{{ $trx['description'] }}</p>
                            <p class="text-xs text-ink-muted">{{ $trx['category'] }}</p>
                        </x-ui.table.cell>
                        <x-ui.table.cell type="status" label="Status">
                            <x-ui.badge :variant="$trx['status']" size="sm">{{ $trx['statusLabel'] }}</x-ui.badge>
                        </x-ui.table.cell>
                        <x-ui.table.cell type="number" label="Nominal">
                            <span class="{{ $trx['amount'] < 0 ? 'text-negative' : 'text-positive' }}">
                                {{ $trx['amount'] < 0 ? '−' : '+' }}{{ number_format(abs($trx['amount']), 0, ',', '.') }}
                            </span>
                        </x-ui.table.cell>
                    </x-ui.table.row>
                @endforeach
            </x-ui.table>
        @endif
    </x-ui.card>

    @push('scripts')
        @vite('resources/js/modules/chart-loader.js')
    @endpush
@endsection
