<?php
namespace Igor\Projeto\funcoes;
use Igor\Projeto\funcoes\Formatacoes;

class FuncoesTransitorias{

    public static function processarDados ($tipoEspecificoNotaDispSubstReass){
        $dataDaApresentacaoDesformatada = $_POST['data_saida_retorno_funcao']; 
        
        $aPartirOuAcontar = Formatacoes::ApartirOuAcontar($dataDaApresentacaoDesformatada);

        $dataApresentacaoFormatadaPadraoBR = Formatacoes::formatadordeData($dataDaApresentacaoDesformatada);
    
        if ($tipoEspecificoNotaDispSubstReass === 'designacaoFuncao')
        {
            $funcaoDesignada = $_POST['qualFuncao'];
            $dadosTratadosRefFuncoesTransitorias = FuncoesTransitorias::tratarDesigFuncao(
            $dataApresentacaoFormatadaPadraoBR,
            $aPartirOuAcontar, 
            $funcaoDesignada);
    
        } elseif ($tipoEspecificoNotaDispSubstReass === 'funcaoDispensa')
        {
            $funcaoDipensa = $_POST['primeiraFuncao'];
            $exercerOuResponder = $_POST['responderOuExercer'];
            $motivo = $_POST['motivoDispensadoFuncao'];
            $segundafuncaoDipensa = $_POST['segundaFuncao'];
            $exercerOuResponderSegundFuncao = $_POST['respondendoOuExercendoSegundaFuncao'];


            $dadosTratadosRefFuncoesTransitorias = FuncoesTransitorias::tratarDispFuncao(
            $dataApresentacaoFormatadaPadraoBR,
            $aPartirOuAcontar, 
            $funcaoDipensa,
            $exercerOuResponder,
            $motivo,
            $segundafuncaoDipensa,
            $exercerOuResponderSegundFuncao
        );
        } elseif ($tipoEspecificoNotaDispSubstReass === 'substituicaoTemporaria')
        {
            $funcaoSubstTemp = $_POST['qualFuncaoSubstituira'];
            $dadosTratadosRefFuncoesTransitorias = FuncoesTransitorias::TratarSubstTemporaria(
            $dataApresentacaoFormatadaPadraoBR,
            $aPartirOuAcontar,
            $funcaoSubstTemp);
    
        }
        elseif ($tipoEspecificoNotaDispSubstReass === 'reassuncaoFuncao')
        {
            $reassuncaoFuncao = $_POST['reassumiufuncao1'];
            $reassumiuSegundafuncao = $_POST['reassumiufuncao2'];
            $dadosTratadosRefFuncoesTransitorias = FuncoesTransitorias::TratarReassuncaoFuncao(
            $dataApresentacaoFormatadaPadraoBR,
            $aPartirOuAcontar, 
            $reassuncaoFuncao,
            $reassumiuSegundafuncao
        );
    
        }
    return $dadosTratadosRefFuncoesTransitorias;
    }

    public static function tratarDesigFuncao($dataApresentacaoFormatadaPadraoBR, $aPartirOuAcontar, $funcaoDesignada)
    {   
        $resultado = "Designado para exercer a função de $funcaoDesignada, a $aPartirOuAcontar de $dataApresentacaoFormatadaPadraoBR";
        return $resultado;
    }

    public static function tratarDispFuncao($dataApresentacaoFormatadaPadraoBR, $aPartirOuAcontar, $funcaoDipensa, $exercerOuResponder, $motivo, $segundafuncaoDipensa, $exercerOuResponderSegundFuncao
    )
    {
        if ($exercerOuResponderSegundFuncao == 'exercer'){
            if ($segundafuncaoDipensa != 'null' and $motivo != 'null'){
                $resultado = "Dispensado de $exercerOuResponder função de $funcaoDipensa e $segundafuncaoDipensa, a $aPartirOuAcontar de $dataApresentacaoFormatadaPadraoBR" . "$motivo";
            } elseif ($segundafuncaoDipensa != 'null' and $motivo == 'null') {
                $resultado = "Dispensado de $exercerOuResponder função de $funcaoDipensa e $segundafuncaoDipensa, a $aPartirOuAcontar de $dataApresentacaoFormatadaPadraoBR";
            } elseif ($motivo != 'null' and $segundafuncaoDipensa == 'null'){
                $resultado = "Dispensado de $exercerOuResponder função de $funcaoDipensa, a $aPartirOuAcontar de $dataApresentacaoFormatadaPadraoBR" . "$motivo";
            } elseif ($motivo == 'null' and $segundafuncaoDipensa == 'null'){
            $resultado = "Dispensado de $exercerOuResponder função de $funcaoDipensa, a $aPartirOuAcontar de $dataApresentacaoFormatadaPadraoBR";
            }
        }else{
            if ($segundafuncaoDipensa != 'null' and $motivo != 'null'){
                $resultado = "Dispensado de $exercerOuResponder função de $funcaoDipensa e $exercerOuResponderSegundFuncao função de $segundafuncaoDipensa, a $aPartirOuAcontar de $dataApresentacaoFormatadaPadraoBR" . "$motivo";
            } elseif ($segundafuncaoDipensa != 'null' and $motivo == 'null') {
                $resultado = "Dispensado de $exercerOuResponder função de $funcaoDipensa e $exercerOuResponderSegundFuncao função de $segundafuncaoDipensa, a $aPartirOuAcontar de $dataApresentacaoFormatadaPadraoBR";
            } elseif ($motivo != 'null' and $segundafuncaoDipensa == 'null'){
                $resultado = "Dispensado de $exercerOuResponder função de $funcaoDipensa, a $aPartirOuAcontar de $dataApresentacaoFormatadaPadraoBR" . "$motivo";
            } elseif ($motivo == 'null' and $segundafuncaoDipensa == 'null'){
            $resultado = "Dispensado de $exercerOuResponder função de $funcaoDipensa, a $aPartirOuAcontar de $dataApresentacaoFormatadaPadraoBR";
            }
        }
        return $resultado;
    }

    public static function TratarSubstTemporaria($dataApresentacaoFormatadaPadraoBR, $aPartirOuAcontar, $funcaoSubstTemp)
    {   
        $resultado = "Designado para responder pela função de $funcaoSubstTemp, a $aPartirOuAcontar de $dataApresentacaoFormatadaPadraoBR, como substituto temporário, cumulativamente com as funções que já exerce";
        return $resultado;
    }

    public static function TratarReassuncaoFuncao($dataApresentacaoFormatadaPadraoBR, $aPartirOuAcontar, $reassuncaoFuncao, $reassumiuSegundafuncao
    )
    {   
        if ($reassumiuSegundafuncao!= 'null'){
            $resultado = "Reassumiu a função de $reassuncaoFuncao e $reassumiuSegundafuncao, a $aPartirOuAcontar de $dataApresentacaoFormatadaPadraoBR";
        } else{
            $resultado = "Reassumiu a função de $reassuncaoFuncao, a $aPartirOuAcontar de $dataApresentacaoFormatadaPadraoBR";
        }
        return $resultado;
    }

}