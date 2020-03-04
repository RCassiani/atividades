<?php

    //Função para pegar extensao
    function getExtensao($arquivo)
    {
        return strstr($arquivo, '.');
    }

    //Array de arquivos
    $arquivos = [
        'music.mp4',
        'video.mov',
        'imagem.jpeg'
    ];

    //Array de extensoes para ordenar
    $extensoes = [];

    //Monta um array com as extensoes
    foreach ($arquivos as $a){
        $extensoes[] = getExtensao($a);
    }

    // Array ordenado
    sort($extensoes);

?>

<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Atividade 3</title>
</head>
<body>
    <p>Extensões</p>
    <ul>
        <?php
        //Listando arrays
        foreach ($extensoes as $e)
            echo "<li>" . $e . "</li>";
        ?>
    </ul>
</body>
</html>
