<?php

    //Função foiMordido
    function foiMordido()
    {
        return rand(0, 1);
    }

    //Declaração de mordeu
    $mordeu = (isset($_GET['mordeu']) == 1) ? foiMordido() : 0;
?>

<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Atividade 2</title>
</head>
<body>
    <a href="index.php?mordeu=1">
        <button type="button">Joãozinho foi mordido?</button>
    </a>
    <p>Joaozinho <?= (!$mordeu) ? 'NAO' : '' ?> mordeu seu dedo</p>
</body>
</html>
