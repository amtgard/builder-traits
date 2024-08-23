<?php

namespace Exemplo2\Models;

require 'GatoBuilderInteface.php';

class Gato
{
  protected string $nome;
  protected int $idade;
  protected string $cor;
  protected string $raca;

  protected function __construct(GatoBuilderInterface $builder)
  {
    $this->nome = $builder->nome;
    $this->idade = $builder->idade;
    $this->cor = $builder->cor;
    $this->raca = $builder->raca;
  }

  public function __toString()
  {
    return "Nome: {$this->nome}\n" .
      "Idade: {$this->idade} anos\n" .
      "Cor: {$this->cor}\n" .
      "Raça: {$this->raca}\n";
  }
}
