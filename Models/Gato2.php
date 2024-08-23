<?php

namespace Models;

require 'Models/Traits/Builder.php';

use Models\Traits\Builder;

class Gato2
{
  use Builder;

  protected string $nome;
  protected int $idade;
  protected string $cor;
  protected string $raca;

  public function __toString(): string
  {
    return "Nome: {$this->nome}\n" .
      "Idade: {$this->idade} anos\n" .
      "Cor: {$this->cor}\n" .
      "Raça: {$this->raca}\n";
  }
}
