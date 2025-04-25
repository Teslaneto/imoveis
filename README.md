# CRM Imobiliário - Sistema de Cadastro de Imóveis e Interesses de Clientes
------------------------------------------------
## Este projeto simula um módulo de um CRM imobiliário, onde é possível cadastrar imóveis e interesses de clientes, com o objetivo de recomendar imóveis baseados nos critérios de interesse dos clientes. O sistema permite o cadastro, edição, exclusão e visualização tanto de imóveis quanto de interesses de clientes.
---------------
## Tecnologias Utilizadas
PHP: Linguagem de programação para o backend.

MySQL: Banco de dados para persistência de dados.

HTML/CSS: Para construção da interface do usuário.

Bootstrap: Framework para facilitar o design responsivo.

PDO: Para a conexão e manipulação segura do banco de dados.

Banco de dados estar na pastar DB_install

---------------------------
## Como Rodar o Projeto Localmente
Clone o repositório para a sua máquina local:


git clone https://github.com/Teslaneto/imoveis.git
Acesse o diretório do projeto:

cd imoveis
Crie e configure o banco de dados no MySQL 

Altere as configurações de conexão no arquivo conexao/conexao.php para corresponder ao seu banco de dados.

Acesse o sistema pelo navegador:

http://localhost/imoveis

## Melhorias Futuras
Se tivesse mais tempo, algumas melhorias que poderiam ser implementadas incluem:

Autenticação de Usuários: Implementação de um sistema de login para que os corretores possam gerenciar imóveis e interesses de maneira segura.

Filtros Avançados: Melhorar os filtros de busca de imóveis, como incluir filtros por área, número de vagas de garagem, entre outros.

Notificações: Implementação de notificações para alertar os corretores quando um novo imóvel corresponder ao interesse de um cliente.
