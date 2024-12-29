document.querySelectorAll('input[name="tipoNota"]').forEach(function (radio){
    radio.addEventListener('change', function () {
    // Oculta os campos adicionais
    document.getElementById('camposAdicionais').classList.add('hidden');
    document.getElementById('camposAdicionaisFuncaoTransitoria').classList.add('hidden');
    document.getElementById('camposAdicionaisTornarSemEfeito').classList.add('hidden');
    document.getElementById('camposAdicionaisMudancaPF').classList.add('hidden');
    document.getElementById('camposAdicionaisAfastamento').classList.add('hidden');
    document.getElementById('camposAdicionaisPassagemRecebFuncao').classList.add('hidden');
    document.getElementById('camposAdicionaisInclusaoPlanFerias').classList.add('hidden'); 
    document.getElementById('camposAdicionaisRefDIEXGenerico').classList.add('hidden');

    // Verifica se o radio button ref as apresentações está selecionado
    if (document.getElementById('Apresentacoes').checked) {
        // Mostra os campos adicionais apenas se o estiver 'check
        document.getElementById('camposAdicionais').classList.remove('hidden');
        document.getElementById('data_apresentacao').setAttribute('required', 'required');

        var radioButtons = document.querySelectorAll('input[type="radio"][name="ApresentEspecifica"]');
        // Se o radio de apresentacao específica estiver selecionado, adiciona o required em todos os radiobutton para o usuário não enviar o formulário sem nenhum radio de apresentação estar selecionado
        radioButtons.forEach(function(radioButton) {
            radioButton.setAttribute('required', 'required');
        });
    } else {
        //retira a obrigatoriedade de todos os campos ref a apresentação caso o check de tipo apresentação não esteja ativo
        document.querySelectorAll('input[type="radio"][name="ApresentEspecifica"]').forEach(function(radioButton) {
        radioButton.removeAttribute('required');
    });
        //retira a obrigatoriedade da data do campo da data caso o check de tipo apresentação não esteja ativo
        document.getElementById('data_apresentacao').removeAttribute('required');
    }

    if (document.getElementById('funcaotransitoria').checked) {
        // Mostra os campos adicionais apenas se o estiver 'check
        document.getElementById('camposAdicionaisFuncaoTransitoria').classList.remove('hidden');
        document.getElementById('data_saida_retorno_funcao').setAttribute('required', 'required');

        var radioButtons = document.querySelectorAll('input[type="radio"][name="estadoFuncaoTransitoria"]');
        // Se o radio de apresentacao específica estiver selecionado, adiciona o required em todos os radiobutton para o usuário não enviar o formulário sem nenhum radio de apresentação estar selecionado
        radioButtons.forEach(function(radioButton) {
            radioButton.setAttribute('required', 'required');
        });
    } else {
        //retira a obrigatoriedade de todos os campos ref a apresentação caso o check de tipo apresentação não esteja ativo
        document.querySelectorAll('input[type="radio"][name="estadoFuncaoTransitoria"]').forEach(function(radioButton) {
        radioButton.removeAttribute('required');
    });
        //retira a obrigatoriedade da data do campo da data caso o check de tipo apresentação não esteja ativo
        document.getElementById('data_saida_retorno_funcao').removeAttribute('required');
    }



    if (document.getElementById('tornarSemEfeito').checked) {
        // Mostra os campos adicionais apenas se o estiver 'check
        document.getElementById('camposAdicionaisTornarSemEfeito').classList.remove('hidden');
        document.getElementById('data_bi_publicou').setAttribute('required', 'required');
        document.getElementById('nrBiConstPub').setAttribute('required', 'required');
        document.getElementById('nrPagBI').setAttribute('required', 'required');

        var radioButtons = document.querySelectorAll('input[type="radio"][name="semEfeito"]');
        // Se o radio de tornar sem efeito estiver selecionado, adiciona o required em todos os campos radio enhum radio
        radioButtons.forEach(function(radioButton) {
            radioButton.setAttribute('required', 'required');
        });
    } else {
        //retira a obrigatoriedade de todos os campos ref a sem efeito caso o check de tipo de nota s/efeito não esteja ativo
        document.querySelectorAll('input[type="radio"][name="semEfeito"]').forEach(function(radioButton) {
        radioButton.removeAttribute('required');
    });
        //retira a obrigatoriedade da data do campo da data caso o check de tipo apresentação não esteja ativo
    
        document.getElementById('data_bi_publicou').removeAttribute('required');
        document.getElementById('nrBiConstPub').removeAttribute('required');
        document.getElementById('nrPagBI').removeAttribute('required');
    }

    // Verifica se o radio button referente a Mudança no Plano de Férias está selecionado
    if (document.getElementById('mudancaPF').checked) {
        // Mostra os campos adicionais apenas se estiver 'check'
        document.getElementById('camposAdicionaisMudancaPF').classList.remove('hidden');
        document.getElementById('anoFeriasMudanca').setAttribute('required', 'required');
        document.getElementById('data_do_DIEx').setAttribute('required', 'required');
        document.getElementById('nrDiexSolicitacao').setAttribute('required', 'required');
        document.getElementById('nrNUP').setAttribute('required', 'required');

        var radioButtons = document.querySelectorAll('input[type="radio"][name="mudancaPF"]');
        // Se o radio de apresentacao específica estiver selecionado, adiciona o required em todos os radiobutton para o usuário não enviar o formulário sem nenhum radio de apresentação estar selecionado
        radioButtons.forEach(function(radioButton) {
            radioButton.setAttribute('required', 'required');
        });
    } else {
        // Remove a obrigatoriedade de todos os campos relacionados à mudança no plano de férias
        document.querySelectorAll('input[type="radio"][name="mudancaPF"]').forEach(function(radioButton) {
            radioButton.removeAttribute('required');
        });
        document.getElementById('anoFeriasMudanca').removeAttribute('required');
        document.getElementById('data_do_DIEx').removeAttribute('required');
        document.getElementById('nrDiexSolicitacao').removeAttribute('required');
        document.getElementById('nrNUP').removeAttribute('required');
    }

    // Verifica se o radio button referente a Mudança no Plano de Férias está selecionado
    if (document.getElementById('afastamento').checked) {
        // Mostra os campos adicionais apenas se estiver 'check'
        document.getElementById('camposAdicionaisAfastamento').classList.remove('hidden');

        var radioButtons = document.querySelectorAll('input[type="radio"][name="afastamentos"]');
        // Se o radio de apresentacao específica estiver selecionado, adiciona o required em todos os radiobutton para o usuário não enviar o formulário sem nenhum radio de apresentação estar selecionado
        radioButtons.forEach(function(radioButton) {
            radioButton.setAttribute('required', 'required');
        });
    } else {
        // Remove a obrigatoriedade de todos os campos relacionados à mudança no plano de férias
        document.querySelectorAll('input[type="radio"][name="afastamentos"]').forEach(function(radioButton) {
            radioButton.removeAttribute('required');
        });
    }

    if (document.getElementById('passagemFuncao').checked) {
        // Mostra os campos adicionais apenas se estiver 'check'
        document.getElementById('camposAdicionaisPassagemRecebFuncao').classList.remove('hidden');

        var radioButtons = document.querySelectorAll('input[type="radio"][name="funcoes"]');
        // Se o radio de apresentacao específica estiver selecionado, adiciona o required em todos os radiobutton para o usuário não enviar o formulário sem nenhum radio de apresentação estar selecionado
        radioButtons.forEach(function(radioButton) {
            radioButton.setAttribute('required', 'required');
        });
    } else {
        // Remove a obrigatoriedade de todos os campos relacionados à mudança no plano de férias
        document.querySelectorAll('input[type="radio"][name="funcoes"]').forEach(function(radioButton) {
            radioButton.removeAttribute('required');
        });
    }

    if (document.getElementById('inclusaoPlanFerias').checked) {
        // Mostra os campos adicionais apenas se estiver 'check'
        document.getElementById('camposAdicionaisInclusaoPlanFerias').classList.remove('hidden');
        var radioButtons = document.querySelectorAll('input[type="radio"][name="inclusaoferias"]');
        // Se o radio de apresentacao específica estiver selecionado, adiciona o required em todos os radiobutton para o usuário não enviar o formulário sem nenhum radio de apresentação estar selecionado
        radioButtons.forEach(function(radioButton) {
            radioButton.setAttribute('required', 'required');
        });
    } else{
        // Remove a obrigatoriedade de todos os campos relacionados à mudança no plano de férias
        document.querySelectorAll('input[type="radio"][name="inclusaoferias"]').forEach(function(radioButton) {
            radioButton.removeAttribute('required');
        });
    }

    if (document.getElementById('refDIExGenerico').checked) {
        // Mostra os campos adicionais apenas se estiver 'check'
        document.getElementById('camposAdicionaisRefDIEXGenerico').classList.remove('hidden');
    }



    }); 
});


