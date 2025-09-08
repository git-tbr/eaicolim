<?php
require_once "sql.php";
require_once "session.php";

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Origin: *");

$method = $_SERVER['REQUEST_METHOD'];
if ($method == "POST") {
    $data = json_decode(file_get_contents('php://input'), true) ?? $_POST;
    updateData($data);
} else {
    getData();
}

function getData(){
    $consulta = sql([
        "statement" => "SELECT  *
                        FROM    tbr_podcasts.client
                        WHERE   c_id = ?",
        "types" => "i",
        "parameters" => [
            PID
        ],
        "only_first_row"=>"1"
    ]);

    if (!$consulta) {
        die(json_encode([
            "code" => 0,
            "msg" => "Ainda não há patrocinadores para exibir"
        ]));
    }

    echo json_encode($consulta);
}

function updateData($d){
    sql([
        "statement" => "UPDATE  tbr_podcasts.client
                        SET     c_youtube = ?,
                                c_instagram = ?,
                                c_facebook = ?,
                                c_tiktok = ?,
                                c_spotify = ?,
                                c_apple = ?,
                                c_deezer = ?,
                                c_twitter = ?
                        WHERE   c_id = ?",
        "types" => "ssssssssi",
        "parameters" => [
            $d['youtube'],
            $d['instagram'],
            $d['facebook'],
            $d['tiktok'],
            $d['spotify'],
            $d['apple'],
            $d['deezer'],
            $d['twitter'],
            PID
        ]
    ]);
    getData();
}