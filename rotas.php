<?php

use Pecee\SimpleRouter\SimpleRouter as Router;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException as Exception;
use sistema\Nucleo\Helpers;

try {
    Router::setDefaultNamespace('sistema\Controlador');

    Router::get(URL_SITE, 'SiteControlador@index');
    Router::get(URL_SITE . 'sobre-nos', 'SiteControlador@sobre');
    Router::get(URL_SITE . 'post/{id}', 'SiteControlador@post');
    Router::get(URL_SITE . 'categoria/{id}', 'SiteControlador@categoria');
    Router::post(URL_SITE . 'buscar', 'SiteControlador@buscar');

    Router::get(URL_SITE . '404', 'SiteControlador@erro404');

    Router::group(['namespace' => 'Admin'], function () {
        Router::get(URL_ADMIN . 'dashboard', 'AdminDashboard@dashboard');
    });

    Router::start();
} catch (Exception $ex) {
    if (Helpers::localhost()) {
        echo $ex->getMessage();
    } else {
        Helpers::redirecionar('404');
    }
}
