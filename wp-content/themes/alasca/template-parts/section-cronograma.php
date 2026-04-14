<?php
/**
 * Seção Cronograma — Módulo 1
 * @package Alasca
 */

$cronograma_aulas = [
    [
        'numero' => '01',
        'data'   => '01/09',
        'hora'   => '20h',
        'titulo' => 'Os Segredos da Usucapião de Sucesso',
        'imagem' => 'cronograma_01_set.png',
    ],
    [
        'numero' => '02',
        'data'   => '02/09',
        'hora'   => '20h',
        'titulo' => 'Ações Judiciais mais Rentáveis do Direito Imobiliário',
        'imagem' => 'cronograma_02_set.png',
    ],
    [
        'numero' => '03',
        'data'   => '03/09',
        'hora'   => '20h',
        'titulo' => 'O Passo a Passo da Regularização de Imóveis',
        'imagem' => 'cronograma_03_set.png',
    ],
];
?>
<section id="cronograma-1" class="bg-black py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="section-title mb-12">Cronograma</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-5xl mx-auto">

            <?php foreach ( $cronograma_aulas as $aula ) : ?>
            <div class="flex flex-col items-center gap-2.5">
                <div class="bg-dark-card rounded-2xl p-2.5">
                    <img src="<?php echo ALASCA_URI; ?>/assets/images/<?php echo esc_attr( $aula['imagem'] ); ?>"
                         alt="Aula <?php echo esc_attr( $aula['numero'] ); ?> - <?php echo esc_attr( $aula['titulo'] ); ?>"
                         class="w-full h-auto rounded-xl" loading="lazy">
                </div>
                <span class="inline-flex items-center border border-primary rounded-full px-6 py-2 text-sm text-white">
                    Aula <?php echo esc_html( $aula['numero'] ); ?> (<?php echo esc_html( $aula['data'] ); ?>), <?php echo esc_html( $aula['hora'] ); ?>
                </span>
                <h3 class="text-white font-heading font-semibold text-base text-center px-3 lg:px-8">
                    <?php echo esc_html( $aula['titulo'] ); ?>
                </h3>
            </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>
