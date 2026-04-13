# Etapa 4 — Formulários: Contact Form 7 + CFDB7

## Objetivo

Instalar e configurar os plugins Contact Form 7 e CFDB7, criar os formulários com campos tipados, máscaras de input, placeholders e tratamento completo de mensagens (sucesso, erro, loading).

---

## Pré-requisitos

- Etapa 3 concluída (template da landing page implementado)
- Docker rodando, WordPress acessível em `http://localhost:8080`
- Acesso ao WP Admin

---

## Plugins a instalar

### 1. Contact Form 7

**Instalação via WP-CLI:**
```powershell
docker exec -it alasca_wp wp plugin install contact-form-7 --activate --allow-root
```

**Instalação manual:**
1. WP Admin → Plugins → Adicionar novo
2. Buscar "Contact Form 7"
3. Instalar e Ativar

### 2. CFDB7 (Contact Form 7 Database Addon)

**Instalação via WP-CLI:**
```powershell
docker exec -it alasca_wp wp plugin install contact-form-cfdb7 --activate --allow-root
```

**Instalação manual:**
1. WP Admin → Plugins → Adicionar novo
2. Buscar "Contact Form CFDB7"
3. Instalar e Ativar

> O CFDB7 salva automaticamente todas as submissões do CF7 no banco de dados. Acessível em WP Admin → CFDB7.

---

## Formulários a criar

### Formulário 1: Hero (Inscrição principal)

**Acessar:** WP Admin → Contato → Adicionar novo

**Nome:** `Formulário Hero`

**Template do formulário CF7:**

```
<div class="space-y-3">
    [text* your-name id:hero-name class:input-field placeholder "Seu nome completo"]

    [email* your-email id:hero-email class:input-field placeholder "Seu melhor e-mail"]

    [tel* your-phone id:hero-phone class:input-field placeholder "Seu WhatsApp (com DDD)"]

    [submit class:btn-cta "QUERO REFORÇAR NESTA AULA"]
</div>
```

**Configuração do e-mail (aba "Mail"):**
- Para: `admin@seudominio.com` (ou e-mail configurado)
- De: `[your-name] <wordpress@localhost>`
- Assunto: `[Landing Page] Nova inscrição - [your-name]`
- Corpo:
  ```
  Nova inscrição recebida via Landing Page:

  Nome: [your-name]
  E-mail: [your-email]
  Telefone: [your-phone]

  ---
  Formulário: Hero (Inscrição principal)
  Data: {date}
  ```

**Mensagens customizadas (aba "Mensagens"):**
| Situação | Mensagem |
|----------|----------|
| Sucesso | ✅ Inscrição realizada com sucesso! Aguarde nosso contato. |
| Falha no envio | ❌ Ops! Houve um erro ao enviar. Tente novamente. |
| Erro de validação | ⚠️ Por favor, verifique os campos destacados. |
| Spam detectado | Sua mensagem não pôde ser enviada. |
| E-mail inválido | Por favor, insira um e-mail válido. |
| Campo obrigatório | Este campo é obrigatório. |
| Telefone inválido | Por favor, insira um número de telefone válido. |

---

### Formulário 2: Como Participar

**Nome:** `Formulário Como Participar`

**Template do formulário CF7:**

```
<div class="space-y-3">
    [text* your-name id:participar-name class:input-field-alt placeholder "Seu nome completo"]

    [email* your-email id:participar-email class:input-field-alt placeholder "Seu melhor e-mail"]

    [tel* your-phone id:participar-phone class:input-field-alt placeholder "Seu WhatsApp (com DDD)"]

    [submit class:btn-cta-alt "QUERO ADVOGAR NESTA ÁREA"]
</div>
```

> Nota: as classes `-alt` são variantes para o fundo azul desta seção.

**E-mail:** Mesmo esquema do Formulário Hero, com "Formulário: Como Participar" no corpo.

---

## Integração nos Templates

### No `template-parts/section-hero.php`:

```php
<!-- Formulário CF7 -->
<div class="max-w-md">
    <?php
    // Substituir FORM_ID pelo ID real após criar o formulário no WP Admin
    echo do_shortcode('[contact-form-7 id="FORM_ID" title="Formulário Hero"]');
    ?>
</div>
```

### No `template-parts/section-como-participar.php`:

```php
<!-- Formulário CF7 -->
<div>
    <?php
    echo do_shortcode('[contact-form-7 id="FORM_ID" title="Formulário Como Participar"]');
    ?>
</div>
```

> **Dica:** Após criar os formulários no WP Admin, copie o shortcode gerado (ex: `[contact-form-7 id="abc1234" title="Formulário Hero"]`) e substitua nos templates.

---

## Estilização dos formulários (Tailwind)

Adicionar ao `src/input.css` as seguintes regras para override do CSS padrão do CF7:

```css
@layer components {
    /* ================================================
       Input field para fundo escuro (Hero)
       ================================================ */
    .input-field {
        @apply w-full bg-neutral-800 border border-neutral-700 text-white
               rounded-md px-4 py-3 text-sm placeholder-neutral-500
               focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
               transition-all duration-200;
    }

    /* Input field para fundo azul (Como Participar) */
    .input-field-alt {
        @apply w-full bg-white/10 border border-white/20 text-white
               rounded-md px-4 py-3 text-sm placeholder-white/60
               focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-transparent
               transition-all duration-200;
    }

    /* Botão CTA no fundo azul */
    .btn-cta-alt {
        @apply inline-block bg-neutral-950 hover:bg-neutral-800 text-white font-bold
               py-3 px-8 rounded-md uppercase tracking-wider text-sm w-full text-center
               transition-all duration-300 cursor-pointer
               focus:outline-none focus:ring-2 focus:ring-white/50;
    }
}

/* ================================================
   Override global do Contact Form 7
   ================================================ */
.wpcf7 {
    @apply w-full;
}

.wpcf7-form {
    @apply w-full;
}

/* Esconder o spinner padrão do CF7 */
.wpcf7-spinner {
    display: none !important;
}

/* Mensagens de resposta do CF7 */
.wpcf7-response-output {
    @apply text-sm mt-4 p-3 rounded-md border text-center;
}

/* Sucesso */
.wpcf7-mail-sent-ok,
.wpcf7 form.sent .wpcf7-response-output {
    @apply bg-green-900/50 border-green-500 text-green-300;
}

/* Erro */
.wpcf7-validation-errors,
.wpcf7 form.invalid .wpcf7-response-output {
    @apply bg-red-900/50 border-red-500 text-red-300;
}

/* Erro de envio */
.wpcf7-mail-sent-ng,
.wpcf7 form.failed .wpcf7-response-output {
    @apply bg-red-900/50 border-red-500 text-red-300;
}

/* Campo com erro */
.wpcf7-not-valid {
    @apply border-red-500 ring-1 ring-red-500;
}

/* Mensagem de erro individual do campo */
.wpcf7-not-valid-tip {
    @apply text-red-400 text-xs mt-1;
}

/* Estado de loading/submitting */
.wpcf7 form.submitting .wpcf7-submit {
    @apply opacity-50 cursor-wait;
}
```

---

## Máscaras de Input (JavaScript)

### Instalar IMask.js

Opção 1 — CDN (mais simples, adicionar no `functions.php`):

```php
// No functions.php, dentro de alasca_enqueue_assets()
wp_enqueue_script(
    'imask',
    'https://unpkg.com/imask@7.1.3/dist/imask.min.js',
    [],
    '7.1.3',
    true
);
```

Opção 2 — Download local:

```powershell
# Baixar e salvar em assets/js/
cd d:\projects\alasca\wp-content\themes\alasca\assets\js
curl -o imask.min.js https://unpkg.com/imask@7.1.3/dist/imask.min.js
```

### Script de máscara (`assets/js/main.js`)

