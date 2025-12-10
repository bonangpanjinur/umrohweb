<?php 
get_header(); 

// 1. AMBIL DATA DARI DATABASE
$travel_id = get_the_ID();
$phone = get_post_meta($travel_id, '_travel_phone', true);
$address = get_post_meta($travel_id, '_travel_address', true);
$faqs = get_post_meta($travel_id, '_travel_faqs', true) ?: [];
$testis = get_post_meta($travel_id, '_travel_testis', true) ?: [];

// Gambar Banner (Ambil dari Featured Image Travel, kalau tidak ada pakai default)
$banner_url = has_post_thumbnail() ? get_the_post_thumbnail_url($travel_id, 'full') : 'https://placehold.co/1920x600/0d9488/ffffff?text=Travel+Umroh+Terpercaya';
?>

<!-- BANNER ATAS -->
<section class="relative h-[50vh] flex items-center justify-center text-white bg-slate-900">
    <div class="absolute inset-0 bg-cover bg-center opacity-60" style="background-image: url('<?php echo esc_url($banner_url); ?>');"></div>
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
    <div class="relative z-10 text-center px-6">
        <h1 class="text-4xl md:text-6xl font-extrabold mb-4 uppercase tracking-wider"><?php the_title(); ?></h1>
        <p class="text-lg md:text-xl text-slate-200">Mitra Resmi Perjalanan Ibadah Anda</p>
    </div>
</section>

<!-- FILTER & LIST PAKET FLAYER -->
<section class="py-16 bg-slate-50 min-h-screen">
    <div class="container mx-auto px-6">
        
        <?php
        // 2. QUERY: Cari Flayer yang miliknya Travel ini
        $args = array(
            'post_type' => 'umroh_package',
            'posts_per_page' => -1, 
            'meta_key' => '_related_travel_id',
            'meta_value' => $travel_id
        );
        $packages = new WP_Query($args);

        if ($packages->have_posts()) :
            
            // LOGIKA FILTER: Cari kategori apa saja yang ada di paket travel ini
            $used_terms = array(); 
            while ($packages->have_posts()) : $packages->the_post();
                $terms = get_the_terms(get_the_ID(), 'package_category');
                if ($terms && !is_wp_error($terms)) {
                    foreach ($terms as $term) {
                        $used_terms[$term->term_id] = $term; // Simpan ID kategori
                    }
                }
            endwhile;
            $packages->rewind_posts(); // Reset loop untuk ditampilkan di bawah
        ?>
        
            <!-- TOMBOL FILTER -->
            <div class="flex flex-wrap justify-center gap-3 mb-10 fade-in-element">
                <button class="filter-btn active bg-teal-600 text-white border-2 border-teal-600 px-5 py-2 rounded-full font-bold transition hover:bg-teal-700" data-filter="all">
                    Semua Paket
                </button>
                <?php foreach($used_terms as $term): ?>
                <button class="filter-btn bg-white text-slate-600 border-2 border-slate-300 px-5 py-2 rounded-full font-bold transition hover:border-teal-600 hover:text-teal-600" data-filter="cat-<?php echo $term->term_id; ?>">
                    <?php echo esc_html($term->name); ?>
                </button>
                <?php endforeach; ?>
            </div>

            <!-- GRID PAKET -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php while ($packages->have_posts()) : $packages->the_post(); 
                    // Ambil kategori untuk class CSS filtering
                    $post_terms = get_the_terms(get_the_ID(), 'package_category');
                    $filter_classes = '';
                    if ($post_terms) {
                        foreach ($post_terms as $t) {
                            $filter_classes .= ' cat-' . $t->term_id;
                        }
                    }
                    $price = get_post_meta(get_the_ID(), '_package_price', true);
                    $img_src = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'large') : 'https://placehold.co/600x800/e2e8f0/64748b?text=Flayer+Paket';
                ?>
                
                <!-- KARTU FLAYER -->
                <div class="package-item bg-white rounded-xl shadow-md overflow-hidden hover:shadow-2xl transition duration-300 <?php echo $filter_classes; ?> fade-in-element">
                    <div class="relative">
                        <img src="<?php echo esc_url($img_src); ?>" alt="<?php the_title(); ?>" class="w-full h-auto object-cover">
                        <?php if($price): ?>
                        <div class="absolute top-0 right-0 bg-amber-400 text-slate-900 font-bold px-4 py-2 rounded-bl-xl shadow-md">
                            <?php echo esc_html($price); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="p-5">
                        <h3 class="text-xl font-bold text-slate-800 mb-3 line-clamp-2"><?php the_title(); ?></h3>
                        
                        <!-- Badges Kategori -->
                        <div class="flex flex-wrap gap-2 mb-4">
                            <?php if($post_terms): foreach($post_terms as $pt): ?>
                                <span class="text-xs font-semibold bg-slate-100 text-slate-600 px-2 py-1 rounded border border-slate-200"><?php echo $pt->name; ?></span>
                            <?php endforeach; endif; ?>
                        </div>

                        <!-- TOMBOL WA (OTOMATIS NOMOR TRAVEL) -->
                        <a href="https://api.whatsapp.com/send?phone=<?php echo esc_attr($phone); ?>&text=Halo%20Admin%20<?php the_title_attribute(array('post'=>$travel_id)); ?>%2C%20saya%20tertarik%20dengan%20<?php the_title(); ?>" 
                           target="_blank" 
                           class="block w-full text-center bg-teal-600 text-white font-bold py-3 rounded-lg hover:bg-teal-700 transition shadow-lg hover:-translate-y-1">
                           <span class="flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.487 5.235 3.487 8.413 0 6.557-5.338 11.892-11.894 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.886-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.626.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                Pesan Sekarang
                           </span>
                        </a>
                    </div>
                </div>

                <?php endwhile; ?>
            </div>

        <?php else: ?>
            <div class="text-center py-20 bg-white rounded-xl shadow border border-slate-200">
                <p class="text-slate-500 text-lg">Belum ada paket/flayer yang diupload untuk travel ini.</p>
            </div>
        <?php endif; wp_reset_postdata(); ?>

    </div>
