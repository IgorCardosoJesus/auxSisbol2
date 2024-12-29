<?php
namespace Igor\Projeto\funcoes;
use Igor\Projeto\funcoes\Formatacoes;

class InclusaoPlanFerias{
    

    public static function processarDados ($tipoEspecificoInclusaoPlanFerias){

        $anoFeriasInclusao = $_POST['AnoFeriasInclusao'];
        
        if ($anoFeriasInclusao == 'null'){
            return "Você não selecionou o ano da inclusão das férias..";
        }
    
        if ($tipoEspecificoInclusaoPlanFerias === 'inclusaoFerias30Dias')
        {
            $dataInclusao = $_POST['data_inicio_inclusaoFerias30Dias'];

            if (!$dataInclusao){
                return "Você não selecionou a data de início dos 30 dias corridos..";
            }

            $dataInclusaoFormatadoPadraoOM = Formatacoes::formatadordeData($dataInclusao);

            $dataTerminoFerias = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataInclusao), '29'));

            $dataApresentacaoFerias = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataInclusao), '30'));


            $dadosTratadosRefFuncoesTransitorias = InclusaoPlanFerias::trintaDiasSeguidos($anoFeriasInclusao, $dataInclusaoFormatadoPadraoOM, $dataTerminoFerias, $dataApresentacaoFerias);
    
        } elseif ($tipoEspecificoInclusaoPlanFerias === 'inclusaoFerias2x15Dias')
        {
            $dataInclusao1D15 = $_POST['data_inicio1_inclusaoFerias2x15Dias'];

            $dataInclusao1D15FormatadoPadraoOM = Formatacoes::formatadordeData($dataInclusao1D15);

            $dataTerminoFerias1D15 = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataInclusao1D15), '14'));

            $dataApresentacaoFerias1D15 = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataInclusao1D15), '15'));

            $dataInclusao2D15 = $_POST['data_inicio2_inclusaoFerias2x15Dias'];

            $dataInclusao2D15FormatadoPadraoOM = Formatacoes::formatadordeData($dataInclusao2D15);

            $dataTerminoFerias2D15 = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataInclusao2D15), '14'));

            $dataApresentacaoFerias2D15 = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataInclusao2D15), '15'));

            if (!$dataInclusao1D15 || !$dataInclusao2D15){
                return "Você não selecionou a data de início de um dos períodos de 15 dias..";
            }

            $dadosTratadosRefFuncoesTransitorias = InclusaoPlanFerias::duasDeQuinze($anoFeriasInclusao, $dataInclusao1D15FormatadoPadraoOM, $dataTerminoFerias1D15, $dataApresentacaoFerias1D15, $dataInclusao2D15FormatadoPadraoOM, $dataTerminoFerias2D15, $dataApresentacaoFerias2D15);
    

        } elseif ($tipoEspecificoInclusaoPlanFerias === 'inclusaoFerias3x10Dias')
        {
            $dataInclusao1D10 = $_POST['data_inicio1_inclusaoFerias3x10Dias'];

            $dataInclusao1D10FormatadoPadraoOM = Formatacoes::formatadordeData($dataInclusao1D10);

            $dataTerminoFerias1D10 = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataInclusao1D10), '9'));

            $dataApresentacaoFerias1D10 = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataInclusao1D10), '10'));

            $dataInclusao2D10 = $_POST['data_inicio2_inclusaoFerias3x10Dias'];

            $dataInclusao2D10FormatadoPadraoOM = Formatacoes::formatadordeData($dataInclusao2D10);

            $dataTerminoFerias2D10 = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataInclusao2D10), '9'));

            $dataApresentacaoFerias2D10 = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataInclusao2D10), '10'));

            $dataInclusao3D10 = $_POST['data_inicio3_inclusaoFerias3x10Dias'];

            $dataInclusao3D10FormatadoPadraoOM = Formatacoes::formatadordeData($dataInclusao3D10);

            $dataTerminoFerias3D10 = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataInclusao3D10), '9'));

            $dataApresentacaoFerias3D10 = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataInclusao3D10), '10'));

            if (!$dataInclusao1D10 || !$dataInclusao2D10 || !$dataInclusao3D10){
                return "Você não selecionou a data de início de um dos períodos de 10 dias..";
            }

            $dadosTratadosRefFuncoesTransitorias = InclusaoPlanFerias::tresDeDez($anoFeriasInclusao, $dataInclusao1D10FormatadoPadraoOM, $dataTerminoFerias1D10, $dataApresentacaoFerias1D10, $dataInclusao2D10FormatadoPadraoOM, $dataTerminoFerias2D10, $dataApresentacaoFerias2D10, $dataInclusao3D10FormatadoPadraoOM, $dataTerminoFerias3D10, $dataApresentacaoFerias3D10);

        }
    return $dadosTratadosRefFuncoesTransitorias;
    }

    public static function trintaDiasSeguidos($anoFeriasInclusao, $dataInclusaoFormatadoPadraoOM, $dataTerminoFerias, $dataApresentacaoFerias)
    {   
        return "Seja incluído no Plano de Férias, relativas ao ano de $anoFeriasInclusao, no período de $dataInclusaoFormatadoPadraoOM a $dataTerminoFerias, devendo se apresentar pronto para o serviço em $dataApresentacaoFerias";
    }

    public static function duasDeQuinze($anoFeriasInclusao, $dataInclusao1D15FormatadoPadraoOM, $dataTerminoFerias1D15, $dataApresentacaoFerias1D15, $dataInclusao2D15FormatadoPadraoOM, $dataTerminoFerias2D15, $dataApresentacaoFerias2D15)
    {   
        return "Seja incluído no Plano de Férias, relativas ao ano de $anoFeriasInclusao:\n- 1ª parcela de 10 dias, com início em $dataInclusao1D15FormatadoPadraoOM a $dataTerminoFerias1D15. Apresentação pronto para o serviço em $dataApresentacaoFerias1D15.\n- 2ª parcela de 10 dias, com início em $dataInclusao2D15FormatadoPadraoOM a $dataTerminoFerias2D15. Apresentação pronto para o serviço em $dataApresentacaoFerias2D15";
    }

    public static function tresDeDez($anoFeriasInclusao, $dataInclusao1D10FormatadoPadraoOM, $dataTerminoFerias1D10, $dataApresentacaoFerias1D10, $dataInclusao2D10FormatadoPadraoOM, $dataTerminoFerias2D10, $dataApresentacaoFerias2D10, $dataInclusao3D10FormatadoPadraoOM, $dataTerminoFerias3D10, $dataApresentacaoFerias3D10)
    {   
        return "Seja incluído no Plano de Férias, relativas ao ano de $anoFeriasInclusao:\n- 1ª parcela de 10 dias, com início em $dataInclusao1D10FormatadoPadraoOM a $dataTerminoFerias1D10. Apresentação pronto para o serviço em $dataApresentacaoFerias1D10.\n- 2ª parcela de 10 dias, com início em $dataInclusao2D10FormatadoPadraoOM a $dataTerminoFerias2D10. Apresentação pronto para o serviço em $dataApresentacaoFerias2D10.\n- 3ª parcela de 10 dias, com início em $dataInclusao3D10FormatadoPadraoOM a $dataTerminoFerias3D10. Apresentação pronto para o serviço em $dataApresentacaoFerias3D10";
    }

}