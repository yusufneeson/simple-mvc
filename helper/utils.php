<?php

use Core\View;

function view(string $view, array $opts)
{
    $view = implode('/', explode('.', $view));
    $ext  = pathinfo($view, PATHINFO_EXTENSION);
    $view = empty($ext) ? $view . '.php' : $view;
    $base = !isset($opts['base']) ? 'layouts/app' : $opts['base'];
    $opts = array_merge($opts, ['page' => $view]);

    return (new View)->load($base, $opts);
}


function is_php($version)
{
    static $_is_php;
    $version = (string) $version;

    if (!isset($_is_php[$version])) {
        $_is_php[$version] = version_compare(PHP_VERSION, $version, '>=');
    }

    return $_is_php[$version];
}
