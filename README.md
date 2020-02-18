### App Cadastro de Produtos - com Laravel e VueJs 

Projeto desenvolvido com Laravel, no qual foi criada uma Api com autenticação Jwt.
No frontend foi utilizado o VueJS, VueRouter, Vuex, entre outros.
No backend foi usado o Laravel, migrations, jwt-auth, Resources, entre outros.
Nele é possível criar usuários, cadastrar, listar e ver produtos e categorias.


Depois de clonar o projeto siga os passos abaixo:

```bash
# vá para a pasta do projeto
cd /cadastroDeProdutos

# crie o arquivo .env
cp .env.example .env

# instale as dependencias do composer
composer update

# instale as dependencias do npm
npm install

# gere uma chave para a aplicação
php artisan key:generate

# gere uma chave para o jwt
php artisan jwt:secret

# crie uma base de dados local
mysql -u root

> create database seu-banco-de-dados;
> exit;

# coloque a configuração do seu banco de dados no arquivo .env
DB_CONNECTION=mysql
DB_DATABASE=seu-banco-de-dados
DB_USERNAME=root
DB_PASSWORD=

# execute o comando migrate para gerar o schema
php artisan migrate

# crie um virtualhost para a aplicação na pasta /cadastroDeProdutos/public
Caso esteja rodando no xamp, adicione um entrada em httpd-vhost.conf e no arquivo hosts,
roteando para pasta /cadastroDeProdutos/public do projeto

# e finalmente
npm run watch
```

Isso é tudo :)
