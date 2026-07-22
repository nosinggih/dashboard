@props([
    'quote' => 'Sejak pakai Ledgerly, tutup buku bulanan yang dulu makan waktu 3 hari sekarang selesai dalam hitungan jam.',
    'name' => 'Dewi Anggraini',
    'role' => 'Owner, Toko Berkah Jaya',
])

<div class="c-auth__aside">
    <a href="{{ route('landing') }}" class="inline-flex items-center gap-2 text-h2 font-display text-white">
        <x-ui.icon name="wallet" :size="24" />
        Ledgerly
    </a>

    <blockquote class="c-auth__quote">
        <p class="text-h2 font-display text-white">&ldquo;{{ $quote }}&rdquo;</p>
        <footer class="mt-4 flex items-center gap-3">
            <x-ui.avatar :name="$name" size="sm" />
            <div>
                <p class="text-sm font-medium text-white">{{ $name }}</p>
                <p class="text-xs text-brand-300">{{ $role }}</p>
            </div>
        </footer>
    </blockquote>
</div>
