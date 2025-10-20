// scripts/modules/mudancaPlanoFerias.js
import { templates } from './templates.js';
import { formatadordeData, adicionarDiasEmUmaData } from './formatacoes.js';

export function processarMudancaPlanoFerias(tipoEspecificoMudancaPlanoFerias, inputs) {
  console.log('Processing mudanca plano ferias tipo:', tipoEspecificoMudancaPlanoFerias, 'with inputs:', inputs);
  // Validações gerais
  if (typeof tipoEspecificoMudancaPlanoFerias !== 'string' || !tipoEspecificoMudancaPlanoFerias) {
    throw new Error('Tipo específico de mudança no plano de férias inválido');
  }
  if (typeof inputs !== 'object' || inputs === null) {
    throw new Error('Inputs devem ser um objeto válido');
  }
  if (!inputs.anoFeriasMudanca || inputs.anoFeriasMudanca === 'null') {
    throw new Error('Ano de referência obrigatório');
  }
  if (!inputs.nrDiexSolicitacao) {
    throw new Error('Número do DIEx obrigatório');
  }
  if (!inputs.nrNUP) {
    throw new Error('Número NUP/EB obrigatório');
  }
  if (!inputs.data_do_DIEx || !/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_do_DIEx)) {
    throw new Error('Data do DIEx obrigatória e no formato YYYY-MM-DD');
  }
  if (!inputs.solicitanteMudanca || inputs.solicitanteMudanca === 'null') {
    throw new Error('Solicitante da mudança obrigatório');
  }

  const anoDeReferencia = inputs.anoFeriasMudanca;
  const nrDIExSolicitacao = inputs.nrDiexSolicitacao;
  const nrNupEb = inputs.nrNUP;
  const dataDoDIExFormatada = formatadordeData(inputs.data_do_DIEx);
  const quemSolicitouMudanca = inputs.solicitanteMudanca;

  const refDIEx = templates.refDIEx
    .replace('{{nRdiexSolicitacao}}', nrDIExSolicitacao)
    .replace('{{nup}}', nrNupEb)
    .replace('{{dataDIExFormatadoPadraoOM}}', dataDoDIExFormatada)
    .replace('{{remetente}}', quemSolicitouMudanca);

  try {
    if (tipoEspecificoMudancaPlanoFerias === 'mudancaParcelaUnica30P30-UMAPARCD10-UMAPARCD15') {
      if (!inputs.mudarDiaParc301510 || inputs.mudarDiaParc301510 === 'null') {
        throw new Error('Parcela a mudar obrigatória');
      }
      if (!inputs.data_publicada_mudanca_dia || !/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_publicada_mudanca_dia)) {
        throw new Error('Data publicada obrigatória e no formato YYYY-MM-DD');
      }
      if (!inputs.data_solicitada_mudanca_dia || !/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_solicitada_mudanca_dia)) {
        throw new Error('Data solicitada obrigatória e no formato YYYY-MM-DD');
      }
      const parcelaFerias = inputs.mudarDiaParc301510;
      const dataPublicada = inputs.data_publicada_mudanca_dia;
      const dataSolicitada = inputs.data_solicitada_mudanca_dia;

      let days;
      if (parcelaFerias === 'Parcela Única') {
        days = 30;
      } else if (parcelaFerias.includes('15')) {
        days = 15;
      } else {
        days = 10;
      }

      const dataAprsFormatada = formatadordeData(adicionarDiasEmUmaData(dataPublicada, days - 1));
      const dataPublicadaFormatted = formatadordeData(dataPublicada);
      const UltimoDiaParaDataSolicitada = formatadordeData(adicionarDiasEmUmaData(dataSolicitada, days - 1));
      const ApresentParaDataSolicitada = formatadordeData(adicionarDiasEmUmaData(dataSolicitada, days));
      const dataSolicitadaFormatted = formatadordeData(dataSolicitada);

      return templates.mudancaFeriasParcelaUnica
        .replace('{{quemSolicitouMudanca}}', quemSolicitouMudanca)
        .replace('{{anoDeReferencia}}', anoDeReferencia)
        .replace('{{dataPublicada}}', dataPublicadaFormatted)
        .replace('{{dataAprsFormatada}}', dataAprsFormatada)
        .replace('{{dataSolicitada}}', dataSolicitadaFormatted)
        .replace('{{UltimoDiaParaDataSolicitada}}', UltimoDiaParaDataSolicitada)
        .replace('{{ApresentParaDataSolicitada}}', ApresentParaDataSolicitada)
        .replace('{{refDIEx}}', refDIEx);
    }

    if (tipoEspecificoMudancaPlanoFerias === 'mudancaParcelaUnica30P2D15') {
      if (!inputs.data_publicada_mudanca_PF30_2D15 || !/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_publicada_mudanca_PF30_2D15)) {
        throw new Error('Data publicada obrigatória e no formato YYYY-MM-DD');
      }
      if (!inputs.data_solicitada_mudanca_PF30_2D15_1 || !/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_solicitada_mudanca_PF30_2D15_1)) {
        throw new Error('Data solicitada 1 obrigatória e no formato YYYY-MM-DD');
      }
      if (!inputs.data_solicitada_mudanca_PF30_2D15_2 || !/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_solicitada_mudanca_PF30_2D15_2)) {
        throw new Error('Data solicitada 2 obrigatória e no formato YYYY-MM-DD');
      }
      const dataPublicada = inputs.data_publicada_mudanca_PF30_2D15;
      const dataSolicitada1 = inputs.data_solicitada_mudanca_PF30_2D15_1;
      const dataSolicitada2 = inputs.data_solicitada_mudanca_PF30_2D15_2;

      const ultimoDiaParaDataPublicadaFormatado = formatadordeData(adicionarDiasEmUmaData(dataPublicada, 29));
      const dataPublicadaFormatted = formatadordeData(dataPublicada);
      const ultimoDiaParaDataSolicitada1 = formatadordeData(adicionarDiasEmUmaData(dataSolicitada1, 14));
      const dataApresentacaoParaDataSolicitada1 = formatadordeData(adicionarDiasEmUmaData(dataSolicitada1, 15));
      const dataSolicitada1Formatted = formatadordeData(dataSolicitada1);
      const ultimoDiaParaDataSolicitada2 = formatadordeData(adicionarDiasEmUmaData(dataSolicitada2, 14));
      const dataApresentacaoParaDataSolicitada2 = formatadordeData(adicionarDiasEmUmaData(dataSolicitada2, 15));
      const dataSolicitada2Formatted = formatadordeData(dataSolicitada2);

      return templates.mudancaFerias30Para2x15
        .replace('{{quemSolicitouMudanca}}', quemSolicitouMudanca)
        .replace('{{anoDeReferencia}}', anoDeReferencia)
        .replace('{{dataPublicada}}', dataPublicadaFormatted)
        .replace('{{ultimoDiaParaDataPublicadaFormatado}}', ultimoDiaParaDataPublicadaFormatado)
        .replace('{{dataSolicitada1}}', dataSolicitada1Formatted)
        .replace('{{ultimoDiaParaDataSolicitada1}}', ultimoDiaParaDataSolicitada1)
        .replace('{{dataApresentacaoParaDataSolicitada1}}', dataApresentacaoParaDataSolicitada1)
        .replace('{{dataSolicitada2}}', dataSolicitada2Formatted)
        .replace('{{ultimoDiaParaDataSolicitada2}}', ultimoDiaParaDataSolicitada2)
        .replace('{{dataApresentacaoParaDataSolicitada2}}', dataApresentacaoParaDataSolicitada2)
        .replace('{{refDIEx}}', refDIEx);
    }

    if (tipoEspecificoMudancaPlanoFerias === 'mudanca30P3D10') {
      if (!inputs.data_publicada_mudanca_PF30_3D10 || !/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_publicada_mudanca_PF30_3D10)) {
        throw new Error('Data publicada obrigatória e no formato YYYY-MM-DD');
      }
      if (!inputs.data_solicitada_mudanca_PF30_3D10_1 || !/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_solicitada_mudanca_PF30_3D10_1)) {
        throw new Error('Data solicitada 1 obrigatória e no formato YYYY-MM-DD');
      }
      if (!inputs.data_solicitada_mudanca_PF30_3D10_2 || !/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_solicitada_mudanca_PF30_3D10_2)) {
        throw new Error('Data solicitada 2 obrigatória e no formato YYYY-MM-DD');
      }
      if (!inputs.data_solicitada_mudanca_PF30_3D10_3 || !/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_solicitada_mudanca_PF30_3D10_3)) {
        throw new Error('Data solicitada 3 obrigatória e no formato YYYY-MM-DD');
      }
      const dataPublicada = inputs.data_publicada_mudanca_PF30_3D10;
      const dataSolicitada1 = inputs.data_solicitada_mudanca_PF30_3D10_1;
      const dataSolicitada2 = inputs.data_solicitada_mudanca_PF30_3D10_2;
      const dataSolicitada3 = inputs.data_solicitada_mudanca_PF30_3D10_3;

      const ultimoDiaParaDataPublicadaFormatado = formatadordeData(adicionarDiasEmUmaData(dataPublicada, 29));
      const dataPublicadaFormatted = formatadordeData(dataPublicada);
      const ultimoDiaParaDataSolicitada1 = formatadordeData(adicionarDiasEmUmaData(dataSolicitada1, 9));
      const dataApresentacaoParaDataSolicitada1 = formatadordeData(adicionarDiasEmUmaData(dataSolicitada1, 10));
      const dataSolicitada1Formatted = formatadordeData(dataSolicitada1);
      const ultimoDiaParaDataSolicitada2 = formatadordeData(adicionarDiasEmUmaData(dataSolicitada2, 9));
      const dataApresentacaoParaDataSolicitada2 = formatadordeData(adicionarDiasEmUmaData(dataSolicitada2, 10));
      const dataSolicitada2Formatted = formatadordeData(dataSolicitada2);
      const ultimoDiaParaDataSolicitada3 = formatadordeData(adicionarDiasEmUmaData(dataSolicitada3, 9));
      const dataApresentacaoParaDataSolicitada3 = formatadordeData(adicionarDiasEmUmaData(dataSolicitada3, 10));
      const dataSolicitada3Formatted = formatadordeData(dataSolicitada3);

      return templates.mudancaFerias30Para3x10
        .replace('{{quemSolicitouMudanca}}', quemSolicitouMudanca)
        .replace('{{anoDeReferencia}}', anoDeReferencia)
        .replace('{{dataPublicada}}', dataPublicadaFormatted)
        .replace('{{ultimoDiaParaDataPublicadaFormatado}}', ultimoDiaParaDataPublicadaFormatado)
        .replace('{{dataSolicitada1}}', dataSolicitada1Formatted)
        .replace('{{ultimoDiaParaDataSolicitada1}}', ultimoDiaParaDataSolicitada1)
        .replace('{{dataApresentacaoParaDataSolicitada1}}', dataApresentacaoParaDataSolicitada1)
        .replace('{{dataSolicitada2}}', dataSolicitada2Formatted)
        .replace('{{ultimoDiaParaDataSolicitada2}}', ultimoDiaParaDataSolicitada2)
        .replace('{{dataApresentacaoParaDataSolicitada2}}', dataApresentacaoParaDataSolicitada2)
        .replace('{{dataSolicitada3}}', dataSolicitada3Formatted)
        .replace('{{ultimoDiaParaDataSolicitada3}}', ultimoDiaParaDataSolicitada3)
        .replace('{{dataApresentacaoParaDataSolicitada3}}', dataApresentacaoParaDataSolicitada3)
        .replace('{{refDIEx}}', refDIEx);
    }

    if (tipoEspecificoMudancaPlanoFerias === 'mudanca2D15P30') {
      if (!inputs.data_publicada_mudanca_PF2D15_30_1 || !/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_publicada_mudanca_PF2D15_30_1)) {
        throw new Error('Data publicada 1 obrigatória e no formato YYYY-MM-DD');
      }
      if (!inputs.data_publicada_mudanca_PF2D15_30_2 || !/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_publicada_mudanca_PF2D15_30_2)) {
        throw new Error('Data publicada 2 obrigatória e no formato YYYY-MM-DD');
      }
      if (!inputs.data_solicitada_mudanca_PF2D15_30 || !/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_solicitada_mudanca_PF2D15_30)) {
        throw new Error('Data solicitada obrigatória e no formato YYYY-MM-DD');
      }
      const dataPublicada = inputs.data_publicada_mudanca_PF2D15_30_1;
      const dataPublicada2 = inputs.data_publicada_mudanca_PF2D15_30_2;
      const dataSolicitada = inputs.data_solicitada_mudanca_PF2D15_30;

      const ultimoDiaParaDataPublicadaFormatado = formatadordeData(adicionarDiasEmUmaData(dataPublicada, 14));
      const dataPublicadaFormatted = formatadordeData(dataPublicada);
      const ultimoDiaParaSegundaDataPublicadaFormatado = formatadordeData(adicionarDiasEmUmaData(dataPublicada2, 14));
      const dataPublicada2Formatted = formatadordeData(dataPublicada2);
      const ultimoDiaParaDataSolicitada = formatadordeData(adicionarDiasEmUmaData(dataSolicitada, 29));
      const dataApresentacaoParaDataSolicitada = formatadordeData(adicionarDiasEmUmaData(dataSolicitada, 30));
      const dataSolicitadaFormatted = formatadordeData(dataSolicitada);

      return templates.mudancaFerias2x15Para30
        .replace('{{quemSolicitouMudanca}}', quemSolicitouMudanca)
        .replace('{{anoDeReferencia}}', anoDeReferencia)
        .replace('{{dataPublicada}}', dataPublicadaFormatted)
        .replace('{{ultimoDiaParaDataPublicadaFormatado}}', ultimoDiaParaDataPublicadaFormatado)
        .replace('{{dataPublicada2}}', dataPublicada2Formatted)
        .replace('{{ultimoDiaParaSegundaDataPublicadaFormatado}}', ultimoDiaParaDataPublicadaFormatado)
        .replace('{{dataSolicitada}}', dataSolicitadaFormatted)
        .replace('{{ultimoDiaParaDataSolicitada}}', ultimoDiaParaDataSolicitada)
        .replace('{{dataApresentacaoParaDataSolicitada}}', dataApresentacaoParaDataSolicitada)
        .replace('{{refDIEx}}', refDIEx);
    }

    if (tipoEspecificoMudancaPlanoFerias === 'mudanca2D15P2D15DIFF') {
      if (!inputs.data_publicada_mudanca_PF2D15_2D15DIFF_1 || !/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_publicada_mudanca_PF2D15_2D15DIFF_1)) {
        throw new Error('Data publicada 1 obrigatória e no formato YYYY-MM-DD');
      }
      if (!inputs.data_publicada_mudanca_PF2D15_2D15DIFF_2 || !/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_publicada_mudanca_PF2D15_2D15DIFF_2)) {
        throw new Error('Data publicada 2 obrigatória e no formato YYYY-MM-DD');
      }
      if (!inputs.data_solicitada_mudanca_PF2D15_2D15DIFF_1 || !/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_solicitada_mudanca_PF2D15_2D15DIFF_1)) {
        throw new Error('Data solicitada 1 obrigatória e no formato YYYY-MM-DD');
      }
      if (!inputs.data_solicitada_mudanca_PF2D15_2D15DIFF_2 || !/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_solicitada_mudanca_PF2D15_2D15DIFF_2)) {
        throw new Error('Data solicitada 2 obrigatória e no formato YYYY-MM-DD');
      }
      const dataPublicada = inputs.data_publicada_mudanca_PF2D15_2D15DIFF_1;
      const dataPublicada2 = inputs.data_publicada_mudanca_PF2D15_2D15DIFF_2;
      const dataSolicitada = inputs.data_solicitada_mudanca_PF2D15_2D15DIFF_1;
      const dataSolicitada2 = inputs.data_solicitada_mudanca_PF2D15_2D15DIFF_2;

      const ultimoDiaParaDataPublicadaFormatado = formatadordeData(adicionarDiasEmUmaData(dataPublicada, 14));
      const dataPublicadaFormatted = formatadordeData(dataPublicada);
      const ultimoDiaParaDataPublicada2Formatado = formatadordeData(adicionarDiasEmUmaData(dataPublicada2, 14));
      const dataPublicada2Formatted = formatadordeData(dataPublicada2);
      const ultimoDiaParaDataSolicitada = formatadordeData(adicionarDiasEmUmaData(dataSolicitada, 14));
      const dataApresentacaoParaDataSolicitada = formatadordeData(adicionarDiasEmUmaData(dataSolicitada, 15));
      const dataSolicitadaFormatted = formatadordeData(dataSolicitada);
      const ultimoDiaParaDataSolicitada2 = formatadordeData(adicionarDiasEmUmaData(dataSolicitada2, 14));
      const dataApresentacaoParaDataSolicitada2 = formatadordeData(adicionarDiasEmUmaData(dataSolicitada2, 15));
      const dataSolicitada2Formatted = formatadordeData(dataSolicitada2);

      return templates.mudancaFerias2x15Para2x15Diff
        .replace('{{quemSolicitouMudanca}}', quemSolicitouMudanca)
        .replace('{{anoDeReferencia}}', anoDeReferencia)
        .replace('{{dataPublicada}}', dataPublicadaFormatted)
        .replace('{{ultimoDiaParaDataPublicadaFormatado}}', ultimoDiaParaDataPublicadaFormatado)
        .replace('{{dataPublicada2}}', dataPublicada2Formatted)
        .replace('{{ultimoDiaParaDataPublicada2Formatado}}', ultimoDiaParaDataPublicada2Formatado)
        .replace('{{dataSolicitada}}', dataSolicitadaFormatted)
        .replace('{{ultimoDiaParaDataSolicitada}}', ultimoDiaParaDataSolicitada)
        .replace('{{dataApresentacaoParaDataSolicitada}}', dataApresentacaoParaDataSolicitada)
        .replace('{{dataSolicitada2}}', dataSolicitada2Formatted)
        .replace('{{ultimoDiaParaDataSolicitada2}}', ultimoDiaParaDataSolicitada2)
        .replace('{{dataApresentacaoParaDataSolicitada2}}', dataApresentacaoParaDataSolicitada2)
        .replace('{{refDIEx}}', refDIEx);
    }

    if (tipoEspecificoMudancaPlanoFerias === 'mudanca3D10P30') {
      if (!inputs.data_publicada_mudanca_PF3D10_30_1 || !/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_publicada_mudanca_PF3D10_30_1)) {
        throw new Error('Data publicada 1 obrigatória e no formato YYYY-MM-DD');
      }
      if (!inputs.data_publicada_mudanca_PF3D10_30_2 || !/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_publicada_mudanca_PF3D10_30_2)) {
        throw new Error('Data publicada 2 obrigatória e no formato YYYY-MM-DD');
      }
      if (!inputs.data_publicada_mudanca_PF3D10_30_3 || !/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_publicada_mudanca_PF3D10_30_3)) {
        throw new Error('Data publicada 3 obrigatória e no formato YYYY-MM-DD');
      }
      if (!inputs.data_solicitada_mudanca_PF3D10_30 || !/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_solicitada_mudanca_PF3D10_30)) {
        throw new Error('Data solicitada obrigatória e no formato YYYY-MM-DD');
      }
      const dataPublicada = inputs.data_publicada_mudanca_PF3D10_30_1;
      const dataPublicada2 = inputs.data_publicada_mudanca_PF3D10_30_2;
      const dataPublicada3 = inputs.data_publicada_mudanca_PF3D10_30_3;
      const dataSolicitada = inputs.data_solicitada_mudanca_PF3D10_30;

      const ultimoDiaParaDataPublicadaFormatado = formatadordeData(adicionarDiasEmUmaData(dataPublicada, 9));
      const dataPublicadaFormatted = formatadordeData(dataPublicada);
      const ultimoDiaParaDataPublicada2Formatado = formatadordeData(adicionarDiasEmUmaData(dataPublicada2, 9));
      const dataPublicada2Formatted = formatadordeData(dataPublicada2);
      const ultimoDiaParaDataPublicada3Formatado = formatadordeData(adicionarDiasEmUmaData(dataPublicada3, 9));
      const dataPublicada3Formatted = formatadordeData(dataPublicada3);
      const ultimoDiaParaDataSolicitada = formatadordeData(adicionarDiasEmUmaData(dataSolicitada, 29));
      const dataApresentacaoParaDataSolicitada = formatadordeData(adicionarDiasEmUmaData(dataSolicitada, 30));
      const dataSolicitadaFormatted = formatadordeData(dataSolicitada);

      return templates.mudancaFerias3x10Para30
        .replace('{{quemSolicitouMudanca}}', quemSolicitouMudanca)
        .replace('{{anoDeReferencia}}', anoDeReferencia)
        .replace('{{dataPublicada}}', dataPublicadaFormatted)
        .replace('{{ultimoDiaParaDataPublicadaFormatado}}', ultimoDiaParaDataPublicadaFormatado)
        .replace('{{dataPublicada2}}', dataPublicada2Formatted)
        .replace('{{ultimoDiaParaDataPublicada2Formatado}}', ultimoDiaParaDataPublicada2Formatado)
        .replace('{{dataPublicada3}}', dataPublicada3Formatted)
        .replace('{{ultimoDiaParaDataPublicada3Formatado}}', ultimoDiaParaDataPublicada3Formatado)
        .replace('{{dataSolicitada}}', dataSolicitadaFormatted)
        .replace('{{ultimoDiaParaDataSolicitada}}', ultimoDiaParaDataSolicitada)
        .replace('{{dataApresentacaoParaDataSolicitada}}', dataApresentacaoParaDataSolicitada)
        .replace('{{refDIEx}}', refDIEx);
    }

    if (tipoEspecificoMudancaPlanoFerias === 'mudanca3D10P3D10DIF') {
      if (!inputs.data_publicada_mudanca_PF3D10_3D10DIF_1 || !/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_publicada_mudanca_PF3D10_3D10DIF_1)) {
        throw new Error('Data publicada 1 obrigatória e no formato YYYY-MM-DD');
      }
      if (!inputs.data_publicada_mudanca_PF3D10_3D10DIF_2 || !/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_publicada_mudanca_PF3D10_3D10DIF_2)) {
        throw new Error('Data publicada 2 obrigatória e no formato YYYY-MM-DD');
      }
      if (!inputs.data_publicada_mudanca_PF3D10_3D10DIF_3 || !/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_publicada_mudanca_PF3D10_3D10DIF_3)) {
        throw new Error('Data publicada 3 obrigatória e no formato YYYY-MM-DD');
      }
      if (!inputs.data_solicitada_mudanca_PF3D10_3D10DIF_1 || !/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_solicitada_mudanca_PF3D10_3D10DIF_1)) {
        throw new Error('Data solicitada 1 obrigatória e no formato YYYY-MM-DD');
      }
      if (!inputs.data_solicitada_mudanca_PF3D10_3D10DIF_2 || !/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_solicitada_mudanca_PF3D10_3D10DIF_2)) {
        throw new Error('Data solicitada 2 obrigatória e no formato YYYY-MM-DD');
      }
      if (!inputs.data_solicitada_mudanca_PF3D10_3D10DIF_3 || !/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_solicitada_mudanca_PF3D10_3D10DIF_3)) {
        throw new Error('Data solicitada 3 obrigatória e no formato YYYY-MM-DD');
      }
      const dataPublicada = inputs.data_publicada_mudanca_PF3D10_3D10DIF_1;
      const dataPublicada2 = inputs.data_publicada_mudanca_PF3D10_3D10DIF_2;
      const dataPublicada3 = inputs.data_publicada_mudanca_PF3D10_3D10DIF_3;
      const dataSolicitada = inputs.data_solicitada_mudanca_PF3D10_3D10DIF_1;
      const dataSolicitada2 = inputs.data_solicitada_mudanca_PF3D10_3D10DIF_2;
      const dataSolicitada3 = inputs.data_solicitada_mudanca_PF3D10_3D10DIF_3;

      const ultimoDiaParaDataPublicadaFormatado = formatadordeData(adicionarDiasEmUmaData(dataPublicada, 9));
      const dataPublicadaFormatted = formatadordeData(dataPublicada);
      const ultimoDiaParaDataPublicada2Formatado = formatadordeData(adicionarDiasEmUmaData(dataPublicada2, 9));
      const dataPublicada2Formatted = formatadordeData(dataPublicada2);
      const ultimoDiaParaDataPublicada3Formatado = formatadordeData(adicionarDiasEmUmaData(dataPublicada3, 9));
      const dataPublicada3Formatted = formatadordeData(dataPublicada3);
      const ultimoDiaParaDataSolicitada = formatadordeData(adicionarDiasEmUmaData(dataSolicitada, 9));
      const dataApresentacaoParaDataSolicitada = formatadordeData(adicionarDiasEmUmaData(dataSolicitada, 10));
      const dataSolicitadaFormatted = formatadordeData(dataSolicitada);
      const ultimoDiaParaDataSolicitada2 = formatadordeData(adicionarDiasEmUmaData(dataSolicitada2, 9));
      const dataApresentacaoParaDataSolicitada2 = formatadordeData(adicionarDiasEmUmaData(dataSolicitada2, 10));
      const dataSolicitada2Formatted = formatadordeData(dataSolicitada2);
      const ultimoDiaParaDataSolicitada3 = formatadordeData(adicionarDiasEmUmaData(dataSolicitada3, 9));
      const dataApresentacaoParaDataSolicitada3 = formatadordeData(adicionarDiasEmUmaData(dataSolicitada3, 10));
      const dataSolicitada3Formatted = formatadordeData(dataSolicitada3);

      return templates.mudancaFerias3x10Para3x10Diff
        .replace('{{quemSolicitouMudanca}}', quemSolicitouMudanca)
        .replace('{{anoDeReferencia}}', anoDeReferencia)
        .replace('{{dataPublicada}}', dataPublicadaFormatted)
        .replace('{{ultimoDiaParaDataPublicadaFormatado}}', ultimoDiaParaDataPublicadaFormatado)
        .replace('{{dataPublicada2}}', dataPublicada2Formatted)
        .replace('{{ultimoDiaParaDataPublicada2Formatado}}', ultimoDiaParaDataPublicada2Formatado)
        .replace('{{dataPublicada3}}', dataPublicada3Formatted)
        .replace('{{ultimoDiaParaDataPublicada3Formatado}}', ultimoDiaParaDataPublicada3Formatado)
        .replace('{{dataSolicitada}}', dataSolicitadaFormatted)
        .replace('{{ultimoDiaParaDataSolicitada}}', ultimoDiaParaDataSolicitada)
        .replace('{{dataApresentacaoParaDataSolicitada}}', dataApresentacaoParaDataSolicitada)
        .replace('{{dataSolicitada2}}', dataSolicitada2Formatted)
        .replace('{{ultimoDiaParaDataSolicitada2}}', ultimoDiaParaDataSolicitada2)
        .replace('{{dataApresentacaoParaDataSolicitada2}}', dataApresentacaoParaDataSolicitada2)
        .replace('{{dataSolicitada3}}', dataSolicitada3Formatted)
        .replace('{{ultimoDiaParaDataSolicitada3}}', ultimoDiaParaDataSolicitada3)
        .replace('{{dataApresentacaoParaDataSolicitada3}}', dataApresentacaoParaDataSolicitada3)
        .replace('{{refDIEx}}', refDIEx);
    }

    if (tipoEspecificoMudancaPlanoFerias === 'mudanca2D15_3D10') {
      if (!inputs.data_publicada_mudanca_PF2D15_3D10_1 || !/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_publicada_mudanca_PF2D15_3D10_1)) {
        throw new Error('Data publicada 1 obrigatória e no formato YYYY-MM-DD');
      }
      if (!inputs.data_publicada_mudanca_PF2D15_3D10_2 || !/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_publicada_mudanca_PF2D15_3D10_2)) {
        throw new Error('Data publicada 2 obrigatória e no formato YYYY-MM-DD');
      }
      if (!inputs.data_solicitada_mudanca_PF2D15_3D10_1 || !/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_solicitada_mudanca_PF2D15_3D10_1)) {
        throw new Error('Data solicitada 1 obrigatória e no formato YYYY-MM-DD');
      }
      if (!inputs.data_solicitada_mudanca_PF2D15_3D10_2 || !/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_solicitada_mudanca_PF2D15_3D10_2)) {
        throw new Error('Data solicitada 2 obrigatória e no formato YYYY-MM-DD');
      }
      if (!inputs.data_solicitada_mudanca_PF2D15_3D10_3 || !/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_solicitada_mudanca_PF2D15_3D10_3)) {
        throw new Error('Data solicitada 3 obrigatória e no formato YYYY-MM-DD');
      }
      const dataPublicada = inputs.data_publicada_mudanca_PF2D15_3D10_1;
      const dataPublicada2 = inputs.data_publicada_mudanca_PF2D15_3D10_2;
      const dataSolicitada = inputs.data_solicitada_mudanca_PF2D15_3D10_1;
      const dataSolicitada2 = inputs.data_solicitada_mudanca_PF2D15_3D10_2;
      const dataSolicitada3 = inputs.data_solicitada_mudanca_PF2D15_3D10_3;

      const ultimoDiaParaDataPublicadaFormatado = formatadordeData(adicionarDiasEmUmaData(dataPublicada, 14));
      const dataPublicadaFormatted = formatadordeData(dataPublicada);
      const ultimoDiaParaDataPublicada2Formatado = formatadordeData(adicionarDiasEmUmaData(dataPublicada2, 14));
      const dataPublicada2Formatted = formatadordeData(dataPublicada2);
      const ultimoDiaParaDataSolicitada = formatadordeData(adicionarDiasEmUmaData(dataSolicitada, 9));
      const dataApresentacaoParaDataSolicitada = formatadordeData(adicionarDiasEmUmaData(dataSolicitada, 10));
      const dataSolicitadaFormatted = formatadordeData(dataSolicitada);
      const ultimoDiaParaDataSolicitada2 = formatadordeData(adicionarDiasEmUmaData(dataSolicitada2, 9));
      const dataApresentacaoParaDataSolicitada2 = formatadordeData(adicionarDiasEmUmaData(dataSolicitada2, 10));
      const dataSolicitada2Formatted = formatadordeData(dataSolicitada2);
      const ultimoDiaParaDataSolicitada3 = formatadordeData(adicionarDiasEmUmaData(dataSolicitada3, 9));
      const dataApresentacaoParaDataSolicitada3 = formatadordeData(adicionarDiasEmUmaData(dataSolicitada3, 10));
      const dataSolicitada3Formatted = formatadordeData(dataSolicitada3);

      return templates.mudancaFerias2x15Para3x10
        .replace('{{quemSolicitouMudanca}}', quemSolicitouMudanca)
        .replace('{{anoDeReferencia}}', anoDeReferencia)
        .replace('{{dataPublicada}}', dataPublicadaFormatted)
        .replace('{{ultimoDiaParaDataPublicadaFormatado}}', ultimoDiaParaDataPublicadaFormatado)
        .replace('{{dataPublicada2}}', dataPublicada2Formatted)
        .replace('{{ultimoDiaParaDataPublicada2Formatado}}', ultimoDiaParaDataPublicada2Formatado)
        .replace('{{dataSolicitada}}', dataSolicitadaFormatted)
        .replace('{{ultimoDiaParaDataSolicitada}}', ultimoDiaParaDataSolicitada)
        .replace('{{dataApresentacaoParaDataSolicitada}}', dataApresentacaoParaDataSolicitada)
        .replace('{{dataSolicitada2}}', dataSolicitada2Formatted)
        .replace('{{ultimoDiaParaDataSolicitada2}}', ultimoDiaParaDataSolicitada2)
        .replace('{{dataApresentacaoParaDataSolicitada2}}', dataApresentacaoParaDataSolicitada2)
        .replace('{{dataSolicitada3}}', dataSolicitada3Formatted)
        .replace('{{ultimoDiaParaDataSolicitada3}}', ultimoDiaParaDataSolicitada3)
        .replace('{{dataApresentacaoParaDataSolicitada3}}', dataApresentacaoParaDataSolicitada3)
        .replace('{{refDIEx}}', refDIEx);
    }

    // Add more if statements for other tipos

    throw new Error('Tipo de mudança no plano de férias não suportado');
  } catch (error) {
    console.error('Erro em processarMudancaPlanoFerias:', error.message);
    throw error;
  }
}
