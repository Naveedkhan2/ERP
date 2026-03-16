# Epsilon ERP

![React](https://img.shields.io/badge/React-Frontend-61DAFB?logo=react)
![PHP](https://img.shields.io/badge/PHP-Backend-777BB4?logo=php)
![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?logo=mysql)
![Apache](https://img.shields.io/badge/Apache-Web_Server-D22128?logo=apache)

A web-based ERP system for managing **customers, orders, payroll, inventory, and recipes** from a centralized dashboard.

---

## Overview

Epsilon ERP is a full-stack **Enterprise Resource Planning (ERP)** system designed to manage business operations efficiently.  
The system provides role-based access, secure authentication, and a centralized dashboard for business management.

Frontend is built using **React**, while the backend uses **PHP and MySQL**, deployed on **Apache**.

---

## Features

### Admin Features

- Business performance dashboard (KPIs)
- Manage customers and client accounts
- Create, update and delete orders
- Payroll management (employees, salaries, slips)
- Inventory management with stock tracking
- Recipe / menu management
- ERP user and role management

### User Features

- Secure login to ERP portal
- View assigned customers and orders
- Track order status and history
- View personal payroll information
- Access inventory based on role
- View recipe book
- Personal dashboard with quick statistics

### Authentication

- Email and password login
- PHP session-based authentication
- Protected API routes
- Role-based access control (RBAC)

---

## Tech Stack

**Frontend**

- React (Vite)
- HTML5
- CSS3
- JavaScript

**Backend**

- PHP (Vanilla)
- Apache Server
- MySQL (PDO)

**Styling**

- Custom CSS
- Blue and white dashboard theme

---

## Installation

### 1. Clone Repository

```bash
git clone https://github.com/Naveedkhan2/ERP.git
cd ERP
```

### 2. Configure Database

Edit file:

```
erp/config.php
```

Add your database credentials:

```
$DB_HOST = '127.0.0.1';
$DB_NAME = 'epsilon_erp';
$DB_USER = 'root';
$DB_PASS = '';
```

### 3. Run Locally

```bash
cd erp
php -S localhost:8000
```

Open in browser:

```
http://localhost:8000
```

API Base URL:

```
http://localhost:8000/api/
```

---

## Deployment (Apache / Hostinger)

Upload the **erp** folder to:

```
public_html/erp
```

Make sure these files exist:

```
erp/.htaccess
erp/api/.htaccess
```

Access ERP at:

```
https://your-domain.com/erp/
```

---

## Default Credentials

⚠ Change before production.

**Admin**

```
Email: superadmin@erp.com
Password: admin
```

**User**

```
Email: naveed@erp.com
Password: 1234567890
```

---

## Project Structure

```
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
```

---

## API Endpoints

### Authentication

```
POST /api/auth/login
POST /api/auth/logout
GET  /api/auth/me
```

### Customers

```
GET    /api/customers
GET    /api/customers/:id
POST   /api/customers
PUT    /api/customers/:id
DELETE /api/customers/:id
```

### Orders

```
GET    /api/orders
POST   /api/orders
PUT    /api/orders/:id
DELETE /api/orders/:id
```

### Payroll

```
GET    /api/payroll
POST   /api/payroll
PUT    /api/payroll/:id
```

### Inventory

```
GET    /api/inventory
POST   /api/inventory
PUT    /api/inventory/:id
DELETE /api/inventory/:id
```

### Recipes

```
GET    /api/recipes
POST   /api/recipes
PUT    /api/recipes/:id
DELETE /api/recipes/:id
```

---

## Screenshots

![Login](screenshots/login.png)

![Admin Dashboard](screenshots/admin-dashboard.png)

![Inventory](screenshots/inventory.png)

![Payroll](screenshots/payroll.png)

---

## UI Theme

Primary Blue: `#2563eb`  
Dark Blue: `#1e40af`  
Background: `#f5f7fa`

Clean, card-based layout focused on dashboards and readability.
