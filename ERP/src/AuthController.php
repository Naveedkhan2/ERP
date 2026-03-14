<?php

require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/helpers.php';

class AuthController
{
    private \PDO $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
    }

    // POST /api/auth/login
    public function login(): void
    {
        $body = json_input();
        $email = trim((string) ($body['email'] ?? ''));
        $password = trim((string) ($body['password'] ?? ''));

        if ($email === '' || $password === '') {
            json_response(['message' => 'Email and password are required.'], 400);
        }

        $stmt = $this->db->prepare(
            'SELECT ua.*, c.`Role` AS role
             FROM user_auth ua
             LEFT JOIN customers c ON ua.customer_id = c.customer_id
             WHERE ua.email = ?
             LIMIT 1'
        );
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        // Support both 'email'/'Email' and 'password'/'Password' (DB column casing)
        $get = static function (array $row, string $key) {
            $lower = strtolower($key);
            foreach ($row as $k => $v) {
                if (strtolower($k) === $lower) return $v;
            }
            return null;
        };

        $dbPassword = $user ? trim((string) ($get($user, 'password') ?? '')) : '';
        if (!$user || $password !== $dbPassword) {
            json_response(['message' => 'Invalid credentials.'], 401);
        }

        $userEmail = trim((string) ($get($user, 'email') ?? ''));
        $userRole = $get($user, 'role') ?? 'user';

        $token = base64_encode($userEmail . '|' . $userRole);

        json_response([
            'token' => $token,
            'user' => [
                'id' => $get($user, 'customer_id') ?: $get($user, 'staff_id'),
                'email' => $userEmail,
                'name' => $get($user, 'name') ?? '',
                'role' => $userRole,
            ],
        ]);
    }
}

