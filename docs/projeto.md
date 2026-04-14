# Documentação do Projeto — Alasca

## Sobre o Projeto

Este projeto é um **teste técnico para a empresa Alasca**. O objetivo foi construir uma landing page de captura para a "Imersão em Direito Imobiliário" a partir de protótipos Figma (desktop e mobile), utilizando WordPress com tema customizado.

O resultado é uma landing page totalmente funcional, responsiva, com formulários de captura integrados e otimização para SEO.

---

## Decisões Técnicas

### Por que WordPress com tema customizado?

O tema `alasca` foi desenvolvido do zero (sem page builders como Elementor ou Divi) para demonstrar domínio sobre:

- Estrutura de templates PHP do WordPress (`front-page.php`, `header.php`, `footer.php`, `template-parts/`)
- Enqueue correto de assets (CSS, JS, fonts)
- Componentização via `get_template_part()`
- Integração com plugins (CF7, Yoast)
- HTML semântico e acessibilidade

### Tailwind CSS

O Tailwind foi escolhido por permitir estilização rápida diretamente no markup, sem manter CSS separado manualmente. A compilação gera um único arquivo CSS otimizado.

### Docker

O ambiente Docker garante que o projeto rode em qualquer máquina sem dependências locais de servidor web ou banco de dados. Basta ter Docker Desktop instalado.

---

## Funcionalidades Implementadas

### Landing Page

- **8 seções componentizadas** em `template-parts/`, incluindo Hero, cards de público-alvo, cronograma, biografia, call-to-action e formulários
- **Responsividade completa** (mobile-first) com breakpoints Tailwind
- **Fontes customizadas** via Google Fonts (Chivo + Figtree)
- **Imagens otimizadas** em formato WebP

### Formulários de Captura

- **2 formulários** via Contact Form 7 (Hero e seção "Como Participar")
- **Campos:** Nome, E-mail, Telefone (com máscara via IMask.js)
- **Armazenamento:** Todos os envios são salvos no banco de dados via CFDB7
- **Validação:** Campos obrigatórios com mensagens de erro customizadas

### SEO

- **Yoast SEO** configurado com título e meta description otimizados
- **HTML semântico:** tags `<header>`, `<main>`, `<section>`, `<footer>`
- **Heading hierarchy:** 1 H1 + H2s por seção
- **Schema Markup:** JSON-LD do tipo `Event` injetado via `functions.php`
- **Alt text** em todas as imagens
- **Lazy loading** nativo

### Performance e Segurança

- Limpeza do `<head>` do WordPress (remoção de wp_generator, emoji scripts, etc.)
- Gutenberg desativado para páginas
- CSS minificado em produção (`npm run build`)

---

## Plugins

| Plugin | Versão | Função |
|--------|--------|--------|
| Contact Form 7 | latest | Formulários de captura |
| CFDB7 | latest | Armazenamento de envios no banco |
| Yoast SEO | latest | Meta tags, sitemap, análise de SEO |
| Akismet | latest | Anti-spam (padrão WP) |

---

## Acesso ao WordPress

| Serviço | URL | Credenciais |
|---------|-----|-------------|
| Site (Landing Page) | http://localhost:8080 | — |
| WP Admin | http://localhost:8080/wp-admin | `admin` / `Admin@123456` |
| phpMyAdmin | http://localhost:8081 | root / senha definida no `.env` |

---

## Como Executar

```bash
# 1. Clonar
git clone https://github.com/guilhermehassa/alasca.git
cd alasca

# 2. Configurar ambiente
cp .env.example .env

# 3. Subir containers
docker-compose up -d

# 4. Compilar CSS (se necessário)
cd wp-content/themes/alasca
npm install
npm run build
```

Após subir os containers, acesse http://localhost:8080 para ver a landing page ou http://localhost:8080/wp-admin para o painel administrativo.

---

## Referências Visuais

Os protótipos originais do Figma estão na pasta `referencia/`:

- `referencia/desktop.pdf` — Layout desktop
- `referencia/mobile.pdf` — Layout mobile
