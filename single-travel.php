<?php 
/**
 * Template Name: Single Travel Page (Ultimate Design)
 */
get_header(); 

$travel_id = get_the_ID();
$phone = get_post_meta($travel_id, '_travel_phone', true);
$address = get_post_meta($travel_id, '_travel_address', true);
$maps_url = get_post_meta($travel_id, '_travel_maps', true);
$faqs = get_post_meta($travel_id, '_travel_faqs', true) ?: [];
$testis = get_post_meta($travel_id, '_travel_testis', true) ?: [];

// Banners
$b1 = get_post_meta($travel_id, '_travel_banner_1', true);
$b2 = get_post_meta($travel_id, '_travel_banner_2', true);
$b3 = get_post_meta($travel_id, '_travel_banner_3', true);
$banners = array_filter([$b1, $b2, $b3]);
if (empty($banners)) {
    $banners[] = has_post_thumbnail() ? get_the_post_thumbnail_url($travel_id, 'full') : 'https://placehold.co/1920x800/0f172a/ffffff?text=Travel+Umroh+Terpercaya';
}
?>

<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<!-- === HERO SLIDER === -->
<section class="relative h-[50vh] md:h-[70vh] bg-slate-900 group">
    <div class="swiper mySwiper h-full w-full absolute inset-0 z-0">
        <div class="swiper-wrapper">
            <?php foreach($banners as $banner_img): ?>
            <div class="swiper-slide relative">
                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-[8000ms] scale-105 hover:scale-110" style="background-image: url('<?php echo esc_url($banner_img); ?>');"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/50 to-transparent opacity-90"></div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php if(count($banners)>1): ?><div class="swiper-pagination"></div><?php endif; ?>
    </div>

    <!-- Hero Content -->
    <div class="absolute inset-0 z-10 flex items-end pb-20 justify-center pointer-events-none">
        <div class="container mx-auto px-6 text-center pointer-events-auto">
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md border border-white/20 px-4 py-1.5 rounded-full mb-6">
                <span class="relative flex h-2 w-2">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                </span>
                <span class="text-xs font-bold tracking-widest uppercase text-white">Partner Resmi Terverifikasi</span>
            </div>
            <h1 class="text-4xl md:text-7xl font-extrabold mb-4 tracking-tight text-white drop-shadow-2xl leading-tight"><?php the_title(); ?></h1>
            <p class="text-slate-200 text-base md:text-xl max-w-2xl mx-auto leading-relaxed drop-shadow-md">
                Penyelenggara perjalanan ibadah umroh dan haji khusus dengan pelayanan profesional dan sesuai sunnah.
            </p>
        </div>
    </div>
</section>


