/**
 * Alasca Theme - Main JavaScript
 * Máscaras de input e interações
 *
 * @package Alasca
 * @version 1.0.0
 */

document.addEventListener('DOMContentLoaded', function () {

    // ================================================
    // Máscara de telefone brasileiro: (99) 99999-9999
    // ================================================
    function applyPhoneMask(selector) {
        var elements = document.querySelectorAll(selector);
        elements.forEach(function (el) {
            if (typeof IMask !== 'undefined') {
                IMask(el, {
                    mask: '(00) 00000-0000'
                });
            }
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

        // CF7: após resposta com sucesso
        form.addEventListener('wpcf7mailsent', function () {
            submitBtn.value = originalText;
            submitBtn.classList.remove('opacity-50', 'cursor-wait');
            submitBtn.disabled = false;
        });

        // CF7: validação inválida
        form.addEventListener('wpcf7invalid', function () {
            submitBtn.value = originalText;
            submitBtn.classList.remove('opacity-50', 'cursor-wait');
            submitBtn.disabled = false;
        });

        // CF7: falha no envio
        form.addEventListener('wpcf7mailfailed', function () {
            submitBtn.value = originalText;
            submitBtn.classList.remove('opacity-50', 'cursor-wait');
            submitBtn.disabled = false;
        });
    });

    // ================================================
    // Re-aplicar máscaras após reset do formulário
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
