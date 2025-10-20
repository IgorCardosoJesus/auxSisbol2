<?php
namespace Igor\Projeto\funcoes;
use Igor\Projeto\funcoes\Formatacoes;

class PassRecebFuncao{
    
    public static function processarDados ($tipoEspecificoNotaPassagemFuncao){
    
        if ($tipoEspecificoNotaPassagemFuncao === 'passagemMaterialEncargosValores')
        {
            $prazo = $_POST['prazo_passagemMaterialEncargosValores'];
            $nomeFuncao = $_POST['funcao_passagemMaterialEncargosValores'];
            $dataInicioPass = $_POST['data_inicio_passagemMaterialEncargosValores'];
            if (!$dataInicioPass){
                return "Volte e informe a data de inicio do evento";
            }
            $aPartirOuAcontar = Formatacoes::ApartirOuAcontar($dataInicioPass);
            $dataInicioPass = Formatacoes::formatadordeData($dataInicioPass);

            $dadosTratadosRefPassRecebFuncao = PassRecebFuncao::tratarPassagemMaterialEncargosValores(
            $prazo,
            $nomeFuncao, 
            $dataInicioPass,
            $aPartirOuAcontar);
    
        } elseif ($tipoEspecificoNotaPassagemFuncao === 'recebimentoMaterialEncargosValores')
        {

            $prazo = $_POST['prazo_recebimentoMaterialEncargosValores'];
            $nomeFuncao = $_POST['funcao_recebimentoMaterialEncargosValores'];
            $dataInicioPass = $_POST['data_inicio_recebimentoMaterialEncargosValores'];
            if (!$dataInicioPass){
                return "Volte e informe a data de inicio do evento";
            }
            $aPartirOuAcontar = Formatacoes::ApartirOuAcontar($dataInicioPass);
            $dataInicioPass = Formatacoes::formatadordeData($dataInicioPass);

            $dadosTratadosRefPassRecebFuncao = PassRecebFuncao::tratarRecebMaterialEncargosValores(
            $prazo,
            $nomeFuncao, 
            $dataInicioPass,
            $aPartirOuAcontar);

        } elseif ($tipoEspecificoNotaPassagemFuncao === 'passagemCargoEncargos')
        {
            $prazo = $_POST['prazo_passagemCargoEncargos'];
            $nomeFuncao = $_POST['funcao_passagemCargoEncargos'];
            $dataInicioPass = $_POST['data_inicio_passagemCargoEncargos'];
            if (!$dataInicioPass){
                return "Volte e informe a data de inicio do evento";
            }
            $aPartirOuAcontar = Formatacoes::ApartirOuAcontar($dataInicioPass);
            $dataInicioPass = Formatacoes::formatadordeData($dataInicioPass);

            $dadosTratadosRefPassRecebFuncao = PassRecebFuncao::tratarPassagemCargoEncargos(
            $prazo,
            $nomeFuncao,
            $dataInicioPass,
            $aPartirOuAcontar);

        } elseif ($tipoEspecificoNotaPassagemFuncao === 'recebimentoCargoEncargos')
        {
            $prazo = $_POST['prazo_recebimentoCargoEncargos'];
            $nomeFuncao = $_POST['funcao_recebimentoCargoEncargos'];
            $dataInicioPass = $_POST['data_inicio_recebimentoCargoEncargos'];
            if (!$dataInicioPass){
                return "Volte e informe a data de inicio do evento";
            }
            $aPartirOuAcontar = Formatacoes::ApartirOuAcontar($dataInicioPass);
            $dataInicioPass = Formatacoes::formatadordeData($dataInicioPass);

            $dadosTratadosRefPassRecebFuncao = PassRecebFuncao::tratarRecebimentoCargoEncargos(
            $prazo,
            $nomeFuncao,
            $dataInicioPass,
            $aPartirOuAcontar);

        } elseif ($tipoEspecificoNotaPassagemFuncao === 'passagemMaterialValores')
        {

            $prazo = $_POST['prazo_passagemMaterialValores'];
            $nomeFuncao = $_POST['funcao_passagemMaterialValores'];
            $dataInicioPass = $_POST['data_inicio_passagemMaterialValores'];
            if (!$dataInicioPass){
                return "Volte e informe a data de inicio do evento";
            }
            $aPartirOuAcontar = Formatacoes::ApartirOuAcontar($dataInicioPass);
            $dataInicioPass = Formatacoes::formatadordeData($dataInicioPass);

            $dadosTratadosRefPassRecebFuncao = PassRecebFuncao::tratarPassagemMaterialValores(
            $prazo,
            $nomeFuncao,
            $dataInicioPass,
            $aPartirOuAcontar);

        } elseif ($tipoEspecificoNotaPassagemFuncao === 'recebimentoMaterialValores')
        {

            $prazo = $_POST['prazo_recebimentoMaterialValores'];
            $nomeFuncao = $_POST['funcao_recebimentoMaterialValores'];
            $dataInicioPass = $_POST['data_inicio_recebimentoMaterialValores'];
            if (!$dataInicioPass){
                return "Volte e informe a data de inicio do evento";
            }
            $aPartirOuAcontar = Formatacoes::ApartirOuAcontar($dataInicioPass);
            $dataInicioPass = Formatacoes::formatadordeData($dataInicioPass);

            $dadosTratadosRefPassRecebFuncao = PassRecebFuncao::tratarRecebimentoMaterialValores(
            $prazo,
            $nomeFuncao,
            $dataInicioPass,
            $aPartirOuAcontar);

        } elseif ($tipoEspecificoNotaPassagemFuncao === 'assuncaoFuncao')
        {

            $nomeFuncao = $_POST['funcao_assuncaoFuncao'];
            $dataInicioPass = $_POST['data_inicio_assuncaoFuncao'];
            if (!$dataInicioPass){
                return "Volte e informe a data de inicio do evento";
            }
            $dataInicioPass = Formatacoes::formatadordeData($dataInicioPass);
            $cumulativamente = $_POST['cumulativamente'];

            $dadosTratadosRefPassRecebFuncao = PassRecebFuncao::tratarAssuncaoFuncao(
            $nomeFuncao,
            $dataInicioPass,
            $cumulativamente);

        }

    return $dadosTratadosRefPassRecebFuncao;
    }

