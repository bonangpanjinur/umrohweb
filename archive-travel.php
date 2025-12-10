<?php
/**
 * Template Name: Halaman Arsip Travel (Direktori)
 */
get_header(); ?>

<!-- HEADER ARSIP -->
<div class="bg-slate-900 text-white py-20 md:py-28 relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    
    <div class="container mx-auto px-6 text-center relative z-10">
        <h1 class="text-3xl md:text-5xl font-extrabold mb-4 tracking-tight">Direktori Travel Umroh Terpercaya</h1>
        <p class="text-slate-300 text-lg max-w-2xl mx-auto">Temukan mitra perjalanan ibadah terbaik yang amanah dan profesional untuk kenyamanan ibadah Anda.</p>
    </div>
</div>

<!-- LIST TRAVEL GRID -->
<div class="bg-slate-50 min-h-screen py-16">
    <div class="container mx-auto px-6">
        
        <?php if ( have_posts() ) : ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php while ( have_posts() ) : the_post(); 
                    $travel_id = get_the_ID();
                    // Ambil Logo & Thumbnail
                    $logo = get_post_meta($travel_id, '_travel_logo', true);
                    $thumb = has_post_thumbnail() ? get_the_post_thumbnail_url($travel_id, 'large') : 'https://placehold.co/600x400/e2e8f0/64748b?text=Travel';
                    $address = get_post_meta($travel_id, '_travel_address', true);
                ?>
                
                <!-- CARD ITEM -->
                <a href="<?php the_permalink(); ?>" class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-200 overflow-hidden flex flex-col h-full transform hover:-translate-y-1">
                    
                    <!-- Banner Image -->
                    <div class="h-48 bg-slate-200 relative overflow-hidden">
                        <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title(); ?>" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition"></div>
                        
                        <!-- Logo Overlay (Floating) -->
                        <?php if($logo): ?>
                        <div class="absolute -bottom-8 left-6 bg-white p-2 rounded-xl shadow-md border border-slate-100 w-16 h-16 flex items-center justify-center z-10">
                            <img src="<?php echo esc_url($logo); ?>" alt="Logo" class="w-full h-full object-contain">
                        </div>
                        <?php else: ?>
                        <div class="absolute -bottom-8 left-6 bg-teal-500 text-white p-2 rounded-xl shadow-md border border-white w-16 h-16 flex items-center justify-center z-10 font-bold text-2xl">
                            <?php echo substr(get_the_title(), 0, 1); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Content -->
                    <div class="pt-12 pb-6 px-6 flex-grow flex flex-col">
                        <h2 class="text-xl font-bold text-slate-800 mb-2 group-hover:text-teal-600 transition line-clamp-1"><?php the_title(); ?></h2>
                        
                        <!-- Alamat Singkat -->
                        <?php if($address): ?>
                        <div class="flex items-start gap-2 mb-4 text-sm text-slate-500">
                            <svg class="w-4 h-4 mt-0.5 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <p class="line-clamp-2"><?php echo esc_html($address); ?></p>
                        </div>
                        <?php endif; ?>
                        
                        <div class="mt-auto pt-4 border-t border-slate-100 flex justify-between items-center">
                            <span class="inline-flex items-center gap-1 text-xs font-semibold text-green-600 bg-green-50 px-2 py-1 rounded-md">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                Terverifikasi
                            </span>
                            <span class="text-sm font-bold text-teal-600 group-hover:underline">Lihat Profil &rarr;</span>
                        </div>
                    </div>
                </a>
                <?php endwhile; ?>
            </div>

            <!-- Pagination -->
            <div class="mt-16 text-center">
                <?php
                the_posts_pagination( array(
                    'mid_size'  => 2,
                    'prev_text' => __( '← Sebelumnya', 'textdomain' ),
                    'next_text' => __( 'Selanjutnya →', 'textdomain' ),
                    'class'     => ''
                ) );
                ?>
            </div>

        <?php else : ?>
            <!-- Empty State -->
            <div class="text-center py-24 bg-white rounded-3xl border border-dashed border-slate-300 max-w-2xl mx-auto">
                <div class="inline-block p-4 bg-slate-50 rounded-full mb-4">
                    <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m8-2a2 2 0 01-2-2h-4a2 2 0 01-2 2v-4a2 2 0 012-2h4a2 2 0 012 2v4zm5-12v2m-2-2v2m2-2h2m-2 2h2m-2 2v2m2-2v2"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-600 mb-2">Belum Ada Travel</h3>
                <p class="text-slate-400">Database travel masih kosong. Silakan tambahkan data travel baru.</p>
            </div>
        <?php endif; ?>

    </div>
</div>

<!-- Styling Pagination Khusus -->
<style>
    .pagination .page-numbers {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        margin: 0 4px;
        border-radius: 8px;
        background-color: white;
        color: #475569;
        font-weight: 600;
        border: 1px solid #e2e8f0;
        transition: all 0.2s;
    }
    .pagination .page-numbers:hover {
        border-color: #0d9488;
        color: #0d9488;
    }
    .pagination .page-numbers.current {
        background-color: #0d9488;
        color: white;
        border-color: #0d9488;
    }
    .pagination .next, .pagination .prev {
        width: auto;
        padding: 0 16px;
    }
</style>

<?php get_footer(); ?>