# 🏗️ Arquitetura do Projeto - Super Gestão

## 📋 Visão Geral

Este projeto implementa uma **arquitetura em camadas** seguindo os princípios de **Clean Architecture** e **Domain-Driven Design (DDD)** adaptados para Laravel.

---

## 🎯 Princípios Aplicados

- **Single Responsibility Principle (SRP)** - Cada classe tem uma única responsabilidade
- **Dependency Inversion Principle (DIP)** - Dependemos de abstrações (interfaces), não de implementações
- **Separation of Concerns** - Separação clara entre camadas
- **Don't Repeat Yourself (DRY)** - Código reutilizável em Traits e Actions
- **Testability** - Código facilmente testável através de injeção de dependência

---

## 📁 Estrutura de Camadas

```
backend/app/
├── Http/                   # 🌐 Camada de Transporte
│   ├── Controllers/        # Recebe requests e retorna responses
│   ├── Middleware/         # Intercepta e processa requests
│   └── Requests/           # Validação de dados de entrada
│
├── Services/               # 💼 Camada de Negócio
│   └── ClienteService.php  # Orquestra lógica de negócio complexa
│
├── Repositories/           # 🗄️ Camada de Dados
│   ├── Contracts/          # Interfaces (abstrações)
│   │   └── ClienteRepositoryInterface.php
│   └── ClienteRepository.php  # Implementação (acesso aos Models)
│
├── Models/                 # 🗃️ Camada de Persistência
│   └── Cliente.php         # Eloquent Models (ORM)
│
├── Actions/                # ⚡ Ações de Uso Único
│   ├── ProcessarPedidoAction.php
│   └── CancelarPedidoAction.php
│
├── Enums/                  # 🏷️ Constantes Tipadas
│   ├── PedidoStatus.php
│   ├── ClienteTipo.php
│   └── UserRole.php
│
├── DTOs/                   # 📦 Data Transfer Objects
│   └── ClienteDTO.php      # Transferência de dados entre camadas
│
├── Traits/                 # 🔧 Código Reutilizável
│   ├── HasFilters.php
│   └── FormatsDocuments.php
│
├── Observers/              # 👁️ Event Listeners de Model
│   └── PedidoObserver.php
│
└── Utils/                  # 🛠️ Utilitários Genéricos
    └── Helper.php
```

---

## 🔄 Fluxo de Dados

```
Request → Controller → Service → Repository → Model → Database
                ↓         ↓          ↓
              Action    DTO      Interface
```

### Exemplo Prático:

1. **Request chega** → `ClienteController@store`
2. **Controller** valida dados e chama → `ClienteService@criarCliente`
3. **Service** aplica regras de negócio e chama → `ClienteRepository@create`
4. **Repository** acessa o → `Model (Cliente)`
5. **Model** persiste no → **Database**
6. **Response** retorna pela mesma cadeia

---

## 📦 Componentes da Arquitetura

### 1️⃣ Controllers (HTTP Layer)

**Responsabilidade:** Receber requests, validar dados básicos, chamar Services, retornar responses

```php
public function store(Request $request)
{
    $validated = $request->validate([...]);
    
    $cliente = $this->clienteService->criarCliente($validated);
    
    return redirect()->route('clientes.index')
        ->with('success', 'Cliente criado!');
}
```

**❌ NÃO deve:**
- Conter lógica de negócio
- Acessar Models diretamente
- Fazer queries complexas

**✅ DEVE:**
- Validar requests
- Chamar Services
- Retornar views/JSON

---

### 2️⃣ Services (Business Logic Layer)

**Responsabilidade:** Orquestrar lógica de negócio, coordenar Repositories e Actions

