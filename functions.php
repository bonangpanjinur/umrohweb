<?php

// ==========================================================================
// === BAGIAN 1: PENGATURAN TEMA & CUSTOMIZER (KODE LAMA) ===
// ==========================================================================

// Fungsi untuk menambahkan panel admin di Customizer
function umrohweb_customize_register( $wp_customize ) {

    // Section untuk Pengaturan Umum
    $wp_customize->add_section( 'general_settings', array( 'title' => __( '1. Pengaturan Umum', 'umrohweb' ), 'priority'   => 10, ));
    $wp_customize->add_setting( 'brand_name', array( 'default'   => 'UmrohWeb ID' ));
    $wp_customize->add_control( 'brand_name_control', array( 'label' => 'Nama Brand', 'section' => 'general_settings', 'settings' => 'brand_name' ));
    $wp_customize->add_setting( 'contact_whatsapp', array( 'default'   => '6281283596622' ));
    $wp_customize->add_control( 'contact_whatsapp_control', array( 'label' => 'Nomor WhatsApp (format 62)', 'section' => 'general_settings', 'settings' => 'contact_whatsapp' ));
    
    // Section untuk Hero Area
    $wp_customize->add_section( 'hero_section', array( 'title' => __( '2. Hero Section', 'umrohweb' ), 'priority' => 20 ));
    $wp_customize->add_setting( 'hero_title', array( 'default' => 'Miliki Website Travel Umroh Profesional Sekarang Juga' ));
    $wp_customize->add_control( 'hero_title_control', array( 'label' => 'Judul Utama', 'section' => 'hero_section', 'settings' => 'hero_title', 'type' => 'textarea' ));
    $wp_customize->add_setting( 'hero_subtitle', array( 'default' => 'Tingkatkan kepercayaan jamaah dan jangkau pasar lebih luas...' ));
    $wp_customize->add_control( 'hero_subtitle_control', array( 'label' => 'Sub Judul', 'section' => 'hero_section', 'settings' => 'hero_subtitle', 'type' => 'textarea' ));
    $wp_customize->add_setting( 'hero_background_image' );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hero_background_image_control', array( 'label' => 'Gambar Latar Hero', 'section' => 'hero_section', 'settings' => 'hero_background_image' )));

    // === BAGIAN: Keunggulan & Proses Kerja ===
    $wp_customize->add_section( 'benefits_process_section', array( 'title' => __( '3. Keunggulan & Proses', 'umrohweb' ), 'priority' => 25, ));
    $wp_customize->add_setting('benefits_section_title', array('default' => 'Bukan Sekedar Website, Tapi Solusi Bisnis Anda'));
    $wp_customize->add_control('benefits_section_title_control', array('label' => 'Judul Section Keunggulan', 'section' => 'benefits_process_section', 'settings' => 'benefits_section_title'));
    $benefits_defaults = [
        1 => ['title' => 'Jangkau Jamaah di Mana Saja', 'desc' => 'Tampilan sempurna di HP & laptop membuat calon jamaah nyaman melihat paket Anda kapanpun.'],
        2 => ['title' => 'Anti Lemot, Anti Kehilangan Jamaah', 'desc' => 'Website super cepat memastikan calon jamaah tidak pergi sebelum melihat penawaran terbaik Anda.'],
        3 => ['title' => 'Update Paket Semudah Update Status', 'desc' => 'Anda bisa ganti harga dan jadwal umroh sendiri melalui admin panel yang sangat mudah digunakan.'],
        4 => ['title' => 'Branding Travel Lebih Terpercaya', 'desc' => 'Desain profesional meningkatkan citra dan kepercayaan calon jamaah pada travel umroh Anda.'],
    ];
    for ($i = 1; $i <= 4; $i++) {
        $wp_customize->add_setting("benefit_title_$i", array('default' => $benefits_defaults[$i]['title']));
        $wp_customize->add_control("benefit_title_{$i}_control", array('label' => "Judul Keunggulan #$i", 'section' => 'benefits_process_section', 'settings' => "benefit_title_$i"));
        $wp_customize->add_setting("benefit_desc_$i", array('default' => $benefits_defaults[$i]['desc']));
        $wp_customize->add_control("benefit_desc_{$i}_control", array('label' => "Deskripsi Keunggulan #$i", 'section' => 'benefits_process_section', 'settings' => "benefit_desc_$i", 'type' => 'textarea'));
    }
    $wp_customize->add_setting('process_section_title', array('default' => 'Hanya 3 Langkah Mudah Punya Website Impian'));
    $wp_customize->add_control('process_section_title_control', array('label' => 'Judul Section Proses', 'section' => 'benefits_process_section', 'settings' => 'process_section_title'));
     $process_defaults = [
        1 => ['title' => '1. Konsultasi & Pilih Desain', 'desc' => 'Diskusikan kebutuhan Anda, lalu pilih desain dari portofolio kami yang paling Anda sukai.'],
        2 => ['title' => '2. Kirim Materi Anda', 'desc' => 'Cukup kirimkan logo, profil travel, dan detail paket umroh yang ingin ditampilkan.'],
        3 => ['title' => '3. Website Online!', 'desc' => 'Website Anda siap menjaring jamaah dalam 7-14 hari kerja. Siap untuk launching!'],
    ];
    for ($i = 1; $i <= 3; $i++) {
        $wp_customize->add_setting("process_title_$i", array('default' => $process_defaults[$i]['title']));
        $wp_customize->add_control("process_title_{$i}_control", array('label' => "Judul Proses #$i", 'section' => 'benefits_process_section', 'settings' => "process_title_$i"));
        $wp_customize->add_setting("process_desc_$i", array('default' => $process_defaults[$i]['desc']));
        $wp_customize->add_control("process_desc_{$i}_control", array('label' => "Deskripsi Proses #$i", 'section' => 'benefits_process_section', 'settings' => "process_desc_$i", 'type' => 'textarea'));
    }

    // Section untuk Portfolio
    $wp_customize->add_section( 'portfolio_section', array( 'title' => __( '4. Portofolio Website', 'umrohweb' ), 'priority' => 30 ));
    $wp_customize->add_setting( 'portfolio_section_title', array( 'default' => 'Portofolio Website Kami' ));
    $wp_customize->add_control( 'portfolio_section_title_control', array( 'label' => 'Judul Section', 'section' => 'portfolio_section', 'settings' => 'portfolio_section_title' ));
    $wp_customize->add_setting( 'portfolio_section_subtitle', array( 'default' => 'Pilih desain yang paling Anda sukai dari website yang pernah kami buat.' ));
    $wp_customize->add_control( 'portfolio_section_subtitle_control', array( 'label' => 'Sub Judul Section', 'section' => 'portfolio_section', 'settings' => 'portfolio_section_subtitle', 'type' => 'textarea' ));
    $wp_customize->add_setting( 'portfolio_item_count', array( 'default' => 7 ));
    $wp_customize->add_control( 'portfolio_item_count_control', array( 'label' => 'Jumlah Portofolio', 'section' => 'portfolio_section', 'settings' => 'portfolio_item_count', 'type' => 'number', 'input_attrs' => array( 'min' => 1, 'max' => 10 ) ));
    $default_urls = [ 'umrohalhijazz.com', 'jannahfirdausumroh.com', 'aishahtourtravel.com', 'jannahfirdaustravel.com', 'rizqunatourtravel.com', 'alhijazindowisatatour.com', 'jannahfirdausbanten.com' ];
    for ($i = 1; $i <= 7; $i++) {
        $default_title = isset($default_urls[$i-1]) ? ucwords(str_replace('.com', '', $default_urls[$i-1])) : "Website Portofolio $i";
        $default_url = isset($default_urls[$i-1]) ? 'https://' . $default_urls[$i-1] : '';
        $wp_customize->add_setting( "portfolio_title_$i", array( 'default' => $default_title ));
        $wp_customize->add_control( "portfolio_title_{$i}_control", array( 'label' => "Nama Website #$i", 'section' => 'portfolio_section', 'settings' => "portfolio_title_$i" ));
        $wp_customize->add_setting( "portfolio_url_$i", array( 'default' => $default_url ));
        $wp_customize->add_control( "portfolio_url_{$i}_control", array( 'label' => "URL Website #$i", 'section' => 'portfolio_section', 'settings' => "portfolio_url_$i" ));
        $wp_customize->add_setting( "portfolio_image_$i" );
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, "portfolio_image_{$i}_control", array( 'label' => "Gambar Tampilan Website #$i", 'section' => 'portfolio_section', 'settings' => "portfolio_image_$i" )));
    }

    // Section untuk Harga
    $wp_customize->add_section( 'harga_section', array( 'title' => __( '5. Pengaturan Harga', 'umrohweb' ), 'priority' => 40 ));
    $wp_customize->add_setting( 'harga_section_title', array( 'default' => 'Paket Harga Transparan' ));
    $wp_customize->add_control( 'harga_section_title_control', array( 'label' => 'Judul Section', 'section' => 'harga_section', 'settings' => 'harga_section_title' ));
    $wp_customize->add_setting( 'harga_section_subtitle', array( 'default' => 'Pilih paket yang paling sesuai dengan kebutuhan dan anggaran bisnis travel Anda.' ));
    $wp_customize->add_control( 'harga_section_subtitle_control', array( 'label' => 'Sub Judul Section', 'section' => 'harga_section', 'settings' => 'harga_section_subtitle', 'type' => 'textarea' ));
    $paket_defaults = [
        1 => ['nama' => 'Paket Silver', 'subtitle' => 'Untuk travel pemula', 'harga' => 'Rp 1.5jt', 'fitur' => "Pilihan 1 Desain Template\n5 Halaman Website\nGratis Domain (.live/.online/.site)*\nGratis Hosting 1 Tahun\nIntegrasi WhatsApp"],
        2 => ['nama' => 'Paket Gold', 'subtitle' => 'Untuk travel berkembang', 'harga' => 'Rp 2.5jt', 'fitur' => "Pilihan 3 Desain Template\n10 Halaman Website\nGratis Domain (.live/.online/.site)*\nGratis Hosting 1 Tahun\nIntegrasi WhatsApp & Medsos\nSEO Friendly"],
        3 => ['nama' => 'Paket Platinum', 'subtitle' => 'Fitur terlengkap', 'harga' => 'Rp 4jt', 'fitur' => "Desain Eksklusif Sesuai Brand\nHalaman Tidak Terbatas\nGratis Domain (.live/.online/.site)* & Hosting 1 Thn\nFitur Booking Online\nSupport Prioritas"],
    ];
    for ($i = 1; $i <= 3; $i++) {
        $wp_customize->add_setting( "paket_{$i}_nama", array( 'default' => $paket_defaults[$i]['nama'] ));
        $wp_customize->add_control( "paket_{$i}_nama_control", array( 'label' => "Nama Paket #$i", 'section' => 'harga_section', 'settings' => "paket_{$i}_nama" ));
        $wp_customize->add_setting( "paket_{$i}_subtitle", array( 'default' => $paket_defaults[$i]['subtitle'] ));
        $wp_customize->add_control( "paket_{$i}_subtitle_control", array( 'label' => "Subtitle Paket #$i", 'section' => 'harga_section', 'settings' => "paket_{$i}_subtitle" ));
        $wp_customize->add_setting( "paket_{$i}_harga", array( 'default' => $paket_defaults[$i]['harga'] ));
        $wp_customize->add_control( "paket_{$i}_harga_control", array( 'label' => "Harga Paket #$i", 'section' => 'harga_section', 'settings' => "paket_{$i}_harga" ));
        $wp_customize->add_setting( "paket_{$i}_fitur", array( 'default' => $paket_defaults[$i]['fitur'] ));
        $wp_customize->add_control( "paket_{$i}_fitur_control", array( 'label' => "Fitur Paket #$i (satu per baris)", 'section' => 'harga_section', 'settings' => "paket_{$i}_fitur", 'type' => 'textarea' ));
        
        // --- PENAMBAHAN SETTING URL CONTOH WEBSITE ---
        $wp_customize->add_setting( "paket_{$i}_contoh_url", array( 'default' => '' ));
        $wp_customize->add_control( "paket_{$i}_contoh_url_control", array( 'label' => "URL Contoh Website #$i", 'section' => 'harga_section', 'settings' => "paket_{$i}_contoh_url", 'type' => 'url' ));
        // --- AKHIR PENAMBAHAN ---

        if ($i == 2) {
            $wp_customize->add_setting( "paket_2_populer", array( 'default' => true ));
            $wp_customize->add_control( "paket_2_populer_control", array( 'label' => "Jadikan Paket #2 Populer?", 'section' => 'harga_section', 'settings' => "paket_2_populer", 'type' => 'checkbox' ));
        }
    }

    // === BAGIAN: Promo Spesial ===
    $wp_customize->add_section( 'promo_section', array( 'title' => __( '6. Promo Spesial', 'umrohweb' ), 'priority' => 45 ));
    $wp_customize->add_setting('promo_show', array('default' => true));
    $wp_customize->add_control('promo_show_control', array('label' => 'Tampilkan Bagian Promo?', 'section' => 'promo_section', 'settings' => 'promo_show', 'type' => 'checkbox'));
    $wp_customize->add_setting('promo_title', array('default' => 'PROMO SPESIAL BULAN INI!'));
    $wp_customize->add_control('promo_title_control', array('label' => 'Judul Promo', 'section' => 'promo_section', 'settings' => 'promo_title'));
    $wp_customize->add_setting('promo_text', array('default' => 'Pesan Paket Gold atau Platinum sebelum akhir bulan dan dapatkan GRATIS Lisensi Plugin Premium SEO (Senilai Rp 850.000) untuk membantu website Anda lebih mudah ditemukan di Google!'));
    $wp_customize->add_control('promo_text_control', array('label' => 'Teks Penawaran Promo', 'section' => 'promo_section', 'settings' => 'promo_text', 'type' => 'textarea'));

    // Section FAQ
    $wp_customize->add_section( 'faq_section', array( 'title' => __( '8. FAQ (Pertanyaan Umum)', 'umrohweb' ), 'priority' => 55 )); // Prioritas disesuaikan
    $wp_customize->add_setting( 'faq_section_title', array('default' => 'Pertanyaan yang Sering Diajukan'));
    $wp_customize->add_control('faq_section_title_control', array('label' => 'Judul Section', 'section' => 'faq_section', 'settings' => 'faq_section_title'));
    $wp_customize->add_setting( 'faq_section_subtitle', array('default' => 'Tidak menemukan jawaban Anda? Hubungi kami langsung.'));
    $wp_customize->add_control('faq_section_subtitle_control', array('label' => 'Sub Judul Section', 'section' => 'faq_section', 'settings' => 'faq_section_subtitle', 'type' => 'textarea'));
    $faq_defaults = [
        1 => ['q' => 'Berapa lama proses pembuatan website?', 'a' => 'Proses pengerjaan website biasanya memakan waktu 7-14 hari kerja, tergantung pada kelengkapan materi (teks, foto, logo) dari pihak Anda.'],
        2 => ['q' => 'Apakah saya bisa mengelola konten website sendiri?', 'a' => 'Tentu saja! Paket Silver ke atas dibuat menggunakan WordPress, sehingga Anda bisa dengan mudah menambah, mengubah, atau menghapus paket umroh, artikel, dan galeri foto tanpa perlu keahlian coding.'],
        3 => ['q' => 'Apa saja yang perlu saya siapkan?', 'a' => 'Anda hanya perlu menyiapkan materi dasar seperti: Logo travel, profil perusahaan, daftar paket umroh yang ditawarkan beserta harganya, dan beberapa foto kegiatan.'],
        4 => ['q' => 'Apakah sudah termasuk domain dan hosting?', 'a' => "Betul. Semua paket (Silver, Gold, Platinum) sudah termasuk gratis hosting 1 tahun dan gratis domain 1 tahun.\n\nAnda bisa pilih domain gratis dari ekstensi berikut:\n.live\n.online\n.my.id\n.site\n.store\n\nIngin domain lain? Tentu bisa dengan tambahan biaya:\n+ Rp 100.000 untuk .web.id\n+ Rp 200.000 untuk .net / .com\n+ Rp 250.000 untuk .id / .co.id\n\n(Catatan: Paket Landing Page Promo 499k hanya mendapat subdomain, bukan domain.)"],
        5 => ['q' => 'Bagaimana jika saya butuh bantuan setelah website jadi?', 'a' => 'Kami menyediakan support teknis selama 1 bulan setelah website launching untuk membantu Anda jika ada kendala atau pertanyaan.']
    ];
    for ($i = 1; $i <= 5; $i++) {
        $wp_customize->add_setting( "faq_question_$i", array('default' => $faq_defaults[$i]['q'] ?? ''));
        $wp_customize->add_control("faq_question_{$i}_control", array('label' => "Pertanyaan #$i", 'section' => 'faq_section', 'settings' => "faq_question_$i", 'type' => 'text'));
        $wp_customize->add_setting( "faq_answer_$i", array('default' => $faq_defaults[$i]['a'] ?? ''));
        $wp_customize->add_control("faq_answer_{$i}_control", array('label' => "Jawaban #$i", 'section' => 'faq_section', 'settings' => "faq_answer_$i", 'type' => 'textarea'));
    }

    // === BAGIAN: Syarat, Ketentuan, & Pembayaran ===
    $wp_customize->add_section( 'tnc_payment_section', array( 'title' => __( '9. Syarat & Pembayaran', 'umrohweb' ), 'priority' => 60 )); // Prioritas disesuaikan
    $wp_customize->add_setting('tnc_payment_show', array('default' => true));
    $wp_customize->add_control('tnc_payment_show_control', array('label' => 'Tampilkan Bagian Ini?', 'section' => 'tnc_payment_section', 'settings' => 'tnc_payment_show', 'type' => 'checkbox'));
    
    // Syarat & Ketentuan
    $wp_customize->add_setting('tnc_section_title', array('default' => 'Syarat dan Ketentuan'));
    $wp_customize->add_control('tnc_section_title_control', array('label' => 'Judul Bagian S&K', 'section' => 'tnc_payment_section', 'settings' => 'tnc_section_title'));
    $wp_customize->add_setting('tnc_section_content', array('default' => "Klien menyediakan semua materi (logo, teks, gambar).\nWaktu pengerjaan tidak termasuk revisi besar.\nMaksimal 2x revisi minor setelah web selesai."));
    $wp_customize->add_control('tnc_section_content_control', array('label' => 'Isi Syarat & Ketentuan (satu per baris)', 'section' => 'tnc_payment_section', 'settings' => 'tnc_section_content', 'type' => 'textarea'));
    
    // Metode Pembayaran
    $wp_customize->add_setting('payment_section_title', array('default' => 'Metode Pembayaran'));
    $wp_customize->add_control('payment_section_title_control', array('label' => 'Judul Bagian Pembayaran', 'section' => 'tnc_payment_section', 'settings' => 'payment_section_title'));
    $wp_customize->add_setting('payment_section_content', array('default' => "DP (Down Payment) 50% di awal.\nPelunasan 50% setelah website online.\nTermasuk training pengelolaan website."));
    $wp_customize->add_control('payment_section_content_control', array('label' => 'Isi Metode Pembayaran (satu per baris)', 'section' => 'tnc_payment_section', 'settings' => 'payment_section_content', 'type' => 'textarea'));
    
    // === BAGIAN BARU: Final CTA ===
    $wp_customize->add_section( 'final_cta_section', array( 'title' => __( '10. Ajakan Bertindak (CTA)', 'umrohweb' ), 'priority' => 65 )); // Prioritas disesuaikan
    $wp_customize->add_setting('final_cta_show', array('default' => true));
    $wp_customize->add_control('final_cta_show_control', array('label' => 'Tampilkan Bagian CTA Final?', 'section' => 'final_cta_section', 'settings' => 'final_cta_show', 'type' => 'checkbox'));
    $wp_customize->add_setting('final_cta_title', array('default' => 'Siap Wujudkan Website Impian Anda?'));
    $wp_customize->add_control('final_cta_title_control', array('label' => 'Judul CTA', 'section' => 'final_cta_section', 'settings' => 'final_cta_title'));
    $wp_customize->add_setting('final_cta_text', array('default' => 'Jangan tunda lagi. Hubungi kami sekarang untuk konsultasi gratis dan dapatkan penawaran terbaik untuk pembuatan website travel umroh Anda.'));
    $wp_customize->add_control('final_cta_text_control', array('label' => 'Teks CTA', 'section' => 'final_cta_section', 'settings' => 'final_cta_text', 'type' => 'textarea'));
    $wp_customize->add_setting('final_cta_button_text', array('default' => 'Konsultasi Gratis via WhatsApp'));
    $wp_customize->add_control('final_cta_button_text_control', array('label' => 'Teks Tombol CTA', 'section' => 'final_cta_section', 'settings' => 'final_cta_button_text'));


    // ===============================================
    // === BAGIAN: PENGATURAN LANDING PAGE PROMO ===
    // ===============================================
    $wp_customize->add_section( 'lp_promo_section', array( 'title' => __( '11. Pengaturan Landing Page Promo', 'umrohweb' ), 'priority' => 70 ));
    
    // Hero
    $wp_customize->add_setting('lp_hero_title', array('default' => 'Mulai Online Hanya dengan Rp 499.000'));
    $wp_customize->add_control('lp_hero_title_control', array('label' => 'Judul Utama', 'section' => 'lp_promo_section', 'settings' => 'lp_hero_title', 'type' => 'text'));
    $wp_customize->add_setting('lp_hero_subtitle', array('default' => 'Dapatkan Landing Page profesional untuk travel Anda. Cepat, fokus, dan siap menjaring jamaah!'));
    $wp_customize->add_control('lp_hero_subtitle_control', array('label' => 'Sub Judul', 'section' => 'lp_promo_section', 'settings' => 'lp_hero_subtitle', 'type' => 'textarea'));

    $wp_customize->add_setting( 'lp_hero_background_image' );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'lp_hero_background_image_control', array( 'label' => 'Gambar Latar Hero (Promo)', 'section' => 'lp_promo_section', 'settings' => 'lp_hero_background_image' )));

    // Alasan
    $wp_customize->add_setting('lp_why_title', array('default' => 'Kenapa Travel Anda Wajib Punya Landing Page?'));
    $wp_customize->add_control('lp_why_title_control', array('label' => 'Judul Bagian "Kenapa"', 'section' => 'lp_promo_section', 'settings' => 'lp_why_title', 'type' => 'text'));
    $why_defaults = [
        1 => ['title' => 'Mulai Online Super Cepat', 'desc' => 'Tidak perlu menunggu lama. Dalam 1-2 hari kerja, halaman promo Anda siap digunakan untuk iklan digital atau promosi di media sosial.'],
        2 => ['title' => 'Fokus Menjual 1 Penawaran', 'desc' => 'Landing page didesain khusus untuk fokus pada satu tujuan: membuat pengunjung mendaftar paket umroh yang sedang Anda promosikan.'],
        3 => ['title' => 'Membangun Kepercayaan Awal', 'desc' => 'Daripada hanya promosi di sosmed, memiliki halaman website (meski 1 halaman) membuat bisnis travel Anda terlihat jauh lebih profesional dan terpercaya.'],
    ];
    for ($i = 1; $i <= 3; $i++) {
        $wp_customize->add_setting("lp_why_title_$i", array('default' => $why_defaults[$i]['title']));
        $wp_customize->add_control("lp_why_title_{$i}_control", array('label' => "Judul Alasan #$i", 'section' => 'lp_promo_section', 'settings' => "lp_why_title_$i"));
        $wp_customize->add_setting("lp_why_desc_$i", array('default' => $why_defaults[$i]['desc']));
        $wp_customize->add_control("lp_why_desc_{$i}_control", array('label' => "Deskripsi Alasan #$i", 'section' => 'lp_promo_section', 'settings' => "lp_why_desc_$i", 'type' => 'textarea'));
    }

    // Paket Harga
    $wp_customize->add_setting('lp_package_title', array('default' => 'Paket Landing Page Promo'));
    $wp_customize->add_control('lp_package_title_control', array('label' => 'Judul Bagian Paket', 'section' => 'lp_promo_section', 'settings' => 'lp_package_title', 'type' => 'text'));
    $wp_customize->add_setting('lp_price_old', array('default' => 'Rp 750.000'));
    $wp_customize->add_control('lp_price_old_control', array('label' => 'Harga Coret (Lama)', 'section' => 'lp_promo_section', 'settings' => 'lp_price_old', 'type' => 'text'));
    $wp_customize->add_setting('lp_price_new', array('default' => 'Rp 499.000'));
    $wp_customize->add_control('lp_price_new_control', array('label' => 'Harga Promo (Baru)', 'section' => 'lp_promo_section', 'settings' => 'lp_price_new', 'type' => 'text'));
    $wp_customize->add_setting('lp_price_note', array('default' => '(Sekali Bayar)'));
    $wp_customize->add_control('lp_price_note_control', array('label' => 'Catatan Harga', 'section' => 'lp_promo_section', 'settings' => 'lp_price_note', 'type' => 'text'));
    $wp_customize->add_setting('lp_features', array('default' => "1 Halaman Website Profesional\nDesain Modern & Responsif (Mobile Friendly)\nGratis Subdomain (cth: travelanda.umrohweb.id)\nGratis Hosting 1 Tahun\nTombol Chat WhatsApp\nMasa Pengerjaan Cepat (1-2 Hari Kerja)"));
    $wp_customize->add_control('lp_features_control', array('label' => 'Fitur Paket (Satu per baris)', 'section' => 'lp_promo_section', 'settings' => 'lp_features', 'type' => 'textarea'));
    $wp_customize->add_setting('lp_package_button', array('default' => 'Pesan Paket Landing Page'));
    $wp_customize->add_control('lp_package_button_control', array('label' => 'Teks Tombol Paket', 'section' => 'lp_promo_section', 'settings' => 'lp_package_button', 'type' => 'text'));

    // Batasan Paket Promo (Baru)
    $wp_customize->add_setting('lp_restrictions_title', array('default' => 'Penting: Batasan Paket Promo'));
    $wp_customize->add_control('lp_restrictions_title_control', array('label' => 'Judul Batasan Paket', 'section' => 'lp_promo_section', 'settings' => 'lp_restrictions_title', 'type' => 'text'));
    $wp_customize->add_setting('lp_restrictions', array('default' => "Tidak Termasuk Admin Panel. Klien tidak bisa login dan mengedit harga/konten paket sendiri.\nWebsite bersifat statis. Update konten atau harga dilakukan via admin kami (dikenakan biaya maintenance).\n*Solusi Terbaik: Upgrade ke Paket Silver kapan saja agar bisa kelola sendiri!"));
    $wp_customize->add_control('lp_restrictions_control', array('label' => 'Daftar Batasan (Satu per baris, gunakan * untuk highlight)', 'section' => 'lp_promo_section', 'settings' => 'lp_restrictions', 'type' => 'textarea'));

    // Upgrade
    $wp_customize->add_setting('lp_upgrade_title', array('default' => 'Bagaimana Cara Upgrade?'));
    $wp_customize->add_control('lp_upgrade_title_control', array('label' => 'Judul Upgrade', 'section' => 'lp_promo_section', 'settings' => 'lp_upgrade_title', 'type' => 'text'));
    $wp_customize->add_setting('lp_upgrade_desc', array('default' => 'Paket Landing Page ini adalah langkah awal. Kapanpun bisnis Anda siap, Anda bisa langsung upgrade ke website penuh (seperti Paket Silver/Gold) hanya dengan membayar selisihnya.'));
    $wp_customize->add_control('lp_upgrade_desc_control', array('label' => 'Deskripsi Upgrade', 'section' => 'lp_promo_section', 'settings' => 'lp_upgrade_desc', 'type' => 'textarea'));
    $wp_customize->add_setting('lp_upgrade_features_title', array('default' => 'Apa yang Anda dapatkan saat Upgrade?'));
    $wp_customize->add_control('lp_upgrade_features_title_control', array('label' => 'Judul Fitur Upgrade', 'section' => 'lp_promo_section', 'settings' => 'lp_upgrade_features_title', 'type' => 'text'));
    $wp_customize->add_setting('lp_upgrade_features', array('default' => "Domain .com profesional (bukan subdomain).\nBanyak Halaman (Home, Profil, Paket, Galeri, Kontak).\nBisa pilih desain yang lebih lengkap dari portofolio.\nAnda bisa mengelola konten sendiri via Admin Panel."));
    $wp_customize->add_control('lp_upgrade_features_control', array('label' => 'Fitur Upgrade (Satu per baris)', 'section' => 'lp_promo_section', 'settings' => 'lp_upgrade_features', 'type' => 'textarea'));
    
    // --- PENGATURAN ILUSTRASI UPGRADE (Gaya Portofolio) - PERUBAHAN DI SINI ---
    $wp_customize->add_setting( 'lp_upgrade_example_title', array('default' => 'Contoh Website Paket Gold'));
    $wp_customize->add_control('lp_upgrade_example_title_control', array('label' => 'Judul Website Contoh Upgrade', 'section' => 'lp_promo_section', 'settings' => 'lp_upgrade_example_title'));
    
    $wp_customize->add_setting( 'lp_upgrade_example_url', array('default' => 'https://jannahfirdausumroh.com'));
    $wp_customize->add_control('lp_upgrade_example_url_control', array('label' => 'URL Website Contoh Upgrade', 'section' => 'lp_promo_section', 'settings' => 'lp_upgrade_example_url', 'type' => 'url'));

    $wp_customize->add_setting( 'lp_upgrade_example_image' );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'lp_upgrade_example_image_control', array( 'label' => 'Gambar Screenshot Contoh Upgrade', 'section' => 'lp_promo_section', 'settings' => 'lp_upgrade_example_image' )));
    // --- AKHIR PENGATURAN ILUSTRASI ---

    // Final CTA
    $wp_customize->add_setting('lp_cta_title', array('default' => 'Jangan Tunda Lagi, Mulai Sekarang!'));
    $wp_customize->add_control('lp_cta_title_control', array('label' => 'Judul CTA Final', 'section' => 'lp_promo_section', 'settings' => 'lp_cta_title', 'type' => 'text'));
    $wp_customize->add_setting('lp_cta_subtitle', array('default' => 'Amankan harga promo Rp 499.000 hari ini juga. Klik tombol di bawah untuk konsultasi gratis dan pesan Landing Page Anda.'));
    $wp_customize->add_control('lp_cta_subtitle_control', array('label' => 'Sub Judul CTA Final', 'section' => 'lp_promo_section', 'settings' => 'lp_cta_subtitle', 'type' => 'textarea'));

}
add_action( 'customize_register', 'umrohweb_customize_register' );


