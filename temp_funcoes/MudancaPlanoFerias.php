<?php
namespace Igor\Projeto\funcoes;
use Igor\Projeto\funcoes\Formatacoes;

class MudancaPlanoFerias{

    //REESTRUTURAR TUDÃO, SÓ DEIXEI PRONTO O BASIC
    public static function processarDados ($tipoEspecificoMudancaPlanoFerias){

        $anoDeReferencia = $_POST['anoFeriasMudanca']; 
        $nrDIExSolicitacao = $_POST['nrDiexSolicitacao'];
        $nrNupEb = $_POST['nrNUP'];
        $dataDoDIExFormatada = Formatacoes::formatadordeData($_POST['data_do_DIEx']);
        $quemSolicitouMudanca = $_POST['solicitanteMudanca'];
        
        if ( $quemSolicitouMudanca == 'null'){
            return "Você não selecionou quem foi o solicitante da mudança..";
        } 
    
        if ($tipoEspecificoMudancaPlanoFerias === 'mudancaParcelaUnica30P30-UMAPARCD10-UMAPARCD15')
        {
            $parcelaFerias = $_POST['mudarDiaParc301510'];
            $dataPublicada = $_POST['data_publicada_mudanca_dia'];
            $dataSolicitada = $_POST['data_solicitada_mudanca_dia'];
            if ($parcelaFerias == 'null' || $dataPublicada == 'null' || $dataSolicitada == 'null'){
                return "Preencha novamente o formulário e inclua todas as informações requeridas..";
            }

            $dadosTratadosRefMudancaNoPlanoDeFerias = MudancaPlanoFerias::tratarmudancaParcelaUnica(
            $anoDeReferencia,
            $nrDIExSolicitacao,
            $nrNupEb,
            $dataDoDIExFormatada,
            $quemSolicitouMudanca,
            $parcelaFerias,
            $dataPublicada,
            $dataSolicitada
            );
    
        } elseif ($tipoEspecificoMudancaPlanoFerias === 'mudancaParcelaUnica30P2D15')
        {
            $dataPublicada = $_POST['data_publicada_mudanca_PF30_2D15'];

            $dataSolicitada1 = $_POST['data_solicitada_mudanca_PF30_2D15-1'];
            $dataSolicitada2 = $_POST['data_solicitada_mudanca_PF30_2D15-2'];

            $dadosTratadosRefMudancaNoPlanoDeFerias = MudancaPlanoFerias::tratarmudancaParcelaUnica30P2D15(
            $anoDeReferencia,
            $nrDIExSolicitacao,
            $nrNupEb,
            $dataDoDIExFormatada,
            $quemSolicitouMudanca,
            $dataPublicada,
            $dataSolicitada1,
            $dataSolicitada2
            );
        } elseif ($tipoEspecificoMudancaPlanoFerias === 'mudanca30P3D10')
        {
            $dataPublicada = $_POST['data_publicada_PF30_3D10'];

            $dataSolicitada1 = $_POST['data_solicitada_PF30_3D10_1'];
            $dataSolicitada2 = $_POST['data_solicitada_PF30_3D10_2'];
            $dataSolicitada3 = $_POST['data_solicitada_PF30_3D10_3'];

            $dadosTratadosRefMudancaNoPlanoDeFerias = MudancaPlanoFerias::tratarmudancaParcelaUnica30P3D10(
            $anoDeReferencia,
            $nrDIExSolicitacao,
            $nrNupEb,
            $dataDoDIExFormatada,
            $quemSolicitouMudanca,
            $dataPublicada,
            $dataSolicitada1,
            $dataSolicitada2,
            $dataSolicitada3
            );
    
        } elseif ($tipoEspecificoMudancaPlanoFerias === 'mudanca2D15P30')
        {
            $dataPublicada = $_POST['data_publicada_mudanca_PF2D15_30-1'];
            $dataPublicada2 = $_POST['data_mudanca_PF2D15_30-2'];

            $dataSolicitada = $_POST['data_solicitada_mudanca_PF2D15_30'];

            $dadosTratadosRefMudancaNoPlanoDeFerias = MudancaPlanoFerias::tratarmudancaPF2D15_30(
            $anoDeReferencia,
            $nrDIExSolicitacao,
            $nrNupEb,
            $dataDoDIExFormatada,
            $quemSolicitouMudanca,
            $dataPublicada,
            $dataPublicada2,
            $dataSolicitada
            );
        } elseif ($tipoEspecificoMudancaPlanoFerias === 'mudanca2D15P2D15DIFF')
        {
            $dataPublicada = $_POST['data_publicada_PF2D15_2D15DIFF-1'];
            $dataPublicada2 = $_POST['data_publicada_PF2D15_2D15DIFF-2'];

            $dataSolicitada = $_POST['data_solicitada_PF2D15_2D15DIFF-1'];
            $dataSolicitada2 = $_POST['data_solicitada_PF2D15_2D15DIFF-2'];

            $dadosTratadosRefMudancaNoPlanoDeFerias = MudancaPlanoFerias::tratarmudanca2D15P2D15DIFF(
            $anoDeReferencia,
            $nrDIExSolicitacao,
            $nrNupEb,
            $dataDoDIExFormatada,
            $quemSolicitouMudanca,
            $dataPublicada,
            $dataPublicada2,
            $dataSolicitada,
            $dataSolicitada2
            );
        } elseif ($tipoEspecificoMudancaPlanoFerias === 'mudanca3D10P30')
        {
            $dataPublicada = $_POST['data_publicada_PF3D10_1'];
            $dataPublicada2 = $_POST['data_publicada_PF3D10_2'];
            $dataPublicada3 = $_POST['data_publicada_PF3D10_3'];

            $dataSolicitada = $_POST['data_solicitada_PF3D10_30'];

            $dadosTratadosRefMudancaNoPlanoDeFerias = MudancaPlanoFerias::tratarmudanca3D10P30(
            $anoDeReferencia,
            $nrDIExSolicitacao,
            $nrNupEb,
            $dataDoDIExFormatada,
            $quemSolicitouMudanca,
            $dataPublicada,
            $dataPublicada2,
            $dataPublicada3,
            $dataSolicitada
            );
        } elseif ($tipoEspecificoMudancaPlanoFerias === 'mudanca3D10P3D10DIFF')
        {
            $dataPublicada = $_POST['data_publicada_PF3D10_1'];
            $dataPublicada2 = $_POST['data_publicada_PF3D10_2'];
            $dataPublicada3 = $_POST['data_publicada_PF3D10_3'];

            $dataSolicitada = $_POST['data_solicitada_PF3D10_1'];
            $dataSolicitada2 = $_POST['data_solicitada_PF3D10_2'];
            $dataSolicitada3 = $_POST['data_solicitada_PF3D10_3'];

            $dadosTratadosRefMudancaNoPlanoDeFerias = MudancaPlanoFerias::tratarmudanca3D10P3D10DIF(
            $anoDeReferencia,
            $nrDIExSolicitacao,
            $nrNupEb,
            $dataDoDIExFormatada,
            $quemSolicitouMudanca,
            $dataPublicada,
            $dataPublicada2,
            $dataPublicada3,
            $dataSolicitada,
            $dataSolicitada2,
            $dataSolicitada3
            );
        } elseif ($tipoEspecificoMudancaPlanoFerias === 'mudanca2D15_3D10')
        {
            $dataPublicada = $_POST['data_publicada_PF2D15_3D10_1'];
            $dataPublicada2 = $_POST['data_publicada_PF2D15_3D10_2'];

            $dataSolicitada = $_POST['data_solicitada_PF2D15_3D10_1'];
            $dataSolicitada2 = $_POST['data_solicitada_PF2D15_3D10_2'];
            $dataSolicitada3 = $_POST['data_solicitada_PF2D15_3D10_3'];

            $dadosTratadosRefMudancaNoPlanoDeFerias = MudancaPlanoFerias::tratarmudanca2D15_3D10(
            $anoDeReferencia,
            $nrDIExSolicitacao,
            $nrNupEb,
            $dataDoDIExFormatada,
            $quemSolicitouMudanca,
            $dataPublicada,
            $dataPublicada2,
            $dataSolicitada,
            $dataSolicitada2,
            $dataSolicitada3
            );
        }

        return $dadosTratadosRefMudancaNoPlanoDeFerias;
    }
    public static function tratarmudancaParcelaUnica(
        $anoDeReferencia,
        $nrDIExSolicitacao,
        $nrNupEb,
        $dataDoDIExFormatada,
        $quemSolicitouMudanca,
        $parcelaFerias,
        $dataPublicada,
        $dataSolicitada
    )
    {
    if ($parcelaFerias == "Parcela Única"){
        $dataApresentParaDataPublicada = Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataPublicada), '29');
        $dataAprsFormatada = Formatacoes::formatadordeData($dataApresentParaDataPublicada);
        $dataPublicada = Formatacoes::formatadordeData($dataPublicada);

