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
        body { font-family: 'Plus Jakarta Sans', sans-serif; padding-top: 80px; } /* Tambah padding-top agar konten tidak tertutup header fixed */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body <?php body_class('bg-slate-50 text-slate-800'); ?>>

    <!-- NAVBAR FIXED & SOLID WHITE -->
    <header class="fixed top-0 left-0 right-0 w-full bg-white shadow-md z-50 h-[80px] flex items-center">
        <div class="container mx-auto px-4 md:px-6 flex justify-between items-center w-full">
            
            <!-- LOGO AREA -->
            <div class="flex items-center gap-3">
                <?php if ( is_singular('travel') ): 
                    // Ambil Logo Travel dari Meta
                    $travel_logo = get_post_meta( get_the_ID(), '_travel_logo', true );
                ?>
                    <!-- JIKA HALAMAN TRAVEL -->
                    <?php if ( $travel_logo ): ?>
                        <img src="<?php echo esc_url($travel_logo); ?>" alt="<?php the_title(); ?>" class="h-10 md:h-12 w-auto object-contain">
                    <?php else: ?>
                        <div class="bg-teal-50 p-2 rounded-lg">
                            <svg class="w-6 h-6 text-teal-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 7V3H2v18h20V7H12zM6 19H4v-2h2v2zm0-4H4v-2h2v2zm0-4H4V9h2v2zm0-4H4V5h2v2zm4 12H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V9h2v2zm0-4H8V5h2v2zm10 12h-8v-2h2v-2h-2v-2h2v-2h-2V9h8v10zm-2-8h-2v2h2v-2zm0 4h-2v2h2v-2z"/></svg>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="text-xl font-bold text-slate-800 leading-tight">
                            <?php the_title(); ?>
                        </a>
                    <?php endif; ?>

                <?php else: ?>
                    <!-- DEFAULT BRAND -->
                    <a href="<?php echo home_url(); ?>" class="text-2xl font-extrabold text-teal-600 tracking-tight">
                        <?php echo esc_html(get_theme_mod('brand_name', 'UmrohWeb')); ?>
                    </a>
                <?php endif; ?>
            </div>

            <!-- DESKTOP MENU -->
            <nav class="hidden md:flex items-center space-x-6">
                <?php if ( is_singular('travel') ): ?>
                    <a href="#paket" class="font-semibold text-slate-600 hover:text-teal-600 transition">Paket</a>
                    <a href="#tentang" class="font-semibold text-slate-600 hover:text-teal-600 transition">Profil</a>
                    <a href="#testimoni" class="font-semibold text-slate-600 hover:text-teal-600 transition">Testimoni</a>
                    <a href="<?php echo home_url(); ?>" class="bg-slate-800 text-white px-4 py-2 rounded-full text-sm font-bold hover:bg-slate-900 transition">
                        Travel Lain
                    </a>
                <?php else: ?>
                    <a href="#harga" class="font-semibold text-slate-600 hover:text-teal-600">Harga</a>
                    <a href="#portfolio" class="font-semibold text-slate-600 hover:text-teal-600">Portofolio</a>
                    <a href="https://api.whatsapp.com/send?phone=<?php echo esc_html(get_theme_mod('contact_whatsapp', '6281283596622')); ?>" class="bg-teal-600 text-white px-5 py-2 rounded-full text-sm font-bold hover:bg-teal-700 transition">
                        Hubungi Kami
                    </a>
                <?php endif; ?>
            </nav>

            <!-- MOBILE MENU BUTTON -->
            <button id="mobile-menu-btn" class="md:hidden text-slate-800 p-2">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
            </button>
        </div>

        <!-- MOBILE OVERLAY -->
        <div id="mobile-menu" class="hidden absolute top-[80px] left-0 w-full bg-white border-b border-slate-100 shadow-lg py-4 px-6 md:hidden flex-col space-y-4">
             <?php if ( is_singular('travel') ): ?>
                <a href="#paket" class="block font-semibold text-slate-600 border-b pb-2">Paket Umroh</a>
                <a href="#tentang" class="block font-semibold text-slate-600 border-b pb-2">Tentang Kami</a>
                <a href="<?php echo home_url(); ?>" class="block font-bold text-teal-600">← Cari Travel Lain</a>
            <?php else: ?>
                <a href="#harga" class="block font-semibold text-slate-600">Harga Jasa</a>
                <a href="#portfolio" class="block font-semibold text-slate-600">Portofolio</a>
            <?php endif; ?>
        </div>
    </header>

    <script>
        const menuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        menuBtn.addEventListener('click', () => { mobileMenu.classList.toggle('hidden'); });
    </script>