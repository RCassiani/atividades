<?php

require_once '../../usuarios.php';
require_once '../core.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

$core = new Core();
$core->allowMethods = ['POST']; //Metodo permitido
$core->requestMethod = strtoupper($_SERVER['REQUEST_METHOD']); //Metodo recebido

//Verificação do Metodo Permitido
if ($core->getAllowMethods()) {

    //Dados da requisição
    $data = json_decode(file_get_contents("php://input"));

    //Se todos preenchidos
    if (!empty($data->nome) &&
        !empty($data->sobrenome) &&
        !empty($data->email) &&
        !empty($data->telefone)
    ) {
        try {

            //Cria instancia de usuario e preenche todos as variáveis
            $usuario = new Usuario();

            if(!$usuario->checkEmailData($data->email)) throw new Exception("Dado: email inválido. (Ex: user@email.com)") ;
            if(!$usuario->checkPhoneData($data->telefone)) throw new Exception("Dado: telefone inválido. (Ex: 1998765432)");

            $usuario->nome = $data->nome;
            $usuario->sobrenome = $data->sobrenome;
            $usuario->email = $data->email;
            $usuario->telefone = $data->telefone;
            $create = $usuario->create();

            //Retorna Status - Created
            http_response_code(201);
            echo json_encode(["message" => $create]);

        } catch (Exception $e) {
            //Retorna Status - Bad Request
            http_response_code(400);
            echo json_encode(["message" => $e->getMessage()]);
        }

    } else {
        //Retorna Status - Bad Request
        http_response_code(400);
        echo json_encode(["message" => "Não foi possivel inserir o usuário. Dados incompletos"]);
    }
} else {
    //Retorna Status - Method Not Allowed
    http_response_code(405);
    echo json_encode(["message" => "Método não permitido"]);
}
