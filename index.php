<?php

//Arquivo index responsável pela inicialização do sistema
require 'vendor/autoload.php';

//require 'rotas.php';

use sistema\Modelo\PostModelo;

$posts = (new PostModelo())->ler();

foreach ($posts as $post) {
  echo $post->titulo;
}
