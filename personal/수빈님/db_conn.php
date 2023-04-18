
<?php

// PDO 인스턴스 생성
function db_connect()
{
    $host = "localhost";
    $user = "root";
    $pass = "root506";
    $charset = "utf8mb4";
    $db_name = "morning_project";
    $dsn = "mysql:host=$host;dbname=$db_name;charset=$charset";

    $pdo_options = [
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    try {
        return new PDO($dsn, $user, $pass, $pdo_options);
    } catch (PDOException $e) {
        exit("데이터베이스 연결에 실패하였습니다.");
    }
}

// 데이터베이스 연결
$db = db_connect();
