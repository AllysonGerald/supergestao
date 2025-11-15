# 🛠️ Comandos Úteis - Arquitetura

## 📋 Comandos Make Disponíveis

### Estrutura Base
```bash
# Cria toda a estrutura de pastas
make setup-architecture
```

### Repositories
```bash
# Cria Repository + Interface
make make-repository
# Exemplo: UserRepository + UserRepositoryInterface
```

### Services
```bash
# Cria Service class
make make-service
# Exemplo: UserService
```

### Actions
```bash
# Cria Action class
make make-action
# Exemplo: CreateUserAction
```

### DTOs
```bash
# Cria Data Transfer Object
make make-dto
# Exemplo: UserDTO
```

### Resources (API)
```bash
# Cria Resource completo (single + collection)
make make-resource-full
# Exemplo: UserResource + UserCollection
```

### Model Completo
```bash
# Cria Model + Observer
make make-observable-model
# Exemplo: User + UserObserver
```

### API Completa
```bash
# Cria tudo para API (Model, Controller, Resource, Request, Migration, Factory, Seeder)
make make-api-resource-full
```

### Módulo Completo
```bash
# Cria estrutura de módulo completo
make make-module
# Exemplo: Blog (Controllers, Models, Services, Repositories, etc)
```

### Events & Listeners
```bash
# Cria Event + Listener
make make-event-listener-full
```

### Jobs
```bash
# Cria Job com queue
make make-queue-job-full
```

### Policies
```bash
# Cria Policy para Model
make make-policy-model
```

---

## 🏗️ Estrutura Criada

```
backend/app/
├── Actions/           ⚡ Ações de uso único
├── DTOs/              📦 Data Transfer Objects
├── Enums/             🏷️  Constantes tipadas
├── Observers/         👁️  Event Listeners
├── Repositories/      🗄️  Camada de dados
│   └── Contracts/     📄 Interfaces
├── Services/          💼 Lógica de negócio
├── Traits/            🔧 Código reutilizável
└── Utils/             🛠️  Utilitários
```

---

## 📝 Exemplos de Uso

### Criar Repository
```bash
make make-repository
# Digite: UserRepository
# Cria:
# - app/Repositories/Contracts/UserRepositoryInterface.php
# - app/Repositories/UserRepository.php
```

### Criar Service
```bash
make make-service
# Digite: UserService
# Cria:
# - app/Services/UserService.php
```

### Criar Action
```bash
make make-action
# Digite: CreateUserAction
# Cria:
# - app/Actions/CreateUserAction.php
```

---

## 🔗 Workflow Completo

### 1. Criar Feature Completa (exemplo: Products)

```bash
# 1. Model + Migration + Factory + Seeder
php artisan make:model Product -mfs

# 2. Repository
make make-repository
# Digite: ProductRepository

# 3. Service
make make-service
# Digite: ProductService

# 4. Controller
php artisan make:controller Admin/ProductController --resource

# 5. Requests de validação
php artisan make:request StoreProductRequest
php artisan make:request UpdateProductRequest

# 6. (Opcional) Enum
# Criar manualmente em app/Enums/ProductStatus.php

# 7. Registrar Repository no RepositoryServiceProvider
# Adicionar: $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
```

---

## 📚 Arquivos Importantes

- **`ARCHITECTURE.md`** - Documentação completa da arquitetura
- **`backend/app/Providers/RepositoryServiceProvider.php`** - Registro de Repositories
- **`bootstrap/providers.php`** - Registro de Service Providers

---

## ✅ Checklist para Nova Feature

- [ ] Criar Model + Migration
- [ ] Criar Repository Interface
- [ ] Criar Repository Implementation
- [ ] Registrar no RepositoryServiceProvider
- [ ] Criar Service
- [ ] Criar Controller
- [ ] Criar Form Requests (Store/Update)
- [ ] (Opcional) Criar Actions se necessário
- [ ] (Opcional) Criar DTOs se necessário
- [ ] (Opcional) Criar Enums se necessário
- [ ] Criar views
- [ ] Adicionar rotas
- [ ] Criar testes

---

## 🧪 Testes

```bash
# Rodar todos os testes
php artisan test

# Rodar testes de uma feature específica
php artisan test --filter=ClienteTest

# Rodar testes com coverage
php artisan test --coverage
```

---

## 📊 Ajuda Geral

```bash
# Ver todos os comandos disponíveis
make help

# Comandos Docker
make help | grep Docker

# Comandos Laravel
make help | grep Laravel

# Comandos de Arquitetura
make help | grep "Arquitetura"
```

---

**Branch:** `feature/architecture-improvement`
**Data:** 2025-11-15

