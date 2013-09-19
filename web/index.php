<?php

require dirname(__DIR__).'/config.php';

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem(TEMPLATE_DIR);
$twig   = new Twig_Environment($loader, array('debug' => true, 'cache' => TEMPLATE_COMPILED_DIR));

$twig_vars = array('demo_spoiler' => sprintf(SPOILER_TAG, 'Title', 'url_of_your_spoiler'),
                   'demo_regex'   => SPOILER_REGEX);
echo $twig->render('index.tpl', $twig_vars);
