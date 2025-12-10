<?php get_header(); ?>

    <!-- Hero Section -->
    <section class="hero-bg text-white py-20 md:py-32">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-4"><?php echo esc_html(get_theme_mod('hero_title', 'Miliki Website Travel Umroh Profesional Sekarang Juga')); ?></h1>
            <p class="text-lg md:text-xl text-slate-200 mb-8 max-w-3xl mx-auto"><?php echo esc_html(get_theme_mod('hero_subtitle', 'Tingkatkan kepercayaan jamaah dan jangkau pasar lebih luas dengan website yang modern, cepat, dan mudah dikelola.')); ?></p>
            <a href="#desain" class="bg-amber-500 text-slate-900 font-bold px-8 py-4 rounded-lg text-lg hover:bg-amber-600 transition duration-300">Lihat Portofolio Kami</a>
        </div>
    </section>

    <!-- Keunggulan Section (Fokus Manfaat) -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-slate-800 mb-12"><?php echo esc_html(get_theme_mod('benefits_section_title', 'Bukan Sekedar Website, Tapi Solusi Bisnis Anda')); ?></h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php
                $benefit_icons = [
                    '<svg class="w-10 h-10 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>',
                    '<svg class="w-10 h-10 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>',
                    '<svg class="w-10 h-10 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
                    '<svg class="w-10 h-10 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>'
                ];
                for ($i = 1; $i <= 4; $i++): 
                    $title = get_theme_mod("benefit_title_$i");
                    $desc = get_theme_mod("benefit_desc_$i");
                ?>
                <div class="text-center p-6 fade-in-element">
                    <div class="bg-teal-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4"><?php echo $benefit_icons[$i-1]; ?></div>
                    <h3 class="text-xl font-semibold text-slate-800 mb-2"><?php echo esc_html($title); ?></h3>
                    <p class="text-slate-600"><?php echo esc_html($desc); ?></p>
                </div>
                <?php endfor; ?>
            </div>
        </div>
    </section>

    <!-- Proses Kerja Section -->
    <section class="py-16 bg-slate-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-slate-800 mb-2"><?php echo esc_html(get_theme_mod('process_section_title', 'Hanya 3 Langkah Mudah Punya Website Impian')); ?></h2>
            <p class="text-center text-slate-600 mb-12 max-w-2xl mx-auto">Kami membuat prosesnya sederhana untuk Anda, sehingga Anda bisa fokus pada bisnis utama Anda.</p>
            <div class="relative">
                <div class="hidden md:block absolute top-1/2 left-0 w-full h-0.5 bg-teal-200 transform -translate-y-1/2"></div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12 relative">
                    <?php for ($i = 1; $i <= 3; $i++): 
                        $title = get_theme_mod("process_title_$i");
                        $desc = get_theme_mod("process_desc_$i");
                    ?>
                    <div class="text-center fade-in-element">
                        <div class="bg-teal-500 text-white rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4 text-3xl font-bold border-4 border-slate-50 relative z-10"><?php echo $i; ?></div>
                        <h3 class="text-xl font-semibold text-slate-800 mb-2"><?php echo esc_html($title); ?></h3>
                        <p class="text-slate-600"><?php echo esc_html($desc); ?></p>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Section (REVISED) -->
    <section id="desain" class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-slate-800 mb-2"><?php echo esc_html(get_theme_mod('portfolio_section_title', 'Desain Profesional & Modern')); ?></h2>
            <p class="text-center text-slate-600 mb-12 max-w-2xl mx-auto"><?php echo esc_html(get_theme_mod('portfolio_section_subtitle', 'Pilih desain yang paling Anda sukai. Setiap desain kami buat agar cepat, responsif, dan mudah digunakan oleh calon jamaah Anda.')); ?></p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php 
                $portfolio_count = get_theme_mod('portfolio_item_count', 7); 
                for ($i = 1; $i <= $portfolio_count; $i++): 
                    $portfolio_url = get_theme_mod("portfolio_url_$i"); 
                    $portfolio_title = get_theme_mod("portfolio_title_$i"); 
                    if (!empty($portfolio_url) && !empty($portfolio_title)): 
                ?>
                <div class="bg-white rounded-xl shadow-lg overflow-hidden group transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 fade-in-element">
                    <!-- Browser Frame -->
                    <div class="bg-slate-100 p-3 sm:p-4 border-b border-slate-200">
                        <!-- Browser Header -->
                        <div class="flex items-center pb-2 sm:pb-3">
                            <div class="flex space-x-1.5">
                                <span class="block w-3 h-3 rounded-full bg-red-400"></span>
                                <span class="block w-3 h-3 rounded-full bg-yellow-400"></span>
                                <span class="block w-3 h-3 rounded-full bg-green-400"></span>
                            </div>
                        </div>
                        <!-- Image Container -->
                        <div class="rounded-md overflow-hidden shadow-inner">
                            <img src="<?php echo esc_url(get_theme_mod("portfolio_image_$i", "https://placehold.co/600x400/0d9488/ffffff?text=Contoh+Desain+" . $i)); ?>" 
                                 alt="Tampilan Website <?php echo esc_attr($portfolio_title); ?>" 
                                 class="w-full h-48 object-cover object-top transition-transform duration-500 group-hover:scale-110">
                        </div>
                    </div>
                    <!-- Content -->
                    <div class="p-6">
                        <h3 class="text-xl font-extrabold text-slate-800 mb-4 tracking-tight"><?php echo esc_html($portfolio_title); ?></h3>
                        <!-- === PERBAIKAN TOMBOL PORTFOLIO === -->
                        <div class="grid grid-cols-2 gap-3">
                             <button onclick="openPortfolioModal('<?php echo esc_url($portfolio_url); ?>', '<?php echo esc_js($portfolio_title); ?>')" class="w-full text-center bg-slate-100 text-slate-700 font-semibold py-2.5 px-3 rounded-lg hover:bg-slate-200 transition duration-300 text-sm">
                                Lihat Live
                            </button>
                            <button onclick="pesanViaWhatsapp(this)" data-url="<?php echo esc_url($portfolio_url); ?>" class="w-full text-center bg-teal-600 text-white font-semibold py-2.5 px-3 rounded-lg hover:bg-teal-700 transition duration-300 text-sm">
                                Saya Mau Ini
                            </button>
                        </div>
                    </div>
                </div>
                <?php endif; endfor; ?>
            </div>
        </div>
    </section>


    <!-- Harga Section -->
    <section id="harga" class="py-16 bg-slate-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-slate-800 mb-2"><?php echo esc_html(get_theme_mod('harga_section_title', 'Paket Harga Transparan')); ?></h2>
            <p class="text-center text-slate-600 mb-12 max-w-2xl mx-auto"><?php echo esc_html(get_theme_mod('harga_section_subtitle', 'Pilih paket yang paling sesuai dengan kebutuhan dan anggaran bisnis travel Anda.')); ?></p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <?php for ($i = 1; $i <= 3; $i++): 
                    $nama = get_theme_mod("paket_{$i}_nama"); 
                    $subtitle = get_theme_mod("paket_{$i}_subtitle"); 
                    $harga = get_theme_mod("paket_{$i}_harga"); 
                    $fitur_list = explode("\n", get_theme_mod("paket_{$i}_fitur"));
                    $contoh_url = get_theme_mod("paket_{$i}_contoh_url");
                    $is_populer = ($i == 2 && get_theme_mod('paket_2_populer', true)); 
                    $card_classes = $is_populer ? 'bg-teal-600 text-white rounded-xl shadow-2xl p-8 flex flex-col ring-4 ring-amber-400 transform scale-105 relative' : 'bg-white rounded-xl shadow-lg p-8 flex flex-col';
                    
                    // --- STYLE TOMBOL KONSISTEN ---
                    $button_classes = $is_populer 
                        ? 'block w-full text-center bg-amber-400 text-slate-900 font-bold py-3 px-6 rounded-lg shadow-md hover:bg-amber-500 hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-400 transition-all duration-300' 
                        : 'block w-full text-center bg-teal-600 text-white font-bold py-3 px-6 rounded-lg shadow hover:bg-teal-700 hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition-all duration-300';
                    
                    $outline_button_classes = $is_populer 
                        ? 'block w-full text-center bg-transparent border-2 border-amber-400 text-amber-400 font-bold py-3 px-6 rounded-lg hover:bg-amber-400 hover:text-slate-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-400 transition-all duration-300' 
                        : 'block w-full text-center bg-transparent border-2 border-slate-300 text-slate-700 font-bold py-3 px-6 rounded-lg hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-400 transition-all duration-300';
                ?>
                <div class="<?php echo $card_classes; ?> fade-in-element">
                    <?php if ($is_populer): ?><p class="absolute top-0 -translate-y-1/2 left-1/2 -translate-x-1/2 bg-amber-400 text-slate-900 text-sm font-bold px-4 py-1 rounded-full">PALING POPULER</p><?php endif; ?>
                    <h3 class="text-2xl font-bold text-center mb-2"><?php echo esc_html($nama); ?></h3>
                    <p class="text-center <?php echo $is_populer ? 'text-teal-200' : 'text-slate-500'; ?> mb-6"><?php echo esc_html($subtitle); ?></p>
                    <p class="text-4xl font-extrabold text-center mb-6"><?php echo esc_html($harga); ?></p>
                    <ul class="space-y-4 <?php echo $is_populer ? 'text-teal-100' : 'text-slate-600'; ?> mb-8 flex-grow">
                        <?php foreach($fitur_list as $fitur_item): if(!empty(trim($fitur_item))): ?>
                        <li class="flex items-center"><svg class="w-5 h-5 <?php echo $is_populer ? 'text-amber-400' : 'text-teal-500'; ?> mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg><span><?php echo esc_html(trim($fitur_item)); ?></span></li>
                        <?php endif; endforeach; ?>
                    </ul>
                    <div class="mt-auto pt-4 space-y-3">
                         <a href="https://api.whatsapp.com/send?phone=<?php echo esc_html(get_theme_mod('contact_whatsapp', '6281283596622')); ?>&text=Halo%2C%20saya%20tertarik%20dengan%20<?php echo urlencode($nama); ?>%20pembuatan%20website%20umroh." target="_blank" class="<?php echo $button_classes; ?>">Pesan Sekarang</a>
                        <?php if (!empty($contoh_url)): ?>
                        <button onclick="openPortfolioModal('<?php echo esc_url($contoh_url); ?>', '<?php echo esc_js('Contoh ' . $nama); ?>')" class="<?php echo $outline_button_classes; ?>">
                            Contoh Website
                        </button>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endfor; ?>
            </div>
        </div>
    </section>
    
    <!-- Promo Section -->
    <?php if ( get_theme_mod( 'promo_show', true ) ) : ?>
    <section id="promo" class="py-16 bg-teal-600">
        <div class="container mx-auto px-6 text-center text-white">
            <div class="max-w-3xl mx-auto fade-in-element">
                <div class="mb-4">
                    <svg class="w-16 h-16 mx-auto text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h2 class="text-3xl md:text-4xl font-extrabold mb-4 leading-tight"><?php echo esc_html( get_theme_mod( 'promo_title', 'PROMO SPESIAL BULAN INI!' ) ); ?></h2>
                <p class="text-lg text-teal-100 mb-8"><?php echo nl2br( esc_html( get_theme_mod( 'promo_text', 'Pesan Paket Gold atau Platinum sebelum akhir bulan dan dapatkan GRATIS Lisensi Plugin Premium SEO (Senilai Rp 850.000) untuk membantu website Anda lebih mudah ditemukan di Google!' ) ) ); ?></p>
                <a href="#harga" class="bg-amber-400 text-slate-900 font-bold px-8 py-3 rounded-lg text-lg hover:bg-amber-500 transition duration-300">Klaim Promo Sekarang</a>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Testimoni Section (DIHAPUS) -->
    <?php /* if ( get_theme_mod( 'testimonial_show', true ) ) : ?>
    <section id="testimoni" class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-slate-800 mb-2"><?php echo esc_html(get_theme_mod('testimonial_title', 'Apa Kata Klien Kami')); ?></h2>
            <p class="text-center text-slate-600 mb-12 max-w-2xl mx-auto"><?php echo esc_html(get_theme_mod('testimonial_subtitle', 'Kepercayaan dan kepuasan mereka adalah prioritas utama kami.')); ?></p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <?php for ($i = 1; $i <= 3; $i++): 
                    $name = get_theme_mod("testimonial_name_$i");
                    $role = get_theme_mod("testimonial_role_$i");
                    $text = get_theme_mod("testimonial_text_$i");
                    $image = get_theme_mod("testimonial_image_$i");
                    if (!empty($name)):
                ?>
                <div class="bg-slate-50 rounded-lg p-8 flex flex-col items-center text-center fade-in-element">
                    <img class="w-24 h-24 rounded-full mb-4 object-cover ring-4 ring-teal-100" src="<?php echo esc_url($image ? $image : 'https.placehold.co/100x100/e2e8f0/64748b?text=' . substr($name, 0, 1)); ?>" alt="Foto <?php echo esc_attr($name); ?>">
                    <blockquote class="text-slate-600 italic mb-4 flex-grow">"<?php echo esc_html($text); ?>"</blockquote>
                    <cite class="font-bold text-slate-800 not-italic"><?php echo esc_html($name); ?></cite>
                    <span class="text-sm text-slate-500"><?php echo esc_html($role); ?></span>
                </div>
                <?php endif; endfor; ?>
            </div>
        </div>
    </section>
    <?php endif; */ ?>

    <!-- Syarat & Ketentuan dan Pembayaran Section (REVISED) -->
    <?php if ( get_theme_mod( 'tnc_payment_show', true ) ) : ?>
    <section id="syarat-ketentuan" class="py-16 bg-slate-50">
        <div class="container mx-auto px-6 max-w-5xl">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Kolom Syarat & Ketentuan -->
                <div class="fade-in-element">
                    <h2 class="text-2xl font-bold text-slate-800 mb-6 flex items-center"><svg class="w-6 h-6 mr-3 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg><?php echo esc_html(get_theme_mod('tnc_section_title', 'Syarat dan Ketentuan')); ?></h2>
                    <ul class="space-y-3 text-slate-600">
                        <?php $tnc_list = explode("\n", get_theme_mod('tnc_section_content')); foreach($tnc_list as $tnc_item): if(!empty(trim($tnc_item))): ?>
                        <li class="flex items-start"><svg class="w-5 h-5 mt-1 mr-3 text-teal-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg><span><?php echo esc_html(trim($tnc_item)); ?></span></li>
                        <?php endif; endforeach; ?>
                    </ul>
                </div>

                <!-- Kolom Metode Pembayaran -->
                <div class="fade-in-element">
                     <h2 class="text-2xl font-bold text-slate-800 mb-6 flex items-center"><svg class="w-6 h-6 mr-3 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg><?php echo esc_html(get_theme_mod('payment_section_title', 'Metode Pembayaran')); ?></h2>
                    <ul class="space-y-3 text-slate-600">
                        <?php $payment_list = explode("\n", get_theme_mod('payment_section_content')); foreach($payment_list as $payment_item): if(!empty(trim($payment_item))): ?>
                        <li class="flex items-start"><svg class="w-5 h-5 mt-1 mr-3 text-teal-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg><span><?php echo esc_html(trim($payment_item)); ?></span></li>
                        <?php endif; endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- FAQ Section -->
    <section id="faq" class="py-16 bg-white">
        <div class="container mx-auto px-6 max-w-4xl">
            <h2 class="text-3xl font-bold text-center text-slate-800 mb-2"><?php echo esc_html(get_theme_mod('faq_section_title', 'Pertanyaan yang Sering Diajukan')); ?></h2>
            <p class="text-center text-slate-600 mb-12 max-w-2xl mx-auto"><?php echo esc_html(get_theme_mod('faq_section_subtitle', 'Tidak menemukan jawaban Anda? Hubungi kami langsung.')); ?></p>
            
            <div class="space-y-4">
                <?php for ($i = 1; $i <= 5; $i++): $question = get_theme_mod("faq_question_$i"); $answer = get_theme_mod("faq_answer_$i"); if (!empty($question)): ?>
                <div class="bg-slate-50 rounded-lg shadow-sm faq-item fade-in-element">
                    <button class="faq-question w-full flex justify-between items-center text-left p-6 font-semibold text-slate-800">
                        <span><?php echo esc_html($question); ?></span>
                        <svg class="w-5 h-5 text-slate-500 transition-transform duration-300 transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="faq-answer hidden p-6 pt-0 text-slate-600">
                        <p><?php echo nl2br(esc_html($answer)); ?></p>
                    </div>
                </div>
                <?php endif; endfor; ?>
            </div>
        </div>
    </section>

    <!-- Final CTA Section -->
    <?php if ( get_theme_mod( 'final_cta_show', true ) ) : ?>
    <section id="kontak" class="py-20 bg-slate-800">
        <div class="container mx-auto px-6 text-center">
            <div class="max-w-3xl mx-auto fade-in-element">
                <h2 class="text-3xl md:text-4xl font-extrabold mb-4 leading-tight text-white"><?php echo esc_html( get_theme_mod( 'final_cta_title', 'Siap Wujudkan Website Impian Anda?' ) ); ?></h2>
                <p class="text-lg text-slate-300 mb-8"><?php echo esc_html( get_theme_mod( 'final_cta_text', 'Jangan tunda lagi. Hubungi kami sekarang untuk konsultasi gratis dan dapatkan penawaran terbaik untuk pembuatan website travel umroh Anda.' ) ); ?></p>
                <a href="https://api.whatsapp.com/send?phone=<?php echo esc_html(get_theme_mod('contact_whatsapp', '6281283596622')); ?>&text=Halo%2C%20saya%20tertarik%20untuk%20konsultasi%20gratis%20pembuatan%20website%20umroh." target="_blank" class="bg-amber-500 text-slate-900 font-bold px-8 py-4 rounded-lg text-lg hover:bg-amber-600 transition duration-300 inline-block">
                    <?php echo esc_html( get_theme_mod( 'final_cta_button_text', 'Konsultasi Gratis via WhatsApp' ) ); ?>
                </a>
            </div>
        </div>
    </section>
    <?php endif; ?>


    <!-- Portfolio Modal -->
    <div id="portfolioModal" class="fixed inset-0 bg-black bg-opacity-80 backdrop-blur-sm z-50 items-center justify-center p-4 sm:p-6 md:p-8 hidden transition-opacity duration-300">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-6xl h-full max-h-[90vh] flex flex-col transform transition-transform duration-300 scale-95">
            <!-- Modal Header -->
            <div class="flex justify-between items-center p-4 border-b border-slate-200 flex-shrink-0">
                <h3 id="modalTitle" class="font-bold text-slate-800 text-lg">Live Preview</h3>
                <button onclick="closePortfolioModal()" class="text-slate-400 hover:text-slate-700 hover:bg-slate-100 rounded-full p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <!-- Modal Content -->
            <div class="flex-grow p-2 bg-slate-200">
                <iframe id="portfolioFrame" src="" class="w-full h-full border-0 rounded-md" title="Portfolio Live Preview" sandbox="allow-scripts allow-same-origin"></iframe>
            </div>
        </div>
    </div>


<?php get_footer(); ?>
