<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', 'cidadevivashop' );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'cidadevivashop' );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', 'CVShopp@2020' );

/** Nome do host do MySQL */
define( 'DB_HOST', '187.45.196.163' );

/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define( 'DB_COLLATE', '' );

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '}kPo3=zu@v?~Oij80+lc;XN(gQE/sQ$uPgw*_13Y+f1;oiiwGV|aOS_y$xBL2Y=i' );
define( 'SECURE_AUTH_KEY',  '{-WQ6JHB2<8tSoMs<i2VYXE1?xDY6Qxd9~=N_R-O,wI_aAWux?L(9.R01J1/}<!.' );
define( 'LOGGED_IN_KEY',    '+_r}6*vh>I1sK]:0/8hrlpI:`%LqY/0t!#9y8};2TQi{9.G9vE7V,mPSoW7v*Jg)' );
define( 'NONCE_KEY',        '/Xl/Y$A%v$QN|n*SX+0[D0v<w~dNk)7|zx-g/KLtrAKmm+IXzxn`*7sZ4//%}17(' );
define( 'AUTH_SALT',        '3XW@jc@zMNL0|M~Vjp*n5B.}I.KC6xJAZKngUd;/u7Rc;|cVZD8z?,x#NgEV5NF?' );
define( 'SECURE_AUTH_SALT', 'SX)EmsFokK#;E#m>6D&I*A(on9p{b774d4d@tVx>u[=BF&{_4x{8HlOJq7$yiuH)' );
define( 'LOGGED_IN_SALT',   '34=c2~Y;~+7qyaWb;|$yNQwF>w8O<4{}nF)uZi>ww[&2/}S+riJCa?XiI)(u-3fr' );
define( 'NONCE_SALT',       ')eZ-Ddk$fW!k.)-*L~A69~2,_RT;i6&%x{cE/L+9Lot%J)z;Bx4<MiMR:G~dX~?w' );

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'wp1_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Configura as variáveis e arquivos do WordPress. */
require_once ABSPATH . 'wp-settings.php';
