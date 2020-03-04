<?php

require_once '../../usuarios.php';
require_once '../core.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");


$core = new Core();
$core->allowMethods = ['GET'];
$core->requestMethod = strtoupper($_SERVER['REQUEST_METHOD']);
if ($core->getAllowMethods()) {
    try {
        $usuario = new Usuario();
        $list = $usuario->listAll();
        $status = http_response_code();
        if (!$status)
            http_response_code(200);
        echo json_encode(["message" => "Lista de usuários", "data" => $list]);
    } catch (Exception $e) {
        http_response_code(400);
        echo json_encode(["message" => $e->getMessage()]);
    }
} else {
    http_response_code(405);
    echo json_encode(["message" => "Método não permitido"]);
}