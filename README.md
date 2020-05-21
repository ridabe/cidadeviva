# Portal Ticket

Welcome to the Source.

## Setup de Desenvolvimento

Versionamos apenas a parte do WordPress para deploy, por tanto o setup de desenvolvimento pode variar para cada desenvolvedor, bastando respeitar os requisítos mínimos do WordPress, a versão do Core e a configuração do servidor de Produção, para consistência no fluxo de deploy.

No entando, sugerimos o uso do docker.

### Ambiente de Produção

```
Domain: www.ticket.com.br
PHP Version: 7.0
MySQL Version: 5.7.18
```

### Docker Compose

```yml
version: '2'

services:
    db:
        image: mysql:5.7.18
        volumes:
            - .db_data:/var/lib/mysql
        ports:
            - "3306:3306"
        environment:
            MYSQL_ROOT_PASSWORD: wordpress
            MYSQL_DATABASE: wordpress
            MYSQL_USER: wordpress
            MYSQL_PASSWORD: wordpress

    wordpress:
        depends_on:
            - db
        build: .docker
        ports:
            - "8000:80"
        restart: always
        environment:
            wordpress_deploy_key: XXXX
            WORDPRESS_DB_HOST: db:3306
            WORDPRESS_DB_PASSWORD: wordpress
        volumes:
            - ./portal-ticket:/var/www/html
```

### Dockerfile

```
FROM wordpress:php7.0-apache
```

### WP Config

```
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'wordpress');

/** MySQL hostname */
define('DB_HOST', 'db:3306');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/** Make sure you can download stuff **/
define('FS_METHOD', 'direct');

/** Everyone loves DEBUG **/

define( 'WP_DEBUG', true );
define( 'SCRIPT_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );

/** Multisite **/

define( 'MULTISITE', true );
define( 'SUBDOMAIN_INSTALL', false );
define( 'DOMAIN_CURRENT_SITE', 'dev.ticket.com.br' );
define( 'PATH_CURRENT_SITE', '/' );
define( 'SITE_ID_CURRENT_SITE', 1 );
define( 'BLOG_ID_CURRENT_SITE', 1 );
```

Para produção adicionamos após isso, o seguinte código para redirecionamento WWW:

```
// Redirect from WWW
$domain = strtolower( stripslashes( $_SERVER['HTTP_HOST'] ) );
if ( $domain === 'www.' . DOMAIN_CURRENT_SITE ) {
    $path = $_SERVER['REQUEST_URI'] ?? '/';
    $url = 'https://' . DOMAIN_CURRENT_SITE . $path;
    header( 'Location:' . $url );
    exit;
}
```

### Htaccess

```
RewriteEngine On
RewriteBase /
RewriteRule ^index\.php$ - [L]

# add a trailing slash to /wp-admin
RewriteRule ^([_0-9a-zA-Z-]+/)?wp-admin$ $1wp-admin/ [R=301,L]

RewriteCond %{REQUEST_FILENAME} -f [OR]
RewriteCond %{REQUEST_FILENAME} -d
RewriteRule ^ - [L]
RewriteRule ^([_0-9a-zA-Z-]+/)?(wp-(content|admin|includes).*) $2 [L]
RewriteRule ^([_0-9a-zA-Z-]+/)?(.*\.php)$ $2 [L]
RewriteRule . index.php [L]
```

### Como usar o Docker

Após instalar o Docker e o Docker-compose, crie um diretório para o projeto. Dentro dele crie os diretórios `portal-ticket` e `.docker`.

Clone o repositório dentro do primeiro e insira o `Dockerfile` no segundo. Após isso o `docker-compose.yml` deve ir na raiz do projeto (ao lado dos dois diretórios criados).

Agora basta rodar o comando `docker-compose up` que a imagem será criada. Crie um host para o site.

### Arquivos do site e Banco de Dados

Para obter uma cópia completa do site (setup inicial), solicite à infra.

O mesmo deve ser solicitado em relação ao Banco de Dados, ou você pode tentar fazer o download de `http://wpdev.americas.net/dev.database-2018-03-06.sql.tar.gz`.

Caso faça o dump do banco, lembre-se de atualizar as URLs.

Dos blogs:

```
UPDATE wp_blogs SET domain = 'dev.ticket.com.br' WHERE domain = 'wpdev.americas.net';
```

Das configurações do site e de metadados:

```
UPDATE wp_sitemeta SET meta_value = 'http://dev.ticket.com.br/' WHERE meta_key = 'siteurl';
UPDATE wp_site SET domain = 'dev.ticket.com.br' WHERE domain = 'wpdev.americas.net';
```

E das opções de cada site:

```
UPDATE wp_options SET option_value = 'http://dev.ticket.com.br' WHERE option_name = 'siteurl' OR option_name = 'home' OR option_name = 'fileupload_url';

UPDATE wp_2_options SET option_value = 'http://dev.ticket.com.br/contratar-ticket' WHERE option_name = 'siteurl' OR option_name = 'home' OR option_name = 'fileupload_url';
UPDATE wp_3_options SET option_value = 'http://dev.ticket.com.br/aceitar-ticket' WHERE option_name = 'siteurl' OR option_name = 'home' OR option_name = 'fileupload_url';
UPDATE wp_4_options SET option_value = 'http://dev.ticket.com.br/meus-servicos' WHERE option_name = 'siteurl' OR option_name = 'home' OR option_name = 'fileupload_url';
UPDATE wp_5_options SET option_value = 'http://dev.ticket.com.br/blog' WHERE option_name = 'siteurl' OR option_name = 'home' OR option_name = 'fileupload_url';
UPDATE wp_6_options SET option_value = 'http://dev.ticket.com.br/souticket' WHERE option_name = 'siteurl' OR option_name = 'home' OR option_name = 'fileupload_url';
```

Após isso já deve ser possível abrir o site, não esqueça de atualizar as urls nos posts e demais configurações utilizando algum plugin (como o "Better Search Replace"). Além disso, salve os links permanentes novamente.

Observação: o acesso, caso utilize o dump citado é `admin/Ticket@@2017`.

### Problemas?

Se tiver problemas com permissão de pasta, não esqueça de adicionar o seu usuário ao grupo `www-data` e definir o dono do repositório como `usuario:www-data`.

Após isso, se não conseguir atualizar nada ou baixar temas/plugins, tente corrigir as permissões (esteja na raiz do WordPress):

```bash
sudo find . -type d -exec chmod 775 {} \; && sudo find . -type f -exec chmod 664 {} \;
```

## Desenvolvendo

Não esqueça de dar uma olhada em `CONTRIBUTING.md` para detalhes de como participar do projeto.

## Lead Machine

Não esqueça de adicionar a chave de API da Lead Machine ao seu docker-compose.

## Deploy

Estamos fazendo o deploy jogando o conteúdo da pasta `wp-content` dentro da instalação.

Após finalizar o deploy, precisa ser feito um GET para o site verificar se precisa rodar algum atualizador.

URL: `http://dev.ticket.com.br/wp-admin/admin-ajax.php?action=deployer&deploy_key=XXXX`

Substituia `XXXX` pelo valor da variável de ambiente `wordpress_deploy_key`.

### GitLab

Vá até o repositório na [GitLab](https://gitlab.com/edenredbrazil/vizir/portal-ticket), confira seu acesso e configure sua chave.

O deploy é feito via GoCD usando um pacote `wp_package` que é atualizado a cada push da `master`.