```php
public function criarCliente(array $data): Cliente
{
    DB::beginTransaction();
    
    try {
        // Regras de negócio
        $data['cpf_cnpj'] = $this->formatarCpfCnpj($data['cpf_cnpj']);
        
        // Validação de negócio
        if ($this->emailExiste($data['email'])) {
            throw new \Exception('E-mail já cadastrado');
        }
        
        $cliente = $this->clienteRepository->create($data);
        
        DB::commit();
        Log::info('Cliente criado', ['id' => $cliente->id]);
        
        return $cliente;
    } catch (\Exception $e) {
        DB::rollBack();
        throw $e;
    }
}
```

**❌ NÃO deve:**
- Acessar Request diretamente
- Retornar views
- Conter queries complexas (isso é do Repository)

**✅ DEVE:**
- Conter lógica de negócio
- Usar Repositories para acesso a dados
- Orquestrar Actions
- Gerenciar transações
- Fazer logging

---

### 3️⃣ Repositories (Data Access Layer)

**Responsabilidade:** Abstrair o acesso aos Models, encapsular queries

**Interface (Contract):**
```php
interface ClienteRepositoryInterface
{
    public function find(int $id): ?Cliente;
    public function create(array $data): Cliente;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
    public function getAtivos(): Collection;
}
```

**Implementação:**
```php
class ClienteRepository implements ClienteRepositoryInterface
{
    public function __construct(protected Cliente $model) {}
    
    public function find(int $id): ?Cliente
    {
        return $this->model->find($id);
    }
    
    public function getAtivos(): Collection
    {
        return $this->model->where('ativo', true)->get();
    }
}
```

**❌ NÃO deve:**
- Conter lógica de negócio
- Acessar outros Repositories diretamente

**✅ DEVE:**
- Encapsular queries
- Retornar Models ou Collections
- Implementar sua Interface

---

### 4️⃣ Actions (Single Action Classes)

**Responsabilidade:** Executar **uma única ação complexa** com **responsabilidade única**

```php
class ProcessarPedidoAction
{
    public function execute(array $data): Pedido
    {
        DB::beginTransaction();
        
        try {
            $pedido = $this->criarPedido($data);
            $this->criarItensPedido($pedido, $data['produtos']);
            $this->atualizarEstoque($data['produtos']);
            
            DB::commit();
            return $pedido;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
```

**❌ NÃO deve:**
- Ser usada para ações simples (usar Service)
- Acessar Request diretamente

**✅ DEVE:**
- Ter um único método `execute()`
- Ser reutilizável
- Ser facilmente testável
- Ter responsabilidade única

**Quando usar Action vs Service:**
- **Action:** Ação específica, reutilizável, testável isoladamente
- **Service:** Orquestração de múltiplas operações e Actions

---

### 5️⃣ Enums (Type-Safe Constants)

**Responsabilidade:** Definir constantes tipadas

```php
enum PedidoStatus: string
{
    case PENDENTE = 'pendente';
    case PROCESSANDO = 'processando';
    case ENVIADO = 'enviado';
    case ENTREGUE = 'entregue';
    case CANCELADO = 'cancelado';
    
    public function label(): string
    {
        return match($this) {
            self::PENDENTE => 'Pendente',
            self::PROCESSANDO => 'Processando',
            // ...
        };
    }
}
```

**Benefícios:**
- Type safety (PHP 8.1+)
- Autocomplete na IDE
- Evita magic strings
- Métodos auxiliares (label, color, etc)

---

### 6️⃣ DTOs (Data Transfer Objects)

**Responsabilidade:** Transferir dados entre camadas de forma tipada

```php
class ClienteDTO
{
    public function __construct(
        public readonly string $nome,
        public readonly string $email,
        public readonly string $cpfCnpj,
        // ...
    ) {}
    
    public static function fromArray(array $data): self
    {
        return new self(
            nome: $data['nome'],
            email: $data['email'],
            cpfCnpj: $data['cpf_cnpj'],
        );
    }
    
    public function toArray(): array
    {
        return [
            'nome' => $this->nome,
            'email' => $this->email,
            'cpf_cnpj' => $this->cpfCnpj,
        ];
    }
}
```

