<?php

namespace App\Http\Controllers;

class StyleguideController extends Controller
{
    public function index()
    {
        return view('pages.styleguide', [
            'colorGroups' => $this->colorGroups(),
            'typeScale' => $this->typeScale(),
            'radiusTokens' => $this->radiusTokens(),
            'shadowTokens' => $this->shadowTokens(),
            'motionTokens' => $this->motionTokens(),
            'icons' => $this->icons(),
        ]);
    }

    private function colorGroups(): array
    {
        return [
            [
                'label' => 'Brand',
                'tokens' => [
                    ['name' => 'brand-50', 'class' => 'bg-brand-50'],
                    ['name' => 'brand-100', 'class' => 'bg-brand-100'],
                    ['name' => 'brand-300', 'class' => 'bg-brand-300'],
                    ['name' => 'brand-500', 'class' => 'bg-brand-500'],
                    ['name' => 'brand-600', 'class' => 'bg-brand-600'],
                    ['name' => 'brand-700', 'class' => 'bg-brand-700'],
                    ['name' => 'brand-900', 'class' => 'bg-brand-900'],
                ],
            ],
            [
                'label' => 'Neutral — Surface',
                'tokens' => [
                    ['name' => 'surface', 'class' => 'bg-surface'],
                    ['name' => 'surface-card', 'class' => 'bg-surface-card'],
                    ['name' => 'surface-sunken', 'class' => 'bg-surface-sunken'],
                ],
            ],
            [
                'label' => 'Neutral — Border',
                'tokens' => [
                    ['name' => 'line', 'class' => 'bg-line'],
                    ['name' => 'line-strong', 'class' => 'bg-line-strong'],
                ],
            ],
            [
                'label' => 'Neutral — Teks',
                'tokens' => [
                    ['name' => 'ink', 'class' => 'bg-ink'],
                    ['name' => 'ink-soft', 'class' => 'bg-ink-soft'],
                    ['name' => 'ink-muted', 'class' => 'bg-ink-muted'],
                ],
            ],
            [
                'label' => 'Semantic',
                'tokens' => [
                    ['name' => 'positive', 'class' => 'bg-positive'],
                    ['name' => 'positive-bg', 'class' => 'bg-positive-bg'],
                    ['name' => 'negative', 'class' => 'bg-negative'],
                    ['name' => 'negative-bg', 'class' => 'bg-negative-bg'],
                    ['name' => 'warning', 'class' => 'bg-warning'],
                    ['name' => 'warning-bg', 'class' => 'bg-warning-bg'],
                    ['name' => 'info', 'class' => 'bg-info'],
                    ['name' => 'info-bg', 'class' => 'bg-info-bg'],
                ],
            ],
        ];
    }

    private function typeScale(): array
    {
        return [
            ['token' => 'text-display', 'class' => 'text-display font-display', 'meta' => '2.25rem / 700', 'sample' => 'Rp 47.250.000'],
            ['token' => 'text-h1', 'class' => 'text-h1 font-display', 'meta' => '1.5rem / 700', 'sample' => 'Judul Halaman'],
            ['token' => 'text-h2', 'class' => 'text-h2 font-display', 'meta' => '1.25rem / 600', 'sample' => 'Judul Section / Card'],
            ['token' => 'text-body', 'class' => 'text-body', 'meta' => '0.9375rem / 400', 'sample' => 'Teks default — nyaman untuk screentime lama.'],
            ['token' => 'text-sm', 'class' => 'text-sm', 'meta' => '0.8125rem / 400', 'sample' => 'Meta, helper text'],
            ['token' => 'text-xs', 'class' => 'text-xs uppercase tracking-wide', 'meta' => '0.75rem / 500', 'sample' => 'Label / Badge / Header Tabel'],
        ];
    }

    private function radiusTokens(): array
    {
        return [
            ['name' => '--radius-sm', 'class' => 'rounded-sm', 'value' => '6px'],
            ['name' => '--radius-md', 'class' => 'rounded-md', 'value' => '10px'],
            ['name' => '--radius-lg', 'class' => 'rounded-lg', 'value' => '14px'],
        ];
    }

    private function shadowTokens(): array
    {
        return [
            ['name' => '--shadow-card', 'class' => 'shadow-card'],
            ['name' => '--shadow-modal', 'class' => 'shadow-modal'],
        ];
    }

    private function motionTokens(): array
    {
        return [
            ['name' => '--duration-fast', 'value' => '120ms'],
            ['name' => '--duration-base', 'value' => '180ms'],
            ['name' => '--ease-standard', 'value' => 'cubic-bezier(.2, .6, .3, 1)'],
        ];
    }

    private function icons(): array
    {
        return [
            'wallet', 'credit-card', 'coin', 'receipt-2', 'chart-bar',
            'arrow-up', 'arrow-down', 'trending-up', 'trending-down',
            'check', 'x', 'alert-circle', 'alert-triangle', 'info-circle',
            'circle-check', 'bell', 'user', 'settings', 'search',
            'menu-2', 'chevron-down', 'eye', 'eye-off', 'calendar',
        ];
    }
}
