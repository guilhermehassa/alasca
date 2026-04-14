# Alasca — Teste Técnico: Landing Page WordPress

Projeto de teste técnico para a empresa **Alasca**. Consiste em uma landing page de captura para a "Imersão em Direito Imobiliário", desenvolvida em WordPress com tema customizado.

O projeto foi construído a partir de protótipos Figma (desktop e mobile), transformando o design em uma landing page funcional com formulários de captura, responsividade completa e otimização SEO.

---

## Como o Projeto Funciona

### Stack Técnica

| Camada | Tecnologia |
|--------|------------|
| **CMS** | WordPress (latest) |
| **Infraestrutura** | Docker (WordPress + MySQL 8.0 + phpMyAdmin) |
| **Tema** | Customizado do zero — `alasca` |
| **Estilização** | Tailwind CSS 3.4 |
| **Formulários** | Contact Form 7 (CF7) + CFDB7 (armazenamento no banco) |
| **SEO** | Yoast SEO + Schema Markup (Event) |
| **Máscaras de Input** | IMask.js |
| **Fontes** | Google Fonts — Chivo (títulos/botões) + Figtree (textos) |

### Tema Customizado (`alasca`)

O tema foi desenvolvido do zero, sem uso de page builders. Toda a estrutura é baseada em templates PHP com classes utilitárias do Tailwind CSS.

**Arquivos principais do tema:**

| Arquivo | Função |
|---------|--------|
| `front-page.php` | Template da página inicial (Landing Page) |
| `header.php` | Cabeçalho HTML, meta tags, enqueue de assets |
| `footer.php` | Rodapé com scripts |
| `functions.php` | Registro de assets (CSS/JS/Fonts), limpeza do `<head>`, schema markup, desativação do Gutenberg para páginas |
| `style.css` | Metadados do tema WordPress (obrigatório) |
| `tailwind.config.js` | Configuração do Tailwind (cores, fontes, breakpoints) |

**Seções da Landing Page** (em `template-parts/`):

| Template Part | Seção |
|---------------|-------|
| `section-hero.php` | Hero com formulário de captura |
| `section-para-quem.php` | "Para quem é?" — cards de público-alvo |
| `section-cta.php` | Call-to-action (reutilizado 2x) |
| `section-cronograma.php` | Cronograma/Programação do evento |
| `section-voce-tambem.php` | "Você também" — prova social |
| `section-bio.php` | Biografia do organizador |
| `section-como-participar.php` | Formulário de inscrição |
| `section-numeros.php` | Números/estatísticas oficiais |

### Plugins Utilizados

| Plugin | Função |
|--------|--------|
| **Contact Form 7** | Criação dos formulários de captura (Hero e Como Participar) |
| **CFDB7** | Armazenamento dos envios de formulário no banco de dados WordPress |
| **Yoast SEO** | Configuração de meta tags, título, descrição e análise de SEO |
| **Akismet** | Anti-spam (padrão do WordPress) |

### Compilação do CSS

O Tailwind CSS compila a partir de `src/input.css` para `assets/css/style.css`:

```bash
cd wp-content/themes/alasca
npm install
npm run build    # Produção (minificado)
npm run watch    # Desenvolvimento (hot reload)
```

---

## Como Rodar o Projeto

### Pré-requisitos