// Seleciona todos os radio buttons dentro de apresentação específica e faz a interação entre ocultar e mostrar para o usuário
document.querySelectorAll('input[name="ApresentEspecifica"]').forEach(function (radio) {
    radio.addEventListener('change', function () {
        // Oculta todos os campos adicionais de todos os campos adicionais do formulário e torna-os visíveis mediante o check do usuário
        document.querySelectorAll('#campoAdicionalCargaCargo').forEach(function (campo) {
            campo.classList.add('hidden');
        });
        document.querySelectorAll('#camposAdicionaisCarga').forEach(function (campo) {
            campo.classList.add('hidden');
        });
        document.querySelectorAll('#campoAdicionalFerias').forEach(function (campo) {
            campo.classList.add('hidden');
        });
        document.querySelectorAll('#camposAdicionaisDispCmt').forEach(function (campo) {
            campo.classList.add('hidden');
        });
        document.querySelectorAll('#camposAdicionaisDispSCmt').forEach(function (campo) {
            campo.classList.add('hidden');
        });
        document.querySelectorAll('#camposAdicionaisDispCmtSU').forEach(function (campo) {
            campo.classList.add('hidden');
        });
        document.querySelectorAll('#camposAdicionaisDesistiuTransito').forEach(function (campo) {
            campo.classList.add('hidden');
        });
        document.querySelectorAll('#camposAdicionaisDescoFerias').forEach(function (campo) {
            campo.classList.add('hidden');
        });

        // Verifica qual radio button está selecionado e mostra os campos adicionais correspondentes
        if (document.getElementById('TermTransmCargoEncargo').checked || document.getElementById('TermRecebCargoEncargo').checked || document.getElementById('TermPassMaterialCargo').checked || document.getElementById('TermRecebMaterialCargo').checked)
        {
            document.getElementById('campoAdicionalCargaCargo').classList.remove('hidden');
        } else if (document.getElementById('TermPassMaterial').checked || document.getElementById('TermRecebMaterial').checked) 
        {
            document.getElementById('camposAdicionaisCarga').classList.remove('hidden');
        } else if (document.getElementById('Term30diasferias').checked || document.getElementById('termino1parcela15').checked ||
        document.getElementById('termino2parcela15').checked ||
        document.getElementById('termino1parcela10').checked ||
        document.getElementById('termino2parcela10').checked ||
        document.getElementById('termino3parcela10').checked) 
        {
            document.getElementById('campoAdicionalFerias').classList.remove('hidden');
        } else if ( document.getElementById('TermDispRecoCmtBtl').checked) 
        {
            document.getElementById('camposAdicionaisDispCmt').classList.remove('hidden');
        } else if ( document.getElementById('TermDispRecoSCmtBtl').checked) 
        {
            document.getElementById('camposAdicionaisDispSCmt').classList.remove('hidden');
        } else if ( document.getElementById('TermDispRecoSU').checked) 
        {
            document.getElementById('camposAdicionaisDispCmtSU').classList.remove('hidden');
        } else if ( document.getElementById('TermTrasito').checked) 
        {
            document.getElementById('camposAdicionaisDesistiuTransito').classList.remove('hidden');
        } else if ( document.getElementById('TermDescoFerias').checked) 
        {
            document.getElementById('camposAdicionaisDescoFerias').classList.remove('hidden');
        }
    });
});

