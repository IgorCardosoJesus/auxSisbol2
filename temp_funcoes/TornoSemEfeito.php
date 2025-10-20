<?php
namespace Igor\Projeto\funcoes;
use Igor\Projeto\funcoes\Formatacoes;

class TornoSemEfeito{
    
    public static function processarDados ($tipoEspecificoNotaTornandoSemEfeito){
        $dataAprSemEfeitoDesformatada = $_POST['data_apr_sem_efeito'];
        $dataBiPubAprDesformatada = $_POST['data_bi_pub'];
        $nrBIpublicou = $_POST['nrBIConstPub'];
        $nrPagBI = $_POST['nrPagBIsEfeito'];
        
        //$aPartirOuAcontar = Formatacoes::ApartirOuAcontar($dataDaApresentacaoDesformatada);

        $dataAprSemEfeitoDesformatadaFORMATADA = Formatacoes::formatadordeData($dataAprSemEfeitoDesformatada);
        $dataBiPubAprDesformatadaDESFORMATADA = Formatacoes::formatadordeData($dataBiPubAprDesformatada);
    
        if ($tipoEspecificoNotaTornandoSemEfeito === 'semEfeitoApresentação')
        {
            $tipodaNotaAprTornadaSemEfeito = $_POST['tiposemEfeitoApresent'];
            $anoFeriasApresentSemEfeito = $_POST['anoFeriasApresentacaoSemEfeito'];
            $funcaoQueSeRefere = $_POST['funcaoqueSeRefAprSemEfeito'];
            $motivoSemEfeito = $_POST['motivoTornandoSemEfeito'];

            if ($tipodaNotaAprTornadaSemEfeito == ', por término de 30 dias de férias, referente a ' ||
            $tipodaNotaAprTornadaSemEfeito == ', por término da 1ª parcela de 15 dias de férias, referente a ' ||
            $tipodaNotaAprTornadaSemEfeito == ', por término da 2ª parcela de 15 dias de férias, referente a ' ||
            $tipodaNotaAprTornadaSemEfeito == ', por término da 1ª parcela de 10 dias de férias, referente a ' ||
            $tipodaNotaAprTornadaSemEfeito == ', por término da 2ª parcela de 10 dias de férias, referente a ' ||
            $tipodaNotaAprTornadaSemEfeito == ', por término da 3ª parcela de 10 dias de férias, referente a '){
                return TornoSemEfeito::tratarSemEfeitoAprvRefFerias(
                    $dataAprSemEfeitoDesformatadaFORMATADA,
                    $dataBiPubAprDesformatadaDESFORMATADA, 
                    $nrBIpublicou,
                    $nrPagBI,
                    $tipodaNotaAprTornadaSemEfeito,
                    $anoFeriasApresentSemEfeito,
                    $motivoSemEfeito);
            } elseif ( $tipodaNotaAprTornadaSemEfeito == ', por término de transmissão do Cargo e encargos da função de ' ||
            $tipodaNotaAprTornadaSemEfeito == ', por término de recebimento do Cargo e encargos da função de ' ||
            $tipodaNotaAprTornadaSemEfeito == ', por término da passagem de material, transmissão de encargos e valores da função de ' ||
            $tipodaNotaAprTornadaSemEfeito == ', por término da recebimento de material, de encargos e valores da função de ' ||
            $tipodaNotaAprTornadaSemEfeito == ', por término da passagem de material e transmissão de valores da função de ' ||
            $tipodaNotaAprTornadaSemEfeito == ', por término do recebimento de material e dos valores da função de '){
                return TornoSemEfeito::tratarSemEfeitoAprvRefPassRecebCargoMaterial(
                    $dataAprSemEfeitoDesformatadaFORMATADA,
                    $dataBiPubAprDesformatadaDESFORMATADA, 
                    $nrBIpublicou,
                    $nrPagBI,
                    $tipodaNotaAprTornadaSemEfeito,
                    $funcaoQueSeRefere,
                    $motivoSemEfeito);
            } else{
                return TornoSemEfeito::tratarSemEfeitoAprvRefDispensasGeral(
                    $dataAprSemEfeitoDesformatadaFORMATADA,
                    $dataBiPubAprDesformatadaDESFORMATADA, 
                    $nrBIpublicou,
                    $nrPagBI,
                    $tipodaNotaAprTornadaSemEfeito,
                    $motivoSemEfeito);
            }
            //////PAREI NESSA LÓGICA E COMO EU FAREI AQUI
        } elseif ($tipoEspecificoNotaTornandoSemEfeito === 'semEfeitoGenerico')
        {
            return TornoSemEfeito::tratarSemEfeitoGenerico(
                $dataBiPubAprDesformatadaDESFORMATADA, 
                $nrBIpublicou,
                $nrPagBI
            );
        }
    }
    //Torno sem efeito o publicado na Pág Nr 2106, do BI Nr 193, de 23 Out 22, do 13º BIB, referente à apresentação em 22 Out 22, por término de dispensa como recompensa do Cmt Btl, por ter sido publicado erroneamente.
    public static function tratarSemEfeitoAprvRefFerias($dataAprSemEfeitoDesformatadaFORMATADA, $dataBiPubAprDesformatadaDESFORMATADA, $nrBIpublicou, $nrPagBI, $tipodaNotaAprTornadaSemEfeito, $anoFeriasApresentSemEfeito, $motivoSemEfeito
    )
    {
        if ($anoFeriasApresentSemEfeito == 'null'){
            return "Volte e selecione o ano que se refere as férias.";
        } elseif ($motivoSemEfeito != 'null'){
            return "Torno sem efeito o publicado na Pág Nr $nrPagBI, do BI Nr $nrBIpublicou, de $dataBiPubAprDesformatadaDESFORMATADA, do 13º BIB, referente à apresentação em $dataAprSemEfeitoDesformatadaFORMATADA" . "$tipodaNotaAprTornadaSemEfeito" . "$anoFeriasApresentSemEfeito" . "$motivoSemEfeito";
        } else{
            return "Torno sem efeito o publicado na Pág Nr $nrPagBI, do BI Nr $nrBIpublicou, de $dataBiPubAprDesformatadaDESFORMATADA, do 13º BIB, referente à apresentação em $dataAprSemEfeitoDesformatadaFORMATADA" . "$tipodaNotaAprTornadaSemEfeito" . "$anoFeriasApresentSemEfeito";
        }
    }

