# Etapa 5 — Responsividade (Mobile-First)

## Objetivo

Garantir que a landing page seja totalmente responsiva, com abordagem mobile-first, renderizando corretamente em todos os tamanhos de tela.

---

## Pré-requisitos

- Etapa 3 concluída (template da landing implementado)
- `npm run watch` rodando
- DevTools do navegador disponível para teste

---

## Breakpoints (Tailwind padrão)

| Prefixo | Min-width | Dispositivos |
|---------|-----------|--------------|
| (nenhum) | 0px | Mobile (default) |
| `sm:` | 640px | Mobile landscape |
| `md:` | 768px | Tablet |
| `lg:` | 1024px | Desktop pequeno |
| `xl:` | 1280px | Desktop |
| `2xl:` | 1536px | Desktop grande |

**Abordagem:** Escrever estilos para mobile primeiro, depois adicionar prefixos para telas maiores.

---

## Ajustes por Seção

### 1. Hero

**Mobile (< 768px):**
- Layout: stack vertical (1 coluna)
- Imagem do profissional: aparece primeiro (topo), largura 100%
- Headline: `text-2xl`, alinhado à esquerda
- Formulário: largura 100%
- Badges: wrap em múltiplas linhas

**Desktop (≥ 1024px):**
- Layout: 2 colunas (`grid-cols-2`)
- Imagem à direita, conteúdo à esquerda
- Headline: `text-4xl`
- Formulário: `max-w-md`

**Classes Tailwind:**
```html
<!-- Container do grid -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">

<!-- Headline -->
<h1 class="text-2xl md:text-3xl lg:text-4xl font-bold leading-tight">

<!-- Reordenamento (imagem primeiro no mobile) -->
<div class="order-2 lg:order-1"> <!-- conteúdo -->
<div class="order-1 lg:order-2"> <!-- imagem -->
```

### 2. Para quem é? (2 cards)

**Mobile:** 1 coluna, cards empilhados
**Tablet+:** 2 colunas lado a lado

```html
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
```

### 3. CTA

**Mobile:** Botão com `w-full` ou `w-auto` centralizado
**Desktop:** Botão centralizado, tamanho auto

```html
<div class="text-center px-4">
    <a href="#como-participar" class="btn-cta w-full sm:w-auto">
```

### 4-5. Cronograma (3 cards por módulo)

**Mobile:** 1 coluna
**Tablet:** 2 colunas (com último card centralizado, ou `md:grid-cols-2 lg:grid-cols-3`)
**Desktop:** 3 colunas

```html
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
```

### 6. Você também (3 cards)

Mesmo padrão do cronograma:

```html
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
```

### 7. Bio (texto + foto)

**Mobile:** Stack vertical — foto em cima, texto abaixo
**Desktop:** 2 colunas

```html
<div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
    <div class="order-2 lg:order-1"> <!-- texto -->
    <div class="order-1 lg:order-2"> <!-- foto -->
```

### 8. Como participar? (formulário em fundo azul)

**Mobile:** Stack vertical — texto em cima, formulário abaixo (largura 100%)
**Desktop:** 2 colunas

```html
<div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
```

Formulário no mobile com `w-full`:
```html
<div class="w-full">
    <?php echo do_shortcode('...'); ?>
</div>
```

### 9. Números oficiais

**Mobile:** Badges em wrap, 1-2 por linha
**Desktop:** Múltiplos por linha, flex wrap

```html
<div class="flex flex-wrap justify-center gap-2 sm:gap-3">
```

Badges de número:
```html
<span class="text-xs sm:text-sm px-3 py-1.5 sm:px-4 sm:py-2">
```

### 10. Footer

**Mobile:** Stack vertical, centralizado
**Desktop:** Flex row, `justify-between`

```html
<div class="flex flex-col sm:flex-row justify-between items-center gap-4">
```

---

## Espaçamento responsivo

Usar padding/margin responsivo nas seções:

```html
<!-- Padrão para todas as seções -->
<section class="py-12 md:py-16 lg:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
```

| Tamanho | Padding vertical | Padding horizontal |
|---------|------------------|--------------------|
| Mobile | `py-12` (48px) | `px-4` (16px) |
| Tablet | `py-16` (64px) | `px-6` (24px) |
| Desktop | `py-24` (96px) | `px-8` (32px) |

---

## Tipografia responsiva

| Elemento | Mobile | Tablet | Desktop |
|----------|--------|--------|---------|
| H1 (Hero) | `text-2xl` | `text-3xl` | `text-4xl` |
| H2 (Seção) | `text-xl` | `text-2xl` | `text-3xl` |
| H3 (Card) | `text-base` | `text-lg` | `text-lg` |
| Parágrafo | `text-sm` | `text-sm` | `text-base` |
| Badge | `text-xs` | `text-xs` | `text-sm` |

---

## Imagens responsivas

```html
<!-- Imagem que se ajusta ao container -->
<img class="w-full h-auto max-w-sm lg:max-w-lg" ...>

<!-- Imagem com aspect ratio mantido -->
<img class="w-full h-auto object-cover" ...>
```

Para imagens de hero ou bio, definir `max-w` responsivo:
```html
<!-- Mobile: max 320px, Desktop: max 480px -->
<img class="max-w-xs sm:max-w-sm lg:max-w-md w-full h-auto" ...>
```

---

## Formulários responsivos

```css
/* Inputs já têm w-full, então se adaptam automaticamente */

/* Botão: full width no mobile, auto no desktop */
.wpcf7-submit {
    @apply w-full sm:w-auto;
}
```

Se quiser botão full width em ambos os formulários:
```css
.wpcf7-submit {
    @apply w-full;
}
```

---

## Testes recomendados

### Viewports de teste no DevTools

| Dispositivo | Largura | Tipo |
|-------------|---------|------|
| iPhone SE | 375px | Mobile |
| iPhone 14 | 390px | Mobile |
| Samsung Galaxy | 360px | Mobile |
| iPad Mini | 768px | Tablet |
| iPad Air | 820px | Tablet |
| Laptop | 1024px | Desktop pequeno |
| Desktop | 1280px | Desktop |
| Desktop grande | 1440px | Desktop |
| Ultrawide | 1920px | Desktop grande |

### Checklist por viewport

Para cada viewport testar:

- [ ] Hero: texto legível, formulário acessível, imagem proporcional
- [ ] Cards não estão cortados ou com overflow
- [ ] Formulários usáveis com teclado touch
- [ ] Botões com tamanho mínimo de 44x44px (acessibilidade touch)
- [ ] Texto não precisa de scroll horizontal
- [ ] Imagens não estouram o container
- [ ] Espaçamento vertical adequado entre seções
- [ ] Badges de números não quebram de forma estranha
- [ ] Footer alinhado corretamente

---

## Meta viewport

Confirmar que o `header.php` contém:

```html
<meta name="viewport" content="width=device-width, initial-scale=1.0">
```

---

## Commit

```powershell
cd d:\projects\alasca
git add wp-content/themes/alasca/
git add docs/05-responsividade.md
git commit -m "feat: responsividade mobile-first completa"
git push origin master
```

---

## Verificação

- [ ] Página renderiza corretamente em 375px (mobile)
- [ ] Página renderiza corretamente em 768px (tablet)
- [ ] Página renderiza corretamente em 1024px (desktop pequeno)
- [ ] Página renderiza corretamente em 1440px (desktop)
- [ ] Grids colapsam para 1 coluna no mobile
- [ ] Formulários são usáveis no mobile (campos acessíveis, botão clicável)
- [ ] Imagens redimensionam proporcionalmente
- [ ] Nenhum scroll horizontal em nenhum viewport
- [ ] Botões têm tamanho adequado para toque (min 44px)
- [ ] Texto é legível em todos os tamanhos
