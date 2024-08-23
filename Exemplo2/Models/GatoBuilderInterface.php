<?php

namespace Exemplo2\Models;

interface GatoBuilderInterface
{
  public function idade(int $idade);

  public function nome(string $nome);

  public function cor(string $cor);

  public function raca(string $raca);

  public function build();
}