```javascript
/**
 * Alasca Theme - Main JavaScript
 * Máscaras de input e interações
 *
 * @package Alasca
 */

document.addEventListener('DOMContentLoaded', function () {

    // ================================================
    // Máscara de telefone brasileiro: (99) 99999-9999
    // ================================================
    function applyPhoneMask(selector) {
        const elements = document.querySelectorAll(selector);
        elements.forEach(function (el) {
            IMask(el, {
                mask: '(00) 00000-0000',
                lazy: false,
                placeholderChar: '_'
            });
        });
    }

    // Aplicar máscaras nos campos de telefone
    applyPhoneMask('#hero-phone');
    applyPhoneMask('#participar-phone');

    // ================================================
    // Loading state no botão de submit
    // ================================================
    document.querySelectorAll('.wpcf7-form').forEach(function (form) {
        var submitBtn = form.querySelector('.wpcf7-submit');
        if (!submitBtn) return;

        var originalText = submitBtn.value;

        // Ao iniciar envio
        form.addEventListener('submit', function () {
            submitBtn.value = 'Enviando...';
            submitBtn.classList.add('opacity-50', 'cursor-wait');
            submitBtn.disabled = true;
        });

        // Evento do CF7: após resposta (sucesso ou erro)
        form.addEventListener('wpcf7mailsent', function () {
            submitBtn.value = originalText;
            submitBtn.classList.remove('opacity-50', 'cursor-wait');
            submitBtn.disabled = false;
            // Limpar formulário após sucesso (CF7 faz isso por padrão)
        });

        form.addEventListener('wpcf7invalid', function () {
            submitBtn.value = originalText;
            submitBtn.classList.remove('opacity-50', 'cursor-wait');
            submitBtn.disabled = false;
        });

        form.addEventListener('wpcf7mailfailed', function () {
            submitBtn.value = originalText;
            submitBtn.classList.remove('opacity-50', 'cursor-wait');
            submitBtn.disabled = false;
        });
    });

    // ================================================
    // Re-aplicar máscaras após reset do formulário (CF7 limpa os campos)
    // ================================================
    document.addEventListener('wpcf7mailsent', function () {
        setTimeout(function () {
            applyPhoneMask('#hero-phone');
            applyPhoneMask('#participar-phone');
        }, 100);
    });

    // ================================================
    // Smooth scroll para links de âncora
    // ================================================
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            var targetId = this.getAttribute('href');
            if (targetId === '#') return;

            var target = document.querySelector(targetId);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

});
```

---

## Verificação do CFDB7

Após submeter um formulário de teste:

1. WP Admin → **CFDB7** (menu lateral)
2. Selecionar o formulário
3. Verificar se os dados aparecem:
   - Nome
   - E-mail
   - Telefone
   - Data de submissão

---

## Commit

```powershell
cd d:\projects\alasca
git add wp-content/themes/alasca/assets/js/
git add wp-content/themes/alasca/src/input.css
git add wp-content/themes/alasca/functions.php
git add wp-content/plugins/
git add docs/04-formularios-cf7.md
git commit -m "feat: formulários CF7 com validação, máscaras e CF7DB"
git push origin master
```

---

## Verificação

- [ ] Contact Form 7 instalado e ativado
- [ ] CFDB7 instalado e ativado
- [ ] Formulário Hero renderiza com 3 campos + botão
- [ ] Formulário Como Participar renderiza com 3 campos + botão
- [ ] Máscara de telefone `(99) 99999-9999` funciona
- [ ] Validação de e-mail impede envio com e-mail inválido
- [ ] Campos obrigatórios impedem envio vazio
- [ ] Mensagem de sucesso aparece com estilo verde
- [ ] Mensagem de erro aparece com estilo vermelho
- [ ] Botão mostra "Enviando..." durante submissão
- [ ] CFDB7 registra as submissões no banco
- [ ] Campos com erro exibem borda vermelha + mensagem individual
