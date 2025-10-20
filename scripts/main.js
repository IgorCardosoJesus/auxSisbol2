// scripts/main.js
import { processarDados } from './modules/afastamentos.js';
import { processarApresentacao } from './modules/apresentacoes.js';
import { processarFuncaoTransitoria } from './modules/funcoesTransitorias.js';
import { processarTornarSemEfeito } from './modules/tornarSemEfeito.js';
import { processarPassagemFuncao } from './modules/passagemFuncao.js';
import { processarInclusaoPlanFerias } from './modules/inclusaoPlanFerias.js';
import { processarMudancaPlanoFerias } from './modules/mudancaPlanoFerias.js';
import { processarRefDIEx } from './modules/refDIExGenerico.js';
import { pegarAnosAnterioresAtualEPosteriores, pegarTodasFuncoesOM, pegarFuncoesQueTemCarga } from './modules/formatacoes.js';
// Import other modules as needed

function gerarResultado(inputs) {
  console.log('=== INÍCIO gerarResultado ===');
  console.log('🔍 Generating result for inputs:', inputs);
  console.log('🔍 Tipo de nota detectado:', inputs.tipoNota);
  console.log('🔍 Todos os valores de inputs:', Object.keys(inputs));

  let output = '';
  try {
    if (inputs.tipoNota === 'afastamentosdiversos') {
      console.log('🔄 Processando AFASTAMENTOS DIVERSOS');
      const tipoEspecifico = inputs.afastamentos;
      console.log('🔍 Tipo específico de afastamento:', tipoEspecifico);
      console.log('🔍 Dados disponíveis para afastamentos:', {
        afastamentos: inputs.afastamentos,
        anoFerias: inputs.anoFerias,
        data_inicio_ferias: inputs.data_inicio_ferias
      });
      output = processarDados(tipoEspecifico, inputs);
      console.log('✅ Resultado afastamentos:', output);
    } else if (inputs.tipoNota === 'apresentacoesDiversas') {
      console.log('🔄 Processando APRESENTAÇÕES DIVERSAS');
      const tipoEspecifico = inputs.ApresentEspecifica;
      console.log('🔍 Tipo específico de apresentação:', tipoEspecifico);
      output = processarApresentacao(tipoEspecifico, inputs);
      console.log('✅ Resultado apresentações:', output);
    } else if (inputs.tipoNota === 'dispensaReassuncaoFuncao') {
      console.log('🔄 Processando FUNÇÃO TRANSITÓRIA');
      const tipoEspecifico = inputs.estadoFuncaoTransitoria;
      console.log('🔍 Tipo específico de função transitória:', tipoEspecifico);
      console.log('🔍 Dados disponíveis para função transitória:', {
        estadoFuncaoTransitoria: inputs.estadoFuncaoTransitoria,
        data_saida_retorno_funcao: inputs.data_saida_retorno_funcao
      });
      output = processarFuncaoTransitoria(tipoEspecifico, inputs);
      console.log('✅ Resultado função transitória:', output);
    } else if (inputs.tipoNota === 'tornarSemEfeito') {
      console.log('🔄 Processando TORNAR SEM EFEITO');
      const tipoEspecifico = inputs.semEfeito;
      console.log('🔍 Tipo específico sem efeito:', tipoEspecifico);
      console.log('🔍 Dados disponíveis para sem efeito:', {
        semEfeito: inputs.semEfeito,
        data_bi_publicou: inputs.data_bi_publicou,
        nrBiConstPub: inputs.nrBiConstPub,
        nrPagBI: inputs.nrPagBI
      });
      output = processarTornarSemEfeito(tipoEspecifico, inputs);
      console.log('✅ Resultado sem efeito:', output);
    } else if (inputs.tipoNota === 'passagemFuncao') {
      console.log('🔄 Processando PASSAGEM DE FUNÇÃO');
      console.log('🔍 Dados disponíveis para passagem de função:', {
        funcoes: inputs.funcoes,
        prazo_passagemMaterialEncargosValores: inputs.prazo_passagemMaterialEncargosValores,
        funcao_passagemMaterialEncargosValores: inputs.funcao_passagemMaterialEncargosValores,
        data_inicio_passagemMaterialEncargosValores: inputs.data_inicio_passagemMaterialEncargosValores
      });
      output = processarPassagemFuncao(inputs);
      console.log('✅ Resultado passagem função:', output);
    } else if (inputs.tipoNota === 'inclusaoPlanFerias') {
      console.log('🔄 Processando INCLUSÃO PLANO DE FÉRIAS');
      console.log('🔍 Dados disponíveis para inclusão:', {
        inclusaoferias: inputs.inclusaoferias,
        anoFeriasInclusao: inputs.AnoFeriasInclusao
      });
      output = processarInclusaoPlanFerias(inputs);
      console.log('✅ Resultado inclusão férias:', output);
    } else if (inputs.tipoNota === 'mudancaPlanoFerias') {
      console.log('🔄 Processando MUDANÇA PLANO DE FÉRIAS');
      console.log('🔍 Dados disponíveis para mudança PF:', {
        mudancaPF: inputs.mudancaPF,
        anoFeriasMudanca: inputs.anoFeriasMudanca,
        data_do_DIEx: inputs.data_do_DIEx
      });
      output = processarMudancaPlanoFerias(inputs);
      console.log('✅ Resultado mudança PF:', output);
    } else if (inputs.tipoNota === 'refDIExGenerico') {
      console.log('🔄 Processando REFERÊNCIA DIEX');
      console.log('🔍 Dados disponíveis para ref DIEx:', inputs);
      output = processarRefDIEx(inputs);
      console.log('✅ Resultado ref DIEx:', output);
    } else {
      console.warn('⚠️ TIPO DE NOTA NÃO RECONHECIDO:', inputs.tipoNota);
      console.log('🔍 Valores disponíveis esperados:', [
        'afastamentosdiversos',
        'apresentacoesDiversas',
        'dispensaReassuncaoFuncao',
        'tornarSemEfeito',
        'passagemFuncao',
        'inclusaoPlanFerias',
        'mudancaPlanoFerias',
        'refDIExGenerico'
      ]);
      output = 'Tipo de nota não reconhecido: ' + inputs.tipoNota;
    }

    console.log('=== RESULTADO FINAL ===');
    console.log('✅ Output gerado:', output);
    console.log('=== FIM gerarResultado ===');

  } catch (error) {
    console.error('❌ ERRO em gerarResultado:', error);
    console.error('📍 Stack trace:', error.stack);
    throw new Error(`Erro no processamento: ${error.message}`);
  }

  return output;
}

