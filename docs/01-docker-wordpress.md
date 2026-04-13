# Etapa 1 — Docker Compose: WordPress + MySQL

## Objetivo

Criar o ambiente de desenvolvimento local com Docker, rodando WordPress (em Português do Brasil) + MySQL + phpMyAdmin.

---

## Pré-requisitos

- Docker Desktop instalado e rodando no Windows
- Etapa 0 concluída (repositório configurado)

---

## Arquivos a criar

### 1. Arquivo `.env` (na raiz do projeto)

> **Este arquivo NÃO é versionado** (está no `.gitignore`). Crie manualmente.

```env
# MySQL
MYSQL_ROOT_PASSWORD=rootpassword123
MYSQL_DATABASE=wordpress
MYSQL_USER=wpuser
MYSQL_PASSWORD=wppassword123

# WordPress
WORDPRESS_DB_HOST=db:3306
WORDPRESS_DB_USER=wpuser
WORDPRESS_DB_PASSWORD=wppassword123
WORDPRESS_DB_NAME=wordpress

# phpMyAdmin
PMA_HOST=db
PMA_PORT=3306
```

> **Criar também um `.env.example`** (este SIM é versionado) com os mesmos campos mas valores placeholder:

```env
# MySQL
MYSQL_ROOT_PASSWORD=your_root_password
MYSQL_DATABASE=wordpress
MYSQL_USER=your_db_user
MYSQL_PASSWORD=your_db_password

# WordPress
WORDPRESS_DB_HOST=db:3306
WORDPRESS_DB_USER=your_db_user
WORDPRESS_DB_PASSWORD=your_db_password
WORDPRESS_DB_NAME=wordpress

# phpMyAdmin
PMA_HOST=db
PMA_PORT=3306
```

### 2. Arquivo `docker-compose.yml` (na raiz do projeto)

```yaml
version: '3.8'

services:
  # ========================================
  # MySQL 8.0
  # ========================================
  db:
    image: mysql:8.0
    container_name: alasca_db
    restart: unless-stopped
    env_file: .env
    environment:
      MYSQL_ROOT_PASSWORD: ${MYSQL_ROOT_PASSWORD}
      MYSQL_DATABASE: ${MYSQL_DATABASE}
      MYSQL_USER: ${MYSQL_USER}
      MYSQL_PASSWORD: ${MYSQL_PASSWORD}
    volumes:
      - db_data:/var/lib/mysql
    ports:
      - "3306:3306"
    networks:
      - alasca_network
    healthcheck:
      test: ["CMD", "mysqladmin", "ping", "-h", "localhost"]
      interval: 10s
      timeout: 5s
      retries: 5

  # ========================================
  # WordPress (Português do Brasil)
  # ========================================
  wordpress:
    image: wordpress:latest
    container_name: alasca_wp
    restart: unless-stopped
    depends_on:
      db:
        condition: service_healthy
    env_file: .env
    environment:
      WORDPRESS_DB_HOST: ${WORDPRESS_DB_HOST}
      WORDPRESS_DB_USER: ${WORDPRESS_DB_USER}
      WORDPRESS_DB_PASSWORD: ${WORDPRESS_DB_PASSWORD}
      WORDPRESS_DB_NAME: ${WORDPRESS_DB_NAME}
      WORDPRESS_LOCALE: pt_BR
      WORDPRESS_DEBUG: "true"
    volumes:
      - ./wp-content/themes/alasca:/var/www/html/wp-content/themes/alasca
      - ./wp-content/plugins:/var/www/html/wp-content/plugins
    ports:
      - "8080:80"
    networks:
      - alasca_network

  # ========================================
  # phpMyAdmin (ferramenta de debug)
  # ========================================
  phpmyadmin:
    image: phpmyadmin:latest
    container_name: alasca_pma
    restart: unless-stopped
    depends_on:
      - db
    env_file: .env
    environment:
      PMA_HOST: ${PMA_HOST}
      PMA_PORT: ${PMA_PORT}
    ports:
      - "8081:80"
    networks:
      - alasca_network

# ========================================
# Volumes persistentes
# ========================================
volumes:
  db_data:
    driver: local

# ========================================
# Rede interna
# ========================================
networks:
  alasca_network:
    driver: bridge
```

