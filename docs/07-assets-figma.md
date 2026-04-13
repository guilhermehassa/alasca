# Etapa 7 — Assets do Figma

## Objetivo

Importar, organizar e otimizar os assets visuais exportados do Figma, colocando-os no diretório correto do tema e integrando-os nos templates.

---

## Pré-requisitos

- Protótipo finalizado no Figma
- Acesso ao Figma para exportação
- Etapa 3 concluída (templates prontos com placeholders)

---

## Diretório de destino

Todos os assets devem ser colocados em:

```
d:\projects\alasca\wp-content\themes\alasca\assets\images\
```

---

## Assets necessários

### Lista completa

| # | Asset | Nome sugerido | Formato | Tamanho recomendado | Usado em |
|---|-------|---------------|---------|---------------------|----------|
| 1 | Logo "Imersão Direito Imobiliário" | `logo.svg` ou `logo.png` | SVG (preferencial) ou PNG com transparência | ~300px largura | Hero |
| 2 | Foto principal do hero (profissional de terno) | `hero-photo.webp` | WebP (ou JPG) | 800-1200px largura | Hero |
| 3 | Thumbnail Aula 01 — Usucapião | `aula-01.webp` | WebP (ou JPG) | 400px largura | Cronograma |
| 4 | Thumbnail Aula 02 — Ações Judiciais | `aula-02.webp` | WebP (ou JPG) | 400px largura | Cronograma |
| 5 | Thumbnail Aula 03 — Regularização | `aula-03.webp` | WebP (ou JPG) | 400px largura | Cronograma |
| 6 | Foto bio (Jaylton Lopes Jr.) | `bio-photo.webp` | WebP (ou JPG) | 600px largura | Bio |
| 7 | Ícone IA | `icon-ia.svg` | SVG | 48x48px | Você também |
| 8 | Ícone Sorteio/Presente | `icon-sorteio.svg` | SVG | 48x48px | Você também |
| 9 | Ícone Certificado | `icon-certificado.svg` | SVG | 48x48px | Você também |
| 10 | Ícone WhatsApp | `icon-whatsapp.svg` | SVG | 20x20px | Números |
| 11 | Ícone Telefone | `icon-phone.svg` | SVG | 20x20px | Números |
| 12 | Background do hero (se houver textura/overlay) | `hero-bg.webp` | WebP (ou JPG) | 1920px largura | Hero |
| 13 | Screenshot do tema (preview WP) | `screenshot.png` | PNG | 1200x900px | Painel WP |

---

## Como exportar do Figma

### Imagens (fotos)

1. No Figma, selecione a imagem/frame
2. No painel direito, seção **Export**
3. Configurar:
   - **Formato:** PNG (depois converter para WebP) ou exportar como JPG
   - **Escala:** 2x (para retina) ou 1x se a imagem já for grande
4. Clicar **Export**
5. Renomear conforme a tabela acima

### Ícones (SVG)

1. No Figma, selecione o ícone/componente
2. No painel direito, seção **Export**
3. Configurar:
   - **Formato:** SVG
   - **Include "id" attribute:** Desmarcar (mais limpo)
4. Clicar **Export**

### Logo

1. Selecione o logo completo (com texto)
2. Exportar como **SVG** (preferencial para qualidade)
3. Alternativa: PNG com fundo transparente, 2x

---

## Conversão para WebP (otimização)

### Opção 1: Online

Usar [squoosh.app](https://squoosh.app/) (Google):
- Arrastar a imagem
- Selecionar WebP como formato de saída
- Ajustar qualidade (~80% é bom equilíbrio)
- Baixar

### Opção 2: Via terminal (se tiver cwebp instalado)

```powershell
# Converter JPG/PNG para WebP
cwebp -q 80 input.jpg -o output.webp
```

### Opção 3: Manter JPG/PNG

Se preferir simplicidade, pode manter JPG/PNG. O impacto em performance é menor para uma landing page simples.

---

## Colocar os assets

1. Copie todos os arquivos exportados para:
   ```
   d:\projects\alasca\wp-content\themes\alasca\assets\images\
   ```

2. Verifique a estrutura:
   ```
   assets/images/
   ├── logo.svg
   ├── hero-photo.webp
   ├── hero-bg.webp (se houver)
   ├── aula-01.webp
   ├── aula-02.webp
   ├── aula-03.webp
   ├── bio-photo.webp
   ├── icon-ia.svg
   ├── icon-sorteio.svg
   ├── icon-certificado.svg
   ├── icon-whatsapp.svg
   ├── icon-phone.svg
   └── screenshot.png (copiar para raiz do tema também)
   ```

3. Copie o `screenshot.png` para a raiz do tema:
   ```powershell
   Copy-Item "d:\projects\alasca\wp-content\themes\alasca\assets\images\screenshot.png" "d:\projects\alasca\wp-content\themes\alasca\screenshot.png"
   ```

---

## Integrar nos templates

### Referência de imagem no PHP:

```php
<!-- Imagem com caminho dinâmico do tema -->
<img src="<?php echo ALASCA_URI; ?>/assets/images/hero-photo.webp"
     alt="Descrição da imagem"
     loading="lazy"
     class="w-full h-auto">
```

### SVG inline (para ícones que precisam de cor dinâmica):

Se preferir SVG inline ao invés de `<img>`, pode usar:

```php
<?php echo file_get_contents(ALASCA_DIR . '/assets/images/icon-ia.svg'); ?>
```

> ⚠️ Usar `file_get_contents` apenas com SVGs locais e confiáveis (do próprio tema).

### Checklist de integração por template:

| Template Part | Assets utilizados |
|--------------|-------------------|
| `section-hero.php` | `logo.svg`, `hero-photo.webp`, `hero-bg.webp` |
| `section-cronograma-1.php` | `aula-01.webp`, `aula-02.webp`, `aula-03.webp` |
| `section-cronograma-2.php` | `aula-01.webp`, `aula-02.webp`, `aula-03.webp` |
| `section-voce-tambem.php` | `icon-ia.svg`, `icon-sorteio.svg`, `icon-certificado.svg` |
| `section-bio.php` | `bio-photo.webp` |
| `section-numeros.php` | `icon-whatsapp.svg`, `icon-phone.svg` |

---

## Placeholder enquanto os assets não estão prontos

Enquanto o usuário exporta os assets, usar placeholders nos templates:

```php
<!-- Placeholder de imagem -->
<div class="bg-neutral-800 rounded-lg flex items-center justify-center"
     style="width: 400px; height: 300px;">
    <span class="text-neutral-600 text-sm">📷 hero-photo.webp</span>
</div>
```

Ou usar um serviço de placeholder:
```html
<img src="https://placehold.co/800x600/111111/666666?text=Hero+Photo" alt="Placeholder">
```

---

## Commit

```powershell
cd d:\projects\alasca
git add wp-content/themes/alasca/assets/images/
git add wp-content/themes/alasca/screenshot.png
git add docs/07-assets-figma.md
git commit -m "feat: assets do Figma integrados"
git push origin master
```

---

## Verificação

- [ ] Todos os 13 assets da tabela estão no diretório `assets/images/`
- [ ] `screenshot.png` copiado para a raiz do tema (aparece no painel WP)
- [ ] Imagens WebP abrem corretamente no navegador
- [ ] SVGs renderizam corretamente (sem erros de path/viewBox)
- [ ] Nenhum 404 no console do navegador para imagens
- [ ] Alt text correto em todas as `<img>` tags
- [ ] `loading="eager"` na imagem do hero, `loading="lazy"` nas demais
- [ ] Imagens não ultrapassam o container (responsivas com `w-full h-auto`)
