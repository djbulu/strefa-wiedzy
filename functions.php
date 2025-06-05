<?php
// =============================
// MOTYW: EcoBlog Pro (SEO + AI 2025)
// =============================

// 🧱 Ustawienia motywu
function ecoblogpro_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'gallery', 'caption']);
    register_nav_menus([
        'main_menu' => __('Main Menu', 'ecoblogpro')
    ]);
}
add_action('after_setup_theme', 'ecoblogpro_setup');

// 🎨 Ładowanie stylów i skryptów
function ecoblogpro_assets() {
    wp_enqueue_style('ecoblogpro-style', get_stylesheet_uri());
    wp_enqueue_script(
        'ecoblogpro-main-js',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        null,
        true
    );
}
add_action('wp_enqueue_scripts', 'ecoblogpro_assets');

// 🧠 Shortcode: [read_time]
function ecoblogpro_read_time_shortcode() {
    $content = get_post_field('post_content', get_the_ID());
    $word_count = str_word_count(strip_tags($content));
    $minutes = ceil($word_count / 200);
    return $minutes;
}
add_shortcode('read_time', 'ecoblogpro_read_time_shortcode');

// ✂️ Wycinek: długość i „więcej”
add_filter('excerpt_length', fn() => 30);
add_filter('excerpt_more', fn() => '...');

// 🧠 JSON-LD FAQ z ACF
add_action('wp_head', 'ecoblogpro_add_faq_jsonld');
function ecoblogpro_add_faq_jsonld() {
    if (!is_single() || !function_exists('have_rows') || !have_rows('faq')) return;

    echo '<script type="application/ld+json">{
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": [';

    $faq_json = [];
    while (have_rows('faq')) {
        the_row();
        $faq_json[] = '{
          "@type": "Question",
          "name": "' . get_sub_field('pytanie') . '",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "' . get_sub_field('odpowiedz') . '"
          }
        }';
    }

    echo implode(',', $faq_json);
    echo ']}</script>';
}

// 📍 LocalBusiness JSON-LD (dodaj do stopki lub head)
add_action('wp_footer', 'ecoblogpro_add_localbusiness_jsonld');
function ecoblogpro_add_localbusiness_jsonld() {
    if (!is_front_page()) return;
    ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "Eco Ciepło Opole",
  "image": "https://ecocieplo.pl/assets/images/logo.png",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "ul. Grudzicka 104",
    "addressLocality": "Opole",
    "postalCode": "45-432",
    "addressCountry": "PL"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": "50.6751",
    "longitude": "17.9213"
  },
  "url": "<?php echo esc_url(home_url()); ?>",
  "telephone": "77 456 42 70",
  "priceRange": "$$"
}
</script>
<?php
}

add_action('wp_enqueue_scripts', function() {
  wp_localize_script('ecoblogpro-main-js', 'wp_ajax_url', admin_url('admin-ajax.php'));
});

// Ajax search
add_action('wp_ajax_live_search', 'ecoblogpro_live_search');
add_action('wp_ajax_nopriv_live_search', 'ecoblogpro_live_search');

function ecoblogpro_live_search() {
  $query = sanitize_text_field($_GET['q']);
  $args = [
    's' => $query,
    'post_type' => 'post',
    'posts_per_page' => 5,
  ];
  $search = new WP_Query($args);
  $results = [];

  if ($search->have_posts()) {
    while ($search->have_posts()) {
      $search->the_post();
      $results[] = [
        'title' => get_the_title(),
        'url' => get_permalink()
      ];
    }
    wp_reset_postdata();
  }

  wp_send_json($results);
}



// 🧭 Breadcrumbs JSON-LD
add_action('wp_head', 'ecoblogpro_breadcrumbs_jsonld');
function ecoblogpro_breadcrumbs_jsonld() {
    if (!is_single()) return;

    $position = 1;
    $breadcrumbs = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => []
    ];

    $breadcrumbs['itemListElement'][] = [
        '@type' => 'ListItem',
        'position' => $position++,
        'name' => 'Strona główna',
        'item' => home_url()
    ];

    $cat = get_the_category();
    if ($cat && !empty($cat)) {
        $breadcrumbs['itemListElement'][] = [
            '@type' => 'ListItem',
            'position' => $position++,
            'name' => $cat[0]->name,
            'item' => get_category_link($cat[0]->term_id)
        ];
    }

    $breadcrumbs['itemListElement'][] = [
        '@type' => 'ListItem',
        'position' => $position,
        'name' => get_the_title(),
        'item' => get_permalink()
    ];

    echo '<script type="application/ld+json">' . json_encode($breadcrumbs, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>';
}

// 🐌 LazyLoad + alt z tytułu posta
add_filter('post_thumbnail_html', 'ecoblogpro_lazyload_featured_image', 10, 5);
function ecoblogpro_lazyload_featured_image($html, $post_id, $post_thumbnail_id, $size, $attr) {
    $alt = esc_attr(get_the_title($post_id));
    $html = str_replace('src=', 'loading="lazy" alt="' . $alt . '" src=', $html);
    return $html;
}
?>

