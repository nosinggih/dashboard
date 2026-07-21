@props([
    'size' => 'md',
    'variant' => 'default',
    'title' => null,
    'confirmLabel' => 'Hapus',
    'cancelLabel' => 'Batal',
])

@php
$sizeClass = match ($size) {
    'sm' => 'c-modal__panel--sm',
    'lg' => 'c-modal__panel--lg',
    'full' => 'c-modal__panel--full',
    default => 'c-modal__panel--md',
};

$id = $attributes->get('id') ?? uniqid('modal-');
@endphp

<div x-data="{ open: false }" data-js="modal">
    @isset($trigger)
        <span @click="open = true">{{ $trigger }}</span>
    @endisset

    <template x-teleport="body">
        <div
            x-show="open"
            x-cloak
            @keydown.escape.window="open = false"
            class="c-modal"
        >
            <div class="c-modal__overlay" @click="open = false" aria-hidden="true"></div>

            <div
                class="c-modal__panel {{ $sizeClass }}"
                role="dialog"
                aria-modal="true"
                aria-labelledby="{{ $id }}-title"
                tabindex="-1"
                x-focus-trap="open"
                @click.outside="open = false"
            >
                <div class="c-modal__header">
                    @if ($title)
                        <h2 id="{{ $id }}-title" class="c-modal__title">{{ $title }}</h2>
                    @endif
                    <button type="button" class="c-modal__close" @click="open = false" aria-label="Tutup">
                        <x-ui.icon name="x" :size="20" />
                    </button>
                </div>

                <div class="c-modal__body">
                    {{ $slot }}
                </div>

                @if ($variant === 'confirm' && ! isset($footer))
                    <div class="c-modal__footer">
                        <x-ui.button variant="secondary" @click="open = false">{{ $cancelLabel }}</x-ui.button>
                        <x-ui.button variant="danger" @click="open = false">{{ $confirmLabel }}</x-ui.button>
                    </div>
                @elseif (isset($footer))
                    <div class="c-modal__footer">{{ $footer }}</div>
                @endif
            </div>
        </div>
    </template>
</div>
