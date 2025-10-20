// scripts/modules/funcoesTransitorias.js
import { templates } from './templates.js';
import { formatadordeData, ApartirOuAcontar } from './formatacoes.js';

export function processarFuncaoTransitoria(tipoEspecificoNotaDispSubstReass, inputs) {
  console.log('🔄 [FUNÇÃO TRANSITÓRIA] Processing tipo:', tipoEspecificoNotaDispSubstReass, 'with inputs:', inputs);

  // Validações gerais
  if (typeof tipoEspecificoNotaDispSubstReass !== 'string' || !tipoEspecificoNotaDispSubstReass) {
    console.error('❌ [FUNÇÃO TRANSITÓRIA] Tipo específico inválido:', tipoEspecificoNotaDispSubstReass);
    throw new Error('Tipo específico de função transitoria inválido');
  }
  if (typeof inputs !== 'object' || inputs === null) {
    console.error('❌ [FUNÇÃO TRANSITÓRIA] Inputs inválidos:', inputs);
    throw new Error('Inputs devem ser um objeto válido');
  }
  if (!inputs.data_saida_retorno_funcao || !/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_saida_retorno_funcao)) {
    console.error('❌ [FUNÇÃO TRANSITÓRIA] Data inválida:', inputs.data_saida_retorno_funcao);
    throw new Error('Data obrigatória e no formato YYYY-MM-DD');
  }

  const dataApresentacaoFormatadaPadraoBR = formatadordeData(inputs.data_saida_retorno_funcao);
  const aPartirOuAcontar = ApartirOuAcontar(inputs.data_saida_retorno_funcao);

  try {
    if (tipoEspecificoNotaDispSubstReass === 'designacaoFuncao') {
      if (!inputs.qualFuncao) {
        throw new Error('Função designada obrigatória');
      }
      return templates.designacaoFuncao
        .replace('{{funcaoDesignada}}', inputs.qualFuncao)
        .replace('{{aPartirOuAcontar}}', aPartirOuAcontar)
        .replace('{{dataApresentacaoFormatadaPadraoBR}}', dataApresentacaoFormatadaPadraoBR);
    }

    if (tipoEspecificoNotaDispSubstReass === 'funcaoDispensa') {
      if (!inputs.primeiraFuncao || !inputs.responderOuExercer) {
        throw new Error('Função dispensada e exercer/responder obrigatórios');
      }
      const funcaoDipensa = inputs.primeiraFuncao;
      const exercerOuResponder = inputs.responderOuExercer;
      const motivo = inputs.motivoDispensadoFuncao || '';
      const segundafuncaoDipensa = inputs.segundaFuncao || null;
      const exercerOuResponderSegundFuncao = inputs.respondendoOuExercendoSegundaFuncao || null;

      let template;
      let replacements = {
        '{{exercerOuResponder}}': exercerOuResponder,
        '{{funcaoDipensa}}': funcaoDipensa,
        '{{aPartirOuAcontar}}': aPartirOuAcontar,
        '{{dataApresentacaoFormatadaPadraoBR}}': dataApresentacaoFormatadaPadraoBR,
        '{{motivo}}': motivo ? motivo : ''
      };

      if (exercerOuResponderSegundFuncao === 'exercer') {
        if (segundafuncaoDipensa && motivo) {
          template = templates.dispensaFuncaoDuplaComMotivo;
          replacements['{{segundafuncaoDipensa}}'] = segundafuncaoDipensa;
          replacements['{{exercerOuResponderSegundFuncao}}'] = exercerOuResponderSegundFuncao;
        } else if (segundafuncaoDipensa) {
          template = templates.dispensaFuncaoDupla;
          replacements['{{segundafuncaoDipensa}}'] = segundafuncaoDipensa;
          replacements['{{exercerOuResponderSegundFuncao}}'] = exercerOuResponderSegundFuncao;
        } else if (motivo) {
          template = templates.dispensaFuncaoComMotivo;
        } else {
          template = templates.dispensaFuncaoSimples;
        }
      } else {
        // Similar logic for responder
        if (segundafuncaoDipensa && motivo) {
          template = templates.dispensaFuncaoDuplaComMotivo;
          replacements['{{segundafuncaoDipensa}}'] = segundafuncaoDipensa;
          replacements['{{exercerOuResponderSegundFuncao}}'] = exercerOuResponderSegundFuncao;
        } else if (segundafuncaoDipensa) {
          template = templates.dispensaFuncaoDupla;
          replacements['{{segundafuncaoDipensa}}'] = segundafuncaoDipensa;
          replacements['{{exercerOuResponderSegundFuncao}}'] = exercerOuResponderSegundFuncao;
        } else if (motivo) {
          template = templates.dispensaFuncaoComMotivo;
        } else {
          template = templates.dispensaFuncaoSimples;
        }
      }

      let result = template;
      for (const [key, value] of Object.entries(replacements)) {
        result = result.replace(new RegExp(key.replace(/[.*+?^${}()|[\]\\]/g, '\\$&'), 'g'), value);
      }
      return result;
    }

    if (tipoEspecificoNotaDispSubstReass === 'substituicaoTemporaria') {
      if (!inputs.qualFuncaoSubstituira) {
        throw new Error('Função a substituir obrigatória');
      }
      return templates.substituicaoTemporaria
        .replace('{{funcaoSubstTemp}}', inputs.qualFuncaoSubstituira)
        .replace('{{aPartirOuAcontar}}', aPartirOuAcontar)
        .replace('{{dataApresentacaoFormatadaPadraoBR}}', dataApresentacaoFormatadaPadraoBR);
    }

    if (tipoEspecificoNotaDispSubstReass === 'reassuncaoFuncao') {
      if (!inputs.reassumiufuncao1) {
        throw new Error('Função a reassumir obrigatória');
      }
      const template = inputs.reassumiufuncao2 ? templates.reassuncaoFuncaoDupla : templates.reassuncaoFuncao;
      return template
        .replace('{{reassuncaoFuncao}}', inputs.reassumiufuncao1)
        .replace('{{reassumiuSegundafuncao}}', inputs.reassumiufuncao2 || '')
        .replace('{{aPartirOuAcontar}}', aPartirOuAcontar)
        .replace('{{dataApresentacaoFormatadaPadraoBR}}', dataApresentacaoFormatadaPadraoBR);
    }

    throw new Error('Tipo de função transitoria não suportado');
  } catch (error) {
    console.error('Erro em processarFuncaoTransitoria:', error.message);
    throw error;
  }
}
