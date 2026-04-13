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

```bash
git clone https://github.com/guilhermehassa/alasca.git
cd alasca
```

### 2. Configurar variáveis de ambiente

```bash
cp .env.example .env
# Edite o .env com suas credenciais (ou use os valores padrão para dev)
```

### 3. Subir os containers

```bash
docker-compose up -d
```

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

```bash
cd wp-content/themes/alasca
npm install
npm run watch    # Desenvolvimento (com hot reload)
npm run build    # Produção (minificado)
```

## Material de referência

A pasta `referencia/` contém os protótipos exportados do Figma em PDF, que servem como base visual para todo o desenvolvimento:

| Arquivo | Descrição |
|---------|-----------|
| `referencia/desktop.pdf` | Layout completo da versão desktop |
| `referencia/mobile.pdf` | Layout completo da versão mobile |

> Consulte esses PDFs durante o desenvolvimento para garantir fidelidade ao design e, ao final, para validação visual.

## Estrutura do projeto

```
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
│   ├── desktop.pdf             # Layout desktop completo
│   └── mobile.pdf              # Layout mobile completo
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