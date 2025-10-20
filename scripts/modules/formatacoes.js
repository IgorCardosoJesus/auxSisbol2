// scripts/modules/formatacoes.js

// Recebe a data desformatada ('2024-06-12') e formata no padrão ('12 JUN 24')
export function formatadordeData(datadesformatada) {
  const meses = {
    "01": "JAN",
    "02": "FEV",
    "03": "MAR",
    "04": "ABR",
    "05": "MAIO",
    "06": "JUN",
    "07": "JUL",
    "08": "AGO",
    "09": "SET",
    "10": "OUT",
    "11": "NOV",
    "12": "DEZ"
  };

  const partesData = datadesformatada.split("-");
  const dia = partesData[2];
  const mes = partesData[1];
  const mesFormatado = meses[mes];
  const ano = partesData[0];

  let diaFormatado;
  if (dia === '01') {
    diaFormatado = '1º';
  } else if (dia >= '02' && dia <= '09') {
    diaFormatado = dia;
  } else {
    diaFormatado = dia;
  }

  return `${diaFormatado} ${mesFormatado} ${ano.slice(-2)}`;
}

// Recebe uma data string e dias a somar, retorna data somada formatada
export function adicionarDiasEmUmaData(dataEmString, diasParaSomar) {
  const data = new Date(dataEmString);
  data.setDate(data.getDate() + parseInt(diasParaSomar));
  return data.toISOString().split('T')[0]; // YYYY-MM-DD
}

// Recebe data string, verifica se "partir" ou "contar"
export function ApartirOuAcontar(dataVindaDiretoDoFormulario) {
  const data = new Date(dataVindaDiretoDoFormulario);
  const hoje = new Date();
  hoje.setHours(0, 0, 0, 0);
  data.setHours(0, 0, 0, 0);

  if (data > hoje) {
    return 'partir';
  } else {
    return 'contar';
  }
}

// Recebe número 1-30, retorna por extenso
export function numeroEmExtenso(numero) {
  const extenso = {
    "01": "um",
    "02": "dois",
    "03": "três",
    "04": "quatro",
    "05": "cinco",
    "06": "seis",
    "07": "sete",
    "08": "oito",
    "09": "nove",
    "10": "dez",
    "11": "onze",
    "12": "doze",
    "13": "treze",
    "14": "quatorze",
    "15": "quinze",
    "16": "dezesseis",
    "17": "dezessete",
    "18": "dezoito",
    "19": "dezenove",
    "20": "vinte",
    "21": "vinte e um",
    "22": "vinte e dois",
    "23": "vinte e três",
    "24": "vinte e quatro",
    "25": "vinte e cinco",
    "26": "vinte e seis",
    "27": "vinte e sete",
    "28": "vinte e oito",
    "29": "vinte e nove",
    "30": "trinta"
  };
  return extenso[numero] || numero;
}

// Devolve anos anteriores, atual e posteriores
export function pegarAnosAnterioresAtualEPosteriores() {
  const anoAtual = new Date().getFullYear();
  return [anoAtual - 2, anoAtual - 1, anoAtual, anoAtual + 1, anoAtual + 2];
}

// Devolve todas as funções OM
export function pegarTodasFuncoesOM() {
  return [
    "Cmt Btl",
    "Cmt Btl e Ordenador de Despesas",
    "Ordenador de Despesas",
    "SCmt Btl",
    "Cmt 1ª Cia Fuz Bld",
    "Sgte 1ª Cia Fuz Bld",
    "Aux Sgte 1ª Cia Fuz Bld",
    "Fur 1ª Cia Fuz Bld",
    "Enc Mat 1ª Cia Fuz Bld",
    "Aux Enc Mat 1ª Cia Fuz Bld",
    "Rspnl Res Armt 1ª Cia Fuz Bld",
    "Cmt 2ª Cia Fuz Bld",
    "Sgte 2ª Cia Fuz Bld",
    "Fur 2ª Cia Fuz Bld",
    "Enc Mat 2ª Cia Fuz Bld",
    "Rspnl Res Armt 2ª Cia Fuz Bld",
    "Cmt 3ª Cia Fuz Bld",
    "Sgte 3ª Cia Fuz Bld",
    "Aux Sgte 3ª Cia Fuz Bld",
    "Fur 3ª Cia Fuz Bld",
    "Enc Mat 3ª Cia Fuz Bld",
    "Aux Enc Mat 3ª Cia Fuz Bld",
    "Rspnl Res Armt 3ª Cia Fuz Bld",
    "Cmt 4ª Cia Fuz Bld",
    "Sgte 4ª Cia Fuz Bld",
    "Aux Sgte 4ª Cia Fuz Bld",
    "Fur 4ª Cia Fuz Bld",
    "Enc Mat 4ª Cia Fuz Bld",
    "Aux Enc Mat 4ª Cia Fuz Bld",
    "Rspnl Res Armt 4ª Cia Fuz Bld",
    "Cmt Cia C Ap",
    "Sgte Cia C Ap",
    "Aux Sgte Cia C Ap",
    "Fur Cia C Ap",
    "Enc Mat Cia C Ap",
    "Aux Enc Mat Cia C Ap",
    "Rspnl Res Armt Cia C Ap",
    "Instr Ch NPOR",
    "Sgte NPOR",
    "Aux Sgte NPOR",
    "Fur NPOR",
    "Enc Mat NPOR",
    "Aux Enc Mat NPOR",
    "Rspnl Res Armt NPOR",
    "Reg B Mus",
    "Sgte B Mus",
    "Aux Sgte B Mus",
    "Fur B Mus",
    "Enc Mat B Mus",
    "Aux Enc Mat B Mus",
    "Ch 1ª Seç",
    "Aux 1ª Seç",
    "Ch 2ª Seç",
    "Aux 2ª Seç",
    "Ch 3ª Seç",
    "Aux 3ª Seç",
    "Ch 4ª Seç",
    "Aux 4ª Seç",
    "O Mnt Vtr",
    "Ch Fisc Adm",
    "Aux Fisc Adm",
    "Aux Fusex"
  ];
}

// Devolve funções que têm carga
export function pegarFuncoesQueTemCarga() {
  return [
    "1ª Cia Fuz Bld",
    "Res Armt 1ª Cia Fuz Bld",
    "2ª Cia Fuz Bld",
    "Res Armt 2ª Cia Fuz Bld",
    "3ª Cia Fuz Bld",
    "Res Armt 3ª Cia Fuz Bld",
    "4ª Cia Fuz Bld",
    "Res Armt 4ª Cia Fuz Bld",
    "Cia C Ap",
    "Res Armt Cia C Ap",
    "NPOR",
    "Res Armt NPOR",
    "B Mus",
    "1ª Seç",
    "2ª Seç",
    "3ª Seç",
    "4ª Seç",
    "Fisc Adm",
    "Salc",
    "P.O",
    "SPP",
    "Infor",
    "S Seç Sv Just",
    "PRM",
    "Conf",
    "Sect",
    "Set Fin",
    "RP",
    "SFPC",
    "SVP",
    "Almox",
    "Set Aprv",
    "Fusex"
  ];
}

// Recebe um número como string e remove zeros à esquerda.
export function tiraZeroAEsquerda(num) {
  return num.replace(/^0+/, '') || '0';
}
