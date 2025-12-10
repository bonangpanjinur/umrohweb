<?php 
/**
 * Template Name: Single Travel Page (Premium UI/UX)
 */
get_header(); 

// 1. AMBIL DATA
$travel_id = get_the_ID();
$phone = get_post_meta($travel_id, '_travel_phone', true);
$address = get_post_meta($travel_id, '_travel_address', true);
$maps_url = get_post_meta($travel_id, '_travel_maps', true);
$faqs = get_post_meta($travel_id, '_travel_faqs', true) ?: [];
$testis = get_post_meta($travel_id, '_travel_testis', true) ?: [];

// Fallback Banner
$banner_url = has_post_thumbnail() ? get_the_post_thumbnail_url($travel_id, 'full') : 'https://placehold.co/1920x800/0f172a/ffffff?text=Travel+Umroh+Amanah';
?>

<style>
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<!-- HERO SECTION -->
<section class="relative h-[40vh] md:h-[50vh] flex items-end pb-12 justify-center text-white bg-slate-900 overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center bg-fixed transition-transform duration-1000 hover:scale-105" 
         style="background-image: url('<?php echo esc_url($banner_url); ?>');">
    </div>
    <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/60 to-transparent"></div>
    
    <div class="relative z-10 container mx-auto px-6 text-center">
        <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md border border-white/20 px-4 py-1.5 rounded-full mb-4">
            <svg class="w-4 h-4 text-blue-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812z" clip-rule="evenodd"></path></svg>
            <span class="text-xs font-semibold tracking-wide uppercase text-blue-50">Partner Resmi</span>
        </div>
        <h1 class="text-3xl md:text-5xl font-extrabold mb-2 tracking-tight"><?php the_title(); ?></h1>
        <p class="text-slate-300 text-sm md:text-lg max-w-2xl mx-auto line-clamp-2">
            Melayani perjalanan ibadah ke Tanah Suci dengan amanah dan profesional.
        </p>
    </div>
</section>

<!-- MAIN CONTENT -->
<div class="bg-slate-50 min-h-screen pb-20">
    
    <?php
    $args = array(
        'post_type' => 'umroh_package',
        'posts_per_page' => -1, 
        'meta_key' => '_related_travel_id',
        'meta_value' => $travel_id
    );
    $packages = new WP_Query($args);

    if ($packages->have_posts()) :
        $used_terms = array(); 
        while ($packages->have_posts()) : $packages->the_post();
            $terms = get_the_terms(get_the_ID(), 'package_category');
            if ($terms && !is_wp_error($terms)) {
                foreach ($terms as $term) {
                    $used_terms[$term->term_id] = $term;
                }
            }
        endwhile;
        $packages->rewind_posts();
    ?>

    <!-- STICKY FILTER BAR -->
    <div class="sticky top-0 z-30 bg-white/80 backdrop-blur-md border-b border-slate-200 shadow-sm transition-all duration-300">
        <div class="container mx-auto px-4 md:px-6 py-3 md:py-4">
            <div class="flex overflow-x-auto gap-3 pb-1 no-scrollbar items-center md:justify-center">
                <button class="filter-btn active whitespace-nowrap px-5 py-2 rounded-full text-sm font-bold bg-teal-600 text-white shadow-md shadow-teal-200" data-filter="all">Semua Paket</button>
                <?php foreach($used_terms as $term): ?>
                <button class="filter-btn whitespace-nowrap px-5 py-2 rounded-full text-sm font-bold bg-white text-slate-600 border border-slate-200 hover:border-teal-500 hover:text-teal-600" data-filter="cat-<?php echo $term->term_id; ?>">
                    <?php echo esc_html($term->name); ?>
                </button>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- GRID PAKET (ID: #paket) -->
    <div id="paket" class="container mx-auto px-4 md:px-6 py-8 scroll-mt-24">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
            <?php while ($packages->have_posts()) : $packages->the_post(); 
                $post_terms = get_the_terms(get_the_ID(), 'package_category');
                $filter_classes = '';
                if ($post_terms) { foreach ($post_terms as $t) $filter_classes .= ' cat-' . $t->term_id; }
                $price = get_post_meta(get_the_ID(), '_package_price', true);
                $img_src = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'large') : 'https://placehold.co/600x800/e2e8f0/64748b?text=Flayer+Paket';
            ?>
            
            <div class="package-item bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col h-full group <?php echo $filter_classes; ?>">
                <div class="relative aspect-[4/5] md:aspect-[4/3] overflow-hidden bg-slate-100">
                    <img src="<?php echo esc_url($img_src); ?>" alt="<?php the_title(); ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <?php if($post_terms): $first_term = reset($post_terms); ?>
                    <span class="absolute top-4 left-4 bg-white/90 backdrop-blur text-teal-700 text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                        <?php echo $first_term->name; ?>
                    </span>
                    <?php endif; ?>
                </div>

                <div class="p-5 flex flex-col flex-grow">
                    <h3 class="text-lg font-bold text-slate-800 mb-2 leading-tight group-hover:text-teal-600 transition-colors">
                        <?php the_title(); ?>
                    </h3>
                    <div class="flex items-center gap-4 text-xs text-slate-500 mb-4 border-b border-slate-100 pb-4">
                        <div class="flex items-center gap-1"><span class="text-amber-400">★★★★</span> Hotel</div>
                        <div class="flex items-center gap-1">✈️ Direct</div>
                        <div class="flex items-center gap-1">📅 Sesuai Jadwal</div>
                    </div>
                    <div class="mt-auto">
                        <p class="text-slate-400 text-xs mb-1">Mulai dari</p>
                        <div class="flex justify-between items-end">
                            <div class="text-xl md:text-2xl font-extrabold text-teal-600">
                                <?php echo esc_html($price ?: 'Hubungi Kami'); ?>
                            </div>
                            <a href="https://api.whatsapp.com/send?phone=<?php echo esc_attr($phone); ?>&text=Assalamu'alaikum%2C%20saya%20tertarik%20paket%20<?php echo urlencode(get_the_title()); ?>" target="_blank" class="bg-teal-50 text-teal-700 p-2 rounded-lg hover:bg-teal-600 hover:text-white transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
                <a href="https://api.whatsapp.com/send?phone=<?php echo esc_attr($phone); ?>&text=Assalamu'alaikum%2C%20saya%20tertarik%20paket%20<?php echo urlencode(get_the_title()); ?>" target="_blank" class="absolute inset-0 z-0"></a>
            </div>
            <?php endwhile; ?>
        </div>
    </div>

    <?php else: ?>
    <div class="container mx-auto px-6 py-20 text-center">
        <div class="inline-block p-6 bg-slate-100 rounded-full mb-4">
            <svg class="w-12 h-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
        </div>
        <h3 class="text-xl font-bold text-slate-700">Belum Ada Paket Tersedia</h3>
        <p class="text-slate-500">Travel ini belum mengupload paket umroh terbaru mereka.</p>
    </div>
    <?php endif; wp_reset_postdata(); ?>

