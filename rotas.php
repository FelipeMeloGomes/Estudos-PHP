<?php

use Pecee\SimpleRouter\Exceptions\HttpException as Exception;
use Pecee\SimpleRouter\SimpleRouter as Router;
use sistema\Nucleo\Helpers;

try {
  Router::setDefaultNamespace('sistema\Controlador');

  Router::get(URL_SITE, 'SiteControlador@index');
  Router::get(URL_SITE . 'sobre-nos', 'SiteControlador@sobre');
  Router::get(URL_SITE . 'post/{id}', 'SiteControlador@post');
  Router::get(URL_SITE . '404',  'SiteControlador@erro404');

  Router::start();
} catch (Exception $e) {
  if (Helpers::localhost()) {
    echo $e;
  } else {
    Helpers::redirecionar('404');
  }
}
