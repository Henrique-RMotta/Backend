<?php 
namespace AULA11\Exercicios;
/*
class Personagens { 
public nome; 
public function comer(){ 
}
public function amar(){ 
}
}
$JonhSnow = new Personagens(); 
$JonhSnow -> nome = JonhSnow; 
$JonhSnow -> comer(); 
$JonhSnow -> amar(); 
$PapaiSmurf = new Personagens(); 
$PapaiSmurf -> nome = PapaiSmurf; 
$PapaiSmurf -> comer(); 
$PapaiSmurf -> amar(); 
$Deadpool = new Personagens(); 
$Deadpool -> nome = Deadpool; 
$Deadpool -> comer(); 
$Deadpool -> amar(); 
$Dexter = new Personagens(); 
$Dexter -> nome = Dexter; 
$Dexter -> comer(); 
$Dexter -> amar(); 

class Jornada {
public function chover();{
}
}
$Jornada = new Jornada();
$Jornada -> chover();
*/

class Personagem {
    public $nomePersonagem; 
    public function seguirJornada() {
        echo "O(a) {$this->nomePersonagem} seguiu a jornada";
    }

    public function enfrentarDesafio() {
        echo "O(a) {$this->nomePersonagem} enfrentou o desafio";
    }

    public function celebrar(){
        echo "O (a) {$this->nomePersonagem} celebrou"; 
    }
}

class Jornada {
    public static function avancar() {
        echo "Os herois avançaram";
    }
}

class clima {
    public static function mudar() {
        echo "O clima mudou";
    }
}

class Dificuldade {
    public static function superar() {
        echo "A dificuldade foi superada";
    }
}

class Refeicao {
    public $nomeRefeicao;

    public function servir() {
        echo "A refeição {$this->nomeRefeicao} foi servida ";
    }
}
?>