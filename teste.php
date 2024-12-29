<?php
require 'vendor/autoload.php';
use Igor\Projeto\funcoes\Formatacoes;

$data = New DateTime();
$diasParaSomar = "3";


$diasASomarFormatado = "P" . $diasParaSomar . "D";
$dataAcrescida = $data->add(new DateInterval($diasASomarFormatado));
$dataAcrescida = $dataAcrescida -> format('Y-m-d');
echo $dataAcrescida;
// $anos = array();
// $anos = Formatacoes::pegarAnosAnterioresAtualEPosteriores();
// foreach ($anos as $ano){
//     echo "$ano";
// };