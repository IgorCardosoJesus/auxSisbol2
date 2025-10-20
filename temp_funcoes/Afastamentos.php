<?php
namespace Igor\Projeto\funcoes;
use Igor\Projeto\funcoes\Formatacoes;

class Afastamentos{
    

    public static function processarDados ($tipoEspecificoDoAfastamento){
    
        if ($tipoEspecificoDoAfastamento === 'ferias30dias' || $tipoEspecificoDoAfastamento === 'ferias1parcela15' ||
        $tipoEspecificoDoAfastamento === 'ferias2parcela15' || $tipoEspecificoDoAfastamento === 'ferias1parcela10'||
        $tipoEspecificoDoAfastamento === 'ferias2parcela10' || $tipoEspecificoDoAfastamento === 'ferias3parcela10'){

            $anoFerias = $_POST['anoFerias'];

            $dataInicioFeriasDesformatado = $_POST['data_inicio_ferias']; 
        
            $aPartirOuAcontar = Formatacoes::ApartirOuAcontar($dataInicioFeriasDesformatado);
    
            $dataInicioFeriasFormatadoPadraoOM = Formatacoes::formatadordeData($dataInicioFeriasDesformatado);

            if ($tipoEspecificoDoAfastamento === 'ferias30dias')
            {
                $dataApresentacaoFerias = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataInicioFeriasDesformatado), '30'));

