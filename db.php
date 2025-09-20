<?php
    $db_host = 'localhost';
    $db_name = 'shopping';
    $db_user = 'root';
    $db_pass = '';

    header('Content-Type: application/json');
    date_default_timezone_set("Asia/Bangkok");

    try {
        $db = new PDO("mysql:host=${db_host};dbname=${db_name}", $db_user, $db_pass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e) {
        http_response_code(500);
        echo json_encode(['RespCode'=>500, 'RespMessage'=>$e->getMessage()]);
        exit;
    }
?>