<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
    <style>
        html { scroll-behavior: smooth; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; padding-top: 80px; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body <?php body_class('bg-slate-50 text-slate-800'); ?>>

    <!-- NAVBAR FIXED & SOLID WHITE -->
    <header class="fixed top-0 left-0 right-0 w-full bg-white shadow-md z-50 h-[80px] flex items-center transition-all duration-300">
        <div class="container mx-auto px-4 md:px-6 flex justify-between items-center w-full">
            
            <!-- 1. LOGO AREA (DINAMIS) -->
            <div class="flex items-center gap-3">
                <?php if ( is_singular('travel') ): 
                    // AMBIL LOGO KHUSUS TRAVEL
                    $travel_logo = get_post_meta( get_the_ID(), '_travel_logo', true );
                ?>
                    <!-- JIKA DI HALAMAN TRAVEL -->
                    <?php if ( $travel_logo ): ?>
                        <img src="<?php echo esc_url($travel_logo); ?>" alt="<?php the_title(); ?>" class="h-12 w-auto object-contain">
                    <?php else: ?>
                        <!-- Fallback jika logo kosong -->
                        <div class="bg-teal-50 p-2 rounded-lg">
                            <svg class="w-6 h-6 text-teal-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 7V3H2v18h20V7H12zM6 19H4v-2h2v2zm0-4H4v-2h2v2zm0-4H4V9h2v2zm0-4H4V5h2v2zm4 12H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V9h2v2zm0-4H8V5h2v2zm10 12h-8v-2h2v-2h-2v-2h2v-2h-2V9h8v10zm-2-8h-2v2h2v-2zm0 4h-2v2h2v-2z"/></svg>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="text-xl font-bold text-slate-800 leading-tight hover:text-teal-600 transition">
                            <?php the_title(); ?>
                        </a>
                    <?php endif; ?>

                <?php else: ?>
                    <!-- JIKA DI HALAMAN UTAMA (LANDING PAGE) -->
                    <a href="<?php echo home_url(); ?>" class="text-2xl font-extrabold text-teal-600 tracking-tight">
                        <?php echo esc_html(get_theme_mod('brand_name', 'UmrohWeb')); ?>
                    </a>
                <?php endif; ?>
            </div>

            <!-- 2. DESKTOP MENU (DINAMIS) -->
            <nav class="hidden md:flex items-center space-x-6">
                <?php if ( is_singular('travel') ): ?>
                    <!-- Menu Halaman Travel (TANPA Tombol Travel Lain) -->
                    <a href="#paket" class="font-semibold text-slate-600 hover:text-teal-600 transition">Paket</a>
                    <a href="#tentang" class="font-semibold text-slate-600 hover:text-teal-600 transition">Profil</a>
                    <a href="#testimoni" class="font-semibold text-slate-600 hover:text-teal-600 transition">Testimoni</a>
                    <!-- Tombol 'Travel Lain' Dihapus Sesuai Request -->
                <?php else: ?>
                    <!-- Menu Halaman Utama -->
                    <a href="#harga" class="font-semibold text-slate-600 hover:text-teal-600">Harga</a>
                    <a href="#portfolio" class="font-semibold text-slate-600 hover:text-teal-600">Portofolio</a>
                    <a href="https://api.whatsapp.com/send?phone=<?php echo esc_html(get_theme_mod('contact_whatsapp', '6281283596622')); ?>" class="bg-teal-600 text-white px-5 py-2 rounded-full text-sm font-bold hover:bg-teal-700 transition">
                        Hubungi Kami
                    </a>
                <?php endif; ?>
            </nav>

            <!-- 3. MOBILE MENU BUTTON -->
            <button id="mobile-menu-btn" class="md:hidden text-slate-800 p-2 focus:outline-none">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
            </button>
        </div>

        <!-- 4. MOBILE MENU OVERLAY -->
        <div id="mobile-menu" class="hidden absolute top-[80px] left-0 w-full bg-white border-b border-slate-100 shadow-lg py-4 px-6 md:hidden flex-col space-y-4 z-40">
             <?php if ( is_singular('travel') ): ?>
                <a href="#paket" class="block font-semibold text-slate-600 border-b pb-2">Paket Umroh</a>
                <a href="#tentang" class="block font-semibold text-slate-600 border-b pb-2">Tentang Kami</a>
                <a href="#testimoni" class="block font-semibold text-slate-600 border-b pb-2">Testimoni</a>
                <!-- Link Travel Lain di Mobile juga dihapus -->
            <?php else: ?>
                <a href="#harga" class="block font-semibold text-slate-600">Harga Jasa</a>
                <a href="#portfolio" class="block font-semibold text-slate-600">Portofolio</a>
            <?php endif; ?>
        </div>
    </header>

    <script>
        const menuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        
        // Toggle Menu
        menuBtn.addEventListener('click', () => { 
            mobileMenu.classList.toggle('hidden'); 
        });

        // Close menu when clicking link (Mobile UX)
        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });
        });
    </script>