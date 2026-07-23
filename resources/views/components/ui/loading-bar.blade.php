<div
    x-data
    x-show="$store.loadingBar.active"
    x-cloak
    x-transition.opacity.duration.150ms
    class="c-loading-bar"
    role="status"
    aria-live="polite"
    aria-label="Memuat data"
    data-js="loading-bar"
>
    <div class="c-loading-bar__progress"></div>
</div>
