<?php
namespace AULA11\Exercicios;
/* class pessoas {
    public $nome;
    public function comer() {
    }
    public function nadar() {
    }
}
    $turistas = new pessoas();
    $turistas -> nome = Turistas;
    class lugares {
    public $nome; 
    }
    $Japao = new lugares();
    $Japao -> nome = Japão;
    $Brasil = new lugares();
    $Brasil -> nome = Brasil;
    $Acre = new Lugares();
    $Acre -> nome = Acre; 
    $Rios = new lugares();
    $Rios -> nome = rios;
    $Praias = new Lugares(); 
    $Praias -> nome = praias;
}*/
class Turista implements atividade {
    public $nome;
    public function visitar(){
        echo "{$this->nome} visitou a localidade.";
    }
    public function comer() {
        echo "{$this->nome} comeu a comida. ";
    }

    public function nadar(){
        echo "{$this->nome} nadou.";
    }
    public function executar() {
        echo "{$this->nome} executou a ação.";
    }
}

class Localidade {
    public $nomeLocalidade;
    public function informarAtividades() {
        echo "localidade: {$this->nomeLocalidade}";
    }
}

interface Atividade {
    public function executar ();
}

class Comida {
    public $descricao;

    public function getDescricao() {
        return $this->descricao;
    }
}

class CorpoDagua {
    public $tipo; 

    public function getTipo(){ 
        return $this->tipo;
    }
}
?>