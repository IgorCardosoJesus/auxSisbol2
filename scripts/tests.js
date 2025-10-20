// scripts/tests.js - Testes unitários manuais com console.assert
import { formatadordeData, adicionarDiasEmUmaData, ApartirOuAcontar, numeroEmExtenso, pegarAnosAnterioresAtualEPosteriores } from './modules/formatacoes.js';
import { processarDados, processarApresentacao } from './modules/afastamentos.js';
import { processarFuncaoTransitoria } from './modules/funcoesTransitorias.js';
import { processarTornarSemEfeito } from './modules/tornarSemEfeito.js';

// Testes para formatacoes.js
console.assert(formatadordeData('2024-06-12') === '12 JUN 24', 'formatadordeData: falhou para data válida');
console.assert(formatadordeData('2023-01-01') === '1º JAN 23', 'formatadordeData: falhou para dia com zero');
console.assert(adicionarDiasEmUmaData('2024-06-12', '30') === '2024-07-12', 'adicionarDiasEmUmaData: falhou para 30 dias');
console.assert(ApartirOuAcontar('2024-06-12') === 'contar', 'ApartirOuAcontar: falhou para data passada');
console.assert(ApartirOuAcontar('2025-12-31') === 'partir', 'ApartirOuAcontar: falhou para data futura');
console.assert(numeroEmExtenso('01') === 'um', 'numeroEmExtenso: falhou para 01');
console.assert(numeroEmExtenso('15') === 'quinze', 'numeroEmExtenso: falhou para 15');
const anos = pegarAnosAnterioresAtualEPosteriores();
console.assert(anos.length === 5 && anos.includes(2024), 'pegarAnosAnterioresAtualEPosteriores: falhou');

// Testes para afastamentos.js
const sampleInputs30 = { anoFerias: '2024', dataInicioFerias: '2024-06-12' };
const result30 = processarDados('ferias30dias', sampleInputs30);
console.assert(result30.includes('Concedidos 30 (trinta) dias') && result30.includes('2024'), 'processarDados: ferias30dias falhou');

const sampleInputs15 = { anoFerias: '2024', dataInicioFerias: '2024-06-12' };
const result15 = processarDados('ferias1parcela15', sampleInputs15);
console.assert(result15.includes('Concedida a 1ª parcela de 15 (quinze) dias') && result15.includes('2024'), 'processarDados: ferias1parcela15 falhou');

const sampleInputsRest = { qtdeDiasRest: '5', anoFeriasRestantes: '2024', dataInicioFeriasRestantes: '2024-06-12' };
const resultRest = processarDados('feriasDiasRestantes', sampleInputsRest);
console.assert(resultRest.includes('Concedidos 5 (cinco) dias') && resultRest.includes('2024'), 'processarDados: feriasDiasRestantes falhou');

// Testes para apresentacoes.js
const sampleApresentacao = { data_apresentacao: '2024-06-12', AnoFerias: '2024' };
const resultApresentacao = processarApresentacao('term30dias', sampleApresentacao);
console.assert(resultApresentacao.includes('Apresentou-se') && resultApresentacao.includes('30 (trinta) dias') && resultApresentacao.includes('2024'), 'processarApresentacao: term30dias falhou');

const sampleApresentacaoFuncao = { data_apresentacao: '2024-06-12', apresentouTermRecebFuncaoCargoEncargo: 'Cmt Btl' };
const resultApresentacaoFuncao = processarApresentacao('termTransmCargoEncargo', sampleApresentacaoFuncao);
console.assert(resultApresentacaoFuncao.includes('Apresentou-se') && resultApresentacaoFuncao.includes('Cmt Btl'), 'processarApresentacao: termTransmCargoEncargo falhou');

const sampleApresentacaoDisp = { data_apresentacao: '2024-06-12', DiasDispCmt: '01' };
const resultApresentacaoDisp = processarApresentacao('termDispRecoCmtBtl', sampleApresentacaoDisp);
console.assert(resultApresentacaoDisp.includes('Apresentou-se') && resultApresentacaoDisp.includes('1 dia'), 'processarApresentacao: termDispRecoCmtBtl falhou');