document.querySelectorAll('input[name="estadoFuncaoTransitoria"]').forEach(function (radio) {
    radio.addEventListener('change', function () {
        // Oculta todos os campos adicionais de todos os campos adicionais do formulário e torna-os visíveis mediante o check do usuário
        document.querySelectorAll('#campoAdicionalDesignacaoFuncao').forEach(function (campo) {
            campo.classList.add('hidden');
        });
        document.querySelectorAll('#campoAdicionalDispensaFuncao').forEach(function (campo) {
            campo.classList.add('hidden');
        });
        document.querySelectorAll('#campoAdicionalFuncaoSubstTemporaria').forEach(function (campo) {
            campo.classList.add('hidden');
        });
        document.querySelectorAll('#campoAdicionalReassuncaoFuncao').forEach(function (campo) {
            campo.classList.add('hidden');
        });

        // Verifica qual radio button está selecionado e mostra os campos adicionais correspondentes
        if (document.getElementById('desigFuncao').checked)
        {
            document.getElementById('campoAdicionalDesignacaoFuncao').classList.remove('hidden');
        } else if (document.getElementById('dispensaFuncao').checked) 
        {
            document.getElementById('campoAdicionalDispensaFuncao').classList.remove('hidden');
        } else if (document.getElementById('funcaoSubstituicaoTemporaria').checked)
        {
            document.getElementById('campoAdicionalFuncaoSubstTemporaria').classList.remove('hidden');
        } else if (document.getElementById('reassunçãoFuncao').checked) 
        {
            document.getElementById('campoAdicionalReassuncaoFuncao').classList.remove('hidden');
        }
    });
});