// ==========================================================================
// === BAGIAN 2: FITUR BARU: SISTEM DATA TRAVEL & FLAYER ===
// ==========================================================================

function create_travel_post_types() {
    // 1. CPT: Data Travel (Untuk Profil Perusahaan: Jannah Firdaus, dll)
    register_post_type('travel',
        array(
            'labels'      => array(
                'name'          => __('Data Travel'),
                'singular_name' => __('Travel'),
                'add_new'       => __('Tambah Travel Baru'),
                'add_new_item'  => __('Tambah Data Travel'),
                'edit_item'     => __('Edit Data Travel'),
                'all_items'     => __('Semua Travel'),
            ),
            'public'      => true,
            'has_archive' => false,
            'supports'    => array('title', 'editor', 'thumbnail'), // Editor untuk "Tentang Perusahaan", Thumbnail untuk Logo/Banner
            'menu_icon'   => 'dashicons-building',
            'rewrite'     => array('slug' => 'travel'), // URL nanti jadi: domain.com/travel/nama-travel
        )
    );

    // 2. CPT: Paket Umroh (Untuk Flayer)
    register_post_type('umroh_package',
        array(
            'labels'      => array(
                'name'          => __('Data Flayer/Paket'),
                'singular_name' => __('Paket'),
                'add_new'       => __('Tambah Flayer Baru'),
                'add_new_item'  => __('Tambah Flayer'),
                'edit_item'     => __('Edit Flayer'),
                'all_items'     => __('Semua Flayer'),
            ),
            'public'      => true,
            'has_archive' => true,
            'supports'    => array('title', 'thumbnail'), // Hanya butuh Judul & Gambar Flayer
            'menu_icon'   => 'dashicons-tickets-alt',
        )
    );

    // 3. Taxonomy: Kategori & Sub Kategori
    register_taxonomy(
        'package_category',
        'umroh_package',
        array(
            'labels' => array(
                'name' => 'Kategori Paket',
                'add_new_item' => 'Tambah Kategori/Sub Kategori',
            ),
            'rewrite' => array('slug' => 'kategori-paket'),
            'hierarchical' => true, // True agar bisa punya Sub-Kategori (Induk -> Anak)
            'show_admin_column' => true,
        )
    );
}
add_action('init', 'create_travel_post_types');


