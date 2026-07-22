@php
$footerColumns = [
    [
        'heading' => 'Produk',
        'links' => [
            ['label' => 'Fitur', 'url' => '#fitur'],
            ['label' => 'Harga', 'url' => '#harga'],
            ['label' => 'Styleguide', 'url' => '/styleguide'],
        ],
    ],
    [
        'heading' => 'Perusahaan',
        'links' => [
            ['label' => 'Tentang Kami', 'url' => '#'],
            ['label' => 'Karier', 'url' => '#'],
            ['label' => 'Kontak', 'url' => '#'],
        ],
    ],
    [
        'heading' => 'Sumber Daya',
        'links' => [
            ['label' => 'Bantuan', 'url' => '#'],
            ['label' => 'Dokumentasi', 'url' => '#'],
            ['label' => 'Status Layanan', 'url' => '#'],
        ],
    ],
    [
        'heading' => 'Legal',
        'links' => [
            ['label' => 'Syarat Layanan', 'url' => '#'],
            ['label' => 'Kebijakan Privasi', 'url' => '#'],
        ],
    ],
];
@endphp

<footer class="c-footer">
    <div class="c-footer__grid">
        <div class="sm:col-span-2 lg:col-span-1">
            <a href="/" class="inline-flex items-center gap-2 text-h2 font-display text-white">
                <x-ui.icon name="wallet" :size="24" />
                Ledgerly
            </a>
            <p class="mt-3 max-w-xs text-sm text-brand-100">
                Design system &amp; tema untuk aplikasi web keuangan — rapi, konsisten, dan mudah dipercaya.
            </p>
        </div>

        @foreach ($footerColumns as $column)
            <div>
                <p class="c-footer__heading">{{ $column['heading'] }}</p>
                @foreach ($column['links'] as $link)
                    <a href="{{ $link['url'] }}" class="c-footer__link">{{ $link['label'] }}</a>
                @endforeach
            </div>
        @endforeach
    </div>

    <div class="c-footer__bottom">
        &copy; {{ date('Y') }} Ledgerly. Seluruh hak cipta dilindungi.
    </div>
</footer>
