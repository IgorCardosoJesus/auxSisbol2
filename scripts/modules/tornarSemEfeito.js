// scripts/modules/tornarSemEfeito.js
import { templates } from './templates.js';
import { formatadordeData } from './formatacoes.js';

export function processarTornarSemEfeito(tipoEspecificoNotaTornandoSemEfeito, inputs) {
  console.log('Processing tornar sem efeito tipo:', tipoEspecificoNotaTornandoSemEfeito, 'with inputs:', inputs);
  // Validações gerais
  if (typeof tipoEspecificoNotaTornandoSemEfeito !== 'string' || !tipoEspecificoNotaTornandoSemEfeito) {
    throw new Error('Tipo específico de tornar sem efeito inválido');
  }
  if (typeof inputs !== 'object' || inputs === null) {
    throw new Error('Inputs devem ser um objeto válido');
  }
  if (!inputs.data_bi_pub || !/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_bi_pub)) {
    throw new Error('Data de publicação do BI obrigatória e no formato YYYY-MM-DD');
  }
  if (!inputs.nrBIConstPub || isNaN(parseInt(inputs.nrBIConstPub))) {
    throw new Error('Número do BI obrigatório');
  }
  if (!inputs.nrPagBIsEfeito || isNaN(parseInt(inputs.nrPagBIsEfeito))) {
    throw new Error('Página do BI obrigatória');
  }

  const dataBiPubAprDesformatadaDESFORMATADA = formatadordeData(inputs.data_bi_pub);
  const nrBIpublicou = inputs.nrBIConstPub;
  const nrPagBI = inputs.nrPagBIsEfeito;

  try {
    if (tipoEspecificoNotaTornandoSemEfeito === 'semEfeitoGenerico') {
      return templates.semEfeitoGenerico
        .replace('{{nrPagBI}}', nrPagBI)
        .replace('{{nrBIpublicou}}', nrBIpublicou)
        .replace('{{dataBiPubAprDesformatadaDESFORMATADA}}', dataBiPubAprDesformatadaDESFORMATADA);
    }

    if (tipoEspecificoNotaTornandoSemEfeito === 'semEfeitoApresentação') {
      if (!inputs.data_apr_sem_efeito || !/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_apr_sem_efeito)) {
        throw new Error('Data da apresentação obrigatória e no formato YYYY-MM-DD');
      }
      if (!inputs.tiposemEfeitoApresent) {
        throw new Error('Tipo da apresentação obrigatória');
      }

      const dataAprSemEfeitoDesformatadaFORMATADA = formatadordeData(inputs.data_apr_sem_efeito);
      const tipodaNotaAprTornadaSemEfeito = inputs.tiposemEfeitoApresent;
      const motivoSemEfeito = inputs.motivoTornandoSemEfeito || '';

      let template;
      let replacements = {
        '{{nrPagBI}}': nrPagBI,
        '{{nrBIpublicou}}': nrBIpublicou,
        '{{dataBiPubAprDesformatadaDESFORMATADA}}': dataBiPubAprDesformatadaDESFORMATADA,
        '{{dataAprSemEfeitoDesformatadaFORMATADA}}': dataAprSemEfeitoDesformatadaFORMATADA,
        '{{tipodaNotaAprTornadaSemEfeito}}': tipodaNotaAprTornadaSemEfeito,
        '{{motivoSemEfeito}}': motivoSemEfeito
      };

      const feriasTypes = [
        ', por término de 30 dias de férias, referente a ',
        ', por término da 1ª parcela de 15 dias de férias, referente a ',
        ', por término da 2ª parcela de 15 dias de férias, referente a ',
        ', por término da 1ª parcela de 10 dias de férias, referente a ',
        ', por término da 2ª parcela de 10 dias de férias, referente a ',
        ', por término da 3ª parcela de 10 dias de férias, referente a '
      ];

      const funcaoTypes = [
        ', por término de transmissão do Cargo e encargos da função de ',
        ', por término de recebimento do Cargo e encargos da função de ',
        ', por término da passagem de material, transmissão de encargos e valores da função de ',
        ', por término da recebimento de material, de encargos e valores da função de ',
        ', por término da passagem de material e transmissão de valores da função de ',
        ', por término do recebimento de material e dos valores da função de '
      ];

      if (feriasTypes.includes(tipodaNotaAprTornadaSemEfeito)) {
        if (!inputs.anoFeriasApresentacaoSemEfeito || inputs.anoFeriasApresentacaoSemEfeito === 'null') {
          throw new Error('Ano das férias obrigatório');
        }
        template = templates.semEfeitoApresentacaoFerias;
        replacements['{{anoFeriasApresentSemEfeito}}'] = inputs.anoFeriasApresentacaoSemEfeito;
      } else if (funcaoTypes.includes(tipodaNotaAprTornadaSemEfeito)) {
        if (!inputs.funcaoqueSeRefAprSemEfeito) {
          throw new Error('Função obrigatória');
        }
        template = templates.semEfeitoApresentacaoFuncao;
        replacements['{{funcaoQueSeRefere}}'] = inputs.funcaoqueSeRefAprSemEfeito;
      } else {
        template = templates.semEfeitoApresentacaoGeral;
      }

      let result = template;
      for (const [key, value] of Object.entries(replacements)) {
        result = result.replace(new RegExp(key.replace(/[.*+?^${}()|[\]\\]/g, '\\$&'), 'g'), value);
      }
      return result;
    }

    throw new Error('Tipo de tornar sem efeito não suportado');
  } catch (error) {
    console.error('Erro em processarTornarSemEfeito:', error.message);
    throw error;
  }
}