                $dadosTratadosRefConcessaoAfastamento = Afastamentos::trintaDiasSeguidos(
                $anoFerias,
                $dataInicioFeriasFormatadoPadraoOM,
                $aPartirOuAcontar,
                $dataApresentacaoFerias);
        
            } elseif ($tipoEspecificoDoAfastamento === 'ferias1parcela15' || $tipoEspecificoDoAfastamento === 'ferias2parcela15')
            {
                $dataApresentacaoFerias15 = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataInicioFeriasDesformatado), '15'));

                $dadosTratadosRefConcessaoAfastamento = Afastamentos::umaParcelaDeQuinze(
                $anoFerias,
                $dataInicioFeriasFormatadoPadraoOM,
                $aPartirOuAcontar,
                $dataApresentacaoFerias15,
                $tipoEspecificoDoAfastamento);
            } elseif ($tipoEspecificoDoAfastamento === 'ferias1parcela10' || $tipoEspecificoDoAfastamento === 'ferias2parcela10' || $tipoEspecificoDoAfastamento === 'ferias3parcela10')
            {
                $dataApresentacaoFerias15 = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataInicioFeriasDesformatado), '10'));

                $dadosTratadosRefConcessaoAfastamento = Afastamentos::umaParcelaDeDEZ(
                $anoFerias,
                $dataInicioFeriasFormatadoPadraoOM,
                $aPartirOuAcontar,
                $dataApresentacaoFerias15,
                $tipoEspecificoDoAfastamento);
            } 
        }

        if ($tipoEspecificoDoAfastamento === 'feriasDiasRestantes'){
            
            $anoFerias = $_POST['anoFeriasRestantes'];
            $quantidadeDeDiasRestantes = $_POST['qtdeDiasRest'];
            $quantidadeDeDiasRestantesPorEXTENSO = Formatacoes::numeroEmExtenso($quantidadeDeDiasRestantes);
            $dataInicioFeriasRestantesDesform = $_POST['data_inicio_ferias_restantes'];
            $dataApresentacaoFeriasRestantes = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataInicioFeriasRestantesDesform), $quantidadeDeDiasRestantes));
        
            $aPartirOuAcontar = Formatacoes::ApartirOuAcontar($dataInicioFeriasRestantesDesform);
    
            $dataInicioFeriasFormatadoPadraoOM = Formatacoes::formatadordeData($dataInicioFeriasRestantesDesform);

            $dadosTratadosRefConcessaoAfastamento = Afastamentos::diasRestantes(
            $quantidadeDeDiasRestantes,
            $quantidadeDeDiasRestantesPorEXTENSO,
            $anoFerias,
            $dataInicioFeriasFormatadoPadraoOM,
            $aPartirOuAcontar,
            $dataApresentacaoFeriasRestantes);
        }

        if ($tipoEspecificoDoAfastamento === 'dispensaCmtCia'){
            
            $quantidadeDeDiasDispReco = $_POST['numDiasDispensaCmtCia'];
            $quantidadeDeDiasDispRecoPorEXTENSO = Formatacoes::numeroEmExtenso($quantidadeDeDiasDispReco);
            $cmtSUQueDeuADispensa = $_POST['qualCmtSUBondoso'];
            $dataInicioDispRecoCmtSUDesformatadao = $_POST['data_inicio_dispensaCmtCia'];
            $dataApresentacaoDispRecoCmtSU = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataInicioDispRecoCmtSUDesformatadao), $quantidadeDeDiasDispReco));
        
            $aPartirOuAcontar = Formatacoes::ApartirOuAcontar($dataInicioDispRecoCmtSUDesformatadao);
    
            $dataInicioDispRecoCmtSUPadraoOM = Formatacoes::formatadordeData($dataInicioDispRecoCmtSUDesformatadao);

            $dadosTratadosRefConcessaoAfastamento = Afastamentos::dispRecoCMTSU(
            $quantidadeDeDiasDispReco,
            $quantidadeDeDiasDispRecoPorEXTENSO,
            $dataInicioDispRecoCmtSUPadraoOM,
            $aPartirOuAcontar,
            $dataApresentacaoDispRecoCmtSU,
            $cmtSUQueDeuADispensa);
        }

        if ($tipoEspecificoDoAfastamento === 'dispensaSCmtBtl'){
            
            $quantidadeDeDiasDispReco = $_POST['numDiasDispensaSCmtBtl'];
            $quantidadeDeDiasDispRecoPorEXTENSO = Formatacoes::numeroEmExtenso($quantidadeDeDiasDispReco);
            $dataInicioDispRecoSCmtDesformatadao = $_POST['data_inicio_dispensaSCmtBtl'];
            $dataApresentacaoDispRecoSCmt = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataInicioDispRecoSCmtDesformatadao), $quantidadeDeDiasDispReco));
        
            $aPartirOuAcontar = Formatacoes::ApartirOuAcontar($dataInicioDispRecoSCmtDesformatadao);
    
            $dataInicioDispRecoSCmtPadraoOM = Formatacoes::formatadordeData($dataInicioDispRecoSCmtDesformatadao);

            $dadosTratadosRefConcessaoAfastamento = Afastamentos::dispRecoSCMTBTL(
            $quantidadeDeDiasDispReco,
            $quantidadeDeDiasDispRecoPorEXTENSO,
            $dataInicioDispRecoSCmtPadraoOM,
            $aPartirOuAcontar,
            $dataApresentacaoDispRecoSCmt);
        }

        if ($tipoEspecificoDoAfastamento === 'dispensaCmtBtl'){
            
            $quantidadeDeDiasDispReco = $_POST['numDiasDispensaCmtBtl'];
            $quantidadeDeDiasDispRecoPorEXTENSO = Formatacoes::numeroEmExtenso($quantidadeDeDiasDispReco);
            $dataInicioDispRecoCmtBtlDesformatadao = $_POST['data_inicio_dispensaCmtBtl'];
            $dataApresentacaoDispRecoCmtBtl = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataInicioDispRecoCmtBtlDesformatadao), $quantidadeDeDiasDispReco));
        
            $aPartirOuAcontar = Formatacoes::ApartirOuAcontar($dataInicioDispRecoCmtBtlDesformatadao);
    
            $dataInicioDispRecoCmtBtlPadraoOM = Formatacoes::formatadordeData($dataInicioDispRecoCmtBtlDesformatadao);

            $dadosTratadosRefConcessaoAfastamento = Afastamentos::dispRecoCmtBtl(
            $quantidadeDeDiasDispReco,
            $quantidadeDeDiasDispRecoPorEXTENSO,
            $dataInicioDispRecoCmtBtlPadraoOM,
            $aPartirOuAcontar,
            $dataApresentacaoDispRecoCmtBtl);
        }

        if ($tipoEspecificoDoAfastamento === 'dispensa5BdaCBld'){
            
            $quantidadeDeDiasDispReco = $_POST['numDiasDispensaCmt5Bgda'];
            $quantidadeDeDiasDispRecoPorEXTENSO = Formatacoes::numeroEmExtenso($quantidadeDeDiasDispReco);
            $dataInicioDispRecoCmt5BdaDesformatadao = $_POST['data_inicio_dispensaCmt5Bgda'];
            $dataApresentacaoDispRecoCmt5Bda = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataInicioDispRecoCmt5BdaDesformatadao), $quantidadeDeDiasDispReco));
        
            $aPartirOuAcontar = Formatacoes::ApartirOuAcontar($dataInicioDispRecoCmt5BdaDesformatadao);
    
            $dataInicioDispRecoCmt5BdaPadraoOM = Formatacoes::formatadordeData($dataInicioDispRecoCmt5BdaDesformatadao);

            $dadosTratadosRefConcessaoAfastamento = Afastamentos::dispRecoCmtBda(
            $quantidadeDeDiasDispReco,
            $quantidadeDeDiasDispRecoPorEXTENSO,
            $dataInicioDispRecoCmt5BdaPadraoOM,
            $aPartirOuAcontar,
            $dataApresentacaoDispRecoCmt5Bda);
        }

        if ($tipoEspecificoDoAfastamento === 'dispensaDescontoFerias'){
            
            $quantidadeDeDiasDispPdescoFerias = $_POST['numDiasDispensaDescontoFerias'];
            $quantidadeDeDiasDispPdescoFeriasPorEXTENSO = Formatacoes::numeroEmExtenso($quantidadeDeDiasDispPdescoFerias);
            $dataInicioDispPdescoFeriasDesformatadao = $_POST['data_inicio_dispensaDescontoFerias'];
            $dataApresentacaoDispPdescoFerias = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataInicioDispPdescoFeriasDesformatadao), $quantidadeDeDiasDispPdescoFerias));

            $quantidadeDeDiasRestantesFeriasFerias = $_POST['qtdeDiasRestantesFerias'];
            $quantidadeDeDiasRestantesFeriasFeriasPorEXTENSO = Formatacoes::numeroEmExtenso($quantidadeDeDiasRestantesFeriasFerias);
            
            $anoFeriasDispDesco = $_POST['anoDispDescoFerias'];

            $aPartirOuAcontar = Formatacoes::ApartirOuAcontar($dataInicioDispPdescoFeriasDesformatadao);
    
            $dataInicioDispPdescoFeriasPadraoOM = Formatacoes::formatadordeData($dataInicioDispPdescoFeriasDesformatadao);

            $dadosTratadosRefConcessaoAfastamento = Afastamentos::dispPdescoFerias(
            $quantidadeDeDiasDispPdescoFerias,
            $quantidadeDeDiasDispPdescoFeriasPorEXTENSO,
            $dataInicioDispPdescoFeriasPadraoOM,
            $aPartirOuAcontar,
            $dataApresentacaoDispPdescoFerias,
            $quantidadeDeDiasRestantesFeriasFerias,
            $quantidadeDeDiasRestantesFeriasFeriasPorEXTENSO,
            $anoFeriasDispDesco);
        }
        
        if ($tipoEspecificoDoAfastamento === 'instalacao'){
            $solteiroOuCasado = $_POST['tipoInstalacao'];
            if ($solteiroOuCasado == "solteiro"){
                $quantidadeDeDias = "04";
            }else{
                $quantidadeDeDias = "10";
            }
            
            $dataInicioInstalacao = $_POST['data_inicio_instalacao'];

            $dataInicioInstalacaoPadraoOM = Formatacoes::formatadordeData($dataInicioInstalacao);

            $dataApresentacaoInstalacao = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataInicioInstalacao), $quantidadeDeDias));
        
            $aPartirOuAcontar = Formatacoes::ApartirOuAcontar($dataInicioInstalacao);
    
            $dadosTratadosRefConcessaoAfastamento = Afastamentos::instalacao(
            $dataInicioInstalacaoPadraoOM,
            $aPartirOuAcontar,
            $dataApresentacaoInstalacao,
            $solteiroOuCasado);

        }

        if ($tipoEspecificoDoAfastamento === 'transito'){
            $trintaDiasOuQuarentaEoitoHoras = $_POST['tipoTransito'];
            
            $dataInicioInstalacao = $_POST['data_inicio_transito'];

            $dataInicioTransitoPadraoOM = Formatacoes::formatadordeData($dataInicioInstalacao);
        
            $aPartirOuAcontar = Formatacoes::ApartirOuAcontar($dataInicioInstalacao);
    
            $dadosTratadosRefConcessaoAfastamento = Afastamentos::transito(
            $dataInicioTransitoPadraoOM,
            $aPartirOuAcontar,
            $trintaDiasOuQuarentaEoitoHoras);

        }

        if ($tipoEspecificoDoAfastamento === 'nupcias'){
            
            $dataInicioNupcias = $_POST['data_inicio_nupcias'];

            $dataInicioNupciasPadraoOM = Formatacoes::formatadordeData($dataInicioNupcias);

            $dataApresentacaoNupcias = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataInicioNupcias), 8));
        
            $aPartirOuAcontar = Formatacoes::ApartirOuAcontar($dataInicioNupcias);
    
            $dadosTratadosRefConcessaoAfastamento = Afastamentos::nupcias(
            $dataInicioNupciasPadraoOM,
            $aPartirOuAcontar,
            $dataApresentacaoNupcias);

        }

        if ($tipoEspecificoDoAfastamento === 'luto'){
            
            $dataInicioLuto = $_POST['data_inicio_luto'];

            $dataInicioLutoPadraoOM = Formatacoes::formatadordeData($dataInicioLuto);

            $dataApresentacaoLuto = Formatacoes::formatadordeData(Formatacoes::adicionarDiasEmUmaData(Formatacoes::transformarDataStringEmData($dataInicioLuto), 8));
        
            $aPartirOuAcontar = Formatacoes::ApartirOuAcontar($dataInicioLuto);
    
            $dadosTratadosRefConcessaoAfastamento = Afastamentos::luto(
            $dataInicioLutoPadraoOM,
            $aPartirOuAcontar,
            $dataApresentacaoLuto);

        }

        return $dadosTratadosRefConcessaoAfastamento;
        }
        


    
    

    public static function trintaDiasSeguidos($anoFerias, $dataInicioFeriasFormatadoPadraoOM, $aPartirOuAcontar, $dataApresentacaoFerias)
    {   
        return "Concedidos 30 (trinta) dias de férias, relativas ao ano de $anoFerias, a $aPartirOuAcontar de $dataInicioFeriasFormatadoPadraoOM, de acordo com o Art. 63, do Estatuto dos Militares (Lei Nr 6.880, de 09 DEZ 1980), combinado com o inciso XVIII, do Art. 21 e inciso I, do §1, do Art. 451, ambos do Regulamento Interno e dos Serviços Gerais (Port. Min. Nr 816, de 19 DEZ 03), devendo se apresentar pronto para o serviço em $dataApresentacaoFerias";
    }

    public static function umaParcelaDeQuinze($anoFerias, $dataInicioFeriasFormatadoPadraoOM, $aPartirOuAcontar, $dataApresentacaoFerias15, $tipoEspecificoDoAfastamento)
    {
        if ($tipoEspecificoDoAfastamento == 'ferias1parcela15'){
            return "Concedida a 1ª parcela de 15 (quinze) dias de férias, relativas ao ano de $anoFerias, a $aPartirOuAcontar de $dataInicioFeriasFormatadoPadraoOM, de acordo com o Art. 63, do Estatuto dos Militares (Lei Nr 6.880, de 09 DEZ 1980), combinado com o inciso XVIII, do Art. 21 e inciso I, do §1, do Art. 451, ambos do Regulamento Interno e dos Serviços Gerais (Port. Min. Nr 816, de 19 DEZ 03), devendo se apresentar pronto para o serviço em $dataApresentacaoFerias15";
        } else {
            return "Concedida a 2ª parcela de 15 (quinze) dias de férias, relativas ao ano de $anoFerias, a $aPartirOuAcontar de $dataInicioFeriasFormatadoPadraoOM, de acordo com o Art. 63, do Estatuto dos Militares (Lei Nr 6.880, de 09 DEZ 1980), combinado com o inciso XVIII, do Art. 21 e inciso I, do §1, do Art. 451, ambos do Regulamento Interno e dos Serviços Gerais (Port. Min. Nr 816, de 19 DEZ 03), devendo se apresentar pronto para o serviço em $dataApresentacaoFerias15";
        }
    }

    public static function umaParcelaDeDEZ($anoFerias, $dataInicioFeriasFormatadoPadraoOM, $aPartirOuAcontar, $dataApresentacaoFerias10, $tipoEspecificoDoAfastamento)
    {
        if ($tipoEspecificoDoAfastamento == 'ferias1parcela10'){
            return "Concedida a 1ª parcela de 10 (dez) dias de férias, relativas ao ano de $anoFerias, a $aPartirOuAcontar de $dataInicioFeriasFormatadoPadraoOM, de acordo com o Art. 63, do Estatuto dos Militares (Lei Nr 6.880, de 09 DEZ 1980), combinado com o inciso XVIII, do Art. 21 e inciso II, do §1, do Art. 451, ambos do Regulamento Interno e dos Serviços Gerais (Port. Min. Nr 816, de 19 DEZ 03), devendo se apresentar pronto para o serviço em $dataApresentacaoFerias10";
        } elseif ($tipoEspecificoDoAfastamento == 'ferias2parcela10'){
            return "Concedida a 2ª parcela de 10 (dez) dias de férias, relativas ao ano de $anoFerias, a $aPartirOuAcontar de $dataInicioFeriasFormatadoPadraoOM, de acordo com o Art. 63, do Estatuto dos Militares (Lei Nr 6.880, de 09 DEZ 1980), combinado com o inciso XVIII, do Art. 21 e inciso II, do §1, do Art. 451, ambos do Regulamento Interno e dos Serviços Gerais (Port. Min. Nr 816, de 19 DEZ 03), devendo se apresentar pronto para o serviço em $dataApresentacaoFerias10";
        } else{
            return "Concedida a 3ª parcela de 10 (dez) dias de férias, relativas ao ano de $anoFerias, a $aPartirOuAcontar de $dataInicioFeriasFormatadoPadraoOM, de acordo com o Art. 63, do Estatuto dos Militares (Lei Nr 6.880, de 09 DEZ 1980), combinado com o inciso XVIII, do Art. 21 e inciso II, do §1, do Art. 451, ambos do Regulamento Interno e dos Serviços Gerais (Port. Min. Nr 816, de 19 DEZ 03), devendo se apresentar pronto para o serviço em $dataApresentacaoFerias10";
        }
    }
    public static function diasRestantes($quantidadeDeDiasRestantes, $quantidadeDeDiasRestantesPorEXTENSO, $anoFerias, $dataInicioFeriasFormatadoPadraoOM,
    $aPartirOuAcontar, $dataApresentacaoFeriasRestantes)
    {   
        if ($quantidadeDeDiasRestantes == '01'){
            return "Concedido $quantidadeDeDiasRestantes ($quantidadeDeDiasRestantesPorEXTENSO) dia de férias restantes, relativas ao ano de $anoFerias, a $aPartirOuAcontar de $dataInicioFeriasFormatadoPadraoOM, de acordo com o Art. 63, do Estatuto dos Militares (Lei Nr 6.880, de 09 DEZ 1980), combinado com o inciso XVIII, do Art. 21 e inciso I, do §1, do Art. 451, ambos do Regulamento Interno e dos Serviços Gerais (Port. Min. Nr 816, de 19 DEZ 03), devendo se apresentar pronto para o serviço em $dataApresentacaoFeriasRestantes";
        }else{
            return "Concedidos $quantidadeDeDiasRestantes ($quantidadeDeDiasRestantesPorEXTENSO) dias de férias restantes, relativas ao ano de $anoFerias, a $aPartirOuAcontar de $dataInicioFeriasFormatadoPadraoOM, de acordo com o Art. 63, do Estatuto dos Militares (Lei Nr 6.880, de 09 DEZ 1980), combinado com o inciso XVIII, do Art. 21 e inciso I, do §1, do Art. 451, ambos do Regulamento Interno e dos Serviços Gerais (Port. Min. Nr 816, de 19 DEZ 03), devendo se apresentar pronto para o serviço em $dataApresentacaoFeriasRestantes";
    }
    }

    public static function dispRecoCMTSU($quantidadeDeDiasDispReco, $quantidadeDeDiasDispRecoPorEXTENSO,
    $dataInicioDispRecoCmtSUPadraoOM, $aPartirOuAcontar, $dataApresentacaoDispRecoCmtSU, $cmtSUQueDeuADispensa)
    {   
        if ($quantidadeDeDiasDispReco == '01'){
            return "Concedido $quantidadeDeDiasDispReco ($quantidadeDeDiasDispRecoPorEXTENSO) dia de dispensa como recompensa pelo $cmtSUQueDeuADispensa, a $aPartirOuAcontar de $dataInicioDispRecoCmtSUPadraoOM, de acordo com o inciso I, do Art. 66, e inciso IV, do Art. 67, do Regulamento Disciplinar do Exército (Dec Nr 4346, de 26 AGO 02), devendo se apresentar pronto para o serviço em $dataApresentacaoDispRecoCmtSU";
        } else {
            return "Concedidos $quantidadeDeDiasDispReco ($quantidadeDeDiasDispRecoPorEXTENSO) dias de dispensa como recompensa pelo $cmtSUQueDeuADispensa, a $aPartirOuAcontar de $dataInicioDispRecoCmtSUPadraoOM, de acordo com o inciso I, do Art. 66, e inciso IV, do Art. 67, do Regulamento Disciplinar do Exército (Dec Nr 4346, de 26 AGO 02), devendo se apresentar pronto para o serviço em $dataApresentacaoDispRecoCmtSU";
        }
    }

    public static function dispRecoSCMTBTL($quantidadeDeDiasDispReco, $quantidadeDeDiasDispRecoPorEXTENSO,
    $dataInicioDispRecoSCmtPadraoOM, $aPartirOuAcontar, $dataApresentacaoDispRecoSCmt)
    {   
        if ($quantidadeDeDiasDispReco == '01'){
            return "Concedido $quantidadeDeDiasDispReco ($quantidadeDeDiasDispRecoPorEXTENSO) dia de dispensa como recompensa pelo Subcomandante do Batalhão, a $aPartirOuAcontar de $dataInicioDispRecoSCmtPadraoOM, de acordo com o inciso I, do Art. 66, e inciso IV, do Art. 67, do Regulamento Disciplinar do Exército (Dec Nr 4346, de 26 AGO 02), devendo se apresentar pronto para o serviço em $dataApresentacaoDispRecoSCmt";
        } else {
            return "Concedidos $quantidadeDeDiasDispReco ($quantidadeDeDiasDispRecoPorEXTENSO) dias de dispensa como recompensa pelo Subcomandante do Batalhão, a $aPartirOuAcontar de $dataInicioDispRecoSCmtPadraoOM, de acordo com o inciso I, do Art. 66, e inciso IV, do Art. 67, do Regulamento Disciplinar do Exército (Dec Nr 4346, de 26 AGO 02), devendo se apresentar pronto para o serviço em $dataApresentacaoDispRecoSCmt";
        }
    }

    public static function dispRecoCmtBtl($quantidadeDeDiasDispReco, $quantidadeDeDiasDispRecoPorEXTENSO, $dataInicioDispRecoCmtBtlPadraoOM,
    $aPartirOuAcontar, $dataApresentacaoDispRecoCmtBtl)
    {   
        if ($quantidadeDeDiasDispReco == '01'){
            return "Concedido $quantidadeDeDiasDispReco ($quantidadeDeDiasDispRecoPorEXTENSO) dia de dispensa como recompensa pelo Comandante do Batalhão, a $aPartirOuAcontar de $dataInicioDispRecoCmtBtlPadraoOM, de acordo com o inciso I, do Art. 66, e inciso IV, do Art. 67, do Regulamento Disciplinar do Exército (Dec Nr 4346, de 26 AGO 02), devendo se apresentar pronto para o serviço em $dataApresentacaoDispRecoCmtBtl";
        } else {
            return "Concedidos $quantidadeDeDiasDispReco ($quantidadeDeDiasDispRecoPorEXTENSO) dias de dispensa como recompensa pelo Comandante do Batalhão, a $aPartirOuAcontar de $dataInicioDispRecoCmtBtlPadraoOM, de acordo com o inciso I, do Art. 66, e inciso IV, do Art. 67, do Regulamento Disciplinar do Exército (Dec Nr 4346, de 26 AGO 02), devendo se apresentar pronto para o serviço em $dataApresentacaoDispRecoCmtBtl";
        }
    }

    public static function dispRecoCmtBda($quantidadeDeDiasDispReco, $quantidadeDeDiasDispRecoPorEXTENSO, $dataInicioDispRecoCmtBtlPadraoOM,
    $aPartirOuAcontar, $dataApresentacaoDispRecoCmtBtl)
    {   
        if ($quantidadeDeDiasDispReco == '01'){
            return "Concedido $quantidadeDeDiasDispReco ($quantidadeDeDiasDispRecoPorEXTENSO) dia de dispensa como recompensa pelo Cmt 5ª Bda C Bld, a $aPartirOuAcontar de $dataInicioDispRecoCmtBtlPadraoOM, de acordo com o inciso I, do Art. 66, e inciso IV, do Art. 67, do Regulamento Disciplinar do Exército (Dec Nr 4346, de 26 AGO 02), devendo se apresentar pronto para o serviço em $dataApresentacaoDispRecoCmtBtl";
        } else {
            return "Concedidos $quantidadeDeDiasDispReco ($quantidadeDeDiasDispRecoPorEXTENSO) dias de dispensa como recompensa pelo Cmt 5ª Bda C Bld, a $aPartirOuAcontar de $dataInicioDispRecoCmtBtlPadraoOM, de acordo com o inciso I, do Art. 66, e inciso IV, do Art. 67, do Regulamento Disciplinar do Exército (Dec Nr 4346, de 26 AGO 02), devendo se apresentar pronto para o serviço em $dataApresentacaoDispRecoCmtBtl";
        }
    }

    public static function dispPdescoFerias( $quantidadeDeDiasDispPdescoFerias, $quantidadeDeDiasDispPdescoFeriasPorEXTENSO, $dataInicioDispPdescoFeriasPadraoOM, $aPartirOuAcontar, $dataApresentacaoDispPdescoFerias, $quantidadeDeDiasRestantesFeriasFerias, $quantidadeDeDiasRestantesFeriasFeriasPorEXTENSO, $anoFeriasDispDesco)
    {
        if ($quantidadeDeDiasDispPdescoFerias == '01'){
            return "Concedido $quantidadeDeDiasDispPdescoFerias ($quantidadeDeDiasDispPdescoFeriasPorEXTENSO) dia de dispensa para desconto em férias, relativas ao ano de $anoFeriasDispDesco, a $aPartirOuAcontar de $dataInicioDispPdescoFeriasPadraoOM, de acordo com o inciso II, do Art 148, do Estatuto dos Militares (Lei Nr 6.880, de 09 Dez 80) combinado com a letra b), do inciso XV, do Art 21, do Regulamento Interno e dos Serviços Gerais (Port Min Nr 816, de 19 Dez 03), restando-lhe $quantidadeDeDiasRestantesFeriasFerias ($quantidadeDeDiasRestantesFeriasFeriasPorEXTENSO) dias de férias restantes, devendo se apresentar pronto para o serviço em $dataApresentacaoDispPdescoFerias";
        } else {
            return "Concedidos $quantidadeDeDiasDispPdescoFerias ($quantidadeDeDiasDispPdescoFeriasPorEXTENSO) dias de dispensa para desconto em férias, relativas ao ano de $anoFeriasDispDesco, a $aPartirOuAcontar de $dataInicioDispPdescoFeriasPadraoOM, de acordo com o inciso II, do Art 148, do Estatuto dos Militares (Lei Nr 6.880, de 09 Dez 80) combinado com a letra b), do inciso XV, do Art 21, do Regulamento Interno e dos Serviços Gerais (Port Min Nr 816, de 19 Dez 03), restando-lhe $quantidadeDeDiasRestantesFeriasFerias ($quantidadeDeDiasRestantesFeriasFeriasPorEXTENSO) dias de férias restantes, devendo se apresentar pronto para o serviço em $dataApresentacaoDispPdescoFerias";
        }
    }

    public static function instalacao($dataInicioInstalacaoPadraoOM, $aPartirOuAcontar, $dataApresentacaoInstalacao, $solteiroOuCasado)
    {
        if ($solteiroOuCasado == "solteiro"){
            return "Concedidos 4 (quatro) dias de instalação, a $aPartirOuAcontar de $dataInicioInstalacaoPadraoOM, de acordo com o inciso I, do §1º, do Art 454, do Regulamento Interno e dos Serviços Gerais (Port Min Nr 816, de 19 DEZ 03), devendo se apresentar pronto para o serviço em $dataApresentacaoInstalacao";
        } else {
            return "Concedidos 10 (dez) dias de instalação, a $aPartirOuAcontar de $dataInicioInstalacaoPadraoOM, de acordo com o inciso II, do §1º, do Art 454, do Regulamento Interno e dos Serviços Gerais (Port Min Nr 816, de 19 DEZ 03), devendo se apresentar pronto para o serviço em $dataApresentacaoInstalacao";
        }
    }
    
    public static function transito($dataInicioTransitoPadraoOM, $aPartirOuAcontar, $trintaDiasOuQuarentaEoitoHoras){
        if ($trintaDiasOuQuarentaEoitoHoras == "30 dias"){
            return "Concedidos 30 (trinta) dias de trânsito, a $aPartirOuAcontar de $dataInicioTransitoPadraoOM, de acordo com o inciso IV, do Art 64, da Lei Nr 6.880, de 9 DEZ 80 - Estatuto dos Militares, combinado com o § 1º, do Art 452, da Port Nr 816 - Cmt Ex, de 19 DEZ 03 - RISG";
        } else {
            return "Concedidas 48 (quarenta e oito) horas de prazo para apresentar-se na OM de destino, a $aPartirOuAcontar de $dataInicioTransitoPadraoOM, de acordo com o art. 442 da Port Nr 816 - Cmt Ex, de 19 DEZ 03 - RISG";
        }
    }

    public static function nupcias($dataInicioNupciasPadraoOM, $aPartirOuAcontar, $dataApresentacaoNupcias){
        return "Concedidos 08 (oito) dias de núpcias, a $aPartirOuAcontar de $dataInicioNupciasPadraoOM, de acordo com o inciso I, do Art 64, do Estatuto dos Militares (Lei Nr 6.880, de 09 DEZ 80) combinado com a letra c), do inciso XV, do Art 21, do Regulamento Interno e dos Serviços Gerais (Port Min Nr 816, de 19 DEZ 03), devendo se apresentar pronto para o serviço em $dataApresentacaoNupcias";
    }

    public static function luto($dataInicioLutoPadraoOM, $aPartirOuAcontar, $dataApresentacaoLuto){
        return "Concedidos 08 (oito) dias de luto, a $aPartirOuAcontar de $dataInicioLutoPadraoOM, em virtude do falecimento de sua genitora, de acordo com o inciso II, do Art 64, do Estatuto dos Militares (Lei Nr 6.880, de 9 DEZ 80), combinado com a alínea d), do inciso XV, do Art 21, do Regulamento Interno e dos Serviços Gerais (Port Nr 816, de 19 DEZ 03), devendo se apresentar pronto para o serviço em $dataApresentacaoLuto";
    }

}