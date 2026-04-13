# Etapa 6 — SEO com Yoast

## Objetivo

Instalar o plugin Yoast SEO, configurar meta tags, garantir HTML semântico, heading hierarchy correta e boas práticas de performance para SEO.

---

## Pré-requisitos

- Etapa 3 concluída (template da landing page)
- Docker rodando, WordPress acessível
- Acesso ao WP Admin

---

## Instalar Yoast SEO

### Via WP-CLI:
```powershell
docker exec -it alasca_wp wp plugin install wordpress-seo --activate --allow-root
```

### Via painel:
1. WP Admin → Plugins → Adicionar novo
2. Buscar "Yoast SEO"
3. Instalar e Ativar
4. Seguir o assistente de configuração inicial

---

## Configuração do Yoast

### 1. Assistente de configuração (primeira vez)

Ao ativar, o Yoast exibe um assistente. Preencher:

- **Tipo de site:** Outro (Landing page / Página de captura)
- **Organização:** Jaylton Lopes Jr. / Imersão Direito Imobiliário
- **Visibilidade:** Permitir indexação (quando em produção)
- **Redes sociais:** Preencher se houver perfis (Instagram do prof.jayltonlopes)

### 2. Configurações gerais

**WP Admin → Yoast SEO → Configurações:**

- **Aparência na busca > Tipos de conteúdo:**
  - Páginas: Mostrar nos resultados
  - Posts: Ocultar (não usamos blog)

- **Aparência na busca > Taxonomias:**
  - Categorias: Ocultar
  - Tags: Ocultar

### 3. Meta tags da página inicial

**WP Admin → Páginas → "Home" → Editar → Seção Yoast SEO:**

- **Título SEO:** `Imersão em Direito Imobiliário — Advoceue nas demandas mais rentáveis`
- **Meta descrição:** `Em 3 dias, descubra como advogar nas demandas rentáveis do Direito Imobiliário e faturar acima de R$20.000,00 em honorários por contrato. Evento online e ao vivo com Jaylton Lopes Jr.`
- **Slug:** `/` (página inicial)

### 4. Open Graph (compartilhamento social)

O Yoast gera automaticamente as tags OG. Configurar:

- **Imagem OG:** Usar a imagem do hero ou uma imagem de compartilhamento dedicada (1200x630px)
- **Título OG:** Mesmo do SEO
- **Descrição OG:** Mesma do SEO

---

## HTML Semântico no Tema

### Estrutura de tags

O template já deve usar tags semânticas HTML5. Verificar:

```html
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <!-- Meta tags gerenciadas pelo Yoast via wp_head() -->
</head>
<body>
    <header>...</header>    <!-- Navegação, se houver -->

    <main id="main-content" role="main">
        <section id="hero">...</section>
        <section id="para-quem">...</section>
        <section id="cronograma-1">...</section>
        <section id="cronograma-2">...</section>
        <section id="voce-tambem">...</section>
        <section id="bio">...</section>
        <section id="como-participar">...</section>
        <section id="numeros">...</section>
    </main>

    <footer>...</footer>
</body>
</html>
```

### Heading Hierarchy

**Ordem correta (sem pular níveis):**

```
H1: "Em 3 dias, você descobrirá como advogar..." (Hero — ÚNICO na página)
  H2: "Para quem é?"
  H2: "Cronograma"
  H2: "Cronograma"
  H2: "Você também:"
  H2: "Prazer, Jaylton Lopes Jr."
  H2: "Como participar?"
  H2: "Confira os meus números oficiais:"
    H3: (subtítulos de card, se houver)
```

> ⚠️ **Regra:** Apenas 1 `<h1>` por página. Todos os títulos de seção são `<h2>`. Subtítulos dentro de cards ou seções são `<h3>`.

### Alt text em imagens

Todas as imagens devem ter `alt` descritivo:

```html
<!-- ✅ Correto -->
<img alt="Jaylton Lopes Jr. apresentando sobre Direito Imobiliário" ...>
<img alt="Thumbnail da Aula 01 - Os Segredos da Usucapião de Sucesso" ...>

<!-- ❌ Errado -->
<img alt="" ...>
<img alt="foto" ...>
<img alt="imagem1.jpg" ...>
```

---

## Lazy Loading

### Imagens acima do fold (Hero):
```html
<!-- NÃO usar lazy loading — carrega imediatamente -->
<img loading="eager" fetchpriority="high" alt="..." ...>
```

### Imagens abaixo do fold (cronograma, bio, etc.):
```html
<!-- Usar lazy loading -->
<img loading="lazy" alt="..." ...>
```

---

## Performance

### Tailwind CSS — Purge em produção

O comando `npm run build` já usa `--minify` que:
- Remove classes CSS não utilizadas
- Minifica o output

```powershell
# Build de produção (CSS minificado e purged)
npm run build
```

