@props([
    'message' => 'Memuat...',
])

<div
    x-data
    x-show="$store.loadingOverlay.active"
    x-cloak
    x-transition.opacity
    x-focus-trap="$store.loadingOverlay.active"
    class="c-loading-overlay"
    role="alertdialog"
    aria-live="polite"
    aria-label="{{ $message }}"
    tabindex="-1"
    data-js="loading-overlay"
>
    <div class="c-loading-overlay__panel">
        <span class="c-loading-overlay__spinner" aria-hidden="true"></span>
        <p class="c-loading-overlay__text" x-text="$store.loadingOverlay.message"></p>
    </div>
</div>
