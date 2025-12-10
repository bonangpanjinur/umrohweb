<?php

// ==========================================================================
// === 0. SETUP TEMA ===
// ==========================================================================
function umrohweb_theme_setup() {
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'umrohweb_theme_setup' );

// === SCRIPT UPLOAD GAMBAR (ADMIN) ===
function umrohweb_admin_scripts() {
    // Load media uploader bawaan WordPress
    if ( ! did_action( 'wp_enqueue_media' ) ) {
        wp_enqueue_media();
    }
}
add_action( 'admin_enqueue_scripts', 'umrohweb_admin_scripts' );

// Script JS untuk menangani klik tombol upload
function umrohweb_admin_footer_script() {
    ?>
    <script>
    jQuery(document).ready(function($){
        $('.upload-btn').click(function(e) {
            e.preventDefault();
            var button = $(this);
            var targetInput = button.siblings('.image-input');
            var previewImg = button.siblings('.image-preview');

            var custom_uploader = wp.media({
                title: 'Pilih Gambar',
                button: { text: 'Gunakan Gambar Ini' },
                multiple: false
            }).on('select', function() {
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                targetInput.val(attachment.url);
                previewImg.attr('src', attachment.url).show();
            }).open();
        });
    });
    </script>
    <?php
}
add_action('admin_footer', 'umrohweb_admin_footer_script');


// ==========================================================================
// === BAGIAN 1: PENGATURAN TEMA & CUSTOMIZER ===
// ==========================================================================
function umrohweb_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'general_settings', array( 'title' => __( '1. Pengaturan Umum', 'umrohweb' ), 'priority' => 10 ));
    $wp_customize->add_setting( 'brand_name', array( 'default' => 'UmrohWeb ID' ));
    $wp_customize->add_control( 'brand_name_control', array( 'label' => 'Nama Brand', 'section' => 'general_settings', 'settings' => 'brand_name' ));
    $wp_customize->add_setting( 'contact_whatsapp', array( 'default' => '6281283596622' ));
    $wp_customize->add_control( 'contact_whatsapp_control', array( 'label' => 'Nomor WhatsApp (format 62)', 'section' => 'general_settings', 'settings' => 'contact_whatsapp' ));
}
add_action( 'customize_register', 'umrohweb_customize_register' );


// ==========================================================================
// === BAGIAN 2: SISTEM DATA TRAVEL & FLAYER ===
// ==========================================================================

function create_travel_post_types() {
    // CPT TRAVEL
    register_post_type('travel',
        array(
            'labels'      => array( 'name' => 'Data Travel', 'singular_name' => 'Travel', 'add_new' => 'Tambah Travel', 'add_new_item' => 'Tambah Data Travel', 'edit_item' => 'Edit Data Travel' ),
            'public'      => true,
            'supports'    => array('title', 'editor', 'thumbnail'),
            'menu_icon'   => 'dashicons-building',
            'rewrite'     => array('slug' => 'travel'),
        )
    );

    // CPT PAKET
    register_post_type('umroh_package',
        array(
            'labels'      => array( 'name' => 'Data Paket/Flayer', 'singular_name' => 'Paket', 'add_new' => 'Tambah Paket', 'add_new_item' => 'Tambah Paket', 'edit_item' => 'Edit Paket' ),
            'public'      => true,
            'supports'    => array('title', 'thumbnail'),
            'menu_icon'   => 'dashicons-tickets-alt',
        )
    );

    // TAXONOMY
    register_taxonomy( 'package_category', 'umroh_package', array(
        'labels' => array('name' => 'Kategori Paket'),
        'rewrite' => array('slug' => 'kategori-paket'),
        'hierarchical' => true,
        'show_admin_column' => true,
    ));
}
add_action('init', 'create_travel_post_types');


// === META BOXES ===

