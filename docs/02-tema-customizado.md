# Etapa 2 — Tema Customizado com Tailwind CSS

## Objetivo

Criar um tema WordPress limpo e customizado chamado "Alasca", utilizando Tailwind CSS como framework de estilização, com pipeline de build via Node.js.

---

## Pré-requisitos

- Etapa 1 concluída (Docker rodando, WordPress instalado)
- Node.js (v18+) instalado na máquina Windows
- npm disponível no terminal

---

## Estrutura do Tema

```
wp-content/themes/alasca/
├── style.css                  # Header obrigatório do tema WP
├── functions.php              # Configurações, enqueue de assets, suportes
├── index.php                  # Template fallback obrigatório
├── header.php                 # Cabeçalho HTML (head, nav)
├── footer.php                 # Rodapé HTML (scripts, fechamento)
├── front-page.php             # Template da landing page (home)
├── screenshot.png             # Preview do tema no painel WP (1200x900)
├── package.json               # Dependências Node.js
├── tailwind.config.js         # Configuração do Tailwind
├── postcss.config.js          # Configuração PostCSS
├── src/
│   └── input.css              # CSS fonte (imports Tailwind + custom)
├── assets/
│   ├── css/
│   │   └── style.css          # CSS compilado (output do Tailwind)
│   ├── js/
│   │   └── main.js            # Scripts customizados
│   └── images/                # Assets visuais
└── template-parts/            # Seções componentizadas da landing
```

---

## Arquivos a criar

### 1. `style.css` — Header do tema WordPress

```css
/*
Theme Name: Alasca
Theme URI: https://github.com/guilhermehassa/alasca
Author: Guilherme Hassã
Author URI: https://github.com/guilhermehassa
Description: Tema customizado para landing page de captura — Imersão em Direito Imobiliário
Version: 1.0.0
Requires at least: 6.0
Tested up to: 6.7
Requires PHP: 8.0
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: alasca
*/

/* Os estilos reais estão em assets/css/style.css (compilado pelo Tailwind) */
```

> ⚠️ Este arquivo é **obrigatório** para o WordPress reconhecer o tema. Os estilos de verdade ficam no CSS compilado do Tailwind.

### 2. `functions.php`

```php
<?php
/**
 * Alasca Theme - Functions
 *
 * @package Alasca
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

// ================================================
// Constantes do tema
// ================================================
define('ALASCA_VERSION', '1.0.0');
define('ALASCA_DIR', get_template_directory());
define('ALASCA_URI', get_template_directory_uri());

// ================================================
// Setup do tema
// ================================================
function alasca_setup() {
    // Suporte ao título gerenciado pelo WP/Yoast
    add_theme_support('title-tag');

    // Suporte a thumbnails
    add_theme_support('post-thumbnails');

    // Suporte ao HTML5
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);

    // Suporte ao logo customizado
    add_theme_support('custom-logo', [
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ]);
}
add_action('after_setup_theme', 'alasca_setup');

// ================================================
// Enqueue de estilos e scripts
// ================================================
function alasca_enqueue_assets() {
    // CSS compilado do Tailwind
    wp_enqueue_style(
        'alasca-style',
        ALASCA_URI . '/assets/css/style.css',
        [],
        ALASCA_VERSION
    );

    // JavaScript principal
    wp_enqueue_script(
        'alasca-main',
        ALASCA_URI . '/assets/js/main.js',
        [],
        ALASCA_VERSION,
        true // Carregar no footer
    );
}
add_action('wp_enqueue_scripts', 'alasca_enqueue_assets');

// ================================================
// Remover itens desnecessários do <head>
// ================================================
function alasca_cleanup_head() {
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
}
add_action('init', 'alasca_cleanup_head');

// ================================================
// Desabilitar Gutenberg para páginas
// (usamos template PHP direto)
// ================================================
function alasca_disable_gutenberg($use_block_editor, $post_type) {
    if ($post_type === 'page') {
        return false;
    }
    return $use_block_editor;
}
add_filter('use_block_editor_for_post_type', 'alasca_disable_gutenberg', 10, 2);
```

### 3. `index.php` — Template fallback

```php
<?php
/**
 * Template fallback principal
 *
 * @package Alasca
 */

get_header();
?>

<main class="min-h-screen bg-neutral-950 text-white flex items-center justify-center">
    <div class="text-center">
        <h1 class="text-3xl font-bold">Alasca Theme</h1>
        <p class="mt-2 text-neutral-400">Tema ativo. Configure a página inicial estática.</p>
    </div>
</main>

<?php
get_footer();
```

### 4. `header.php`

```php
<?php
/**
 * Header do tema
 *
 * @package Alasca
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php wp_head(); ?>
</head>
<body <?php body_class('bg-neutral-950 text-white antialiased'); ?>>
<?php wp_body_open(); ?>
```

### 5. `footer.php`

```php
<?php
/**
 * Footer do tema
 *
 * @package Alasca
 */
?>

<?php wp_footer(); ?>
</body>
</html>
```

### 6. `front-page.php` — Template placeholder da landing

```php
<?php
/**
 * Template da página inicial (Landing Page)
 *
 * @package Alasca
 */

get_header();
?>

<main id="main-content" role="main">
    <!-- Seções serão implementadas na Etapa 3 -->
    <section class="min-h-screen flex items-center justify-center">
        <h1 class="text-4xl font-bold text-white">Landing Page — Em desenvolvimento</h1>
    </section>
</main>

<?php
get_footer();
```

### 7. `src/input.css` — Fonte do Tailwind

