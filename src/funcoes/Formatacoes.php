<?php
namespace Igor\Projeto\funcoes;
use DateTime;
use DateInterval;

class Formatacoes {

    //Recebe a data do formulário DESFORMATADA e devolve um OBJETO do tipo DateTime.
    public static function transformarDataStringEmData(string $dataEmString)
    {
        $data = new DateTime($dataEmString);
        return $data;
    }

    //Recebe um OBJETO do tipo DateTime e adiciona dias a ele.
    //Dias a somar pode ser em formato 01 ou 1 que não tem problema.
    public static function adicionarDiasEmUmaData(DateTime $data, string $diasParaSomar)
    {
        $diasASomarFormatado = "P" . $diasParaSomar . "D";
        $dataAcrescida = $data->add(new DateInterval($diasASomarFormatado));
        $dataAcrescida = $dataAcrescida -> format('Y-m-d');
        return $dataAcrescida;
    }


    //Recebe uma data qualquer do formulário ('2024-06-12') e formata no padrão exigido ('12 JUN 24')
    public static function formatadordeData(string $datadesformatada){

        $meses = array(
        "01" => "JAN",
        "02" => "FEV",
        "03" => "MAR",
        "04" => "ABR",
        "05" => "MAIO",
        "06" => "JUN",
        "07" => "JUL",
        "08" => "AGO",
        "09" => "SET",
        "10" => "OUT",
        "11" => "NOV",
        "12" => "DEZ"
        );

        // Separa a data em dia, mês e ano
        $partes_data = explode("-", $datadesformatada);
        $dia = $partes_data[2];
        $mes = $partes_data[1];
        $mesFormatado = $meses[$mes];
        $ano = $partes_data[0];


        // Verifica se o dia está entre 1 e 9 e adiciona "º" se for necessário
        if ($dia == '01') {
            // Remove o zero à esquerda do dia
            $diaFormatado = ltrim($dia, '0') . "º";
        } elseif ($dia >= '02' && $dia <= '09') {
            $diaFormatado = ltrim($dia, '0');
        } else {
            // Não precisamos fazer nada especial para os dias de 10 a 30
            $diaFormatado = $dia;
        }

        // Formata a data no formato desejado
        $data_formatada = $diaFormatado . " " . $mesFormatado . " " . substr($ano, -2);
        return $data_formatada;
    }


    //Recebe a data DESFORMATADA vinda do formulário e verifica se é "contar" ou "partir".
    public static function ApartirOuAcontar($dataVindaDiretoDoFormulario)
    {
        $objetoTipoDataFormatado = DateTime::createFromFormat('Y-m-d', $dataVindaDiretoDoFormulario);

        // Obtendo a data atual
        $hoje = new DateTime();
    
        // Formata as datas como strings no formato 'Y-m-d' para comparação
        $dataFormatada = $objetoTipoDataFormatado->format('Y-m-d');
        $hojeFormatado = $hoje->format('Y-m-d');

        if ($objetoTipoDataFormatado > $hoje) {
            return 'partir';
        } elseif ($dataFormatada === $hojeFormatado) {
            return 'partir';
        } else {
            return 'contar';
        }
    }


    //Recebe um número qualquer de 1 - 30 e devolve por extenso.
    //Detalhe: TEM QUE SER COM 0 (ZERO) A FRENTE.
    public static function numeroEmExtenso($numero){

    $transformaEmExtenso = array(
        "01" => "um",
        "02" => "dois",
        "03" => "três",
        "04" => "quatro",
        "05" => "cinco",
        "06" => "seis",
        "07" => "sete",
        "08" => "oito",
        "09" => "nove",
        "10" => "dez",
        "11" => "onze",
        "12" => "doze",
        "13" => "treze",
        "14" => "catorze",
        "15" => "quinze",
        "16" => "dezesseis",
        "17" => "dezessete",
        "18" => "dezoito",
        "19" => "dezenove",
        "20" => "vinte",
        "21" => "vinte e um",
        "22" => "vinte e dois",
        "23" => "vinte e três",
        "24" => "vinte e quatro",
        "25" => "vinte e cinco",
        "26" => "vinte e seis",
        "27" => "vinte e sete",
        "28" => "vinte e oito",
        "29" => "vinte e nove",
        "30" => "trinta"
    );

    return $transformaEmExtenso[$numero];
    }