document.querySelectorAll('input[name="semEfeito"]').forEach(function (radio) {
    radio.addEventListener('change', function () {
        // Oculta todos os campos adicionais de todos os campos adicionais do formulário e torna-os visíveis mediante o check do usuário
        document.querySelectorAll('#campoAdicionalSemEfeitoApresentação').forEach(function (campo) {
            campo.classList.add('hidden');
        });

        // Verifica qual radio button está selecionado e mostra os campos adicionais correspondentes
        if (document.getElementById('TornosemEfeitoApresentacao').checked)
        {
            document.getElementById('campoAdicionalSemEfeitoApresentação').classList.remove('hidden');
        }
    });
});

document.querySelectorAll('input[name="mudancaPF"]').forEach(function (radio) {
    radio.addEventListener('change', function () {
        // Oculta todos os campos adicionais de mudança de parcela
        document.querySelectorAll('#campoAdicionalmudancaApenasDeDia').forEach(function (campo) {
            campo.classList.add('hidden');
        });
        document.querySelectorAll('#campoAdicionalmudancaPF30_2D15').forEach(function (campo) {
            campo.classList.add('hidden');
        });
        document.querySelectorAll('#campoAdicionalmudancaPF2D15_30').forEach(function (campo) {
            campo.classList.add('hidden');
        });
        document.querySelectorAll('#campoAdicionalPF2D15_2D15DIFF').forEach(function (campo) {
            campo.classList.add('hidden');
        });
        document.querySelectorAll('#campoAdicionalPF30_3D10').forEach(function (campo) {
            campo.classList.add('hidden');
        });
        document.querySelectorAll('#campoAdicionalPF3D10_30').forEach(function (campo) {
            campo.classList.add('hidden');
        });
        document.querySelectorAll('#campoAdicionalPF3D10_3D10DIFF').forEach(function (campo) {
            campo.classList.add('hidden');
        });
        document.querySelectorAll('#campoAdicionalPF2D15_3D10').forEach(function (campo) {
            campo.classList.add('hidden');
        });

        // Verifica qual botão de rádio está selecionado e mostra os campos adicionais correspondentes
        if (document.getElementById('mudancaPF30_30-UMAPARCD10-UMAPARCD15').checked) {
            // Mostra os campos adicionais para mudança do dia de início, independente de ser 30, 15 ou 10 dias
            document.getElementById('campoAdicionalmudancaApenasDeDia').classList.remove('hidden');
        } else if (document.getElementById('mudancaPF30_2D15').checked) {
            document.getElementById('campoAdicionalmudancaPF30_2D15').classList.remove('hidden');
        } else if (document.getElementById('mudancaPF2D15_30').checked) {
            document.getElementById('campoAdicionalmudancaPF2D15_30').classList.remove('hidden');
        } else if (document.getElementById('mudancaPF2D15_2D15DIFF').checked) {
            document.getElementById('campoAdicionalPF2D15_2D15DIFF').classList.remove('hidden');
        } else if (document.getElementById('mudancaPF30_3D10').checked) {
            document.getElementById('campoAdicionalPF30_3D10').classList.remove('hidden');
        } else if (document.getElementById('mudancaPF3D10_30').checked) {
            document.getElementById('campoAdicionalPF3D10_30').classList.remove('hidden');
        } else if (document.getElementById('mudancaPF3D10_3D10DIFF').checked) {
            document.getElementById('campoAdicionalPF3D10_3D10DIFF').classList.remove('hidden');
        } else if (document.getElementById('mudancaPF2D15_3D10').checked) {
            document.getElementById('campoAdicionalPF2D15_3D10').classList.remove('hidden');
        }
    });
});