<!-- === MAIN CONTENT === -->
<div class="bg-slate-50 min-h-screen pb-24 relative z-20 -mt-8 rounded-t-[2.5rem] shadow-[0_-10px_40px_rgba(0,0,0,0.1)]">
    
    <?php
    $args = array( 'post_type' => 'umroh_package', 'posts_per_page' => -1, 'meta_key' => '_related_travel_id', 'meta_value' => $travel_id );
    $packages = new WP_Query($args);
    ?>

    <!-- STICKY FILTER BAR -->
    <div class="sticky top-[72px] z-30 bg-white/90 backdrop-blur-md border-b border-slate-200/60 shadow-sm transition-all duration-300">
        <div class="container mx-auto px-4 md:px-6 py-4">
            <div class="flex overflow-x-auto gap-3 pb-1 no-scrollbar items-center md:justify-center">
                <!-- Tombol All -->
                <button class="filter-btn active whitespace-nowrap px-6 py-2.5 rounded-full text-sm font-bold bg-teal-600 text-white shadow-lg shadow-teal-600/30 ring-2 ring-teal-600 ring-offset-2 transition-all" data-filter="all">
                    Semua Paket
                </button>
                
                <?php 
                if ($packages->have_posts()) {
                    $used_terms = array();
                    while ($packages->have_posts()) { 
                        $packages->the_post(); 
                        $terms = get_the_terms(get_the_ID(), 'package_category');
                        if ($terms) { foreach ($terms as $term) $used_terms[$term->term_id] = $term; }
                    }
                    $packages->rewind_posts();
                    
                    foreach($used_terms as $term): ?>
                    <button class="filter-btn whitespace-nowrap px-6 py-2.5 rounded-full text-sm font-bold bg-white text-slate-600 border border-slate-200 hover:border-teal-500 hover:text-teal-600 transition-all" data-filter="cat-<?php echo $term->term_id; ?>">
                        <?php echo esc_html($term->name); ?>
                    </button>
                    <?php endforeach;
                } ?>
            </div>
        </div>
    </div>

    <!-- GRID PAKET -->
    <div id="paket" class="container mx-auto px-4 md:px-6 py-12 scroll-mt-32">
        <?php if ($packages->have_posts()) : ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php while ($packages->have_posts()) : $packages->the_post(); 
                // Data Meta
                $post_terms = get_the_terms(get_the_ID(), 'package_category');
                $filter_classes = ''; if ($post_terms) { foreach ($post_terms as $t) $filter_classes .= ' cat-' . $t->term_id; }
                
                $price = get_post_meta(get_the_ID(), '_package_price', true);
                $duration = get_post_meta(get_the_ID(), '_package_duration', true);
                $airline = get_post_meta(get_the_ID(), '_package_airline', true);
                $hotel_star = get_post_meta(get_the_ID(), '_package_hotel_star', true);
                $date = get_post_meta(get_the_ID(), '_package_date', true);
                
                $img_src = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'large') : 'https://placehold.co/600x800/e2e8f0/64748b?text=Paket+Umroh';
            ?>
            
            <!-- PREMIUM CARD -->
            <div class="package-item group bg-white rounded-3xl border border-slate-100 shadow-lg shadow-slate-200/50 overflow-hidden hover:shadow-2xl hover:shadow-teal-900/10 hover:-translate-y-2 transition-all duration-300 flex flex-col h-full <?php echo $filter_classes; ?>">
                
                <!-- Image Header -->
                <div class="relative aspect-[4/3] overflow-hidden">
                    <img src="<?php echo esc_url($img_src); ?>" alt="<?php the_title(); ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-80"></div>
                    
                    <!-- Badges -->
                    <div class="absolute top-4 left-4 flex gap-2">
                        <?php if($post_terms): $first = reset($post_terms); ?>
                        <span class="bg-white/95 backdrop-blur text-teal-700 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wide shadow-sm">
                            <?php echo $first->name; ?>
                        </span>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Date Badge -->
                    <?php if($date): ?>
                    <div class="absolute bottom-4 left-4 text-white">
                        <div class="flex items-center gap-1.5 text-xs font-medium bg-black/30 backdrop-blur-md px-3 py-1.5 rounded-lg border border-white/20">
                            <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <?php echo esc_html($date); ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Body Content -->
                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="text-xl font-bold text-slate-800 mb-3 leading-snug group-hover:text-teal-600 transition-colors">
                        <?php the_title(); ?>
                    </h3>
                    
                    <!-- Meta Info Grid -->
                    <div class="grid grid-cols-2 gap-y-3 gap-x-2 text-sm text-slate-500 mb-6 border-b border-slate-100 pb-6">
                        <!-- Maskapai -->
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                            </div>
                            <span class="font-medium text-slate-700 truncate"><?php echo $airline ?: 'Direct Flight'; ?></span>
                        </div>
                        <!-- Hotel -->
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-amber-400">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            </div>
                            <span class="font-medium text-slate-700">Hotel *<?php echo $hotel_star ?: '4'; ?></span>
                        </div>
                        <!-- Durasi -->
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <span class="font-medium text-slate-700"><?php echo $duration ?: '9 Hari'; ?></span>
                        </div>
                        <!-- Seat -->
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-full bg-green-50 flex items-center justify-center text-green-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="font-medium text-green-700">Tersedia</span>
                        </div>
                    </div>

                    <!-- Footer: Price & Action -->
                    <div class="mt-auto">
                        <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider mb-1">Harga Paket</p>
                        <div class="flex items-center justify-between gap-4">
                            <div class="text-2xl font-extrabold text-teal-600 tracking-tight">
                                <?php echo esc_html($price ?: 'Hubungi'); ?>
                            </div>
                            <a href="https://api.whatsapp.com/send?phone=<?php echo esc_attr($phone); ?>&text=Assalamu'alaikum%2C%20saya%20tertarik%20paket%20<?php echo urlencode(get_the_title()); ?>" target="_blank" class="flex-shrink-0 bg-slate-900 text-white p-3 rounded-xl hover:bg-teal-600 transition-colors shadow-lg hover:shadow-teal-500/30">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Full Card Link (UX) -->
                <a href="https://api.whatsapp.com/send?phone=<?php echo esc_attr($phone); ?>&text=Assalamu'alaikum%2C%20saya%20tertarik%20paket%20<?php echo urlencode(get_the_title()); ?>" target="_blank" class="absolute inset-0 z-0"></a>
            </div>
            <?php endwhile; ?>
        </div>
        <?php else: ?>
            <div class="text-center py-20 bg-white rounded-3xl border border-dashed border-slate-300">
                <div class="inline-block p-4 bg-slate-50 rounded-full mb-4 text-slate-400">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-600">Belum Ada Paket</h3>
                <p class="text-slate-400">Admin belum mengupload paket untuk travel ini.</p>
            </div>
        <?php endif; wp_reset_postdata(); ?>
    </div>