---

## Passos de execução

### 1. Criar o arquivo `.env`

```powershell
cd d:\projects\alasca
# Copie o .env.example para .env e altere as senhas se desejar
Copy-Item .env.example .env
```

### 2. Subir os containers

```powershell
docker-compose up -d
```

### 3. Verificar se os containers estão rodando

```powershell
docker-compose ps
# Deve mostrar 3 containers: alasca_db, alasca_wp, alasca_pma — todos "Up"
```

### 4. Acessar os serviços

| Serviço     | URL                          | Descrição                    |
|-------------|------------------------------|------------------------------|
| WordPress   | http://localhost:8080        | Site principal               |
| WP Admin    | http://localhost:8080/wp-admin | Painel administrativo       |
| phpMyAdmin  | http://localhost:8081        | Gerenciamento do banco       |

### 5. Configuração inicial do WordPress

Na primeira execução, o WordPress exibirá o assistente de instalação:

1. Acesse `http://localhost:8080`
2. O idioma já deve estar em **Português do Brasil** (graças ao `WORDPRESS_LOCALE=pt_BR`)
3. Preencha:
   - **Título do site:** Imersão em Direito Imobiliário
   - **Nome de usuário:** admin
   - **Senha:** (escolha uma senha forte)
   - **E-mail:** seu@email.com
   - **Visibilidade:** Marque "Desencorajar mecanismos de busca" (ambiente de dev)
4. Clique em "Instalar WordPress"

### 6. Configurações pós-instalação

No painel WP Admin (`http://localhost:8080/wp-admin`):

1. **Configurações > Leitura:**
   - "Sua página inicial mostra:" → **Uma página estática**
   - Página inicial → (será definida após criar a página na Etapa 3)

2. **Configurações > Links permanentes:**
   - Selecione **"Nome do post"** (`/%postname%/`)
   - Salvar alterações

3. **Configurações > Geral:**
   - Confirme que o idioma está em Português do Brasil
   - Fuso horário: Brasília (UTC-3)

---

## Comandos úteis

```powershell
# Subir os containers
docker-compose up -d

# Parar os containers (mantém os dados)
docker-compose stop

# Parar e remover os containers (dados do volume persistem)
docker-compose down

# Parar e remover TUDO (incluindo volumes — DESTRUTIVO)
docker-compose down -v

# Ver logs do WordPress
docker-compose logs -f wordpress

# Ver logs do MySQL
docker-compose logs -f db

# Acessar o shell do container WordPress
docker exec -it alasca_wp bash

# Executar WP-CLI dentro do container
docker exec -it alasca_wp wp --allow-root <comando>

# Reiniciar um serviço específico
docker-compose restart wordpress
```

---

## Notas Importantes

- O volume `db_data` persiste os dados do banco mesmo após `docker-compose down`. Só é apagado com `docker-compose down -v`.
- O diretório `wp-content/themes/alasca/` é montado como volume, então edições locais refletem imediatamente no container.
- O diretório `wp-content/plugins/` também é montado para permitir versionamento dos plugins.
- O `WORDPRESS_DEBUG: "true"` está habilitado para desenvolvimento. **Desabilitar em produção.**
- As credenciais do `.env` são para **desenvolvimento local apenas**. Nunca use em produção.

---

## Commit

```powershell
git add docker-compose.yml .env.example docs/01-docker-wordpress.md
git commit -m "feat: docker-compose WordPress + MySQL pt-BR"
git push origin master
```

---

## Verificação

- [ ] `docker-compose up -d` sobe sem erros
- [ ] 3 containers rodando (`docker-compose ps`)
- [ ] WordPress acessível em `http://localhost:8080`
- [ ] Assistente de instalação aparece em Português do Brasil
- [ ] phpMyAdmin acessível em `http://localhost:8081`
- [ ] Banco de dados `wordpress` visível no phpMyAdmin