- [Docker Desktop](https://www.docker.com/products/docker-desktop/)
- [Node.js](https://nodejs.org/) (v18+)
- [Git](https://git-scm.com/)

### 1. Clonar e configurar

```bash
git clone https://github.com/guilhermehassa/alasca.git
cd alasca
cp .env.example .env
```

Edite o `.env` com suas credenciais ou use os valores padrão para desenvolvimento local.

### 2. Subir os containers

```bash
docker-compose up -d
```

### 3. Configuração inicial do WordPress

Na primeira execução, acesse `http://localhost:8080` e siga o assistente de instalação do WordPress. Após a instalação:

1. Acesse **WP Admin → Aparência → Temas** e ative o tema **"Alasca"**
2. Em **Configurações → Leitura**, defina a página inicial como **"Home"**
3. Ative os plugins **Contact Form 7**, **CFDB7** e **Yoast SEO**

---

## Acesso ao WordPress

| Serviço | URL | Credenciais |
|---------|-----|-------------|
| **Site (Landing Page)** | http://localhost:8080 | — |
| **WP Admin** | http://localhost:8080/wp-admin | `admin` / `Admin@123456` |
| **phpMyAdmin** | http://localhost:8081 | root / senha do `.env` |

### Banco de Dados

| Variável | Valor padrão |
|----------|-------------|
| Host | `db:3306` (interno Docker) / `localhost:3306` (externo) |
| Database | `wordpress` |
| Usuário | Definido no `.env` |

---

## Estrutura do Projeto

```
alasca/
├── docker-compose.yml              # Orquestração Docker (WP + MySQL + phpMyAdmin)
├── .env.example                    # Template de variáveis de ambiente
├── README.md
├── referencia/                     # Protótipos Figma exportados em PDF
│   ├── desktop.pdf
│   └── mobile.pdf
├── wp-content/
│   ├── plugins/                    # Plugins WordPress (CF7, CFDB7, Yoast, Akismet)
│   └── themes/
│       └── alasca/                 # Tema customizado
│           ├── front-page.php      # Template da landing page
│           ├── header.php          # Cabeçalho
│           ├── footer.php          # Rodapé
│           ├── functions.php       # Lógica do tema
│           ├── style.css           # Metadados do tema
│           ├── tailwind.config.js  # Config Tailwind
│           ├── package.json        # Scripts npm (build/watch)
│           ├── src/input.css       # CSS fonte (Tailwind directives)
│           ├── assets/
│           │   ├── css/style.css   # CSS compilado
│           │   ├── js/main.js      # JavaScript (máscaras, interações)
│           │   └── images/         # Imagens otimizadas (WebP)
│           └── template-parts/     # Seções componentizadas da LP
│               ├── section-hero.php
│               ├── section-para-quem.php
│               ├── section-cta.php
│               ├── section-cronograma.php
│               ├── section-voce-tambem.php
│               ├── section-bio.php
│               ├── section-como-participar.php
│               └── section-numeros.php
└── docs/                           # Documentação do projeto
    └── projeto.md
```

## Documentação

Cada etapa do desenvolvimento está documentada na pasta `docs/`:

| Etapa | Documento | Descrição |
|-------|-----------|-----------|
| 0 | [Setup do Repositório](docs/00-setup-repositorio.md) | Clone, git, estrutura de pastas |
| 1 | [Docker + WordPress](docs/01-docker-wordpress.md) | Docker Compose, MySQL, WP pt-BR |
| 2 | [Tema Customizado](docs/02-tema-customizado.md) | Tema limpo + Tailwind CSS |
| 3 | [Estrutura da Página](docs/03-estrutura-pagina.md) | Template da landing (seções) |
| 4 | [Formulários CF7](docs/04-formularios-cf7.md) | Contact Form 7 + CFDB7, máscaras |
| 5 | [Responsividade](docs/05-responsividade.md) | Mobile-first, breakpoints |
| 6 | [SEO + Yoast](docs/06-seo-yoast.md) | Yoast SEO + HTML semântico |
| 7 | [Assets do Figma](docs/07-assets-figma.md) | Importação e otimização |
| 8 | [Finalização](docs/08-finalizacao-deploy.md) | Revisão, testes, deploy |

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

## Credenciais padrão (desenvolvimento)

Veja o arquivo `.env.example` para as credenciais do banco de dados.
As credenciais do WordPress são definidas durante a instalação inicial.

## Licença

Propriedade de Guilherme Hassã. Todos os direitos reservados.