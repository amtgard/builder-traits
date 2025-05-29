<?php
require 'Models/Gato.php';
require 'Models/PrivateGato.php';
require 'Models/Penguin.php';
require 'Models/Wombat.php';

require "../vendor/autoload.php";

use Amtgard\PHPUnit\AmtgardTestCase;
use Models\Gato;
use Models\Penguin;
use Models\Wombat;
use Models\PrivateGato;

class BuilderTest extends AmtgardTestCase {

    private Gato $gato;
    private Penguin $penguin;

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
        $this->gato->setNome('Siau');
        self::assertEquals("Models\Gato Object\n(\n    [nome:Models\Gato:private] => Siau\n    [idade:protected] => 5\n    [cor:protected] => Preto\n    [raca:protected] => Persa\n)\n", print_r($this->gato, true));
    }

    public function testGetter() {
        self::assertEquals("Miau", $this->gato->getNome());
    }

    public function testToBuilder() {
        $nekoBuilder = $this->gato->toBuilder();
        $nekoBuilder->nome('Niau');
        $neko = $nekoBuilder->build();
        self::assertEquals("Models\Gato Object\n(\n    [nome:Models\Gato:private] => Niau\n    [idade:protected] => 5\n    [cor:protected] => Preto\n    [raca:protected] => Persa\n)\n", print_r($neko, true));
    }

    public function testToBuilderDoesNotMutate() {
        $neko = Gato::builder()->nome('Charlie')->build();
        $chuck = $neko->toBuilder()->nome('Chuck')->build();
        self::assertNotEquals(print_r($neko, true), print_r($chuck, true));
        self::assertEquals('Charlie', $neko->getNome());
        self::assertEquals('Chuck', $chuck->getNome());
    }

    public function testGetPenguinName() {
        $this->penguin = Penguin::builder()->name("Sam")->build();
        self::assertEquals("Sam", $this->penguin->getName());
    }

    public function testSetWombatAge() {
        $wombat = Wombat::builder()->age(3)->build();
        $wombat->setAge(5);
        self::assertEquals(5, $wombat->getAge());
    }

    public function testPrivateGatoDoesNotThrow() {
        self::assertDoesNotThrow(function() {
            $private = PrivateGato::builder()->aField('a')->build();
            self::assertEquals('a', $private->getAField());
        });
    }

    public function testPostInitIsCalledOnBuild() {
        $private = PrivateGato::builder()->build();
        self::assertEquals('b', $private->getBField());
        self::assertNull($private->getAField());
    }
}

