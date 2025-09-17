<?php
// Polifomismo
// O termo Poliformismo siginifica "Várias Formas". Associando isso a programação orientada a objetos, o conceito se trata de várias classes e suas instâncias (objetos) respondendo a um mesmo metodo de formas diferentes. No exemplo do interface da aula09, temos um metodo calcularArea() que responde de forma diferente á classe quadrado, á classe pentagono e a classe circulo. Isso quer dizer que a função é a mesma - calcular a area de forma geometrica - mas a operação muda de acordo com a figura

// crie um metodo chamado "mover()", aonde ele responde de varias formas diferentes, paras as sub-classes carro, avião,barco e elevador. Dica: utilize interfaces.
namespace AULA10;
interface Veiculo {
    public function mover();
}

class carro implements Veiculo {
    public $nome;
    public function mover() {
        echo "o Carro ($this->nome) esta andando\n"; 
    }
}

class aviao implements Veiculo {
    public $nome;
    public function mover() {
        echo "O avião($this->nome) está voando\n";
    }
}

class barco implements Veiculo {
    public $nome;
    public function mover() {
        echo "O Barco($this->nome) está nadando\n";
    }
}
$carro1 = new carro();
$carro1 ->nome="Golf";
$carro1 -> mover();

$carro2 = new carro();
$carro1 ->nome="Renault";
$carro1 -> mover();
echo "\n";

$aviao = new aviao();
$aviao->nome="Boeing 747";
$aviao -> mover();

$aviao = new aviao();
$aviao->nome="Boeing 737";
$aviao -> mover();

echo"\n";

$barco = new barco();
$barco->nome="Chalupa";
$barco -> mover();

$barco = new barco();
$barco->nome="Bergantim";   
$barco -> mover();

echo"\n";
?>