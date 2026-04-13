<?php
/**
 * Template da página inicial — Landing Page
 * Imersão em Direito Imobiliário
 *
 * @package Alasca
 */

get_header();
?>

<main id="main-content" role="main">

    <?php
    get_template_part('template-parts/section', 'hero');
    get_template_part('template-parts/section', 'para-quem');
    get_template_part('template-parts/section', 'cta');
    get_template_part('template-parts/section', 'cronograma-1');
    get_template_part('template-parts/section', 'cronograma-2');
    get_template_part('template-parts/section', 'voce-tambem');
    get_template_part('template-parts/section', 'cta');
    get_template_part('template-parts/section', 'bio');
    get_template_part('template-parts/section', 'como-participar');
    get_template_part('template-parts/section', 'numeros');
    ?>

</main>

<?php
get_footer();
