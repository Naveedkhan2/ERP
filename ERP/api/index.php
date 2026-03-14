<?php

// Front controller for PHP backend.

require_once __DIR__ . '/../src/helpers.php';
require_once __DIR__ . '/../src/Database.php';
require_once __DIR__ . '/../src/AuthController.php';
require_once __DIR__ . '/../src/CustomerController.php';

$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/';
// When ERP is in subfolder /erp (e.g. yourdomain.com/erp/api/...), strip prefix for route matching
if (strpos($uri, '/erp') === 0) {
    $uri = substr($uri, 4) ?: '/';
}

// Handle CORS preflight
if ($method === 'OPTIONS') {
    $origin = $_SERVER['HTTP_ORIGIN'] ?? '';
    if ($origin !== '') {
        header('Access-Control-Allow-Origin: ' . $origin);
        header('Vary: Origin');
    }
    header('Access-Control-Allow-Headers: Content-Type, Authorization');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    exit;
}

/*
|--------------------------------------------------------------------------
| ROUTES
|--------------------------------------------------------------------------
*/

// GET /api/health - check if database is connected (no auth required)
if ($uri === '/api/health' && $method === 'GET') {
    try {
        $db = (new Database())->getConnection();
        $db->query('SELECT 1');
        json_response(['ok' => true, 'database' => 'connected']);
    } catch (\Throwable $e) {
        json_response(['ok' => false, 'database' => 'error', 'message' => $e->getMessage()], 500);
    }
    return;
}

// POST /api/auth/login
if ($uri === '/api/auth/login' && $method === 'POST') {
    (new AuthController())->login();
    return;
}

// /api/customers
if ($uri === '/api/customers') {
    $controller = new CustomerController();

    if ($method === 'GET') {
        $controller->index();
        return;
    }

    if ($method === 'POST') {
        $controller->store();
        return;
    }
}

// /api/customers/{id}
if (preg_match('#^/api/customers/(\d+)$#', $uri, $matches)) {
    $id = (int)$matches[1];
    $controller = new CustomerController();

    if ($method === 'PUT') {
        $controller->update($id);
        return;
    }

    if ($method === 'DELETE') {
        $controller->destroy($id);
        return;
    }
}

// If no route matched
not_found();