// === META BOXES: FORM INPUT TAMBAHAN ===

function add_travel_meta_boxes() {
    // Inputan Khusus di Menu "Data Travel"
    add_meta_box('travel_details', 'Informasi Kontak Travel', 'render_travel_details_meta_box', 'travel', 'normal', 'high');
    add_meta_box('travel_extras', 'FAQ & Testimoni', 'render_travel_extras_meta_box', 'travel', 'normal', 'default');

    // Inputan Khusus di Menu "Data Flayer" (Pilih Travel Pemilik)
    add_meta_box('package_details', 'Hubungkan ke Travel', 'render_package_details_meta_box', 'umroh_package', 'side', 'default');
}
add_action('add_meta_boxes', 'add_travel_meta_boxes');

// 1. Form Data Travel (Telepon, Alamat, Maps)
function render_travel_details_meta_box($post) {
    $phone = get_post_meta($post->ID, '_travel_phone', true);
    $address = get_post_meta($post->ID, '_travel_address', true);
    ?>
    <p>
        <label><strong>Nomor Telepon / WhatsApp (Wajib):</strong></label><br>
        <input type="text" name="travel_phone" value="<?php echo esc_attr($phone); ?>" placeholder="628123456789" style="width:100%;">
        <small>Nomor ini akan otomatis dipakai di tombol WA semua flayer travel ini.</small>
    </p>
    <p>
        <label><strong>Alamat Kantor:</strong></label><br>
        <textarea name="travel_address" style="width:100%;" rows="3"><?php echo esc_textarea($address); ?></textarea>
    </p>
    <?php
}

