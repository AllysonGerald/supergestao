# Super Gestão

Sistema completo de gestão empresarial desenvolvido com Laravel 12 e Tailwind CSS, implementando **Clean Architecture** e **padrões avançados de desenvolvimento**.

> 🏗️ **Arquitetura Profissional**: Este projeto implementa Services, Repositories, Actions, DTOs, Enums e Traits seguindo princípios SOLID e Clean Architecture.

## 🚀 Funcionalidades

### Autenticação
- Login e Registro de usuários
- Logout seguro
- Controle de perfis (Admin, Gerente, Usuário)

### Dashboard Administrativo
- Métricas e estatísticas em tempo real
- Gráficos de pedidos por status
- Produtos com estoque baixo
- Últimos pedidos
- Produtos mais vendidos
- Faturamento mensal

### Módulos de Gestão

#### 👥 Clientes
- Cadastro de pessoas físicas e jurídicas
- Gestão completa de dados cadastrais
- Endereço completo
- Histórico de pedidos
- Filtros e busca avançada

#### 🚚 Fornecedores
- Cadastro de fornecedores
- Dados completos (CNPJ, contatos, endereço)
- Produtos vinculados
- Controle de ativo/inativo

#### 📦 Produtos
- Cadastro completo de produtos
- Upload de imagens
- Controle de estoque (mínimo e atual)
- Preço de custo e venda
- Cálculo automático de margem de lucro
- Categorização
- Vinculação com fornecedores
- Alerta de estoque baixo

#### 🛒 Pedidos
- Criação de pedidos com múltiplos itens
- Cálculo automático de valores
- Controle de status (Pendente, Processando, Enviado, Entregue, Cancelado)
- Desconto
- Data de entrega prevista
- Atualização automática de estoque
- Histórico completo

#### 👨‍💼 Usuários (Apenas Admin)
- Gestão de usuários do sistema
- Controle de perfis e permissões
- Ativação/desativação de contas
- Redefinição de senhas

## 🏗️ Arquitetura Avançada

Este projeto implementa uma **arquitetura em camadas** profissional seguindo os princípios de **Clean Architecture** e **SOLID**:

### Camadas Implementadas

- **🌐 Controllers (HTTP Layer)** - Recebe requests e retorna responses
- **💼 Services (Business Logic)** - Orquestra lógica de negócio complexa
- **🗄️ Repositories (Data Access)** - Abstrai acesso aos dados através de interfaces
- **⚡ Actions (Single Responsibility)** - Ações específicas e reutilizáveis
- **🏷️ Enums (Type-Safe Constants)** - Constantes tipadas (Status, Tipos, Roles)
- **📦 DTOs (Data Transfer Objects)** - Transferência de dados entre camadas
- **🔧 Traits (Reusable Code)** - Código reutilizável (Filtros, Formatação)
- **👁️ Observers (Event Listeners)** - Listeners de eventos de Model
- **🛠️ Utils (Helpers)** - Utilitários genéricos

### Enums Disponíveis

- **`PedidoStatus`** - pendente, processando, enviado, entregue, cancelado
- **`ClienteTipo`** - pessoa física, pessoa jurídica
- **`UserRole`** - admin, manager, user (com permissões)

### Benefícios da Arquitetura

✅ **Testabilidade** - Fácil criar testes unitários com mocks  
✅ **Manutenibilidade** - Código organizado e fácil de manter  
✅ **Escalabilidade** - Simples adicionar novas funcionalidades  
✅ **Reutilização** - Actions e Traits compartilháveis  
✅ **Type Safety** - Enums e DTOs garantem tipos corretos  
✅ **SOLID Principles** - Single Responsibility, Dependency Inversion, etc

### 📚 Documentação

- **[QUICK_START.md](QUICK_START.md)** - Guia de início rápido
- Documentação inline no código
- Exemplos de uso nas pastas de cada camada

## 🛠️ Tecnologias Utilizadas

- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: Blade Templates + Tailwind CSS
- **JavaScript**: Alpine.js para interatividade
- **Ícones**: Font Awesome 6
- **Banco de Dados**: MySQL/PostgreSQL/SQLite

## 📋 Requisitos

- PHP 8.2 ou superior
- Composer
- Node.js e NPM (para assets)
- MySQL/PostgreSQL/SQLite
- Docker (opcional, via Laravel Sail)

## 🔧 Instalação

### 1. Clone o repositório e acesse a pasta do backend

```bash
cd backend
```

### 2. Instale as dependências do Composer

```bash
composer install
```

### 3. Configure o arquivo .env

```bash
cp .env.example .env
php artisan key:generate
```

Configure as credenciais do banco de dados no arquivo `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=super_gestao
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

### 4. Execute as migrations e seeders

```bash
php artisan migrate
php artisan db:seed
```

### 5. Crie o link simbólico para armazenamento

```bash
php artisan storage:link
```

### 6. Inicie o servidor de desenvolvimento

```bash
php artisan serve
```

O sistema estará disponível em: `http://localhost:8000`

## 🛠️ Comandos Make (Arquitetura)

O projeto inclui comandos Make para facilitar a criação de componentes:

### Estrutura de Pastas
```bash
make setup-architecture    # Cria toda a estrutura de pastas
```

### Criar Componentes
```bash
make make-repository       # Cria Repository + Interface
make make-service          # Cria Service class
make make-action           # Cria Action class
make make-dto              # Cria Data Transfer Object
make make-observable-model # Cria Model com Observer
```