</div>

<!-- INFO TABS SECTION -->
<section id="tentang" class="bg-white border-t border-slate-100 pt-12 pb-20 scroll-mt-20">
    <div class="container mx-auto px-4 md:px-6 max-w-5xl">
        
        <!-- Tab Nav -->
        <div class="flex justify-center mb-10 overflow-x-auto no-scrollbar pb-2">
            <div class="bg-slate-100 p-1.5 rounded-full inline-flex">
                <button onclick="switchTab('about')" id="tab-about" class="tab-btn active px-8 py-3 rounded-full text-sm font-bold text-white bg-teal-600 shadow-md transition-all">Tentang</button>
                <button onclick="switchTab('faq')" id="tab-faq" class="tab-btn px-8 py-3 rounded-full text-sm font-bold text-slate-500 hover:text-slate-700 transition-all">FAQ</button>
                <button onclick="switchTab('testi')" id="tab-testi" class="tab-btn px-8 py-3 rounded-full text-sm font-bold text-slate-500 hover:text-slate-700 transition-all">Testimoni</button>
            </div>
        </div>

        <div class="min-h-[300px]">
            <!-- About -->
            <div id="content-about" class="tab-content fade-in-up">
                <div class="bg-slate-50 rounded-3xl p-8 md:p-12 border border-slate-100">
                    <h3 class="text-2xl font-bold text-slate-800 mb-6">Profil Perusahaan</h3>
                    <div class="prose max-w-none text-slate-600 leading-relaxed"><?php the_content(); ?></div>
                    
                    <?php if($address): ?>
                    <div class="mt-8 pt-8 border-t border-slate-200">
                        <h4 class="font-bold text-slate-800 mb-2">Kantor Pusat</h4>
                        <p class="text-slate-600 mb-4"><?php echo nl2br(esc_html($address)); ?></p>
                        <?php if($maps_url): ?>
                        <iframe src="<?php echo esc_url($maps_url); ?>" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" class="rounded-xl shadow-sm"></iframe>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- FAQ -->
            <div id="content-faq" class="tab-content hidden fade-in-up">
                <div class="space-y-4 max-w-3xl mx-auto">
                    <?php if(!empty($faqs)): foreach($faqs as $faq): ?>
                    <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition">
                        <button class="w-full text-left px-6 py-5 font-bold text-slate-800 flex justify-between items-center" onclick="this.nextElementSibling.classList.toggle('hidden'); this.querySelector('svg').classList.toggle('rotate-180')">
                            <?php echo esc_html($faq['q']); ?>
                            <svg class="w-5 h-5 text-slate-400 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div class="hidden px-6 pb-6 text-slate-600 leading-relaxed bg-slate-50/50 pt-2 border-t border-slate-100"><?php echo nl2br(esc_html($faq['a'])); ?></div>
                    </div>
                    <?php endforeach; else: echo '<p class="text-center text-slate-400">Tidak ada data.</p>'; endif; ?>
                </div>
            </div>

            <!-- Testimoni -->
            <div id="testimoni"></div>
            <div id="content-testi" class="tab-content hidden fade-in-up">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <?php if(!empty($testis)): foreach($testis as $testi): ?>
                    <div class="bg-white border border-slate-200 p-8 rounded-3xl relative shadow-sm hover:shadow-md transition">
                        <svg class="w-10 h-10 text-teal-100 absolute top-6 right-6" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.896 14.389 16.03 15.133 15.402C15.877 14.774 16.853 14.46 18.061 14.46L18.061 21L14.017 21ZM5 21L5 18C5 16.896 5.372 16.03 6.116 15.402C6.86 14.774 7.836 14.46 9.044 14.46L9.044 21L5 21ZM16.052 13.018C15.028 13.018 14.156 12.636 13.436 11.872C12.716 11.108 12.356 10.15 12.356 8.998C12.356 7.854 12.716 6.896 13.436 6.124C14.156 5.352 15.028 4.966 16.052 4.966C17.076 4.966 17.948 5.352 18.668 6.124C19.388 6.896 19.748 7.854 19.748 8.998C19.748 10.15 19.388 11.108 18.668 11.872C17.948 12.636 17.076 13.018 16.052 13.018ZM7.035 13.018C6.011 13.018 5.139 12.636 4.419 11.872C3.699 11.108 3.339 10.15 3.339 8.998C3.339 7.854 3.699 6.896 4.419 6.124C5.139 5.352 6.011 4.966 7.035 4.966C8.059 4.966 8.931 5.352 9.651 6.124C10.371 6.896 10.731 7.854 10.731 8.998C10.731 10.15 10.371 11.108 9.651 11.872C8.931 12.636 8.059 13.018 7.035 13.018Z"/></svg>
                        <p class="text-slate-600 italic mb-6 leading-relaxed">"<?php echo esc_html($testi['text']); ?>"</p>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-teal-600 text-white flex items-center justify-center font-bold text-lg"><?php echo substr($testi['name'], 0, 1); ?></div>
                            <span class="font-bold text-slate-800"><?php echo esc_html($testi['name']); ?></span>
                        </div>
                    </div>
                    <?php endforeach; else: echo '<p class="text-center text-slate-400 col-span-2">Tidak ada data.</p>'; endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    new Swiper(".mySwiper", { spaceBetween: 0, centeredSlides: true, speed: 1500, effect: 'fade', autoplay: { delay: 6000, disableOnInteraction: false }, pagination: { el: ".swiper-pagination", clickable: true } });

    // Filter Logic
    const filterBtns = document.querySelectorAll('.filter-btn');
    const items = document.querySelectorAll('.package-item');
    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => {
                b.classList.remove('active', 'bg-teal-600', 'text-white', 'shadow-lg', 'ring-2');
                b.classList.add('bg-white', 'text-slate-600', 'border-slate-200');
            });
            btn.classList.add('active', 'bg-teal-600', 'text-white', 'shadow-lg', 'ring-2');
            btn.classList.remove('bg-white', 'text-slate-600', 'border-slate-200');

            const filterValue = btn.getAttribute('data-filter');
            items.forEach(item => {
                if(filterValue === 'all' || item.classList.contains(filterValue)) {
                    item.parentElement.style.display = 'block';
                    setTimeout(() => { item.classList.remove('opacity-0', 'scale-95'); item.classList.add('opacity-100', 'scale-100'); }, 50);
                } else {
                    item.parentElement.style.display = 'none';
                    item.classList.add('opacity-0', 'scale-95');
                }
            });
        });
    });

    // Tab Logic
    window.switchTab = function(tabName) {
        document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('bg-teal-600', 'text-white', 'shadow-md');
            btn.classList.add('text-slate-500');
        });
        document.getElementById('content-' + tabName).classList.remove('hidden');
        const activeBtn = document.getElementById('tab-' + tabName);
        activeBtn.classList.add('bg-teal-600', 'text-white', 'shadow-md');
        activeBtn.classList.remove('text-slate-500');
    };
    
    // Auto-switch hash
    const hash = window.location.hash;
    if(hash === '#testimoni') switchTab('testi');
    if(hash === '#tentang') switchTab('about');
});
</script>

<?php get_footer(); ?>