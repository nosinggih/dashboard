@props([
    'message' => 'Memuat...',
])

<div
    x-data
    x-show="$store.pageTransition.active"
    x-cloak
    x-transition.opacity.duration.300ms
    x-focus-trap="$store.pageTransition.active"
    class="c-page-transition"
    role="status"
    aria-live="polite"
    aria-label="{{ $message }}"
    tabindex="-1"
    data-js="page-transition"
>
    {{-- viewBox 0 0 100 100: ukuran tiap shape = persentase langsung dari layar (70% / 40% / 20%) --}}
    <svg class="c-page-transition__svg" viewBox="0 0 100 100" role="presentation" aria-hidden="true">
        {{-- 70% — blob besar, jangkar visual --}}
        <path
            class="c-page-transition__shape c-page-transition__shape--blob"
            d="M50,19 C72,19 85,32 85,54 C85,76 72,89 50,89 C28,89 15,76 15,54 C15,32 28,19 50,19 Z"
        />

        {{-- 40% — dua shape menengah --}}
        <circle class="c-page-transition__shape c-page-transition__shape--circle-md" cx="27" cy="28" r="20" />
        <rect class="c-page-transition__shape c-page-transition__shape--square-md" x="58" y="56" width="28" height="28" rx="6" />

        {{-- 20% — tiga shape kecil, gerak paling ekspresif --}}
        <polygon class="c-page-transition__shape c-page-transition__shape--triangle-sm" points="78,12 68,32 88,32" />
        <circle class="c-page-transition__shape c-page-transition__shape--dot-sm-1" cx="18" cy="80" r="10" />
        <circle class="c-page-transition__shape c-page-transition__shape--dot-sm-2" cx="90" cy="86" r="10" />
    </svg>
    <span class="sr-only">{{ $message }}</span>
</div>
