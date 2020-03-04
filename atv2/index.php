<?php
    //Array desordenado
    $location = [
        ['pais' => 'Estados Unidos', 'capital' => 'Washington'],
        ['pais' => 'Brasil', 'capital' => 'Brasília'],
        ['pais' => 'Rússia', 'capital' => 'Moscou'],
        ['pais' => 'Argentina', 'capital' => 'Buenos Aires'],
        ['pais' => 'Canadá', 'capital' => 'Ottawa'],
    ];

    //Função de comparação
    function order($a, $b) {
        return $a['capital'] > $b['capital'];
    }

    // Array ordenado
    usort($location, 'order');
?>

<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Atividade 1</title>
</head>
<body>
    <?php
    //Listando arrays
    foreach($location as $l)
        echo "<li>".$l['capital']." é a capital do(a) ".$l['pais'];
    ?>
</body>
</html>