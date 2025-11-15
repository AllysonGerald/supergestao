# ⚡ Super Gestão - Guia de Início Rápido

## 🚀 Instalação Rápida

### Pré-requisitos
- PHP 8.2+
- Composer
- MySQL/PostgreSQL
- Node.js (opcional para assets)

### Instalação em 5 Minutos

```bash
# 1. Clone e acesse o projeto
git clone https://github.com/AllysonGerald/supergestao.git
cd supergestao/backend

# 2. Instale as dependências
composer install

# 3. Configure o ambiente
cp .env.example .env
php artisan key:generate

# 4. Configure o banco de dados no .env
# DB_CONNECTION=mysql
# DB_DATABASE=super_gestao
# DB_USERNAME=seu_usuario
# DB_PASSWORD=sua_senha

# 5. Execute migrations e seeders
php artisan migrate --seed

# 6. Link de storage
php artisan storage:link

# 7. Inicie o servidor
php artisan serve
```

**Pronto!** Acesse: http://localhost:8000

---

## 👤 Credenciais de Acesso

Após executar o seeder (`php artisan db:seed`):

| Perfil | E-mail | Senha | Permissões |
|--------|--------|-------|------------|
| **Admin** | admin@supergestao.com | senha123 | Todas (incluindo Usuários) |
| **Gerente** | gerente@supergestao.com | senha123 | View, Create, Edit, Delete |
| **Usuário** | usuario@supergestao.com | senha123 | View, Create |

---

## 📋 Comandos Mais Usados

### Laravel Básico
```bash
php artisan serve              # Iniciar servidor (http://localhost:8000)
php artisan tinker             # Console interativo
php artisan route:list         # Listar rotas
php artisan migrate            # Executar migrations
php artisan db:seed            # Executar seeders
php artisan migrate:fresh --seed  # Reset completo + seeders
```

### Limpeza de Cache
```bash
php artisan cache:clear        # Limpar cache de aplicação
php artisan config:clear       # Limpar cache de configuração
php artisan view:clear         # Limpar cache de views
php artisan route:clear        # Limpar cache de rotas
php artisan optimize:clear     # Limpar todos os caches
```

### Criação de Componentes (Arquitetura)

#### Via Artisan (Laravel Padrão)
```bash
php artisan make:model NomeModel -mfsc     # Model + Migration + Factory + Seeder + Controller
php artisan make:controller NomeController --resource
php artisan make:request StoreNomeRequest
php artisan make:migration create_tabela_table
```

#### Via Make (Arquitetura Avançada)
```bash
make setup-architecture        # Criar estrutura completa de pastas
make make-repository          # Repository + Interface
make make-service             # Service class
make make-action              # Action class
make make-dto                 # Data Transfer Object
make make-observable-model    # Model + Observer
make help                     # Ver todos comandos
```

---

## 🏗️ Estrutura de Arquitetura

O projeto segue **Clean Architecture** com as seguintes camadas:

```
backend/app/
├── Actions/          ⚡ Ações específicas (ProcessarPedido, CancelarPedido)
├── DTOs/             📦 Data Transfer Objects
├── Enums/            🏷️  Constantes tipadas (Status, Tipos, Roles)
├── Repositories/     🗄️  Acesso a dados + Interfaces
├── Services/         💼 Lógica de negócio
├── Traits/           🔧 Código reutilizável
├── Http/Controllers/ 🌐 Controllers
└── Models/           🗃️  Eloquent Models
```

### Enums Disponíveis

- **`PedidoStatus`** → pendente, processando, enviado, entregue, cancelado
- **`ClienteTipo`** → fisica, juridica
- **`UserRole`** → admin, manager, user

---

## 📦 Módulos do Sistema

| Módulo | Descrição | Rota |
|--------|-----------|------|
| **Dashboard** | Métricas e estatísticas | `/admin/dashboard` |
| **Clientes** | Gestão de clientes (PF/PJ) | `/admin/clientes` |
| **Fornecedores** | Gestão de fornecedores | `/admin/fornecedores` |
| **Produtos** | Produtos + Estoque | `/admin/produtos` |
| **Pedidos** | Pedidos + Itens | `/admin/pedidos` |
| **Usuários** | Gestão de usuários (Admin) | `/admin/users` |

---

## 🔧 Configuração do Banco de Dados