document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('formulariobasico');
  const resultadoDiv = document.getElementById('resultado');

  // Populate selects
  const anos = pegarAnosAnterioresAtualEPosteriores();
  console.log('Anos disponíveis para férias:', anos);

  // Incluindo #anoDasFerias na lista de selects que recebem anos
  document.querySelectorAll('select[name="anoFerias"], select[name="anoFeriasRestantes"], select[name="anoDispDescoFerias"], select[name="AnoFeriasInclusao"], select[name="anoFeriasMudanca"], select[name="anoDasFeriasSemEfeito"], #anoDasFerias').forEach(select => {
    console.log('Populando select:', select.id || select.name, 'com', anos.length, 'anos');
    select.innerHTML = '<option value="null">Selecione</option>';
    anos.forEach(ano => {
      const option = document.createElement('option');
      option.value = ano;
      option.text = ano;
      select.appendChild(option);
    });
    console.log('Select', select.id || select.name, 'populado com sucesso. Total de opções:', select.options.length);
  });

  const funcoes = pegarTodasFuncoesOM();
  document.querySelectorAll('select[name="apresentouTermRecebFuncaoCargoEncargo"], select[name="qualFuncao"], select[name="primeiraFuncao"], select[name="segundaFuncao"], select[name="qualFuncaoSubstituira"], select[name="reassumiufuncao1"], select[name="reassumiufuncao2"], select[name="funcao_assuncaoFuncao"], select[name="funcao_passagemMaterialEncargosValores"], select[name="funcao_recebimentoMaterialEncargosValores"], select[name="funcao_passagemCargoEncargos"], select[name="funcao_recebimentoCargoEncargos"], select[name="funcao_passagemMaterialValores"], select[name="funcao_recebimentoMaterialValores"], select[name="DispensadoDaFuncao"], select[name="DispensadoDaSegundaFuncao"], select[name="nomeFuncaoDesignacao"], select[name="nomefuncaoSubstTemp"], select[name="nomefuncaoreassumindo"], select[name="nomesegundafuncaoreassumindo"], select[name="semEfeitoRefFuncao"]').forEach(select => {
    select.innerHTML = '<option value="">Selecione</option>';
    funcoes.forEach(funcao => {
      const option = document.createElement('option');
      option.value = funcao;
      option.text = funcao;
      select.appendChild(option);
    });
  });

  const funcoesCarga = pegarFuncoesQueTemCarga();
  document.querySelectorAll('select[name="apresentouTermPassouRecebCarga"], select[name="funcoesBtl"], select[name="funcoesBtlCarga"], select[name="funcoesBtlCarga"], select[name="funcoesBtlCarga"]').forEach(select => {
    select.innerHTML = '<option value="">Selecione</option>';
    funcoesCarga.forEach(funcao => {
      const option = document.createElement('option');
      option.value = funcao;
      option.text = funcao;
      select.appendChild(option);
    });
  });

  // Populate qtdeDiasRest with numbers 1 to 30
  document.querySelectorAll('select[name="qtdeDiasRest"]').forEach(select => {
    select.innerHTML = '<option value="null">Selecione</option>';
    for (let i = 1; i <= 30; i++) {
      const option = document.createElement('option');
      option.value = i.toString();
      option.text = i.toString();
      select.appendChild(option);
    }
  });

  // Populate other selects as needed, e.g., numDiasDispensaCmt5Bgda, etc.
  // For simplicity, assuming they are static or add if needed

  form.addEventListener('submit', (e) => {
    e.preventDefault();
    const formData = new FormData(e.target);
    const inputs = Object.fromEntries(formData.entries());
    try {
      const resultado = gerarResultado(inputs);
      resultadoDiv.textContent = resultado;
    } catch (error) {
      alert(`Erro: ${error.message}`);
    }
  });

  // Expose the function globally for the modal
  window.gerarNotaClientSide = function() {
    console.log('gerarNotaClientSide function called');
    const form = document.getElementById('formulariobasico');
    const formData = new FormData(form);
    const inputs = Object.fromEntries(formData.entries());
    console.log('Form inputs collected:', inputs);
    try {
      const resultado = gerarResultado(inputs);
      console.log('Resultado gerado com sucesso:', resultado);
      return resultado;
    } catch (error) {
      console.error('Erro ao gerar resultado:', error);
      return `<p>Erro: ${error.message}</p>`;
    }
  };

  // Adicionar event listener para o botão Gerar Nota
  const btnGerarNota = document.getElementById('btnGerarNota_01');
  console.log('🔍 Procurando botão btnGerarNota_01...');
  console.log('📍 Botão encontrado:', btnGerarNota);

  if (btnGerarNota) {
    console.log('✅ Botão btnGerarNota_01 encontrado, adicionando event listener');
    console.log('🔧 Tipo do botão:', btnGerarNota.type);
    console.log('🔧 Classes do botão:', btnGerarNota.className);
    console.log('🔧 Texto do botão:', btnGerarNota.textContent);

    btnGerarNota.addEventListener('click', function(event) {
      console.log('🚀 ===== BOTÃO GERAR NOTA CLICADO! =====');
      console.log('🔍 Event:', event);
      console.log('🔍 Event target:', event.target);
      console.log('🔍 Event currentTarget:', event.currentTarget);

      // Prevenir comportamento padrão se necessário
      event.preventDefault();
      event.stopPropagation();

      try {
        console.log('📝 Chamando gerarNotaClientSide...');
        const resultado = window.gerarNotaClientSide();
        console.log('✅ Nota gerada com sucesso:', resultado);

        // Usar o modal existente para exibir o resultado
        let abertura = resultado;
        let fechamento = '';
        const closingPhrase = ' e por estar pronto para o serviço';

        if (resultado.includes(closingPhrase)) {
          const parts = resultado.split(closingPhrase);
          abertura = parts[0];
          fechamento = closingPhrase;
        }

        console.log('📝 Texto de abertura:', abertura);
        console.log('📝 Texto de fechamento:', fechamento);

        // Preencher o modal com o conteúdo
        const textoAberturaEl = document.getElementById('textoAbertura');
        const textoFechamentoEl = document.getElementById('textoFechamento');

        console.log('🔍 Elemento textoAbertura:', textoAberturaEl);
        console.log('🔍 Elemento textoFechamento:', textoFechamentoEl);

        if (textoAberturaEl && textoFechamentoEl) {
          textoAberturaEl.textContent = abertura;
          textoFechamentoEl.textContent = fechamento;
          console.log('✅ Conteúdo do modal preenchido');
        } else {
          console.error('❌ Elementos do modal não encontrados');
          alert('Resultado: ' + resultado);
          return;
        }

        // Mostrar o modal
        const modal = document.getElementById('modalGerarNota_01');
        console.log('🔍 Modal encontrado:', modal);

        if (modal) {
          modal.style.display = 'flex';
          modal.setAttribute('aria-hidden','false');
          console.log('✅ Modal exibido com sucesso');
        } else {
          console.error('❌ Modal não encontrado');
          alert('Resultado: ' + resultado);
        }

      } catch (error) {
        console.error('❌ ERRO CRÍTICO ao gerar nota:', error);
        console.error('📍 Stack trace:', error.stack);
        alert('Erro ao gerar nota: ' + error.message);
      }
    });


  } else {
    console.error('❌ Botão btnGerarNota_01 NÃO encontrado no DOM');
    console.log('🔍 Todos os elementos com ID que contém "gerar":',
      Array.from(document.querySelectorAll('[id*="gerar" i]')).map(el => ({
        id: el.id,
        tagName: el.tagName,
        textContent: el.textContent.slice(0, 50)
      }))
    );
  }
});
