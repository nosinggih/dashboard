import {
    Chart,
    BarController,
    BarElement,
    CategoryScale,
    LinearScale,
    Legend,
    Tooltip,
} from 'chart.js';

Chart.register(BarController, BarElement, CategoryScale, LinearScale, Legend, Tooltip);

const canvas = document.querySelector('[data-js="cashflow-chart"]');

if (canvas) {
    const data = JSON.parse(canvas.dataset.chart);
    const style = getComputedStyle(document.documentElement);
    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const formatRupiah = (value) => `Rp ${new Intl.NumberFormat('id-ID').format(value)}`;

    new Chart(canvas, {
        type: 'bar',
        data: {
            labels: data.labels,
            datasets: [
                {
                    label: 'Pemasukan',
                    data: data.pemasukan,
                    backgroundColor: style.getPropertyValue('--color-positive').trim(),
                    borderRadius: 4,
                    maxBarThickness: 28,
                },
                {
                    label: 'Pengeluaran',
                    data: data.pengeluaran,
                    backgroundColor: style.getPropertyValue('--color-negative').trim(),
                    borderRadius: 4,
                    maxBarThickness: 28,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: reducedMotion ? false : { duration: 180 },
            scales: {
                x: { grid: { display: false } },
                y: {
                    ticks: { callback: (value) => formatRupiah(value) },
                    grid: { color: style.getPropertyValue('--color-border').trim() },
                },
            },
            plugins: {
                legend: { position: 'bottom', labels: { color: style.getPropertyValue('--color-text-secondary').trim() } },
                tooltip: { callbacks: { label: (ctx) => `${ctx.dataset.label}: ${formatRupiah(ctx.parsed.y)}` } },
            },
        },
    });
}
