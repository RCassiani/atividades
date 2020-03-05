<?php

require_once '../../usuarios.php';
require_once '../core.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT, POST, PATCH");


$core = new Core();
$core->allowMethods = ['POST', 'PUT', 'PATCH']; //Metodos permitidos
$core->requestMethod = strtoupper($_SERVER['REQUEST_METHOD']); //Metodo recebido

//Verificação do Metodo Permitido
if ($core->getAllowMethods()) {
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->nome) &&
        !empty($data->sobrenome) &&
        !empty($data->email) &&
        !empty($data->telefone)
    ) {
        try {
            //Cria instancia de usuario e preenhche todas as variáveis
            $usuario = new Usuario();

            if(!$usuario->checkEmailData($data->email)) throw new Exception("Dado: email inválido") ;
            if(!$usuario->checkPhoneData($data->telefone)) throw new Exception("Dado: telefone inválido");

            $usuario->nome = $data->nome;
            $usuario->sobrenome = $data->sobrenome;
            $usuario->email = $data->email;
            $usuario->telefone = $data->telefone;
            $update = $usuario->update();

            //Retorna Status - OK
            http_response_code(200);
            echo json_encode(["message" => $update]);

        } catch (Exception $e) {
            //Retorna Status - Já preenchido anteriormente?
            $status = http_response_code();
            if (!$status)
                http_response_code(400); //Retorna Status - Bad Request
            echo json_encode(["message" => $e->getMessage()]);
        }
    } else {
        //Retorna Status - Bad Request
        http_response_code(400);
        echo json_encode(["message" => "Não foi possivel atualizar o usuário. Dados incompletos"]);
    }
} else {
    //Retorna Status - Method Not Allowed
    http_response_code(405);
    echo json_encode(["message" => "Método não permitido"]);
}