document.querySelectorAll('input[name="afastamentos"]').forEach(function (radio) {
    radio.addEventListener('change', function () {
        // Oculta todos os campos adicionais de mudança de parcela
        document.querySelectorAll('#campoAdicionalConcessaoFerias').forEach(function (campo) {
            campo.classList.add('hidden');
        });
        document.querySelectorAll('#campoAdicionalConcessaoFeriasRestantes').forEach(function (campo) {
            campo.classList.add('hidden');
        });
        document.querySelectorAll('#campoAdicionaldispensaCmtCiaDetalhe').forEach(function (campo) {
            campo.classList.add('hidden');
        });
        document.querySelectorAll('#campoAdicionaldispensaSCmtBtlDetalhe').forEach(function (campo) {
            campo.classList.add('hidden');
        });
        document.querySelectorAll('#campoAdicionaldispensaCmtBtlDetalhe').forEach(function (campo) {
            campo.classList.add('hidden');
        });
        document.querySelectorAll('#campoAdicionaldispensaCmt5BgdaDetalhe').forEach(function (campo) {
            campo.classList.add('hidden');
        });
        document.querySelectorAll('#campoAdicionaldispensaDescontoFeriasDetalhe').forEach(function (campo) {
            campo.classList.add('hidden');
        });
        document.querySelectorAll('#campoAdicionalinstalacaoDetalhe').forEach(function (campo) {
            campo.classList.add('hidden');
        });
        document.querySelectorAll('#campoAdicionaltransitoDetalhe').forEach(function (campo) {
            campo.classList.add('hidden');
        });
        document.querySelectorAll('#campoAdicionalnupciasDetalhe').forEach(function (campo) {
            campo.classList.add('hidden');
        });
        document.querySelectorAll('#campoAdicionallutoDetalhe').forEach(function (campo) {
            campo.classList.add('hidden');
        });

        // Verifica qual botão de rádio está selecionado e mostra os campos adicionais correspondentes
        if (document.getElementById('ferias30dias').checked || document.getElementById('ferias1parcela15').checked ||
        document.getElementById('ferias2parcela15').checked || document.getElementById('ferias1parcela10').checked ||
        document.getElementById('ferias2parcela10').checked || document.getElementById('ferias3parcela10').checked) {
            // Mostra os campos adicionais para mudança do dia de início, independente de ser 30, 15 ou 10 dias
            document.getElementById('campoAdicionalConcessaoFerias').classList.remove('hidden');
        } else if (document.getElementById('feriasDiasRestantes').checked) {
            document.getElementById('campoAdicionalConcessaoFeriasRestantes').classList.remove('hidden');
        } else if (document.getElementById('dispensaCmtCia').checked) {
            document.getElementById('campoAdicionaldispensaCmtCiaDetalhe').classList.remove('hidden');
        } else if (document.getElementById('dispensaSCmtBtl').checked) {
            document.getElementById('campoAdicionaldispensaSCmtBtlDetalhe').classList.remove('hidden');
        } else if (document.getElementById('dispensaCmtBtl').checked) {
            document.getElementById('campoAdicionaldispensaCmtBtlDetalhe').classList.remove('hidden');
        } else if (document.getElementById('dispensa5BdaCBld').checked) {
            document.getElementById('campoAdicionaldispensaCmt5BgdaDetalhe').classList.remove('hidden');
        } else if (document.getElementById('dispensaDescontoFerias').checked) {
            document.getElementById('campoAdicionaldispensaDescontoFeriasDetalhe').classList.remove('hidden');
        } else if (document.getElementById('instalacao').checked) {
            document.getElementById('campoAdicionalinstalacaoDetalhe').classList.remove('hidden');
        } else if (document.getElementById('nupcias').checked) {
            document.getElementById('campoAdicionalnupciasDetalhe').classList.remove('hidden');
        } else if (document.getElementById('luto').checked) {
            document.getElementById('campoAdicionallutoDetalhe').classList.remove('hidden');
        } else if (document.getElementById('transito').checked) {
            document.getElementById('campoAdicionaltransitoDetalhe').classList.remove('hidden');
        }
    });
});

