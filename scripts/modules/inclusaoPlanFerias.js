// scripts/modules/inclusaoPlanFerias.js
import { templates } from './templates.js';
import { formatadordeData, adicionarDiasEmUmaData } from './formatacoes.js';

export function processarInclusaoPlanFerias(tipoEspecificoInclusaoPlanFerias, inputs) {
  console.log('Processing inclusao plan ferias tipo:', tipoEspecificoInclusaoPlanFerias, 'with inputs:', inputs);
  // Validações gerais
  if (typeof tipoEspecificoInclusaoPlanFerias !== 'string' || !tipoEspecificoInclusaoPlanFerias) {
    throw new Error('Tipo específico de inclusão no plano de férias inválido');
  }
  if (typeof inputs !== 'object' || inputs === null) {
    throw new Error('Inputs devem ser um objeto válido');
  }
  if (!inputs.AnoFeriasInclusao || inputs.AnoFeriasInclusao === 'null') {
    throw new Error('Ano das férias de inclusão obrigatório');
  }

  const anoFeriasInclusao = inputs.AnoFeriasInclusao;

  try {
    if (tipoEspecificoInclusaoPlanFerias === 'inclusaoFerias30Dias') {
      if (!inputs.data_inicio_inclusaoFerias30Dias || !/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_inicio_inclusaoFerias30Dias)) {
        throw new Error('Data de início dos 30 dias obrigatória e no formato YYYY-MM-DD');
      }
      const dataInclusao = inputs.data_inicio_inclusaoFerias30Dias;
      const dataInclusaoFormatadoPadraoOM = formatadordeData(dataInclusao);
      const dataTerminoFerias = formatadordeData(adicionarDiasEmUmaData(dataInclusao, '29'));
      const dataApresentacaoFerias = formatadordeData(adicionarDiasEmUmaData(dataInclusao, '30'));
      return templates.inclusaoFerias30Dias
        .replace('{{anoFeriasInclusao}}', anoFeriasInclusao)
        .replace('{{dataInclusaoFormatadoPadraoOM}}', dataInclusaoFormatadoPadraoOM)
        .replace('{{dataTerminoFerias}}', dataTerminoFerias)
        .replace('{{dataApresentacaoFerias}}', dataApresentacaoFerias);
    }

    if (tipoEspecificoInclusaoPlanFerias === 'inclusaoFerias2x15Dias') {
      if (!inputs.data_inicio1_inclusaoFerias2x15Dias || !inputs.data_inicio2_inclusaoFerias2x15Dias ||
          !/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_inicio1_inclusaoFerias2x15Dias) ||
          !/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_inicio2_inclusaoFerias2x15Dias)) {
        throw new Error('Datas de início das 2 parcelas de 15 dias obrigatórias e no formato YYYY-MM-DD');
      }
      const dataInclusao1D15 = inputs.data_inicio1_inclusaoFerias2x15Dias;
      const dataInclusao2D15 = inputs.data_inicio2_inclusaoFerias2x15Dias;
      const dataInclusao1D15FormatadoPadraoOM = formatadordeData(dataInclusao1D15);
      const dataTerminoFerias1D15 = formatadordeData(adicionarDiasEmUmaData(dataInclusao1D15, '14'));
      const dataApresentacaoFerias1D15 = formatadordeData(adicionarDiasEmUmaData(dataInclusao1D15, '15'));
      const dataInclusao2D15FormatadoPadraoOM = formatadordeData(dataInclusao2D15);
      const dataTerminoFerias2D15 = formatadordeData(adicionarDiasEmUmaData(dataInclusao2D15, '14'));
      const dataApresentacaoFerias2D15 = formatadordeData(adicionarDiasEmUmaData(dataInclusao2D15, '15'));
      return templates.inclusaoFerias2x15Dias
        .replace('{{anoFeriasInclusao}}', anoFeriasInclusao)
        .replace('{{dataInclusao1D15FormatadoPadraoOM}}', dataInclusao1D15FormatadoPadraoOM)
        .replace('{{dataTerminoFerias1D15}}', dataTerminoFerias1D15)
        .replace('{{dataApresentacaoFerias1D15}}', dataApresentacaoFerias1D15)
        .replace('{{dataInclusao2D15FormatadoPadraoOM}}', dataInclusao2D15FormatadoPadraoOM)
        .replace('{{dataTerminoFerias2D15}}', dataTerminoFerias2D15)
        .replace('{{dataApresentacaoFerias2D15}}', dataApresentacaoFerias2D15);
    }

    if (tipoEspecificoInclusaoPlanFerias === 'inclusaoFerias3x10Dias') {
      if (!inputs.data_inicio1_inclusaoFerias3x10Dias || !inputs.data_inicio2_inclusaoFerias3x10Dias || !inputs.data_inicio3_inclusaoFerias3x10Dias ||
          !/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_inicio1_inclusaoFerias3x10Dias) ||
          !/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_inicio2_inclusaoFerias3x10Dias) ||
          !/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_inicio3_inclusaoFerias3x10Dias)) {
        throw new Error('Datas de início das 3 parcelas de 10 dias obrigatórias e no formato YYYY-MM-DD');
      }
      const dataInclusao1D10 = inputs.data_inicio1_inclusaoFerias3x10Dias;
      const dataInclusao2D10 = inputs.data_inicio2_inclusaoFerias3x10Dias;
      const dataInclusao3D10 = inputs.data_inicio3_inclusaoFerias3x10Dias;
      const dataInclusao1D10FormatadoPadraoOM = formatadordeData(dataInclusao1D10);
      const dataTerminoFerias1D10 = formatadordeData(adicionarDiasEmUmaData(dataInclusao1D10, '9'));
      const dataApresentacaoFerias1D10 = formatadordeData(adicionarDiasEmUmaData(dataInclusao1D10, '10'));
      const dataInclusao2D10FormatadoPadraoOM = formatadordeData(dataInclusao2D10);
      const dataTerminoFerias2D10 = formatadordeData(adicionarDiasEmUmaData(dataInclusao2D10, '9'));
      const dataApresentacaoFerias2D10 = formatadordeData(adicionarDiasEmUmaData(dataInclusao2D10, '10'));
      const dataInclusao3D10FormatadoPadraoOM = formatadordeData(dataInclusao3D10);
      const dataTerminoFerias3D10 = formatadordeData(adicionarDiasEmUmaData(dataInclusao3D10, '9'));
      const dataApresentacaoFerias3D10 = formatadordeData(adicionarDiasEmUmaData(dataInclusao3D10, '10'));
      return templates.inclusaoFerias3x10Dias
        .replace('{{anoFeriasInclusao}}', anoFeriasInclusao)
        .replace('{{dataInclusao1D10FormatadoPadraoOM}}', dataInclusao1D10FormatadoPadraoOM)
        .replace('{{dataTerminoFerias1D10}}', dataTerminoFerias1D10)
        .replace('{{dataApresentacaoFerias1D10}}', dataApresentacaoFerias1D10)
        .replace('{{dataInclusao2D10FormatadoPadraoOM}}', dataInclusao2D10FormatadoPadraoOM)
        .replace('{{dataTerminoFerias2D10}}', dataTerminoFerias2D10)
        .replace('{{dataApresentacaoFerias2D10}}', dataApresentacaoFerias2D10)
        .replace('{{dataInclusao3D10FormatadoPadraoOM}}', dataInclusao3D10FormatadoPadraoOM)
        .replace('{{dataTerminoFerias3D10}}', dataTerminoFerias3D10)
        .replace('{{dataApresentacaoFerias3D10}}', dataApresentacaoFerias3D10);
    }

    throw new Error('Tipo de inclusão no plano de férias não suportado');
  } catch (error) {
    console.error('Erro em processarInclusaoPlanFerias:', error.message);
    throw error;
  }
}
