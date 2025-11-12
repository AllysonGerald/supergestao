#!/bin/bash

# Colors for output
GREEN='\033[0;32m'
BLUE='\033[0;34m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

echo -e "${BLUE}🚀 Super Gestão - GitHub Push Script${NC}\n"

# Navigate to project directory
cd /home/allyson-carvalho/Documentos/projects/super_gestao

# Get current branch
CURRENT_BRANCH=$(git branch --show-current)
echo -e "${YELLOW}📍 Current branch: $CURRENT_BRANCH${NC}\n"

# Step 1: Commit all current changes
echo -e "${BLUE}Step 1: Committing current changes...${NC}"
git add .
git commit -m "feat: add complete management system

- Authentication (login, register, logout)
- Dashboard with statistics
- Clients CRUD
- Suppliers CRUD
- Products CRUD with stock control
- Orders CRUD with multiple items
- Users CRUD with role management
- Admin layout with sidebar
- Database migrations and seeders
- Middleware for authentication and admin access"

echo -e "${GREEN}✅ Current changes committed${NC}\n"

# Step 2: Switch to main branch
echo -e "${BLUE}Step 2: Switching to main branch...${NC}"
git checkout main 2>/dev/null || git checkout -b main
echo -e "${GREEN}✅ On main branch${NC}\n"

# Step 3: Ask for GitHub repository URL
echo -e "${YELLOW}⚠️  Before continuing, create a repository on GitHub${NC}"
echo -e "${YELLOW}Then enter the repository URL:${NC}"
read -p "GitHub URL (https://github.com/username/repo.git): " GITHUB_URL

if [ -z "$GITHUB_URL" ]; then
    echo -e "${YELLOW}⚠️  No URL provided. Skipping remote setup.${NC}"
else
    # Check if remote already exists
    if git remote get-url origin > /dev/null 2>&1; then
        echo -e "${YELLOW}Remote 'origin' already exists. Updating...${NC}"
        git remote set-url origin "$GITHUB_URL"
    else
        echo -e "${BLUE}Adding remote origin...${NC}"
        git remote add origin "$GITHUB_URL"
    fi
    echo -e "${GREEN}✅ Remote configured${NC}\n"
fi

# Step 4: Create feature branches
echo -e "${BLUE}Step 3: Creating feature branches...${NC}\n"

# Database Setup
echo -e "${BLUE}📦 Creating feature/database-setup...${NC}"
git checkout -b feature/database-setup
git add backend/database/migrations/2024_01_*.php
git add backend/app/Models/Cliente.php
git add backend/app/Models/Fornecedor.php
git add backend/app/Models/Produto.php
git add backend/app/Models/Pedido.php
git add backend/app/Models/PedidoItem.php
git commit -m "feat: add database migrations and models

- Create users, clients, suppliers, products, orders tables
- Add Eloquent models with relationships
- Include data validation and formatting methods"
if [ ! -z "$GITHUB_URL" ]; then
    git push -u origin feature/database-setup
fi
git checkout main

# Authentication
echo -e "${BLUE}🔐 Creating feature/authentication...${NC}"
git checkout -b feature/authentication
git add backend/app/Http/Controllers/Auth/
git add backend/resources/views/auth/
git add backend/app/Http/Middleware/CheckAdmin.php
git add backend/app/Models/User.php
git commit -m "feat: add authentication system

- Login and register pages
- Logout functionality
- Admin middleware for protected routes
- User model with role management"
if [ ! -z "$GITHUB_URL" ]; then
    git push -u origin feature/authentication
fi
git checkout main

# Admin Layout
echo -e "${BLUE}🎨 Creating feature/admin-layout...${NC}"
git checkout -b feature/admin-layout
git add backend/resources/views/layouts/admin.blade.php
git commit -m "feat: add admin layout with sidebar

- Responsive sidebar navigation
- Header with user menu
- Modern design with Tailwind CSS
- Mobile-friendly layout"
if [ ! -z "$GITHUB_URL" ]; then
    git push -u origin feature/admin-layout
fi
git checkout main

# Dashboard
echo -e "${BLUE}📊 Creating feature/dashboard...${NC}"
git checkout -b feature/dashboard
git add backend/app/Http/Controllers/Admin/DashboardController.php
git add backend/resources/views/admin/dashboard.blade.php
git commit -m "feat: add dashboard with statistics

- Statistics cards (clients, products, orders, revenue)
- Recent orders list
- Top selling products
- Orders by status chart
- Low stock alerts"
if [ ! -z "$GITHUB_URL" ]; then
    git push -u origin feature/dashboard
fi
git checkout main

# Clients CRUD
echo -e "${BLUE}👥 Creating feature/clients-crud...${NC}"
git checkout -b feature/clients-crud
git add backend/app/Http/Controllers/Admin/ClienteController.php
git add backend/resources/views/admin/clientes/
git commit -m "feat: add clients CRUD operations

- List, create, edit, delete clients
- Support for individual and corporate clients
- Complete address management
- Order history per client
- Search and filters"
if [ ! -z "$GITHUB_URL" ]; then
    git push -u origin feature/clients-crud
fi
git checkout main

# Suppliers CRUD
echo -e "${BLUE}🚚 Creating feature/suppliers-crud...${NC}"
git checkout -b feature/suppliers-crud
git add backend/app/Http/Controllers/Admin/FornecedorController.php
git add backend/resources/views/admin/fornecedores/
git commit -m "feat: add suppliers CRUD operations

- List, create, edit, delete suppliers
- Complete contact information
- Linked products list
- Active/inactive status"
if [ ! -z "$GITHUB_URL" ]; then
    git push -u origin feature/suppliers-crud
