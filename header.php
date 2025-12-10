<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <?php wp_head(); ?>

    <style>
        html {
            scroll-behavior: smooth;
        }
        body { font-family: 'Inter', sans-serif; }
        .hero-bg {
            background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('<?php echo esc_url(get_theme_mod('hero_background_image', 'https://placehold.co/1920x1080/000000/FFFFFF?text=Suasana+Mekkah')); ?>');
            background-size: cover;
            background-position: center;
        }
        /* Style untuk animasi fade-in yang lebih lembut */
        .fade-in-element {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94), transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        .fade-in-element.is-visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body <?php body_class('bg-slate-50'); ?>>

    <header class="bg-white/80 backdrop-blur-lg shadow-sm sticky top-0 z-40">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <!-- PERBAIKAN: Ukuran font brand dikecilkan di mobile -->
            <a href="<?php echo home_url(); ?>" class="text-xl md:text-2xl font-bold text-teal-600"><?php echo esc_html(get_theme_mod('brand_name', 'UmrohWeb ID')); ?></a>
            
            <?php if ( is_page_template('page-landing-murah.php') ): ?>
                <!-- Navigasi Khusus Halaman Promo -->
                <nav class="hidden md:flex space-x-6 text-slate-700 font-semibold">
                    <a href="<?php echo home_url(); ?>#desain" class="hover:text-teal-600">Desain Kami</a>
                    <a href="<?php echo home_url(); ?>#harga" class="hover:text-teal-600">Paket Harga</a>
                    <a href="#detail-paket" class="hover:text-teal-600">Detail Promo</a>
                    <a href="#upgrade" class="hover:text-teal-600">Opsi Upgrade</a>
                </nav>
            <?php else: ?>
                <!-- Navigasi Halaman Utama -->
                <nav class="hidden md:flex space-x-6 text-slate-700 font-semibold">
                    <a href="#desain" class="hover:text-teal-600">Desain Kami</a>
                    <a href="#harga" class="hover:text-teal-600">Paket Harga</a>
                    <a href="#faq" class="hover:text-teal-600">Tanya Jawab</a>
                </nav>
            <?php endif; ?>

            <!-- PERBAIKAN: Padding (px-4) dan ukuran font (text-sm) dikecilkan di mobile, lalu dibesarkan di desktop (md:) -->
            <a href="https://api.whatsapp.com/send?phone=<?php echo esc_html(get_theme_mod('contact_whatsapp', '6281283596622')); ?>&text=Halo%2C%20saya%20tertarik%20untuk%20konsultasi%20gratis%20pembuatan%20website%20umroh." target="_blank" class="bg-teal-600 text-white font-bold px-4 md:px-6 py-2 rounded-lg hover:bg-teal-700 transition duration-300 text-sm md:text-base whitespace-nowrap">Konsultasi Gratis</a>
        </div>
    </header>

