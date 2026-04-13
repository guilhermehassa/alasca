# Etapa 3 — Estrutura da Landing Page (Template)

## Objetivo

Implementar o template completo da landing page em `front-page.php`, componentizando cada seção em `template-parts/`, seguindo fielmente o protótipo do Figma.

---

## Pré-requisitos

- Etapa 2 concluída (tema ativado, Tailwind funcionando)
- `npm run watch` rodando para recompilar CSS automaticamente
- Assets do Figma disponíveis em `assets/images/` (ou usar placeholders temporários)

---

## Seções da Landing Page

O protótipo possui **11 seções** que serão implementadas como template parts:

| # | Seção | Template Part | Descrição |
|---|-------|--------------|-----------|
| 1 | Hero | `section-hero.php` | Headline + formulário + imagem profissional |
| 2 | Para quem é? | `section-para-quem.php` | 2 cards descritivos do público-alvo |
| 3 | CTA intermediário | `section-cta.php` | Botão "QUERO ADVOGAR NESTA ÁREA" |
| 4 | Cronograma (módulo 1) | `section-cronograma-1.php` | 3 cards de aulas com thumbnails |
| 5 | Cronograma (módulo 2) | `section-cronograma-2.php` | 3 cards de aulas com thumbnails |
| 6 | Você também | `section-voce-tambem.php` | 3 cards com ícones de benefícios |
| 7 | CTA secundário | reutiliza `section-cta.php` | Mesmo botão CTA |
| 8 | Bio | `section-bio.php` | Apresentação do Jaylton Lopes Jr. |
| 9 | Como participar? | `section-como-participar.php` | Formulário em fundo azul |
| 10 | Números oficiais | `section-numeros.php` | Telefones e WhatsApp |
| 11 | Footer | via `footer.php` | Copyright + Termos |

---

## Arquivo principal: `front-page.php`

```php
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
    // Seção 1: Hero
    get_template_part('template-parts/section', 'hero');

    // Seção 2: Para quem é?
    get_template_part('template-parts/section', 'para-quem');

    // Seção 3: CTA intermediário
    get_template_part('template-parts/section', 'cta');

    // Seção 4: Cronograma — Módulo 1
    get_template_part('template-parts/section', 'cronograma-1');

    // Seção 5: Cronograma — Módulo 2
    get_template_part('template-parts/section', 'cronograma-2');

    // Seção 6: Você também
    get_template_part('template-parts/section', 'voce-tambem');

    // Seção 7: CTA (reutiliza o mesmo)
    get_template_part('template-parts/section', 'cta');

    // Seção 8: Bio — Jaylton Lopes Jr.
    get_template_part('template-parts/section', 'bio');

    // Seção 9: Como participar?
    get_template_part('template-parts/section', 'como-participar');

    // Seção 10: Números oficiais
    get_template_part('template-parts/section', 'numeros');
    ?>

</main>

<?php
get_footer();
```

---

## Template Parts — Detalhes por Seção

### Seção 1: Hero (`template-parts/section-hero.php`)

**Layout (desktop):** 2 colunas — texto/formulário à esquerda, imagem à direita.
**Layout (mobile):** Stack vertical — imagem no topo, texto/form abaixo.

**Elementos:**
- Logo "Imersão Direito Imobiliário" (topo esquerdo)
- Badges: "01, 02 e 03 de setembro", "Ao vivo", "100% Online"
- Headline (H1): "Em 3 dias, você descobrirá como advogar nas demandas rentáveis do Direito Imobiliário e faturar acima de R$20.000,00 em honorários por contrato."
- Formulário (CF7 shortcode):
  - Input: Nome
  - Input: E-mail
  - Input: Telefone/WhatsApp
  - Botão: "QUERO REFORÇAR NESTA AULA"
- Imagem: Foto profissional do instrutor (lado direito)

**Background:** Escuro (`bg-neutral-950`) com possível overlay de imagem.

