<?php
namespace Igor\Projeto\funcoes;
use Igor\Projeto\funcoes\Formatacoes;
class Apresentacoes {

    public static function processarDados ($tipoEspecificoDeApresentacao){
        $dataDaApresentacaoDesformatada = $_POST['data_apresentacao'];
        $dataApresentacaoFormatadaPadraoBR = Formatacoes::formatadordeData($dataDaApresentacaoDesformatada);
    
        if ($tipoEspecificoDeApresentacao === 'term30dias' || 
        $tipoEspecificoDeApresentacao === 'term1parcela15' || 
        $tipoEspecificoDeApresentacao === 'term2parcela15' || 
        $tipoEspecificoDeApresentacao === 'term1parcela10' || 
        $tipoEspecificoDeApresentacao === 'term2parcela10' || 
        $tipoEspecificoDeApresentacao === 'term3parcela10')
        {
            $anoDaParcelaFerias = $_POST['AnoFerias'];
            $dadosTratadosRefApresentacao = Apresentacoes::tratarApresentacaoRefFerias(
            $dataApresentacaoFormatadaPadraoBR, 
            $tipoEspecificoDeApresentacao, 
            $anoDaParcelaFerias);
    
        } else if ($tipoEspecificoDeApresentacao === 'termTransmCargoEncargo' || 
        $tipoEspecificoDeApresentacao === 'termRecebCargoEncargo' || 
        $tipoEspecificoDeApresentacao === 'termPassCargoMaterial' || 
        $tipoEspecificoDeApresentacao === 'termRecebCargoMaterial')
        {
            $funcao = $_POST['apresentouTermRecebFuncaoCargoEncargo'];
            $dadosTratadosRefApresentacao = Apresentacoes::tratarApresentacaoRefFuncoesBtl(
            $dataApresentacaoFormatadaPadraoBR, 
            $tipoEspecificoDeApresentacao, 
            $funcao);
        
        } else if ($tipoEspecificoDeApresentacao === 'termPassMaterial' || 
        $tipoEspecificoDeApresentacao === 'termRecebMaterial')
        {
            $pelotaoOuEtc = $_POST['apresentouTermPassouRecebCarga'];
            $dadosTratadosRefApresentacao = Apresentacoes::tratarApresentacaoRefFuncoesBtlSomenteCarga(
            $dataApresentacaoFormatadaPadraoBR, 
            $tipoEspecificoDeApresentacao, 
            $pelotaoOuEtc);
        
        } else if ($tipoEspecificoDeApresentacao === 'termDispRecoCmtBtl'){
            $qtdeDiasDispCmt = $_POST['DiasDispCmt'];
            $qtdeDiasDispCmtExtenso = Formatacoes::numeroEmExtenso($qtdeDiasDispCmt);
            $qtdeDiasDispCmtSzero = Formatacoes::tiraZeroAEsquerda($qtdeDiasDispCmt);
            $dadosTratadosRefApresentacao = Apresentacoes::tratarApresentacaoCmtBtl(
            $dataApresentacaoFormatadaPadraoBR, 
            $tipoEspecificoDeApresentacao,
            $qtdeDiasDispCmtExtenso,
            $qtdeDiasDispCmtSzero);
        } 
        else if ($tipoEspecificoDeApresentacao === 'termDispRecoSCmt'){
            $qtdeDiasDispScmt = $_POST['DiasDispSCmt'];
            $diasExtensoDispRecoSCmt = Formatacoes::numeroEmExtenso($qtdeDiasDispScmt);
            $qtdeDiasDispScmtSzero = Formatacoes::tiraZeroAEsquerda($qtdeDiasDispScmt);
            $dadosTratadosRefApresentacao = Apresentacoes::tratarApresentacaoSubCmtBtl(
            $dataApresentacaoFormatadaPadraoBR, 
            $tipoEspecificoDeApresentacao,
            $qtdeDiasDispScmtSzero,
            $diasExtensoDispRecoSCmt);
        } 
        else if ($tipoEspecificoDeApresentacao === 'termDispRecoCmtCia'){
            $cmtSUBondoso = $_POST['CmtSUBondoso'];
            $diasDispCmtSU = $_POST['DiasDispCmtSU'];
            $diasExtensoDispRecoCmtCia = Formatacoes::numeroEmExtenso($diasDispCmtSU);
            $diasDispCmtSUSzero = Formatacoes::tiraZeroAEsquerda($diasDispCmtSU);
            $dadosTratadosRefApresentacao = Apresentacoes::tratarApresentacaoCmtCia(
            $dataApresentacaoFormatadaPadraoBR, 
            $tipoEspecificoDeApresentacao,
            $cmtSUBondoso,
            $diasDispCmtSUSzero,
            $diasExtensoDispRecoCmtCia);
        } 
        else if ($tipoEspecificoDeApresentacao === 'termDispDescoFerias' || 
        $tipoEspecificoDeApresentacao === 'termInstalacao' || 
        $tipoEspecificoDeApresentacao === 'termtransito' || 
        $tipoEspecificoDeApresentacao === 'termnupcias'||
        $tipoEspecificoDeApresentacao === 'termluto')
        {
            $qtadadeDiasDescoFerias = $_POST['gozoDispDescoFerias'];
            $diasExtensoDescoFerias = Formatacoes::numeroEmExtenso($qtadadeDiasDescoFerias);
            $qtadadeDiasDescoFeriasSZero = Formatacoes::tiraZeroAEsquerda($qtadadeDiasDescoFerias);
            $anoRefDiasDescoFerias = $_POST['DispDescFerias'];
            $diasDesistenciaTransito = $_POST['desistiuDiasTransito'];
            $diasExtenso = Formatacoes::numeroEmExtenso($diasDesistenciaTransito); 
            $diasDesistenciaTransitoSZero = Formatacoes::tiraZeroAEsquerda($diasDesistenciaTransito);
            
    
            $dadosTratadosRefApresentacao = Apresentacoes::apresentacoesDiversas($dataApresentacaoFormatadaPadraoBR, 
            $tipoEspecificoDeApresentacao,
            $diasExtensoDescoFerias, 
            $qtadadeDiasDescoFeriasSZero, 
            $anoRefDiasDescoFerias,
            $diasDesistenciaTransito, 
            $diasExtenso, 
            $diasDesistenciaTransitoSZero);
        }

        return $dadosTratadosRefApresentacao;
        }

