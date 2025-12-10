<?php 
/**
 * Template Name: Single Travel Page (Mobile Optimized)
 */
get_header(); 

$travel_id = get_the_ID();
$phone = get_post_meta($travel_id, '_travel_phone', true);
$address = get_post_meta($travel_id, '_travel_address', true);
$maps_url = get_post_meta($travel_id, '_travel_maps', true);
$faqs = get_post_meta($travel_id, '_travel_faqs', true) ?: [];
$testis = get_post_meta($travel_id, '_travel_testis', true) ?: [];

// BANNER LOGIC
$b1 = get_post_meta($travel_id, '_travel_banner_1', true);
$b2 = get_post_meta($travel_id, '_travel_banner_2', true);
$b3 = get_post_meta($travel_id, '_travel_banner_3', true);
$banners = array_filter([$b1, $b2, $b3]);

// Fallback Banner
if (empty($banners)) {
    $banners[] = has_post_thumbnail() ? get_the_post_thumbnail_url($travel_id, 'full') : 'https://placehold.co/1920x800/0f172a/ffffff?text=Travel+Umroh+Terpercaya';
}
?>

<!-- SWIPER CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<style>
    .swiper-pagination-bullet { background: white; opacity: 0.6; width: 8px; height: 8px; }
    .swiper-pagination-bullet-active { background: #14b8a6; opacity: 1; width: 20px; border-radius: 4px; transition: width 0.3s; }
    .swiper-button-next, .swiper-button-prev { color: white; opacity: 0.7; transform: scale(0.7); }
    .swiper-button-next:hover, .swiper-button-prev:hover { opacity: 1; }
    
    /* Hide scrollbar for horizontal scrolling elements */
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<!-- CAROUSEL BANNER SECTION -->
<!-- Responsive Height: 45vh di mobile, 65vh di desktop -->
<section class="relative h-[45vh] md:h-[65vh] bg-slate-900 w-full overflow-hidden">
    <div class="swiper mySwiper h-full w-full">
        <div class="swiper-wrapper">
            <?php foreach($banners as $banner_img): ?>
            <div class="swiper-slide relative">
                <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('<?php echo esc_url($banner_img); ?>');"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-transparent to-transparent opacity-90"></div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="swiper-pagination !bottom-8"></div>
        <?php if(count($banners) > 1): ?>
            <div class="swiper-button-next hidden md:flex"></div>
            <div class="swiper-button-prev hidden md:flex"></div>
        <?php endif; ?>
    </div>

    <div class="absolute inset-0 z-10 flex items-end pb-12 md:pb-16 justify-center pointer-events-none">
        <div class="container mx-auto px-4 text-center pointer-events-auto">
            <!-- Responsive Font Size -->
            <h1 class="text-2xl md:text-5xl lg:text-6xl font-extrabold text-white drop-shadow-lg mb-2 md:mb-4 leading-tight"><?php the_title(); ?></h1>
            <p class="text-slate-200 text-xs md:text-lg max-w-2xl mx-auto drop-shadow-md px-4">
                Solusi Perjalanan Ibadah Umroh & Haji Terbaik
            </p>
        </div>
    </div>
</section>

<!-- MAIN CONTENT -->
<div class="bg-slate-50 min-h-screen pb-20 -mt-6 relative z-20 rounded-t-3xl shadow-[0_-5px_20px_rgba(0,0,0,0.1)]">
    
    <?php
    $args = array( 'post_type' => 'umroh_package', 'posts_per_page' => -1, 'meta_key' => '_related_travel_id', 'meta_value' => $travel_id );
    $packages = new WP_Query($args);
    ?>

    <!-- STICKY FILTER MENU (Scrollable Horizontal) -->
    <div class="sticky top-[75px] md:top-[80px] z-30 bg-white/95 backdrop-blur border-b border-slate-200 shadow-sm py-3 md:py-4">
        <!-- Justify-start di mobile agar enak di scroll, center di desktop -->
        <div class="container mx-auto px-4 flex overflow-x-auto gap-3 pb-1 no-scrollbar justify-start md:justify-center snap-x">
            <button class="filter-btn active whitespace-nowrap px-5 py-2 md:px-6 md:py-2 rounded-full text-xs md:text-sm font-bold bg-teal-600 text-white shadow-md transition-all snap-start shrink-0" data-filter="all">Semua Paket</button>
            <?php 
            if ($packages->have_posts()) {
                $used_terms = [];
                while ($packages->have_posts()) { 
                    $packages->the_post(); 
                    $terms = get_the_terms(get_the_ID(), 'package_category');
                    if ($terms) { foreach ($terms as $term) $used_terms[$term->term_id] = $term; }
                }
                $packages->rewind_posts();
                foreach($used_terms as $term): ?>
                <button class="filter-btn whitespace-nowrap px-5 py-2 md:px-6 md:py-2 rounded-full text-xs md:text-sm font-bold bg-white text-slate-600 border border-slate-200 hover:border-teal-500 hover:text-teal-600 transition-all snap-start shrink-0" data-filter="cat-<?php echo $term->term_id; ?>">
                    <?php echo esc_html($term->name); ?>
                </button>
                <?php endforeach;
            } ?>
        </div>
    </div>

    <!-- GRID PAKET -->
    <!-- Reduced Padding & Gap on Mobile -->
    <div id="paket" class="container mx-auto px-4 md:px-6 py-6 md:py-10 scroll-mt-32">
        <?php if ($packages->have_posts()) : ?>
        <!-- Grid Gap: gap-4 (mobile) -> gap-8 (desktop) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-8">
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
            <div class="package-item bg-white rounded-xl md:rounded-2xl shadow-sm md:shadow-md overflow-hidden hover:shadow-xl transition flex flex-col h-full border border-slate-100 <?php echo $filter_classes; ?>">
                
                <!-- Image Header -->
                <div class="relative aspect-[16/9] md:aspect-[4/3] overflow-hidden">
                    <img src="<?php echo esc_url($img_src); ?>" class="w-full h-full object-cover">
                    <!-- Badge Kategori -->
                    <div class="absolute top-3 left-3 bg-white/95 px-2.5 py-1 rounded-lg text-[10px] md:text-xs font-bold text-teal-700 uppercase shadow-sm tracking-wide">
                        <?php echo esc_html($cat_name); ?>
                    </div>
                    <!-- Badge Tanggal -->
                    <?php if($date): ?>
                    <div class="absolute bottom-3 left-3 bg-black/70 text-white px-2.5 py-1 rounded-lg text-[10px] md:text-xs font-bold backdrop-blur-sm flex items-center gap-1">
                        <svg class="w-3 h-3 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <?php echo esc_html($date); ?>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Card Body -->
                <div class="p-4 md:p-5 flex flex-col flex-grow">
                    <h3 class="text-base md:text-lg font-bold text-slate-800 mb-3 line-clamp-2 leading-snug"><?php the_title(); ?></h3>
                    
                    <!-- Detail Grid -->
                    <div class="grid grid-cols-2 gap-y-2 gap-x-2 text-xs md:text-sm text-slate-600 mb-4 pb-4 border-b border-slate-100">
                        <div class="flex items-center gap-1.5">
                            <span class="text-base">✈️</span> <span class="truncate"><?php echo $airline ? esc_html($airline) : 'Direct'; ?></span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span class="text-base">🏨</span> <span class="truncate"><?php echo $hotel_star ? '*' . esc_html($hotel_star) : 'Hotel *4'; ?></span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span class="text-base">⏳</span> <span><?php echo $duration ? esc_html($duration) : '9 Hari'; ?></span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span class="text-base">✅</span> <span>Tersedia</span>
                        </div>
                    </div>

                    <!-- Footer: Harga & Tombol -->
                    <div class="mt-auto flex justify-between items-center">
                        <div>
                            <p class="text-[10px] md:text-xs text-slate-400 uppercase font-semibold">Mulai dari</p>
                            <div class="text-lg md:text-xl font-bold text-teal-600"><?php echo esc_html($price ?: 'Hubungi'); ?></div>
                        </div>
                        <a href="https://api.whatsapp.com/send?phone=<?php echo esc_attr($phone); ?>&text=Assalamu'alaikum%2C%20saya%20tertarik%20paket%20<?php echo urlencode(get_the_title()); ?>" target="_blank" class="bg-slate-900 text-white p-2.5 md:p-3 rounded-lg md:rounded-xl hover:bg-teal-600 transition shadow-lg flex items-center gap-2 group">
                            <span class="text-xs font-bold md:hidden">Pesan</span>
                            <svg class="w-4 h-4 md:w-5 md:h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
                
                <!-- Full Card Link Overlay -->
                <a href="https://api.whatsapp.com/send?phone=<?php echo esc_attr($phone); ?>&text=Info%20Paket:%20<?php the_title(); ?>" target="_blank" class="absolute inset-0 z-0"></a>
            </div>
            <?php endwhile; ?>
        </div>
        <?php else: ?>
            <div class="flex flex-col items-center justify-center py-12 md:py-16 text-slate-500 bg-white rounded-xl border-2 border-dashed border-slate-300 mx-auto max-w-lg">
                <svg class="w-12 h-12 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                <p>Belum ada paket tersedia saat ini.</p>
            </div>
        <?php endif; wp_reset_postdata(); ?>
    </div>
</div>

<!-- TABS (Tentang, FAQ, Testi) -->
<section id="tentang" class="bg-white py-10 md:py-12 scroll-mt-24 border-t border-slate-100">
    <div class="container mx-auto px-4 max-w-5xl">
        <!-- Tabs Menu: Scrollable on Mobile -->
        <div class="flex justify-start md:justify-center gap-2 mb-6 md:mb-8 overflow-x-auto pb-2 no-scrollbar snap-x">
            <button onclick="switchTab('about')" id="tab-about" class="tab-btn active px-5 py-2 md:px-6 rounded-full text-xs md:text-sm font-bold bg-teal-600 text-white transition snap-start shrink-0">Tentang</button>
            <button onclick="switchTab('faq')" id="tab-faq" class="tab-btn px-5 py-2 md:px-6 rounded-full text-xs md:text-sm font-bold text-slate-500 bg-slate-100 hover:bg-slate-200 transition snap-start shrink-0">FAQ</button>
            <button onclick="switchTab('testi')" id="tab-testi" class="tab-btn px-5 py-2 md:px-6 rounded-full text-xs md:text-sm font-bold text-slate-500 bg-slate-100 hover:bg-slate-200 transition snap-start shrink-0">Testimoni</button>
        </div>

        <div class="min-h-[200px]">
            <div id="content-about" class="tab-content fade-in">
                <div class="bg-slate-50 p-6 md:p-8 rounded-2xl border border-slate-100 prose max-w-none text-slate-600 text-sm md:text-base leading-relaxed">
                    <?php the_content(); ?>
                    <?php if($address): ?>
                        <div class="mt-6 pt-6 border-t border-slate-200">
                            <h4 class="font-bold text-slate-800 text-sm mb-2">Lokasi Kantor:</h4>
                            <p class="flex items-start gap-2 text-sm">
                                <span class="mt-1">📍</span> <?php echo esc_html($address); ?>
                            </p>
                            <?php if($maps_url): ?>
                                <div class="mt-4 aspect-video rounded-lg overflow-hidden bg-slate-200">
                                    <!-- Embed Maps Handling -->
                                    <iframe src="<?php echo esc_url($maps_url); ?>" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div id="content-faq" class="tab-content hidden space-y-3 fade-in">
                <?php if(!empty($faqs)): foreach($faqs as $faq): ?>
                <div class="border border-slate-200 rounded-xl overflow-hidden">
                    <button class="w-full text-left px-5 py-4 font-bold text-slate-800 bg-white hover:bg-slate-50 flex justify-between items-center text-sm md:text-base transition" onclick="toggleFaq(this)">
                        <span><?php echo esc_html($faq['q']); ?></span>
                        <svg class="w-5 h-5 text-slate-400 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="hidden px-5 py-4 bg-slate-50 text-slate-600 border-t border-slate-100 text-sm leading-relaxed"><?php echo nl2br(esc_html($faq['a'])); ?></div>
                </div>
                <?php endforeach; else: echo '<div class="text-center p-8 bg-slate-50 rounded-xl text-slate-500 text-sm">Belum ada FAQ yang ditambahkan.</div>'; endif; ?>
            </div>

            <div id="content-testi" class="tab-content hidden grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 fade-in">
                <?php if(!empty($testis)): foreach($testis as $testi): 
                    $img = isset($testi['img']) ? $testi['img'] : '';
                ?>
                <div class="bg-white p-5 md:p-6 rounded-2xl border border-slate-100 shadow-sm flex flex-col gap-4 h-full">
                    <div class="flex gap-3 md:gap-4 items-center">
                        <div class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-slate-200 overflow-hidden shrink-0">
                            <?php if($img): ?><img src="<?php echo esc_url($img); ?>" class="w-full h-full object-cover"><?php else: ?>
                                <div class="w-full h-full flex items-center justify-center bg-teal-100 text-teal-600 font-bold"><?php echo substr($testi['name'], 0, 1); ?></div>
                            <?php endif; ?>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm md:text-base"><?php echo esc_html($testi['name']); ?></h4>
                            <div class="flex text-amber-400 text-xs mt-0.5">★★★★★</div>
                        </div>
                    </div>
                    <p class="text-sm text-slate-500 italic leading-relaxed">"<?php echo esc_html($testi['text']); ?>"</p>
                </div>
                <?php endforeach; else: echo '<div class="col-span-2 text-center p-8 bg-slate-50 rounded-xl text-slate-500 text-sm">Belum ada testimoni.</div>'; endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- SECTION TRAVEL LAINNYA -->
<section class="py-12 md:py-16 bg-slate-50 border-t border-slate-200">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="text-center mb-8 md:mb-10">
            <h2 class="text-xl md:text-2xl font-bold text-slate-800 mb-2">Cari Pilihan Travel Lain?</h2>
            <p class="text-sm md:text-base text-slate-500">Lihat rekomendasi travel umroh terpercaya lainnya</p>
        </div>
        
        <!-- Grid Gap Adjusted: gap-3 on mobile -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-6">
            <?php
            $related_args = array(
                'post_type' => 'travel',
                'posts_per_page' => 4,
                'post__not_in' => array(get_the_ID()),
                'orderby' => 'rand'
            );
            $related_travels = new WP_Query($related_args);
            
            if($related_travels->have_posts()):
                while($related_travels->have_posts()): $related_travels->the_post();
                    $rel_id = get_the_ID();
                    $rel_logo = get_post_meta($rel_id, '_travel_logo', true);
                    $rel_thumb = has_post_thumbnail() ? get_the_post_thumbnail_url($rel_id, 'medium') : 'https://placehold.co/400x300/e2e8f0/64748b?text=Travel';
            ?>
            <a href="<?php the_permalink(); ?>" class="group bg-white rounded-xl shadow-sm hover:shadow-md transition border border-slate-100 overflow-hidden block h-full flex flex-col">
                <div class="h-24 md:h-32 bg-slate-200 relative overflow-hidden">
                    <img src="<?php echo esc_url($rel_thumb); ?>" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                    
                    <!-- LOGO -->
                    <?php if($rel_logo): ?>
                    <div class="absolute -bottom-6 left-1/2 -translate-x-1/2 bg-white p-1.5 md:p-2 rounded-xl shadow-md border border-slate-100 w-12 h-12 md:w-16 md:h-16 flex items-center justify-center z-10 overflow-hidden">
                        <img src="<?php echo esc_url($rel_logo); ?>" class="w-full h-full object-contain">
                    </div>
                    <?php endif; ?>
                </div>
                
                <div class="pt-8 pb-3 px-2 md:px-4 text-center mt-auto">
                    <h4 class="font-bold text-slate-800 text-xs md:text-sm group-hover:text-teal-600 transition line-clamp-2 mb-2"><?php the_title(); ?></h4>
                    <span class="text-[10px] md:text-xs text-teal-600 font-bold bg-teal-50 px-2 py-1 rounded-md">Lihat Profil</span>
                </div>
            </a>
            <?php endwhile; wp_reset_postdata(); else: ?>
                <div class="col-span-full text-center text-slate-400 py-10 text-sm">Belum ada travel lain yang terdaftar.</div>
            <?php endif; ?>
        </div>
        
        <div class="text-center mt-10 md:mt-12">
            <a href="<?php echo get_post_type_archive_link('travel'); ?>" class="inline-block bg-white text-teal-600 border border-teal-600 font-bold px-6 py-3 rounded-full hover:bg-teal-600 hover:text-white transition shadow-sm hover:shadow-md text-sm md:text-base">
                Lihat Semua Travel &rarr;
            </a>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    // Swiper Init
    new Swiper(".mySwiper", { 
        autoplay: { delay: 4000, disableOnInteraction: false }, 
        loop: true, 
        effect: 'fade', // Menambah efek fade agar lebih halus
        pagination: { el: ".swiper-pagination", clickable: true },
        navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" }
    });

    // Filter Logic
    const filterBtns = document.querySelectorAll('.filter-btn');
    const items = document.querySelectorAll('.package-item');
    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            // Reset buttons style
            filterBtns.forEach(b => { 
                b.className = 'filter-btn px-5 py-2 md:px-6 md:py-2 rounded-full text-xs md:text-sm font-bold text-slate-500 bg-white border border-slate-200 transition whitespace-nowrap snap-start shrink-0'; 
            });
            // Set Active style
            btn.className = 'filter-btn active px-5 py-2 md:px-6 md:py-2 rounded-full text-xs md:text-sm font-bold bg-teal-600 text-white shadow-md transition whitespace-nowrap snap-start shrink-0';
            
            const val = btn.dataset.filter;
            let hasVisible = false;

            items.forEach(item => {
                if (val === 'all' || item.classList.contains(val)) {
                    item.style.display = 'flex';
                    hasVisible = true;
                } else {
                    item.style.display = 'none';
                }
            });

            // Handle empty state visual if needed (optional)
        });
    });

    // Tab Logic
    window.switchTab = function(name) {
        // Hide all content
        document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
        // Show selected content
        document.getElementById('content-' + name).classList.remove('hidden');
        
        // Reset buttons
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.className = 'tab-btn px-5 py-2 md:px-6 md:py-2 rounded-full text-xs md:text-sm font-bold text-slate-500 bg-slate-100 hover:bg-slate-200 transition snap-start shrink-0';
        });
        // Active button
        document.getElementById('tab-' + name).className = 'tab-btn active px-5 py-2 md:px-6 md:py-2 rounded-full text-xs md:text-sm font-bold bg-teal-600 text-white transition snap-start shrink-0';
    };

    // FAQ Accordion Logic
    window.toggleFaq = function(btn) {
        const content = btn.nextElementSibling;
        const icon = btn.querySelector('svg');
        content.classList.toggle('hidden');
        if(!content.classList.contains('hidden')) {
            icon.classList.add('rotate-180');
            btn.classList.add('bg-slate-50');
        } else {
            icon.classList.remove('rotate-180');
            btn.classList.remove('bg-slate-50');
        }
    };
</script>

<?php get_footer(); ?>