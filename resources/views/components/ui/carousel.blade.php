@props([
    'slides' => 1,
])

<div x-data="{ active: 0 }" class="c-carousel" data-js="carousel">
    <div
        class="c-carousel__track"
        x-ref="track"
        @scroll.debounce.100ms="active = Math.round($refs.track.scrollLeft / $refs.track.clientWidth)"
    >
        {{ $slot }}
    </div>

    @if ($slides > 1)
        <div class="c-carousel__controls">
            <button
                type="button"
                class="c-carousel__nav"
                @click="$refs.track.scrollBy({ left: -$refs.track.clientWidth, behavior: 'smooth' })"
                aria-label="Sebelumnya"
            >
                <x-ui.icon name="chevron-left" :size="20" />
            </button>

            <div class="c-carousel__dots" role="tablist">
                @for ($i = 0; $i < $slides; $i++)
                    <button
                        type="button"
                        class="c-carousel__dot"
                        :class="{ 'is-active': active === {{ $i }} }"
                        @click="$refs.track.scrollTo({ left: {{ $i }} * $refs.track.clientWidth, behavior: 'smooth' }); active = {{ $i }}"
                        aria-label="Slide {{ $i + 1 }}"
                    ></button>
                @endfor
            </div>

            <button
                type="button"
                class="c-carousel__nav"
                @click="$refs.track.scrollBy({ left: $refs.track.clientWidth, behavior: 'smooth' })"
                aria-label="Selanjutnya"
            >
                <x-ui.icon name="chevron-right" :size="20" />
            </button>
        </div>
    @endif
</div>
