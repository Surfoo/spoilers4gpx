<?php
error_reporting(-1);
ini_set('display_errors', '1');

define('ROOT', __DIR__);

$template_compiled_dir = ($_SERVER['HTTP_HOST'] == 'spoilers4gpx.vaguelibre.net') ? ROOT . '/cache' : false;

define('TEMPLATE_DIR',  ROOT . '/templates');
define('TEMPLATE_COMPILED_DIR', $template_compiled_dir);

define('URL_GEOCACHING', 'https://www.geocaching.com/');
define('URL_LOGIN',      URL_GEOCACHING . 'login/default.aspx');
define('URL_GEOCACHE',   URL_GEOCACHING . 'seek/cache_details.aspx?wp=%s');

// define('USERNAME', '');
// define('PASSWORD', '');
// define('COOKIE_FILENAME', ROOT . '/cookie');

define('JQUERY_VERSION', '2.1.1');
define('BOOTSTRAP_VERSION', '3.2.0');
define('SUFFIX_CSS_JS', 20131009);
define('SPOILER_INFO', '<!-- Spoiler4Gpx is a tool for include spoilers into GPX files. More info here : http://spoilers4gpx.vaguelibre.net -->');
define('SPOILER_TAG', '<!-- Spoiler4Gpx [%s](%s) -->');
define('SPOILER_REGEX', '/<!-- Spoiler4Gpx \[([^]]*)\]\(([^)]*)\) -->/');

date_default_timezone_set('Europe/Paris');

require ROOT . '/vendor/autoload.php';

function renderAjax($data) {
    if (!is_array($data)) {
        exit();
    }
    $content = json_encode($data);

    if (!headers_sent()) {
        header('Pragma: no-cache');
        header('Cache-Control: no-cache, must-revalidate');
        header('Content-Type: application/json; charset=UTF-8');
    }
    echo $content;
    exit(0);
}

$header = array();
$header[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
$header[] = "User-Agent: Mozilla/5.0 (X11; Linux i686; rv:6.0) Gecko/20100101 Firefox/24.0";
$header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
$header[] = "Accept-Language: fr,fr-fr;q=0.8,en-us;q=0.5,en;q=0.3";
$header[] = "Keep-Alive: 115";
$header[] = "Connection: keep-alive";
$header[] = "Content-type: application/x-www-form-urlencoded;";
