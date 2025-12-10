<footer class="bg-slate-900 text-slate-400 py-12 border-t border-slate-800">
    <div class="container mx-auto px-6 text-center">
        <?php if(is_singular('travel')): ?>
            <p class="mb-4 text-slate-500 text-sm">Website ini adalah bagian dari direktori travel umroh terpercaya.</p>
        <?php endif; ?>
        <p>&copy; <?php echo date('Y'); ?> <?php echo esc_html(get_theme_mod('brand_name', 'UmrohWeb ID')); ?>. All Rights Reserved.</p>
    </div>
</footer>

<!-- LOGIKA TOMBOL WHATSAPP MELAYANG -->
<?php 
// Default: Ambil dari Customizer
$whatsapp_number = get_theme_mod('contact_whatsapp', '6281283596622');
$wa_message = "Halo%2C%20saya%20tertarik%20dengan%20jasa%20pembuatan%20website%20umroh%20Anda.";

// JIKA HALAMAN TRAVEL: Ambil nomor travel tersebut
if ( is_singular('travel') ) {
    $travel_phone = get_post_meta( get_the_ID(), '_travel_phone', true );
    if ( !empty($travel_phone) ) {
        $whatsapp_number = $travel_phone;
        $wa_message = "Assalamu'alaikum%2C%20saya%20tertarik%20info%20umroh%20dari%20web%20travel%20Anda.";
    }
}

// Tampilkan tombol jika nomor ada
if (!empty($whatsapp_number)): 
?>
<a href="https://api.whatsapp.com/send?phone=<?php echo esc_attr($whatsapp_number); ?>&text=<?php echo $wa_message; ?>"
   target="_blank"
   class="fixed bottom-6 right-6 bg-green-500 w-14 h-14 md:w-16 md:h-16 rounded-full flex items-center justify-center shadow-xl hover:bg-green-600 transition-transform duration-300 hover:scale-110 z-50 group"
   aria-label="Hubungi via WhatsApp">
    <!-- Tooltip -->
    <span class="absolute right-full mr-3 bg-slate-800 text-white text-xs px-3 py-1.5 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
        Chat WhatsApp
    </span>
    <svg class="w-8 h-8 md:w-9 md:h-9 text-white" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.487 5.235 3.487 8.413 0 6.557-5.338 11.892-11.894 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.886-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.626.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
    </svg>
</a>
<?php endif; ?>

<?php wp_footer(); ?>

<script>
// Fungsi Modal Preview (Untuk Halaman Utama)
function openPortfolioModal(url, title) {
    const modal = document.getElementById('portfolioModal');
    const iframe = document.getElementById('portfolioFrame');
    const modalTitle = document.getElementById('modalTitle');
    
    if(modal && iframe) {
        iframe.src = url;
        if(modalTitle) modalTitle.textContent = 'Preview: ' + title;
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
}

function closePortfolioModal() {
    const modal = document.getElementById('portfolioModal');
    const iframe = document.getElementById('portfolioFrame');
    
    if(modal && iframe) {
        modal.classList.add('hidden');
        iframe.src = '';
        document.body.style.overflow = '';
    }
}

// Tutup modal dengan tombol ESC
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') closePortfolioModal();
});
</script>
</body>
</html>