// scripts/modules/afastamentos.js
import { templates } from './templates.js';
import { formatadordeData, adicionarDiasEmUmaData, ApartirOuAcontar, numeroEmExtenso } from './formatacoes.js';

export function processarDados(tipoEspecificoDoAfastamento, inputs) {
  console.log('Processing tipo:', tipoEspecificoDoAfastamento, 'with inputs:', inputs); // Debug log
  // Validações gerais
  if (typeof tipoEspecificoDoAfastamento !== 'string' || !tipoEspecificoDoAfastamento) {
    throw new Error('Tipo específico de afastamento inválido');
  }
  if (typeof inputs !== 'object' || inputs === null) {
    throw new Error('Inputs devem ser um objeto válido');
  }

  try {
    if (tipoEspecificoDoAfastamento.startsWith('ferias')) {
      console.log('Processing férias type'); // Debug log
      // Validações para férias
      if (!inputs.anoFerias || inputs.anoFerias === 'null') {
        throw new Error('Ano das férias obrigatório');
      }
      if (typeof inputs.anoFerias !== 'string') {
        throw new Error('Ano das férias deve ser string');
      }
      if (!inputs.dataInicioFerias || !/^\d{4}-\d{2}-\d{2}$/.test(inputs.dataInicioFerias)) {
        throw new Error('Data de início das férias obrigatória e no formato YYYY-MM-DD');
      }
      const dataInicio = new Date(inputs.dataInicioFerias);
      if (isNaN(dataInicio.getTime())) {
        throw new Error('Data de início inválida');
      }

      if (tipoEspecificoDoAfastamento === 'ferias30dias') {
        const dataApresentacaoFerias = formatadordeData(adicionarDiasEmUmaData(inputs.dataInicioFerias, '30'));
        console.log('Calculated dataApresentacaoFerias:', dataApresentacaoFerias); // Debug log
        return templates.trintaDiasSeguidos
          .replace('{{anoFerias}}', inputs.anoFerias)
          .replace('{{aPartirOuAcontar}}', ApartirOuAcontar(inputs.dataInicioFerias))
          .replace('{{dataInicioFeriasFormatadoPadraoOM}}', formatadordeData(inputs.dataInicioFerias))
          .replace('{{dataApresentacaoFerias}}', dataApresentacaoFerias);
      } else if (tipoEspecificoDoAfastamento === 'ferias1parcela15' || tipoEspecificoDoAfastamento === 'ferias2parcela15') {
        const dataApresentacaoFerias15 = formatadordeData(adicionarDiasEmUmaData(inputs.dataInicioFerias, '15'));
        const template = tipoEspecificoDoAfastamento === 'ferias1parcela15' ? templates.primeiraParcelaQuinze : templates.segundaParcelaQuinze;
        return template
          .replace('{{anoFerias}}', inputs.anoFerias)
          .replace('{{aPartirOuAcontar}}', ApartirOuAcontar(inputs.dataInicioFerias))
          .replace('{{dataInicioFeriasFormatadoPadraoOM}}', formatadordeData(inputs.dataInicioFerias))
          .replace('{{dataApresentacaoFerias15}}', dataApresentacaoFerias15);
      } else if (tipoEspecificoDoAfastamento.startsWith('ferias') && tipoEspecificoDoAfastamento.includes('parcela10')) {
        const dataApresentacaoFerias10 = formatadordeData(adicionarDiasEmUmaData(inputs.dataInicioFerias, '10'));
        let template;
        if (tipoEspecificoDoAfastamento === 'ferias1parcela10') template = templates.primeiraParcelaDez;
        else if (tipoEspecificoDoAfastamento === 'ferias2parcela10') template = templates.segundaParcelaDez;
        else template = templates.terceiraParcelaDez;
        return template
          .replace('{{anoFerias}}', inputs.anoFerias)
          .replace('{{aPartirOuAcontar}}', ApartirOuAcontar(inputs.dataInicioFerias))
          .replace('{{dataInicioFeriasFormatadoPadraoOM}}', formatadordeData(inputs.dataInicioFerias))
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
