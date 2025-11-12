# 🚀 Git Strategy - Super Gestão

## 📋 Branch Structure

```
main (or master)
├── feature/database-setup
├── feature/authentication
├── feature/admin-layout
├── feature/dashboard
├── feature/clients-crud
├── feature/suppliers-crud
├── feature/products-crud
├── feature/orders-crud
└── feature/users-crud
```

## 🔄 Commands to Execute

### 1. Check current branch and remote
```bash
cd /home/allyson-carvalho/Documentos/projects/super_gestao
git branch
git remote -v
```

### 2. Stage all changes
```bash
git add .
```

### 3. Commit current changes
```bash
git commit -m "Add complete management system"
```

### 4. Switch to main branch
```bash
git checkout main
# or if main doesn't exist:
git checkout -b main
```

### 5. Create and push feature branches

#### Feature 1: Database Setup
```bash
git checkout -b feature/database-setup
git add backend/database/migrations/
git add backend/app/Models/
git commit -m "Add database migrations and models"
git push origin feature/database-setup
```

#### Feature 2: Authentication
```bash
git checkout main
git checkout -b feature/authentication
git add backend/app/Http/Controllers/Auth/
git add backend/resources/views/auth/
git add backend/app/Http/Middleware/CheckAdmin.php
git commit -m "Add authentication system"
git push origin feature/authentication
```

#### Feature 3: Admin Layout
```bash
git checkout main
git checkout -b feature/admin-layout
git add backend/resources/views/layouts/
git commit -m "Add admin layout with sidebar"
git push origin feature/admin-layout
```

#### Feature 4: Dashboard
```bash
git checkout main
git checkout -b feature/dashboard
git add backend/app/Http/Controllers/Admin/DashboardController.php
git add backend/resources/views/admin/dashboard.blade.php
git commit -m "Add dashboard with statistics"
git push origin feature/dashboard
```

#### Feature 5: Clients CRUD
```bash
git checkout main
git checkout -b feature/clients-crud
git add backend/app/Http/Controllers/Admin/ClienteController.php
git add backend/resources/views/admin/clientes/
git commit -m "Add clients CRUD operations"
git push origin feature/clients-crud
```

#### Feature 6: Suppliers CRUD
```bash
git checkout main
git checkout -b feature/suppliers-crud
git add backend/app/Http/Controllers/Admin/FornecedorController.php
git add backend/resources/views/admin/fornecedores/
git commit -m "Add suppliers CRUD operations"
git push origin feature/suppliers-crud
```

#### Feature 7: Products CRUD
```bash
git checkout main
git checkout -b feature/products-crud
git add backend/app/Http/Controllers/Admin/ProdutoController.php
git add backend/resources/views/admin/produtos/
git commit -m "Add products CRUD with stock control"
git push origin feature/products-crud
```

#### Feature 8: Orders CRUD
```bash
git checkout main
git checkout -b feature/orders-crud
git add backend/app/Http/Controllers/Admin/PedidoController.php
git add backend/resources/views/admin/pedidos/
git commit -m "Add orders CRUD with items"
git push origin feature/orders-crud
```

#### Feature 9: Users CRUD
```bash
git checkout main
git checkout -b feature/users-crud
git add backend/app/Http/Controllers/Admin/UserController.php
git add backend/resources/views/admin/users/
git commit -m "Add users CRUD with roles"
git push origin feature/users-crud
```

#### Feature 10: Routes Configuration
```bash
git checkout main
git checkout -b feature/routes-config
git add backend/routes/web.php
git add backend/bootstrap/app.php
git commit -m "Configure routes and middleware"
git push origin feature/routes-config
```

#### Feature 11: Seeder
```bash
git checkout main
git checkout -b feature/database-seeder
git add backend/database/seeders/DatabaseSeeder.php
git commit -m "Add database seeder with test data"
git push origin feature/database-seeder
```

#### Feature 12: Documentation
```bash
git checkout main
git checkout -b feature/documentation
git add README.md
git commit -m "Add project documentation"
git push origin feature/documentation
```

