<?php
require_once "sql.php";
require_once "session.php";

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Origin: *");

$method = $_SERVER['REQUEST_METHOD'];
if ($method == "POST") {
    $data = json_decode(file_get_contents('php://input'), true) ?? $_POST;
    if ($data['id'] == 0) {
        insertData($data);
    } else if (isset($data['control']) && $data['control'] == "delete") {
        deleteData($data);
    } else {
        updateData($data);
    }
} else {
    getData();
}

function getData()
{
    $consulta = sql([
        "statement" => "SELECT      *
                        FROM        tbr_podcasts.sponsors
                        WHERE       s_client = ?",
        "types" => "i",
        "parameters" => [
            PID
        ]
    ]);

    if (!$consulta) {
        die(json_encode([
            "code" => 0,
            "msg" => "Ainda não há patrocinadores para exibir"
        ]));
    }

    echo json_encode($consulta);
}

function deleteData($d)
{
    sql([
        "statement" => "DELETE FROM     tbr_podcasts.sponsors
                        WHERE           s_client = ?
                        AND             s_id = ?",
        "types" => "ii",
        "parameters" => [
            PID,
            $d['id']
        ]
    ]);
    getData();
}

function insertData($d)
{
    sql([
        "statement" => "INSERT INTO     tbr_podcasts.sponsors
                                SET     s_client = ?,
                                        s_name = ?,                                        
                                        s_image_url = ?,
                                        s_url = ?,
                                        s_active = ?",
        "types" => "issss",
        "parameters" => [
            PID,
            $d['name'],
            $d['image'],
            $d['siteUrl'],
            $d['active']
        ]
    ]);
    getData();
}

function updateData($d)
{
    sql([
        "statement" => "UPDATE  tbr_podcasts.sponsors
                        SET     s_name = ?,
                                s_image_url = ?,                                
                                s_url = ?,
                                s_active = ?
                        WHERE   s_client = ?
                        AND     s_id = ?",
        "types" => "ssssii",
        "parameters" => [
            $d['name'],
            $d['image'],
            $d['siteUrl'],
            $d['active'],
            PID,
            $d['id']
        ]
    ]);
    getData();
}