document.querySelectorAll('input[name="funcoes"]').forEach(function (radio) {
    radio.addEventListener('change', function () {
        // Oculta todos os campos adicionais de mudança de parcela
        document.querySelectorAll('#campoAdicionalpassagemMaterialEncargosValoresDetalhe').forEach(function (campo) {
            campo.classList.add('hidden');
        });
        document.querySelectorAll('#campoAdicionalrecebimentoMaterialEncargosValoresDetalhe').forEach(function (campo) {
            campo.classList.add('hidden');
        });
        document.querySelectorAll('#campoAdicionalpassagemCargoEncargosDetalhe').forEach(function (campo) {
            campo.classList.add('hidden');
        });
        document.querySelectorAll('#campoAdicionalrecebimentoCargoEncargosDetalhe').forEach(function (campo) {
            campo.classList.add('hidden');
        });
        document.querySelectorAll('#campoAdicionalpassagemMaterialValoresDetalhe').forEach(function (campo) {
            campo.classList.add('hidden');
        });
        document.querySelectorAll('#campoAdicionalrecebimentoMaterialValoresDetalhe').forEach(function (campo) {
            campo.classList.add('hidden');
        });
        document.querySelectorAll('#campoAdicionalassuncaoFuncaoDetalhe').forEach(function (campo) {
            campo.classList.add('hidden');
        });

        // Verifica qual botão de rádio está selecionado e mostra os campos adicionais correspondentes
        if (document.getElementById('passagemMaterialEncargosValores').checked) {    
            document.getElementById('campoAdicionalpassagemMaterialEncargosValoresDetalhe').classList.remove('hidden');
        } else if (document.getElementById('recebimentoMaterialEncargosValores').checked) {
            document.getElementById('campoAdicionalrecebimentoMaterialEncargosValoresDetalhe').classList.remove('hidden');
        } else if (document.getElementById('passagemCargoEncargos').checked) {
            document.getElementById('campoAdicionalpassagemCargoEncargosDetalhe').classList.remove('hidden');
        } else if (document.getElementById('recebimentoCargoEncargos').checked) {
            document.getElementById('campoAdicionalrecebimentoCargoEncargosDetalhe').classList.remove('hidden');
        } else if (document.getElementById('passagemMaterialValores').checked) {
            document.getElementById('campoAdicionalpassagemMaterialValoresDetalhe').classList.remove('hidden');
        } else if (document.getElementById('recebimentoMaterialValores').checked) {
            document.getElementById('campoAdicionalrecebimentoMaterialValoresDetalhe').classList.remove('hidden');
        } else if (document.getElementById('assuncaoFuncao').checked) {
            document.getElementById('campoAdicionalassuncaoFuncaoDetalhe').classList.remove('hidden');
        }
    });
});

