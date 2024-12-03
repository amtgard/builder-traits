<?php

namespace Models;

use Amtgard\Traits\Builder\Builder;
use Amtgard\Traits\Builder\Setter;
use Amtgard\Traits\Builder\ToBuilder;
use Amtgard\Traits\Builder\Getter;

class Gato
{
  use Builder;
  use ToBuilder;
  use Getter;
  use Setter;

  private string $nome;
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
