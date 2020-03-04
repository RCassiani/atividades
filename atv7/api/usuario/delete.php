<?php

require_once '../../usuarios.php';
require_once '../core.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE, POST");


$core = new Core();
$core->allowMethods = ['DELETE', 'POST'];
$core->requestMethod = strtoupper($_SERVER['REQUEST_METHOD']);
if ($core->getAllowMethods()) {
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->email)) {
        try {
            $usuario = new Usuario();
            $usuario->email = $data->email;
            $delete = $usuario->delete();

            http_response_code(200);
            echo json_encode(["message" => $delete]);

        } catch (Exception $e) {
            $status = http_response_code();
            if (!$status)
                http_response_code(400);
            echo json_encode(["message" => $e->getMessage()]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["message" => "Não foi possivel excluir o usuário. Dados incompletos"]);
    }
} else {
    http_response_code(405);
    echo json_encode(["message" => "Método não permitido"]);
}
