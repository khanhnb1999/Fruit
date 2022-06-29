<?php
$uris = $_SERVER["REQUEST_URI"];
$uris = explode('/',$uris);
$currentModule = !empty($uris[3]) ? $uris[3] : 'products';
$baseUrl = sprintf(
    "%s://%s/%s",
    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
    $_SERVER['SERVER_NAME'],
    $uris[1].'/'.$uris[2]
);
$baseUrl = rtrim($baseUrl, '/');
