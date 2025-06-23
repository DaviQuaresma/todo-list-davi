# 📝 ToDo List - Projeto Fullstack com Laravel, MySQL, NGINX e HTML/Bootstrap

Aplicação de lista de tarefas (ToDo List) com backend em **Laravel + JWT**, banco de dados **MySQL**, e frontend simples sem framwork para otimizar o tempo feito com **HTML, Bootstrap e jQuery**. O projeto roda totalmente via **Docker Compose**.

---

## 📦 Estrutura do Projeto

```bash
todo-list-davi/
├── todo-api/        # Backend Laravel (API JWT)
├── todo-front/      # Frontend HTML/CSS/JS
├── docker-compose.yml
└── README.md
```

---

## 🚀 Como Rodar o Projeto com Docker

> Pré-requisitos:
> - Docker instalado e funcionando
> - Docker Compose

### 🔧 Passos para subir a aplicação:

1. **Clone o projeto:**
   ```bash
   git clone https://github.com/DaviQuaresma/todo-list-davi
   cd todo-list-davi
   ```

2. **Suba os containers:**
   ```bash
   docker compose up --build -d
   ```

3. **Acesse os serviços:**
   - **Frontend:** http://localhost:8080
   - **Backend API:** /api
   - **MySQL:** localhost:3308 (user: `davi`, pass: `davi`)

4. **(Opcional)** Rodar comandos Laravel no container:
   ```bash
   docker exec -it todo-api sh
   php artisan migrate --force
   ```

---

## 🧭 Roteiro de Uso

### 1. 📋 Registro

Acesse `http://localhost:8080/register.html`  
Preencha o formulário com nome, email e senha. Após isso vá a tela de login para acessar a página de tarefas.

### 2. 🔐 Login

Acesse `http://localhost:8080/index.html`  
Informe email e senha registrados anteriormente. O token será salvo no `localStorage`.

### 3. 🗂️ Gerenciar Listas

- Clique no botão `+` para criar novas listas.
- Clique sobre uma lista para exibir as tarefas dela.

### 4. ✅ Gerenciar Tarefas

- Digite e clique em `Adicionar` para criar nova tarefa na lista selecionada.
- Clique no `✓` para marcar como concluída (ou desfazer).
- Clique no `🗑️` para deletar a tarefa.

### 5. 🚪 Logout

- Clique em `Logout` no topo para sair e apagar o token local.

---

## 🛠️ Tecnologias

- **Backend**: Laravel 10, JWT Auth (`tymon/jwt-auth`)
- **Frontend**: HTML, Bootstrap 5, jQuery
- **Banco de Dados**: MySQL 8
- **Containers**: Docker, Docker Compose
- **Servidor**: NGINX (Frontend)

---

## ⚙️ Comandos úteis (Docker)

```bash
# Subir containers
docker compose up -d

# Parar containers
docker compose down

# Entrar no container da API
docker exec -it todo-api sh

# Rodar migrations
php artisan migrate --force

# Ver logs da API
docker logs -f todo-api
```

---

## 💡 Observações

- As requisições ao backend são autenticadas via token JWT salvo no `localStorage`.
- O frontend e backend comunicam-se via CORS. As regras já estão configuradas.
- O backend serve **apenas API JSON**.
- O frontend é estático e servido via NGINX, com requests AJAX para a API Laravel.
- **Atenção**: Algumas requisições podem apresentar lentidão na execução fora do Docker, especialmente quando o `php artisan serve` é usado diretamente. Isso ocorre por limitações do servidor embutido (voltado apenas para testes). Para desempenho ideal, utilize o ambiente com NGINX + PHP-FPM via Docker.

---

## 📄 Licença

Este projeto está sob a licença MIT.