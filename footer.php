<footer class="bg-slate-800 text-slate-400 py-8">
    <div class="container mx-auto px-6 text-center">
        <p>&copy; <?php echo date('Y'); ?> <?php echo esc_html(get_theme_mod('brand_name', 'UmrohWeb ID')); ?>. All Rights Reserved.</p>
    </div>
</footer>

<!-- Tombol WhatsApp Melayang -->
<?php 
$whatsapp_number = get_theme_mod('contact_whatsapp', '6281283596622');
// Pastikan nomor tidak kosong sebelum menampilkan tombol
if (!empty($whatsapp_number)): 
?>
<a href="https://api.whatsapp.com/send?phone=<?php echo esc_attr($whatsapp_number); ?>&text=Halo%2C%20saya%20tertarik%20dengan%20jasa%20pembuatan%20website%20umroh%20Anda."
   target="_blank"
   class="fixed bottom-6 right-6 bg-green-500 w-16 h-16 rounded-full flex items-center justify-center shadow-lg hover:bg-green-600 transition-transform duration-300 hover:scale-110 z-50"
   aria-label="Hubungi via WhatsApp">
    <svg class="w-9 h-9 text-white" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.487 5.235 3.487 8.413 0 6.557-5.338 11.892-11.894 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.886-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.626.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
    </svg>
</a>
<?php endif; ?>

<!-- Tombol Back to Top -->
<button id="backToTopBtn" class="hidden fixed bottom-24 right-6 bg-teal-600 w-16 h-16 rounded-full flex items-center justify-center shadow-lg hover:bg-teal-700 transition-opacity duration-300 z-50" aria-label="Kembali ke atas">
    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
</button>


<?php wp_footer(); ?>

<script>
// Fungsi untuk tombol WhatsApp di bagian Portofolio
function pesanViaWhatsapp(button) {
    const baseUrl = "https://api.whatsapp.com/send";
    const phone = "<?php echo esc_html(get_theme_mod('contact_whatsapp', '6281283596622')); ?>";
    const urlToShare = button.getAttribute('data-url');
    const message = `Halo, saya mau pesan website seperti ini, dengan url: ${urlToShare}`;
    const encodedMessage = encodeURIComponent(message);
    window.open(`${baseUrl}?phone=${phone}&text=${encodedMessage}`, '_blank');
}

// === FUNGSI BARU UNTUK MODAL PREVIEW PORTFOLIO ===
function openPortfolioModal(url, title) {
    const modal = document.getElementById('portfolioModal');
    const iframe = document.getElementById('portfolioFrame');
    const modalTitle = document.getElementById('modalTitle');
    const modalContent = modal.querySelector('.transform');

    if(modal && iframe && modalTitle) {
        iframe.src = url;
        modalTitle.textContent = 'Live Preview: ' + title;
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden'; // Mencegah scroll background
        
        // Efek transisi saat modal muncul
        setTimeout(() => {
            modal.classList.add('opacity-100');
            modalContent.classList.remove('scale-95');
        }, 10);
    }
}

function closePortfolioModal() {
    const modal = document.getElementById('portfolioModal');
    const iframe = document.getElementById('portfolioFrame');
    const modalContent = modal.querySelector('.transform');
    
    if(modal && iframe) {
        // Efek transisi saat modal hilang
        modal.classList.remove('opacity-100');
        modalContent.classList.add('scale-95');
        
        setTimeout(() => {
            modal.classList.add('hidden');
            iframe.src = ''; // Menghentikan loading iframe
            document.body.style.overflow = ''; // Mengembalikan scroll background
        }, 300); // Sesuaikan dengan durasi transisi
    }
}

// Menjalankan skrip setelah semua konten halaman dimuat
document.addEventListener('DOMContentLoaded', function () {
    // Fungsi untuk Accordion di bagian FAQ
    const faqItems = document.querySelectorAll('.faq-item');
    
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        const answer = item.querySelector('.faq-answer');
        const icon = question.querySelector('svg');

        question.addEventListener('click', () => {
            const isHidden = answer.classList.contains('hidden');
            
            if (isHidden) {
                answer.classList.remove('hidden');
                icon.classList.add('rotate-180');
            } else {
                answer.classList.add('hidden');
                icon.classList.remove('rotate-180');
            }
        });
    });

    // === FUNGSI UNTUK ANIMASI FADE-IN SAAT SCROLL ===
    const observerOptions = {
        root: null, // Mengamati persimpangan relatif terhadap viewport
        rootMargin: '0px',
        threshold: 0.1 // Memicu saat 10% elemen terlihat
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target); // Berhenti mengamati setelah elemen terlihat
            }
        });
    }, observerOptions);

    // Temukan semua elemen yang akan dianimasikan dan mulai amati
    const elementsToAnimate = document.querySelectorAll('.fade-in-element');
    elementsToAnimate.forEach(element => {
        observer.observe(element);
    });

    // === FUNGSI UNTUK SMOOTH SCROLL SAAT KLIK NAVIGASI ===
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            // Cek jika link bukan hanya '#' saja
            if (this.getAttribute('href') !== '#') {
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                
                if(targetElement) {
                    e.preventDefault(); // Mencegah perpindahan instan
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });

    // === FUNGSI BARU UNTUK TOMBOL BACK TO TOP ===
    const backToTopButton = document.getElementById('backToTopBtn');

    if (backToTopButton) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                backToTopButton.classList.remove('hidden');
            } else {
                backToTopButton.classList.add('hidden');
            }
        });

        backToTopButton.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
});

// Menutup modal jika menekan tombol Escape
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closePortfolioModal();
    }
});
</script>

</body>
</html>

