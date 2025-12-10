<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <?php wp_head(); ?>

    <style>
        html { scroll-behavior: smooth; scroll-padding-top: 80px; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; -webkit-font-smoothing: antialiased; }
        
        /* Custom Scrollbar */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        
        /* Header Transition */
        .header-scrolled { @apply bg-white/95 backdrop-blur-md shadow-md py-3; }
        .header-transparent { @apply bg-transparent py-5; }
        
        /* Swiper Custom */
        .swiper-pagination-bullet { width: 8px; height: 8px; background: white; opacity: 0.5; }
        .swiper-pagination-bullet-active { width: 24px; border-radius: 4px; background: #14b8a6; opacity: 1; transition: all 0.3s; }
    </style>
</head>
<body <?php body_class('bg-slate-50 text-slate-800'); ?>>

    <!-- NAVBAR -->
    <header id="main-header" class="fixed top-0 w-full z-50 transition-all duration-300 header-transparent">
        <div class="container mx-auto px-4 md:px-6">
            <div class="flex justify-between items-center">
                
                <!-- BRAND LOGO -->
                <div class="flex items-center gap-2">
                    <?php if ( is_singular('travel') ): ?>
                        <!-- Jika Halaman Travel: Tampilkan Nama Travel -->
                        <div class="bg-white/10 backdrop-blur-sm rounded-lg p-1">
                            <svg class="w-8 h-8 text-teal-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 7V3H2v18h20V7H12zM6 19H4v-2h2v2zm0-4H4v-2h2v2zm0-4H4V9h2v2zm0-4H4V5h2v2zm4 12H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V9h2v2zm0-4H8V5h2v2zm10 12h-8v-2h2v-2h-2v-2h2v-2h-2V9h8v10zm-2-8h-2v2h2v-2zm0 4h-2v2h2v-2z"/></svg>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="text-xl md:text-2xl font-extrabold text-slate-800 tracking-tight leading-none group">
                            <span class="block text-sm font-medium text-teal-600 opacity-90 group-hover:text-teal-500">Travel Umroh</span>
                            <?php echo wp_trim_words( get_the_title(), 3, '' ); ?>
                        </a>
                    <?php else: ?>
                        <!-- Default Brand -->
                        <a href="<?php echo home_url(); ?>" class="text-2xl font-extrabold text-teal-600 tracking-tight">
                            <?php echo esc_html(get_theme_mod('brand_name', 'UmrohWeb')); ?>
                        </a>
                    <?php endif; ?>
                </div>

                <!-- DESKTOP MENU -->
                <nav class="hidden md:flex items-center space-x-8">
                    <?php if ( is_singular('travel') ): ?>
                        <a href="#paket" class="text-sm font-semibold text-slate-600 hover:text-teal-600 transition">Paket Umroh</a>
                        <a href="#tentang" class="text-sm font-semibold text-slate-600 hover:text-teal-600 transition">Tentang Kami</a>
                        <a href="#testimoni" class="text-sm font-semibold text-slate-600 hover:text-teal-600 transition">Testimoni</a>
                        
                        <a href="<?php echo home_url(); ?>" class="bg-slate-900 text-white px-5 py-2.5 rounded-full text-sm font-bold hover:bg-slate-800 transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            Cari Travel Lain
                        </a>
                    <?php else: ?>
                        <a href="#harga" class="text-sm font-semibold text-slate-600 hover:text-teal-600 transition">Harga Jasa</a>
                        <a href="#portfolio" class="text-sm font-semibold text-slate-600 hover:text-teal-600 transition">Portofolio</a>
                        <a href="https://api.whatsapp.com/send?phone=<?php echo esc_html(get_theme_mod('contact_whatsapp', '6281283596622')); ?>" class="bg-teal-600 text-white px-5 py-2.5 rounded-full text-sm font-bold hover:bg-teal-700 transition shadow-lg hover:shadow-teal-200">
                            Konsultasi Gratis
                        </a>
                    <?php endif; ?>
                </nav>

                <!-- MOBILE MENU BUTTON -->
                <button id="mobile-menu-btn" class="md:hidden text-slate-800 p-2 focus:outline-none">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                </button>
            </div>
        </div>

        <!-- MOBILE MENU OVERLAY -->
        <div id="mobile-menu" class="hidden absolute top-full left-0 w-full bg-white border-b border-slate-100 shadow-xl py-4 px-6 md:hidden flex-col space-y-4">
             <?php if ( is_singular('travel') ): ?>
                <a href="#paket" class="block font-semibold text-slate-600 py-2 border-b border-slate-50">Paket Umroh</a>
                <a href="#tentang" class="block font-semibold text-slate-600 py-2 border-b border-slate-50">Tentang Kami</a>
                <a href="<?php echo home_url(); ?>" class="block font-bold text-teal-600 py-2">← Cari Travel Lain</a>
            <?php else: ?>
                <a href="#harga" class="block font-semibold text-slate-600">Harga Jasa</a>
                <a href="#portfolio" class="block font-semibold text-slate-600">Portofolio</a>
            <?php endif; ?>
        </div>
    </header>

    <script>
        // Scroll Effect Script
        const header = document.getElementById('main-header');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                header.classList.remove('header-transparent');
                header.classList.add('header-scrolled');
            } else {
                header.classList.add('header-transparent');
                header.classList.remove('header-scrolled');
            }
        });

        // Mobile Menu Script
        const menuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>