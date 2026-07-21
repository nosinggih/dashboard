@props([
    'tabs' => [],
])

<div x-data="{ active: 0 }" class="c-tabs" data-js="tabs">
    <div
        class="c-tabs__list"
        role="tablist"
        @keydown.right.prevent="active = (active + 1) % {{ count($tabs) }}; $nextTick(() => $refs['tab' + active].focus())"
        @keydown.left.prevent="active = (active - 1 + {{ count($tabs) }}) % {{ count($tabs) }}; $nextTick(() => $refs['tab' + active].focus())"
    >
        @foreach ($tabs as $i => $label)
            <button
                type="button"
                role="tab"
                x-ref="tab{{ $i }}"
                :aria-selected="(active === {{ $i }}).toString()"
                :tabindex="active === {{ $i }} ? 0 : -1"
                :class="active === {{ $i }} ? 'c-tabs__tab is-active' : 'c-tabs__tab'"
                @click="active = {{ $i }}"
            >{{ $label }}</button>
        @endforeach
    </div>

    {{ $slot }}
</div>