**Estrutura HTML sugerida:**
```php
<section id="hero" class="relative bg-black overflow-hidden">
    <!-- Background com imagem de colunas do tribunal -->
    <div class="absolute inset-0 opacity-10">
        <img src="<?php echo ALASCA_URI; ?>/assets/images/hero_bg.png"
             alt="" class="w-full h-full object-cover object-top" aria-hidden="true">
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">

            <!-- Coluna esquerda: conteúdo -->
            <div class="order-2 lg:order-1">
                <!-- Logo -->
                <img src="<?php echo ALASCA_URI; ?>/assets/images/logo.png"
                     alt="Advogando no Direito Imobiliário" class="h-10 mb-6">

                <!-- Badges -->
                <div class="flex flex-wrap gap-2 mb-6">
                    <span class="badge"><img src="<?php echo ALASCA_URI; ?>/assets/images/icon_calendar.svg" alt="" class="inline h-4 w-4 mr-1"> 01, 02 e 03 de setembro</span>
                    <span class="badge">🔴 Ao vivo</span>
                    <span class="badge"><img src="<?php echo ALASCA_URI; ?>/assets/images/icon_youtube.svg" alt="" class="inline h-4 w-4 mr-1"> 100% Online</span>
                </div>

                <!-- Headline H1 -->
                <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold leading-tight mb-8">
                    Em 3 dias, você descobrirá como advogar nas demandas rentáveis
                    do Direito Imobiliário e faturar acima de
                    <span class="text-primary">R$20.000,00</span>
                    em honorários por contrato.
                </h1>

                <!-- Formulário CF7 -->
                <div class="max-w-md">
                    <?php echo do_shortcode('[contact-form-7 id="FORM_ID_HERO" title="Formulário Hero"]'); ?>
                </div>
            </div>

            <!-- Coluna direita: imagem -->
            <div class="order-1 lg:order-2 flex justify-center lg:justify-end">
                <img src="<?php echo ALASCA_URI; ?>/assets/images/hero_image.png"
                     alt="Jaylton Lopes Jr. - Especialista em Direito Imobiliário"
                     class="max-w-sm lg:max-w-lg w-full h-auto"
                     loading="eager">
            </div>

        </div>
    </div>
</section>
```

---

### Seção 2: Para quem é? (`template-parts/section-para-quem.php`)

**Layout:** 2 cards lado a lado (desktop), stack no mobile.

**Elementos:**
- Título (H2): "Para quem é?"
- Card 1 (fundo escuro): Texto sobre advogados OAB que querem trabalhar com Direito Imobiliário
- Card 2 (fundo vermelho escuro `#2D1010`, borda `#E34F4F`): Texto sobre profissionais que já trabalham na área e querem se aprofundar

**Estrutura HTML sugerida:**
```php
<section id="para-quem" class="bg-neutral-950 py-16 lg:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="section-title mb-12" style="font-family: cursive;">Para quem é?</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto">
            <!-- Card 1 -->
            <div class="card min-h-[200px] flex items-end">
                <p class="text-neutral-300 text-sm">
                    Este evento é para advogados OAB exame/res,
                    que praticam ou têm familiaridade com o Direito Imobiliário.
                </p>
            </div>

            <!-- Card 2 (vermelho) -->
            <div class="bg-danger border border-danger-border rounded-lg p-6 min-h-[200px] flex items-end">
                <p class="text-neutral-300 text-sm">
                    Não se preocupe também se você é estudante ou já exerce outra atividade.
                    O conteúdo será 100% focado na prática para quem
                    quer atuar nas demandas mais recorrentes da área,
                    de fato. Consultor Imobiliário é a sua casa.
                </p>
            </div>
        </div>
    </div>
</section>
```

---

### Seção 3: CTA (`template-parts/section-cta.php`)

**Elemento:** Botão centralizado que ancora para o formulário principal.

```php
<section class="bg-neutral-950 py-8">
    <div class="text-center">
        <a href="#como-participar" class="btn-cta">
            QUERO ADVOGAR NESTA ÁREA
        </a>
    </div>
</section>
```

---

### Seção 4 e 5: Cronograma (`template-parts/section-cronograma-1.php` e `section-cronograma-2.php`)

**Layout:** Grid de 3 colunas (desktop), 1 coluna (mobile).

**Cada card contém:**
- Thumbnail (imagem da aula)
- Badge com data (ex: "Aula 01 | 04 FEV. 20h")
- Título da aula

**Dados das aulas (Módulo 1 / Módulo 2):**

| Aula | Data | Título |
|------|------|--------|
| Aula 01 | 01/09, 20h | Os Segredos da Usucapião de Sucesso |
| Aula 02 | 02/09, 20h | Ações Judiciais mais Rentáveis do Direito Imobiliário |
| Aula 03 | 03/09, 20h | O Passo a Passo da Regularização de Imóveis |

**Estrutura HTML sugerida (para cada módulo):**

