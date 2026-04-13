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

Os assets já foram exportados do Figma e estão disponíveis em:

```
d:\projects\alasca\assets\
```

Durante a Etapa 7, eles devem ser copiados para o diretório do tema:

```
d:\projects\alasca\wp-content\themes\alasca\assets\images\
```

**Comando para copiar:**
```powershell
Copy-Item -Path "d:\projects\alasca\assets\*" -Destination "d:\projects\alasca\wp-content\themes\alasca\assets\images\" -Recurse
```

---

## Assets necessários

### Lista completa

| # | Asset | Arquivo fonte (`assets/`) | Formato | Usado em |
|---|-------|---------------------------|---------|----------|
| 1 | Logo "Advogando no Direito Imobiliário" | `logo.png` | PNG | Hero |
| 2 | Foto principal do hero (profissional) | `hero_image.png` | PNG | Hero |
| 3 | Background do hero (colunas tribunal) | `hero_bg.png` | PNG | Hero (overlay) |
| 4 | Thumbnail Aula 01 — Usucapião | `cronograma_01_set.png` | PNG | Cronograma |
| 5 | Thumbnail Aula 02 — Ações Judiciais | `cronograma_02_set.png` | PNG | Cronograma |
| 6 | Thumbnail Aula 03 — Regularização | `cronograma_03_set.png` | PNG | Cronograma |
| 7 | Foto bio (Jaylton Lopes Jr.) | `about_image.png` | PNG | Bio |
| 8 | Ícone IA/Cérebro-circuito | `icon_brain_circuit.svg` | SVG | Você também |
| 9 | Ícone Sorteio/Presente | `icon_gift.png` | PNG | Você também |
| 10 | Ícone Livro/Certificado | `icon_book.svg` | SVG | Você também |
| 11 | Ícone WhatsApp | `icon_whatsapp.svg` | SVG | Números |
| 12 | Ícone Mensagem | `icon_message.svg` | SVG | Números |
| 13 | Ícone YouTube | `icon_youtube.svg` | SVG | Hero (badge) |
| 14 | Ícone Calendário | `icon_calendar.svg` | SVG | Hero (badge) |
| 15 | Ícone Relógio | `icon__clock.svg` | SVG | Cronograma |

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

2. Verifique a estrutura após copiar:
   ```
   wp-content/themes/alasca/assets/images/
   ├── logo.png
   ├── hero_image.png
   ├── hero_bg.png
   ├── about_image.png
   ├── cronograma_01_set.png
   ├── cronograma_02_set.png
   ├── cronograma_03_set.png
   ├── icon_brain_circuit.svg
   ├── icon_gift.png
   ├── icon_book.svg
   ├── icon_whatsapp.svg
   ├── icon_message.svg
   ├── icon_youtube.svg
   ├── icon_calendar.svg
   └── icon__clock.svg
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
| `section-hero.php` | `logo.png`, `hero_image.png`, `hero_bg.png`, `icon_calendar.svg`, `icon_youtube.svg` |
| `section-cronograma-1.php` | `cronograma_01_set.png`, `cronograma_02_set.png`, `cronograma_03_set.png` |
| `section-cronograma-2.php` | `cronograma_01_set.png`, `cronograma_02_set.png`, `cronograma_03_set.png` |
| `section-voce-tambem.php` | `icon_brain_circuit.svg`, `icon_gift.png`, `icon_book.svg` |
| `section-bio.php` | `about_image.png` |
| `section-numeros.php` | `icon_whatsapp.svg`, `icon_message.svg` |

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

- [ ] Todos os 15 assets da tabela estão no diretório `assets/images/`
- [ ] Imagens WebP abrem corretamente no navegador
- [ ] SVGs renderizam corretamente (sem erros de path/viewBox)
- [ ] Nenhum 404 no console do navegador para imagens
- [ ] Alt text correto em todas as `<img>` tags
- [ ] `loading="eager"` na imagem do hero, `loading="lazy"` nas demais
- [ ] Imagens não ultrapassam o container (responsivas com `w-full h-auto`)
