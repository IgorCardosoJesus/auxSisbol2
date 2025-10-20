// scripts/modules/apresentacoes.js
import { templates } from './templates.js';
import { formatadordeData, numeroEmExtenso, tiraZeroAEsquerda } from './formatacoes.js';

export function processarApresentacao(tipoEspecificoDeApresentacao, inputs) {
  console.log('Processing apresentacao tipo:', tipoEspecificoDeApresentacao, 'with inputs:', inputs);
  // Validações gerais
  if (typeof tipoEspecificoDeApresentacao !== 'string' || !tipoEspecificoDeApresentacao) {
    throw new Error('Tipo específico de apresentação inválido');
  }
  if (typeof inputs !== 'object' || inputs === null) {
    throw new Error('Inputs devem ser um objeto válido');
  }
  if (!inputs.data_apresentacao || !/^\d{4}-\d{2}-\d{2}$/.test(inputs.data_apresentacao)) {
    throw new Error('Data de apresentação obrigatória e no formato YYYY-MM-DD');
  }

  const dataApresentacaoFormatadaPadraoBR = formatadordeData(inputs.data_apresentacao);

  try {
    if (['term30dias', 'term1parcela15', 'term2parcela15', 'term1parcela10', 'term2parcela10', 'term3parcela10'].includes(tipoEspecificoDeApresentacao)) {
      if (!inputs.AnoFerias) {
        throw new Error('Ano das férias obrigatório');
      }
      let template;
      if (tipoEspecificoDeApresentacao === 'term30dias') template = templates.apresentacaoFerias30;
      else if (tipoEspecificoDeApresentacao === 'term1parcela15') template = templates.apresentacaoFerias1Parcela15;
      else if (tipoEspecificoDeApresentacao === 'term2parcela15') template = templates.apresentacaoFerias2Parcela15;
      else if (tipoEspecificoDeApresentacao === 'term1parcela10') template = templates.apresentacaoFerias1Parcela10;
      else if (tipoEspecificoDeApresentacao === 'term2parcela10') template = templates.apresentacaoFerias2Parcela10;
      else template = templates.apresentacaoFerias3Parcela10;
      return template
        .replace('{{dataApresentacaoFormatadaPadraoBR}}', dataApresentacaoFormatadaPadraoBR)
        .replace('{{anoDaParcelaFerias}}', inputs.AnoFerias);
    }

    if (['termTransmCargoEncargo', 'termRecebCargoEncargo', 'termPassCargoMaterial', 'termRecebCargoMaterial'].includes(tipoEspecificoDeApresentacao)) {
      if (!inputs.apresentouTermRecebFuncaoCargoEncargo) {
        throw new Error('Função obrigatória');
      }
      let template;
      if (tipoEspecificoDeApresentacao === 'termTransmCargoEncargo') template = templates.apresentacaoTransmCargoEncargo;
      else if (tipoEspecificoDeApresentacao === 'termRecebCargoEncargo') template = templates.apresentacaoRecebCargoEncargo;
      else if (tipoEspecificoDeApresentacao === 'termPassCargoMaterial') template = templates.apresentacaoPassCargoMaterial;
      else template = templates.apresentacaoRecebCargoMaterial;
      return template
        .replace('{{dataApresentacaoFormatadaPadraoBR}}', dataApresentacaoFormatadaPadraoBR)
        .replace('{{funcao}}', inputs.apresentouTermRecebFuncaoCargoEncargo);
    }

    if (['termPassMaterial', 'termRecebMaterial'].includes(tipoEspecificoDeApresentacao)) {
      if (!inputs.apresentouTermPassouRecebCarga) {
        throw new Error('Pelotão ou etc obrigatório');
      }
      const template = tipoEspecificoDeApresentacao === 'termPassMaterial' ? templates.apresentacaoPassMaterial : templates.apresentacaoRecebMaterial;
      return template
        .replace('{{dataApresentacaoFormatadaPadraoBR}}', dataApresentacaoFormatadaPadraoBR)
        .replace('{{pelotaoOuEtc}}', inputs.apresentouTermPassouRecebCarga);
    }

    if (tipoEspecificoDeApresentacao === 'termDispRecoCmtBtl') {
      if (!inputs.DiasDispCmt) {
        throw new Error('Dias de dispensa obrigatório');
      }
      const qtdeDiasDispCmt = inputs.DiasDispCmt;
      const qtdeDiasDispCmtExtenso = numeroEmExtenso(qtdeDiasDispCmt);
      const qtdeDiasDispCmtSzero = tiraZeroAEsquerda(qtdeDiasDispCmt);
      const template = qtdeDiasDispCmtSzero === '1' ? templates.apresentacaoDispCmtBtlSingular : templates.apresentacaoDispCmtBtlPlural;
      return template
        .replace('{{dataApresentacaoFormatadaPadraoBR}}', dataApresentacaoFormatadaPadraoBR)
        .replace('{{qtdeDiasDispCmtSzero}}', qtdeDiasDispCmtSzero)
        .replace('{{qtdeDiasDispCmtExtenso}}', qtdeDiasDispCmtExtenso);
    }

    if (tipoEspecificoDeApresentacao === 'termDispRecoSCmt') {
      if (!inputs.DiasDispSCmt) {
        throw new Error('Dias de dispensa SCmt obrigatório');
      }
      const qtdeDiasDispScmt = inputs.DiasDispSCmt;
      const diasExtensoDispRecoSCmt = numeroEmExtenso(qtdeDiasDispScmt);
      const qtdeDiasDispScmtSzero = tiraZeroAEsquerda(qtdeDiasDispScmt);
      const template = qtdeDiasDispScmtSzero === '1' ? templates.apresentacaoDispSCmtSingular : templates.apresentacaoDispSCmtPlural;
      return template
        .replace('{{dataApresentacaoFormatadaPadraoBR}}', dataApresentacaoFormatadaPadraoBR)
        .replace('{{qtdeDiasDispScmtSzero}}', qtdeDiasDispScmtSzero)
        .replace('{{diasExtensoDispRecoSCmt}}', diasExtensoDispRecoSCmt);
    }

    if (tipoEspecificoDeApresentacao === 'termDispRecoCmtCia') {
      if (!inputs.CmtSUBondoso || !inputs.DiasDispCmtSU) {
        throw new Error('Cmt SU e dias obrigatórios');
      }
      const diasDispCmtSU = inputs.DiasDispCmtSU;
      const diasExtensoDispRecoCmtCia = numeroEmExtenso(diasDispCmtSU);
      const diasDispCmtSUSzero = tiraZeroAEsquerda(diasDispCmtSU);
      const template = diasDispCmtSUSzero === '1' ? templates.apresentacaoDispCmtCiaSingular : templates.apresentacaoDispCmtCiaPlural;
      return template
        .replace('{{dataApresentacaoFormatadaPadraoBR}}', dataApresentacaoFormatadaPadraoBR)
        .replace('{{diasDispCmtSUSzero}}', diasDispCmtSUSzero)
        .replace('{{diasExtensoDispRecoCmtCia}}', diasExtensoDispRecoCmtCia)
        .replace('{{cmtSUBondoso}}', inputs.CmtSUBondoso);
    }

    if (['termDispDescoFerias', 'termInstalacao', 'termtransito', 'termnupcias', 'termluto'].includes(tipoEspecificoDeApresentacao)) {
      if (tipoEspecificoDeApresentacao === 'termDispDescoFerias') {
        if (!inputs.gozoDispDescoFerias || !inputs.DispDescFerias) {
          throw new Error('Dias e ano para desconto em férias obrigatórios');
        }
        const qtadadeDiasDescoFerias = inputs.gozoDispDescoFerias;
        const diasExtensoDescoFerias = numeroEmExtenso(qtadadeDiasDescoFerias);
        const qtadadeDiasDescoFeriasSZero = tiraZeroAEsquerda(qtadadeDiasDescoFerias);
        const template = qtadadeDiasDescoFeriasSZero === '1' ? templates.apresentacaoDispDescoFeriasSingular : templates.apresentacaoDispDescoFeriasPlural;
        return template
          .replace('{{dataApresentacaoFormatadaPadraoBR}}', dataApresentacaoFormatadaPadraoBR)
          .replace('{{qtadadeDiasDescoFeriasSZero}}', qtadadeDiasDescoFeriasSZero)
          .replace('{{diasExtensoDescoFerias}}', diasExtensoDescoFerias)
          .replace('{{anoRefDiasDescoFerias}}', inputs.DispDescFerias);
      } else if (tipoEspecificoDeApresentacao === 'termInstalacao') {
        return templates.apresentacaoInstalacao
          .replace('{{dataApresentacaoFormatadaPadraoBR}}', dataApresentacaoFormatadaPadraoBR);
      } else if (tipoEspecificoDeApresentacao === 'termtransito') {
        if (inputs.desistiuDiasTransito === 'nenhum') {
          return templates.apresentacaoTransito
            .replace('{{dataApresentacaoFormatadaPadraoBR}}', dataApresentacaoFormatadaPadraoBR);
        } else {
          if (!inputs.desistiuDiasTransito) {
            throw new Error('Dias de desistência obrigatórios');
          }
          const diasDesistenciaTransito = inputs.desistiuDiasTransito;
          const diasExtenso = numeroEmExtenso(diasDesistenciaTransito);
          const diasDesistenciaTransitoSZero = tiraZeroAEsquerda(diasDesistenciaTransito);
          const template = diasDesistenciaTransitoSZero === '1' ? templates.apresentacaoDesistenciaTransitoSingular : templates.apresentacaoDesistenciaTransitoPlural;
          return template
            .replace('{{dataApresentacaoFormatadaPadraoBR}}', dataApresentacaoFormatadaPadraoBR)
            .replace('{{diasDesistenciaTransitoSZero}}', diasDesistenciaTransitoSZero)
            .replace('{{diasExtenso}}', diasExtenso);
        }
      } else if (tipoEspecificoDeApresentacao === 'termnupcias') {
        return templates.apresentacaoNupcias
          .replace('{{dataApresentacaoFormatadaPadraoBR}}', dataApresentacaoFormatadaPadraoBR);
      } else {
        return templates.apresentacaoLuto
          .replace('{{dataApresentacaoFormatadaPadraoBR}}', dataApresentacaoFormatadaPadraoBR);
      }
    }

    throw new Error('Tipo de apresentação não suportado');
  } catch (error) {
    console.error('Erro em processarApresentacao:', error.message);
    throw error;
  }
}
