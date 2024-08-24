<?php

namespace Models;

require 'Traits/Builder.php';

use Traits\Builder;

class Gato
{
  use Builder;

  protected string $nome;
  protected int $idade;
  protected string $cor;
  protected string $raca;

  public function __toString()
  {
    return "Nome: {$this->nome}\n" .
      "Idade: {$this->idade} anos\n" .
      "Cor: {$this->cor}\n" .
      "Raça: {$this->raca}\n";
  }
}
