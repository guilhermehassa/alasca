<?php
/**
 * Alasca Theme - Functions
 *
 * @package Alasca
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

define('ALASCA_VERSION', '1.0.0');
define('ALASCA_DIR', get_template_directory());
define('ALASCA_URI', get_template_directory_uri());

function alasca_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);
    add_theme_support('custom-logo', [
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ]);
}
add_action('after_setup_theme', 'alasca_setup');

function alasca_enqueue_assets() {
    // Google Fonts: Chivo (títulos/botões) + Figtree (textos)
    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Chivo:wght@400;700;900&family=Figtree:wght@400;500;600;700&display=swap',
        [],
        null
    );

    // CSS compilado do Tailwind
    wp_enqueue_style(
        'alasca-style',
        ALASCA_URI . '/assets/css/style.css',
        ['google-fonts'],
        filemtime(ALASCA_DIR . '/assets/css/style.css')
    );

    // IMask.js para máscaras de input
    wp_enqueue_script(
        'imask',
        'https://unpkg.com/imask@7.1.3/dist/imask.min.js',
        [],
        '7.1.3',
        true
    );

    // JavaScript principal
    wp_enqueue_script(
        'alasca-main',
        ALASCA_URI . '/assets/js/main.js',
        ['imask'],
        ALASCA_VERSION,
        true
    );
}
add_action('wp_enqueue_scripts', 'alasca_enqueue_assets');

function alasca_cleanup_head() {
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
}
add_action('init', 'alasca_cleanup_head');

function alasca_disable_gutenberg($use_block_editor, $post_type) {
    if ($post_type === 'page') {
        return false;
    }
    return $use_block_editor;
}
add_filter('use_block_editor_for_post_type', 'alasca_disable_gutenberg', 10, 2);

// ================================================
// Schema Markup — Event (Imersão em Direito Imobiliário)
// ================================================
function alasca_add_schema() {
    if (is_front_page()) {
        ?>
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Event",
            "name": "Imersão em Direito Imobiliário",
            "description": "Em 3 dias, descubra como advogar nas demandas rentáveis do Direito Imobiliário e faturar acima de R$20.000,00 em honorários por contrato.",
            "startDate": "2025-09-01T20:00:00-03:00",
            "endDate": "2025-09-03T22:00:00-03:00",
            "eventAttendanceMode": "https://schema.org/OnlineEventAttendanceMode",
            "eventStatus": "https://schema.org/EventScheduled",
            "location": {
                "@type": "VirtualLocation",
                "url": "http://localhost:8080"
            },
            "organizer": {
                "@type": "Person",
                "name": "Jaylton Lopes Jr."
            },
            "offers": {
                "@type": "Offer",
                "price": "0",
                "priceCurrency": "BRL",
                "availability": "https://schema.org/InStock"
            }
        }
        </script>
        <?php
    }
}
add_action('wp_head', 'alasca_add_schema');
