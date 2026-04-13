<?php
/**
 * Seção Números oficiais
 * @package Alasca
 */
?>
<section id="numeros" class="bg-black py-12 md:py-16 lg:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">

        <h2 class="section-title mb-8">Confira os meus números oficiais:</h2>

        <!-- Números principais (com ícone de mensagem) -->
        <div class="flex flex-wrap justify-center gap-2 sm:gap-3 mb-8">
            <a href="tel:+5534900003863" class="inline-flex items-center gap-2 bg-neutral-900 border border-neutral-800 rounded-full px-3 py-2.5 sm:px-4 sm:py-2 min-h-[44px] text-xs sm:text-sm text-neutral-300 hover:border-primary transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500">
                <img src="<?php echo ALASCA_URI; ?>/assets/images/icon_message.svg" alt="" class="h-4 w-4" aria-hidden="true" loading="lazy">
                (34) 90000-3863
            </a>
        </div>

        <p class="text-neutral-400 text-sm font-semibold mb-6">
            Apenas envia mensagens. Não recebe contato.
        </p>

        <!-- Números secundários (com ícone de WhatsApp) -->
        <div class="flex flex-wrap justify-center gap-2 sm:gap-3">
            <span class="inline-flex items-center gap-2 bg-neutral-900 border border-neutral-800 rounded-full px-3 py-1.5 sm:px-4 sm:py-2 text-xs text-neutral-500">
                <img src="<?php echo ALASCA_URI; ?>/assets/images/icon_whatsapp.svg" alt="" class="h-4 w-4" aria-hidden="true" loading="lazy">
                (34) 98984-4774
            </span>
        </div>

    </div>
</section>