### MySQL (Recomendado)
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=super_gestao
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

### PostgreSQL
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=super_gestao
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

### SQLite (Desenvolvimento)
```env
DB_CONNECTION=sqlite
# DB_DATABASE=/caminho/absoluto/database.sqlite
```

---

## 🔍 Troubleshooting

### Erro: "Class not found"
```bash
composer dump-autoload
php artisan optimize:clear
```

### Erro: "Column not found"
```bash
php artisan migrate:fresh --seed
# ⚠️ Isso apaga todos os dados!
```

### Erro: "Storage link not found"
```bash
php artisan storage:link
```

### Erro: "Permission denied"
```bash
sudo chmod -R 775 storage bootstrap/cache
sudo chown -R $USER:www-data storage bootstrap/cache
```

### Erro: "SQLSTATE[HY000] [2002] Connection refused"
- Verifique se o MySQL está rodando
- Confira as credenciais no `.env`
- Teste a conexão: `mysql -u usuario -p`

---

## 🧪 Testes

```bash
# Executar todos os testes
php artisan test

# Testes com coverage
php artisan test --coverage

# Teste específico
php artisan test --filter=ClienteTest
```

---

## 📊 Dados de Teste (Seeders)

Após executar `php artisan db:seed`, o sistema terá:

- ✅ **3 usuários** (Admin, Gerente, Usuário)
- ✅ **10 clientes** (5 PF, 5 PJ)
- ✅ **5 fornecedores**
- ✅ **20 produtos** (com estoque e preços)

---

## 🚀 Workflow de Desenvolvimento

### 1. Criar Nova Feature

```bash
# 1. Criar branch
git checkout -b feature/nova-funcionalidade

# 2. Criar Model + Migration
php artisan make:model NomeModel -m

# 3. Criar Repository
make make-repository
# Digite: NomeRepository

# 4. Criar Service
make make-service
# Digite: NomeService

# 5. Registrar Repository
# Editar: backend/app/Providers/RepositoryServiceProvider.php
# Adicionar: $this->app->bind(NomeRepositoryInterface::class, NomeRepository::class);

# 6. Criar Controller
php artisan make:controller Admin/NomeController --resource

# 7. Criar Requests
php artisan make:request StoreNomeRequest
php artisan make:request UpdateNomeRequest

# 8. Adicionar rotas em routes/web.php

# 9. Criar views em resources/views/admin/nome/

# 10. Commit e push
git add .
git commit -m "feat: add nova funcionalidade"
git push origin feature/nova-funcionalidade
```

---

## 🎯 Comandos Git Úteis

```bash
# Status
git status

# Ver branches
git branch -a

# Criar branch
git checkout -b feature/nome-feature

# Commit
git add .
git commit -m "feat: descrição"

# Push
git push origin nome-da-branch

# Merge para main
git checkout main
git merge feature/nome-feature
git push origin main
```

---

## 📚 Recursos Adicionais

### Documentação Laravel
- [Laravel 12 Docs](https://laravel.com/docs)
- [Eloquent ORM](https://laravel.com/docs/eloquent)
- [Blade Templates](https://laravel.com/docs/blade)

### Projeto
- **README.md** - Documentação completa
- **GitHub** - https://github.com/AllysonGerald/supergestao

---

## 💡 Dicas Importantes

1. **Sempre use migrations** - Nunca altere o banco manualmente
2. **Use Seeders** - Para dados de teste
3. **Siga a arquitetura** - Controller → Service → Repository → Model
4. **Valide dados** - Use Form Requests
5. **Use Enums** - Para constantes (status, tipos, etc)
6. **Faça commits frequentes** - Com mensagens descritivas em inglês
7. **Teste antes de commitar** - `php artisan test`

---

## ⚡ Comandos de Produção

```bash
# Otimizar para produção
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

# Queue worker (se usar filas)
php artisan queue:work

# Scheduler (se usar cron)
php artisan schedule:run
```

---

## 🆘 Suporte

Encontrou um problema? 

1. Verifique os logs: `storage/logs/laravel.log`
2. Execute: `php artisan optimize:clear`
3. Verifique o `.env`
4. Consulte o README.md completo

---

**Super Gestão** - Sistema Completo de Gestão Empresarial  
**Versão:** 1.0  
**Laravel:** 12.x  
**PHP:** 8.2+
