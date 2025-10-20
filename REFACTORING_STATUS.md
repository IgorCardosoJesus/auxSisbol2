# Status da Refatoração: auxSisbol2 de PHP para Client-Side

**Data da Última Atualização:** 20 de outubro de 2025  
**Responsável pela Refatoração:** GitHub Copilot (agente AI)  
**Objetivo:** Migrar o sistema auxiliar para confecção de notas do Boletim Interno de PHP server-side para JavaScript client-side, tornando-o uma aplicação web estática executável offline em qualquer browser.

## Estrutura Atual do Projeto
```
auxSisbol2/
├── index.html                          # Página principal (formulário), convertida de index.php
├── LICENSE                             # Licença do projeto
├── partes.html                         # Arquivo de templates originais (não convertido)
├── README.md                           # Documentação original
├── css/                                # Estilos CSS intactos
│   ├── padrao.css
│   ├── reset.css
│   ├── style.css
│   └── styleResultado.css
├── img/                                # Imagens intactas
│   ├── insignia-cabo.png
│   ├── manualUsuario.pdf
│   └── padraocfc2020.jpeg
├── scripts/                            # Scripts JavaScript
│   ├── allpage.js                      # Script original (não modificado)
│   ├── main.js                         # Orquestrador principal (criado)
│   └── modules/                        # Módulos ES6 criados
│       ├── afastamentos.js             # Lógica para afastamentos
│       ├── apresentacoes.js            # Lógica para apresentações
│       ├── formatacoes.js              # Funções utilitárias (datas, números, listas)
│       ├── funcoesTransitorias.js      # Lógica para funções transitorias
│       ├── inclusaoPlanFerias.js       # Lógica para inclusão no plano de férias
│       ├── mudancaPlanoFerias.js       # Lógica para mudança no plano de férias (parcial)
│       ├── passagemFuncao.js           # Lógica para passagem e recebimento de função
│       ├── refDIExGenerico.js          # Lógica para referenciamento de DIEx
│       ├── templates.js                # Templates de texto com placeholders
│       └── tornarSemEfeito.js          # Lógica para tornar sem efeito
├── src/                                # Pasta vazia (originalmente com PHP)
└── temp_funcoes/                       # Referência temporária dos arquivos PHP originais
    ├── Afastamentos.php
    ├── Apresentacoes.php
    ├── Formatacoes.php
    ├── FuncoesTransitorias.php
    ├── InclusaoPlanFerias.php
    ├── MudancaPlanoFerias.php
    ├── PassRecebFuncao.php
    ├── PassRecebFuncao.php~
    ├── ReferenciarDIEx.php
    └── TornoSemEfeito.php
```

## Progresso Realizado

### Passo 1: Backup, Versionamento e Limpeza Inicial (Concluído)
- **Backup:** Cópia completa criada em `../backup-auxSisbol2`.
- **Versionamento:** Repositório Git inicializado com commit "Estado atual PHP".
- **Limpeza:**
  - Removidos: `composer.json`, `composer.lock`, `vendor/`, `resultado.php`, `trash/`.
  - Movido: `src/funcoes/` para `temp_funcoes/` (referência).
  - Renomeado: `index.php` → `index.html` (bloco PHP inicial removido via sed).
- **Setup:** Pasta `scripts/modules/` criada; `.gitignore` adicionado para ignorar backups.
- **Tempo Gasto:** ~1 hora.
- **Arquivos Afetados:** index.html, .gitignore, estrutura de pastas.

### Passo 2: Conversão de Templates e Lógica PHP para JavaScript (Parcialmente Concluído)
- **Templates:** Convertidos de `partes.html` e lógica PHP para `scripts/modules/templates.js` (objetos com strings e placeholders como `{{anoFerias}}`).
  - Templates Incluídos: trintaDiasSeguidos, primeiraParcelaQuinze, segundaParcelaQuinze, primeiraParcelaDez, segundaParcelaDez, terceiraParcelaDez, diasRestantesSingular, diasRestantesPlural.
  - **Limitação:** Apenas templates para afastamentos implementados; outros tipos (apresentações, funções transitorias, etc.) não convertidos.
- **Funções PHP:** Migradas para módulos ES6.
  - `scripts/modules/formatacoes.js`: Funções utilitárias (formatadordeData, adicionarDiasEmUmaData, ApartirOuAcontar, numeroEmExtenso, pegarAnosAnterioresAtualEPosteriores, pegarTodasFuncoesOM, pegarFuncoesQueTemCarga).
  - `scripts/modules/afastamentos.js`: Função `processarDados(tipoEspecificoDoAfastamento, inputs)` com lógica para tipos de férias (30 dias, parcelas de 15/10, dias restantes).
    - Usa try-catch para validações e erros.
    - **Limitação:** Apenas lógica para afastamentos implementada; outros módulos (apresentacoes.js, funcoesTransitorias.js, etc.) não criados.
