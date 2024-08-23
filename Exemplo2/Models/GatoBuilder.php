<?php

namespace Exemplo2\Models;


class GatoBuilder implements GatoBuilderInterface
{

  protected string $nome;
  protected int $idade;
  protected string $cor;
  protected string $raca;

  public function nome($nome)
  {
    $this->nome = $nome;
    return $this;
  }

  public function idade($idade)
  {
    $this->idade = $idade;
    return $this;
  }

  public function cor($cor)
  {
    $this->cor = $cor;
    return $this;
  }

  public function raca($raca)
  {
    $this->raca = $raca;
    return $this;
  }

  public function build()
  {
    return new Gato($this);
  }
}
