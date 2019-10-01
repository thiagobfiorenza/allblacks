# DESAFIO TÉCNICO - All Blacks

## Configuração da Base de Dados
-	Após clonar o projeto, basta editar o arquivo `.env` na raiz com os dados referentes ao banco de dados:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=here your database name(allblacks)
DB_USERNAME=here database username(root)
DB_PASSWORD=here database password(root)
```

-	Foi utilizado o framework Laravel, então depois disto, resta apenas rodar o seguinte comando para a criação automática das tabelas:

```
php artisan migrate
```

-	E pronto! Já é possível pedir para a secretária realizar a importação do XML com os dados de torcedores no sistema, ou ainda cadastrar e editar os torcedores manualmente. :+1:

- [x] Foi criada uma listagem de torcedores com as opções de criar, editar, visualizar e apagar os mesmos, resolvendo assim o problema dos torcedores que precisam ser cadastrados manualmente, ou editadas somente algumas informações como a adição de telefone e e-mail por exemplo, já que estes campos nem sempre são informados no XML e por isso não são obrigatórios no sistema;
- [x] Os campos documento, CEP, telefone e e-mail receberam tratamento de máscara nos formulários de cadastro e edição;
- [x] Foi criada a funcionalidade de importação de XML, verificando o documento de cada torcedor (se o documento já existe, os dados são atualizados; se não, é cadastrado um novo torcedor);
- [x] Foi criada a funcionalidade de envio de comunicados, onde deve-se preencher o assunto do e-mail e a mensagem e o sistema envia o comunicado para todos os torcedores que possuirem e-mail e estiverem ativos no sistema;
- [x] E por fim, como o controle anteriormente era feito via Excel, basta apenas um clique para que uma planilha com a informação de todos os torcedores seja criada.

## Este projeto almeja resolver os seguintes problemas

-	Seleção Neozelandesa de Rugby é o cliente;
-	Os All Blacks possuem uma base de torcedores em planilha Excel;
-	A planilha é atualizada mensalmente com base em um arquivo XML enviado pela loja virtual da seleção na internet. Uma funcionária do Administrativo abre o arquivo XML em um navegador e atualiza a planilha copiando e colando os dados;
-	Os campos telefone e e-mail não são informados pela loja virtual, sendo atualizados manualmente na planilha;
-	Existem torcedores que não são enviados pela loja virtual sendo inseridos manualmente na planilha;
-	Os All Blacks, periodicamente, enviam comunicados para seus torcedores endereçados aos e-mails cadastrados na planilha;
-	Os All Blacks contam com uma funcionária dedicada exclusivamente para realizar toda essa operação de atualização e envio dos e-mails;
-	Visando reduzir custos, o presidente dos All Blacks ordenou que a funcionária seja demitida, e a operação deverá ser realizada pela secretária que, por sua vez, tem diversas outras ações diárias a fazer e não conseguirá realizar o trabalho da forma como é feito.

## Arquivos necessários para o teste
 * [Planilha excel](https://github.com/p21sistemas/skeleton21/blob/master/clientes.xlsx) - Planilha atualizada com a lista de clientes
 * [Arquivo XML](https://github.com/p21sistemas/skeleton21/blob/master/clientes.xml) - Arquivo XML para importação
