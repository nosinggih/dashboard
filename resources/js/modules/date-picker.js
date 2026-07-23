import AirDatepicker from 'air-datepicker';
import 'air-datepicker/air-datepicker.css';

const idLocale = {
    days: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
    daysShort: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
    daysMin: ['Mg', 'Sn', 'Sl', 'Rb', 'Km', 'Jm', 'Sb'],
    months: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
    monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
    today: 'Hari ini',
    clear: 'Hapus',
    dateFormat: 'dd/MM/yyyy',
    timeFormat: 'hh:mm',
    firstDay: 1,
};

document.querySelectorAll('[data-js="date-input"]').forEach((input) => {
    new AirDatepicker(input, {
        locale: idLocale,
        dateFormat: 'dd/MM/yyyy',
        autoClose: true,
        isMobile: false,
    });
});
