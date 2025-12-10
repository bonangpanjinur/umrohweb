<?php 
/**
 * Template Name: Single Travel Page (Fixed Header & Carousel)
 * Template Post Type: travel
 */
get_header(); 

// Pastikan kita dalam loop post yang benar
while ( have_posts() ) : the_post();

    $travel_id = get_the_ID();
    
    // Ambil Meta Data dengan pengecekan
    $phone = get_post_meta($travel_id, '_travel_phone', true);
    $address = get_post_meta($travel_id, '_travel_address', true);
    $maps_url = get_post_meta($travel_id, '_travel_maps', true);
    
    // Ambil Array dan pastikan formatnya array
    $faqs_raw = get_post_meta($travel_id, '_travel_faqs', true);
    $faqs = is_array($faqs_raw) ? $faqs_raw : [];
    
    $testis_raw = get_post_meta($travel_id, '_travel_testis', true);
    $testis = is_array($testis_raw) ? $testis_raw : [];

    // BANNER LOGIC (CAROUSEL)
    $b1 = get_post_meta($travel_id, '_travel_banner_1', true);
    $b2 = get_post_meta($travel_id, '_travel_banner_2', true);
    $b3 = get_post_meta($travel_id, '_travel_banner_3', true);
    $banners = array_filter([$b1, $b2, $b3]);

    // Jika kosong, pakai Featured Image
    if (empty($banners)) {
        // Fallback ke Featured Image
        $feat_img = get_the_post_thumbnail_url($travel_id, 'full');
        if($feat_img) {
            $banners[] = $feat_img;
        } else {
            // Fallback terakhir placeholder
            $banners[] = 'https://placehold.co/1920x800/0f172a/ffffff?text=Travel+Umroh+Terpercaya';
        }
    }
?>

