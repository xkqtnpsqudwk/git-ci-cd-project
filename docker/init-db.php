<?php

$host = getenv("DB_HOST") ?: "db";
$dbname = getenv("DB_NAME") ?: "my_site";
$username = getenv("DB_USER") ?: "root";
$password = getenv("DB_PASSWORD");

if ($password === false || $password === "") {
    fwrite(STDERR, "DB_PASSWORD is required" . PHP_EOL);
    exit(1);
}

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (in_array("--migrate", $argv, true)) {
        $pdo->exec(
            "CREATE TABLE IF NOT EXISTS member (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id VARCHAR(50) NOT NULL UNIQUE,
                user_pw VARCHAR(255) NOT NULL,
                user_name VARCHAR(100) NOT NULL,
                user_email VARCHAR(255) NOT NULL,
                user_reg_datetime DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
            ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci"
        );
    }

    exit(0);
} catch (Throwable $e) {
    fwrite(STDERR, $e->getMessage() . PHP_EOL);
    exit(1);
}
