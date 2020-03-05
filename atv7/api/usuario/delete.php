<?php

require_once '../../usuarios.php';
require_once '../core.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE, POST");


$core = new Core();
$core->allowMethods = ['DELETE', 'POST']; //Metodos permitidos
$core->requestMethod = strtoupper($_SERVER['REQUEST_METHOD']); //Metodo recebido

//Verificação do Metodo Permitido
if ($core->getAllowMethods()) {

    //Dados da requisição
    $data = json_decode(file_get_contents("php://input"));

    //Se todos preenchidos
    if (!empty($data->email)) {
        try {
            //Cria instancia de usuario e preenche variável de e-mail
            $usuario = new Usuario();

            if(!$usuario->checkEmailData($data->email)) throw new Exception("Dado: email inválido") ;

            $usuario->email = $data->email;
            $delete = $usuario->delete();

            //Retorna Status - OK
            http_response_code(200);
            echo json_encode(["message" => $delete]);

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
        echo json_encode(["message" => "Não foi possivel excluir o usuário. Dados incompletos"]);
    }
} else {
    //Retorna Status - Method Not Allowed
    http_response_code(405);
    echo json_encode(["message" => "Método não permitido"]);
}
