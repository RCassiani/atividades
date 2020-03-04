<?php

$filename = "registros.txt";
$message = '';

if ($_POST['nome'] && $_POST['sobrenome'] && $_POST['email'] && $_POST['telefone'] && $_POST['login'] && $_POST['senha']) {
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    $array = [
        'nome' => $nome,
        'sobrenome' => $sobrenome,
        'email' => $email,
        'telefone' => $telefone,
        'login' => $login,
        'senha' => md5($senha), //Encrypt da senha
    ];

    //Primeiro registro
    if (!file_exists($filename)) {
        $registros = fopen($filename, "a") or die("Problemas ao abrir arquivo!");
    } //Próximos registros
    else {
        $linhasReg = file($filename); //Todos as linhas do arquivo
        foreach ($linhasReg as $l) {
            $l = json_decode($l);
            if ($l->email == $email || $l->login == $login)
                $message = "Não foi possível inserir! Email/Login já cadastrado";
        }
    }

    //Sem erro
    if (!$message) {
        file_put_contents($filename, json_encode($array) . "\n", FILE_APPEND);
        $message = "Registro inserido";
    }
}


?>

<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Atividade 4</title>
</head>
<body>
<h4><?= $message ?></h4>
<a href="index.html"><button>Voltar</button></a>
</body>
</html>
