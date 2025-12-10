<?php
/*
Template Name: Landing Page Murah
*/
get_header(); 

// Ambil URL gambar background dari Customizer
$lp_hero_bg_url = get_theme_mod('lp_hero_background_image', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQts2L5azd-w__rcHyczBf8ZReJ7zDnHL1Q1RoCkZn5oPlr-Tf5cKNmWBYfqzQGTpa8oo0&usqp=CAU');

// --- AMBIL DATA BARU UNTUK CONTOH UPGRADE ---
$upgrade_title = get_theme_mod('lp_upgrade_example_title', 'Contoh Website Paket Gold');
$upgrade_url = get_theme_mod('lp_upgrade_example_url', 'https://jannahfirdausumroh.com');
$upgrade_image = get_theme_mod('lp_upgrade_example_image', 'https://placehold.co/600x400/0d9488/ffffff?text=Contoh+Website+Lengkap');
// --- AKHIR PENGAMBILAN DATA ---
?>

<!-- Style Khusus untuk Background Hero Landing Page --><style>
    html {
        scroll-behavior: smooth; /* Memastikan smooth scroll untuk link #upgrade */
    }
    .lp-hero-bg {
        /* Gunakan gambar dari Customizer, jika tidak ada, gunakan warna teal */
        <?php if (!empty($lp_hero_bg_url)): ?>
            background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('<?php echo esc_url($lp_hero_bg_url); ?>');
            background-size: cover;
            background-position: center;
        <?php else: ?>
            background-color: #0d9488; /* Warna teal-600 */
        <?php endif; ?>
    }
</style>


    <!-- Hero Section - Penawaran Landing Page --><!-- PERBAIKAN: Ukuran font judul di mobile diubah (text-3xl) --><section class="lp-hero-bg text-white py-20 md:py-32 min-h-[60vh] flex flex-col items-center justify-center">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-3xl md:text-6xl font-extrabold leading-tight mb-4"><?php echo esc_html(get_theme_mod('lp_hero_title', 'Mulai Online Hanya dengan Rp 499.000')); ?></h1>
            <p class="text-lg md:text-xl text-slate-200 mb-8 max-w-3xl mx-auto"><?php echo esc_html(get_theme_mod('lp_hero_subtitle', 'Dapatkan Landing Page profesional untuk travel Anda. Cepat, fokus, dan siap menjaring jamaah!')); ?></p>
            <a href="#detail-paket" class="bg-amber-500 text-slate-900 font-bold px-8 py-4 rounded-lg text-lg hover:bg-amber-600 transition duration-300">Lihat Detail Paket</a>
        </div>
    </section>

    <!-- Section: Kenapa Anda Butuh Ini? --><!-- PERBAIKAN: Ukuran font judul di mobile diubah (text-2xl) --><section class="py-16 md:py-20 bg-white">
        <div class="container mx-auto px-6 max-w-6xl">
            <h2 class="text-2xl md:text-3xl font-bold text-center text-slate-800 mb-12 md:mb-16"><?php echo esc_html(get_theme_mod('lp_why_title', 'Kenapa Travel Anda Wajib Punya Landing Page?')); ?></h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 md:gap-12">
                
                <!-- Alasan 1 --><div class="text-center fade-in-element">
                    <div class="bg-teal-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-5 shadow-inner">
                        <svg class="w-10 h-10 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-800 mb-2"><?php echo esc_html(get_theme_mod('lp_why_title_1', 'Mulai Online Super Cepat')); ?></h3>
                    <p class="text-slate-600"><?php echo esc_html(get_theme_mod('lp_why_desc_1', 'Tidak perlu menunggu lama. Dalam 1-2 hari kerja, halaman promo Anda siap digunakan untuk iklan digital atau promosi di media sosial.')); ?></p>
                </div>
                
                <!-- Alasan 2 --><div class="text-center fade-in-element">
                    <div class="bg-teal-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-5 shadow-inner">
                        <!-- ICON BARU: Target (Bullseye) --><svg class="w-10 h-10 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-800 mb-2"><?php echo esc_html(get_theme_mod('lp_why_title_2', 'Fokus Menjual 1 Penawaran')); ?></h3>
                    <p class="text-slate-600"><?php echo esc_html(get_theme_mod('lp_why_desc_2', 'Landing page didesain khusus untuk fokus pada satu tujuan: membuat pengunjung mendaftar paket umroh yang sedang Anda promosikan.')); ?></p>
                </div>

                <!-- Alasan 3 --><div class="text-center fade-in-element">
                    <div class="bg-teal-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-5 shadow-inner">
                        <svg class="w-10 h-10 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-800 mb-2"><?php echo esc_html(get_theme_mod('lp_why_title_3', 'Membangun Kepercayaan Awal')); ?></h3>
                    <p class="text-slate-600"><?php echo esc_html(get_theme_mod('lp_why_desc_3', 'Daripada hanya promosi di sosmed, memiliki halaman website (meski 1 halaman) membuat bisnis travel Anda terlihat jauh lebih profesional dan terpercaya.')); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Detail Paket Landing Page --><!-- PERBAIKAN: Menyesuaikan padding dan max-width --><section id="detail-paket" class="py-16 md:py-20 bg-slate-50">
        <div class="container mx-auto px-6 max-w-xl">
            <!-- PERBAIKAN: Menambahkan efek hover --><div class="bg-white rounded-xl shadow-xl p-8 md:p-10 fade-in-element transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                <h2 class="text-2xl font-bold text-center text-slate-800 mb-4"><?php echo esc_html(get_theme_mod('lp_package_title', 'Paket Landing Page Promo')); ?></h2>
                <p class="text-center mb-6">
                    <!-- PERBAIKAN: Ukuran font harga di mobile diubah (text-3xl) --><span class="text-3xl md:text-4xl font-extrabold text-teal-600"><?php echo esc_html(get_theme_mod('lp_price_new', 'Rp 499.000')); ?></span>
                    <!-- PERBAIKAN: Ukuran font harga coret di mobile diubah (text-lg) --><span class="text-lg md:text-xl text-slate-400 line-through ml-2"><?php echo esc_html(get_theme_mod('lp_price_old', 'Rp 750.000')); ?></span>
                </p>
                <p class="text-center text-slate-500 mb-6"><?php echo esc_html(get_theme_mod('lp_price_note', '(Sekali Bayar)')); ?></p>
                
                <ul class="space-y-4 text-slate-600 mb-8">
                    <?php 
                    $features = explode("\n", get_theme_mod('lp_features', "1 Halaman Website Profesional\nDesain Modern & Responsif (Mobile Friendly)\nGratis Subdomain (cth: travelanda.umrohweb.id)\nGratis Hosting 1 Tahun\nTombol Chat WhatsApp\nMasa Pengerjaan Cepat (1-2 Hari Kerja)"));
                    foreach($features as $feature): if(!empty(trim($feature))): 
                    ?>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 text-teal-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span><?php echo esc_html(trim($feature)); ?></span>
                    </li>
                    <?php endif; endforeach; ?>
                </ul>

                <!-- BATASAN PAKET PROMO --><div class="bg-amber-50 border border-amber-200 rounded-lg p-4 mb-6">
                    <h4 class="font-bold text-amber-800 mb-2 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        <?php echo esc_html(get_theme_mod('lp_restrictions_title', 'Penting: Batasan Paket Promo')); ?>
                    </h4>
                    <ul class="text-sm text-amber-700 space-y-2 list-none pl-0">
                         <?php 
                        $restrictions = explode("\n", get_theme_mod('lp_restrictions', "Tidak Termasuk Admin Panel. Klien tidak bisa login dan mengedit harga/konten paket sendiri.\nWebsite bersifat statis. Update konten atau harga dilakukan via admin kami (dikenakan biaya maintenance).\n*Solusi Terbaik: Upgrade ke Paket Silver kapan saja agar bisa kelola sendiri!"));
                        foreach($restrictions as $restriction): 
                            $restriction_text = esc_html(trim(str_replace('*', '', $restriction)));
                            // --- PERUBAHAN DI SINI (Warna Tombol Upgrade) ---
                            if(strpos(trim($restriction), '*') === 0):
                        ?>
                            <li class="mt-3">
                                <a href="#upgrade" class="inline-block bg-amber-500 text-slate-900 font-bold py-2 px-4 rounded-lg text-sm hover:bg-amber-600 transition-transform hover:scale-105 shadow">
                                    <?php echo $restriction_text; ?>
                                </a>
                            </li>
                        <?php else: ?>
                            <li><?php echo $restriction_text; ?></li>
                        <?php endif; endforeach; ?>
                        <!-- --- AKHIR PERUBAHAN --- --></ul>
                </div>

                <a href="https://api.whatsapp.com/send?phone=<?php echo esc_html(get_theme_mod('contact_whatsapp', '6281283596622')); ?>&text=Halo%2C%2C%20saya%20tertarik%20dengan%20Paket%20Landing%20Page%20Promo%20Rp%20499.000." target="_blank" class="block w-full text-center bg-teal-600 text-white font-bold py-3 px-6 rounded-lg shadow hover:bg-teal-700 hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition-all duration-300">
                    <?php echo esc_html(get_theme_mod('lp_package_button', 'Pesan Paket Landing Page')); ?>
                </a>
            </div>
        </div>
    </section>

    <!-- Penjelasan Upgrade --><!-- PERBAIKAN: Background diubah ke bg-slate-800 agar lebih mencolok --><section id="upgrade" class="py-16 md:py-20 bg-slate-800">
        <div class="container mx-auto px-6 max-w-6xl">
            <!-- PERBAIKAN: Ukuran font judul di mobile diubah (text-2xl) --><h2 class="text-2xl md:text-3xl font-bold text-center text-white mb-12 md:mb-16">Siap Berkembang? <span class="text-amber-400"><?php echo esc_html(get_theme_mod('lp_upgrade_title', 'Upgrade Kapan Saja!')); ?></span></h2>
            
            <!-- PERBAIKAN: Background card diubah jadi putih (kontras) --><div class="bg-white rounded-xl shadow-lg p-8 md:p-12 fade-in-element">
                <!-- PERBAIKAN: Grid 5 kolom untuk layout yg lebih seimbang --><div class="grid grid-cols-1 md:grid-cols-5 gap-8 md:gap-16 items-center">
                    
                    <!-- Kolom Teks (3 kolom) --><div class="md:col-span-3">
                        <h3 class="text-2xl font-bold text-slate-800 mb-4"><?php echo esc_html(get_theme_mod('lp_upgrade_title', 'Bagaimana Cara Upgrade?')); ?></h3>
                        <p class="text-slate-600 mb-6"><?php echo esc_html(get_theme_mod('lp_upgrade_desc', 'Paket Landing Page ini adalah langkah awal. Kapanpun bisnis Anda siap, Anda bisa langsung upgrade ke website penuh (seperti Paket Silver/Gold) hanya dengan membayar selisihnya.')); ?></p>
                        
                        <h4 class="text-lg font-semibold text-slate-800 mb-3"><?php echo esc_html(get_theme_mod('lp_upgrade_features_title', 'Apa yang Anda dapatkan saat Upgrade?')); ?></h4>
                        <ul class="space-y-3 text-slate-600">
                             <?php 
                            $upg_features = explode("\n", get_theme_mod('lp_upgrade_features', "Domain .com profesional (bukan subdomain).\nBanyak Halaman (Home, Profil, Paket, Galeri, Kontak).\nBisa pilih desain yang lebih lengkap dari portofolio.\nAnda bisa mengelola konten sendiri via Admin Panel."));
                            foreach($upg_features as $upg_feature): if(!empty(trim($upg_feature))): 
                            ?>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-teal-500 mr-2 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span><?php echo esc_html(trim($upg_feature)); ?></span>
                            </li>
                            <?php endif; endforeach; ?>
                        </ul>
                    </div>
                    
                    <!-- Kolom Gambar & Tombol (2 kolom) --><!-- PERBAIKAN: Penyesuaian margin dan layout tombol --><div class="md:col-span-2 text-center mt-6 md:mt-0">
                        <!-- Image Container --><div class="rounded-lg overflow-hidden shadow-xl mb-5 group transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                            <img src="<?php echo esc_url($upgrade_image); ?>" 
                                 alt="Tampilan Website <?php echo esc_attr($upgrade_title); ?>" 
                                 class="w-full h-auto object-cover object-top transition-transform duration-500 group-hover:scale-105">
                        </div>
                        
                        <!-- Title --><h3 class="text-2xl font-extrabold text-slate-800 mb-5 tracking-tight"><?php echo esc_html($upgrade_title); ?></h3>
            
                        <!-- Button Container --><div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <button onclick="openPortfolioModal('<?php echo esc_url($upgrade_url); ?>', '<?php echo esc_js($upgrade_title); ?>')" class="w-full text-center bg-white border-2 border-slate-300 text-slate-700 font-bold py-3 px-5 rounded-lg hover:bg-slate-100 transition duration-300">
                                Lihat Live
                            </button>
                            <a href="https://api.whatsapp.com/send?phone=<?php echo esc_html(get_theme_mod('contact_whatsapp', '6281283596622')); ?>&text=Halo%2C%20saya%20tertarik%20untuk%20upgrade%20website%20saya%20ke%20paket%20lengkap%20seperti%20<?php echo urlencode($upgrade_title); ?>." target="_blank" class="w-full text-center bg-teal-600 text-white font-bold py-3 px-5 rounded-lg hover:bg-teal-700 transition duration-300 shadow hover:-translate-y-0.5">
                                Saya Mau Ini
                            </a>
                        </div>
                    </div>
                    <!-- AKHIR CONTOH WEBSITE UPGRADE --></div>
            </div>
        </div>
    </section>

    <!-- Final CTA Section --><!-- PERBAIKAN: Ukuran font judul di mobile diubah (text-2xl) --><section id="kontak-promo" class="py-20 md:py-24 bg-slate-800">
        <div class="container mx-auto px-6 text-center">
            <div class="max-w-3xl mx-auto fade-in-element">
                <h2 class="text-2xl md:text-4xl font-extrabold mb-4 leading-tight text-white"><?php echo esc_html(get_theme_mod('lp_cta_title', 'Jangan Tunda Lagi, Mulai Sekarang!')); ?></h2>
                <p class="text-lg text-slate-300 mb-8"><?php echo esc_html(get_theme_mod('lp_cta_subtitle', 'Amankan harga promo Rp 499.000 hari ini juga. Klik tombol di bawah untuk konsultasi gratis dan pesan Landing Page Anda.')); ?></p>
                <a href="https://api.whatsapp.com/send?phone=<?php echo esc_html(get_theme_mod('contact_whatsapp', '6281283596622')); ?>&text=Halo%2C%20saya%20tertarik%20dengan%20Paket%20Landing%20Page%20Promo%20Rp%20499.000." target="_blank" class="bg-amber-500 text-slate-900 font-bold px-8 py-4 rounded-lg text-lg hover:bg-amber-600 transition duration-300 inline-block">
                    <?php echo esc_html(get_theme_mod('lp_package_button', 'Pesan Paket Landing Page')); ?>
                </a>
            </div>
        </div>
    </section>

<?php get_footer(); ?>