function add_travel_meta_boxes() {
    add_meta_box('travel_details', '1. Identitas & Kontak Travel', 'render_travel_details_meta_box', 'travel', 'normal', 'high');
    add_meta_box('travel_banners', '2. Banner Carousel (Slider)', 'render_travel_banner_meta_box', 'travel', 'normal', 'high');
    add_meta_box('travel_extras', '3. FAQ & Testimoni', 'render_travel_extras_meta_box', 'travel', 'normal', 'default');

    add_meta_box('package_connect', 'A. Hubungkan ke Travel', 'render_package_connect_meta_box', 'umroh_package', 'side', 'high');
    add_meta_box('package_details', 'B. Detail Lengkap Paket', 'render_package_details_meta_box', 'umroh_package', 'normal', 'high');
}
add_action('add_meta_boxes', 'add_travel_meta_boxes');

// --- RENDER FORM TRAVEL (DENGAN TOMBOL UPLOAD) ---

function render_travel_details_meta_box($post) {
    $phone = get_post_meta($post->ID, '_travel_phone', true);
    $address = get_post_meta($post->ID, '_travel_address', true);
    $maps = get_post_meta($post->ID, '_travel_maps', true);
    $logo = get_post_meta($post->ID, '_travel_logo', true); 
    ?>
    <p>
        <label><strong>Logo Travel (Wajib):</strong></label><br>
        <div style="display:flex; gap:10px; align-items:center;">
            <input type="text" name="travel_logo" class="image-input" value="<?php echo esc_url($logo); ?>" placeholder="URL Logo..." style="flex:1;">
            <button type="button" class="button upload-btn">Upload Logo</button>
        </div>
        <img class="image-preview" src="<?php echo esc_url($logo); ?>" style="max-height:50px; margin-top:5px; display:<?php echo $logo ? 'block' : 'none'; ?>;">
    </p>
    <p><label><strong>WhatsApp:</strong></label><br><input type="text" name="travel_phone" value="<?php echo esc_attr($phone); ?>" style="width:100%;"></p>
    <p><label><strong>Alamat:</strong></label><br><textarea name="travel_address" style="width:100%;" rows="2"><?php echo esc_textarea($address); ?></textarea></p>
    <p><label><strong>Maps Embed:</strong></label><br><input type="text" name="travel_maps" value="<?php echo esc_attr($maps); ?>" style="width:100%;"></p>
    <?php
}

function render_travel_banner_meta_box($post) {
    $b1 = get_post_meta($post->ID, '_travel_banner_1', true);
    $b2 = get_post_meta($post->ID, '_travel_banner_2', true);
    $b3 = get_post_meta($post->ID, '_travel_banner_3', true);
    ?>
    <p><em>Upload gambar banner landscape (1920x800 px).</em></p>
    
    <div style="margin-bottom:15px;">
        <label>Banner 1 (Utama):</label>
        <div style="display:flex; gap:10px;">
            <input type="text" name="travel_banner_1" class="image-input" value="<?php echo esc_url($b1); ?>" style="flex:1;">
            <button type="button" class="button upload-btn">Upload</button>
        </div>
        <img class="image-preview" src="<?php echo esc_url($b1); ?>" style="max-height:100px; margin-top:5px; display:<?php echo $b1 ? 'block' : 'none'; ?>;">
    </div>

    <div style="margin-bottom:15px;">
        <label>Banner 2:</label>
        <div style="display:flex; gap:10px;">
            <input type="text" name="travel_banner_2" class="image-input" value="<?php echo esc_url($b2); ?>" style="flex:1;">
            <button type="button" class="button upload-btn">Upload</button>
        </div>
        <img class="image-preview" src="<?php echo esc_url($b2); ?>" style="max-height:100px; margin-top:5px; display:<?php echo $b2 ? 'block' : 'none'; ?>;">
    </div>

    <div style="margin-bottom:15px;">
        <label>Banner 3:</label>
        <div style="display:flex; gap:10px;">
            <input type="text" name="travel_banner_3" class="image-input" value="<?php echo esc_url($b3); ?>" style="flex:1;">
            <button type="button" class="button upload-btn">Upload</button>
        </div>
        <img class="image-preview" src="<?php echo esc_url($b3); ?>" style="max-height:100px; margin-top:5px; display:<?php echo $b3 ? 'block' : 'none'; ?>;">
    </div>
    <?php
}

