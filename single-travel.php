<?php 
/**
 * Template Name: Single Travel Page (Fixed Header & Carousel)
 */
get_header(); 

$travel_id = get_the_ID();
$phone = get_post_meta($travel_id, '_travel_phone', true);
$address = get_post_meta($travel_id, '_travel_address', true);
$maps_url = get_post_meta($travel_id, '_travel_maps', true);
$faqs = get_post_meta($travel_id, '_travel_faqs', true) ?: [];
$testis = get_post_meta($travel_id, '_travel_testis', true) ?: [];

// BANNER LOGIC (CAROUSEL)
$b1 = get_post_meta($travel_id, '_travel_banner_1', true);
$b2 = get_post_meta($travel_id, '_travel_banner_2', true);
$b3 = get_post_meta($travel_id, '_travel_banner_3', true);
$banners = array_filter([$b1, $b2, $b3]);

// Jika kosong, pakai Featured Image
if (empty($banners)) {
    $banners[] = has_post_thumbnail() ? get_the_post_thumbnail_url($travel_id, 'full') : 'https://placehold.co/1920x800/0f172a/ffffff?text=Travel+Umroh+Terpercaya';
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
    $args = array( 'post_type' => 'umroh_package', 'posts_per_page' => -1, 'meta_key' => '_related_travel_id', 'meta_value' => $travel_id );
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
                    if ($terms) { foreach ($terms as $term) $used_terms[$term->term_id] = $term; }
                }
                $packages->rewind_posts();
                foreach($used_terms as $term): ?>
                <button class="filter-btn whitespace-nowrap px-6 py-2 rounded-full text-sm font-bold bg-white text-slate-600 border border-slate-200 hover:border-teal-500 hover:text-teal-600 transition-all" data-filter="cat-<?php echo $term->term_id; ?>">
                    <?php echo esc_html($term->name); ?>
                </button>
                <?php endforeach;
            } ?>
        </div>
    </div>

    <!-- GRID PAKET -->
    <div id="paket" class="container mx-auto px-4 md:px-6 py-10 scroll-mt-32">
        <?php if ($packages->have_posts()) : ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php while ($packages->have_posts()) : $packages->the_post(); 
                $price = get_post_meta(get_the_ID(), '_package_price', true);
                $img_src = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'large') : 'https://placehold.co/600x800/e2e8f0/64748b?text=Paket+Umroh';
                $post_terms = get_the_terms(get_the_ID(), 'package_category');
                $filter_classes = ''; if ($post_terms) { foreach ($post_terms as $t) $filter_classes .= ' cat-' . $t->term_id; }
            ?>
            <div class="package-item bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition flex flex-col h-full <?php echo $filter_classes; ?>">
                <div class="relative aspect-[4/3]">
                    <img src="<?php echo esc_url($img_src); ?>" class="w-full h-full object-cover">
                    <div class="absolute top-3 left-3 bg-white/90 px-3 py-1 rounded-full text-xs font-bold text-teal-700 uppercase">
                        <?php echo $post_terms ? $post_terms[0]->name : 'Promo'; ?>
                    </div>
                </div>
                <div class="p-5 flex flex-col flex-grow">
                    <h3 class="text-lg font-bold text-slate-800 mb-2 line-clamp-2"><?php the_title(); ?></h3>
                    <div class="mt-auto flex justify-between items-center pt-4 border-t border-slate-100">
                        <div class="text-xl font-bold text-teal-600"><?php echo esc_html($price ?: 'Hubungi'); ?></div>
                        <a href="https://api.whatsapp.com/send?phone=<?php echo esc_attr($phone); ?>&text=Info%20Paket:%20<?php the_title(); ?>" target="_blank" class="bg-slate-900 text-white p-2.5 rounded-lg hover:bg-teal-600 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
                <a href="https://api.whatsapp.com/send?phone=<?php echo esc_attr($phone); ?>&text=Info%20Paket:%20<?php the_title(); ?>" target="_blank" class="absolute inset-0 z-0"></a>
            </div>
            <?php endwhile; ?>
        </div>
        <?php else: ?>
            <div class="text-center py-16 text-slate-500 bg-white rounded-xl border border-dashed border-slate-300">Belum ada paket tersedia.</div>
        <?php endif; wp_reset_postdata(); ?>
    </div>
