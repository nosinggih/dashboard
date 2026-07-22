<?php

namespace App\Http\Controllers;

class LandingController extends Controller
{
    public function index()
    {
        return view('pages.landing', [
            'trustLogos' => $this->trustLogos(),
            'features' => $this->features(),
            'stats' => $this->stats(),
            'testimonials' => $this->testimonials(),
            'pricingPlans' => $this->pricingPlans(),
        ]);
    }

    private function trustLogos(): array
    {
        return [
            'PT Maju Bersama', 'CV Sinar Abadi', 'Koperasi Sejahtera',
            'Toko Berkah Jaya', 'PT Nusantara Digital',
        ];
    }

    private function features(): array
    {
        return [
            [
                'icon' => 'chart-bar',
                'title' => 'Laporan Real-Time',
                'description' => 'Pantau arus kas, laba rugi, dan neraca yang selalu diperbarui otomatis setiap ada transaksi baru.',
            ],
            [
                'icon' => 'receipt-2',
                'title' => 'Invoice & Tagihan',
                'description' => 'Buat dan kirim invoice profesional, lalu lacak status pembayarannya sampai lunas.',
            ],
            [
                'icon' => 'credit-card',
                'title' => 'Rekonsiliasi Otomatis',
                'description' => 'Hubungkan rekening bank dan biarkan Ledgerly mencocokkan transaksi secara otomatis.',
            ],
        ];
    }

    private function stats(): array
    {
        return [
            ['value' => 'Rp 2,4 M', 'label' => 'dana dikelola tiap bulan'],
            ['value' => '18.500+', 'label' => 'transaksi diproses / bulan'],
            ['value' => '1.200+', 'label' => 'bisnis mempercayai Ledgerly'],
        ];
    }

    private function testimonials(): array
    {
        return [
            [
                'quote' => 'Sejak pakai Ledgerly, tutup buku bulanan yang dulu makan waktu 3 hari sekarang selesai dalam hitungan jam.',
                'name' => 'Dewi Anggraini',
                'role' => 'Owner, Toko Berkah Jaya',
            ],
            [
                'quote' => 'Rekonsiliasi bank otomatis benar-benar menghemat waktu tim keuangan kami setiap minggu.',
                'name' => 'Rizky Pratama',
                'role' => 'Finance Manager, PT Nusantara Digital',
            ],
            [
                'quote' => 'Tampilannya rapi dan gampang dipahami, bahkan untuk anggota koperasi yang baru belajar pembukuan digital.',
                'name' => 'Siti Rahmawati',
                'role' => 'Bendahara, Koperasi Sejahtera',
            ],
        ];
    }

    private function pricingPlans(): array
    {
        return [
            [
                'name' => 'Starter',
                'price' => 'Rp 99.000',
                'period' => '/bulan',
                'description' => 'Untuk usaha kecil yang baru mulai merapikan pembukuan.',
                'features' => ['1 pengguna', 'Hingga 100 transaksi/bulan', 'Laporan dasar', 'Dukungan email'],
                'highlighted' => false,
                'cta' => 'Mulai Gratis',
            ],
            [
                'name' => 'Pro',
                'price' => 'Rp 299.000',
                'period' => '/bulan',
                'description' => 'Untuk bisnis yang berkembang dan butuh laporan lengkap.',
                'features' => ['5 pengguna', 'Transaksi tanpa batas', 'Laporan & analitik lengkap', 'Rekonsiliasi bank otomatis', 'Dukungan prioritas'],
                'highlighted' => true,
                'cta' => 'Mulai Gratis',
            ],
            [
                'name' => 'Bisnis',
                'price' => 'Hubungi Kami',
                'period' => null,
                'description' => 'Untuk perusahaan dengan kebutuhan integrasi khusus.',
                'features' => ['Pengguna tanpa batas', 'Integrasi API', 'Manajer akun khusus', 'SLA & dukungan 24/7'],
                'highlighted' => false,
                'cta' => 'Hubungi Sales',
            ],
        ];
    }
}