- **Processamento Principal:** `scripts/main.js` criado para orquestrar.
  - Captura submit do form (preventDefault).
  - Coleta `tipoNota` e `tipoEspecifico` via radios.
  - Coleta inputs dinâmicos (e.g., anoFerias, dataInicioFerias).
  - Chama `processarDados` e renderiza em `<div id="resultado">`.
  - **Limitação:** Lógica de coleta de inputs básica; IDs dos campos podem precisar ajuste (e.g., `data_apresentacao` vs. IDs reais no form).
- **Integração em index.html:**
  - Form alterado: removido `action="resultado.php"` e `method="POST"`, adicionado `onsubmit="return false;"`.
  - Adicionado `<div id="resultado"></div>` e scripts: `formatacoes.js`, `templates.js`, `afastamentos.js`, `main.js` (type="module").
- **Tempo Gasto:** ~4-6 horas.
- **Arquivos Criados/Modificados:** scripts/modules/templates.js, scripts/modules/formatacoes.js, scripts/modules/afastamentos.js, scripts/main.js, index.html.
- **Testes Iniciais:** Abrir index.html em browser, selecionar "Afastamentos Diversos" > "Término de 30 dias de Férias", preencher campos, submeter. Deve gerar texto no div de resultado. Verificar console para erros.

## O Que Falta Fazer

### Passo 3: Expansão para Todos os Tipos de Nota (Concluído)
- **Módulos Implementados:** Todos os módulos JS criados para as classes PHP em `temp_funcoes/`:
  - `scripts/modules/apresentacoes.js`: Migrado `Apresentacoes.php`.
  - `scripts/modules/funcoesTransitorias.js`: Migrado `FuncoesTransitorias.php`.
  - `scripts/modules/tornarSemEfeito.js`: Migrado `TornoSemEfeito.php`.
  - `scripts/modules/inclusaoPlanFerias.js`: Migrado `InclusaoPlanFerias.php`.
  - `scripts/modules/mudancaPlanoFerias.js`: Migrado `MudancaPlanoFerias.php` (parcialmente, apenas 2 tipos implementados).
  - `scripts/modules/passagemFuncao.js`: Migrado `PassRecebFuncao.php`.
  - `scripts/modules/refDIExGenerico.js`: Migrado `ReferenciarDIEx.php`.
- **Templates Adicionais:** Expandido `templates.js` com strings de todos os tipos.
- **Lógica em main.js:** Expandida coleta de inputs e chamadas de módulos para todos os `tipoNota`.
- **Validações:** Adicionadas validações client-side.
- **Selects Dinâmicos:** Substituídos PHP por população via JS.
- **Tempo Gasto:** ~10 horas.

### Passo 4: Otimizações e Finalização
- **Bundle JS:** Usar Webpack ou Parcel para combinar módulos em um único `bundle.js` (opcional, mas recomendado para performance).
- **CSS/JS:** Manter estilos; adicionar responsividade se necessário.
- **Documentação:** Atualizar `README.md` com instruções para uso client-side (abrir index.html em browser).
- **Testes End-to-End:** Testar todos os tipos de nota, validar saídas contra originais PHP.
- **Limpeza Final:** Remover `temp_funcoes/`, `partes.html` (se não usado), `allpage.js` (se obsoleto).
- **Deploy:** Pronto para hospedagem estática (GitHub Pages, Netlify).
- **Tempo Estimado:** 2-4 horas.

### Passo 5: Validações e Debugging
- **Erros Comuns:** Verificar IDs de campos em `index.html` (e.g., `data_apresentacao` pode ser `data_apresentacao` ou outro). Ajustar em main.js.
- **Compatibilidade:** Testar em browsers modernos (Chrome, Firefox); usar Babel se necessário para transpilação.
- **Segurança:** Como client-side, não há exposição de servidor, mas validar inputs para evitar XSS (sanitizar se necessário).
- **Riscos:** Lógica complexa em PHP pode ter nuances não capturadas; comparar saídas.

## Instruções para Continuar
1. **Revisar Arquivos Criados:** Verificar sintaxe em todos os JS (usar linter como ESLint).
2. **Expandir Módulos:** Para cada tipo, ler o PHP correspondente, extrair templates e lógica, criar módulo similar a afastamentos.js.
3. **Testar Incrementalmente:** Após cada módulo, testar o tipo correspondente no form.
4. **Substituir PHP em index.html:** Usar JS para popular selects (e.g., on load, chamar funções de formatacoes.js).
5. **Se Bloqueado:** Consultar `temp_funcoes/` para detalhes; usar console.log para debug.

**Contato/Suporte:** Este arquivo serve como handover para qualquer AI ou desenvolvedor. Atualize-o conforme progresso.