### API Completa
```bash
make make-api-resource-full  # Cria Model, Controller, Resource, Request, Migration
```

### Outros Comandos
```bash
make help                  # Ver todos os comandos disponíveis
make make-module           # Criar módulo completo
make make-event-listener-full  # Criar Event + Listener
```

📚 **Ver mais:** [QUICK_START.md](QUICK_START.md)

## 👤 Credenciais de Acesso Padrão

Após executar o seeder, você terá os seguintes usuários:

### Administrador
- **E-mail**: admin@supergestao.com
- **Senha**: senha123
- **Perfil**: Admin (acesso total)

### Gerente
- **E-mail**: gerente@supergestao.com
- **Senha**: senha123
- **Perfil**: Manager

### Usuário
- **E-mail**: usuario@supergestao.com
- **Senha**: senha123
- **Perfil**: User

## 📁 Estrutura do Projeto

```
backend/
├── app/
│   ├── Actions/                # ⚡ Ações de uso único (ProcessarPedido, CancelarPedido)
│   ├── DTOs/                   # 📦 Data Transfer Objects (ClienteDTO)
│   ├── Enums/                  # 🏷️  Enums tipados (PedidoStatus, ClienteTipo, UserRole)
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          # Controllers administrativos
│   │   │   ├── Auth/           # Controllers de autenticação
│   │   │   └── Site/           # Controllers do site público
│   │   ├── Middleware/
│   │   │   └── CheckAdmin.php  # Middleware de verificação admin
│   │   └── Requests/           # Form Requests de validação
│   ├── Models/                 # 🗃️  Models Eloquent
│   ├── Observers/              # 👁️  Event Listeners de Models
│   ├── Providers/              # Service Providers (RepositoryServiceProvider)
│   ├── Repositories/           # 🗄️  Camada de acesso a dados
│   │   ├── Contracts/          # Interfaces dos Repositories
│   │   ├── ClienteRepository.php
│   │   └── ProdutoRepository.php
│   ├── Services/               # 💼 Lógica de negócio (ClienteService)
│   ├── Traits/                 # 🔧 Código reutilizável (HasFilters, FormatsDocuments)
│   └── Utils/                  # 🛠️  Utilitários e Helpers
├── database/
│   ├── migrations/             # Migrations do banco
│   └── seeders/                # Seeders com dados iniciais
├── resources/
│   └── views/
│       ├── admin/              # Views administrativas
│       ├── auth/               # Views de autenticação
│       ├── layouts/            # Layouts do sistema
│       └── site/               # Views do site público
└── routes/
    └── web.php                 # Rotas da aplicação
```

## 🎨 Interface

O sistema possui uma interface moderna e responsiva construída com:

- **Tailwind CSS**: Design system moderno
- **Alpine.js**: Interatividade leve
- **Font Awesome**: Ícones profissionais
- **Design Responsivo**: Funciona em desktop, tablet e mobile

### Características da Interface

- Menu lateral retrátil
- Cards com gradientes
- Tabelas com paginação
- Formulários validados
- Notificações de sucesso/erro
- Modais e dropdowns
- Dashboard com estatísticas visuais

## 🔒 Segurança

- Autenticação segura com Laravel
- Proteção CSRF em todos os formulários
- Middleware de autenticação
- Controle de acesso baseado em perfis
- Senhas criptografadas com Hash
- Validação de dados em todos os formulários

## 📊 Funcionalidades Adicionais

### Dashboard
- Total de clientes, produtos, fornecedores e pedidos
- Valor de faturamento do mês
- Produtos com estoque baixo
- Últimos 5 pedidos
- Top 5 produtos mais vendidos
- Distribuição de pedidos por status

### Filtros e Buscas
- Busca em todos os módulos
- Filtros por status, tipo, categoria
- Ordenação de resultados
- Paginação

### Relatórios
- Estatísticas por cliente
- Histórico de pedidos
- Controle de estoque
- Produtos por fornecedor

## 🚀 Próximos Passos (Melhorias Futuras)

### ✅ Implementado
- [x] **Arquitetura em Camadas** (Services, Repositories, Actions)
- [x] **Enums Tipados** (PedidoStatus, ClienteTipo, UserRole)
- [x] **Repository Pattern** com Interfaces
- [x] **Service Layer** para lógica de negócio
- [x] **Actions** para operações específicas
- [x] **DTOs** para transferência de dados
- [x] **Traits** reutilizáveis
- [x] **Dependency Injection** configurada

### 📋 Próximas Melhorias
- [ ] Refatorar todos os Controllers para usar Services
- [ ] Criar Repositories para Fornecedor e Pedido
- [ ] Implementar Observers para logs automáticos
- [ ] Adicionar testes unitários (PHPUnit)
- [ ] Adicionar testes de integração
- [ ] Relatórios em PDF
- [ ] Exportação para Excel
- [ ] Gráficos interativos com Chart.js
- [ ] Notificações por e-mail
- [ ] API REST completa
- [ ] Integração com gateway de pagamento
- [ ] Multi-idioma (i18n)
- [ ] Tema escuro
- [ ] Backup automático
- [ ] Logs de auditoria detalhados
- [ ] Queue para processamento assíncrono
- [ ] Cache para performance

## 📝 Licença

Este projeto é de código aberto e está sob a licença MIT.

## 👨‍💻 Suporte

Para dúvidas ou suporte, entre em contato através do e-mail configurado no sistema.

---

**Super Gestão** - Sistema Completo de Gestão Empresarial