// 2. Form FAQ & Testimoni Travel
function render_travel_extras_meta_box($post) {
    // Mengambil data array FAQ & Testimoni
    $faqs = get_post_meta($post->ID, '_travel_faqs', true) ?: [];
    $testis = get_post_meta($post->ID, '_travel_testis', true) ?: [];
    ?>
    
    <!-- Input FAQ (Bisa Tambah Banyak) -->
    <h4>FAQ (Tanya Jawab)</h4>
    <div id="faq-wrapper">
        <?php 
        if(!empty($faqs)) {
            foreach($faqs as $i => $faq) {
                echo '<div class="faq-item" style="margin-bottom:10px; border-bottom:1px solid #ccc; padding-bottom:10px;">
                    <input type="text" name="faq_q[]" value="'.esc_attr($faq['q']).'" placeholder="Pertanyaan" style="width:100%; margin-bottom:5px;">
                    <textarea name="faq_a[]" placeholder="Jawaban" style="width:100%;">'.esc_textarea($faq['a']).'</textarea>
                </div>';
            }
        }
        ?>
    </div>
    <button type="button" class="button" onclick="addFaq()">+ Tambah FAQ Lain</button>

    <!-- Input Testimoni -->
    <hr>
    <h4>Testimoni Jamaah</h4>
    <div id="testi-wrapper">
        <?php 
        if(!empty($testis)) {
            foreach($testis as $i => $testi) {
                echo '<div class="testi-item" style="margin-bottom:10px; border-bottom:1px solid #ccc; padding-bottom:10px;">
                    <input type="text" name="testi_name[]" value="'.esc_attr($testi['name']).'" placeholder="Nama Jamaah" style="width:100%; margin-bottom:5px;">
                    <textarea name="testi_text[]" placeholder="Isi Testimoni" style="width:100%;">'.esc_textarea($testi['text']).'</textarea>
                </div>';
            }
        }
        ?>
    </div>
    <button type="button" class="button" onclick="addTesti()">+ Tambah Testimoni Lain</button>

    <script>
    function addFaq() {
        var html = '<div class="faq-item" style="margin-bottom:10px; border-bottom:1px solid #ccc; padding-bottom:10px;"><input type="text" name="faq_q[]" placeholder="Pertanyaan" style="width:100%; margin-bottom:5px;"><textarea name="faq_a[]" placeholder="Jawaban" style="width:100%;"></textarea></div>';
        document.getElementById('faq-wrapper').insertAdjacentHTML('beforeend', html);
    }
    function addTesti() {
        var html = '<div class="testi-item" style="margin-bottom:10px; border-bottom:1px solid #ccc; padding-bottom:10px;"><input type="text" name="testi_name[]" placeholder="Nama Jamaah" style="width:100%; margin-bottom:5px;"><textarea name="testi_text[]" placeholder="Isi Testimoni" style="width:100%;"></textarea></div>';
        document.getElementById('testi-wrapper').insertAdjacentHTML('beforeend', html);
    }
    </script>
    <?php
}