</section>

<!-- INFO KANTOR, TESTIMONI & FAQ -->
<section class="py-16 bg-white border-t border-slate-200">
    <div class="container mx-auto px-6 max-w-6xl">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
            
            <!-- KOLOM KIRI: TENTANG & ALAMAT -->
            <div class="fade-in-element">
                <h2 class="text-2xl font-bold text-slate-800 mb-6 flex items-center">
                    <span class="bg-teal-100 text-teal-600 p-2 rounded-lg mr-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m8-2a2 2 0 01-2-2h-4a2 2 0 01-2 2v-4a2 2 0 012-2h4a2 2 0 012 2v4zm5-12v2m-2-2v2m2-2h2m-2 2h2m-2 2v2m2-2v2"></path></svg>
                    </span>
                    Tentang Kami
                </h2>
                <div class="prose text-slate-600 mb-8 leading-relaxed">
                    <?php the_content(); ?>
                </div>

                <?php if($address): ?>
                <div class="bg-slate-50 p-6 rounded-xl border border-slate-200">
                    <h3 class="font-bold text-slate-800 mb-2">Alamat Kantor:</h3>
                    <p class="text-slate-600"><?php echo nl2br(esc_html($address)); ?></p>
                </div>
                <?php endif; ?>
            </div>

            <!-- KOLOM KANAN: FAQ & TESTIMONI -->
            <div class="space-y-8 fade-in-element">
                
                <!-- FAQ -->
                <?php if(!empty($faqs)): ?>
                <div>
                    <h2 class="text-2xl font-bold text-slate-800 mb-6">Pertanyaan Umum</h2>
                    <div class="space-y-4">
                        <?php foreach($faqs as $idx => $faq): ?>
                        <div class="bg-slate-50 rounded-lg overflow-hidden border border-slate-200">
                            <button class="w-full text-left px-6 py-4 font-bold text-slate-800 hover:bg-slate-100 flex justify-between items-center" onclick="this.nextElementSibling.classList.toggle('hidden')">
                                <?php echo esc_html($faq['q']); ?>
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div class="hidden px-6 py-4 text-slate-600 border-t border-slate-200 bg-white">
                                <?php echo nl2br(esc_html($faq['a'])); ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- TESTIMONI -->
                <?php if(!empty($testis)): ?>
                <div>
                    <h2 class="text-2xl font-bold text-slate-800 mb-6">Kata Jamaah</h2>
                    <div class="bg-teal-50 border border-teal-100 p-6 rounded-xl relative">
                        <svg class="w-10 h-10 text-teal-200 absolute top-4 left-4" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.896 14.389 16.03 15.133 15.402C15.877 14.774 16.853 14.46 18.061 14.46L18.061 21L14.017 21ZM5 21L5 18C5 16.896 5.372 16.03 6.116 15.402C6.86 14.774 7.836 14.46 9.044 14.46L9.044 21L5 21ZM16.052 13.018C15.028 13.018 14.156 12.636 13.436 11.872C12.716 11.108 12.356 10.15 12.356 8.998C12.356 7.854 12.716 6.896 13.436 6.124C14.156 5.352 15.028 4.966 16.052 4.966C17.076 4.966 17.948 5.352 18.668 6.124C19.388 6.896 19.748 7.854 19.748 8.998C19.748 10.15 19.388 11.108 18.668 11.872C17.948 12.636 17.076 13.018 16.052 13.018ZM7.035 13.018C6.011 13.018 5.139 12.636 4.419 11.872C3.699 11.108 3.339 10.15 3.339 8.998C3.339 7.854 3.699 6.896 4.419 6.124C5.139 5.352 6.011 4.966 7.035 4.966C8.059 4.966 8.931 5.352 9.651 6.124C10.371 6.896 10.731 7.854 10.731 8.998C10.731 10.15 10.371 11.108 9.651 11.872C8.931 12.636 8.059 13.018 7.035 13.018Z"/></svg>
                        
                        <!-- Slider Sederhana (Hanya tampil 1 per 1 jika ada banyak) -->
                        <?php foreach($testis as $idx => $testi): ?>
                        <div class="testi-slide <?php echo $idx > 0 ? 'hidden' : ''; ?>">
                            <p class="italic text-slate-700 relative z-10 pl-6 mb-4 text-lg">"<?php echo esc_html($testi['text']); ?>"</p>
                            <p class="font-bold text-teal-800 text-right">- <?php echo esc_html($testi['name']); ?></p>
                        </div>
                        <?php endforeach; ?>
                        
                        <?php if(count($testis) > 1): ?>
                        <div class="flex justify-end gap-2 mt-4">
                            <button onclick="changeTesti(-1)" class="w-8 h-8 rounded-full bg-teal-200 text-teal-800 hover:bg-teal-300 flex items-center justify-center">&larr;</button>
                            <button onclick="changeTesti(1)" class="w-8 h-8 rounded-full bg-teal-200 text-teal-800 hover:bg-teal-300 flex items-center justify-center">&rarr;</button>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>

