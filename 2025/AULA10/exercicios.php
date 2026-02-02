<?php
namespace AULA10;


interface area {
    public function calculararea();
}

class quadrado implements area {
public $lado;
public function calculararea() {
   $lado = $this -> lado;
   $area = $lado * $lado;

   echo "A área do quadrado é {$area}cm²\n";
}
}
$quadrado = new quadrado();
$quadrado->lado = 10;
$quadrado ->calculararea();

class retangulo implements area {
    public $base;
    public $altura;

    public function calculararea(){
        $area = $this->base * $this->altura;
        echo "A área do retangulo é {$area}cm²\n";
    }
}

$retangulo = new retangulo();
$retangulo -> base =10;
$retangulo -> altura = 5;
$retangulo->calculararea();

class circulo implements area {
    public $raio;
    public $pi = 3.14;

    public function calculararea(){
        $area = $this-> pi * ($this->raio**2);
        echo "A área do circulo é: {$area}cm²\n";
    }
}
$circulo = new circulo();
$circulo -> raio = 14;
$circulo -> calculararea();

// EXERCICIO 2
interface som {
    public function fazerSom();
}
class animal {
    public String $som;
    public function __construct($som){
        $this -> som = $som;
    }
    public function fazerSom() {
        echo "{$this->som}\n";
    }
}
class cachorro extends animal {

   public function __construct($som){
        parent::__construct($som);
   }
}

$cachorro = new cachorro("auau");
$cachorro -> fazerSom();

class gato extends animal {
    public function __construct($som){
        parent::__construct($som);
    }
}
$gato = new gato("Miau");
$gato -> fazerSom();

class vaca extends animal {
    public function __construct($som){
        parent::__construct($som);
    }
}
$vaca = new vaca("Muuu");
$vaca -> fazerSom();

abstract class transporte {
    public $nome;
    public $verbo;
    public $local;
    public function mover(){
        echo "O(a){$this->nome} está {$this->verbo} no(a) {$this->local}\n";
    }
}
// exercicio 3
class carro extends transporte {
    public $nome = "carro";
    public $verbo = "andando";
    public $local = "estrada";
}

class Barco extends transporte {
    public $nome = "Barco";
    public $verbo = "nadando";
    public $local = "mar";
}

class Aviao extends transporte {
    public $nome = "Aviao";
    public $verbo = "Voando";
    public $local = "Céu";
}
class elevador extends transporte {
    public $nome = "Elevador";
    public $verbo = "Correndo pelo";
    public $local = "prédio";
}

$carro = new carro();
$carro ->mover();

$barco = new barco();
$barco -> mover();

$aviao = new aviao();
$aviao -> mover();

$elevador = new elevador();
$elevador -> mover();

//exercicio 4
class Email {
    public function enviar(){
        echo "Enviando email...";
    }
}

class Sms {
    public function enviar(){
        echo"Enviando Sms\n";
    }
}
$email = new Email();
$sms = new Sms();

function notificação ($objeto){
    $objeto -> enviar();
}

notificação($email);
notificação($sms);

//exercicio 5
class calculadora {
    public $num1;
    public $num2;
    public $num3;

    public function __construct($num1,$num2){
        $this -> num1 = $num1;
        $this -> num2 = $num2;
    }

    public function somar(){
        $soma = $this->num1 + $this->num2 + $this->num3;
        echo "A soma é:{$soma}\n";
    }
    
}

$num = new calculadora(10,15);
$num->somar();
$num2 = new calculadora(10,20);
$num2 -> num3 = 30;
$num2->somar();
?>