function render_travel_extras_meta_box($post) {
    $faqs = get_post_meta($post->ID, '_travel_faqs', true) ?: [];
    $testis = get_post_meta($post->ID, '_travel_testis', true) ?: [];
    ?>
    <h4>FAQ</h4>
    <div id="faq-wrapper">
        <?php if(!empty($faqs)) { foreach($faqs as $faq) { ?>
            <div style="margin-bottom:10px; border-bottom:1px solid #eee; padding-bottom:10px;">
                <input type="text" name="faq_q[]" value="<?php echo esc_attr($faq['q']); ?>" placeholder="Tanya" style="width:100%; margin-bottom:5px;">
                <textarea name="faq_a[]" placeholder="Jawab" style="width:100%;"><?php echo esc_textarea($faq['a']); ?></textarea>
            </div>
        <?php }} ?>
    </div>
    <button type="button" class="button" onclick="addFaq()">+ Tambah FAQ</button>

    <hr><h4>Testimoni</h4>
    <div id="testi-wrapper">
        <?php if(!empty($testis)) { foreach($testis as $i => $testi) { 
             $img = isset($testi['img']) ? $testi['img'] : '';
             $video = isset($testi['video']) ? $testi['video'] : '';
        ?>
            <div style="margin-bottom:15px; border:1px solid #eee; padding:10px; background:#f9f9f9;">
                <input type="text" name="testi_name[]" value="<?php echo esc_attr($testi['name']); ?>" placeholder="Nama" style="width:100%; margin-bottom:5px;">
                <textarea name="testi_text[]" placeholder="Isi Testimoni" style="width:100%; height:50px; margin-bottom:5px;"><?php echo esc_textarea($testi['text']); ?></textarea>
                
                <!-- Upload Foto Testimoni -->
                <div style="display:flex; gap:5px; align-items:center; margin-bottom:5px;">
                    <input type="text" name="testi_img[]" class="image-input" value="<?php echo esc_url($img); ?>" placeholder="URL Foto" style="flex:1;">
                    <button type="button" class="button upload-btn">Upload Foto</button>
                </div>
                <input type="text" name="testi_video[]" value="<?php echo esc_url($video); ?>" placeholder="URL Video (Opsional)" style="width:100%;">
            </div>
        <?php }} ?>
    </div>
    <button type="button" class="button" onclick="addTesti()">+ Tambah Testimoni</button>

    <script>
    function addFaq() { document.getElementById('faq-wrapper').insertAdjacentHTML('beforeend', '<div style="margin-bottom:10px; border-bottom:1px solid #eee; padding-bottom:10px;"><input type="text" name="faq_q[]" placeholder="Tanya" style="width:100%; margin-bottom:5px;"><textarea name="faq_a[]" placeholder="Jawab" style="width:100%;"></textarea></div>'); }
    function addTesti() { 
        var html = '<div style="margin-bottom:15px; border:1px solid #eee; padding:10px; background:#f9f9f9;">' +
                   '<input type="text" name="testi_name[]" placeholder="Nama" style="width:100%; margin-bottom:5px;">' +
                   '<textarea name="testi_text[]" placeholder="Isi Testimoni" style="width:100%; height:50px; margin-bottom:5px;"></textarea>' +
                   '<div style="display:flex; gap:5px; align-items:center; margin-bottom:5px;">' +
                   '<input type="text" name="testi_img[]" class="image-input" placeholder="URL Foto" style="flex:1;">' +
                   '<button type="button" class="button upload-btn">Upload Foto</button>' +
                   '</div>' +
                   '<input type="text" name="testi_video[]" placeholder="URL Video (Opsional)" style="width:100%;">' +
                   '</div>';
        var el = jQuery(html);
        jQuery('#testi-wrapper').append(el);
        // Re-bind click event untuk tombol upload baru
        el.find('.upload-btn').click(function(e) {
            e.preventDefault();
            var btn = jQuery(this);
            var target = btn.siblings('.image-input');
            var uploader = wp.media({ title: 'Pilih Foto', button: {text: 'Pilih'}, multiple: false })
                .on('select', function(){ target.val(uploader.state().get('selection').first().toJSON().url); })
                .open();
        });
    }
    </script>
    <?php
}

