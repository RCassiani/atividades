<?php

function parserXmlToCsv($xmlString)
{
    //Existe arquivo XML
    if (file_exists($xmlString)) {

        $xml = simplexml_load_file($xmlString); //Carrega o arquivo XML
        $header = false;
        $csv = '';

        foreach ($xml as $key => $value) {
            //Primeira linha = cabeçalho
            if (!$header) {
                $csv .= implode(array_keys(get_object_vars($value)), ','); //Apenas as chaves para o cabeçalho
                $header = true; //Próximas linhas, conteúdo
            }
            $csv .= "\n";
            $csv .= implode(get_object_vars($value), ','); //Os valores, para o corpo
        }
        return $csv;
    }
}

$xml_file = 'example.xml'; //Nome do arquivo - XML
$csv_file = 'parse.csv'; //Nome do arquivo - CSV

$csv = parserXmlToCsv($xml_file); //Executa função de converter
file_put_contents($csv_file, $csv); //Salva arquivo convertido

echo "Atividade - 5: XML (".$xml_file.") convertido para CSV (".$csv_file.")";