    public static function tratarSemEfeitoAprvRefPassRecebCargoMaterial($dataAprSemEfeitoDesformatadaFORMATADA, $dataBiPubAprDesformatadaDESFORMATADA, $nrBIpublicou, $nrPagBI, $tipodaNotaAprTornadaSemEfeito, $funcaoQueSeRefere, $motivoSemEfeito)
    {   
        if ($funcaoQueSeRefere == 'null'){
            return "Volte e selecione a função que se refere.";
        } elseif ($motivoSemEfeito != 'null'){
            return "Torno sem efeito o publicado na Pág Nr $nrPagBI, do BI Nr $nrBIpublicou, de $dataBiPubAprDesformatadaDESFORMATADA, do 13º BIB, referente à apresentação em $dataAprSemEfeitoDesformatadaFORMATADA" . "$tipodaNotaAprTornadaSemEfeito" . "$funcaoQueSeRefere" . "$motivoSemEfeito";
        } else{
            return "Torno sem efeito o publicado na Pág Nr $nrPagBI, do BI Nr $nrBIpublicou, de $dataBiPubAprDesformatadaDESFORMATADA, do 13º BIB, referente à apresentação em $dataAprSemEfeitoDesformatadaFORMATADA" . "$tipodaNotaAprTornadaSemEfeito" . "$funcaoQueSeRefere";
        }
    }

    public static function tratarSemEfeitoAprvRefDispensasGeral($dataAprSemEfeitoDesformatadaFORMATADA, $dataBiPubAprDesformatadaDESFORMATADA, $nrBIpublicou, $nrPagBI, $tipodaNotaAprTornadaSemEfeito, $motivoSemEfeito
    )
    {   
        if ($motivoSemEfeito != 'null'){
            return "Torno sem efeito o publicado na Pág Nr $nrPagBI, do BI Nr $nrBIpublicou, de $dataBiPubAprDesformatadaDESFORMATADA, do 13º BIB, referente à apresentação em $dataAprSemEfeitoDesformatadaFORMATADA" . "$tipodaNotaAprTornadaSemEfeito" . "$motivoSemEfeito";
        } else{
            return "Torno sem efeito o publicado na Pág Nr $nrPagBI, do BI Nr $nrBIpublicou, de $dataBiPubAprDesformatadaDESFORMATADA, do 13º BIB, referente à apresentação em $dataAprSemEfeitoDesformatadaFORMATADA" . "$tipodaNotaAprTornadaSemEfeito";
        }
    }
    public static function tratarSemEfeitoGenerico($dataBiPubAprDesformatadaDESFORMATADA, $nrBIpublicou, $nrPagBI){
        return "Torno sem efeito o publicado na Pág Nr $nrPagBI, do BI Nr $nrBIpublicou, de $dataBiPubAprDesformatadaDESFORMATADA, do 13º BIB, referente (digitar aqui o sobre oque se trata a nota)";
    }

}