    //Tira 0 a esquerda de um número
    public static function tiraZeroAEsquerda($numero){
        $semZero = (ltrim($numero, '0'));
        return $semZero;
    }

    //Devolve todas as funções do btl para um campo select por exemplo.
    public static function pegarTodasFuncoesOM(){
        $todasAsFuncoes = array(
            "Cmt Btl",
            "Cmt Btl e Ordenador de Despesas",
            "Ordenador de Despesas",
            "SCmt Btl",
            "Cmt 1ª Cia Fuz Bld",
            "Sgte 1ª Cia Fuz Bld",
            "Aux Sgte 1ª Cia Fuz Bld",
            "Fur 1ª Cia Fuz Bld",
            "Enc Mat 1ª Cia Fuz Bld",
            "Aux Enc Mat 1ª Cia Fuz Bld",
            "Rspnl Res Armt 1ª Cia Fuz Bld",
            "Cmt 2ª Cia Fuz Bld",
            "Sgte 2ª Cia Fuz Bld",
            "Fur 2ª Cia Fuz Bld",
            "Enc Mat 2ª Cia Fuz Bld",
            "Rspnl Res Armt 2ª Cia Fuz Bld",
            "Cmt 3ª Cia Fuz Bld",
            "Sgte 3ª Cia Fuz Bld",
            "Aux Sgte 3ª Cia Fuz Bld",
            "Fur 3ª Cia Fuz Bld",
            "Enc Mat 3ª Cia Fuz Bld",
            "Aux Enc Mat 3ª Cia Fuz Bld",
            "Rspnl Res Armt 3ª Cia Fuz Bld",
            "Cmt 4ª Cia Fuz Bld",
            "Sgte 4ª Cia Fuz Bld",
            "Aux Sgte 4ª Cia Fuz Bld",
            "Fur 4ª Cia Fuz Bld",
            "Enc Mat 4ª Cia Fuz Bld",
            "Aux Enc Mat 4ª Cia Fuz Bld",
            "Rspnl Res Armt 4ª Cia Fuz Bld",
            "Cmt Cia C Ap",
            "Sgte Cia C Ap",
            "Aux Sgte Cia C Ap",
            "Fur Cia C Ap",
            "Enc Mat Cia C Ap",
            "Aux Enc Mat Cia C Ap",
            "Rspnl Res Armt Cia C Ap",
            "Instr Ch NPOR",
            "Sgte NPOR",
            "Aux Sgte NPOR",
            "Fur NPOR",
            "Enc Mat NPOR",
            "Aux Enc Mat NPOR",
            "Rspnl Res Armt NPOR",
            "Reg B Mus",
            "Sgte B Mus",
            "Aux Sgte B Mus",
            "Fur B Mus",
            "Enc Mat B Mus",
            "Aux Enc Mat B Mus",
            "Ch 1ª Seç",
            "Aux 1ª Seç",
            "Ch 2ª Seç",
            "Aux 2ª Seç",
            "Ch 3ª Seç",
            "Aux 3ª Seç",
            "Ch 4ª Seç",
            "Aux 4ª Seç",
            "O Mnt Vtr",
            "Ch Fisc Adm",
            "Aux Fisc Adm",
            "Ch Salc",
            "Aux Salc",
            "Ch P.O",
            "Aux P.O",
            "Ch SPP",
            "Aux SPP",
            "Ch Infor",
            "Aux Infor",
            "Ch S Seç Sv Just",
            "Aux S Seç Sv Just",
            "Ch PRM",
            "Aux PRM",
            "Ch Conf",
            "Aux Conf",
            "Ch Sect",
            "Aux Sect",
            "Ch Set Fin",
            "Aux Set Fin",
            "Ch RP",
            "Aux RP",
            "Ch SFPC",
            "Aux SFPC",
            "Ch SVP",
            "Aux SVP",
            "Ch Almox",
            "Aux Almox",
            "Ch Set Aprv",
            "Aux Set Aprv",
            "Ch Fusex",
            "Aux Fusex"
            );
        return $todasAsFuncoes;
    }