    public static function tratarPassagemMaterialEncargosValores($prazo, $nomeFuncao, $dataInicioPass, $aPartirOuAcontar)
    {   
        if ($prazo == '20'){
            return ("Concedidos 20 (vinte) dias úteis para a passagem de material e transmissão de encargos e valores de $nomeFuncao, a $aPartirOuAcontar de $dataInicioPass, de acordo com o Nr 1, do Art 131, do Regulamento de Administração do Exército - EB10-R-01.003,  1ª Edição, 2021, Portaria C Ex Nr 1.555, de 9 JUL 21");

        } else if ($prazo == '10'){
            return ("Concedidos 10 (dez) dias úteis para a passagem de material e transmissão de encargos e valores de $nomeFuncao, a $aPartirOuAcontar de $dataInicioPass, de acordo com o Nr 2, do Art 131, do Regulamento de Administração do Exército - EB10-R-01.003,  1ª Edição, 2021, Portaria C Ex Nr 1.555, de 9 JUL 21");

        } else{
            return ("Concedidos 04 (quatro) dias úteis para a passagem de material e transmissão de encargos e valores de $nomeFuncao, a $aPartirOuAcontar de $dataInicioPass, de acordo com o Nr 3, do Art 131, do Regulamento de Administração do Exército - EB10-R-01.003,  1ª Edição, 2021, Portaria C Ex Nr 1.555, de 9 JUL 21");

        }
    }

    public static function tratarRecebMaterialEncargosValores($prazo, $nomeFuncao, $dataInicioPass, $aPartirOuAcontar)
    {
        if ($prazo == '20'){
            return ("Concedidos 20 (vinte) dias úteis para o recebimento de material, de encargos e valores de $nomeFuncao, a $aPartirOuAcontar de $dataInicioPass, de acordo com o Nr 1, do Art 131, do Regulamento de Administração do Exército - EB10-R-01.003,  1ª Edição, 2021, Portaria C Ex Nr 1.555, de 9 Jul 21");
        } else if ($prazo == '10'){
            return ("Concedidos 10 (dez) dias úteis para o recebimento de material, de encargos e valores de $nomeFuncao, a $aPartirOuAcontar de $dataInicioPass, de acordo com o Nr 2, do Art 131, do Regulamento de Administração do Exército - EB10-R-01.003,  1ª Edição, 2021, Portaria C Ex Nr 1.555, de 9 Jul 21");
        } else{
            return ("Concedidos 04 (quatro) dias úteis para o recebimento de material, de encargos e valores de $nomeFuncao, a $aPartirOuAcontar de $dataInicioPass, de acordo com o Nr 3, do Art 131, do Regulamento de Administração do Exército - EB10-R-01.003,  1ª Edição, 2021, Portaria C Ex Nr 1.555, de 9 Jul 21");
        }
    }

