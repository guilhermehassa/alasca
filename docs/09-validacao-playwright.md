# Etapa 9 — Validação Visual via MCP Playwright

## Objetivo

Usar o MCP Playwright para navegar na landing page, capturar screenshots e comparar visualmente com os protótipos de referência (`referencia/desktop.pdf` e `referencia/mobile.pdf`), garantindo fidelidade ao design.

---

## Pré-requisitos

- Todas as etapas anteriores (0-8) concluídas
- Docker rodando com WordPress funcional em `http://localhost:8080`
- MCP Playwright configurado e operacional na máquina
- PDFs de referência presentes em `referencia/desktop.pdf` e `referencia/mobile.pdf`

---

## Material de Referência

A pasta `referencia/` na raiz do projeto contém os protótipos exportados do Figma em PDF:

| Arquivo | Descrição |
|---------|-----------|
| `referencia/desktop.pdf` | Layout completo da versão desktop |
| `referencia/mobile.pdf` | Layout completo da versão mobile |

Esses PDFs devem ser consultados **durante todo o desenvolvimento** para garantir fidelidade ao design, e **ao final** como base de comparação na validação visual.

---

## Roteiro de Validação

### 1. Validação Desktop (viewport 1440×900)

Usar o MCP Playwright para:

1. **Navegar** para `http://localhost:8080`
2. **Definir viewport** para 1440×900 (desktop padrão)
3. **Capturar screenshot full-page** da landing page
4. **Comparar visualmente** com `referencia/desktop.pdf`

**Checklist de validação desktop:**

- [ ] Hero section: layout, imagem de fundo, posicionamento do formulário
- [ ] Logo e tipografia correspondem ao protótipo
- [ ] Seção Cronograma: grid de 3 colunas com thumbnails
- [ ] Seção Bio: foto + texto lado a lado
- [ ] Seção Como Participar: formulário centralizado
- [ ] Footer: informações legais e copyright
- [ ] Cores e espaçamentos consistentes com o Figma
- [ ] Fontes e tamanhos de texto corretos
- [ ] Botões de CTA com estilo correto
- [ ] Imagens carregando sem quebra

### 2. Validação Mobile (viewport 375×812)

Usar o MCP Playwright para:

1. **Navegar** para `http://localhost:8080`
2. **Definir viewport** para 375×812 (iPhone padrão)
3. **Capturar screenshot full-page** da landing page
4. **Comparar visualmente** com `referencia/mobile.pdf`

**Checklist de validação mobile:**

- [ ] Hero section: layout empilhado verticalmente
- [ ] Formulário ocupa largura total
- [ ] Cronograma: grid colapsado para 1 coluna
- [ ] Bio: foto acima do texto (stack vertical)
- [ ] Inputs com tamanho adequado para toque (min 44px)
- [ ] Textos legíveis sem zoom
- [ ] Sem overflow horizontal (sem scroll lateral)
- [ ] Espaçamentos proporcionais ao mobile do Figma
- [ ] Menu/navegação adaptado para mobile

### 3. Validação Funcional (interações)

Usar o MCP Playwright para testar interações:

1. **Formulário Hero:**
   - Preencher campos (nome, e-mail, telefone)
   - Verificar máscara de telefone `(99) 99999-9999`
   - Submeter formulário
   - Verificar mensagem de sucesso

2. **Formulário Como Participar:**
   - Repetir os mesmos testes do formulário Hero
   - Verificar que campos obrigatórios impedem envio quando vazios

3. **Scroll e navegação:**
   - Verificar que CTAs com âncora rolam suavemente para a seção correta
   - Verificar que todas as seções estão visíveis ao scrollar

### 4. Validação de Viewports Intermediários

Testar também nos seguintes viewports adicionais:

| Viewport | Largura × Altura | Dispositivo referência |
|----------|-------------------|------------------------|
| Mobile large | 414×896 | iPhone XR |
| Tablet | 768×1024 | iPad |
| Desktop small | 1024×768 | Laptop |
| Desktop | 1280×800 | Notebook |
| Desktop large | 1440×900 | Monitor |

Para cada viewport:
- [ ] Layout se adapta sem quebras
- [ ] Sem scroll horizontal
- [ ] Formulários funcionais e usáveis

---

## Comandos MCP Playwright (referência)

As ações do MCP Playwright são chamadas via o agente Copilot. Os comandos típicos são:

| Ação | Tool MCP | Descrição |
|------|----------|-----------|
| Navegar | `browser_navigate` | Abre uma URL no navegador |
| Screenshot | `browser_take_screenshot` | Captura screenshot da página |
| Snapshot | `browser_snapshot` | Captura snapshot acessível da página |
| Clicar | `browser_click` | Clica em um elemento |
| Digitar | `browser_type` | Digita texto em um campo |
| Redimensionar | `browser_resize` | Altera o viewport do navegador |
| Esperar | `browser_wait_for_text` | Aguarda texto aparecer na página |

### Exemplo de fluxo de validação

```
1. browser_navigate → http://localhost:8080
2. browser_resize → 1440×900
3. browser_take_screenshot → salvar como "desktop-fullpage.png"
4. Comparar com referencia/desktop.pdf
5. browser_resize → 375×812
6. browser_take_screenshot → salvar como "mobile-fullpage.png"
7. Comparar com referencia/mobile.pdf
8. browser_click → campo de e-mail
9. browser_type → "teste@email.com"
10. browser_click → botão de envio
11. browser_wait_for_text → mensagem de sucesso
```

---

## Critérios de Aprovação

A validação é considerada **aprovada** quando:

1. **Fidelidade visual ≥ 95%** — O layout renderizado corresponde ao protótipo PDF em cores, espaçamentos, tipografia e posicionamento
2. **Zero erros funcionais** — Formulários submetem, máscaras funcionam, validações ativas
3. **Responsividade OK** — Todos os viewports sem quebra visual ou scroll horizontal
4. **Zero erros de console** — Nenhum erro JS ou 404 no console do navegador
5. **Acessibilidade básica** — Focus states, contraste, labels em formulários

---

## Comandos de commit

```powershell
cd d:\projects\alasca

git add .
git commit -m "docs: etapa 9 - validação visual via MCP Playwright"
git push origin master
```

---

## Histórico de commits atualizado

```
docs: etapa 9 - validação visual via MCP Playwright  (Etapa 9)
docs: README final e ajustes de revisão               (Etapa 8)
feat: assets do Figma integrados                      (Etapa 7)
feat: SEO com Yoast + HTML semântico                  (Etapa 6)
feat: responsividade mobile-first completa            (Etapa 5)
feat: formulários CF7 com validação, máscaras e CF7DB (Etapa 4)
feat: template da landing page com todas as seções    (Etapa 3)
feat: tema customizado alasca com Tailwind CSS        (Etapa 2)
feat: docker-compose WordPress + MySQL pt-BR          (Etapa 1)
chore: setup inicial do repositório                   (Etapa 0)
Initial commit                                        (GitHub)
```