```php
<section class="bg-neutral-950 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="section-title mb-12" style="font-family: cursive;">Cronograma</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto">

            <!-- Card Aula 01 -->
            <div class="text-center">
                <div class="rounded-lg overflow-hidden mb-4">
                    <img src="<?php echo ALASCA_URI; ?>/assets/images/cronograma_01_set.png"
                         alt="Aula 01 - Os Segredos da Usucapião de Sucesso"
                         class="w-full h-auto" loading="lazy">
                </div>
                <span class="inline-block bg-primary text-white text-xs font-bold px-3 py-1 rounded-full mb-2">
                    Aula 01 | 01 SET. 20h
                </span>
                <h3 class="text-white font-semibold text-sm">
                    Os Segredos da Usucapião de Sucesso
                </h3>
            </div>

            <!-- Card Aula 02 -->
            <!-- ... mesmo padrão ... -->

            <!-- Card Aula 03 -->
            <!-- ... mesmo padrão ... -->

        </div>
    </div>
</section>
```

---

### Seção 6: Você também (`template-parts/section-voce-tambem.php`)

**Layout:** Grid 3 colunas (desktop), stack no mobile.

**Cada card contém:**
- Ícone (SVG ou imagem)
- Texto do benefício

**Benefícios identificados no protótipo:**
1. IA — "Encontrará como utilizar Inteligência Artificial para entregar mais em menos tempo."
2. Sorteio — "Poderá participar de um SORTEIO de 1 Apple (sic)."
3. Certificado — "Poderá participar da emissão do CERTIFICADO com Carga de horas Jurídicas."

```php
<section class="bg-neutral-950 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="section-title mb-12" style="font-family: cursive;">Você também:</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto">

            <div class="card text-center">
                <!-- Ícone IA -->
                <img src="<?php echo ALASCA_URI; ?>/assets/images/icon_brain_circuit.svg"
                     alt="Inteligência Artificial" class="h-12 w-12 mx-auto mb-4">
                <p class="text-neutral-300 text-sm">
                    Encontrará como utilizar Inteligência Artificial
                    para entregar mais em menos tempo.
                </p>
            </div>

            <div class="card text-center">
                <!-- Ícone Sorteio -->
                <img src="<?php echo ALASCA_URI; ?>/assets/images/icon_gift.png"
                     alt="Sorteio" class="h-12 w-12 mx-auto mb-4">
                <p class="text-neutral-300 text-sm">
                    Poderá participar de um SORTEIO de 1 Apple (sic).
                </p>
            </div>

            <div class="card text-center">
                <!-- Ícone Certificado -->
                <img src="<?php echo ALASCA_URI; ?>/assets/images/icon_book.svg"
                     alt="Certificado" class="h-12 w-12 mx-auto mb-4">
                <p class="text-neutral-300 text-sm">
                    Poderá participar da emissão do CERTIFICADO
                    com Carga de horas Jurídicas.
                </p>
            </div>

        </div>
    </div>
</section>
```

---

### Seção 8: Bio (`template-parts/section-bio.php`)

**Layout (desktop):** 2 colunas — texto à esquerda, foto à direita.
**Layout (mobile):** Stack vertical — foto em cima, texto abaixo.

```php
<section id="bio" class="bg-neutral-950 py-16 lg:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center max-w-5xl mx-auto">

            <!-- Texto -->
            <div class="order-2 lg:order-1">
                <h2 class="text-2xl md:text-3xl font-bold mb-6">
                    Prazer, Jaylton Lopes Jr.
                </h2>
                <div class="space-y-4 text-neutral-300 text-sm leading-relaxed">
                    <p>Sou advogado, graduado pelo CEUB/DF, professor e autor de
                    obras/artigos publicados para a capacitação.</p>
                    <p>Minha trajetória no Direito Imobiliário é compartilhada com muitos que se
                    dedicaram ideias e trilharam seus caminhos com dedicação.</p>
                    <p>Sou um dos poucos advogados que recebe os problemas dos mais
                    renomados da CUBET, oferecendo uma visão estratégica
                    e diferenciada.</p>
                    <p>É exatamente esse tipo de conhecimento real, prático e
                    estratégico que eu quero compartilhar com você nessa aula.</p>
                    <p>O conhecimento que você vai receber 3 dias são os pontos
                    em Direito Imobiliário.</p>
                </div>
            </div>

            <!-- Foto -->
            <div class="order-1 lg:order-2 flex justify-center">
                <div class="relative">
                    <img src="<?php echo ALASCA_URI; ?>/assets/images/about_image.png"
                         alt="Jaylton Lopes Jr. - Advogado especialista em Direito Imobiliário"
                         class="rounded-lg max-w-sm w-full h-auto"
                         loading="lazy">
                    <div class="absolute bottom-4 left-4 flex items-center gap-2 text-white text-sm">
                        <span>📷</span>
                        <span>prof.jayltonlopes</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
```

