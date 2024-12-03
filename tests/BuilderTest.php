<?php
require 'Models/Gato.php';

use PHPUnit\Framework\TestCase;
use Models\Gato;
use function PHPUnit\Framework\assertEquals;

class BuilderTest extends TestCase {

    private Gato $gato;

    public function setUp(): void
    {
        $this->gato = Gato::builder()
            ->nome('Miau')
            ->idade(5)
            ->cor('Preto')
            ->raca('Persa')
            ->build();
    }
    public function testBuilder() {
        self::assertEquals("Models\Gato Object\n(\n    [nome:Models\Gato:private] => Miau\n    [idade:protected] => 5\n    [cor:protected] => Preto\n    [raca:protected] => Persa\n)\n", print_r($this->gato, true));
    }

    public function testSetter() {
        $this->gato->nome('Siau');
        self::assertEquals("Models\Gato Object\n(\n    [nome:Models\Gato:private] => Siau\n    [idade:protected] => 5\n    [cor:protected] => Preto\n    [raca:protected] => Persa\n)\n", print_r($this->gato, true));
    }

    public function testGetter() {
        self::assertEquals("Miau", $this->gato->nome);
    }

    public function testToBuilder() {
        $nekoBuilder = $this->gato->toBuilder();
        $nekoBuilder->nome('Niau');
        $neko = $nekoBuilder->build();
        self::assertEquals("Models\Gato Object\n(\n    [nome:Models\Gato:private] => Niau\n    [idade:protected] => 5\n    [cor:protected] => Preto\n    [raca:protected] => Persa\n)\n", print_r($neko, true));
    }
}