```css
/* Tailwind base layers */
@tailwind base;
@tailwind components;
@tailwind utilities;

/* ================================================
   Custom base styles
   ================================================ */
@layer base {
    body {
        @apply font-sans;
    }

    /* Reset de links */
    a {
        @apply transition-colors duration-200;
    }
}

/* ================================================
   Custom component classes
   ================================================ */
@layer components {
    /* Botão CTA primário */
    .btn-cta {
        @apply inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold
               py-3 px-8 rounded-md uppercase tracking-wider text-sm
               transition-all duration-300 cursor-pointer
               focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2
               focus:ring-offset-neutral-950;
    }

    /* Input estilizado */
    .input-field {
        @apply w-full bg-neutral-800 border border-neutral-700 text-white
               rounded-md px-4 py-3 text-sm placeholder-neutral-500
               focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
               transition-all duration-200;
    }

    /* Card genérico */
    .card {
        @apply bg-neutral-900 border border-neutral-800 rounded-lg p-6;
    }

    /* Título de seção */
    .section-title {
        @apply text-2xl md:text-3xl font-bold text-center text-white;
    }
}

/* ================================================
   Override do Contact Form 7 (será refinado na Etapa 4)
   ================================================ */
@layer utilities {
    /* Spinner de loading no submit */
    .wpcf7-spinner {
        @apply hidden;
    }
}
```

### 8. `assets/js/main.js` — Script placeholder

```javascript
/**
 * Alasca Theme - Main JavaScript
 *
 * @package Alasca
 * @version 1.0.0
 */

document.addEventListener('DOMContentLoaded', function () {
    console.log('Alasca theme loaded');
});
```

---

## Setup do Tailwind CSS

### 1. Criar `package.json`

```powershell
cd d:\projects\alasca\wp-content\themes\alasca
npm init -y
```

Depois editar o `package.json` para incluir os scripts:

```json
{
  "name": "alasca-theme",
  "version": "1.0.0",
  "description": "Tema WordPress customizado - Imersão em Direito Imobiliário",
  "scripts": {
    "build": "npx tailwindcss -i ./src/input.css -o ./assets/css/style.css --minify",
    "watch": "npx tailwindcss -i ./src/input.css -o ./assets/css/style.css --watch",
    "dev": "npx tailwindcss -i ./src/input.css -o ./assets/css/style.css --watch"
  },
  "devDependencies": {
    "tailwindcss": "^3.4",
    "postcss": "^8.4",
    "autoprefixer": "^10.4"
  }
}
```

### 2. Instalar dependências

```powershell
cd d:\projects\alasca\wp-content\themes\alasca
npm install
```

### 3. Criar `tailwind.config.js`

```javascript
/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './**/*.php',
    './src/**/*.css',
    './assets/js/**/*.js',
  ],
  theme: {
    extend: {
      colors: {
        // Cores do protótipo
        primary: {
          DEFAULT: '#2563eb',
          hover: '#1d4ed8',
          light: '#3b82f6',
        },
        dark: {
          DEFAULT: '#0a0a0a',
          card: '#111111',
          border: '#1f1f1f',
          lighter: '#171717',
        }
      },
      fontFamily: {
        sans: ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
        heading: ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
      },
    },
  },
  plugins: [],
};
```

### 4. Criar `postcss.config.js`

```javascript
module.exports = {
  plugins: {
    tailwindcss: {},
    autoprefixer: {},
  },
};
```

### 5. Gerar o CSS inicial

```powershell
cd d:\projects\alasca\wp-content\themes\alasca
npm run build
```

---

## Ativar o tema no WordPress

1. Acesse `http://localhost:8080/wp-admin`
2. Vá em **Aparência > Temas**
3. O tema "Alasca" deve aparecer na lista
4. Clique em **Ativar**
5. Acesse `http://localhost:8080` — deve exibir o template placeholder

---

## Fluxo de desenvolvimento

Durante o desenvolvimento, mantenha o watcher do Tailwind rodando:

```powershell
cd d:\projects\alasca\wp-content\themes\alasca
npm run watch
```

Isso recompila o CSS automaticamente a cada alteração nos arquivos `.php`, `.js` ou `.css`.

---

## Paleta de cores (extraída do protótipo)

| Uso                  | Cor         | Classe Tailwind         |
|----------------------|-------------|------------------------|
| Background principal | `#0a0a0a`   | `bg-dark` / `bg-neutral-950` |
| Background cards     | `#111111`   | `bg-dark-card` / `bg-neutral-900` |
| Bordas/divisores     | `#1f1f1f`   | `border-dark-border` / `border-neutral-800` |
| Azul CTA (botões)    | `#2563eb`   | `bg-primary` / `bg-blue-600` |
| Azul hover           | `#1d4ed8`   | `hover:bg-primary-hover` |
| Texto principal      | `#ffffff`   | `text-white`           |
| Texto secundário     | `#a3a3a3`   | `text-neutral-400`     |

---

## Commit

```powershell
cd d:\projects\alasca
git add wp-content/themes/alasca/ docs/02-tema-customizado.md
git commit -m "feat: tema customizado alasca com Tailwind CSS"
git push origin master
```

---

## Verificação

- [ ] `npm install` completa sem erros
- [ ] `npm run build` gera `assets/css/style.css`
- [ ] Tema "Alasca" aparece no painel WP (Aparência > Temas)
- [ ] Tema pode ser ativado sem erros
- [ ] Página inicial exibe o template placeholder
- [ ] `npm run watch` recompila CSS automaticamente ao salvar `.php`
- [ ] Fonte Inter carrega corretamente (adicionar via Google Fonts no header se necessário)
