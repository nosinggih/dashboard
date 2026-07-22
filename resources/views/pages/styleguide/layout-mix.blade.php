@extends('layouts.app-mix')

@section('title', 'Preview — Mix Layout')

@section('breadcrumb')
    <x-ui.breadcrumb :items="[
        ['label' => 'Ledgerly', 'url' => '/styleguide'],
        ['label' => $activeModule['label']],
    ]" />
@endsection

@section('content')
    <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-h1 font-display text-ink">{{ $activeModule['label'] }}</h1>
            <p class="text-sm text-ink-soft">Preview layout <code>app-mix</code> — klik modul di topbar untuk ganti sidebar level-2.</p>
        </div>
        <a href="/styleguide" class="c-btn c-btn--secondary c-btn--sm">Kembali ke Styleguide</a>
    </div>

    <x-ui.table variant="striped">
        <x-ui.table.head>
            <x-ui.table.cell header>Tanggal</x-ui.table.cell>
            <x-ui.table.cell header>Deskripsi</x-ui.table.cell>
            <x-ui.table.cell header type="number">Nominal</x-ui.table.cell>
        </x-ui.table.head>
        @foreach ($transactions as $trx)
            <x-ui.table.row>
                <x-ui.table.cell label="Tanggal">{{ $trx['date'] }}</x-ui.table.cell>
                <x-ui.table.cell label="Deskripsi">{{ $trx['description'] }}</x-ui.table.cell>
                <x-ui.table.cell type="number" label="Nominal">
                    <span class="{{ $trx['amount'] < 0 ? 'text-negative' : 'text-positive' }}">
                        {{ $trx['amount'] < 0 ? '−' : '+' }}{{ number_format(abs($trx['amount']), 0, ',', '.') }}
                    </span>
                </x-ui.table.cell>
            </x-ui.table.row>
        @endforeach
    </x-ui.table>
@endsection
