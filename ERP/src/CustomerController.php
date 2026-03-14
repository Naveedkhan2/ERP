<?php

require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/TmsDatabase.php';
require_once __DIR__ . '/helpers.php';

class CustomerController
{
    private \PDO $db;
    private \PDO $tmsDb;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->tmsDb = (new TmsDatabase())->getConnection();
    }

    /**
     * Create per-customer payroll table in TMS database when operations is active.
     * Table name pattern: {customer_id}_payroll
     */
    private function ensurePayrollTable(int $customerId): void
    {
        $id = (int)$customerId;
        if ($id <= 0) {
            return;
        }

        $tableName = sprintf('`%d_payroll`', $id);

        $sql = "
            CREATE TABLE IF NOT EXISTS $tableName (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                employee_id INT UNSIGNED NOT NULL,
                employee_name VARCHAR(255) NOT NULL,
                Address VARCHAR(255) DEFAULT NULL,
                NTN_Number VARCHAR(50) DEFAULT NULL,
                Salary DECIMAL(15,2) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ";

        $this->tmsDb->exec($sql);
    }

    // GET /api/customers
    public function index(): void
    {
        $status = $_GET['status'] ?? null;
        $search = $_GET['search'] ?? null;

        $conditions = [];
        $params = [];

        if ($status && $status !== 'all') {
            $conditions[] = 'status = ?';
            $params[] = $status;
        }

        if ($search) {
            $conditions[] = '(name LIKE ? OR cafe_name LIKE ? OR phone_number LIKE ?)';
            $term = '%' . $search . '%';
            $params[] = $term;
            $params[] = $term;
            $params[] = $term;
        }

        $where = $conditions ? 'WHERE ' . implode(' AND ', $conditions) : '';

        $sql = "SELECT
                    customer_id AS id,
                    name,
                    father_name,
                    address,
                    ntn,
                    cnic,
                    email,
                    cafe_name,
                    cafe_location,
                    phone_number,
                    status,
                    date_of_purchase,
                    due_date,
                    `Role` AS role,
                    sales,
                    inventory,
                    operations
                FROM customers
                $where
                ORDER BY created_at DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $rows = $stmt->fetchAll();

        json_response($rows);
    }

    // POST /api/customers
    public function store(): void
    {
        $body = json_input();

        $required = ['name', 'cnic', 'phone_number', 'email', 'password'];
        foreach ($required as $field) {
            if (empty($body[$field])) {
                json_response(['message' => 'Missing required field: ' . $field], 400);
            }
        }

        $sql = 'INSERT INTO customers
            (name, father_name, cnic, address, ntn, phone_number, email, password,
             cafe_name, cafe_location, date_of_purchase, due_date, status, `Role`,
             sales, inventory, operations, created_at)
            VALUES
            (:name, :father_name, :cnic, :address, :ntn, :phone_number, :email, :password,
             :cafe_name, :cafe_location, :date_of_purchase, :due_date, :status, :role,
             :sales, :inventory, :operations, NOW())';

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':name' => $body['name'],
            ':father_name' => $body['father_name'] ?? null,
            ':cnic' => $body['cnic'],
            ':address' => $body['address'] ?? null,
            ':ntn' => $body['ntn'] ?? null,
            ':phone_number' => $body['phone_number'],
            ':email' => $body['email'],
            // Plain-text, to match existing DB – can be upgraded later.
            ':password' => $body['password'],
            ':cafe_name' => $body['cafe_name'] ?? null,
            ':cafe_location' => $body['cafe_location'] ?? null,
            ':date_of_purchase' => $body['date_of_purchase'] ?? null,
            ':due_date' => $body['due_date'] ?? null,
            ':status' => $body['status'] ?? 'active',
            ':role' => $body['role'] ?? 'customer',
            ':sales' => $body['sales'] ?? null,
            ':inventory' => $body['inventory'] ?? null,
            ':operations' => $body['operations'] ?? null,
        ]);

        $id = (int)$this->db->lastInsertId();
        $body['id'] = $id;

        // If operations is enabled for this new customer, ensure payroll table exists in TMS DB.
        $operationsFlag = $body['operations'] ?? null;
        if ($operationsFlag && (int)$operationsFlag === 1) {
            $this->ensurePayrollTable($id);
        }

        json_response($body, 201);
    }

    // PUT /api/customers/{id}
    public function update(int $id): void
    {
        $body = json_input();
        if (!$body) {
            json_response(['message' => 'No data provided'], 400);
        }

        $allowed = [
            'name',
            'father_name',
            'cnic',
            'address',
            'ntn',
            'phone_number',
            'email',
            'password',
            'cafe_name',
            'cafe_location',
            'date_of_purchase',
            'due_date',
            'status',
            'role',
            'sales',
            'inventory',
            'operations',
        ];

        $fields = [];
        $params = [];

        foreach ($allowed as $key) {
            if (array_key_exists($key, $body)) {
                $column = $key === 'role' ? '`Role`' : $key;
                $fields[] = "$column = :$key";
                $params[":$key"] = $body[$key];
            }
        }

        if (!$fields) {
            json_response(['message' => 'Nothing to update'], 400);
        }

        $params[':id'] = $id;

        $sql = 'UPDATE customers SET ' . implode(', ', $fields) . ' WHERE customer_id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        if ($stmt->rowCount() === 0) {
            json_response(['message' => 'Customer not found'], 404);
        }

        // If operations field is being set to active (1), ensure payroll table exists.
        if (array_key_exists('operations', $body) && (int)$body['operations'] === 1) {
            $this->ensurePayrollTable($id);
        }

        json_response(['message' => 'Customer updated successfully']);
    }

    // DELETE /api/customers/{id}
    public function destroy(int $id): void
    {
        $stmt = $this->db->prepare('DELETE FROM customers WHERE customer_id = ?');
        $stmt->execute([$id]);

        if ($stmt->rowCount() === 0) {
            json_response(['message' => 'Customer not found'], 404);
        }

        http_response_code(204);
        exit;
    }
}

