# Etapa 8 — Finalização e Deploy

## Objetivo

Revisar todos os componentes, realizar testes finais, atualizar a documentação do projeto e fazer o push final para o GitHub.

---

## Pré-requisitos

- Todas as etapas anteriores (0-7) concluídas
- Docker rodando com WordPress funcional
- Assets integrados nos templates

---

## Checklist de Revisão

### 1. Formulários

- [ ] Formulário Hero: submete com sucesso
- [ ] Formulário Como Participar: submete com sucesso
- [ ] Validação de e-mail funciona (rejeita e-mails inválidos)
- [ ] Validação de telefone funciona (aceita formato brasileiro)
- [ ] Campos obrigatórios impedem envio quando vazios
- [ ] Máscara de telefone `(99) 99999-9999` funciona no desktop
- [ ] Máscara de telefone funciona no mobile (teclado numérico)
- [ ] Mensagem de sucesso aparece com estilo verde
- [ ] Mensagem de erro aparece com estilo vermelho
- [ ] Botão mostra "Enviando..." durante a submissão
- [ ] Botão volta ao texto original após resposta
- [ ] CFDB7 registra as submissões (verificar no WP Admin → CFDB7)
- [ ] Formulário limpa os campos após sucesso

### 2. Responsividade

Testar nos seguintes viewports:

| Viewport | Largura | Status |
|----------|---------|--------|
| Mobile | 375px | [ ] OK |
| Mobile large | 414px | [ ] OK |
| Tablet | 768px | [ ] OK |
| Desktop small | 1024px | [ ] OK |
| Desktop | 1280px | [ ] OK |
| Desktop large | 1440px | [ ] OK |

Para cada viewport:
- [ ] Sem scroll horizontal
- [ ] Textos legíveis
- [ ] Botões clicáveis (min 44x44px)
- [ ] Imagens proporcionais
- [ ] Grids colapsam corretamente
- [ ] Formulários usáveis

### 3. SEO

- [ ] Yoast mostra semáforo verde na página Home
- [ ] Título SEO definido (60-70 caracteres)
- [ ] Meta descrição definida (120-160 caracteres)
- [ ] H1 único na página (Hero headline)
- [ ] Hierarquia de headings correta (H1 > H2 > H3)
- [ ] Todas as imagens têm `alt` descritivo
- [ ] `loading="lazy"` em imagens abaixo do fold
- [ ] Open Graph tags presentes (`og:title`, `og:description`, `og:image`)
- [ ] Schema markup de Event presente no `<head>`
- [ ] `lang="pt-BR"` no `<html>`

### 4. Performance

- [ ] CSS compilado e minificado (`npm run build`)
- [ ] Sem erros no console do navegador (F12)
- [ ] Sem 404 para assets (imagens, CSS, JS)
- [ ] Fontes carregam com `font-display: swap`
- [ ] Imagens em formato WebP (quando possível)

### 5. Acessibilidade

- [ ] Contraste de cores adequado (texto branco em fundo escuro)
- [ ] Focus states visíveis em inputs e botões (anel de foco)
- [ ] Links de CTA têm texto descritivo (não apenas "Clique aqui")
- [ ] Formulários têm labels associados (CF7 gerencia isso)
- [ ] Imagens decorativas com `alt=""`, imagens informativas com `alt` descritivo

### 6. Segurança

- [ ] `WORDPRESS_DEBUG` desabilitado (ou pronto para desabilitar em produção)
- [ ] `.env` não está sendo versionado (verificar com `git status`)
- [ ] Plugins atualizados na versão mais recente
- [ ] Senhas do banco de dados não estão hardcoded em nenhum arquivo versionado

---

## Atualizar README.md

O `README.md` na raiz do projeto deve conter:

```markdown
# Alasca — Imersão em Direito Imobiliário

Landing page de captura para a Imersão em Direito Imobiliário, desenvolvida com WordPress + tema customizado (Tailwind CSS).

## Tecnologias

- **CMS:** WordPress (latest)
- **Estilização:** Tailwind CSS 3.4
- **Formulários:** Contact Form 7 + CFDB7
- **SEO:** Yoast SEO
- **Infraestrutura:** Docker (WordPress + MySQL + phpMyAdmin)
- **Máscaras:** IMask.js

## Pré-requisitos

- [Docker Desktop](https://www.docker.com/products/docker-desktop/)
- [Node.js](https://nodejs.org/) (v18+)
- [Git](https://git-scm.com/)

## Como rodar

### 1. Clonar o repositório

\```bash
git clone https://github.com/guilhermehassa/alasca.git
cd alasca
\```

### 2. Configurar variáveis de ambiente

\```bash
cp .env.example .env
# Edite o .env com suas credenciais (ou use os valores padrão para dev)
\```

### 3. Subir os containers

\```bash
docker-compose up -d
\```

### 4. Acessar o WordPress

| Serviço | URL |
|---------|-----|
| WordPress | http://localhost:8080 |
| WP Admin | http://localhost:8080/wp-admin |
| phpMyAdmin | http://localhost:8081 |

Na primeira execução, siga o assistente de instalação do WordPress.

### 5. Ativar o tema

1. WP Admin → Aparência → Temas
2. Ativar "Alasca"
3. Configurações → Leitura → Página inicial: "Home"

### 6. Compilar CSS (Tailwind)

\```bash
cd wp-content/themes/alasca
npm install
npm run watch    # Desenvolvimento (com hot reload)
npm run build    # Produção (minificado)
\```

## Estrutura do projeto

\```
alasca/
├── docker-compose.yml          # Orquestração Docker
├── .env.example                # Template de variáveis de ambiente
├── .gitignore
├── README.md
├── docs/                       # Documentação de cada etapa
│   ├── 00-setup-repositorio.md
│   ├── 01-docker-wordpress.md
│   ├── 02-tema-customizado.md
│   ├── 03-estrutura-pagina.md
│   ├── 04-formularios-cf7.md
│   ├── 05-responsividade.md
│   ├── 06-seo-yoast.md
│   ├── 07-assets-figma.md
│   ├── 08-finalizacao-deploy.md
│   └── 09-validacao-playwright.md
├── referencia/                 # PDFs de referência (protótipos Figma)
│   ├── desktop.pdf
│   └── mobile.pdf
└── wp-content/
    ├── themes/alasca/          # Tema customizado
    │   ├── style.css
    │   ├── functions.php
    │   ├── front-page.php
    │   ├── header.php
    │   ├── footer.php
    │   ├── index.php
    │   ├── template-parts/     # Seções componentizadas
    │   ├── assets/
    │   │   ├── css/style.css   # CSS compilado (Tailwind)
    │   │   ├── js/main.js      # JavaScript
    │   │   └── images/         # Assets visuais
    │   ├── src/input.css       # Source do Tailwind
    │   ├── package.json
    │   └── tailwind.config.js
    └── plugins/                # Plugins WP (versionados)
\```

## Plugins WordPress

| Plugin | Função |
|--------|--------|
| Contact Form 7 | Formulários de contato/captura |
| CFDB7 | Armazenamento de submissões no banco |
| Yoast SEO | Otimização para mecanismos de busca |

## Comandos úteis

| Comando | Descrição |
|---------|-----------|
| `docker-compose up -d` | Subir containers |
| `docker-compose down` | Parar containers |
| `docker-compose logs -f wordpress` | Ver logs do WP |
| `npm run watch` | Tailwind em modo watch |
| `npm run build` | Build de produção |
| `docker exec -it alasca_wp wp --allow-root ...` | WP-CLI |

## Credenciais padrão (desenvolvimento)

Veja o arquivo `.env.example` para as credenciais do banco.
As credenciais do WordPress são definidas durante a instalação inicial.

## Licença

Propriedade de Guilherme Hassã. Todos os direitos reservados.
```

> ⚠️ Nota: O bloco acima é o conteúdo que deve ir no `README.md`. Os `\``` estão escapados para funcionar dentro deste documento `.md` — ao criar o arquivo real, use ``` normalmente.

---

## Comandos de commit finais

```powershell
cd d:\projects\alasca

# Build final do Tailwind
cd wp-content\themes\alasca
npm run build
cd ..\..\..

# Verificar que .env NÃO está no staging
git status

# Adicionar tudo
git add .
git commit -m "docs: README final e ajustes de revisão"
git push origin master
```

---

## Histórico de commits esperado

Ao final de todas as etapas, o histórico de commits deve ser:

```
docs: etapa 9 - validação visual via MCP Playwright  (Etapa 9)
docs: README final e ajustes de revisão               (Etapa 8)
feat: assets do Figma integrados                      (Etapa 7)
feat: SEO com Yoast + HTML semântico               (Etapa 6)
feat: responsividade mobile-first completa         (Etapa 5)
feat: formulários CF7 com validação, máscaras e CF7DB (Etapa 4)
feat: template da landing page com todas as seções (Etapa 3)
feat: tema customizado alasca com Tailwind CSS     (Etapa 2)
feat: docker-compose WordPress + MySQL pt-BR       (Etapa 1)
chore: setup inicial do repositório                (Etapa 0)
Initial commit                                     (GitHub)
```

---

## Verificação Final

- [ ] Todos os 10 commits realizados e pushados
- [ ] WordPress funcional em `localhost:8080`
- [ ] Landing page renderiza todas as 11 seções
- [ ] Formulários submetem e armazenam dados
- [ ] Responsividade OK em todos os viewports
- [ ] SEO configurado (Yoast verde)
- [ ] Assets carregam sem erros
- [ ] README.md completo e informativo
- [ ] `.env` NÃO está no repositório
- [ ] Sem erros no console do navegador