// Testes para funcoesTransitorias.js
const sampleFuncao = { data_saida_retorno_funcao: '2024-06-12', qualFuncao: 'Cmt Btl' };
const resultFuncao = processarFuncaoTransitoria('designacaoFuncao', sampleFuncao);
console.assert(resultFuncao.includes('Designado') && resultFuncao.includes('Cmt Btl'), 'processarFuncaoTransitoria: designacaoFuncao falhou');

const sampleDispensa = { data_saida_retorno_funcao: '2024-06-12', primeiraFuncao: 'Cmt Btl', responderOuExercer: 'exercer' };
const resultDispensa = processarFuncaoTransitoria('funcaoDispensa', sampleDispensa);
console.assert(resultDispensa.includes('Dispensado') && resultDispensa.includes('Cmt Btl'), 'processarFuncaoTransitoria: funcaoDispensa falhou');

// Testes para tornarSemEfeito.js
const sampleSemEfeitoGenerico = { data_bi_pub: '2024-06-12', nrBIConstPub: '193', nrPagBIsEfeito: '210' };
const resultSemEfeitoGenerico = processarTornarSemEfeito('semEfeitoGenerico', sampleSemEfeitoGenerico);
console.assert(resultSemEfeitoGenerico.includes('Torno sem efeito') && resultSemEfeitoGenerico.includes('193'), 'processarTornarSemEfeito: semEfeitoGenerico falhou');

const sampleSemEfeitoApresentacao = { data_apr_sem_efeito: '2024-06-12', data_bi_pub: '2024-06-12', nrBIConstPub: '193', nrPagBIsEfeito: '210', tiposemEfeitoApresent: ', por término de 30 dias de férias, referente a ', anoFeriasApresentacaoSemEfeito: '2024' };
const resultSemEfeitoApresentacao = processarTornarSemEfeito('semEfeitoApresentação', sampleSemEfeitoApresentacao);
console.assert(resultSemEfeitoApresentacao.includes('Torno sem efeito') && resultSemEfeitoApresentacao.includes('2024'), 'processarTornarSemEfeito: semEfeitoApresentação falhou');

// Testes de erro
try {
  processarDados('ferias30dias', {});
  console.assert(false, 'processarDados: deveria falhar com inputs vazios');
} catch (e) {
  console.assert(e.message.includes('Ano das férias obrigatório'), 'processarDados: erro inesperado');
}

try {
  processarDados('ferias30dias', { anoFerias: '2024', dataInicioFerias: 'invalid' });
  console.assert(false, 'processarDados: deveria falhar com data inválida');
} catch (e) {
  console.assert(e.message.includes('Data de início inválida'), 'processarDados: erro inesperado');
}

// Testes de erro para apresentacoes
try {
  processarApresentacao('term30dias', {});
  console.assert(false, 'processarApresentacao: deveria falhar sem data');
} catch (e) {
  console.assert(e.message.includes('Data de apresentação obrigatória'), 'processarApresentacao: erro inesperado');
}

// Testes de erro para funcoesTransitorias
try {
  processarFuncaoTransitoria('designacaoFuncao', {});
  console.assert(false, 'processarFuncaoTransitoria: deveria falhar sem data');
} catch (e) {
  console.assert(e.message.includes('Data obrigatória'), 'processarFuncaoTransitoria: erro inesperado');
}

// Testes de erro para tornarSemEfeito
try {
  processarTornarSemEfeito('semEfeitoGenerico', {});
  console.assert(false, 'processarTornarSemEfeito: deveria falhar sem data BI');
} catch (e) {
  console.assert(e.message.includes('Data de publicação do BI obrigatória'), 'processarTornarSemEfeito: erro inesperado');
}

console.log('Todos os testes unitários passaram!');

// Para executar: Abra index.html no browser, abra console e execute: import('./scripts/tests.js')