    public static function tratarApresentacaoRefFerias($dataApresentacaoFormatadaPadraoBR, $tipoEspecificoDeApresentacao, $anoDaParcelaFerias)
    {
        if ($tipoEspecificoDeApresentacao === 'term30dias'){
            $motivo = ", por término de 30 (trinta) dias de férias, relativas ao ano de $anoDaParcelaFerias e por estar pronto para o serviço";
        }
        else if ($tipoEspecificoDeApresentacao === 'term1parcela15'){
            $motivo = ", por término da 1ª parcela de 15 (quinze) dias de férias, relativas ao ano de $anoDaParcelaFerias e por estar pronto para o serviço";
        }
        else if ($tipoEspecificoDeApresentacao === 'term2parcela15'){
            $motivo = ", por término da 2ª parcela de 15 (quinze) dias de férias, relativas ao ano de $anoDaParcelaFerias e por estar pronto para o serviço";
        }
        else if ($tipoEspecificoDeApresentacao === 'term1parcela10'){
            $motivo = ", por término da 1ª parcela de 10 (dez) dias de férias, relativas ao ano de $anoDaParcelaFerias e por estar pronto para o serviço";
        }
        else if ($tipoEspecificoDeApresentacao === 'term2parcela10'){
            $motivo = ", por término da 2ª parcela de 10 (dez) dias de férias, relativas ao ano de $anoDaParcelaFerias e por estar pronto para o serviço";
        }
        else if ($tipoEspecificoDeApresentacao === 'term3parcela10'){
            $motivo = ", por término da 3ª parcela de 10 (dez) dias de férias, relativas ao ano de $anoDaParcelaFerias e por estar pronto para o serviço";
        }
        $resultado = "Apresentou-se, em $dataApresentacaoFormatadaPadraoBR" . "$motivo";
        return $resultado;
    }

    public static function tratarApresentacaoRefFuncoesBtl($dataApresentacaoFormatadaPadraoBR, $tipoEspecificoDeApresentacao, $funcao)
    {
        if ($tipoEspecificoDeApresentacao === 'termTransmCargoEncargo'){
            $motivo = ", por término da transmissão de cargo e encargos de $funcao e por estar pronto para o serviço";
        }
        else if ($tipoEspecificoDeApresentacao === 'termRecebCargoEncargo'){
            $motivo = ", por término do recebimento de cargo e encargos de $funcao e por estar pronto para o serviço";
        }
        else if ($tipoEspecificoDeApresentacao === 'termPassCargoMaterial'){
            $motivo = ", por término da passagem de material, transmissão de encargos e valores de $funcao e por estar pronto para o serviço";
        }
        else if ($tipoEspecificoDeApresentacao === 'termRecebCargoMaterial'){
            $motivo = ", por término do recebimento de material, de encargos e valores de $funcao e por estar pronto para o serviço";
        }
        return "Apresentou-se, em $dataApresentacaoFormatadaPadraoBR" . "$motivo";
    }

    public static function tratarApresentacaoRefFuncoesBtlSomenteCarga($dataApresentacaoFormatadaPadraoBR, $tipoEspecificoDeApresentacao, $pelotaoOuEtc){
        
        if ($tipoEspecificoDeApresentacao === 'termPassMaterial'){
            $motivo = ", por término da passagem de material e transmissão de valores de $pelotaoOuEtc e por estar pronto para o serviço";
        }
        else if ($tipoEspecificoDeApresentacao === 'termRecebMaterial'){
            $motivo = ", por término do recebimento de material e dos valores de $pelotaoOuEtc e por estar pronto para o serviço";
        }
        return "Apresentou-se, em $dataApresentacaoFormatadaPadraoBR" . "$motivo";
    }

