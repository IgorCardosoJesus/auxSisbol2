<?php
setlocale(LC_TIME, 'pt_BR');
require 'vendor/autoload.php';

use Igor\Projeto\funcoes\Afastamentos;
use Igor\Projeto\funcoes\Apresentacoes;
use Igor\Projeto\funcoes\FuncoesTransitorias;
use Igor\Projeto\funcoes\Formatacoes;
use Igor\Projeto\funcoes\TornoSemEfeito;
use Igor\Projeto\funcoes\MudancaPlanoFerias;
use Igor\Projeto\funcoes\ReferenciarDIEx;
use Igor\Projeto\funcoes\InclusaoPlanFerias;
use Igor\Projeto\funcoes\PassRecebFuncao;

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/styleResultado.css">
    <title>Aux Sisbol</title>
    <!-- Icone da página -->
    <link rel="icon" type="image/x-icon" href="img/insignia-cabo.png">
    <!-- Link essencial para formatação dos campos select (Select Pesquisável) -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
    </style>
</head>

<body>
<!-- Navbar simples com os ícones de plaquinha (Criando ecossistema) -->
<nav>

        <span style='font-size:12px;'>&#128679; SISTEMA EM CONSTRUÇÃO &#128679; SISTEMA EM CONSTRUÇÃO &#128679;</span>

        <div class="button">
                <a href="img/manualUsuario.pdf" target="blank">Manual do Usuário</a>

        </div>

        <span style='font-size:12px;'>&#128679; SISTEMA EM CONSTRUÇÃO &#128679; SISTEMA EM CONSTRUÇÃO &#128679;</span>