// 3. Form Di Flayer: Pilih Travel Pemilik
function render_package_details_meta_box($post) {
    $selected_travel = get_post_meta($post->ID, '_related_travel_id', true);
    $price = get_post_meta($post->ID, '_package_price', true);
    
    // Ambil daftar semua travel
    $travels = get_posts(array('post_type' => 'travel', 'numberposts' => -1, 'post_status' => 'publish'));
    ?>
    <p><strong>Pilih Nama Travel:</strong></p>
    <select name="related_travel_id" style="width:100%;">
        <option value="">-- Pilih Travel --</option>
        <?php foreach ($travels as $travel) : ?>
            <option value="<?php echo $travel->ID; ?>" <?php selected($selected_travel, $travel->ID); ?>>
                <?php echo esc_html($travel->post_title); ?>
            </option>
        <?php endforeach; ?>
    </select>
    <p style="color: #666; font-style: italic; font-size: 12px;">Nomor WA akan otomatis mengambil dari data travel yang dipilih di atas.</p>
    
    <p><strong>Harga (Opsional untuk label):</strong></p>
    <input type="text" name="package_price" value="<?php echo esc_attr($price); ?>" placeholder="Rp 25 Juta">
    <?php
}

// Simpan Data
function save_travel_custom_meta($post_id) {
    // Save Data Travel
    if (isset($_POST['travel_phone'])) update_post_meta($post_id, '_travel_phone', sanitize_text_field($_POST['travel_phone']));
    if (isset($_POST['travel_address'])) update_post_meta($post_id, '_travel_address', sanitize_textarea_field($_POST['travel_address']));
    
    // Save FAQ & Testi (Array)
    if (isset($_POST['faq_q'])) {
        $faqs = [];
        for($i=0; $i<count($_POST['faq_q']); $i++) {
            if(!empty($_POST['faq_q'][$i])) {
                $faqs[] = ['q' => sanitize_text_field($_POST['faq_q'][$i]), 'a' => sanitize_textarea_field($_POST['faq_a'][$i])];
            }
        }
        update_post_meta($post_id, '_travel_faqs', $faqs);
    }
    
    if (isset($_POST['testi_name'])) {
        $testis = [];
        for($i=0; $i<count($_POST['testi_name']); $i++) {
            if(!empty($_POST['testi_name'][$i])) {
                $testis[] = ['name' => sanitize_text_field($_POST['testi_name'][$i]), 'text' => sanitize_textarea_field($_POST['testi_text'][$i])];
            }
        }
        update_post_meta($post_id, '_travel_testis', $testis);
    }

    // Save Data Flayer
    if (isset($_POST['related_travel_id'])) update_post_meta($post_id, '_related_travel_id', sanitize_text_field($_POST['related_travel_id']));
    if (isset($_POST['package_price'])) update_post_meta($post_id, '_package_price', sanitize_text_field($_POST['package_price']));
}
add_action('save_post', 'save_travel_custom_meta');
?>