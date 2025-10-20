// scripts/modules/passagemFuncao.js
import { templates } from './templates.js';
import { formatadordeData, ApartirOuAcontar } from './formatacoes.js';

export function processarPassagemFuncao(tipoEspecificoNotaPassagemFuncao, inputs) {
  console.log('Processing passagem funcao tipo:', tipoEspecificoNotaPassagemFuncao, 'with inputs:', inputs);
  // Validações gerais
  if (typeof tipoEspecificoNotaPassagemFuncao !== 'string' || !tipoEspecificoNotaPassagemFuncao) {
    throw new Error('Tipo específico de passagem de função inválido');
  }
  if (typeof inputs !== 'object' || inputs === null) {
    throw new Error('Inputs devem ser um objeto válido');
  }

  try {
    if (tipoEspecificoNotaPassagemFuncao === 'passagemMaterialEncargosValores') {
      if (!inputs.prazo_passagemMaterialEncargosValores || !inputs.funcao_passagemMaterialEncargosValores || !inputs.data_inicio_passagemMaterialEncargosValores) {
        throw new Error('Prazo, função e data obrigatórios');
      }
      if (!/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_inicio_passagemMaterialEncargosValores)) {
        throw new Error('Data no formato YYYY-MM-DD');
      }
      const prazo = inputs.prazo_passagemMaterialEncargosValores;
      const nomeFuncao = inputs.funcao_passagemMaterialEncargosValores;
      const dataInicioPass = formatadordeData(inputs.data_inicio_passagemMaterialEncargosValores);
      const aPartirOuAcontar = ApartirOuAcontar(inputs.data_inicio_passagemMaterialEncargosValores);
      let template;
      if (prazo === '20') template = templates.passagemMaterialEncargosValores20;
      else if (prazo === '10') template = templates.passagemMaterialEncargosValores10;
      else template = templates.passagemMaterialEncargosValores4;
      return template
        .replace('{{nomeFuncao}}', nomeFuncao)
        .replace('{{aPartirOuAcontar}}', aPartirOuAcontar)
        .replace('{{dataInicioPass}}', dataInicioPass);
    }

    if (tipoEspecificoNotaPassagemFuncao === 'recebimentoMaterialEncargosValores') {
      if (!inputs.prazo_recebimentoMaterialEncargosValores || !inputs.funcao_recebimentoMaterialEncargosValores || !inputs.data_inicio_recebimentoMaterialEncargosValores) {
        throw new Error('Prazo, função e data obrigatórios');
      }
      if (!/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_inicio_recebimentoMaterialEncargosValores)) {
        throw new Error('Data no formato YYYY-MM-DD');
      }
      const prazo = inputs.prazo_recebimentoMaterialEncargosValores;
      const nomeFuncao = inputs.funcao_recebimentoMaterialEncargosValores;
      const dataInicioPass = formatadordeData(inputs.data_inicio_recebimentoMaterialEncargosValores);
      const aPartirOuAcontar = ApartirOuAcontar(inputs.data_inicio_recebimentoMaterialEncargosValores);
      let template;
      if (prazo === '20') template = templates.recebMaterialEncargosValores20;
      else if (prazo === '10') template = templates.recebMaterialEncargosValores10;
      else template = templates.recebMaterialEncargosValores4;
      return template
        .replace('{{nomeFuncao}}', nomeFuncao)
        .replace('{{aPartirOuAcontar}}', aPartirOuAcontar)
        .replace('{{dataInicioPass}}', dataInicioPass);
    }

    if (tipoEspecificoNotaPassagemFuncao === 'passagemCargoEncargos') {
      if (!inputs.prazo_passagemCargoEncargos || !inputs.funcao_passagemCargoEncargos || !inputs.data_inicio_passagemCargoEncargos) {
        throw new Error('Prazo, função e data obrigatórios');
      }
      if (!/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_inicio_passagemCargoEncargos)) {
        throw new Error('Data no formato YYYY-MM-DD');
      }
      const prazo = inputs.prazo_passagemCargoEncargos;
      const nomeFuncao = inputs.funcao_passagemCargoEncargos;
      const dataInicioPass = formatadordeData(inputs.data_inicio_passagemCargoEncargos);
      const aPartirOuAcontar = ApartirOuAcontar(inputs.data_inicio_passagemCargoEncargos);
      let template;
      if (prazo === '20') template = templates.passagemCargoEncargos20;
      else if (prazo === '10') template = templates.passagemCargoEncargos10;
      else template = templates.passagemCargoEncargos4;
      return template
        .replace('{{nomeFuncao}}', nomeFuncao)
        .replace('{{aPartirOuAcontar}}', aPartirOuAcontar)
        .replace('{{dataInicioPass}}', dataInicioPass);
    }

    if (tipoEspecificoNotaPassagemFuncao === 'recebimentoCargoEncargos') {
      if (!inputs.prazo_recebimentoCargoEncargos || !inputs.funcao_recebimentoCargoEncargos || !inputs.data_inicio_recebimentoCargoEncargos) {
        throw new Error('Prazo, função e data obrigatórios');
      }
      if (!/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_inicio_recebimentoCargoEncargos)) {
        throw new Error('Data no formato YYYY-MM-DD');
      }
      const prazo = inputs.prazo_recebimentoCargoEncargos;
      const nomeFuncao = inputs.funcao_recebimentoCargoEncargos;
      const dataInicioPass = formatadordeData(inputs.data_inicio_recebimentoCargoEncargos);
      const aPartirOuAcontar = ApartirOuAcontar(inputs.data_inicio_recebimentoCargoEncargos);
      let template;
      if (prazo === '20') template = templates.recebimentoCargoEncargos20;
      else if (prazo === '10') template = templates.recebimentoCargoEncargos10;
      else template = templates.recebimentoCargoEncargos4;
      return template
        .replace('{{nomeFuncao}}', nomeFuncao)
        .replace('{{aPartirOuAcontar}}', aPartirOuAcontar)
        .replace('{{dataInicioPass}}', dataInicioPass);
    }

    if (tipoEspecificoNotaPassagemFuncao === 'passagemMaterialValores') {
      if (!inputs.prazo_passagemMaterialValores || !inputs.funcao_passagemMaterialValores || !inputs.data_inicio_passagemMaterialValores) {
        throw new Error('Prazo, função e data obrigatórios');
      }
      if (!/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_inicio_passagemMaterialValores)) {
        throw new Error('Data no formato YYYY-MM-DD');
      }
      const prazo = inputs.prazo_passagemMaterialValores;
      const nomeFuncao = inputs.funcao_passagemMaterialValores;
      const dataInicioPass = formatadordeData(inputs.data_inicio_passagemMaterialValores);
      const aPartirOuAcontar = ApartirOuAcontar(inputs.data_inicio_passagemMaterialValores);
      let template;
      if (prazo === '20') template = templates.passagemMaterialValores20;
      else if (prazo === '10') template = templates.passagemMaterialValores10;
      else template = templates.passagemMaterialValores4;
      return template
        .replace('{{nomeFuncao}}', nomeFuncao)
        .replace('{{aPartirOuAcontar}}', aPartirOuAcontar)
        .replace('{{dataInicioPass}}', dataInicioPass);
    }

    if (tipoEspecificoNotaPassagemFuncao === 'recebimentoMaterialValores') {
      if (!inputs.prazo_recebimentoMaterialValores || !inputs.funcao_recebimentoMaterialValores || !inputs.data_inicio_recebimentoMaterialValores) {
        throw new Error('Prazo, função e data obrigatórios');
      }
      if (!/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_inicio_recebimentoMaterialValores)) {
        throw new Error('Data no formato YYYY-MM-DD');
      }
      const prazo = inputs.prazo_recebimentoMaterialValores;
      const nomeFuncao = inputs.funcao_recebimentoMaterialValores;
      const dataInicioPass = formatadordeData(inputs.data_inicio_recebimentoMaterialValores);
      const aPartirOuAcontar = ApartirOuAcontar(inputs.data_inicio_recebimentoMaterialValores);
      let template;
      if (prazo === '20') template = templates.recebimentoMaterialValores20;
      else if (prazo === '10') template = templates.recebimentoMaterialValores10;
      else template = templates.recebimentoMaterialValores4;
      return template
        .replace('{{nomeFuncao}}', nomeFuncao)
        .replace('{{aPartirOuAcontar}}', aPartirOuAcontar)
        .replace('{{dataInicioPass}}', dataInicioPass);
    }

    if (tipoEspecificoNotaPassagemFuncao === 'assuncaoFuncao') {
      if (!inputs.funcao_assuncaoFuncao || !inputs.data_inicio_assuncaoFuncao) {
        throw new Error('Função e data obrigatórios');
      }
      if (!/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_inicio_assuncaoFuncao)) {
        throw new Error('Data no formato YYYY-MM-DD');
      }
      const nomeFuncao = inputs.funcao_assuncaoFuncao;
      const dataInicioPass = formatadordeData(inputs.data_inicio_assuncaoFuncao);
      const cumulativamente = inputs.cumulativamente;
      const template = cumulativamente === '1' ? templates.assuncaoFuncaoCumulativa : templates.assuncaoFuncaoNaoCumulativa;
      return template
        .replace('{{nomeFuncao}}', nomeFuncao)
        .replace('{{dataInicioPass}}', dataInicioPass);
    }

    throw new Error('Tipo de passagem de função não suportado');
  } catch (error) {
    console.error('Erro em processarPassagemFuncao:', error.message);
    throw error;
  }
}