<!-- JAVASCRIPT: LOGIKA FILTER & SLIDER TESTIMONI -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. FILTER PAKET
    const filterBtns = document.querySelectorAll('.filter-btn');
    const items = document.querySelectorAll('.package-item');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            // Reset style tombol
            filterBtns.forEach(b => {
                b.classList.remove('active', 'bg-teal-600', 'text-white', 'border-teal-600');
                b.classList.add('bg-white', 'text-slate-600', 'border-slate-300');
            });
            
            // Set active tombol yang diklik
            btn.classList.add('active', 'bg-teal-600', 'text-white', 'border-teal-600');
            btn.classList.remove('bg-white', 'text-slate-600', 'border-slate-300');

            const filterValue = btn.getAttribute('data-filter');

            items.forEach(item => {
                if(filterValue === 'all' || item.classList.contains(filterValue)) {
                    item.style.display = 'block';
                    // Animasi muncul
                    item.classList.remove('opacity-0', 'scale-95');
                    item.classList.add('opacity-100', 'scale-100');
                } else {
                    item.style.display = 'none';
                    item.classList.add('opacity-0', 'scale-95');
                }
            });
        });
    });
});

// 2. SLIDER TESTIMONI SEDERHANA
let currentTesti = 0;
const testiSlides = document.querySelectorAll('.testi-slide');
function changeTesti(direction) {
    if(testiSlides.length <= 1) return;
    testiSlides[currentTesti].classList.add('hidden');
    currentTesti += direction;
    if(currentTesti >= testiSlides.length) currentTesti = 0;
    if(currentTesti < 0) currentTesti = testiSlides.length - 1;
    testiSlides[currentTesti].classList.remove('hidden');
}
</script>

<?php get_footer(); ?>