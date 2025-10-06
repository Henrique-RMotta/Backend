<?php
namespace AULA11\Exercicios;
/*
class planetas {
public $nome; 
public function nascer (){
}
public function crescer(){
}
public function engravidar(){
}
public function fazerEscolhas(){
}
public function doarSangue(){
}
}
$Terra = new planetas(); 
$Terra -> nome = Terra; 
$Terra -> nascer();
$Terra-> engravidar(); 
$Terra-> fazerEscolhas();
$Terra -> doarSangue();
class pessoas extends planetas{ 
}
*/

class Pessoa {
    public $nomePessoa; 
    public function __construct($nomePessoa){
        $this->setNomePessoa($nomePessoa); 
    }

    public function setNomePessoa($nomePessoa) {
        $this -> nomePessoa = ucwords(strtolower($nomePessoa));
    }

    public function getNome() {
        return $this-> nomePessoa;
    }
    public function engravidar() {
        echo "A {$this->nomePessoa} engravidou";
    }

    public function nascer(){
        echo "O(a) {$this->nomePessoa} nasceu";
    }
    public function crescer() { 
        echo "O(a) {$this->nomePessoa} cresceu";
    }
    public function fazerEscolha() {
        echo "O(a) {$this->nomePessoa} fez a escolha";
    }

    public function doarSangue(){
        echo "O(a) {$this->nomePessoa} doou sangue";
    }
    
}

class Escolha {
    public static function executar() {
        echo "A escolha foi executada";
    }
}

class BancoDeSangue {
    public static function receberDoacao() {
        echo "A doação foi recebida";
    }
}

?>