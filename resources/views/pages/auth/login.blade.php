@extends('layouts.guest')

@section('title', 'Masuk — Ledgerly')

@section('content')
    <div class="c-auth">
        @include('partials.auth-aside')

        <div class="c-auth__form">
            <div class="c-auth__form-inner">
                <h1 class="text-h1 font-display text-ink">Masuk ke Ledgerly</h1>
                <p class="mt-2 text-sm text-ink-soft">Kelola keuangan bisnis Anda dalam satu tempat.</p>

                @if ($loginError)
                    <x-ui.alert variant="negative" class="mt-6">{{ $loginError }}</x-ui.alert>
                @endif

                <form method="POST" action="{{ route('login') }}" class="mt-6 flex flex-col gap-4">
                    @csrf

                    <x-ui.input type="email" name="email" label="Email" placeholder="nama@perusahaan.com" required autocomplete="email" />

                    <div class="c-field" x-data="{ show: false }">
                        <label for="login-password" class="c-field__label">Kata Sandi</label>
                        <div class="relative flex items-center">
                            <input
                                id="login-password"
                                name="password"
                                type="password"
                                :type="show ? 'text' : 'password'"
                                placeholder="Masukkan kata sandi"
                                required
                                autocomplete="current-password"
                                class="c-input c-input--md pr-10"
                            />
                            <button
                                type="button"
                                class="absolute right-3 text-ink-muted hover:text-ink"
                                data-js="password-toggle"
                                @click="show = !show"
                                :aria-label="show ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi'"
                            >
                                <x-ui.icon name="eye" :size="18" x-show="!show" />
                                <x-ui.icon name="eye-off" :size="18" x-show="show" x-cloak />
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <x-ui.checkbox name="remember" label="Ingat saya" />
                        <a href="#" class="text-sm font-medium text-brand-600 hover:underline">Lupa kata sandi?</a>
                    </div>

                    <x-ui.button type="submit" variant="primary" class="w-full justify-center">Masuk</x-ui.button>

                    <div class="c-auth__divider"><span>atau</span></div>

                    <x-ui.button variant="secondary" class="w-full justify-center" icon="user">Masuk dengan SSO</x-ui.button>
                </form>

                <p class="mt-6 text-center text-sm text-ink-soft">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-medium text-brand-600 hover:underline">Daftar sekarang</a>
                </p>
            </div>
        </div>
    </div>
@endsection
