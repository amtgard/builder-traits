<?php
require 'Models/Gato.php';
require 'Models/GatoDataHandler.php';
require 'Models/GatoGetHandler.php';
require 'Models/GatoSetHandler.php';
require 'Models/PrivateGato.php';
require 'Models/Penguin.php';
require 'Models/Wombat.php';

require "../vendor/autoload.php";

use Amtgard\PHPUnit\AmtgardTestCase;
use Models\Gato;
use Models\GatoDataHandler;
use Models\GatoGetHandler;
use Models\GatoSetHandler;
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

    public function testOnSetIsCalledOnSet_forDataTrait() {
        $private = GatoDataHandler::builder()->build();
        $private->setAField('c');
        self::assertEquals('c', $private->getAField());
        self::assertEquals('c', $private->getOnSetField());
    }

    public function testOnGetIsCalledOnGet_forDataTrait() {
        $private = GatoDataHandler::builder()->build();
        $private->setAField('c');
        $private->getAField();
        self::assertEquals('c', $private->getAField());
        self::assertEquals('side-effect', $private->getOnGetField());
    }

    public function testOnSetIsCalledOnSet_forSetTrait_withSetter() {
        $private = GatoSetHandler::builder()->build();
        $private->setAField('d');
        self::assertEquals('d', $private->getAField());
        self::assertEquals('d', $private->getOnSetField());
    }

    public function testOnSetIsCalledOnSet_forSetTrait_withMagicSet() {
        $private = GatoSetHandler::builder()->build();
        $private->aField = 'c';
        self::assertEquals('c', $private->getAField());
        self::assertEquals('c', $private->getOnSetField());
    }

    public function testOnGetIsCalledOnGet_forGetTrait_withGetter() {
        $private =  GatoGetHandler::builder()->build();
        $v = $private->getAField();
        self::assertEquals('side-effect', $private->getOnGetField());
    }

    public function testOnGetIsCalledOnGet_forGetTrait_withMagicGet() {
        $private =  GatoGetHandler::builder()->build();
        $v = $private->aField;
        self::assertEquals('side-effect', $private->getOnGetField());
    }
}

