<?php
require 'Models/Gato.php';

use Models\Gato;

$gato = Gato::builder()
  ->nome('Miau')
  ->idade(5)
  ->cor('Preto')
  ->raca('Persa')
  ->build();

echo $gato;
