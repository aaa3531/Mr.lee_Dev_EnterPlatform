<?php
define('__C2__', true);

include_once("common.php");

use kr\c2 as c2;

$router = new c2\Router();
$url = $router->getRealURL();
$path = $router->getPath();
$data = $router->getData();

// css 로딩
$htmlheader = c2\HtmlHeader::getInstance();
if (file_exists($router->getDir().'/css/'.$data['mod'].'.css')) {
    $htmlheader->addCSS($url.'/css/'.$data['mod'].'.css');
}

if ($data['sec'] && file_exists($router->getDir().'/css/'.$data['sec'].'.css')) {
    $htmlheader->addCSS($url.'/css/'.$data['sec'].'.css');
}

if(!file_exists($path)) {
    http_response_code(404);
    echo '페이지가 존재하지 않습니다';
    exit;
}

if ($data['mod'] !== 'login' && !c2\isval($_SESSION['login'])) {
    header("Location: ?mod=login");
    exit;
}

include($path);
