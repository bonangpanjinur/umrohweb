<?php 
/**
 * Template Name: Single Travel Page (Full Responsive Flyer-Friendly)
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
    
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<!-- ========================================= -->
<!-- 1. HERO BANNER (Blur + Contain)           -->
<!-- ========================================= -->
<section class="relative h-[50vh] md:h-[70vh] bg-slate-900 w-full overflow-hidden group">
    <div class="swiper mySwiper h-full w-full">
        <div class="swiper-wrapper">
            <?php foreach($banners as $banner_img): ?>
            <div class="swiper-slide relative overflow-hidden flex items-center justify-center bg-slate-900">
                <!-- Background Blur (Mengisi ruang kosong) -->
                <div class="absolute inset-0 bg-cover bg-center blur-xl opacity-50 scale-110" 
                     style="background-image: url('<?php echo esc_url($banner_img); ?>');">
                </div>
                <!-- Main Image (Utuh) -->
                <img src="<?php echo esc_url($banner_img); ?>" 
                     class="relative w-full h-full object-contain z-10 shadow-lg" 
                     alt="<?php the_title(); ?>">
                <!-- Gradient Overlay Bawah -->
                <div class="absolute inset-x-0 bottom-0 h-32 bg-gradient-to-t from-slate-900/90 to-transparent z-20 pointer-events-none"></div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="swiper-pagination !bottom-8 z-30"></div>
        <?php if(count($banners) > 1): ?>
            <div class="swiper-button-next hidden md:flex z-30"></div>
            <div class="swiper-button-prev hidden md:flex z-30"></div>
        <?php endif; ?>
    </div>

    <!-- Title Overlay -->
    <div class="absolute inset-0 z-30 flex items-end pb-10 md:pb-16 justify-center pointer-events-none">
        <div class="container mx-auto px-4 text-center pointer-events-auto">
            <h1 class="text-2xl md:text-5xl lg:text-6xl font-extrabold text-white drop-shadow-md mb-2 md:mb-3 leading-tight">
                <?php the_title(); ?>
            </h1>
            <div class="inline-block bg-black/40 backdrop-blur-md rounded-full px-4 py-1 border border-white/10">
                <p class="text-slate-100 text-xs md:text-base font-medium">
                    Solusi Perjalanan Ibadah Umroh & Haji Terbaik
                </p>
            </div>
        </div>
    </div>
</section>

<!-- MAIN CONTENT CONTAINER -->
<div class="bg-slate-50 min-h-screen pb-20 -mt-6 relative z-20 rounded-t-[2rem] shadow-[0_-10px_40px_rgba(0,0,0,0.1)]">
    
    <?php
    $args = array( 'post_type' => 'umroh_package', 'posts_per_page' => -1, 'meta_key' => '_related_travel_id', 'meta_value' => $travel_id );
    $packages = new WP_Query($args);
    ?>

    <!-- 2. STICKY FILTER MENU -->
    <div class="sticky top-[75px] md:top-[80px] z-30 bg-white/95 backdrop-blur-md border-b border-slate-200 shadow-sm py-3 md:py-4">
        <div class="container mx-auto px-4 flex overflow-x-auto gap-2 md:gap-3 pb-1 no-scrollbar justify-start md:justify-center snap-x">
            <button class="filter-btn active whitespace-nowrap px-4 py-2 md:px-6 md:py-2 rounded-full text-xs md:text-sm font-bold bg-teal-600 text-white shadow-md transition-all snap-start shrink-0" data-filter="all">Semua Paket</button>
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
                <button class="filter-btn whitespace-nowrap px-4 py-2 md:px-6 md:py-2 rounded-full text-xs md:text-sm font-bold bg-white text-slate-600 border border-slate-200 hover:border-teal-500 hover:text-teal-600 transition-all snap-start shrink-0" data-filter="cat-<?php echo $term->term_id; ?>">
                    <?php echo esc_html($term->name); ?>
                </button>
                <?php endforeach;
            } ?>
        </div>
    </div>

    <!-- 3. GRID PAKET (Optimized) -->
    <div id="paket" class="container mx-auto px-4 md:px-6 py-8 md:py-12 scroll-mt-32">
        <?php if ($packages->have_posts()) : ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 md:gap-8">
            <?php while ($packages->have_posts()) : $packages->the_post(); 
                $price = get_post_meta(get_the_ID(), '_package_price', true);
                $duration = get_post_meta(get_the_ID(), '_package_duration', true);
                $airline = get_post_meta(get_the_ID(), '_package_airline', true);
                $hotel_star = get_post_meta(get_the_ID(), '_package_hotel_star', true);
                $date = get_post_meta(get_the_ID(), '_package_date', true);
                
                $img_src = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'large') : 'https://placehold.co/600x800/e2e8f0/64748b?text=Paket+Umroh';
                
                // Kategori & Filter Class
                $post_terms = get_the_terms(get_the_ID(), 'package_category');
                $filter_classes = ''; 
                $cat_name = 'Promo';
                if ($post_terms && !is_wp_error($post_terms)) { 
                    foreach ($post_terms as $t) $filter_classes .= ' cat-' . $t->term_id; 
                    $cat_name = $post_terms[0]->name;
                }
            ?>
            
            <div class="package-item bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col h-full group <?php echo $filter_classes; ?>">
                
                <!-- IMAGE AREA: Blur + Contain (Agar Flyer tidak terpotong) -->
                <div class="relative aspect-[4/5] md:aspect-[4/3] bg-slate-100 overflow-hidden">
                    <!-- Background Blur -->
                    <div class="absolute inset-0 bg-cover bg-center blur-sm opacity-50 scale-110" style="background-image: url('<?php echo esc_url($img_src); ?>');"></div>
                    <!-- Main Image (Contain) -->
                    <img src="<?php echo esc_url($img_src); ?>" class="relative w-full h-full object-contain z-10 transition-transform duration-700 group-hover:scale-105">
                    
                    <!-- Badges -->
                    <div class="absolute top-3 left-3 z-20 flex flex-col gap-2 items-start">
                         <span class="bg-teal-600 text-white text-[10px] md:text-xs font-bold px-3 py-1 rounded-full shadow-md uppercase tracking-wider">
                            <?php echo esc_html($cat_name); ?>
                        </span>
                    </div>
                    
                    <?php if($date): ?>
                    <div class="absolute bottom-3 right-3 z-20 bg-black/70 backdrop-blur text-white px-3 py-1 rounded-lg text-[10px] md:text-xs font-bold shadow-sm flex items-center gap-1.5 border border-white/10">
                        <svg class="w-3.5 h-3.5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <?php echo esc_html($date); ?>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- INFO AREA -->
                <div class="p-5 flex flex-col flex-grow">
                    <h3 class="text-lg font-bold text-slate-800 mb-3 leading-snug line-clamp-2 group-hover:text-teal-600 transition-colors"><?php the_title(); ?></h3>
                    
                    <!-- Icons Grid -->
                    <div class="grid grid-cols-2 gap-y-2 gap-x-3 text-xs md:text-sm text-slate-600 mb-5 pb-5 border-b border-slate-100">
                        <div class="flex items-center gap-2" title="Maskapai">
                            <span class="w-6 h-6 rounded-full bg-slate-100 flex items-center justify-center text-sm">✈️</span> 
                            <span class="truncate font-medium"><?php echo $airline ? esc_html($airline) : 'Direct'; ?></span>
                        </div>
                        <div class="flex items-center gap-2" title="Hotel">
                            <span class="w-6 h-6 rounded-full bg-slate-100 flex items-center justify-center text-sm">🏨</span> 
                            <span class="truncate font-medium"><?php echo $hotel_star ? '*' . esc_html($hotel_star) : 'Hotel *4'; ?></span>
                        </div>
                        <div class="flex items-center gap-2" title="Durasi">
                            <span class="w-6 h-6 rounded-full bg-slate-100 flex items-center justify-center text-sm">⏳</span> 
                            <span class="font-medium"><?php echo $duration ? esc_html($duration) : '9 Hari'; ?></span>
                        </div>
                        <div class="flex items-center gap-2 text-green-600" title="Status">
                            <span class="w-6 h-6 rounded-full bg-green-100 flex items-center justify-center text-sm">✅</span> 
                            <span class="font-bold">Pasti Berangkat</span>
                        </div>
                    </div>

                    <!-- Action Area -->
                    <div class="mt-auto flex items-center justify-between gap-3">
                        <div class="flex flex-col">
                            <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wide">Mulai Dari</span>
                            <span class="text-xl md:text-2xl font-extrabold text-teal-600"><?php echo esc_html($price ?: 'Hubungi'); ?></span>
                        </div>
                        <a href="https://api.whatsapp.com/send?phone=<?php echo esc_attr($phone); ?>&text=Assalamu'alaikum%2C%20saya%20tertarik%20paket%20<?php echo urlencode(get_the_title()); ?>" target="_blank" class="flex-shrink-0 bg-slate-900 hover:bg-teal-600 text-white p-3 rounded-xl transition-all shadow-lg hover:shadow-teal-500/30 active:scale-95">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
                
                <!-- Link Overlay -->
                <a href="https://api.whatsapp.com/send?phone=<?php echo esc_attr($phone); ?>&text=Info%20Paket:%20<?php the_title(); ?>" target="_blank" class="absolute inset-0 z-0"></a>
            </div>
            <?php endwhile; ?>
        </div>
        <?php else: ?>
            <div class="flex flex-col items-center justify-center py-16 text-slate-500 bg-white rounded-2xl border-2 border-dashed border-slate-200 mx-auto max-w-lg text-center px-6">
                <div class="bg-slate-50 p-4 rounded-full mb-4">
                    <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-700 mb-1">Belum Ada Paket</h3>
                <p class="text-sm">Saat ini belum ada paket perjalanan yang tersedia.</p>
            </div>
        <?php endif; wp_reset_postdata(); ?>
    </div>
</div>

<!-- 4. TABS SECTION (Tentang, FAQ, Testi) -->
<section id="tentang" class="bg-white py-12 border-t border-slate-100 scroll-mt-24">
    <div class="container mx-auto px-4 max-w-5xl">
        <!-- Tab Navigation -->
        <div class="flex justify-start md:justify-center gap-2 mb-8 overflow-x-auto pb-2 no-scrollbar snap-x">
            <button onclick="switchTab('about')" id="tab-about" class="tab-btn active px-5 py-2.5 rounded-full text-sm font-bold bg-teal-600 text-white shadow-md transition-all snap-start shrink-0">Tentang Kami</button>
            <button onclick="switchTab('faq')" id="tab-faq" class="tab-btn px-5 py-2.5 rounded-full text-sm font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 transition-all snap-start shrink-0">FAQ</button>
            <button onclick="switchTab('testi')" id="tab-testi" class="tab-btn px-5 py-2.5 rounded-full text-sm font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 transition-all snap-start shrink-0">Testimoni</button>
        </div>

        <!-- Tab Content -->
        <div class="min-h-[250px]">
            <!-- ABOUT -->
            <div id="content-about" class="tab-content fade-in">
                <div class="bg-slate-50 p-6 md:p-10 rounded-3xl border border-slate-100">
                    <div class="prose max-w-none text-slate-600 leading-relaxed text-sm md:text-base">
                        <?php the_content(); ?>
                    </div>
                    <?php if($address): ?>
                        <div class="mt-8 pt-8 border-t border-slate-200">
                            <h4 class="font-bold text-slate-800 mb-3 flex items-center gap-2">
                                <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                Lokasi Kantor
                            </h4>
                            <p class="text-slate-600 mb-4 ml-7"><?php echo esc_html($address); ?></p>
                            <?php if($maps_url): ?>
                                <div class="aspect-video w-full rounded-xl overflow-hidden shadow-sm border border-slate-200 bg-slate-200">
                                    <iframe src="<?php echo esc_url($maps_url); ?>" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- FAQ -->
            <div id="content-faq" class="tab-content hidden space-y-4 fade-in">
                <?php if(!empty($faqs)): foreach($faqs as $faq): ?>
                <div class="border border-slate-200 rounded-2xl bg-white overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                    <button class="w-full text-left px-6 py-5 font-bold text-slate-800 flex justify-between items-center text-sm md:text-base group" onclick="toggleFaq(this)">
                        <span class="group-hover:text-teal-600 transition-colors"><?php echo esc_html($faq['q']); ?></span>
                        <span class="bg-slate-100 p-1 rounded-full group-hover:bg-teal-50 transition-colors">
                            <svg class="w-5 h-5 text-slate-400 group-hover:text-teal-600 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </span>
                    </button>
                    <div class="hidden px-6 pb-6 pt-0 text-slate-600 text-sm leading-relaxed border-t border-slate-50 mt-2">
                        <div class="pt-4"><?php echo nl2br(esc_html($faq['a'])); ?></div>
                    </div>
                </div>
                <?php endforeach; else: echo '<div class="text-center p-12 bg-slate-50 rounded-3xl text-slate-500 border border-dashed border-slate-200">Belum ada FAQ yang ditambahkan.</div>'; endif; ?>
            </div>

            <!-- TESTIMONI -->
            <div id="content-testi" class="tab-content hidden grid grid-cols-1 md:grid-cols-2 gap-5 fade-in">
                <?php if(!empty($testis)): foreach($testis as $testi): $img = isset($testi['img']) ? $testi['img'] : ''; ?>
                <div class="bg-white p-6 md:p-8 rounded-2xl border border-slate-100 shadow-sm flex flex-col gap-4 h-full hover:shadow-md transition-shadow">
                    <div class="flex gap-4 items-center border-b border-slate-50 pb-4">
                        <div class="w-12 h-12 md:w-14 md:h-14 rounded-full bg-slate-100 overflow-hidden shrink-0 border-2 border-white shadow-sm">
                            <?php if($img): ?><img src="<?php echo esc_url($img); ?>" class="w-full h-full object-cover"><?php else: ?>
                                <div class="w-full h-full flex items-center justify-center bg-teal-600 text-white font-bold text-lg"><?php echo substr($testi['name'], 0, 1); ?></div>
                            <?php endif; ?>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-base"><?php echo esc_html($testi['name']); ?></h4>
                            <div class="flex text-amber-400 text-xs mt-1 gap-0.5">★★★★★</div>
                        </div>
                    </div>
                    <div class="relative">
                        <svg class="absolute -top-2 -left-2 w-8 h-8 text-slate-100 -z-10" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.896 14.353 15.993 15.025 15.291C15.697 14.589 16.606 14.062 17.752 13.71V13.682C17.752 13.682 17.472 13.682 16.912 13.682C15.82 13.682 14.966 13.346 14.35 12.674C13.734 12.002 13.426 11.05 13.426 9.818C13.426 8.502 13.804 7.424 14.56 6.584C15.316 5.744 16.424 5.324 17.884 5.324C19.34 5.324 20.448 5.758 21.208 6.626C21.968 7.494 22.348 8.656 22.348 10.112C22.348 11.876 21.844 13.486 20.836 14.942C19.828 16.398 18.512 17.658 16.888 18.722L14.017 21ZM5.017 21L5.017 18C5.017 16.896 5.353 15.993 6.025 15.291C6.697 14.589 7.606 14.062 8.752 13.71V13.682C8.752 13.682 8.472 13.682 7.912 13.682C6.82 13.682 5.966 13.346 5.35 12.674C4.734 12.002 4.426 11.05 4.426 9.818C4.426 8.502 4.804 7.424 5.56 6.584C6.316 5.744 7.424 5.324 8.884 5.324C10.34 5.324 11.448 5.758 12.208 6.626C12.968 7.494 13.348 8.656 13.348 10.112C13.348 11.876 12.844 13.486 11.836 14.942C10.828 16.398 9.512 17.658 7.888 18.722L5.017 21Z"/></svg>
                        <p class="text-slate-600 text-sm leading-relaxed italic relative z-10"><?php echo esc_html($testi['text']); ?></p>
                    </div>
                </div>
                <?php endforeach; else: echo '<div class="col-span-2 text-center p-12 bg-slate-50 rounded-3xl text-slate-500 border border-dashed border-slate-200">Belum ada testimoni.</div>'; endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- 5. TRAVEL LAINNYA (Grid & Image Adjusted) -->
<section class="py-16 bg-slate-50 border-t border-slate-200">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="text-center mb-10">
            <h2 class="text-xl md:text-2xl font-bold text-slate-800 mb-3">Pilihan Travel Lainnya</h2>
            <p class="text-slate-500 text-sm md:text-base max-w-xl mx-auto">Kami memiliki mitra travel terpercaya lainnya yang siap melayani ibadah Anda.</p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
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
            <a href="<?php the_permalink(); ?>" class="group bg-white rounded-2xl shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col h-full border border-slate-100">
                <!-- THUMBNAIL: Blur + Contain agar logo/kantor tidak terpotong -->
                <div class="h-28 md:h-36 bg-slate-100 relative overflow-hidden">
                    <div class="absolute inset-0 bg-cover bg-center blur-sm opacity-50 scale-110" style="background-image: url('<?php echo esc_url($rel_thumb); ?>');"></div>
                    <img src="<?php echo esc_url($rel_thumb); ?>" class="relative w-full h-full object-contain z-10 transition duration-500 group-hover:scale-110">
                    
                    <!-- Logo Circle -->
                    <?php if($rel_logo): ?>
                    <div class="absolute -bottom-5 left-1/2 -translate-x-1/2 bg-white p-1.5 rounded-full shadow-md border border-slate-100 w-12 h-12 flex items-center justify-center z-20">
                        <img src="<?php echo esc_url($rel_logo); ?>" class="w-full h-full object-contain rounded-full">
                    </div>
                    <?php endif; ?>
                </div>
                
                <div class="pt-8 pb-4 px-3 text-center mt-auto">
                    <h4 class="font-bold text-slate-800 text-xs md:text-sm group-hover:text-teal-600 transition-colors line-clamp-2 mb-3 leading-snug"><?php the_title(); ?></h4>
                    <span class="text-[10px] md:text-xs font-bold text-teal-600 bg-teal-50 border border-teal-100 px-3 py-1 rounded-full group-hover:bg-teal-600 group-hover:text-white transition-colors">Kunjungi Profil</span>
                </div>
            </a>
            <?php endwhile; wp_reset_postdata(); else: ?>
                <div class="col-span-full text-center text-slate-400 py-10 text-sm">Belum ada travel lain.</div>
            <?php endif; ?>
        </div>
        
        <div class="text-center mt-10">
            <a href="<?php echo get_post_type_archive_link('travel'); ?>" class="inline-flex items-center gap-2 bg-white text-teal-700 border border-teal-200 font-bold px-6 py-3 rounded-full hover:bg-teal-600 hover:text-white hover:border-teal-600 transition-all shadow-sm hover:shadow-md text-sm">
                Lihat Semua Travel 
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
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
        effect: 'fade', 
        pagination: { el: ".swiper-pagination", clickable: true },
        navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" }
    });

    // Filter Logic
    const filterBtns = document.querySelectorAll('.filter-btn');
    const items = document.querySelectorAll('.package-item');
    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => { 
                b.className = 'filter-btn px-4 py-2 md:px-6 md:py-2 rounded-full text-xs md:text-sm font-bold text-slate-600 bg-white border border-slate-200 transition-all snap-start shrink-0 hover:border-teal-500'; 
            });
            btn.className = 'filter-btn active px-4 py-2 md:px-6 md:py-2 rounded-full text-xs md:text-sm font-bold bg-teal-600 text-white shadow-md transition-all snap-start shrink-0';
            
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
            btn.className = 'tab-btn px-5 py-2.5 rounded-full text-sm font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 transition-all snap-start shrink-0';
        });
        document.getElementById('tab-' + name).className = 'tab-btn active px-5 py-2.5 rounded-full text-sm font-bold bg-teal-600 text-white shadow-md transition-all snap-start shrink-0';
    };

    // FAQ Logic
    window.toggleFaq = function(btn) {
        const content = btn.nextElementSibling;
        const icon = btn.querySelector('svg');
        content.classList.toggle('hidden');
        
        if(!content.classList.contains('hidden')) {
            icon.classList.add('rotate-180');
            btn.classList.add('text-teal-700');
        } else {
            icon.classList.remove('rotate-180');
            btn.classList.remove('text-teal-700');
        }
    };
</script>

<?php get_footer(); ?>