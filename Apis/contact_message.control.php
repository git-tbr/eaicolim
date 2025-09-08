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
    if ($data['id'] == 0) {
        insertData($data);
    } else {
        updateData($data);
    }
} else {
    getData();
}

function getData()
{
    $consulta = sql([
        "statement" => "SELECT  *
                        FROM    tbr_podcasts.contact_msg
                        WHERE   cm_client = ?
                        ORDER BY cm_date DESC",
        "types" => "i",
        "parameters" => [
            PID
        ]
    ]);

    if (!$consulta) {
        die(json_encode([
            "code" => 0,
            "msg" => "Ainda não há mensagens para exibir"
        ]));
    }

    echo json_encode($consulta);
}

function insertData($d)
{
    sql([
        "statement" => "INSERT INTO tbr_podcasts.contact_msg
                            SET     cm_client = ?,
                                    cm_name = ?,
                                    cm_email = ?,
                                    cm_subject = ?,
                                    cm_body = ?,
                                    cm_read = ?,
                                    cm_date = NOW()",
        "types" => "isssss",
        "parameters" => [
            PID,
            $d['name'],
            $d['email'],
            $d['subject'],
            $d['body'],
            'n'
        ]
    ]);

    if (!$GLOBALS['sql']->insert_id > 0) {
        echo json_encode([
            "code" => 0,
            "msg" => "Erro ao enviar a mensagem. Por favor, tente novamente mais tarde"
        ]);
    }

    echo json_encode([
        "code" => 1,
        "msg" => "Mensagem enviada com sucesso"
    ]);
}

function updateData($d)
{
    sql([
        "statement" => "UPDATE  tbr_podcasts.contact_msg
                        SET     cm_read = ?
                        WHERE   cm_id = ?",
        "types" => "si",
        "parameters" => [
            $d['read'],
            $d['id']
        ]
    ]);
    getData();
}