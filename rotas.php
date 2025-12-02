<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::setDefaultNamespace('sistema\Controlador');

Router::get(URL_SITE, 'SiteControlador@index');
Router::get(URL_SITE . 'blog', 'SiteControlador@sobre');

Router::start();
