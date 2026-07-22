@extends('layouts.guest')

@section('title', 'Daftar — Ledgerly')

@section('content')
    <div class="c-auth">
        @include('partials.auth-aside', [
            'quote' => 'Onboarding-nya cepat — dalam 10 menit tim kami sudah bisa mulai input transaksi harian.',
            'name' => 'Rizky Pratama',
            'role' => 'Finance Manager, PT Nusantara Digital',
        ])

        <div class="c-auth__form">
            <div class="c-auth__form-inner">
                <h1 class="text-h1 font-display text-ink">Buat akun Ledgerly</h1>
                <p class="mt-2 text-sm text-ink-soft">Mulai kelola keuangan bisnis Anda hari ini — gratis 14 hari.</p>

                <x-ui.stepper :steps="$steps" :active="0" class="mt-6" />

                <form method="POST" action="{{ route('register') }}" class="mt-6 flex flex-col gap-8">
                    @csrf

                    <fieldset class="flex flex-col gap-4">
                        <legend class="mb-1 text-h2 font-display text-ink">Akun</legend>

                        <x-ui.input name="name" label="Nama Lengkap" placeholder="Nama sesuai KTP" required autocomplete="name" />
                        <x-ui.input type="email" name="email" label="Email" placeholder="nama@perusahaan.com" required autocomplete="email" />

                        <div class="c-field" x-data="{ show: false }">
                            <label for="register-password" class="c-field__label">Kata Sandi</label>
                            <div class="relative flex items-center">
                                <input
                                    id="register-password"
                                    name="password"
                                    type="password"
                                    :type="show ? 'text' : 'password'"
                                    placeholder="Minimal 8 karakter"
                                    required
                                    minlength="8"
                                    autocomplete="new-password"
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
                            <x-ui.progress variant="bar" label="Kekuatan kata sandi: Sedang" :value="45" class="mt-2" />
                        </div>
                    </fieldset>

                    <fieldset class="flex flex-col gap-4">
                        <legend class="mb-1 text-h2 font-display text-ink">Profil Usaha</legend>

                        <x-ui.input name="business_name" label="Nama Usaha" placeholder="PT / CV / Nama Toko" required />

                        <x-ui.select name="business_type" label="Jenis Usaha" required>
                            <option value="">Pilih jenis usaha</option>
                            <option value="retail">Retail / Toko</option>
                            <option value="jasa">Jasa</option>
                            <option value="manufaktur">Manufaktur</option>
                            <option value="koperasi">Koperasi</option>
                            <option value="lainnya">Lainnya</option>
                        </x-ui.select>

                        <x-ui.input type="tel" name="phone" label="Nomor Telepon" placeholder="08xx-xxxx-xxxx" required autocomplete="tel" />
                    </fieldset>

                    <fieldset class="flex flex-col gap-4">
                        <legend class="mb-1 text-h2 font-display text-ink">Verifikasi</legend>

                        <x-ui.checkbox
                            name="agree"
                            required
                            label="Saya menyetujui Syarat Layanan dan Kebijakan Privasi Ledgerly."
                        />

                        <x-ui.button type="submit" variant="primary" class="w-full justify-center">Buat Akun</x-ui.button>
                    </fieldset>
                </form>

                <p class="mt-2 text-center text-sm text-ink-soft">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="font-medium text-brand-600 hover:underline">Masuk</a>
                </p>
            </div>
        </div>
    </div>
@endsection
