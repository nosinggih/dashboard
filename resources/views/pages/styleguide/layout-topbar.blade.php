@extends('layouts.app-topbar')

@section('title', 'Preview — Topbar Layout')

@section('content')
    <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-h1 font-display text-ink">Dashboard</h1>
            <p class="text-sm text-ink-soft">Preview layout <code>app-topbar</code> — menu overflow masuk ke dropdown "Lainnya", &lt; lg jadi hamburger.</p>
        </div>
        <a href="/styleguide" class="c-btn c-btn--secondary c-btn--sm">Kembali ke Styleguide</a>
    </div>

    <div class="mb-8 grid gap-4 sm:grid-cols-3">
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

    <x-ui.table variant="card">
        @foreach ($transactions as $trx)
            <x-ui.table.row>
                <x-ui.table.cell label="Deskripsi">
                    <p class="text-ink">{{ $trx['description'] }}</p>
                    <p class="text-xs text-ink-muted">{{ $trx['date'] }}</p>
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
