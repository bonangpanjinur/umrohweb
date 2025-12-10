<?php
/**
 * Template Name: Halaman Arsip Travel
 */
get_header(); ?>

<div class="bg-slate-50 min-h-screen py-20">
    <div class="container mx-auto px-6">
        
        <!-- Header Arsip -->
        <div class="text-center max-w-3xl mx-auto mb-16 fade-in-element">
            <h1 class="text-3xl md:text-5xl font-extrabold text-slate-800 mb-4">Direktori Travel Umroh Terpercaya</h1>
            <p class="text-lg text-slate-600">Pilih mitra perjalanan ibadah Anda dari daftar travel resmi yang telah terverifikasi.</p>
        </div>

        <!-- Grid Travel -->
        <?php if ( have_posts() ) : ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php while ( have_posts() ) : the_post(); 
                    $travel_id = get_the_ID();
                    $logo = get_post_meta($travel_id, '_travel_logo', true);
                    $thumb = has_post_thumbnail() ? get_the_post_thumbnail_url($travel_id, 'large') : 'https://placehold.co/600x400/e2e8f0/64748b?text=Travel';
                    $address = get_post_meta($travel_id, '_travel_address', true);
                ?>
                
                <!-- Card Travel Item -->
                <a href="<?php the_permalink(); ?>" class="group bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-slate-100 flex flex-col h-full fade-in-element">
                    <!-- Banner -->
                    <div class="h-48 bg-slate-200 relative overflow-hidden">
                        <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title(); ?>" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition"></div>
                        
                        <!-- Logo Overlay -->
                        <?php if($logo): ?>
                        <div class="absolute -bottom-10 left-6 bg-white p-3 rounded-xl shadow-lg border border-slate-100 w-20 h-20 flex items-center justify-center z-10">
                            <img src="<?php echo esc_url($logo); ?>" alt="Logo" class="w-full h-full object-contain">
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Content -->
                    <div class="pt-12 pb-6 px-6 flex-grow flex flex-col">
                        <h2 class="text-xl font-bold text-slate-800 mb-2 group-hover:text-teal-600 transition"><?php the_title(); ?></h2>
                        
                        <?php if($address): ?>
                        <p class="text-sm text-slate-500 mb-4 line-clamp-2">
                            <svg class="w-4 h-4 inline mr-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <?php echo esc_html(substr($address, 0, 80)) . '...'; ?>
                        </p>
                        <?php endif; ?>
                        
                        <div class="mt-auto pt-4 border-t border-slate-100 flex justify-between items-center">
                            <span class="text-xs font-semibold text-teal-600 bg-teal-50 px-3 py-1 rounded-full">Resmi Terdaftar</span>
                            <span class="text-sm font-bold text-slate-400 group-hover:text-teal-600 transition">Lihat Profil →</span>
                        </div>
                    </div>
                </a>
                <?php endwhile; ?>
            </div>

            <!-- Pagination -->
            <div class="mt-12 text-center">
                <?php
                the_posts_pagination( array(
                    'mid_size'  => 2,
                    'prev_text' => __( 'Sebelumnya', 'textdomain' ),
                    'next_text' => __( 'Selanjutnya', 'textdomain' ),
                    'class'     => 'inline-flex gap-2'
                ) );
                ?>
            </div>

        <?php else : ?>
            <div class="text-center py-20 bg-white rounded-3xl border border-dashed border-slate-300">
                <svg class="w-16 h-16 mx-auto text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m8-2a2 2 0 01-2-2h-4a2 2 0 01-2 2v-4a2 2 0 012-2h4a2 2 0 012 2v4zm5-12v2m-2-2v2m2-2h2m-2 2h2m-2 2v2m2-2v2"></path></svg>
                <h3 class="text-xl font-bold text-slate-600">Belum Ada Travel</h3>
                <p class="text-slate-400">Saat ini belum ada data travel yang dimasukkan.</p>
            </div>
        <?php endif; ?>

    </div>
</div>

<!-- Animasi Fade In Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = 1;
                entry.target.style.transform = 'translateY(0)';
            }
        });
    });
    
    document.querySelectorAll('.fade-in-element').forEach((el) => {
        el.style.opacity = 0;
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'all 0.6s ease-out';
        observer.observe(el);
    });
});
</script>

<?php get_footer(); ?>