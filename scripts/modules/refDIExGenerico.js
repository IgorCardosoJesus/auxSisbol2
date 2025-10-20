// scripts/modules/refDIExGenerico.js
import { templates } from './templates.js';
import { formatadordeData } from './formatacoes.js';

export function processarRefDIEx(tipoEspecifico, inputs) {
  console.log('Processing ref DIEx tipo:', tipoEspecifico, 'with inputs:', inputs);
  // Validações gerais
  if (typeof tipoEspecifico !== 'string' || !tipoEspecifico) {
    throw new Error('Tipo específico de referenciamento de DIEx inválido');
  }
  if (typeof inputs !== 'object' || inputs === null) {
    throw new Error('Inputs devem ser um objeto válido');
  }
  if (!inputs.numero || !inputs.data || !inputs.bi) {
    throw new Error('Número do DIEx, data e número do BI obrigatórios');
  }
  if (!/^\d{4}-\d{2}-\d{2}$/.test(inputs.data)) {
    throw new Error('Data no formato YYYY-MM-DD');
  }

  try {
    const numero = inputs.numero;
    const data = formatadordeData(inputs.data);
    const bi = inputs.bi;

    return templates.refDIExGenerico
      .replace('{{numero}}', numero)
      .replace('{{data}}', data)
      .replace('{{bi}}', bi);
  } catch (error) {
    console.error('Erro em processarRefDIEx:', error.message);
    throw error;
  }
}
