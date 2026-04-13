<?php
/**
 * Seção Hero — Headline + Formulário + Imagem
 * @package Alasca
 */
?>
<section id="hero" class="relative bg-black overflow-hidden">
    <!-- Background com imagem de colunas do tribunal -->
    <div class="absolute inset-0 opacity-10">
        <img src="<?php echo ALASCA_URI; ?>/assets/images/hero_bg.png"
             alt="" class="w-full h-full object-cover object-top" aria-hidden="true"
             loading="lazy">
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16 lg:py-24">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">

            <!-- Coluna esquerda: conteúdo -->
            <div class="order-2 lg:order-1">
                <!-- Logo -->
                <img src="<?php echo ALASCA_URI; ?>/assets/images/logo.png"
                     alt="Advogando no Direito Imobiliário" class="h-10 mb-6"
                     loading="lazy">

                <!-- Badges -->
                <div class="flex flex-wrap gap-2 mb-6">
                    <span class="badge">
                        <img src="<?php echo ALASCA_URI; ?>/assets/images/icon_calendar.svg" alt="" class="h-4 w-4" aria-hidden="true" loading="lazy">
                        01, 02 e 03 de setembro
                    </span>
                    <span class="badge">
                        <span class="inline-block h-2 w-2 bg-red-500 rounded-full" aria-hidden="true"></span>
                        Ao vivo
                    </span>
                    <span class="badge">
                        <img src="<?php echo ALASCA_URI; ?>/assets/images/icon_youtube.svg" alt="" class="h-4 w-4" aria-hidden="true" loading="lazy">
                        100% Online
                    </span>
                </div>

                <!-- Headline H1 -->
                <h1 class="font-heading text-2xl md:text-3xl lg:text-4xl font-bold leading-tight mb-8">
                    Em 3 dias, você descobrirá como advogar nas demandas rentáveis
                    do Direito Imobiliário e faturar acima de
                    <span class="text-primary">R$20.000,00</span>
                    em honorários por contrato.
                </h1>

                <!-- Formulário CF7 (ID será atualizado na Etapa 4) -->
                <div class="max-w-md">
                    <?php echo do_shortcode('[contact-form-7 id="6" title="Formulário Hero"]'); ?>
                </div>
            </div>

            <!-- Coluna direita: imagem -->
            <div class="order-1 lg:order-2 flex justify-center lg:justify-end">
                <img src="<?php echo ALASCA_URI; ?>/assets/images/hero_image.png"
                     alt="Jaylton Lopes Jr. - Especialista em Direito Imobiliário"
                     class="max-w-xs sm:max-w-sm lg:max-w-lg w-full h-auto"
                     loading="eager"
                     fetchpriority="high">
            </div>

        </div>
    </div>
</section>
