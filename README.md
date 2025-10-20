# AuxSisbol2
 Sistema auxiliar para confecção de notas do Boletim Interno versão 2.0 após inserção no servidor da empresa.

Essa linha foi adicionada diretamente do Github pelo site.

## Instalação
Abra `index.html` em qualquer browser moderno (Chrome, Firefox, Edge). A aplicação funciona completamente offline, sem necessidade de servidor.

## Desenvolvimento
- Use Git para versionamento: `git init`, commits regulares.
- Branches: Crie branches para novas features (e.g., `git checkout -b feature-novo-tipo-nota`).
- Testes: Abra `index.html` no browser, abra o console (F12) e execute `import('./scripts/tests.js')` para rodar testes unitários manuais.
- Debugging: Logs de console em `scripts/modules/afastamentos.js` e `scripts/main.js` ajudam a rastrear processamento.

## Troubleshooting
- **Selects vazios**: Aguarde o carregamento completo da página; selects são populados dinamicamente via JS.
- **Erros de validação**: Verifique se todos os campos obrigatórios estão preenchidos (marcados com `required`).
- **Compatibilidade**: Funciona em browsers modernos. Para IE, use polyfills para `FormData` (não testado).
- **Problemas de layout**: Em dispositivos móveis, layout se adapta via media queries.
- **Erros inesperados**: Verifique console do browser para logs de debug.

## Deploy
Hospede em plataformas estáticas como GitHub Pages ou Netlify. Basta subir os arquivos; funciona offline.