function render_package_connect_meta_box($post) {
    $selected_travel = get_post_meta($post->ID, '_related_travel_id', true);
    $travels = get_posts(array('post_type' => 'travel', 'numberposts' => -1, 'post_status' => 'publish'));
    ?>
    <select name="related_travel_id" style="width:100%;">
        <option value="">-- Pilih Travel Pemilik --</option>
        <?php foreach ($travels as $travel) : ?>
            <option value="<?php echo $travel->ID; ?>" <?php selected($selected_travel, $travel->ID); ?>><?php echo esc_html($travel->post_title); ?></option>
        <?php endforeach; ?>
    </select>
    <?php
}

function render_package_details_meta_box($post) {
    $price = get_post_meta($post->ID, '_package_price', true);
    $duration = get_post_meta($post->ID, '_package_duration', true);
    $airline = get_post_meta($post->ID, '_package_airline', true);
    $hotel_star = get_post_meta($post->ID, '_package_hotel_star', true);
    $depart_date = get_post_meta($post->ID, '_package_date', true);
    ?>
    <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 15px;">
        <p><label>Harga:</label><br><input type="text" name="package_price" value="<?php echo esc_attr($price); ?>" style="width:100%;"></p>
        <p><label>Durasi (misal: 9 Hari):</label><br><input type="text" name="package_duration" value="<?php echo esc_attr($duration); ?>" style="width:100%;"></p>
        <p><label>Maskapai:</label><br><input type="text" name="package_airline" value="<?php echo esc_attr($airline); ?>" style="width:100%;"></p>
        <p><label>Bintang Hotel:</label><br>
            <select name="package_hotel_star" style="width:100%;">
                <option value="3" <?php selected($hotel_star, '3'); ?>>Bintang 3</option>
                <option value="4" <?php selected($hotel_star, '4'); ?>>Bintang 4</option>
                <option value="5" <?php selected($hotel_star, '5'); ?>>Bintang 5</option>
            </select>
        </p>
        <p><label>Tanggal (misal: 12 Jan 2025):</label><br><input type="text" name="package_date" value="<?php echo esc_attr($depart_date); ?>" style="width:100%;"></p>
    </div>
    <?php
}

// SAVE DATA
function save_travel_custom_meta($post_id) {
    // Travel Meta
    $fields = ['_travel_phone', '_travel_address', '_travel_maps', '_travel_logo', '_travel_banner_1', '_travel_banner_2', '_travel_banner_3'];
    foreach($fields as $f) { 
        if(isset($_POST[str_replace('_','',$f)])) update_post_meta($post_id, $f, sanitize_text_field($_POST[str_replace('_','',$f)])); 
    }

    // FAQ
    if (isset($_POST['faq_q'])) {
        $faqs = []; foreach($_POST['faq_q'] as $i => $q) { if($q) $faqs[] = ['q'=>sanitize_text_field($q), 'a'=>sanitize_textarea_field($_POST['faq_a'][$i])]; }
        update_post_meta($post_id, '_travel_faqs', $faqs);
    }

    // Testimoni
    if (isset($_POST['testi_name'])) {
        $testis = []; foreach($_POST['testi_name'] as $i => $n) { if($n) $testis[] = [
            'name'=>sanitize_text_field($n), 
            'text'=>sanitize_textarea_field($_POST['testi_text'][$i]),
            'img'=>sanitize_text_field($_POST['testi_img'][$i]),
            'video'=>sanitize_text_field($_POST['testi_video'][$i])
        ]; }
        update_post_meta($post_id, '_travel_testis', $testis);
    }

    // Paket Meta
    $pkg_fields = ['related_travel_id', 'package_price', 'package_duration', 'package_airline', 'package_hotel_star', 'package_date'];
    foreach($pkg_fields as $f) { 
        if(isset($_POST[$f])) update_post_meta($post_id, '_'.$f, sanitize_text_field($_POST[$f])); 
    }
}
add_action('save_post', 'save_travel_custom_meta');
?>