</div>

<!-- INFO TABS SECTION (ID: #tentang & #testimoni) -->
<section id="tentang" class="bg-white border-t border-slate-200 scroll-mt-24">
    <div class="container mx-auto px-4 md:px-6 py-12 max-w-5xl">
        
        <div class="flex justify-center border-b border-slate-200 mb-8 overflow-x-auto no-scrollbar">
            <button onclick="switchTab('about')" id="tab-about" class="tab-btn active px-6 py-3 text-sm md:text-base font-bold text-teal-600 border-b-2 border-teal-600 transition-all whitespace-nowrap">Tentang Travel</button>
            <button onclick="switchTab('faq')" id="tab-faq" class="tab-btn px-6 py-3 text-sm md:text-base font-medium text-slate-500 hover:text-teal-600 border-b-2 border-transparent hover:border-teal-200 transition-all whitespace-nowrap">FAQ</button>
            <button onclick="switchTab('testi')" id="tab-testi" class="tab-btn px-6 py-3 text-sm md:text-base font-medium text-slate-500 hover:text-teal-600 border-b-2 border-transparent hover:border-teal-200 transition-all whitespace-nowrap">Testimoni</button>
        </div>

        <div class="min-h-[300px]">
            <div id="content-about" class="tab-content fade-in-up">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="md:col-span-2 prose max-w-none text-slate-600">
                        <h3 class="text-2xl font-bold text-slate-800 mb-4">Profil Perusahaan</h3>
                        <?php the_content(); ?>
                    </div>
                    <div class="md:col-span-1">
                        <?php if($address): ?>
                        <div class="bg-slate-50 p-6 rounded-xl border border-slate-100 shadow-sm">
                            <h4 class="font-bold text-slate-800 mb-3 flex items-center gap-2">
                                <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                Kantor Pusat
                            </h4>
                            <p class="text-sm text-slate-600 mb-4"><?php echo nl2br(esc_html($address)); ?></p>
                            <?php if($maps_url): ?>
                            <a href="<?php echo esc_url($maps_url); ?>" target="_blank" class="text-sm font-bold text-teal-600 hover:underline">Lihat di Google Maps &rarr;</a>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div id="content-faq" class="tab-content hidden fade-in-up">
                <div class="max-w-3xl mx-auto space-y-4">
                    <?php if(!empty($faqs)): foreach($faqs as $faq): ?>
                    <div class="border border-slate-200 rounded-lg overflow-hidden">
                        <button class="w-full text-left px-6 py-4 font-semibold text-slate-800 bg-slate-50 hover:bg-white transition-colors flex justify-between items-center" onclick="this.nextElementSibling.classList.toggle('hidden'); this.querySelector('svg').classList.toggle('rotate-180')">
                            <?php echo esc_html($faq['q']); ?>
                            <svg class="w-5 h-5 text-slate-400 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div class="hidden px-6 py-4 text-slate-600 border-t border-slate-100 bg-white leading-relaxed"><?php echo nl2br(esc_html($faq['a'])); ?></div>
                    </div>
                    <?php endforeach; else: ?>
                        <p class="text-center text-slate-500">Belum ada data FAQ.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- ID TESTIMONI UNTUK MENU SCROLL -->
            <div id="testimoni"></div>
            <div id="content-testi" class="tab-content hidden fade-in-up">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <?php if(!empty($testis)): foreach($testis as $testi): ?>
                    <div class="bg-teal-50 p-6 rounded-xl border border-teal-100 relative">
                        <svg class="w-8 h-8 text-teal-200 absolute top-4 right-4" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.896 14.389 16.03 15.133 15.402C15.877 14.774 16.853 14.46 18.061 14.46L18.061 21L14.017 21ZM5 21L5 18C5 16.896 5.372 16.03 6.116 15.402C6.86 14.774 7.836 14.46 9.044 14.46L9.044 21L5 21ZM16.052 13.018C15.028 13.018 14.156 12.636 13.436 11.872C12.716 11.108 12.356 10.15 12.356 8.998C12.356 7.854 12.716 6.896 13.436 6.124C14.156 5.352 15.028 4.966 16.052 4.966C17.076 4.966 17.948 5.352 18.668 6.124C19.388 6.896 19.748 7.854 19.748 8.998C19.748 10.15 19.388 11.108 18.668 11.872C17.948 12.636 17.076 13.018 16.052 13.018ZM7.035 13.018C6.011 13.018 5.139 12.636 4.419 11.872C3.699 11.108 3.339 10.15 3.339 8.998C3.339 7.854 3.699 6.896 4.419 6.124C5.139 5.352 6.011 4.966 7.035 4.966C8.059 4.966 8.931 5.352 9.651 6.124C10.371 6.896 10.731 7.854 10.731 8.998C10.731 10.15 10.371 11.108 9.651 11.872C8.931 12.636 8.059 13.018 7.035 13.018Z"/></svg>
                        <p class="text-slate-700 italic mb-4 leading-relaxed">"<?php echo esc_html($testi['text']); ?>"</p>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-teal-200 text-teal-700 flex items-center justify-center font-bold text-xs">
                                <?php echo substr($testi['name'], 0, 1); ?>
                            </div>
                            <span class="font-bold text-teal-800 text-sm"><?php echo esc_html($testi['name']); ?></span>
                        </div>
                    </div>
                    <?php endforeach; else: ?>
                        <p class="text-center text-slate-500 col-span-2">Belum ada testimoni.</p>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const items = document.querySelectorAll('.package-item');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => {
                b.classList.remove('active', 'bg-teal-600', 'text-white', 'shadow-md');
                b.classList.add('bg-white', 'text-slate-600', 'border-slate-200');
            });
            btn.classList.add('active', 'bg-teal-600', 'text-white', 'shadow-md');
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

    window.switchTab = function(tabName) {
        document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('text-teal-600', 'border-teal-600', 'font-bold');
            btn.classList.add('text-slate-500', 'border-transparent', 'font-medium');
        });
        document.getElementById('content-' + tabName).classList.remove('hidden');
        const activeBtn = document.getElementById('tab-' + tabName);
        activeBtn.classList.add('text-teal-600', 'border-teal-600', 'font-bold');
        activeBtn.classList.remove('text-slate-500', 'border-transparent', 'font-medium');
    };
    
    // Auto switch tab saat klik menu testimoni
    const hash = window.location.hash;
    if(hash === '#testimoni') switchTab('testi');
    if(hash === '#tentang') switchTab('about');
});
</script>

<?php get_footer(); ?>