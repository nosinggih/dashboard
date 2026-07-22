@extends('layouts.app-sidebar')

@section('title', 'Preview — Sidebar Layout')

@section('content')
    <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-h1 font-display text-ink">Dashboard</h1>
            <p class="text-sm text-ink-soft">Preview layout <code>app-sidebar</code> — coba ciutkan sidebar atau buka drawer di layar kecil.</p>
        </div>
        <a href="/styleguide" class="c-btn c-btn--secondary c-btn--sm">Kembali ke Styleguide</a>
    </div>

    <div class="mb-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <x-ui.card variant="stat" label="Saldo" value="Rp 47.250.000">
            <x-slot:trend><x-ui.trend direction="up" value="+8,2%" /></x-slot:trend>
        </x-ui.card>
        <x-ui.card variant="stat" label="Pemasukan bulan ini" value="Rp 12.800.000">
            <x-slot:trend><x-ui.trend direction="up" value="+8,2%" /></x-slot:trend>
        </x-ui.card>
        <x-ui.card variant="stat" label="Pengeluaran bulan ini" value="Rp 9.350.000">
            <x-slot:trend><x-ui.trend direction="down" value="−3,1%" /></x-slot:trend>
        </x-ui.card>
    </div>

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
@endsection