### 6. Merge all features to main
```bash
git checkout main
git merge feature/database-setup
git merge feature/authentication
git merge feature/admin-layout
git merge feature/dashboard
git merge feature/clients-crud
git merge feature/suppliers-crud
git merge feature/products-crud
git merge feature/orders-crud
git merge feature/users-crud
git merge feature/routes-config
git merge feature/database-seeder
git merge feature/documentation
```

### 7. Push main to remote
```bash
git push origin main
```

## 🎯 Quick Commands (All at once)

If you want to do everything automatically, run this script:

```bash
#!/bin/bash

cd /home/allyson-carvalho/Documentos/projects/super_gestao

# Add all files
git add .

# Commit everything
git commit -m "Initial commit - Complete management system"

# Check if main exists, if not create it
git checkout main 2>/dev/null || git checkout -b main

# Push main
git push origin main

# Create and push all feature branches
features=(
  "database-setup:backend/database/migrations/ backend/app/Models/:Add database migrations and models"
  "authentication:backend/app/Http/Controllers/Auth/ backend/resources/views/auth/ backend/app/Http/Middleware/:Add authentication system"
  "admin-layout:backend/resources/views/layouts/:Add admin layout with sidebar"
  "dashboard:backend/app/Http/Controllers/Admin/DashboardController.php backend/resources/views/admin/dashboard.blade.php:Add dashboard with statistics"
  "clients-crud:backend/app/Http/Controllers/Admin/ClienteController.php backend/resources/views/admin/clientes/:Add clients CRUD operations"
  "suppliers-crud:backend/app/Http/Controllers/Admin/FornecedorController.php backend/resources/views/admin/fornecedores/:Add suppliers CRUD operations"
  "products-crud:backend/app/Http/Controllers/Admin/ProdutoController.php backend/resources/views/admin/produtos/:Add products CRUD with stock control"
  "orders-crud:backend/app/Http/Controllers/Admin/PedidoController.php backend/resources/views/admin/pedidos/:Add orders CRUD with items"
  "users-crud:backend/app/Http/Controllers/Admin/UserController.php backend/resources/views/admin/users/:Add users CRUD with roles"
  "routes-config:backend/routes/web.php backend/bootstrap/app.php:Configure routes and middleware"
  "database-seeder:backend/database/seeders/:Add database seeder with test data"
  "documentation:README.md:Add project documentation"
)

for feature in "${features[@]}"; do
  IFS=':' read -r branch files message <<< "$feature"
  git checkout -b "feature/$branch"
  git add $files
  git commit -m "$message"
  git push origin "feature/$branch"
  git checkout main
done

echo "✅ All feature branches created and pushed!"
```

## 📝 Commit Message Guidelines

### Format
```
<type>: <short description>

[optional body]
```

### Types
- `feat`: New feature
- `fix`: Bug fix
- `docs`: Documentation
- `style`: Formatting
- `refactor`: Code refactoring
- `test`: Tests
- `chore`: Maintenance

### Examples
```bash
git commit -m "feat: add user authentication"
git commit -m "feat: add clients CRUD"
git commit -m "fix: correct login validation"
git commit -m "docs: update README"
git commit -m "refactor: optimize database queries"
```

## 🔗 Connect to GitHub

### Create repository on GitHub first, then:

```bash
# Add remote
git remote add origin https://github.com/username/super_gestao.git

# Or if using SSH
git remote add origin git@github.com:username/super_gestao.git

# Push all branches
git push -u origin --all

# Push tags
git push origin --tags
```

## 🌿 Branch Naming Convention

- `main` or `master` - Production-ready code
- `develop` - Development branch (optional)
- `feature/feature-name` - New features
- `bugfix/bug-description` - Bug fixes
- `hotfix/issue-description` - Urgent fixes
- `release/version-number` - Release preparation

## ✅ Best Practices

1. ✅ Keep commits small and focused
2. ✅ Write clear commit messages
3. ✅ One feature per branch
4. ✅ Always test before pushing
5. ✅ Use pull requests for code review
6. ✅ Keep branches up to date with main
7. ✅ Delete branches after merging

---

**Ready to push!** 🚀

