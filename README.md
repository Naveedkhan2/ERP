# Epsilon ERP

![React](https://img.shields.io/badge/React-Frontend-61DAFB?logo=react)
![PHP](https://img.shields.io/badge/PHP-Backend-777BB4?logo=php)
![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?logo=mysql)
![Apache](https://img.shields.io/badge/Apache-Web_Server-D22128?logo=apache)

A web-based ERP system for managing customers, orders, payroll, inventory, and recipes.

# Epsilon ERP – Complete Web‑Based ERP System
Epsilon ERP is a full-stack Enterprise Resource Planning (ERP) web application designed to manage business operations such as customers, orders, payroll, inventory, and recipe/menu management from a centralized dashboard.
---
## Features
### Admin Features
- Performance dashboard (overall KPIs)
- Manage customers and client accounts
- Create, edit and delete orders
- Payroll management (employees, salaries, slips)
- Inventory management (items, stock levels, alerts)
- Menu recipe book management (recipes, ingredients, costing)
- Manage ERP users and roles
  
### User Features
- Secure login to ERP portal
- View own customers / assigned orders (role-based)
- View personal payroll information (for employee role)
- View inventory and interact according to role (store/warehouse)
- View menu recipes (production/kitchen role)
- Track order status and history
- Personal dashboard with quick stats
  
### Authentication
- Email/password-based login
- PHP session-based authentication
- Protected API endpoints and frontend routes
- Role-based access control (Admin, Accounts/Payroll, Inventory, Production, etc.)
---
## Tech Stack
- Backend: PHP (vanilla), Apache, MySQL (PDO)
- Frontend: React (Vite build), HTML5, CSS3, JavaScript
- Styling: Custom CSS with blue and white dashboard theme
---
## Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/Naveedkhan2/ERP.git
   cd <ERP>

## Configure database connection:
erp/config.php
$DB_HOST = '127.0.0.1';
$DB_NAME = 'epsilon_erp';
$DB_USER = 'root';
$DB_PASS = '';

## Run Locally
cd erp
php -S localhost:8000

## open
ERP portal: http://localhost:8000

## API Base

API base: http://localhost:8000/api/...

## Deployment (Apache / Hostinger)

Upload the erp folder to:
public_html/erp

## Make sure .htaccess files exist for:
erp/.htaccess
erp/api/.htaccess

## Default Credentials
Admin

Email: superadmin@erp.com  
Password: admin  

User

Email: naveed@erp.com  
Password: 1234567890

### Project Structure
epsilon-erp/
│
├── erp/
│   ├── index.html
│   ├── config.php
│
│   ├── src/
│   │   ├── Database.php
│   │   ├── AuthController.php
│   │   ├── CustomerController.php
│   │   ├── PayrollController.php
│   │   ├── InventoryController.php
│   │   ├── RecipeController.php
│   │   └── helpers.php
│
│   ├── api/
│   │   ├── index.php
│   │   └── .htaccess
│
│   ├── assets/
│   ├── screenshots/
│   └── .htaccess


# API Endpoints 

Authentication
POST /api/auth/login
POST /api/auth/logout
GET  /api/auth/me

Customers
GET    /api/customers
GET    /api/customers/:id
POST   /api/customers
PUT    /api/customers/:id
DELETE /api/customers/:id

Orders
GET    /api/orders
POST   /api/orders
PUT    /api/orders/:id
DELETE /api/orders/:id

Payroll
GET    /api/payroll
POST   /api/payroll
PUT    /api/payroll/:id

Inventory
GET    /api/inventory
POST   /api/inventory
PUT    /api/inventory/:id
DELETE /api/inventory/:id

Recipes
GET    /api/recipes
POST   /api/recipes
PUT    /api/recipes/:id
DELETE /api/recipes/:id


Screenshots
Store all images in a screenshots/ folder and reference them here:

![Login Screen](screenshots/login.png)
![Admin Dashboard](screenshots/admin-dashboard.png)
![User Dashboard](screenshots/user-dashboard.png)
![Payroll Screen](screenshots/payroll.png)
![Inventory Screen](screenshots/inventory.png)
![Recipe Book Screen](screenshots/recipes.png)
Theme
Primary Blue: #2563eb
Dark Blue: #1e40af
Background: white / #f5f7fa
Clean, card-based layout focused on dashboards and readability.
