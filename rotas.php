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

        //ADMIN POSTS
        Router::get(URL_ADMIN . 'posts/listar', 'AdminPosts@listar');

        //ADMIN POSTS CADASTRAR
        Router::match(['get', 'post'], URL_ADMIN . 'posts/cadastrar', 'AdminPosts@cadastrar');
        //ADMIN POSTS EDITAR
        Router::match(['get', 'post'], URL_ADMIN . 'posts/editar/{id}', 'AdminPosts@editar');

        //ADMIN CATEGORIAS
        Router::get(URL_ADMIN . 'categorias/listar', 'AdminCategorias@listar');

        //ADMIN CATEGORIAS CADASTRAR
        Router::match(['get', 'post'], URL_ADMIN . 'categorias/cadastrar', 'AdminCategorias@cadastrar');
        //ADMIN CATEGORIAS EDITAR
        Router::match(['get', 'post'], URL_ADMIN . 'categorias/editar/{id}', 'AdminCategorias@editar');
    });

    Router::start();
} catch (Exception $ex) {
    if (Helpers::localhost()) {
        echo $ex->getMessage();
    } else {
        Helpers::redirecionar('404');
    }
}
