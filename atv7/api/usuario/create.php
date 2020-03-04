<?php

require_once '../../usuarios.php';
require_once '../core.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");


$core = new Core();
$core->allowMethods = ['POST'];
$core->requestMethod = strtoupper($_SERVER['REQUEST_METHOD']);
if ($core->getAllowMethods()) {

    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->nome) &&
        !empty($data->sobrenome) &&
        !empty($data->email) &&
        !empty($data->telefone)
    ) {

        try {

            $usuario = new Usuario();
            $usuario->nome = $data->nome;
            $usuario->sobrenome = $data->sobrenome;
            $usuario->email = $data->email;
            $usuario->telefone = $data->telefone;
            $create = $usuario->create();

            http_response_code(201);
            echo json_encode(["message" => $create]);

        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(["message" => $e->getMessage()]);
        }

    } else {
        http_response_code(400);
        echo json_encode(["message" => "Não foi possivel inserir o usuário. Dados incompletos"]);
    }
} else {
    http_response_code(405);
    echo json_encode(["message" => "Método não permitido"]);
}