</nav>
<div class="container-body"> <!-- Conteiner está organizando todo o conteúdo da página -->
        <div class="boxNotaGerada">
            <fieldset>
                <legend class="legendaFildset"><b>Texto de Abertura:</b></legend>
                <!-- Texto sendo mostrado dentro desse TextArea somente leitura -->
                <textarea name="textoAbertura" cols="100" rows="5" class="TXTAbertura" readonly><?php
                    //Se o usuário apertar no botão pra zerar formulário, printa nada na tela
                    if (isset($_POST['Enviar'])) {
                        try {
                            // A partir desta etapa é toda regra de negócio, ponto a ponto do que o usuário selecionar (Método POST está pegando pelo 'name' dos radios, atentar pontualmente para isso)
                            $tipoDaNota = $_POST['tipoNota'];
                            $dataOportuna = $_POST['dateOportuna'];

                            if ($tipoDaNota === 'apresentacoesDiversas') {
                                $tipoEspecificoDeApresentacao = $_POST['ApresentEspecifica'];
                                $dadosTratadosRefApresentacoes = Apresentacoes::processarDados($tipoEspecificoDeApresentacao);
                                if ($dataOportuna == '1') {
                                    echo ($dadosTratadosRefApresentacoes . ".");
                                } else {
                                    echo ($dadosTratadosRefApresentacoes . ", por não ter sido publicado em data oportuna.");
                                }
                            } elseif ($tipoDaNota === 'dispensaReassuncaoFuncao') {
                                $tipoEspecificoNotaDispSubstReass = $_POST['estadoFuncaoTransitoria'];
                                $dadosTratadosRefFuncaoTransitoria = FuncoesTransitorias::processarDados($tipoEspecificoNotaDispSubstReass);
                                if ($dataOportuna == '1') {
                                    echo ($dadosTratadosRefFuncaoTransitoria . ".");
                                } else {
                                    echo ($dadosTratadosRefFuncaoTransitoria . ", por não ter sido publicado em data oportuna.");
                                }
                            } elseif ($tipoDaNota === 'tornarSemEfeito') {
                                $tipoEspecificoSemEfeito = $_POST['semEfeito'];
                                $dadosTratadosRefNotaSemEfeito = TornoSemEfeito::processarDados($tipoEspecificoSemEfeito);
                                if ($dataOportuna == '1') {
                                    echo ($dadosTratadosRefNotaSemEfeito . ".");
                                } else {
                                    echo ($dadosTratadosRefNotaSemEfeito . ", por não ter sido publicado em data oportuna.");
                                }
                            } elseif ($tipoDaNota === 'mudancaPlanoFerias') {
                                $tipoEspecificoMudanca = $_POST['mudancaPF'];
                                $dadosTratadosRefMudancaPF = MudancaPlanoFerias::processarDados($tipoEspecificoMudanca);
                                if ($dataOportuna == '1') {
                                    echo ($dadosTratadosRefMudancaPF . ".");
                                } else {
                                    echo ($dadosTratadosRefMudancaPF . ", por não ter sido publicado em data oportuna.");
                                }
                            } elseif ($tipoDaNota === 'afastamentosdiversos') {
                                $tipoEspecificoAfastamento = $_POST['afastamentos'];
                                $dadosTratadosRefAfastamentos = Afastamentos::processarDados($tipoEspecificoAfastamento);
                                if ($dataOportuna == '1') {
                                    echo ($dadosTratadosRefAfastamentos . ".");
                                } else {
                                    echo ($dadosTratadosRefAfastamentos . ", por não ter sido publicado em data oportuna.");
                                }
                            } elseif ($tipoDaNota === 'refDIExGenerico') {

                                $nRdiexSolicitacao = $_POST['nrDiexSolicitacaoGenerico'];
                                $nup = $_POST['nrNUPGenerico'];
                                $dataDESFORMATADA = $_POST['data_do_DIEx_Generico'];
                                $dataDIExFormatadoPadraoOM = Formatacoes::formatadordeData($dataDESFORMATADA);
                                $remetente = $_POST['remetente'];

                                if ($nRdiexSolicitacao == '' || $nup == '' || $dataDIExFormatadoPadraoOM == '' || $remetente == ''){
                                    echo "Você não preencheu todas as informações do DIEx, volte e preencha novamente!";
                                } else{

                                    $dadosTratadosRefDIEXGenerico = ReferenciarDIEx::processarDados($nRdiexSolicitacao, $nup, $remetente, $dataDIExFormatadoPadraoOM);

                                    if ($dataOportuna == '1') {
                                        echo ($dadosTratadosRefDIEXGenerico . ".");
                                    } else {
                                        echo ($dadosTratadosRefDIEXGenerico . ", por não ter sido publicado em data oportuna.");
                                    }
                                }
                            } elseif ($tipoDaNota === 'inclusaoPlanFerias') {
                                $tipoEspecificoInclusaoPlanFerias = $_POST['inclusaoferias'];
                                $dadosTratadosRefAfastamentos = InclusaoPlanFerias::processarDados($tipoEspecificoInclusaoPlanFerias);
                                if ($dataOportuna == '1') {
                                    echo ($dadosTratadosRefAfastamentos . ".");
                                } else {
                                    echo ($dadosTratadosRefAfastamentos . ", por não ter sido publicado em data oportuna.");
                                }
                            } elseif ($tipoDaNota === 'passagemFuncao') {
                                $tipoEspecificoInclusaoPlanFerias = $_POST['funcoes'];
                                $dadosTratadosRefAfastamentos = PassRecebFuncao::processarDados($tipoEspecificoInclusaoPlanFerias);
                                if ($dataOportuna == '1') {
                                    echo ($dadosTratadosRefAfastamentos . ".");
                                } else {
                                    echo ($dadosTratadosRefAfastamentos . ", por não ter sido publicado em data oportuna.");
                                }
                            }
                        } catch (Exception $e) {
                            // Tratamento adequado da exceção
                            echo "Ocorreu um erro ao processar os dados: " . $e->getMessage();
                        }
                    }
                    ?></textarea>
                <br><br>
                <!-- Botão de copiar conteúdo, funcionando através do script logo abaixo -->
                <button type="button" class="copiar" id="button">Copiar Texto de Abertura</button>
                <button type="button" class="redirect-button" id="buttonRedirect" onclick="window.location.href='index.php';">
                    Voltar para o formulário
                </button>
                <script>
                    const btnCopiar = document.querySelector('.copiar');
                    const textAreaTextoAbertura = document.querySelector('.TXTAbertura');
                    //Função assíncrona que primeiro copia o dado para o Clipboard e depois mostra o alerta na tela para o usuário
                    btnCopiar.addEventListener('click', async (e) =>{
                        if (navigator.clipboard) {
                            try{
                                await navigator.clipboard.writeText(textAreaTextoAbertura.value)
                                //console.log(textAreaTextoAbertura.value);
                                alert('Texto de Abertuda copiado com sucesso! Cole com Ctrl + Shift + V no SISBOL para colar sem formatação.');
                            } catch(err){ //Se não colar, capturamos o erro no console
                                //console.log(textAreaTextoAbertura.value);
                                console.error('Erro ao copiar o texto', err);
                                alert('Erro ao copiar, tente novamente');
                            }
                        } else {
                            var texto = textAreaTextoAbertura.value; // Correção aqui
                            // Criar um input oculto
                            var input = document.createElement('input');
                            input.setAttribute('type', 'text');
                            input.setAttribute('value', texto);
                            document.body.appendChild(input);

                            // Selecionar o texto no input
                            input.select();

                            // Copiar o texto selecionado
                            document.execCommand('copy');

                            // Remover o input
                            document.body.removeChild(input);

                            // Verificar se o texto foi copiado com sucesso
                            if (document.queryCommandSupported('copy')) {
                                alert('Texto de Abertuda copiado com sucesso! Cole com Ctrl + Shift + V no SISBOL para colar sem formatação.');
                            } else {
                                alert('Seu navegador não suporta a funcionalidade de cópia para a área de transferência. Tente usar um navegador mais recente!');
                            }
                        }
                    });
                </script>
            </fieldset>
        </div>

        <div class="boxNotaGerada">
            <fieldset> <!-- Início da box referente ao texto de fechamento nos mesmos moldes do texto de abertura -->
                <legend class="legendaFildset"><b> Texto de Fechamento:</b></legend>
                <textarea name="textoFechamento" cols="100" rows="5" class="TXTFechamento" readonly><?php
                    if (isset($_POST['Enviar'])){
                        //REFATORAR NO SENTIDO DE: CASO O MILITAR SE APRESENTOU DE TERM INSTALAÇÃO, TENHO QUE DESIGNAR PARA UMA SU, OU SEJA, EM CONSEQÊNCIA "COMPOSTO"
                        if ($tipoDaNota === 'mudancaPlanoFerias')
                        {
                            $SUEmConsequencia = $_POST['SUGeral'];
                            echo "Em consequência, dou o seguinte despacho: DEFERIDO. Seja alterado o período de férias conforme solicitado; e\n- o Ch 1ª Seç, $SUEmConsequencia e os demais interessados, tomem conhecimento e adotem as providências decorrentes.";
                        } else if ($tipoDaNota === 'inclusaoPlanFerias')
                        {
                            $SUEmConsequencia = $_POST['SUGeral'];
                            echo "Em consequência, o Ch 1ª Seç, $SUEmConsequencia, o Ch Seç Pg Pes e os demais interessados, tomem conhecimento e adotem as providências decorrentes.";
                        } elseif ($tipoDaNota === 'refDIExGenerico') {
                            echo "";
                        } elseif ($tipoDaNota === 'tornarSemEfeito') {
                            echo "";
                        } else{
                            $SUEmConsequencia = $_POST['SUGeral'];
                            echo "Em consequência, o Ch 1ª Seç, $SUEmConsequencia e os demais interessados, tomem conhecimento e adotem as providências decorrentes.";
                        }
                    }
                    ?></textarea>
                <br><br>
                <button type="button" class="copiarFechamento" id="buttonFechamento">Copiar Texto de Fechamento</button>
                <button type="button" class="redirect-button" id="buttonRedirect" onclick="window.location.href='index.php';">
                    Voltar para o formulário
                </button>
                <script>
                    const btnCopiarTextFechamento = document.querySelector('.copiarFechamento');
                    const textAreaTextoFechamento = document.querySelector('.TXTFechamento');

                    btnCopiarTextFechamento.addEventListener('click', async (e) => {

                        if (navigator.clipboard) {
                            try {
                                await navigator.clipboard.writeText(textAreaTextoFechamento.value);
                                console.log(textAreaTextoFechamento.value);
                                alert('Texto de Fechamento copiado com sucesso! Cole com Ctrl + Shift + V no SISBOL para colar sem formatação.');
                            } catch (err) {
                                console.log(textAreaTextoFechamento.value);
                                console.error('Erro ao copiar texto:', err);
                                alert('Ocorreu um erro ao copiar o texto de Fechamento. Por favor, tente novamente.');
                            }
                        } else {
                            var texto = textAreaTextoFechamento.value; // Correção aqui

                            // Criar um input oculto
                            var input = document.createElement('input');
                            input.setAttribute('type', 'text');
                            input.setAttribute('value', texto);
                            document.body.appendChild(input);

                            // Selecionar o texto no input
                            input.select();

                            // Copiar o texto selecionado
                            document.execCommand('copy');

                            // Remover o input
                            document.body.removeChild(input);

                            // Verificar se o texto foi copiado com sucesso
                            if (document.queryCommandSupported('copy')) {
                                alert('Texto de Fechamento copiado com sucesso! Cole com Ctrl + Shift + V no SISBOL para colar sem formatação!');
                            } else {
                                alert('Seu navegador não suporta a funcionalidade de cópia para a área de transferência. Tente usar um navegador mais recente!');
                            }
                        }
                    });
                </script>

            </fieldset>
        </div>

    </div>
<!-- Footer com informações necessárias -->
<footer>
    <div class="criadoImplement">
        Pensado e implementado por:
        <p>Cb IGOR CARDOSO DE <strong>JESUS</strong>
    </div>
    <div>
        <span style='font-size:20px;'>&#128679;
        SISTEMA EM CONSTRUÇÃO &#128679;</span>

    </div>
    <div class="relatarErroEscritaLink">
        <h6>Para relatar Erros e Bugs:</h6>
        <span>Clique <a href="https://forms.gle/iphJ3PE9NYCGAZ8z9" target="blank">aqui</a>.</span>
    </div>
</footer>
<script src="scripts/allpage.js"></script>
</body>
</html>