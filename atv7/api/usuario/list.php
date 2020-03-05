<?php

require_once '../../usuarios.php';
require_once '../core.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");


$core = new Core();
$core->allowMethods = ['GET']; //Metodo permitido
$core->requestMethod = strtoupper($_SERVER['REQUEST_METHOD']); //Metodo recebido

//Verificação do Metodo Permitido
if ($core->getAllowMethods()) {
    try {
        //Cria instancia de usuario
        $usuario = new Usuario();
        $list = $usuario->listAll();

        //Retorna Status - Já preenchido anteriormente?
        $status = http_response_code();
        if (!$status)
            http_response_code(200); //Retorna Status - OK
        echo json_encode(["message" => "Lista de usuários", "data" => $list]);
    } catch (Exception $e) {
        //Retorna Status - Bad Request
        http_response_code(400);
        echo json_encode(["message" => $e->getMessage()]);
    }
} else {
    //Retorna Status - Method Not Allowed
    http_response_code(405);
    echo json_encode(["message" => "Método não permitido"]);
}