fi
git checkout main

# Products CRUD
echo -e "${BLUE}📦 Creating feature/products-crud...${NC}"
git checkout -b feature/products-crud
git add backend/app/Http/Controllers/Admin/ProdutoController.php
git add backend/resources/views/admin/produtos/
git commit -m "feat: add products CRUD with stock control

- List, create, edit, delete products
- Image upload functionality
- Stock management (minimum and current)
- Cost and selling price
- Automatic profit margin calculation
- Low stock alerts
- Category management"
if [ ! -z "$GITHUB_URL" ]; then
    git push -u origin feature/products-crud
fi
git checkout main

# Orders CRUD
echo -e "${BLUE}🛒 Creating feature/orders-crud...${NC}"
git checkout -b feature/orders-crud
git add backend/app/Http/Controllers/Admin/PedidoController.php
git add backend/resources/views/admin/pedidos/
git commit -m "feat: add orders CRUD with items

- List, create, edit, delete orders
- Multiple items per order
- Automatic calculations
- Status management (pending, processing, shipped, delivered, cancelled)
- Discount support
- Automatic stock update
- Order history"
if [ ! -z "$GITHUB_URL" ]; then
    git push -u origin feature/orders-crud
fi
git checkout main

# Users CRUD
echo -e "${BLUE}👨‍💼 Creating feature/users-crud...${NC}"
git checkout -b feature/users-crud
git add backend/app/Http/Controllers/Admin/UserController.php
git add backend/resources/views/admin/users/
git commit -m "feat: add users CRUD with roles

- List, create, edit, delete users
- Role management (admin, manager, user)
- Active/inactive status
- Password management
- Admin-only access"
if [ ! -z "$GITHUB_URL" ]; then
    git push -u origin feature/users-crud
fi
git checkout main

# Routes and Configuration
echo -e "${BLUE}🔧 Creating feature/routes-config...${NC}"
git checkout -b feature/routes-config
git add backend/routes/web.php
git add backend/bootstrap/app.php
git commit -m "feat: configure routes and middleware

- Admin routes with authentication
- Public site routes
- Authentication routes
- Middleware configuration"
if [ ! -z "$GITHUB_URL" ]; then
    git push -u origin feature/routes-config
fi
git checkout main

# Database Seeder
echo -e "${BLUE}🌱 Creating feature/database-seeder...${NC}"
git checkout -b feature/database-seeder
git add backend/database/seeders/DatabaseSeeder.php
git commit -m "feat: add database seeder with test data

- 3 users (admin, manager, user)
- 2 clients (individual and corporate)
- 1 supplier
- 3 products with stock"
if [ ! -z "$GITHUB_URL" ]; then
    git push -u origin feature/database-seeder
fi
git checkout main

# Documentation
echo -e "${BLUE}📝 Creating feature/documentation...${NC}"
git checkout -b feature/documentation
git add README.md
git add GIT_STRATEGY.md
git commit -m "docs: add project documentation

- Complete README with features
- Installation guide
- Usage instructions
- Git strategy guide"
if [ ! -z "$GITHUB_URL" ]; then
    git push -u origin feature/documentation
fi
git checkout main

# Step 5: Merge all features to main
echo -e "\n${BLUE}Step 4: Merging all features to main...${NC}"
git merge feature/database-setup --no-edit
git merge feature/authentication --no-edit
git merge feature/admin-layout --no-edit
git merge feature/dashboard --no-edit
git merge feature/clients-crud --no-edit
git merge feature/suppliers-crud --no-edit
git merge feature/products-crud --no-edit
git merge feature/orders-crud --no-edit
git merge feature/users-crud --no-edit
git merge feature/routes-config --no-edit
git merge feature/database-seeder --no-edit
git merge feature/documentation --no-edit
echo -e "${GREEN}✅ All features merged${NC}\n"

# Step 6: Push main to remote
if [ ! -z "$GITHUB_URL" ]; then
    echo -e "${BLUE}Step 5: Pushing main branch...${NC}"
    git push -u origin main
    echo -e "${GREEN}✅ Main branch pushed${NC}\n"
fi

# Final summary
echo -e "\n${GREEN}🎉 All done!${NC}"
echo -e "\n${BLUE}📋 Summary:${NC}"
echo -e "✅ 12 feature branches created"
echo -e "✅ All features merged to main"
if [ ! -z "$GITHUB_URL" ]; then
    echo -e "✅ Pushed to GitHub: $GITHUB_URL"
fi
echo -e "\n${YELLOW}🌿 Branches created:${NC}"
echo -e "  • feature/database-setup"
echo -e "  • feature/authentication"
echo -e "  • feature/admin-layout"
echo -e "  • feature/dashboard"
echo -e "  • feature/clients-crud"
echo -e "  • feature/suppliers-crud"
echo -e "  • feature/products-crud"
echo -e "  • feature/orders-crud"
echo -e "  • feature/users-crud"
echo -e "  • feature/routes-config"
echo -e "  • feature/database-seeder"
echo -e "  • feature/documentation"

echo -e "\n${BLUE}🔗 Next steps:${NC}"
if [ -z "$GITHUB_URL" ]; then
    echo -e "  1. Create a repository on GitHub"
    echo -e "  2. Run: git remote add origin <your-repo-url>"
    echo -e "  3. Run: git push -u origin --all"
else
    echo -e "  1. Go to: $GITHUB_URL"
    echo -e "  2. Create pull requests to review and merge features"
    echo -e "  3. Set up branch protection rules"
fi

echo -e "\n${GREEN}🚀 Your project is ready on GitHub!${NC}\n"

