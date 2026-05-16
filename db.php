<?php

$host = getenv("DB_HOST") ?: "db";
$dbname = getenv("DB_NAME") ?: "my_site";
$username = getenv("DB_USER") ?: "root";
$password = getenv("DB_PASSWORD");

if ($password === false || $password === "") {
    echo "DB 연결 실패 : DB_PASSWORD 환경변수가 설정되지 않았습니다.";
    exit;
}

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );

    // 에러 확인 설정
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {

    echo "DB 연결 실패 : " . $e->getMessage();
}
?>