    public static function tratarApresentacaoCmtBtl($dataApresentacaoFormatadaPadraoBR, $tipoEspecificoDeApresentacao, $qtdeDiasDispCmtExtenso, $qtdeDiasDispCmtSzero){
        if ($qtdeDiasDispCmtSzero == '1'){
            $motivo = ", por término de $qtdeDiasDispCmtSzero ($qtdeDiasDispCmtExtenso) dia de dispensa como recompensa do Cmt Btl e por estar pronto para o serviço";
        } else{
            $motivo = ", por término de $qtdeDiasDispCmtSzero ($qtdeDiasDispCmtExtenso) dias de dispensa como recompensa do Cmt Btl e por estar pronto para o serviço";
        }
        return "Apresentou-se, em $dataApresentacaoFormatadaPadraoBR" . "$motivo";
    }

    public static function tratarApresentacaoSubCmtBtl($dataApresentacaoFormatadaPadraoBR, $tipoEspecificoDeApresentaca, $qtdeDiasDispScmtSzero, $diasExtensoDispRecoSCmt)
    {
    if ($qtdeDiasDispScmtSzero == '1'){
        $motivo = ", por término de $qtdeDiasDispScmtSzero ($diasExtensoDispRecoSCmt) dia de dispensa como recompensa do SCmt Btl e por estar pronto para o serviço";
    } else{
        $motivo = ", por término de $qtdeDiasDispScmtSzero ($diasExtensoDispRecoSCmt) dias de dispensa como recompensa do SCmt Btl e por estar pronto para o serviço";
    }
    return "Apresentou-se, em $dataApresentacaoFormatadaPadraoBR" . "$motivo";
    }

    public static function tratarApresentacaoCmtCia($dataApresentacaoFormatadaPadraoBR, $tipoEspecificoDeApresentacao, $cmtSUBondoso, $diasDispCmtSUSzero, $diasExtensoDispRecoCmtCia)
    {
    if ($diasDispCmtSUSzero == '1'){
    $motivo = ", por término de $diasDispCmtSUSzero ($diasExtensoDispRecoCmtCia) dia de dispensa como recompensa $cmtSUBondoso e por estar pronto para o serviço";
    } else{
    $motivo = ", por término de $diasDispCmtSUSzero ($diasExtensoDispRecoCmtCia) dias de dispensa como recompensa $cmtSUBondoso e por estar pronto para o serviço";
    }
    return "Apresentou-se, em $dataApresentacaoFormatadaPadraoBR" . "$motivo";
    }

    public static function apresentacoesDiversas($dataApresentacaoFormatadaPadraoBR, $tipoEspecificoDeApresentacao,$diasExtensoDescoFerias, $qtadadeDiasDescoFeriasSZero, $anoRefDiasDescoFerias, $diasDesistenciaTransito, $diasExtenso,$diasDesistenciaTransitoSZero)
    {
    if ($tipoEspecificoDeApresentacao === 'termDispDescoFerias'){
        if ($qtadadeDiasDescoFeriasSZero == '1'){
            $motivo = ", por término de $qtadadeDiasDescoFeriasSZero ($diasExtensoDescoFerias) dia de dispensa para desconto em férias, relativas ao ano de $anoRefDiasDescoFerias e por estar pronto para o serviço";
        } else { 
            $motivo = ", por término de $qtadadeDiasDescoFeriasSZero ($diasExtensoDescoFerias) dias de dispensa para desconto em férias, relativas ao ano de $anoRefDiasDescoFerias e por estar pronto para o serviço";
        }
    } else if ($tipoEspecificoDeApresentacao === 'termInstalacao'){
        $motivo = ", por término de Instalação e por estar pronto para o serviço";
    } else if ($tipoEspecificoDeApresentacao === 'termtransito'){
        if ($diasDesistenciaTransito == 'nenhum'){
            $motivo = ", por término de Trânsito e por estar pronto para o serviço";
        } else {
            if ($diasDesistenciaTransito == '1'){
                $motivo = ", por ter desistido de $diasDesistenciaTransitoSZero ($diasExtenso) dia de Trânsito e por estar pronto para o serviço";
            } else {
                $motivo = ", por ter desistido de $diasDesistenciaTransitoSZero ($diasExtenso) dias de Trânsito e por estar pronto para o serviço";
            }
        }
    } else if ($tipoEspecificoDeApresentacao === 'termnupcias'){
        $motivo = ", por término de núpcias e por estar pronto para o serviço";
    } else if ($tipoEspecificoDeApresentacao === 'termluto'){
        $motivo = ", por término de luto e por estar pronto para o serviço";
    }
    return "Apresentou-se, em $dataApresentacaoFormatadaPadraoBR". "$motivo"; 
    }
}