---

### Seção 9: Como participar? (`template-parts/section-como-participar.php`)

**Layout:** Background azul, 2 colunas — texto + formulário.

```php
<section id="como-participar" class="bg-primary py-16 lg:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center max-w-5xl mx-auto">

            <!-- Texto -->
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-white mb-4">
                    Como participar?
                </h2>
                <p class="text-blue-100 text-sm leading-relaxed">
                    É simples. Preencha seus dados com seu nome,
                    e-mail e seu melhor número de WhatsApp,
                    porque é dessa maneira que a equipe de suporte vai se comunicar contigo.
                </p>
            </div>

            <!-- Formulário CF7 -->
            <div>
                <?php echo do_shortcode('[contact-form-7 id="FORM_ID_PARTICIPAR" title="Formulário Como Participar"]'); ?>
            </div>

        </div>
    </div>
</section>
```

---

### Seção 10: Números oficiais (`template-parts/section-numeros.php`)

**Layout:** Centralizado, com listas de telefones em badges.

```php
<section id="numeros" class="bg-neutral-950 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">

        <h2 class="section-title mb-8">Confira os meus números oficiais:</h2>

        <!-- Números principais (com ícone de telefone) -->
        <div class="flex flex-wrap justify-center gap-3 mb-8">
            <a href="tel:+5534900003863" class="inline-flex items-center gap-2 bg-neutral-900 border border-neutral-800 rounded-full px-4 py-2 text-sm text-neutral-300 hover:border-primary transition-colors">
                <img src="<?php echo ALASCA_URI; ?>/assets/images/icon_message.svg" alt="" class="h-4 w-4"> (34) 90000-3863
            </a>
            <!-- ... mais números ... -->
        </div>

        <p class="text-neutral-400 text-sm font-semibold mb-6">
            Apenas envia mensagens. Não recebe contato.
        </p>

        <!-- Números secundários (com ícone de WhatsApp) -->
        <div class="flex flex-wrap justify-center gap-3">
            <span class="inline-flex items-center gap-2 bg-neutral-900 border border-neutral-800 rounded-full px-4 py-2 text-xs text-neutral-500">
                <img src="<?php echo ALASCA_URI; ?>/assets/images/icon_whatsapp.svg" alt="" class="h-4 w-4"> (34) 98984-4774
            </span>
            <!-- ... mais números ... -->
        </div>

    </div>
</section>
```

---

### Footer (atualizar `footer.php`)

```php
<footer class="bg-neutral-950 border-t border-neutral-800 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 text-sm text-neutral-500">
            <p>&copy; 2025 Alasca | Todos os direitos reservados.</p>
            <a href="#" class="hover:text-white transition-colors">
                Termos e Condições
            </a>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
```

---

## Tipografia Especial

O protótipo usa uma **fonte cursiva/script** para alguns títulos de seção ("Para quem é?", "Cronograma", "Você também"). Identificar a fonte exata no Figma e:

1. Baixar a fonte (ou usar Google Fonts)
2. Adicionar ao `functions.php` via `wp_enqueue_style`
3. Criar classe utilitária no Tailwind para essa font-family

---

## Página estática no WordPress

Após criar o template, configurar no WP Admin:

1. **Páginas > Adicionar nova** → Título: "Home" → Publicar
2. **Configurações > Leitura** → Página inicial: "Home"

O WordPress usará automaticamente o `front-page.php` como template.

---

## Commit

```powershell
cd d:\projects\alasca
git add wp-content/themes/alasca/front-page.php
git add wp-content/themes/alasca/template-parts/
git add wp-content/themes/alasca/footer.php
git add docs/03-estrutura-pagina.md
git commit -m "feat: template da landing page com todas as seções"
git push origin master
```

---

## Verificação

- [ ] `front-page.php` carrega todas as seções sem erro PHP
- [ ] Todas as 11 seções renderizam na ordem correta
- [ ] Layout corresponde ao protótipo do Figma (desktop)
- [ ] Cada seção está em seu próprio arquivo `template-parts/section-*.php`
- [ ] Títulos H1/H2/H3 em hierarquia correta (H1 apenas no Hero)
- [ ] Formulários CF7 mostram shortcode placeholder (serão configurados na Etapa 4)
- [ ] Links de CTA apontam para `#como-participar`
