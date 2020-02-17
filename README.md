Projeto desenvolvido com Laravel, no qual foi criada uma Api com autenticação.
No frontend foi utilizado o VueJS, VueRouter, Vuex, entre outros.
Nele é possível criar usuários, cadastrar, listar e ver produtos e categorias.

Depois de clonar o projeto sigua os passos abaixo

```bash
# vá para a pasta do projeto
cd /pastadoprojeto

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

# e finalmente
npm run watch
```

Isso é tudo :)
