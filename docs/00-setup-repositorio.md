# Etapa 0 — Setup do Repositório

## Objetivo

Configurar o repositório Git local, sincronizar com o GitHub e criar a estrutura de pastas base para o projeto.

---

## Pré-requisitos

- Git instalado e configurado na máquina Windows
- Acesso autenticado via HTTPS ao GitHub (`https://github.com/guilhermehassa/alasca`)
- Pasta de trabalho: `d:\projects\alasca`

---

## Passos

### 1. Clonar o repositório

```powershell
cd d:\projects
git clone https://github.com/guilhermehassa/alasca.git
cd alasca
```

> Se a pasta já existir com conteúdo, use:
> ```powershell
> cd d:\projects\alasca
> git init
> git remote add origin https://github.com/guilhermehassa/alasca.git
> git pull origin master
> ```

### 2. Verificar conexão com o GitHub

```powershell
git remote -v
# Deve mostrar:
# origin  https://github.com/guilhermehassa/alasca.git (fetch)
# origin  https://github.com/guilhermehassa/alasca.git (push)
```

### 3. Criar o `.gitignore`

Já foi criado na raiz do projeto com as seguintes regras:

- `db_data/` — Dados do MySQL (volume Docker)
- `wp-content/uploads/` — Uploads do WP (runtime)
- `.env` — Variáveis de ambiente sensíveis
- `node_modules/` — Dependências Node.js (Tailwind)
- Arquivos de sistema (Windows/macOS) e IDE

### 4. Criar estrutura de pastas base

```powershell
# Na raiz do projeto (d:\projects\alasca)
mkdir docs
mkdir wp-content
mkdir wp-content\themes
mkdir wp-content\themes\alasca
mkdir wp-content\themes\alasca\assets
mkdir wp-content\themes\alasca\assets\css
mkdir wp-content\themes\alasca\assets\js
mkdir wp-content\themes\alasca\assets\images
mkdir wp-content\themes\alasca\src
mkdir wp-content\themes\alasca\template-parts
```

**Estrutura resultante:**

```
d:\projects\alasca\
├── .gitignore
├── README.md
├── docs/
│   ├── 00-setup-repositorio.md
│   ├── 01-docker-wordpress.md
│   ├── ...
├── docker-compose.yml          (será criado na Etapa 1)
├── .env                        (será criado na Etapa 1, ignorado pelo git)
└── wp-content/
    └── themes/
        └── alasca/
            ├── assets/
            │   ├── css/
            │   ├── js/
            │   └── images/
            ├── src/
            └── template-parts/
```

### 5. Commit desta etapa

```powershell
git add .
git commit -m "chore: setup inicial do repositório"
git push origin master
```

---

## Verificação

- [ ] Repo clonado e conectado ao GitHub
- [ ] `.gitignore` criado com regras adequadas
- [ ] Estrutura de pastas criada
- [ ] Commit realizado e push feito com sucesso