        $ultimoDiaParaDataSolicitada = Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataSolicitada), '29');
        $dataApresentacaoParaDataSolicitada = Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataSolicitada), '30');
        $dataSolicitada = Formatacoes::formatadordeData($dataSolicitada);
        $UltimoDiaParaDataSolicitada = Formatacoes::formatadordeData($ultimoDiaParaDataSolicitada);
        $ApresentParaDataSolicitada = Formatacoes::formatadordeData($dataApresentacaoParaDataSolicitada);

        return "O $quemSolicitouMudanca solicitou a este Cmdo a mudança do período de férias, relativas ao ano de $anoDeReferencia, de $dataPublicada a $dataAprsFormatada para $dataSolicitada a $UltimoDiaParaDataSolicitada, devendo se apresentar pronto para o serviço em $ApresentParaDataSolicitada, por necessidade do serviço.\n(Solu DIEx Nº $nrDIExSolicitacao, EB: $nrNupEb, de $dataDoDIExFormatada, do $quemSolicitouMudanca)";

    } elseif ($parcelaFerias == 'da 1ª parcela de 15 (quinze) dias de férias' || $parcelaFerias == 'da 2ª parcela de 15 (quinze) dias de férias') 
    {
        $dataApresentParaDataPublicada = Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataPublicada), '14');
        $dataAprsFormatada = Formatacoes::formatadordeData($dataApresentParaDataPublicada);
        $dataPublicada = Formatacoes::formatadordeData($dataPublicada);

        $ultimoDiaParaDataSolicitada = Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataSolicitada), '14');
        $dataApresentacaoParaDataSolicitada = Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataSolicitada), '15');
        $dataSolicitada = Formatacoes::formatadordeData($dataSolicitada);
        $UltimoDiaParaDataSolicitada = Formatacoes::formatadordeData($ultimoDiaParaDataSolicitada);
        $ApresentParaDataSolicitada = Formatacoes::formatadordeData($dataApresentacaoParaDataSolicitada);

        return "O $quemSolicitouMudanca solicitou a este Cmdo a mudança do período de férias, relativas ao ano de $anoDeReferencia, de $dataPublicada a $dataAprsFormatada para $dataSolicitada a $UltimoDiaParaDataSolicitada, devendo se apresentar pronto para o serviço em $ApresentParaDataSolicitada, por necessidade do serviço.\n(Solu DIEx Nº $nrDIExSolicitacao, EB: $nrNupEb, de $dataDoDIExFormatada, do $quemSolicitouMudanca)";
    } else
    {
        $dataApresentParaDataPublicada = Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataPublicada), '9');
        $dataAprsFormatada = Formatacoes::formatadordeData($dataApresentParaDataPublicada);
        $dataPublicada = Formatacoes::formatadordeData($dataPublicada);

        $ultimoDiaParaDataSolicitada = Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataSolicitada), '9');
        $dataApresentacaoParaDataSolicitada = Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataSolicitada), '10');
        $dataSolicitada = Formatacoes::formatadordeData($dataSolicitada);
        $UltimoDiaParaDataSolicitada = Formatacoes::formatadordeData($ultimoDiaParaDataSolicitada);
        $ApresentParaDataSolicitada = Formatacoes::formatadordeData($dataApresentacaoParaDataSolicitada);

        return "O $quemSolicitouMudanca solicitou a este Cmdo a mudança do período de férias, relativas ao ano de $anoDeReferencia, de $dataPublicada a $dataAprsFormatada para $dataSolicitada a $UltimoDiaParaDataSolicitada, devendo se apresentar pronto para o serviço em $ApresentParaDataSolicitada, por necessidade do serviço.\n(Solu DIEx Nº $nrDIExSolicitacao, EB: $nrNupEb, de $dataDoDIExFormatada, do $quemSolicitouMudanca)";
    }   
    }

    public static function tratarmudancaParcelaUnica30P2D15(
        $anoDeReferencia,
        $nrDIExSolicitacao,
        $nrNupEb,
        $dataDoDIExFormatada,
        $quemSolicitouMudanca,
        $dataPublicada,
        $dataSolicitada1,
        $dataSolicitada2
    )
    {
        $ultimoDiaParaDataPublicadaFormatado = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataPublicada), '29'));
        $dataPublicada = Formatacoes::formatadordeData($dataPublicada);

        $ultimoDiaParaDataSolicitada1 = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataSolicitada1), '14'));
        $dataApresentacaoParaDataSolicitada1 = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataSolicitada1), '15'));
        $dataSolicitada1 = Formatacoes::formatadordeData($dataSolicitada1);

        $ultimoDiaParaDataSolicitada2 = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataSolicitada2), '14'));
        $dataApresentacaoParaDataSolicitada2 = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataSolicitada2), '15'));
        $dataSolicitada2 = Formatacoes::formatadordeData($dataSolicitada2);


        return "O $quemSolicitouMudanca solicitou a este Cmdo a mudança do período de férias, relativas ao ano de $anoDeReferencia, de $dataPublicada a $ultimoDiaParaDataPublicadaFormatado para 2 (duas) parcelas de 15 (quinze) dias, sendo a 1ª parcela em $dataSolicitada1 a $ultimoDiaParaDataSolicitada1, pronto em $dataApresentacaoParaDataSolicitada1, e a 2ª parcela em $dataSolicitada2 a $ultimoDiaParaDataSolicitada2, pronto em $dataApresentacaoParaDataSolicitada2, por necessidade do serviço.\n(Solu DIEx Nº $nrDIExSolicitacao, EB: $nrNupEb, de $dataDoDIExFormatada, do $quemSolicitouMudanca)";

    }
    public static function tratarmudancaParcelaUnica30P3D10(
        $anoDeReferencia,
        $nrDIExSolicitacao,
        $nrNupEb,
        $dataDoDIExFormatada,
        $quemSolicitouMudanca,
        $dataPublicada,
        $dataSolicitada1,
        $dataSolicitada2,
        $dataSolicitada3
    )
    {
        $ultimoDiaParaDataPublicadaFormatado = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataPublicada), '29'));
        $dataPublicada = Formatacoes::formatadordeData($dataPublicada);

        $ultimoDiaParaDataSolicitada1 = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataSolicitada1), '9'));
        $dataApresentacaoParaDataSolicitada1 = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataSolicitada1), '10'));
        $dataSolicitada1 = Formatacoes::formatadordeData($dataSolicitada1);

        $ultimoDiaParaDataSolicitada2 = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataSolicitada2), '9'));
        $dataApresentacaoParaDataSolicitada2 = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataSolicitada2), '10'));
        $dataSolicitada2 = Formatacoes::formatadordeData($dataSolicitada2);

        $ultimoDiaParaDataSolicitada3 = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataSolicitada3), '9'));
        $dataApresentacaoParaDataSolicitada3 = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataSolicitada3), '10'));
        $dataSolicitada3 = Formatacoes::formatadordeData($dataSolicitada3);


        return "O $quemSolicitouMudanca solicitou a este Cmdo a mudança do período de férias, relativas ao ano de $anoDeReferencia, de $dataPublicada a $ultimoDiaParaDataPublicadaFormatado para 3 (trêS) parcelas de 10 (dez) dias, sendo a 1ª parcela em $dataSolicitada1 a $ultimoDiaParaDataSolicitada1, pronto em $dataApresentacaoParaDataSolicitada1, a 2ª parcela em $dataSolicitada2 a $ultimoDiaParaDataSolicitada2, pronto em $dataApresentacaoParaDataSolicitada2, e a 3ª parcela em $dataSolicitada3 a $ultimoDiaParaDataSolicitada3, pronto em $dataApresentacaoParaDataSolicitada3, por necessidade do serviço.\n(Solu DIEx Nº $nrDIExSolicitacao, EB: $nrNupEb, de $dataDoDIExFormatada, do $quemSolicitouMudanca)";

    }

    public static function tratarmudancaPF2D15_30(
        $anoDeReferencia,
        $nrDIExSolicitacao,
        $nrNupEb,
        $dataDoDIExFormatada,
        $quemSolicitouMudanca,
        $dataPublicada,
        $dataPublicada2,
        $dataSolicitada
    )
    {
        $ultimoDiaParaDataPublicadaFormatado = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataPublicada), '14'));
        $dataPublicada = Formatacoes::formatadordeData($dataPublicada);

        $ultimoDiaParaSegundaDataPublicadaFormatado = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataPublicada2), '14'));
        $dataPublicada2 = Formatacoes::formatadordeData($dataPublicada2);

        $ultimoDiaParaDataSolicitada = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataSolicitada), '29'));
        $dataApresentacaoParaDataSolicitada = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataSolicitada), '30'));
        $dataSolicitada = Formatacoes::formatadordeData($dataSolicitada);


        return "O $quemSolicitouMudanca solicitou a este Cmdo a mudança das 02 (duas) parcelas de 15 dias de férias, relativas ao ano de $anoDeReferencia, sendo a 1ª parcela de 15 (quinze) dias, de $dataPublicada a $ultimoDiaParaDataPublicadaFormatado e a 2ª parcela de 15 (quinze) dias de férias, de $dataPublicada2 a $ultimoDiaParaSegundaDataPublicadaFormatado, para 1 (uma) parcela única de 30 (trinta) dias, de $dataSolicitada a $ultimoDiaParaDataSolicitada, pronto em $$dataApresentacaoParaDataSolicitada, por necessidade do serviço.\n(Solu DIEx Nº $nrDIExSolicitacao, EB: $nrNupEb, de $dataDoDIExFormatada, do $quemSolicitouMudanca)";

    }
    public static function tratarmudanca2D15P2D15DIFF(
        $anoDeReferencia,
        $nrDIExSolicitacao,
        $nrNupEb,
        $dataDoDIExFormatada,
        $quemSolicitouMudanca,
        $dataPublicada,
        $dataPublicada2,
        $dataSolicitada,
        $dataSolicitada2
    )
    {
        $ultimoDiaParaDataPublicadaFormatado = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataPublicada), '14'));
        $dataPublicada = Formatacoes::formatadordeData($dataPublicada);

        $ultimoDiaParaDataPublicada2Formatado = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataPublicada2), '14'));
        $dataPublicada2 = Formatacoes::formatadordeData($dataPublicada2);

        $ultimoDiaParaDataSolicitada = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataSolicitada), '14'));
        $dataApresentacaoParaDataSolicitada = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataSolicitada), '15'));
        $dataSolicitada = Formatacoes::formatadordeData($dataSolicitada);

        $ultimoDiaParaDataSolicitada2 = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataSolicitada2), '14'));
        $dataApresentacaoParaDataSolicitada2 = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataSolicitada2), '15'));
        $dataSolicitada2 = Formatacoes::formatadordeData($dataSolicitada2);


        return "O $quemSolicitouMudanca solicitou a este Cmdo a mudança das 02 (duas) parcelas de 15 (quinze) dias de férias, relativas ao ano de $anoDeReferencia, sendo a 1ª parcela de 15 (quinze) dias, de $dataPublicada a $ultimoDiaParaDataPublicadaFormatado, para $dataSolicitada a $ultimoDiaParaDataSolicitada, devendo se apresentar pronto para o serviço em $dataApresentacaoParaDataSolicitada e a 2ª parcela de 15 (quinze) dias, de $dataPublicada2 a $ultimoDiaParaDataPublicada2Formatado, para $dataSolicitada2 a $ultimoDiaParaDataSolicitada2, devendo se apresentar pronto para o serviço em $dataApresentacaoParaDataSolicitada2, por necessidade do serviço.\n(Solu DIEx Nº $nrDIExSolicitacao, EB: $nrNupEb, de $dataDoDIExFormatada, do $quemSolicitouMudanca)";

    }
    public static function tratarmudanca3D10P30(
        $anoDeReferencia,
        $nrDIExSolicitacao,
        $nrNupEb,
        $dataDoDIExFormatada,
        $quemSolicitouMudanca,
        $dataPublicada,
        $dataPublicada2,
        $dataPublicada3,
        $dataSolicitada
    )
    {
        $ultimoDiaParaDataPublicadaFormatado = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataPublicada), '9'));
        $dataPublicada = Formatacoes::formatadordeData($dataPublicada);

        $ultimoDiaParaDataPublicada2Formatado = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataPublicada2), '9'));
        $dataPublicada2 = Formatacoes::formatadordeData($dataPublicada2);

        $ultimoDiaParaDataPublicada3Formatado = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataPublicada3), '9'));
        $dataPublicada3 = Formatacoes::formatadordeData($dataPublicada3);

        $ultimoDiaParaDataSolicitada = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataSolicitada), '29'));
        $dataApresentacaoParaDataSolicitada = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataSolicitada), '30'));
        $dataSolicitada = Formatacoes::formatadordeData($dataSolicitada);

        return "O $quemSolicitouMudanca solicitou a este Cmdo a mudança do período de férias, relativas ao ano de $anoDeReferencia, de 3 (trêS) parcelas de 10 (dez) dias, sendo a 1ª parcela em $dataPublicada a $ultimoDiaParaDataPublicadaFormatado, a 2ª parcela em $dataPublicada2 a $ultimoDiaParaDataPublicada2Formatado e a 3ª parcela em $dataPublicada3 a $ultimoDiaParaDataPublicada3Formatado, para 1 (uma) parcela única de 30 (trinta) dias, de $dataSolicitada a $ultimoDiaParaDataSolicitada, pronto em $dataApresentacaoParaDataSolicitada, por necessidade do serviço.\n(Solu DIEx Nº $nrDIExSolicitacao, EB: $nrNupEb, de $dataDoDIExFormatada, do $quemSolicitouMudanca)";

    }

    public static function tratarmudanca3D10P3D10DIF(
        $anoDeReferencia,
        $nrDIExSolicitacao,
        $nrNupEb,
        $dataDoDIExFormatada,
        $quemSolicitouMudanca,
        $dataPublicada,
        $dataPublicada2,
        $dataPublicada3,
        $dataSolicitada,
        $dataSolicitada2,
        $dataSolicitada3
    )
    {
        $ultimoDiaParaDataPublicadaFormatado = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataPublicada), '9'));
        $dataPublicada = Formatacoes::formatadordeData($dataPublicada);

        $ultimoDiaParaDataPublicada2Formatado = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataPublicada2), '9'));
        $dataPublicada2 = Formatacoes::formatadordeData($dataPublicada2);

        $ultimoDiaParaDataPublicada3Formatado = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataPublicada3), '9'));
        $dataPublicada3 = Formatacoes::formatadordeData($dataPublicada3);

        $ultimoDiaParaDataSolicitada = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataSolicitada), '9'));
        $dataApresentacaoParaDataSolicitada = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataSolicitada), '10'));
        $dataSolicitada = Formatacoes::formatadordeData($dataSolicitada);

        $ultimoDiaParaDataSolicitada2 = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataSolicitada2), '9'));
        $dataApresentacaoParaDataSolicitada2 = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataSolicitada2), '10'));
        $dataSolicitada2 = Formatacoes::formatadordeData($dataSolicitada2);

        $ultimoDiaParaDataSolicitada3 = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataSolicitada3), '9'));
        $dataApresentacaoParaDataSolicitada3 = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataSolicitada3), '10'));
        $dataSolicitada3 = Formatacoes::formatadordeData($dataSolicitada3);

        return "O $quemSolicitouMudanca solicitou a este Cmdo a mudança do período de férias, relativas ao ano de $anoDeReferencia, sendo a 1ª parcela em $dataPublicada a $ultimoDiaParaDataPublicadaFormatado, para $dataSolicitada a $ultimoDiaParaDataSolicitada, pronto em $dataApresentacaoParaDataSolicitada, a 2ª parcela em $dataPublicada2 a $ultimoDiaParaDataPublicada2Formatado para $dataSolicitada2 a $ultimoDiaParaDataSolicitada2, pronto em $dataApresentacaoParaDataSolicitada2, e a 3ª parcela em $dataPublicada3 a $ultimoDiaParaDataPublicada3Formatado, para $dataSolicitada3 a $ultimoDiaParaDataSolicitada3, pronto em $dataApresentacaoParaDataSolicitada3, por necessidade do serviço.\n(Solu DIEx Nº $nrDIExSolicitacao, EB: $nrNupEb, de $dataDoDIExFormatada, do $quemSolicitouMudanca)";

    }

    public static function tratarmudanca2D15_3D10(
        $anoDeReferencia,
        $nrDIExSolicitacao,
        $nrNupEb,
        $dataDoDIExFormatada,
        $quemSolicitouMudanca,
        $dataPublicada,
        $dataPublicada2,
        $dataSolicitada,
        $dataSolicitada2,
        $dataSolicitada3
    )
    {
        $ultimoDiaParaDataPublicadaFormatado = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataPublicada), '14'));
        $dataPublicada = Formatacoes::formatadordeData($dataPublicada);

        $ultimoDiaParaDataPublicada2Formatado = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataPublicada2), '14'));
        $dataPublicada2 = Formatacoes::formatadordeData($dataPublicada2);
        
        $ultimoDiaParaDataSolicitada = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataSolicitada), '9'));
        $dataApresentacaoParaDataSolicitada = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataSolicitada), '10'));
        $dataSolicitada = Formatacoes::formatadordeData($dataSolicitada);

        $ultimoDiaParaDataSolicitada2 = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataSolicitada2), '9'));
        $dataApresentacaoParaDataSolicitada2 = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataSolicitada2), '10'));
        $dataSolicitada2 = Formatacoes::formatadordeData($dataSolicitada2);

        $ultimoDiaParaDataSolicitada3 = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataSolicitada3), '9'));
        $dataApresentacaoParaDataSolicitada3 = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataSolicitada3), '10'));
        $dataSolicitada3 = Formatacoes::formatadordeData($dataSolicitada3);

        return "O $quemSolicitouMudanca solicitou a este Cmdo a mudança do período de férias, relativas ao ano de $anoDeReferencia, das duas parcelas de 15 (quinze) dias, sendo a 1ª parcela de 15 (quinze) dias de $dataPublicada a $ultimoDiaParaDataPublicadaFormatado e a 2ª parcela de $dataPublicada2 a $ultimoDiaParaDataPublicada2Formatado para 3 (três) parcelas de 10 (dez) dias, sendo a 1ª parcela de $dataSolicitada a $ultimoDiaParaDataSolicitada, pronto em $dataApresentacaoParaDataSolicitada, a 2ª parcela de $dataSolicitada2 a $ultimoDiaParaDataSolicitada2, pronto em $dataApresentacaoParaDataSolicitada2 e a 3ª parcela de $dataSolicitada3 a $ultimoDiaParaDataSolicitada3, pronto em $dataApresentacaoParaDataSolicitada3, por necessidade do serviço.\n(Solu DIEx Nº $nrDIExSolicitacao, EB: $nrNupEb, de $dataDoDIExFormatada, do $quemSolicitouMudanca)";

    }

}

