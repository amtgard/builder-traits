<?php

namespace Models;

use Amtgard\Traits\Builder\Builder;
use Amtgard\Traits\Builder\Data;
use Amtgard\Traits\Builder\ToBuilder;

class Gato
{
  use Builder;
  use ToBuilder;
  use Data;

  private string $nome;
  protected ?int $idade = null;
  protected ?string $cor = null;
  protected ?string $raca = null;

  public function __toString()
  {
    return "Nome: {$this->nome}\n" .
      "Idade: {$this->idade} anos\n" .
      "Cor: {$this->cor}\n" .
      "Raça: {$this->raca}\n";
  }
}