### Fontes

Se usar Google Fonts (Inter), adicionar `preconnect` no `header.php`:

```html
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
```

**Ou** usar `font-display: swap` para evitar FOIT:

```php
// No functions.php
function alasca_enqueue_fonts() {
    wp_enqueue_style(
        'google-fonts-inter',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap',
        [],
        null
    );
}
add_action('wp_enqueue_scripts', 'alasca_enqueue_fonts');
```

### Otimização adicional

1. **Minificação JS:** Considerar minificar `main.js` para produção
2. **Compressão de imagens:** WebP quando possível (menor tamanho)
3. **Cache do navegador:** WordPress + plugins de cache (se necessário em produção)

---

## Schema Markup (opcional mas recomendado)

O Yoast gera automaticamente schema `WebPage`. Para um evento, pode-se adicionar manualmente ou via Yoast:

```json
{
    "@context": "https://schema.org",
    "@type": "Event",
    "name": "Imersão em Direito Imobiliário",
    "description": "Em 3 dias, descubra como advogar nas demandas rentáveis do Direito Imobiliário",
    "startDate": "2025-02-04T20:00:00-03:00",
    "endDate": "2025-02-06T22:00:00-03:00",
    "eventAttendanceMode": "https://schema.org/OnlineEventAttendanceMode",
    "eventStatus": "https://schema.org/EventScheduled",
    "organizer": {
        "@type": "Person",
        "name": "Jaylton Lopes Jr."
    },
    "offers": {
        "@type": "Offer",
        "price": "0",
        "priceCurrency": "BRL",
        "availability": "https://schema.org/InStock"
    }
}
```

Adicionar no `header.php` ou via Yoast (se suportar custom schema):

```php
// No functions.php
function alasca_add_schema() {
    if (is_front_page()) {
        ?>
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Event",
            "name": "Imersão em Direito Imobiliário",
            "description": "Em 3 dias, descubra como advogar nas demandas rentáveis do Direito Imobiliário e faturar acima de R$20.000,00 em honorários por contrato.",
            "startDate": "2025-02-04T20:00:00-03:00",
            "endDate": "2025-02-06T22:00:00-03:00",
            "eventAttendanceMode": "https://schema.org/OnlineEventAttendanceMode",
            "eventStatus": "https://schema.org/EventScheduled",
            "location": {
                "@type": "VirtualLocation",
                "url": "https://seudominio.com"
            },
            "organizer": {
                "@type": "Person",
                "name": "Jaylton Lopes Jr."
            },
            "offers": {
                "@type": "Offer",
                "price": "0",
                "priceCurrency": "BRL",
                "availability": "https://schema.org/InStock"
            }
        }
        </script>
        <?php
    }
}
add_action('wp_head', 'alasca_add_schema');
```

---

## Checklist Yoast — Semáforo Verde

Para obter o semáforo verde no Yoast:

1. **Título SEO:** Contém a palavra-chave foco (60-70 caracteres)
2. **Meta descrição:** Contém a palavra-chave foco (120-160 caracteres)
3. **H1:** Contém a palavra-chave foco
4. **URL slug:** Contém a palavra-chave (é a home, então `/`)
5. **Palavra-chave no conteúdo:** Aparece no primeiro parágrafo e ao longo do texto
6. **Links internos:** Ao menos 1 (se aplicável)
7. **Links externos:** Ao menos 1 (se aplicável)
8. **Imagens:** Ao menos 1 com `alt` contendo a palavra-chave
9. **Comprimento do texto:** Acima de 300 palavras
10. **Legibilidade:** Frases curtas, parágrafos curtos, subtítulos

**Palavras-chave foco sugeridas:**
- "Direito Imobiliário"
- "Imersão Direito Imobiliário"
- "Advogar Direito Imobiliário"

---

## Commit

```powershell
cd d:\projects\alasca
git add wp-content/themes/alasca/
git add wp-content/plugins/
git add docs/06-seo-yoast.md
git commit -m "feat: SEO com Yoast + HTML semântico"
git push origin master
```

---

## Verificação

- [ ] Yoast SEO instalado e ativado
- [ ] Assistente de configuração concluído
- [ ] Página "Home" tem título SEO e meta descrição configurados
- [ ] HTML usa tags semânticas (`<header>`, `<main>`, `<section>`, `<footer>`)
- [ ] Heading hierarchy correta (H1 único, H2 por seção)
- [ ] Todas as imagens têm atributo `alt` descritivo
- [ ] `loading="lazy"` em imagens abaixo do fold
- [ ] `loading="eager"` na imagem do hero
- [ ] Google Fonts com `font-display: swap`
- [ ] CSS compilado e minificado (`npm run build`)
- [ ] Yoast mostra semáforo verde para a página "Home"
- [ ] Schema markup de Event presente no `<head>`
