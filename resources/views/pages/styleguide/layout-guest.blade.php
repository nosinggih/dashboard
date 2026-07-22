@extends('layouts.guest')

@section('title', 'Preview — Guest Layout')

@section('content')
    <section class="mx-auto max-w-4xl px-4 py-16 text-center sm:px-6">
        <p class="text-xs font-medium uppercase tracking-wide text-brand-600">Preview Layout</p>
        <h1 class="mt-2 text-display font-display text-ink">Layout Guest</h1>
        <p class="mx-auto mt-4 max-w-xl text-body text-ink-soft">
            Dipakai untuk landing, login, dan register — navbar sticky di atas, footer 4 kolom di bawah.
            Konten di antara keduanya sepenuhnya bebas diisi tiap halaman.
        </p>
        <a href="/styleguide" class="c-btn c-btn--primary c-btn--md mt-8 inline-flex">Kembali ke Styleguide</a>
    </section>
@endsection
