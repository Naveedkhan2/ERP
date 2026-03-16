Epsilon ERP – Web-Based ERP System

Epsilon ERP is a full-stack enterprise resource planning system used to manage customers, orders, payroll, inventory, and menu recipes from a centralized dashboard.

The frontend is built with React, while the backend uses PHP and MySQL. The application is deployed on Apache under /erp.

Features
Admin

Dashboard with business statistics

Manage customers and orders

Payroll management

Inventory management with stock tracking

Menu recipe management

User and role management

Users

Secure login to ERP portal

View assigned customers and orders

Track order status

View personal payroll information

Access inventory based on role

View recipe book

Tech Stack

Frontend

React (Vite)

HTML5

CSS3

JavaScript

Backend

PHP

Apache

MySQL (PDO)

API

REST-style JSON API under /erp/api

Installation
Clone Repository
git clone https://github.com/<your-username>/<repo>.git
cd <repo>
Create Database

Create a MySQL database:

epsilon_erp

Import the provided SQL schema.

Configure Database

Edit:

erp/config.php
$DB_HOST = '127.0.0.1';
$DB_NAME = 'epsilon_erp';
$DB_USER = 'root';
$DB_PASS = '';
Run Locally
cd erp
php -S localhost:8000

Open:

http://localhost:8000

API Base:

http://localhost:8000/api/
Deployment (Apache / Hostinger)

Upload the erp folder to:

public_html/erp

Make sure .htaccess files exist for:

erp/.htaccess
erp/api/.htaccess

Live URL:

https://your-domain.com/erp/
Project Structure
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
API Endpoints

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

Inventory

GET    /api/inventory
POST   /api/inventory
PUT    /api/inventory/:id
DELETE /api/inventory/:id

Payroll

GET    /api/payroll
POST   /api/payroll
PUT    /api/payroll/:id

Recipes

GET    /api/recipes
POST   /api/recipes
PUT    /api/recipes/:id
DELETE /api/recipes/:id
Screenshots
screenshots/admin-dashboard.png
screenshots/user-dashboard.png
screenshots/login.png
screenshots/payroll.png
screenshots/inventory.png
screenshots/recipes.png

Example:

![Dashboard](screenshots/admin-dashboard.png)
Default Credentials

Change before production.

Admin

Email: admin@epsilon-erp.com
Password: admin123