    public static function pegarFuncoesQueTemCarga(){

        $funcoesOMComMaterial = array(
            "1ª Cia Fuz Bld",
            "Res Armt 1ª Cia Fuz Bld",
            "2ª Cia Fuz Bld",
            "Res Armt 2ª Cia Fuz Bld",
            "3ª Cia Fuz Bld",
            "Res Armt 3ª Cia Fuz Bld",
            "4ª Cia Fuz Bld",
            "Res Armt 4ª Cia Fuz Bld",
            "Cia C Ap",
            "Res Armt Cia C Ap",
            "NPOR",
            "Res Armt NPOR",
            "B Mus",
            "1ª Seç",
            "2ª Seç",
            "3ª Seç",
            "4ª Seç",
            "Fisc Adm",
            "Salc",
            "P.O",
            "SPP",
            "Infor",
            "S Seç Sv Just",
            "PRM",
            "Conf",
            "Sect",
            "Set Fin",
            "RP",
            "SFPC",
            "SVP",
            "Almox",
            "Set Aprv",
            "Fusex",
            );
            return $funcoesOMComMaterial;
    }

    //espero usar em PASSAGEM E RECEB FUNÇÃO
    public static function pegarFuncoesRefPassagemDeFuncao(){

        $funcoesPassagemFuncao = array(
            "Cmt 1ª Cia Fuz Bld",
            "Rspnl Res Armt 1ª Cia Fuz Bld",
            "Enc Mat 1ª Cia Fuz Bld",
            "Sgte 1ª Cia Fuz Bld",
            "Fur 1ª Cia Fuz Bld",
            "Cmt 2ª Cia Fuz Bld",
            "Rspnl Res Armt 2ª Cia Fuz Bld",
            "Enc Mat 2ª Cia Fuz Bld",
            "Sgte 2ª Cia Fuz Bld",
            "Fur 2ª Cia Fuz Bld",
            "Cmt 3ª Cia Fuz Bld",
            "Rspnl Res Armt 3ª Cia Fuz Bld",
            "Enc Mat 3ª Cia Fuz Bld",
            "Sgte 3ª Cia Fuz Bld",
            "Fur 3ª Cia Fuz Bld",
            "Cmt 4ª Cia Fuz Bld",
            "Rspnl Res Armt 4ª Cia Fuz Bld",
            "Enc Mat 4ª Cia Fuz Bld",
            "Sgte 4ª Cia Fuz Bld",
            "Fur 4ª Cia Fuz Bld",
            "Cmt Cia C Ap",
            "Enc Mat Cia C Ap",
            "Rspnl Res Armt Cia C Ap",
            "Sgte Cia C Ap",
            "Fur Cia C Ap",
            "Instr Ch NPOR",
            "Rspnl Res Armt NPOR",
            "Enc Mat NPOR",
            "Sgte NPOR",
            "Fur NPOR",
            "Reg B Mus",
            "Mestre da Banda de Música",
            "Enc Mat B Mus",
            "Sgte B Mus",
            "Fur B Mus",
            "Ch 1ª Seç",
            "Ch 2ª Seç",
            "Ch 3ª Seç",
            "Ch 4ª Seç",
            "Ch Fisc Adm",
            "Ch Salc",
            "Ch Ch Seç Sv G",
            "Ch SPP",
            "Ch Seç Infor",
            "Ch S Seç Sv Just",
            "Ch PRM",
            "Ch Conf Doc",
            "Ch Sect",
            "Ch Set Fin",
            "Ch Pel Mnt Trnp",
            "Ch RP",
            "Ch Pel Com",
            "Ch SFPC",
            "Ch SVP",
            "Ch Almox",
            "Ch Set Aprv",
            "Ch Fusex",
            "Ch Sup Doc",
            );
            return $funcoesPassagemFuncao;
    }

    //Devolve os 2 últimos anos, o atual e os dois próximos.
    public static function pegarAnosAnterioresAtualEPosteriores(){
        $anos = array();
        for ($i = -2; $i <= 2; $i++){
            $anos[] = date('Y') + $i;
        }
        return $anos;
    }

}