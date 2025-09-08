<?php
require_once "sql.php";
require_once "session.php";

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Origin: *");

$data = json_decode(file_get_contents('php://input'), true);

$consulta = sql([
    "statement" => "SELECT    *
                    FROM    tbr_podcasts.user
                    WHERE   u_email = ?",
    "types" => "s",
    "parameters" => [
        $data['email']
    ],
    "only_first_row" => "1"
]);

if (!password_verify($data['password'], $consulta['u_password'])) {
    http_response_code(401);
    exit(json_encode([
        "code" => 0,
        "data" => null
    ]));
}

echo json_encode([
    "code" => 1,
    "data" => $consulta
]);
