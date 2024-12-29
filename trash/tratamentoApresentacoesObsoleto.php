<?php
    
function tratarApresentacaoRefFerias($dataApresentacaoFormatadaPadraoBR, $tipoEspecificoDeApresentacao, $anoDaParcelaFerias)
{
    if ($tipoEspecificoDeApresentacao === 'term30dias'){
        $motivo = ", por término de 30 (trinta) dias de férias, relativas ao ano de $anoDaParcelaFerias e por estar pronto para o serviço.";
    }
    else if ($tipoEspecificoDeApresentacao === 'term1parcela15'){
        $motivo = ", por término da 1ª parcela de 15 (quinze) dias de férias, relativas ao ano de $anoDaParcelaFerias e por estar pronto para o serviço.";
    }
    else if ($tipoEspecificoDeApresentacao === 'term2parcela15'){
        $motivo = ", por término da 2ª parcela de 15 (quinze) dias de férias, relativas ao ano de $anoDaParcelaFerias e por estar pronto para o serviço.";
    }
    else if ($tipoEspecificoDeApresentacao === 'term1parcela10'){
        $motivo = ", por término da 1ª parcela de 10 (dez) dias de férias, relativas ao ano de $anoDaParcelaFerias e por estar pronto para o serviço.";
    }
    else if ($tipoEspecificoDeApresentacao === 'term2parcela10'){
        $motivo = ", por término da 2ª parcela de 10 (dez) dias de férias, relativas ao ano de $anoDaParcelaFerias e por estar pronto para o serviço.";
    }
    else if ($tipoEspecificoDeApresentacao === 'term3parcela10'){
        $motivo = ", por término da 3ª parcela de 10 (dez) dias de férias, relativas ao ano de $anoDaParcelaFerias e por estar pronto para o serviço.";
    }
    $resultado = "Apresentou-se, em $dataApresentacaoFormatadaPadraoBR" . "$motivo";
    return $resultado;
}

function tratarApresentacaoRefFuncoesBtl($dataApresentacaoFormatadaPadraoBR, $tipoEspecificoDeApresentacao, $funcao, $pelotaoOuEtc)
{
    if ($tipoEspecificoDeApresentacao === 'termTransmCargoEncargo'){
        $motivo = ", por término da transmissão de cargo e encargos de $funcao e por estar pronto para o serviço.";
    }
    else if ($tipoEspecificoDeApresentacao === 'termRecebCargoEncargo'){
        $motivo = ", por término do recebimento de cargo e encargos de $funcao e por estar pronto para o serviço.";
    }
    else if ($tipoEspecificoDeApresentacao === 'termPassCargoMaterial'){
        $motivo = ", por término da passagem de material, transmissão de encargos e valores de $funcao e por estar pronto para o serviço.";
    }
    else if ($tipoEspecificoDeApresentacao === 'termRecebCargoMaterial'){
        $motivo = ", por término da recebimento de material, de encargos e valores de $funcao e por estar pronto para o serviço.";
    }
    else if ($tipoEspecificoDeApresentacao === 'termPassMaterial'){
        $motivo = ", por término da passagem de material e transmissão de valores de $pelotaoOuEtc e por estar pronto para o serviço.";
    }
    else if ($tipoEspecificoDeApresentacao === 'termRecebMaterial'){
        $motivo = ", por término do recebimento de material e dos valores de $pelotaoOuEtc e por estar pronto para o serviço.";
    }
    return "Apresentou-se, em $dataApresentacaoFormatadaPadraoBR $motivo";
}

function tratarApresentacaoCmtBtl($dataApresentacaoFormatadaPadraoBR, $tipoEspecificoDeApresentacao, $qtdeDiasDispCmtExtenso, $qtdeDiasDispCmtSzero){
        if ($qtdeDiasDispCmtSzero == '1'){
            $motivo = ", por término de $qtdeDiasDispCmtSzero ($qtdeDiasDispCmtExtenso) dia de dispensa como recompensa do Cmt Btl e por estar pronto para o serviço.";
        } else{
            $motivo = ", por término de $qtdeDiasDispCmtSzero ($qtdeDiasDispCmtExtenso) dias de dispensa como recompensa do Cmt Btl e por estar pronto para o serviço.";
        }
        return "Apresentou-se, em $dataApresentacaoFormatadaPadraoBR" . "$motivo";
}
    