<!-- SWIPER CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<style>
    /* Styling Navigasi Slider */
    .swiper-pagination-bullet { background: white; opacity: 0.6; width: 10px; height: 10px; }
    .swiper-pagination-bullet-active { background: #14b8a6; opacity: 1; }
    .swiper-button-next, .swiper-button-prev { color: white; opacity: 0.7; }
    .swiper-button-next:hover, .swiper-button-prev:hover { opacity: 1; }
</style>

<!-- CAROUSEL BANNER SECTION -->
<section class="relative h-[50vh] md:h-[65vh] bg-slate-900 w-full overflow-hidden">
    <div class="swiper mySwiper h-full w-full">
        <div class="swiper-wrapper">
            <?php foreach($banners as $banner_img): ?>
            <div class="swiper-slide relative">
                <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('<?php echo esc_url($banner_img); ?>');"></div>
                <!-- Overlay Gradient agar teks terbaca -->
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-transparent to-transparent opacity-90"></div>
            </div>
            <?php endforeach; ?>
        </div>
        <!-- Pagination & Navigation -->
        <div class="swiper-pagination"></div>
        <?php if(count($banners) > 1): ?>
            <div class="swiper-button-next hidden md:flex"></div>
            <div class="swiper-button-prev hidden md:flex"></div>
        <?php endif; ?>
    </div>

    <!-- Text Overlay di Atas Banner -->
    <div class="absolute inset-0 z-10 flex items-end pb-12 justify-center pointer-events-none">
        <div class="container mx-auto px-6 text-center pointer-events-auto">
            <h1 class="text-3xl md:text-6xl font-extrabold text-white drop-shadow-lg mb-3"><?php the_title(); ?></h1>
            <p class="text-slate-200 text-sm md:text-lg max-w-2xl mx-auto drop-shadow-md">
                Solusi Perjalanan Ibadah Umroh & Haji Terbaik
            </p>
        </div>
    </div>
</section>

<!-- MAIN CONTENT (PAKET, TENTANG, DLL) -->
<!-- Menggunakan margin minus agar sedikit menumpuk banner untuk efek modern -->
<div class="bg-slate-50 min-h-screen pb-20 -mt-6 relative z-20 rounded-t-3xl shadow-lg">
    
    <?php
    // Query Paket Khusus Travel Ini
    $args = array( 
        'post_type' => 'umroh_package', 
        'posts_per_page' => -1, 
        'meta_key' => '_related_travel_id', 
        'meta_value' => $travel_id 
    );
    $packages = new WP_Query($args);
    ?>

    <!-- STICKY FILTER MENU (Menempel saat scroll) -->
    <div class="sticky top-[80px] z-30 bg-white/95 backdrop-blur border-b border-slate-200 shadow-sm py-4">
        <div class="container mx-auto px-4 flex overflow-x-auto gap-3 pb-1 no-scrollbar md:justify-center">
            <button class="filter-btn active whitespace-nowrap px-6 py-2 rounded-full text-sm font-bold bg-teal-600 text-white shadow-md transition-all" data-filter="all">Semua Paket</button>
            <?php 
            if ($packages->have_posts()) {
                $used_terms = [];
                while ($packages->have_posts()) { 
                    $packages->the_post(); 
                    $terms = get_the_terms(get_the_ID(), 'package_category');
                    if ($terms && !is_wp_error($terms)) { 
                        foreach ($terms as $term) $used_terms[$term->term_id] = $term; 
                    }
                }
                $packages->rewind_posts();
                
                if(!empty($used_terms)) {
                    foreach($used_terms as $term): ?>
                    <button class="filter-btn whitespace-nowrap px-6 py-2 rounded-full text-sm font-bold bg-white text-slate-600 border border-slate-200 hover:border-teal-500 hover:text-teal-600 transition-all" data-filter="cat-<?php echo $term->term_id; ?>">
                        <?php echo esc_html($term->name); ?>
                    </button>
                    <?php endforeach;
                }
            } ?>
        </div>
    </div>

    <!-- GRID PAKET -->
    <div id="paket" class="container mx-auto px-4 md:px-6 py-10 scroll-mt-32">
        <?php if ($packages->have_posts()) : ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php while ($packages->have_posts()) : $packages->the_post(); 
                // AMBIL DATA DETAIL
                $price = get_post_meta(get_the_ID(), '_package_price', true);
                $duration = get_post_meta(get_the_ID(), '_package_duration', true);
                $airline = get_post_meta(get_the_ID(), '_package_airline', true);
                $hotel_star = get_post_meta(get_the_ID(), '_package_hotel_star', true);
                $date = get_post_meta(get_the_ID(), '_package_date', true);
                
                $img_src = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'large') : 'https://placehold.co/600x800/e2e8f0/64748b?text=Paket+Umroh';
                
                $post_terms = get_the_terms(get_the_ID(), 'package_category');
                $filter_classes = ''; 
                $cat_name = 'Promo';
                if ($post_terms && !is_wp_error($post_terms)) { 
                    foreach ($post_terms as $t) $filter_classes .= ' cat-' . $t->term_id; 
                    $cat_name = $post_terms[0]->name;
                }
            ?>
            
            <!-- CARD PAKET DETAIL -->
            <div class="package-item bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition flex flex-col h-full <?php echo $filter_classes; ?>">
                
                <!-- Image Header -->
                <div class="relative aspect-[4/3] overflow-hidden">
                    <img src="<?php echo esc_url($img_src); ?>" class="w-full h-full object-cover transition duration-500 hover:scale-110">
                    <!-- Badge Kategori -->
                    <div class="absolute top-3 left-3 bg-white/90 px-3 py-1 rounded-full text-xs font-bold text-teal-700 uppercase shadow-sm">
                        <?php echo esc_html($cat_name); ?>
                    </div>
                    <!-- Badge Tanggal -->
                    <?php if($date): ?>
                    <div class="absolute bottom-3 left-3 bg-black/60 text-white px-3 py-1 rounded-full text-xs font-bold backdrop-blur-sm">
                        📅 <?php echo esc_html($date); ?>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Card Body -->
                <div class="p-5 flex flex-col flex-grow">
                    <h3 class="text-lg font-bold text-slate-800 mb-3 line-clamp-2"><?php the_title(); ?></h3>
                    
                    <!-- Detail Grid -->
                    <div class="grid grid-cols-2 gap-y-2 gap-x-4 text-sm text-slate-600 mb-4 pb-4 border-b border-slate-100">
                        <div class="flex items-center gap-2">
                            <span class="text-lg">✈️</span> <?php echo $airline ? esc_html($airline) : 'Direct'; ?>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-lg">🏨</span> <?php echo $hotel_star ? 'Bintang ' . esc_html($hotel_star) : 'Hotel *4'; ?>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-lg">⏳</span> <?php echo $duration ? esc_html($duration) : '9 Hari'; ?>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-lg">✅</span> Tersedia
                        </div>
                    </div>

                    <!-- Footer: Harga & Tombol -->
                    <div class="mt-auto flex justify-between items-center">
                        <div>
                            <p class="text-xs text-slate-400">Mulai dari</p>
                            <div class="text-xl font-bold text-teal-600"><?php echo esc_html($price ?: 'Hubungi'); ?></div>
                        </div>
                        <a href="https://api.whatsapp.com/send?phone=<?php echo esc_attr($phone); ?>&text=Assalamu'alaikum%2C%20saya%20tertarik%20paket%20<?php echo urlencode(get_the_title()); ?>" target="_blank" class="bg-slate-900 text-white p-3 rounded-xl hover:bg-teal-600 transition shadow-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
                
                <!-- Full Card Link Overlay (Hanya untuk UX klik area kosong) -->
                <!-- Note: Tombol WA di atas punya z-index lebih tinggi secara default karena urutan DOM, tapi aman kalau di klik spesifik -->
            </div>
            <?php endwhile; ?>
        </div>
        <?php else: ?>
            <div class="text-center py-16 text-slate-500 bg-white rounded-xl border border-dashed border-slate-300">Belum ada paket tersedia untuk travel ini.</div>
        <?php endif; wp_reset_postdata(); ?>
    </div>