    public static function tratarPassagemCargoEncargos($prazo, $nomeFuncao, $dataInicioPass, $aPartirOuAcontar)
    {
        if ($prazo == '20'){
            return ("De acordo com o inciso I, do Art 131, do RAE, são concedidos 20 (vinte) dias úteis de prazo para passagem cargo e encargos da função de $nomeFuncao, a $aPartirOuAcontar de $dataInicioPass");
        } else if ($prazo == '10'){
            return ("De acordo com o inciso II, do Art 131, do RAE, são concedidos 10 (dez) dias úteis de prazo para passagem cargo e encargos da função de $nomeFuncao, a $aPartirOuAcontar de $dataInicioPass");
        } else{
            return ("De acordo com o inciso III, do Art 131, do RAE, são concedidos 4 (quatro) dias úteis de prazo para passagem do cargo e encargos da função de $nomeFuncao, a $aPartirOuAcontar de $dataInicioPass");
        }
    }

    public static function tratarRecebimentoCargoEncargos($prazo, $nomeFuncao, $dataInicioPass, $aPartirOuAcontar)
    {
        if ($prazo == '20'){
            return ("De acordo com o inciso I, do Art 131, do RAE, são concedidos 20 (vinte) dias úteis de prazo para recebimento do cargo e encargos da função de $nomeFuncao, a $aPartirOuAcontar de $dataInicioPass");
        } else if ($prazo == '10'){
            return ("De acordo com o inciso II, do Art 131, do RAE, são concedidos 10 (dez) dias úteis de prazo para recebimento do cargo e encargos da função de $nomeFuncao, a $aPartirOuAcontar de $dataInicioPass");
        } else{
            return ("De acordo com o inciso III, do Art 131, do RAE, são concedidos 4 (quatro) dias úteis de prazo para recebimento do cargo e encargos da função de $nomeFuncao, a $aPartirOuAcontar de $dataInicioPass");
        }
    }

    public static function tratarPassagemMaterialValores($prazo, $nomeFuncao, $dataInicioPass, $aPartirOuAcontar)
    {
        if ($prazo == '20'){
            return ("Concedidos 20 (vinte) dias úteis para a passagem de material e transmissão de valores da função de $nomeFuncao, a $aPartirOuAcontar de $dataInicioPass, de acordo com o Nr 1, do Art 131, do Regulamento de Administração do Exército - EB10-R-01.003,  1ª Edição, 2021, Portaria C Ex Nr 1.555, de 9 JUL 21");
        } else if ($prazo == '10'){
            return ("Concedidos 10 (dez) dias úteis para a passagem de material e transmissão de valores da função de $nomeFuncao, a $aPartirOuAcontar de $dataInicioPass, de acordo com o Nr 2, do Art 131, do Regulamento de Administração do Exército - EB10-R-01.003,  1ª Edição, 2021, Portaria C Ex Nr 1.555, de 9 JUL 21");
        } else{
            return ("Concedidos 4 (quatro) dias úteis para a passagem de material e transmissão de valores da função de $nomeFuncao, a $aPartirOuAcontar de $dataInicioPass, de acordo com o Nr 3, do Art 131, do Regulamento de Administração do Exército - EB10-R-01.003,  1ª Edição, 2021, Portaria C Ex Nr 1.555, de 9 JUL 21");
        }
    }

    public static function tratarRecebimentoMaterialValores($prazo, $nomeFuncao, $dataInicioPass, $aPartirOuAcontar)
    {
        if ($prazo == '20'){
            return ("Concedidos 20 (vinte) dias úteis para o recebimento de material e valores de função de $nomeFuncao, a $aPartirOuAcontar de $dataInicioPass, de acordo com o Nr 1, do Art 131, do Regulamento de Administração do Exército - EB10-R-01.003,  1ª Edição, 2021, Portaria C Ex Nr 1.555, de 9 JUL 21");
        } else if ($prazo == '10'){
            return ("Concedidos 10 (dez) dias úteis para o recebimento de material e valores de função de $nomeFuncao, a $aPartirOuAcontar de $dataInicioPass, de acordo com o Nr 2, do Art 131, do Regulamento de Administração do Exército - EB10-R-01.003,  1ª Edição, 2021, Portaria C Ex Nr 1.555, de 9 JUL 21");
        } else{
            return ("Concedidos 4 (quatro) dias úteis para o recebimento de material e valores de função de $nomeFuncao, a $aPartirOuAcontar de $dataInicioPass, de acordo com o Nr 3, do Art 131, do Regulamento de Administração do Exército - EB10-R-01.003,  1ª Edição, 2021, Portaria C Ex Nr 1.555, de 9 JUL 21");
        }
    }

    public static function tratarAssuncaoFuncao($nomeFuncao, $dataInicioPass, $cumulativamente)
    {
        if ($cumulativamente == '1'){
            return("Assumiu a função de $nomeFuncao em $dataInicioPass, cumulativamente com as funções que já exerce, de acordo com o disposto no § 1º, do Art 365, do RISG");
        } else {
            return("Assumiu a função de $nomeFuncao em $dataInicioPass, de acordo com o disposto no § 1º, do Art 365, do RISG");
        }
    
    }
}
