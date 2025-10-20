// scripts/modules/afastamentos.js
import { templates } from './templates.js';
import { formatadordeData, adicionarDiasEmUmaData, ApartirOuAcontar, numeroEmExtenso } from './formatacoes.js';

export function processarDados(tipoEspecificoDoAfastamento, inputs) {
  console.log('📋 [AFASTAMENTOS] Processing tipo:', tipoEspecificoDoAfastamento, 'with inputs:', inputs);

  // Validações gerais
  if (typeof tipoEspecificoDoAfastamento !== 'string' || !tipoEspecificoDoAfastamento) {
    console.error('❌ [AFASTAMENTOS] Tipo específico inválido:', tipoEspecificoDoAfastamento);
    throw new Error('Tipo específico de afastamento inválido');
  }
  if (typeof inputs !== 'object' || inputs === null) {
    console.error('❌ [AFASTAMENTOS] Inputs inválidos:', inputs);
    throw new Error('Inputs devem ser um objeto válido');
  }

  try {
    console.log('🔍 [AFASTAMENTOS] Verificando tipo de afastamento...');

    if (tipoEspecificoDoAfastamento.startsWith('ferias')) {
      console.log('🏖️ [AFASTAMENTOS] Processing férias type');
      // Validações para férias
      if (!inputs.anoFerias || inputs.anoFerias === 'null') {
        console.error('❌ [AFASTAMENTOS] Ano das férias obrigatório. Valor recebido:', inputs.anoFerias);
        throw new Error('Ano das férias obrigatório');
      }
      if (typeof inputs.anoFerias !== 'string') {
        console.error('❌ [AFASTAMENTOS] Ano das férias deve ser string. Tipo recebido:', typeof inputs.anoFerias);
        throw new Error('Ano das férias deve ser string');
      }

      // Aceitar tanto dataInicioFerias quanto data_inicio_ferias
      const dataInicioFerias = inputs.dataInicioFerias || inputs.data_inicio_ferias;
      if (!dataInicioFerias || !/^\d{4}-\d{2}-\d{2}$/.test(dataInicioFerias)) {
        console.error('❌ [AFASTAMENTOS] Data de início das férias obrigatória e no formato YYYY-MM-DD. Valor recebido:', dataInicioFerias);
        throw new Error('Data de início das férias obrigatória e no formato YYYY-MM-DD');
      }
      const dataInicio = new Date(dataInicioFerias);
      if (isNaN(dataInicio.getTime())) {
        console.error('❌ [AFASTAMENTOS] Data de início inválida. Valor recebido:', dataInicioFerias);
        throw new Error('Data de início inválida');
      }

      if (tipoEspecificoDoAfastamento === 'ferias30dias') {
        const dataApresentacaoFerias = formatadordeData(adicionarDiasEmUmaData(dataInicioFerias, '30'));
        console.log('Calculated dataApresentacaoFerias:', dataApresentacaoFerias); // Debug log
        return templates.trintaDiasSeguidos
          .replace('{{anoFerias}}', inputs.anoFerias)
          .replace('{{aPartirOuAcontar}}', ApartirOuAcontar(dataInicioFerias))
          .replace('{{dataInicioFeriasFormatadoPadraoOM}}', formatadordeData(dataInicioFerias))
          .replace('{{dataApresentacaoFerias}}', dataApresentacaoFerias);
      } else if (tipoEspecificoDoAfastamento === 'ferias1parcela15' || tipoEspecificoDoAfastamento === 'ferias2parcela15') {
        const dataApresentacaoFerias15 = formatadordeData(adicionarDiasEmUmaData(dataInicioFerias, '15'));
        const template = tipoEspecificoDoAfastamento === 'ferias1parcela15' ? templates.primeiraParcelaQuinze : templates.segundaParcelaQuinze;
        return template
          .replace('{{anoFerias}}', inputs.anoFerias)
          .replace('{{aPartirOuAcontar}}', ApartirOuAcontar(dataInicioFerias))
          .replace('{{dataInicioFeriasFormatadoPadraoOM}}', formatadordeData(dataInicioFerias))
          .replace('{{dataApresentacaoFerias15}}', dataApresentacaoFerias15);
      } else if (tipoEspecificoDoAfastamento.startsWith('ferias') && tipoEspecificoDoAfastamento.includes('parcela10')) {
        const dataApresentacaoFerias10 = formatadordeData(adicionarDiasEmUmaData(dataInicioFerias, '10'));
        let template;
        if (tipoEspecificoDoAfastamento === 'ferias1parcela10') template = templates.primeiraParcelaDez;
        else if (tipoEspecificoDoAfastamento === 'ferias2parcela10') template = templates.segundaParcelaDez;
        else template = templates.terceiraParcelaDez;
        return template
          .replace('{{anoFerias}}', inputs.anoFerias)
          .replace('{{aPartirOuAcontar}}', ApartirOuAcontar(dataInicioFerias))
          .replace('{{dataInicioFeriasFormatadoPadraoOM}}', formatadordeData(dataInicioFerias))
          .replace('{{dataApresentacaoFerias10}}', dataApresentacaoFerias10);
      }
    }

    if (tipoEspecificoDoAfastamento === 'feriasDiasRestantes') {
      console.log('Processing dias restantes'); // Debug log
      // Validações para dias restantes
      if (!inputs.qtdeDiasRest || isNaN(parseInt(inputs.qtdeDiasRest)) || parseInt(inputs.qtdeDiasRest) < 1 || parseInt(inputs.qtdeDiasRest) > 30) {
        throw new Error('Quantidade de dias restantes obrigatória e entre 1 e 30');
      }
      if (!inputs.anoFeriasRestantes || inputs.anoFeriasRestantes === 'null') {
        throw new Error('Ano das férias restantes obrigatório');
      }
      if (!inputs.dataInicioFeriasRestantes || !/^\d{4}-\d{2}-\d{2}$/.test(inputs.dataInicioFeriasRestantes)) {
        throw new Error('Data de início das férias restantes obrigatória e no formato YYYY-MM-DD');
      }

      const quantidadeDeDiasRestantes = inputs.qtdeDiasRest;
      const quantidadeDeDiasRestantesPorEXTENSO = numeroEmExtenso(quantidadeDeDiasRestantes);
      const anoFerias = inputs.anoFeriasRestantes;
      const dataApresentacaoFeriasRestantes = formatadordeData(adicionarDiasEmUmaData(inputs.dataInicioFeriasRestantes, quantidadeDeDiasRestantes));
      const aPartirOuAcontar = ApartirOuAcontar(inputs.dataInicioFeriasRestantes);
      const dataInicioFeriasFormatadoPadraoOM = formatadordeData(inputs.dataInicioFeriasRestantes);
      const template = parseInt(quantidadeDeDiasRestantes) === 1 ? templates.diasRestantesSingular : templates.diasRestantesPlural;
      return template
        .replace('{{quantidadeDeDiasRestantes}}', quantidadeDeDiasRestantes)
        .replace('{{quantidadeDeDiasRestantesPorEXTENSO}}', quantidadeDeDiasRestantesPorEXTENSO)
        .replace('{{anoFerias}}', anoFerias)
        .replace('{{aPartirOuAcontar}}', aPartirOuAcontar)
        .replace('{{dataInicioFeriasFormatadoPadraoOM}}', dataInicioFeriasFormatadoPadraoOM)
        .replace('{{dataApresentacaoFeriasRestantes}}', dataApresentacaoFeriasRestantes);
    }

    // Adicionar validações e lógica para outros tipos (dispensa, instalacao, etc.) conforme necessário

    throw new Error('Tipo de afastamento não suportado');
  } catch (error) {
    console.error('Erro em processarDados:', error.message);
    throw error; // Re-throw para main.js
  }
}
