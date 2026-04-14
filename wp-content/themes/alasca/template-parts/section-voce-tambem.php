<?php
/**
 * Seção Você também — 3 cards de benefícios
 * @package Alasca
 */

$cards = [
    [
        'icon' => 'icon_brain_circuit.svg',
        'alt'  => 'Inteligência Artificial',
        'text' => 'Descobrirá como utilizar Inteligência Artificial para entregar mais em menos tempo',
    ],
    [
        'icon' => 'icon_gift.png',
        'alt'  => 'Sorteio',
        'text' => 'Poderá participar de um SORTEIO de 1 Apple Ipad',
    ],
    [
        'icon' => 'icon_book.svg',
        'alt'  => 'Certificado',
        'text' => 'Poderá participar de um segundo SORTEIO de uma Coleção de Livros Jurídicos',
    ],
];
?>
<section id="voce-tambem" class="bg-black py-12 md:py-16 lg:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="section-title mb-12">Você também:</h2>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 max-w-5xl mx-auto">

            <?php foreach ( $cards as $card ) : ?>
            <div class="card flex flex-col justify-between h-[258px]">
                <img src="<?php echo ALASCA_URI; ?>/assets/images/<?php echo esc_attr( $card['icon'] ); ?>"
                     alt="<?php echo esc_attr( $card['alt'] ); ?>" class="h-6 w-6" loading="lazy">
                <p class="text-neutral-300 text-sm leading-relaxed">
                    <?php echo esc_html( $card['text'] ); ?>
                </p>
            </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>
