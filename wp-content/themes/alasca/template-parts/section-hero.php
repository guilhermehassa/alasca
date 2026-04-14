<?php
/**
 * Seção Hero — Headline + Formulário + Imagem
 * @package Alasca
 */
?>
<section id="hero" class="relative bg-black overflow-hidden">
    <!-- Background com imagem de colunas do tribunal -->
    <div class="absolute inset-0">
        <img src="<?php echo ALASCA_URI; ?>/assets/images/hero_bg.png"
             alt="" class="w-full h-full object-cover object-top opacity-30 lg:opacity-40" aria-hidden="true"
             loading="eager">
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-16 lg:py-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-end">

            <!-- Coluna esquerda: conteúdo -->
            <div class="order-1 lg:order-1">
                <!-- Logo -->
                <img src="<?php echo ALASCA_URI; ?>/assets/images/logo.png"
                     alt="Advogando no Direito Imobiliário" class="h-12 lg:h-14 mb-6"
                     loading="eager" fetchpriority="high">

                <!-- Badges -->
                <div class="flex flex-wrap gap-2 mb-6">
                    <span class="badge">
                        <img src="<?php echo ALASCA_URI; ?>/assets/images/icon_calendar.svg" alt="" class="h-4 w-4" aria-hidden="true">
                        01, 02 e 03 de Setembro
                    </span>
                    <span class="badge">
                        <img src="<?php echo ALASCA_URI; ?>/assets/images/icon__clock.svg" alt="" class="h-4 w-4" aria-hidden="true">
                        Às 20h
                    </span>
                    <span class="badge hidden lg:inline-flex">
                        <img src="<?php echo ALASCA_URI; ?>/assets/images/icon_youtube.svg" alt="" class="h-4 w-4" aria-hidden="true">
                        Pelo YouTube
                    </span>
                </div>

                <!-- Headline H1 -->
                <h1 class="font-heading text-2xl md:text-3xl lg:text-[2.5rem] font-bold leading-tight mb-8">
                    Em 3 dias, você descobrirá como advogar nas demandas rentáveis
                    do Direito Imobiliário e faturar acima de
                    R$20.000,00 em honorários por contrato.
                </h1>

                <!-- Formulário CF7 -->
                <div class="max-w-[280px]">
                    <?php echo do_shortcode('[contact-form-7 id="6" title="Formulário Hero"]'); ?>
                </div>
            </div>

            <!-- Coluna direita: imagem -->
            <div class="order-2 lg:order-2 flex justify-center lg:justify-end">
                <img src="<?php echo ALASCA_URI; ?>/assets/images/hero_image.png"
                     alt="Jaylton Lopes Jr. - Especialista em Direito Imobiliário"
                     class="max-w-[280px] sm:max-w-sm lg:max-w-lg w-full h-auto"
                     loading="eager">
            </div>

        </div>
    </div>
</section>
