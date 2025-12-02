<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::setDefaultNamespace('sistema\Controlador');

Router::get(URL_SITE, 'SiteControlador@index');
Router::get(URL_SITE . 'sobre-nos', 'SiteControlador@sobre');

Router::start();
