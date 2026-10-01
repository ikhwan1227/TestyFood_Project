import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// =========================================
// CUSTOM JS TASTY FOOD
// =========================================
document.addEventListener('DOMContentLoaded', () => {
    // Mobile Menu Toggle
    const menu = document.querySelector('.menu');
    if (menu) {
        menu.addEventListener('click', () => {
            const open = document.querySelector('nav').classList.toggle('open');
            menu.setAttribute('aria-expanded', open);
        });
    }

    // Lightbox
    const lightbox = document.querySelector('#lightbox');
    if (lightbox) {
        document.querySelectorAll('.photo').forEach(btn => {
            btn.addEventListener('click', () => {
                lightbox.querySelector('img').src = btn.querySelector('img').src;
                lightbox.showModal();
            });
        });
        lightbox.querySelector('.close').onclick = () => lightbox.close();
        lightbox.onclick = e => {
            if (e.target === lightbox) lightbox.close();
        };
    }

    // Slider Galeri
    const slide = document.querySelector('#slide');
    if (slide) {
        const photos = ['ella-olsson-mmnKI8kMxpc', 'brooke-lark-oaz0raysASk', 'eiliv-aceron-ZuIDLSz3XLg'];
        let index = 0;
        function change(n) {
            index = (index + n + photos.length) % photos.length;
            slide.src = '/assets/' + photos[index] + '-unsplash.webp';
        }
        const prevBtn = document.querySelector('.prev');
        const nextBtn = document.querySelector('.next');
        if (prevBtn) prevBtn.onclick = () => change(-1);
        if (nextBtn) nextBtn.onclick = () => change(1);
    }

    // Article Read More Toggle
    const article = document.querySelector('#article-open');
    if (article) {
        article.onclick = () => {
            const extra = document.querySelector('#article-extra');
            extra.hidden = !extra.hidden;
            article.textContent = extra.hidden ? 'BACA SELENGKAPNYA' : 'TUTUP ARTIKEL';
        };
    }

    // Form Kontak
    const form = document.querySelector('#contact');
    if (form) {
        form.addEventListener('submit', e => {
            e.preventDefault();
            const data = new FormData(form);
            const body = `Nama: ${data.get('name')}\nEmail: ${data.get('email')}\n\n${data.get('message')}`;
            location.href = 'mailto:tastyfood@gmail.com?subject=' + encodeURIComponent(data.get('subject')) + '&body=' + encodeURIComponent(body);
            const status = document.querySelector('#form-status');
            if (status) status.textContent = 'Lanjutkan pengiriman melalui aplikasi email Anda. Pesan belum dikirim dari website.';
        });
    }
});