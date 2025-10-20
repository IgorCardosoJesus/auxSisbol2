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
  console.log('Generating result for inputs:', inputs); // Debug log
  // Lógica orquestradora: chama funções, substitui, retorna HTML string
  let output = '';
  try {
    if (inputs.tipoNota === 'afastamentosdiversos') {
      const tipoEspecifico = inputs.ApresentEspecifica;
      output = processarDados(tipoEspecifico, inputs);
    } else if (inputs.tipoNota === 'apresentacoesDiversas') {
      const tipoEspecifico = inputs.ApresentEspecifica;
      output = processarApresentacao(tipoEspecifico, inputs);
    } else if (inputs.tipoNota === 'funcaoTransitoria') {
      const tipoEspecifico = inputs.estadoFuncaoTransitoria;
      output = processarFuncaoTransitoria(tipoEspecifico, inputs);
    } else if (inputs.tipoNota === 'tornarSemEfeito') {
      const tipoEspecifico = inputs.semEfeito;
      output = processarTornarSemEfeito(tipoEspecifico, inputs);
    } else if (inputs.tipoNota === 'passagemFuncao') {
      output = processarPassagemFuncao(inputs);
    } else if (inputs.tipoNota === 'inclusaoPlanFerias') {
      output = processarInclusaoPlanFerias(inputs);
    } else if (inputs.tipoNota === 'mudancaPlanoFerias') {
      output = processarMudancaPlanoFerias(inputs);
    } else if (inputs.tipoNota === 'refDIExGenerico') {
      output = processarRefDIEx(inputs);
    }
    // Add for other tipos: e.g., if (inputs.tipoNota === 'outroTipo') output = processarOutroTipo(inputs);
  } catch (error) {
    throw new Error(`Erro no processamento: ${error.message}`);
  }
  // Sanitize para XSS: output é string de texto, textContent usado para segurança
  return output;
}

document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('formulariobasico');
  const resultadoDiv = document.getElementById('resultado');

  // Populate selects
  const anos = pegarAnosAnterioresAtualEPosteriores();
  document.querySelectorAll('select[name="anoFerias"], select[name="anoFeriasRestantes"], select[name="anoDispDescoFerias"], select[name="AnoFeriasInclusao"], select[name="anoFeriasMudanca"], select[name="anoDasFeriasSemEfeito"]').forEach(select => {
    select.innerHTML = '<option value="null">Selecione</option>';
    anos.forEach(ano => {
      const option = document.createElement('option');
      option.value = ano;
      option.text = ano;
      select.appendChild(option);
    });
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
    const form = document.getElementById('formulariobasico');
    const formData = new FormData(form);
    const inputs = Object.fromEntries(formData.entries());
    try {
      return gerarResultado(inputs);
    } catch (error) {
      return `<p>Erro: ${error.message}</p>`;
    }
  };
});
