<?php
/**
 * Seção Como participar? — Formulário em fundo azul
 * @package Alasca
 */
?>
<section id="como-participar" class="bg-primary py-12 md:py-16 lg:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center max-w-5xl mx-auto">

            <!-- Texto -->
            <div>
                <h2 class="font-heading text-2xl md:text-3xl font-bold text-white mb-4">
                    Como participar?
                </h2>
                <p class="text-blue-100 text-sm leading-relaxed">
                    É simples. Preencha seus dados com seu nome,
                    e-mail e seu melhor número de WhatsApp,
                    porque é dessa maneira que a equipe de suporte vai se comunicar contigo.
                </p>
            </div>

            <!-- Formulário CF7 (ID será atualizado na Etapa 4) -->
            <div class="w-full">
                <?php echo do_shortcode('[contact-form-7 id="7" title="Formulário Como Participar"]'); ?>
            </div>

        </div>
    </div>
</section>
