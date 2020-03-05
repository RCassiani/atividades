<?php

require_once 'select.php';

$selectField = new SelectField();

?>

<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Atividade 6</title>
</head>
<body>
    <form action="index.php" method="post" autocomplete="off">
        <label for="nome">Nome</label>
        <input type="text" name='nome' id='nome' required>
        <br>
        <label for="login">Login</label>
        <input type="text" name='login' id='login' required>
        <br>
        <label for="tipo">Tipo</label>
        <?= $selectField->getFieldTipo() ?>
        <br>
        <label for="senha">Senha</label>
        <input type="password" name='senha' id='senha' required>
        <br>
        <button>Salvar</button>
    </form>
</body>
</html>
