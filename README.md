# 🛒 Sistema de E-commerce Laravel

Um sistema completo de e-commerce desenvolvido em Laravel com funcionalidades de gerenciamento de produtos, carrinho de compras, categorias e sistema de autenticação.

## 📋 Índice

- [Características](#-características)
- [Tecnologias Utilizadas](#-tecnologias-utilizadas)
- [Estrutura do Projeto](#-estrutura-do-projeto)
- [Instalação](#-instalação)
- [Configuração](#-configuração)
- [Funcionalidades](#-funcionalidades)
- [Estrutura do Banco de Dados](#-estrutura-do-banco-de-dados)
- [Rotas](#-rotas)
- [Desenvolvimento](#-desenvolvimento)
- [Contribuição](#-contribuição)

## ✨ Características

- **Sistema de Autenticação**: Login e registro de usuários
- **Gerenciamento de Produtos**: CRUD completo para produtos
- **Sistema de Categorias**: Organização de produtos por categorias
- **Carrinho de Compras**: Adicionar, remover e atualizar itens
- **Interface Responsiva**: Design moderno e responsivo
- **Sistema de Upload**: Upload de imagens para produtos
- **QR Code**: Geração de códigos QR para demonstração
- **Painel Administrativo**: Área restrita para administradores
- **Sistema de Vendas**: Registro e controle de pedidos

## 🛠 Tecnologias Utilizadas

### Backend
- **Laravel 12.x** - Framework PHP
- **PHP 8.2+** - Linguagem de programação
- **SQLite** - Banco de dados (configurável para MySQL/PostgreSQL)
- **Inertia.js** - SPA-like experience
- **Laravel Cart** - Gerenciamento de carrinho

### Frontend
- **React** - Biblioteca JavaScript
- **TypeScript** - Superset do JavaScript
- **Tailwind CSS** - Framework CSS
- **Vite** - Build tool

### Ferramentas de Desenvolvimento
- **Laravel Pint** - Code style fixer
- **PHPUnit** - Testes automatizados
- **Laravel Pail** - Log viewer
- **Laravel Sail** - Docker development environment

## 📁 Estrutura do Projeto

```
example-app/
├── app/
│   ├── Http/
│   │   ├── Controllers/          # Controladores da aplicação
│   │   │   ├── Auth/            # Autenticação
│   │   │   ├── Settings/        # Configurações
│   │   │   ├── CarrinhoController.php
│   │   │   ├── CategoriaController.php
│   │   │   ├── ProdutoController.php
│   │   │   └── SiteController.php
│   │   ├── Middleware/          # Middlewares customizados
│   │   └── Requests/            # Form Requests
│   ├── Models/                  # Modelos Eloquent
│   │   ├── User.php
│   │   ├── Produtos.php
│   │   └── Categoria.php
│   └── Policies/                # Políticas de autorização
├── database/
│   ├── migrations/              # Migrações do banco
│   ├── seeders/                 # Seeders para dados iniciais
│   └── factories/               # Factories para testes
├── resources/
│   ├── views/                   # Views Blade
│   │   ├── admin/              # Painel administrativo
│   │   ├── site/               # Site público
│   │   └── login/              # Páginas de autenticação
│   ├── js/                     # Assets JavaScript/React
│   └── css/                    # Estilos CSS
├── routes/                      # Definição de rotas
├── public/                      # Arquivos públicos
└── storage/                     # Arquivos de armazenamento
```

## 🚀 Instalação

### Pré-requisitos
- PHP 8.2 ou superior
- Composer
- Node.js e npm
- SQLite (ou MySQL/PostgreSQL)

### Passos de Instalação

1. **Clone o repositório**
```bash
git clone <url-do-repositorio>
cd example-app
```

2. **Instale as dependências PHP**
```bash
composer install
```

3. **Instale as dependências JavaScript**
```bash
npm install
```

4. **Configure o ambiente**
```bash
cp .env.example .env
php artisan key:generate
```

5. **Configure o banco de dados**
```bash
# Para SQLite (padrão)
touch database/database.sqlite

# Para MySQL/PostgreSQL, configure no .env:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=seu_banco
# DB_USERNAME=seu_usuario
# DB_PASSWORD=sua_senha
```

6. **Execute as migrações**
```bash
php artisan migrate
```

7. **Execute os seeders (opcional)**
```bash
php artisan db:seed
```

8. **Compile os assets**
```bash
npm run build
```

## ⚙️ Configuração

### Variáveis de Ambiente Importantes

```env
APP_NAME="Sistema E-commerce"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite
DB_DATABASE=/caminho/para/database.sqlite

# Para upload de arquivos
FILESYSTEM_DISK=local
```

### Configuração do Laradock (Docker)

O projeto inclui configuração completa do Laradock para desenvolvimento com Docker:

```bash
cd laradock
cp .env.example .env
docker-compose up -d nginx mysql phpmyadmin
```

## 🎯 Funcionalidades

### 🔐 Sistema de Autenticação
- Login e logout de usuários
- Registro de novos usuários
- Middleware de autenticação
- Proteção de rotas sensíveis

### 📦 Gerenciamento de Produtos
- **Criar**: Adicionar novos produtos com imagem
- **Listar**: Visualizar produtos com paginação
- **Editar**: Atualizar informações dos produtos
- **Excluir**: Remover produtos do sistema
- **Buscar**: Sistema de busca por nome
- **Upload**: Upload de imagens para produtos

### 🏷️ Sistema de Categorias
- Gerenciamento de categorias
- Associação de produtos a categorias
- Visualização de produtos por categoria

### 🛒 Carrinho de Compras
- Adicionar produtos ao carrinho
- Remover itens do carrinho
- Atualizar quantidades
- Limpar carrinho completo
- Persistência de sessão

### 👤 Perfil do Usuário
- Visualização do perfil
- Edição de informações pessoais
- Upload de foto de perfil

### 🛡️ Painel Administrativo
- Dashboard com estatísticas
- Gerenciamento de usuários
- Controle de produtos e categorias
- Visualização de pedidos

## 🗄️ Estrutura do Banco de Dados

### Tabela `users`
```sql
- id (bigint, primary key)
- name (string)
- email (string, unique)
- email_verified_at (timestamp, nullable)
- password (string)
- photo (string, nullable)
- created_at (timestamp)
- updated_at (timestamp)
```

### Tabela `categorias`
```sql
- id (bigint, primary key)
- name (string)
- descricao (text)
- created_at (timestamp)
- updated_at (timestamp)
```

### Tabela `produtos`
```sql
- id (bigint, primary key)
- nome (string)
- descrição (text)
- preco (double, 10,2)
- slug (string)
- imagem (string, nullable)
- id_user (bigint, foreign key -> users.id)
- id_categoria (bigint, foreign key -> categorias.id)
- created_at (timestamp)
- updated_at (timestamp)
```

### Tabela `vendas`
```sql
- id (bigint, primary key)
- id_user (bigint, foreign key -> users.id)
- total (decimal, 10,2)
- status (string)
- created_at (timestamp)
- updated_at (timestamp)
```

## 🛣️ Rotas

### Rotas Públicas
- `GET /` - Página de login
- `POST /auth` - Autenticação
- `GET /register` - Formulário de registro

### Rotas Autenticadas
- `GET /inicio` - Home do site
- `GET /produto/{slug}` - Detalhes do produto
- `GET /categoria/{id}` - Produtos por categoria
- `GET /perfil` - Perfil do usuário
- `GET /carrinho` - Carrinho de compras

### Rotas do Carrinho
- `POST /carrinho` - Adicionar ao carrinho
- `POST /remove` - Remover do carrinho
- `POST /atualizar` - Atualizar quantidade
- `GET /limpar` - Limpar carrinho

### Rotas Administrativas
- `GET /admin/dashboard` - Dashboard admin
- `GET /admin/produtos` - Gerenciar produtos
- `GET /admin/categorias` - Gerenciar categorias
- `GET /admin/usuarios` - Gerenciar usuários
- `GET /admin/pedidos` - Visualizar pedidos

## 🚀 Desenvolvimento

### Comandos Úteis

```bash
# Executar em modo de desenvolvimento
composer run dev

# Executar testes
composer run test

# Code style fixer
./vendor/bin/pint

# Limpar cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Gerar QR Code
php artisan tinker
>>> LaravelQRCode\Facades\QRCode::text('Teste')->png();
```

### Estrutura de Desenvolvimento

1. **Models**: Definem a estrutura dos dados e relacionamentos
2. **Controllers**: Gerenciam a lógica de negócio e requisições
3. **Views**: Interface do usuário (Blade templates)
4. **Routes**: Definem as rotas da aplicação
5. **Middleware**: Filtros de requisições (autenticação, etc.)

### Padrões Utilizados

- **MVC**: Model-View-Controller
- **Repository Pattern**: Para acesso a dados
- **Service Layer**: Para lógica de negócio complexa
- **Form Requests**: Para validação de dados
- **Policies**: Para autorização

## 🤝 Contribuição

1. Fork o projeto
2. Crie uma branch para sua feature (`git checkout -b feature/AmazingFeature`)
3. Commit suas mudanças (`git commit -m 'Add some AmazingFeature'`)
4. Push para a branch (`git push origin feature/AmazingFeature`)
5. Abra um Pull Request

### Padrões de Código

- Siga o PSR-12 para PHP
- Use nomes descritivos para variáveis e funções
- Comente código complexo
- Escreva testes para novas funcionalidades

## 📝 Licença

Este projeto está sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

## 📞 Suporte

Para suporte, entre em contato através de:
- Email: seu-email@exemplo.com
- Issues: [GitHub Issues](https://github.com/seu-usuario/example-app/issues)

---

**Desenvolvido com ❤️ usando Laravel**
