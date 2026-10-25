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
    if (slide && typeof sliderImages !== 'undefined' && sliderImages.length > 0) {
        let index = 0;
        
        // Set gambar pertama
        slide.src = sliderImages[0];
        
        function change(n) {
            index = (index + n + sliderImages.length) % sliderImages.length;
            slide.src = sliderImages[index];
        }
        
        const prevBtn = document.querySelector('.prev');
        const nextBtn = document.querySelector('.next');
        
        if (prevBtn) prevBtn.onclick = () => change(-1);
        if (nextBtn) nextBtn.onclick = () => change(1);
    }

    // Form Kontak
    const form = document.querySelector('#contact');
    if (form) {
        form.addEventListener('submit', e => {
            e.preventDefault();
            const data = new FormData(form);
            const body = `Nama: ${data.get('name')}\nEmail: ${data.get('email')}\n\n${data.get('message')}`;
            location.href = 'mailto:marketing@cyberlabs.co.id?subject=' + encodeURIComponent(data.get('subject')) + '&body=' + encodeURIComponent(body);
            const status = document.querySelector('#form-status');
            if (status) status.textContent = 'Lanjutkan pengiriman melalui aplikasi email Anda. Pesan belum dikirim dari website.';
        });
    }

    // === STICKY NAVBAR & BACK TO TOP PROGRESS ===
    const stickyNavbar = document.getElementById('stickyNavbar');
    const backToTop = document.getElementById('backToTop');
    const progressCircle = document.querySelector('.progress-circle-path');
    
    const scrollTrigger = 400; // px

    if (stickyNavbar || backToTop) {
        window.addEventListener('scroll', function () {
            const scrollY = window.scrollY;
            
            // Menghitung total tinggi halaman yang bisa di-scroll
            const scrollHeight = document.documentElement.scrollHeight - window.innerHeight;
            
            // Menghitung persentase scroll (0.0 sampai 1.0)
            const scrollPercentage = scrollHeight > 0 ? (scrollY / scrollHeight) : 0;

            // Sticky navbar
            if (stickyNavbar) {
                if (scrollY > scrollTrigger) {
                    stickyNavbar.classList.add('show');
                } else {
                    stickyNavbar.classList.remove('show');
                }
            }

            // Back to top & Progress Ring
            if (backToTop) {
                if (scrollY > scrollTrigger) {
                    backToTop.classList.add('show');
                } else {
                    backToTop.classList.remove('show');
                }

                // Update cincin progres
                if (progressCircle) {
                    const radius = progressCircle.r.baseVal.value;
                    const circumference = 2 * Math.PI * radius;
                    // Menghitung offset (semakin besar scroll, cincin semakin penuh)
                    const offset = circumference - (scrollPercentage * circumference);
                    progressCircle.style.strokeDashoffset = offset;
                }
            }
        }, { passive: true });

        // Back to top click
        if (backToTop) {
            backToTop.addEventListener('click', function () {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }
    }

    // =========================================
    // ALPINE COMPONENT: IMAGE UPLOAD
    // =========================================
    document.addEventListener('alpine:init', () => {
        Alpine.data('imageUpload', (existingImage) => ({
            previewUrl: existingImage ? existingImage : null,
            dragover: false,
            
            handleDrop(e) {
                this.dragover = false;
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    this.$refs.fileInput.files = files;
                    this.handleFileSelect({ target: this.$refs.fileInput });
                }
            },
            
            handleFileSelect(e) {
                const file = e.target.files[0];
                if (file) {
                    if (file.size > 2 * 1024 * 1024) {
                        alert('Ukuran file terlalu besar. Maksimal 2MB.');
                        this.$refs.fileInput.value = '';
                        return;
                    }
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.previewUrl = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            },
            
            removeImage() {
                this.previewUrl = null;
                this.$refs.fileInput.value = '';
            },

            reset() {
                this.previewUrl = null;
                this.$refs.fileInput.value = '';
                this.dragover = false;
            }
        }));
    });

        // =========================================
    // SCROLL ANIMATION (STAGGERED SLIDE UP)
    // =========================================
    
    document.body.classList.add('js-enabled');

    // Pilih semua section utama (termasuk hero, header, footer)
    const sections = document.querySelectorAll('section, .home-hero, header, footer');
    
    sections.forEach(section => {
        // Tentukan elemen komponen apa saja yang mau dianimasikan di dalam section ini
        // Kita targetkan elemen blok utama agar animasinya rapi (tidak menimpa satu sama lain)
        const elementsToAnimate = section.querySelectorAll(
            '.hero-copy > *, .wrap > *, .two-cols > *, .home-news > *, .news-grid > *, .gallery > *, .food-grid > *, .intro > *'
        );
        
        // Bersihkan duplikasi elemen (jika ada elemen yang terpilih dua kali)
        const uniqueElements = [...new Set(elementsToAnimate)];

        // Tambahkan class dasar dan atur delay berurutan
        uniqueElements.forEach((el, index) => {
            el.classList.add('animate-item');
            
            // Berikan jeda (delay) kelipatan 0.15 detik per elemen
            // Batasi maksimal delay 0.6s agar tidak terlalu lama menunggu
            const delay = Math.min(index * 0.15, 0.6); 
            el.style.setProperty('--delay', `${delay}s`);
        });

        // Observer untuk mendeteksi scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Saat section masuk layar, munculkan semua elemen di dalamnya
                    const items = entry.target.querySelectorAll('.animate-item');
                    items.forEach(item => {
                        item.classList.add('is-visible');
                    });
                    // Hentikan pengamatan setelah animasi berjalan
                    observer.unobserve(entry.target);
                }
            });
        }, { 
            threshold: 0.1, // Animasi mulai saat 10% section terlihat
            rootMargin: '0px 0px -50px 0px' // Sedikit trigger lebih awal
        });

        // Pantau setiap section
        observer.observe(section);
    });
});