</div>

<!-- TABS (Tentang, FAQ, Testi) -->
<section id="tentang" class="bg-white py-12 scroll-mt-24">
    <div class="container mx-auto px-4 max-w-5xl">
        <!-- Tab Nav -->
        <div class="flex justify-center gap-2 mb-8 overflow-x-auto pb-2">
            <button onclick="switchTab('about')" id="tab-about" class="tab-btn active px-6 py-2 rounded-full text-sm font-bold bg-teal-600 text-white transition">Tentang</button>
            <button onclick="switchTab('faq')" id="tab-faq" class="tab-btn px-6 py-2 rounded-full text-sm font-bold text-slate-500 bg-slate-100 hover:bg-slate-200 transition">FAQ</button>
            <button onclick="switchTab('testi')" id="tab-testi" class="tab-btn px-6 py-2 rounded-full text-sm font-bold text-slate-500 bg-slate-100 hover:bg-slate-200 transition">Testimoni</button>
        </div>

        <div class="min-h-[200px]">
            <!-- About -->
            <div id="content-about" class="tab-content">
                <div class="bg-slate-50 p-8 rounded-2xl border border-slate-100 prose max-w-none text-slate-600">
                    <?php the_content(); ?>
                    <?php if($address): ?><p class="mt-4 pt-4 border-t border-slate-200 text-sm font-semibold">📍 <?php echo esc_html($address); ?></p><?php endif; ?>
                </div>
            </div>
            
            <!-- FAQ -->
            <div id="content-faq" class="tab-content hidden space-y-3">
                <?php if($faqs): foreach($faqs as $faq): ?>
                <div class="border border-slate-200 rounded-xl overflow-hidden">
                    <button class="w-full text-left px-5 py-4 font-bold text-slate-800 bg-white flex justify-between" onclick="this.nextElementSibling.classList.toggle('hidden')">
                        <?php echo esc_html($faq['q']); ?> <span>+</span>
                    </button>
                    <div class="hidden px-5 py-4 bg-slate-50 text-slate-600 border-t border-slate-100 text-sm"><?php echo nl2br(esc_html($faq['a'])); ?></div>
                </div>
                <?php endforeach; else: echo '<p class="text-center text-slate-400">Belum ada FAQ.</p>'; endif; ?>
            </div>

            <!-- Testi -->
            <div id="content-testi" class="tab-content hidden grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php if($testis): foreach($testis as $testi): 
                    $img = isset($testi['img']) ? $testi['img'] : '';
                ?>
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex gap-4 items-start">
                    <div class="w-12 h-12 rounded-full bg-slate-200 overflow-hidden shrink-0">
                        <?php if($img): ?><img src="<?php echo esc_url($img); ?>" class="w-full h-full object-cover"><?php endif; ?>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-800"><?php echo esc_html($testi['name']); ?></h4>
                        <p class="text-sm text-slate-500 mt-1">"<?php echo esc_html($testi['text']); ?>"</p>
                    </div>
                </div>
                <?php endforeach; else: echo '<p class="text-center text-slate-400 col-span-2">Belum ada testimoni.</p>'; endif; ?>
            </div>
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
            btn.className = 'tab-btn px-6 py-2 rounded-full text-sm font-bold text-slate-500 bg-slate-100 hover:bg-slate-200 transition';
        });
        document.getElementById('tab-' + name).className = 'tab-btn active px-6 py-2 rounded-full text-sm font-bold bg-teal-600 text-white transition';
    };
</script>

<?php get_footer(); ?>