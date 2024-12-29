<?php
function adicionarDiasEmUmaData(DateTime $data, string $diasParaSomar)
{
    $diasASomarFormatado = "P" . $diasParaSomar . "D";
    $dataAcrescida = $data->add(new DateInterval($diasASomarFormatado));
    $dataAcrescida = $dataAcrescida -> format('Y-m-d');
    return $dataAcrescida;
}

$data = new DateTime('2024-04-24');
var_dump(adicionarDiasEmUmaData($data, '1'));