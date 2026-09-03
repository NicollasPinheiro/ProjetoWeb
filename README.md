Loja Virtual em PHP e MySQL

Este projeto consiste em um site de e-commerce desenvolvido em PHP com integração a banco de dados MySQL. A aplicação simula a venda de produtos, realizando consultas SQL para recuperar informações armazenadas no banco de dados e exibi-las dinamicamente na interface do usuário.

Os produtos são apresentados com imagens, descrições, preços e demais informações cadastradas, proporcionando uma experiência semelhante à de uma loja virtual real. O gerenciamento dos dados é realizado por meio do phpMyAdmin, permitindo o cadastro e a manutenção dos produtos no banco de dados.

 Funcionalidades

* Listagem dinâmica de produtos.
* Exibição de imagens e detalhes dos produtos.
* Integração com banco de dados MySQL.
* Consultas SQL para busca e apresentação de informações.
* Interface organizada para navegação dos usuários.
* Simulação de um ambiente de compras online.

Tecnologias Utilizadas

* PHP
* MySQL
* phpMyAdmin
* HTML5
* CSS3
* JavaScript

Objetivo

Aplicar conceitos de desenvolvimento web full stack, integração com banco de dados e manipulação dinâmica de informações, simulando o funcionamento de uma plataforma de vendas online.

## Como Importar o Banco de Dados (WAMP + phpMyAdmin)

### Pré-requisitos

* WAMP Server instalado.
* Apache e MySQL em execução.
* Arquivo do banco de dados (`.sql`) disponível no projeto.

### Passo a Passo

1. Inicie o WAMP Server e verifique se o ícone está verde.

2. Abra o navegador e acesse:

   ```
   http://localhost/phpmyadmin
   ```

3. Faça login no phpMyAdmin.

   * Usuário padrão: `root`
   * Senha: (em branco, salvo configuração diferente)

4. Clique em **Novo** no menu lateral esquerdo.

5. Crie um banco de dados com o nome utilizado pelo projeto.

6. Após criar o banco, selecione-o na lista lateral.

7. Clique na aba **Importar**.

8. Em **Escolher arquivo**, selecione o arquivo `.sql` fornecido no projeto.

9. Clique em **Executar** para iniciar a importação.

10. Aguarde a mensagem de confirmação informando que o banco de dados foi importado com sucesso.

### Configuração da Conexão

Verifique se as credenciais do banco de dados no arquivo de conexão PHP correspondem às configurações do seu ambiente local:

```php
$host = "localhost";
$user = "root";
$password = "";
$database = "nome_do_banco";
```

### Executando o Projeto

1. Copie a pasta do projeto para:

   ```
   C:\wamp64\www\
   ```
2. Inicie o WAMP Server.
3. Abra o navegador e acesse:

   ```
   http://localhost/nome-do-projeto
   ```
4. O sistema deverá carregar os produtos e demais informações diretamente do banco de dados importado.