</div>

<!-- TABS (Tentang, FAQ, Testi) -->
<section id="tentang" class="bg-white py-12 scroll-mt-24">
    <div class="container mx-auto px-4 max-w-5xl">
        <!-- Tab Nav -->
        <div class="flex justify-center gap-2 mb-8 overflow-x-auto pb-2">
            <button onclick="switchTab('about')" id="tab-about" class="tab-btn active px-6 py-2 rounded-full text-sm font-bold bg-teal-600 text-white transition whitespace-nowrap">Tentang</button>
            <button onclick="switchTab('faq')" id="tab-faq" class="tab-btn px-6 py-2 rounded-full text-sm font-bold text-slate-500 bg-slate-100 hover:bg-slate-200 transition whitespace-nowrap">FAQ</button>
            <button onclick="switchTab('testi')" id="tab-testi" class="tab-btn px-6 py-2 rounded-full text-sm font-bold text-slate-500 bg-slate-100 hover:bg-slate-200 transition whitespace-nowrap">Testimoni</button>
        </div>

        <div class="min-h-[200px]">
            <!-- About -->
            <div id="content-about" class="tab-content">
                <div class="bg-slate-50 p-8 rounded-2xl border border-slate-100 prose max-w-none text-slate-600">
                    <h3 class="text-2xl font-bold text-slate-800 mb-4">Profil Travel</h3>
                    <?php the_content(); ?>
                    <?php if($address): ?>
                        <div class="mt-6 pt-6 border-t border-slate-200">
                            <h4 class="font-bold text-slate-800 mb-2">📍 Kantor Pusat</h4>
                            <p><?php echo nl2br(esc_html($address)); ?></p>
                            <?php if($maps_url): ?>
                                <div class="mt-4 rounded-xl overflow-hidden shadow-sm h-64 bg-slate-200 relative">
                                    <iframe src="<?php echo esc_url($maps_url); ?>" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- FAQ -->
            <div id="content-faq" class="tab-content hidden space-y-3">
                <?php if(!empty($faqs)): foreach($faqs as $faq): ?>
                <div class="border border-slate-200 rounded-xl overflow-hidden">
                    <button class="w-full text-left px-5 py-4 font-bold text-slate-800 bg-white flex justify-between items-center" onclick="this.nextElementSibling.classList.toggle('hidden'); this.querySelector('.icon').classList.toggle('rotate-180');">
                        <?php echo esc_html($faq['q']); ?> 
                        <span class="icon transition-transform duration-300 transform">▼</span>
                    </button>
                    <div class="hidden px-5 py-4 bg-slate-50 text-slate-600 border-t border-slate-100 text-sm"><?php echo nl2br(esc_html($faq['a'])); ?></div>
                </div>
                <?php endforeach; else: echo '<div class="text-center p-8 bg-slate-50 rounded-xl text-slate-500">Belum ada FAQ yang ditambahkan.</div>'; endif; ?>
            </div>

            <!-- Testi -->
            <div id="content-testi" class="tab-content hidden grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php if(!empty($testis)): foreach($testis as $testi): 
                    $img = isset($testi['img']) ? $testi['img'] : '';
                    $video = isset($testi['video']) ? $testi['video'] : '';
                ?>
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex flex-col gap-4 h-full">
                    <div class="flex gap-4 items-start">
                        <div class="w-12 h-12 rounded-full bg-slate-200 overflow-hidden shrink-0">
                            <?php if($img): ?><img src="<?php echo esc_url($img); ?>" class="w-full h-full object-cover"><?php else: ?>
                                <div class="w-full h-full flex items-center justify-center bg-teal-100 text-teal-600 font-bold"><?php echo substr($testi['name'], 0, 1); ?></div>
                            <?php endif; ?>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800"><?php echo esc_html($testi['name']); ?></h4>
                            <div class="flex text-amber-400 text-xs mt-1">★★★★★</div>
                        </div>
                    </div>
                    <p class="text-sm text-slate-500 italic">"<?php echo esc_html($testi['text']); ?>"</p>
                    
                    <?php if($video): ?>
                    <div class="mt-auto pt-2">
                        <a href="<?php echo esc_url($video); ?>" target="_blank" class="inline-flex items-center gap-2 text-xs font-bold text-red-600 bg-red-50 px-3 py-1.5 rounded-full hover:bg-red-100 transition">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                            Lihat Video Testimoni
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; else: echo '<div class="col-span-2 text-center p-8 bg-slate-50 rounded-xl text-slate-500">Belum ada testimoni.</div>'; endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- SECTION TRAVEL LAINNYA (REKOMENDASI) -->
<section class="py-16 bg-slate-50 border-t border-slate-200">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="text-center mb-10">
            <h2 class="text-2xl font-bold text-slate-800">Cari Pilihan Travel Lain?</h2>
            <p class="text-slate-500">Lihat rekomendasi travel umroh terpercaya lainnya</p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <?php
            // Query untuk mendapatkan travel lain (kecuali yang sedang dibuka)
            $related_args = array(
                'post_type' => 'travel',
                'posts_per_page' => 4,
                'post__not_in' => array($travel_id), // Kecualikan ID travel ini
                'orderby' => 'rand' // Acak agar pengunjung melihat variasi
            );
            $related_travels = new WP_Query($related_args);
            
            if($related_travels->have_posts()):
                while($related_travels->have_posts()): $related_travels->the_post();
                    $rel_id = get_the_ID();
                    $rel_logo = get_post_meta($rel_id, '_travel_logo', true);
                    $rel_thumb = has_post_thumbnail() ? get_the_post_thumbnail_url($rel_id, 'medium') : 'https://placehold.co/400x300/e2e8f0/64748b?text=Travel';
            ?>
            <a href="<?php the_permalink(); ?>" class="group bg-white rounded-xl shadow-sm hover:shadow-md transition border border-slate-100 overflow-hidden block h-full flex flex-col">
                <div class="h-32 bg-slate-200 relative overflow-hidden">
                    <img src="<?php echo esc_url($rel_thumb); ?>" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                    <?php if($rel_logo): ?>
                    <div class="absolute -bottom-6 left-1/2 -translate-x-1/2 bg-white p-2 rounded-full shadow-sm border border-slate-100 w-12 h-12 flex items-center justify-center z-10">
                        <img src="<?php echo esc_url($rel_logo); ?>" class="w-full h-full object-contain">
                    </div>
                    <?php endif; ?>
                </div>
                <div class="pt-8 pb-4 px-4 text-center mt-auto">
                    <h4 class="font-bold text-slate-800 text-sm group-hover:text-teal-600 transition line-clamp-1"><?php the_title(); ?></h4>
                    <span class="text-xs text-teal-500 font-bold mt-2 inline-block bg-teal-50 px-3 py-1 rounded-full">Lihat Profil</span>
                </div>
            </a>
            <?php endwhile; wp_reset_postdata(); else: ?>
                <div class="col-span-full text-center text-slate-400 py-10">Belum ada travel lain yang terdaftar.</div>
            <?php endif; ?>
        </div>
        
        <div class="text-center mt-10">
            <a href="<?php echo get_post_type_archive_link('travel'); ?>" class="inline-block bg-slate-800 text-white font-bold px-8 py-3 rounded-full hover:bg-slate-900 transition shadow-lg">
                Lihat Semua Travel
            </a>
        </div>
    </div>