**Benefícios:**
- Imutabilidade (readonly)
- Type safety
- Validação em tempo de construção
- Facilita testes

---

### 7️⃣ Traits (Reusable Code)

**Responsabilidade:** Compartilhar código entre classes

```php
trait FormatsDocuments
{
    public function formatCpf(string $cpf): string
    {
        $cpf = preg_replace('/\D/', '', $cpf);
        return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $cpf);
    }
}

// Uso
class Cliente extends Model
{
    use FormatsDocuments;
}
```

---

## 🔌 Injeção de Dependência

### Registrando Repositories

**`app/Providers/RepositoryServiceProvider.php`:**
```php
public function register(): void
{
    $this->app->bind(
        ClienteRepositoryInterface::class, 
        ClienteRepository::class
    );
}
```

**`bootstrap/providers.php`:**
```php
return [
    App\Providers\AppServiceProvider::class,
    App\Providers\RepositoryServiceProvider::class,
];
```

### Usando no Controller

```php
class ClienteController extends Controller
{
    public function __construct(
        protected ClienteService $clienteService
    ) {}
}
```

**O Laravel automaticamente resolve:**
- `ClienteService` precisa de `ClienteRepositoryInterface`
- `ClienteRepositoryInterface` está bound para `ClienteRepository`
- `ClienteRepository` precisa de `Cliente` (Model)
- Tudo é injetado automaticamente! ✨

---

## 🧪 Testabilidade

### Testando Services

```php
public function test_criar_cliente()
{
    // Mock do Repository
    $repositoryMock = Mockery::mock(ClienteRepositoryInterface::class);
    $repositoryMock->shouldReceive('create')
        ->once()
        ->andReturn(new Cliente(['id' => 1]));
    
    // Service com mock injetado
    $service = new ClienteService($repositoryMock);
    
    // Testa o service
    $result = $service->criarCliente([...]);
    
    $this->assertInstanceOf(Cliente::class, $result);
}
```

---

## 📊 Benefícios da Arquitetura

✅ **Manutenibilidade** - Código organizado e fácil de manter
✅ **Testabilidade** - Fácil criar testes unitários com mocks
✅ **Escalabilidade** - Fácil adicionar novas features
✅ **Reutilização** - Actions e Traits são reutilizáveis
✅ **Separação de Responsabilidades** - Cada camada tem seu papel
✅ **Type Safety** - Enums e DTOs garantem tipos corretos
✅ **Flexibilidade** - Fácil trocar implementações (Repository Pattern)

---

## 🚀 Como Adicionar Nova Feature

### 1. Criar Model e Migration
```bash
php artisan make:model NomeModel -m
```

### 2. Criar Repository
```php
// Interface
interface NomeRepositoryInterface { ... }

// Implementação
class NomeRepository implements NomeRepositoryInterface { ... }

// Registrar no RepositoryServiceProvider
$this->app->bind(NomeRepositoryInterface::class, NomeRepository::class);
```

### 3. Criar Service
```php
class NomeService
{
    public function __construct(
        protected NomeRepositoryInterface $repository
    ) {}
}
```

### 4. Criar Controller
```php
class NomeController extends Controller
{
    public function __construct(
        protected NomeService $service
    ) {}
}
```

### 5. (Opcional) Criar Actions, DTOs, Enums conforme necessário

---

## 📚 Referências

- [Laravel Documentation](https://laravel.com/docs)
- [Clean Architecture - Robert C. Martin](https://blog.cleancoder.com/uncle-bob/2012/08/13/the-clean-architecture.html)
- [Repository Pattern](https://designpatternsphp.readthedocs.io/en/latest/More/Repository/README.html)
- [Domain-Driven Design](https://martinfowler.com/bliki/DomainDrivenDesign.html)

---

**Arquitetura implementada em:** `feature/architecture-improvement` branch
**Data:** 2025-11-15