document.querySelectorAll('input[name="inclusaoferias"]').forEach(function (radio) {
    radio.addEventListener('change', function () {
        // Oculta todos os campos adicionais de mudança de parcela
        document.querySelectorAll('#campoAdicionalinclusaoFerias30DiasDetalhe').forEach(function (campo) {
            campo.classList.add('hidden');
        });
        document.querySelectorAll('#campoAdicionalinclusaoFerias2x15DiasDetalhe').forEach(function (campo) {
            campo.classList.add('hidden');
        });
        document.querySelectorAll('#campoAdicionalinclusaoFerias3x10DiasDetalhe').forEach(function (campo) {
            campo.classList.add('hidden');
        });

        // Verifica qual botão de rádio está selecionado e mostra os campos adicionais correspondentes
        if (document.getElementById('inclusaoFerias30Dias').checked) {    
            document.getElementById('campoAdicionalinclusaoFerias30DiasDetalhe').classList.remove('hidden');
        } else if (document.getElementById('inclusaoFerias2x15Dias').checked) {
            document.getElementById('campoAdicionalinclusaoFerias2x15DiasDetalhe').classList.remove('hidden');
        } else if (document.getElementById('inclusaoFerias3x10Dias').checked) {
            document.getElementById('campoAdicionalinclusaoFerias3x10DiasDetalhe').classList.remove('hidden');
        }
    
});
});

// Seleciona todos os radio buttons com o atributo name="ApresentEspecifica"
document.querySelectorAll('input[name="estadoFuncaoTransitoria"]').forEach(function(radio) {
    radio.addEventListener('change', function() {
        // Verifica qual radio button está selecionado e adiciona ou remove o atributo 'required' (Script apenas ref a passagem de cargo encargo e material (***********verif se não consigo juntar**************))
        if (this.id === 'TermTransmCargoEncargo' || this.id === 'TermRecebCargoEncargo' || this.id === 'TermPassMaterialCargo' || this.id === 'TermRecebMaterialCargo') {
            document.getElementById('nomeFuncao').setAttribute('required', 'required');
        } else {
            document.getElementById('nomeFuncao').removeAttribute('required');
        }

        if (this.id === 'TermPassMaterial' || this.id === 'TermRecebMaterial') {
            document.getElementById('nomePelSeç').setAttribute('required', 'required');
        } else {
            document.getElementById('nomePelSeç').removeAttribute('required');
        }
    });
});
document.querySelectorAll('input[name="semEfeito"]').forEach(function(radio) {
    radio.addEventListener('change', function() {
        // Verifica qual radio button está selecionado e adiciona ou remove o atributo 'required' (Script apenas ref a passagem de cargo encargo e material (***********verif se não consigo juntar**************))
        if (this.id === 'TornosemEfeitoApresentacao') {
            document.getElementById('tipoAprSemEfeito').setAttribute('required', 'required');
        } else {
            document.getElementById('tipoAprSemEfeito').removeAttribute('required');
        }
    });
});

