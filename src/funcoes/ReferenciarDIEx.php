<?php
namespace Igor\Projeto\funcoes;
use Igor\Projeto\funcoes\Formatacoes;

class ReferenciarDIEx{
    

    public static function processarDados ($nRdiexSolicitacao, $nup, $remetente, $dataDIExFormatadoPadraoOM){
        
        return "(Solu DIEx Nr $nRdiexSolicitacao, EB: $nup, de $dataDIExFormatadoPadraoOM, do $remetente)";
    }

}