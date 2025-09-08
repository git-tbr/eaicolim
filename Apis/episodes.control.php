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
    if($data['id'] == 0){
        insertData($data);
    }else{
        updateData($data);
    }
} else {
    if(isset($_GET['id'])){
        getDataById($_GET['id']);
    }else{
        getData();
    }    
}

function getDataById($id){
    $consulta = sql([
        "statement" => "SELECT  *
                        FROM    tbr_podcasts.episodes
                        WHERE   e_client = ? 
                        AND     e_id = ?",
        "types" => "ii",
        "parameters" => [
            PID,
            $id
        ],
        "only_first_row"=>"1"
    ]);

    if (!$consulta) {
        die(json_encode([
            "code" => 0,
            "msg" => "Ainda não há episódio para exibir"
        ]));
    }

    echo json_encode($consulta);
}

function getData(){
    $consulta = sql([
        "statement" => "SELECT  *
                        FROM    tbr_podcasts.episodes
                        WHERE   e_client = ?",
        "types" => "i",
        "parameters" => [
            PID
        ]
    ]);

    if (!$consulta) {
        die(json_encode([
            "code" => 0,
            "msg" => "Ainda não há episódio para exibir"
        ]));
    }

    echo json_encode($consulta);
}

function insertData($d){
    sql([
        "statement" => "INSERT INTO tbr_podcasts.episodes
                    SET     e_client = ?,
                            e_order = ?,
                            e_title = ?,
                            e_description = ?,
                            e_youtube = ?,
                            e_spotify = ?,
                            e_apple = ?,
                            e_deezer = ?,
                            e_cover = ?",
        "types" => "iisssssss",
        "parameters" => [
            PID,
            $d['order'],
            $d['title'],
            $d['description'],
            $d['youtube'],
            $d['spotify'],
            $d['apple'],
            $d['deezer'],
            $d['cover']
        ]
    ]);
    getData();
}

function updateData($d){
    sql([
        "statement" => "UPDATE tbr_podcasts.episodes
                    SET     e_order = ?,
                            e_title = ?,
                            e_description = ?,
                            e_youtube = ?,
                            e_spotify = ?,
                            e_apple = ?,
                            e_deezer = ?,
                            e_cover = ?,
                            e_active = ?
                    WHERE   e_client = ?
                    AND     e_id = ?",
        "types" => "issssssssii",
        "parameters" => [
            $d['order'],
            $d['title'],
            $d['description'],
            $d['youtube'],
            $d['spotify'],
            $d['apple'],
            $d['deezer'],
            $d['cover'],
            $d['active'],
            PID,
            $d['id']
        ]
    ]);
    getData();
}