</section>

<!-- SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    // Initialize Swiper
    new Swiper(".mySwiper", { 
        autoplay: { delay: 4000, disableOnInteraction: false }, 
        loop: true, 
        pagination: { el: ".swiper-pagination", clickable: true },
        navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" }
    });

    // Filter Logic
    const filterBtns = document.querySelectorAll('.filter-btn');
    const items = document.querySelectorAll('.package-item');
    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => { b.className = 'filter-btn px-6 py-2 rounded-full text-sm font-bold text-slate-500 bg-white border border-slate-200 transition whitespace-nowrap'; });
            btn.className = 'filter-btn active px-6 py-2 rounded-full text-sm font-bold bg-teal-600 text-white shadow-md transition whitespace-nowrap';
            const val = btn.dataset.filter;
            items.forEach(item => {
                item.style.display = (val === 'all' || item.classList.contains(val)) ? 'flex' : 'none';
            });
        });
    });

    // Tab Logic
    window.switchTab = function(name) {
        document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
        document.getElementById('content-' + name).classList.remove('hidden');
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.className = 'tab-btn px-6 py-2 rounded-full text-sm font-bold text-slate-500 bg-slate-100 hover:bg-slate-200 transition whitespace-nowrap';
        });
        document.getElementById('tab-' + name).className = 'tab-btn active px-6 py-2 rounded-full text-sm font-bold bg-teal-600 text-white transition whitespace-nowrap';
    };
    
    // Auto switch hash
    if(window.location.hash) {
        const hash = window.location.hash.substring(1);
        if(['about', 'faq', 'testi'].includes(hash)) switchTab(hash);
    }
</script>

<?php endwhile; // End of the loop. ?>

<?php get_footer(); ?>