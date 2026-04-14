<?php
/**
 * Seção Como participar? — Formulário em fundo azul
 * @package Alasca
 */
?>
<section id="como-participar" class="py-12" style="background-color: #fff;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-neutral-900 rounded-2xl px-6 py-10 sm:px-10 sm:py-14 lg:px-16 lg:py-16 max-w-5xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

                <!-- Texto -->
                <div>
                    <h2 class="font-heading text-2xl md:text-3xl font-bold text-white mb-4">
                        Como participar?
                    </h2>
                    <p class="text-neutral-300 text-sm leading-relaxed">
                        É simples. Não precisa pagar, nem comprovar nada.
                        Basta preencher com seu nome, número e email, e eu
                        pessoalmente vou colocar você na lista de alunos.
                    </p>
                </div>

                <!-- Formulário CF7 (ID será atualizado na Etapa 4) -->
                <div class="w-full">
                    <?php echo do_shortcode('[contact-form-7 id="6" title="Formulário Hero"]'); ?>
                </div>

            </div>
        </div>
    </div>
</section>
