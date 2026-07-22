<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.dashboard.index', [
            'stats' => $this->stats(),
            'chart' => $this->chart(),
            'categories' => $this->categories(),
            'transactions' => $this->transactions(),
        ]);
    }

    private function stats(): array
    {
        return [
            ['label' => 'Saldo', 'value' => 'Rp 47.250.000', 'trend' => ['direction' => 'up', 'value' => '+8,2%']],
            ['label' => 'Pemasukan bulan ini', 'value' => 'Rp 12.800.000', 'trend' => ['direction' => 'up', 'value' => '+8,2%']],
            ['label' => 'Pengeluaran bulan ini', 'value' => 'Rp 9.350.000', 'trend' => ['direction' => 'down', 'value' => '−3,1%']],
            ['label' => 'Tagihan jatuh tempo', 'value' => 'Rp 3.100.000', 'badge' => ['variant' => 'warning', 'label' => '3 tagihan']],
        ];
    }

    private function chart(): array
    {
        return [
            'labels' => ['Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul'],
            'pemasukan' => [9_400_000, 10_100_000, 8_900_000, 11_300_000, 11_850_000, 12_800_000],
            'pengeluaran' => [7_200_000, 8_450_000, 7_600_000, 8_900_000, 9_650_000, 9_350_000],
        ];
    }

    private function categories(): Collection
    {
        return collect([
            ['label' => 'Operasional', 'percent' => 45],
            ['label' => 'Gaji Karyawan', 'percent' => 30],
            ['label' => 'Pemasaran', 'percent' => 15],
            ['label' => 'Lainnya', 'percent' => 10],
        ]);
    }

    private function transactions(): Collection
    {
        return collect([
            ['date' => '20 Jul 2026', 'description' => 'Pembayaran invoice PT Maju Bersama', 'category' => 'Pemasukan', 'status' => 'positive', 'statusLabel' => 'Lunas', 'amount' => 12_800_000],
            ['date' => '18 Jul 2026', 'description' => 'Gaji karyawan bulan Juli', 'category' => 'Operasional', 'status' => 'negative', 'statusLabel' => 'Terbayar', 'amount' => -9_350_000],
            ['date' => '16 Jul 2026', 'description' => 'Biaya server cloud', 'category' => 'Operasional', 'status' => 'warning', 'statusLabel' => 'Pending', 'amount' => -1_450_000],
            ['date' => '14 Jul 2026', 'description' => 'Pembayaran invoice CV Sinar Abadi', 'category' => 'Pemasukan', 'status' => 'positive', 'statusLabel' => 'Lunas', 'amount' => 5_200_000],
            ['date' => '12 Jul 2026', 'description' => 'Langganan software akuntansi', 'category' => 'Operasional', 'status' => 'negative', 'statusLabel' => 'Terbayar', 'amount' => -450_000],
            ['date' => '10 Jul 2026', 'description' => 'Iklan media sosial', 'category' => 'Pemasaran', 'status' => 'negative', 'statusLabel' => 'Terbayar', 'amount' => -1_200_000],
            ['date' => '08 Jul 2026', 'description' => 'Pembayaran invoice Koperasi Sejahtera', 'category' => 'Pemasukan', 'status' => 'positive', 'statusLabel' => 'Lunas', 'amount' => 3_600_000],
            ['date' => '06 Jul 2026', 'description' => 'Sewa gudang bulan Juli', 'category' => 'Operasional', 'status' => 'negative', 'statusLabel' => 'Terbayar', 'amount' => -2_500_000],
            ['date' => '04 Jul 2026', 'description' => 'Pembayaran invoice Toko Berkah Jaya', 'category' => 'Pemasukan', 'status' => 'positive', 'statusLabel' => 'Lunas', 'amount' => 4_150_000],
            ['date' => '02 Jul 2026', 'description' => 'Token listrik kantor', 'category' => 'Operasional', 'status' => 'negative', 'statusLabel' => 'Terbayar', 'amount' => -680_000],
        ]);
    }
}