function tratarApresentacaoSubCmtBtl($dataApresentacaoFormatadaPadraoBR, $tipoEspecificoDeApresentaca, $qtdeDiasDispScmtSzero, $diasExtensoDispRecoSCmt)
{
    if ($qtdeDiasDispScmtSzero == '1'){
        $motivo = ", por término de $qtdeDiasDispScmtSzero ($diasExtensoDispRecoSCmt) dia de dispensa como recompensa do SCmt Btl e por estar pronto para o serviço.";
    } else{
        $motivo = ", por término de $qtdeDiasDispScmtSzero ($diasExtensoDispRecoSCmt) dias de dispensa como recompensa do SCmt Btl e por estar pronto para o serviço.";
    }
    return "Apresentou-se, em $dataApresentacaoFormatadaPadraoBR" . "$motivo";
}

function tratarApresentacaoCmtCia($dataApresentacaoFormatadaPadraoBR, $tipoEspecificoDeApresentacao, $cmtSUBondoso, $diasDispCmtSUSzero, $diasExtensoDispRecoCmtCia)
{
    if ($diasDispCmtSUSzero == '1'){
    $motivo = ", por término de $diasDispCmtSUSzero ($diasExtensoDispRecoCmtCia) dia de dispensa como recompensa $cmtSUBondoso e por estar pronto para o serviço.";
    } else{
    $motivo = ", por término de $diasDispCmtSUSzero ($diasExtensoDispRecoCmtCia) dias de dispensa como recompensa $cmtSUBondoso e por estar pronto para o serviço.";
    }
    return "Apresentou-se, em $dataApresentacaoFormatadaPadraoBR" . "$motivo";
}

function apresentacoesDiversas($dataApresentacaoFormatadaPadraoBR, $tipoEspecificoDeApresentacao,$diasExtensoDescoFerias, $qtadadeDiasDescoFeriasSZero, $anoRefDiasDescoFerias, $diasDesistenciaTransito, $diasExtenso,$diasDesistenciaTransitoSZero)
{
    if ($tipoEspecificoDeApresentacao === 'termDispDescoFerias'){
        if ($qtadadeDiasDescoFeriasSZero == '1'){
            $motivo = ", por término de $qtadadeDiasDescoFeriasSZero ($diasExtensoDescoFerias) dia para Desconto em Férias, relativas ao ano de $anoRefDiasDescoFerias e por estar pronto para o serviço.";
        } else { 
            $motivo = ", por término de $qtadadeDiasDescoFeriasSZero ($diasExtensoDescoFerias) dias para Desconto em Férias, relativas ao ano de $anoRefDiasDescoFerias e por estar pronto para o serviço.";
        }
    } else if ($tipoEspecificoDeApresentacao === 'termInstalacao'){
        $motivo = ", por término de Instalação e por estar pronto para o serviço.";
    } else if ($tipoEspecificoDeApresentacao === 'termtransito'){
        if ($diasDesistenciaTransito == 'nenhum'){
            $motivo = ", por término de Trânsito e por estar pronto para o serviço.";
        } else {
            if ($diasDesistenciaTransito == '1'){
                $motivo = ", por ter desistido de $diasDesistenciaTransitoSZero ($diasExtenso) dia de Trânsito e por estar pronto para o serviço.";
            } else {
                $motivo = ", por ter desistido de $diasDesistenciaTransitoSZero ($diasExtenso) dias de Trânsito e por estar pronto para o serviço.";
            }
        }
    } else if ($tipoEspecificoDeApresentacao === 'termnupcias'){
        $motivo = ", por término de Núpcias e por estar pronto para o serviço.";
    }
    return "Apresentou-se, em $dataApresentacaoFormatadaPadraoBR". "$motivo"; 
}
