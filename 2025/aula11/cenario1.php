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
    public String $nome;

    public function __construct($nome){
        $this -> setNome($nome);
    }

    public function getNome () {
        return $this->nome; 
    }
    public function setNome($nome) {
     $this -> nome = ucwords(strtolower($nome));

    }
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
    public String $nomeLocalidade;
    public String $Atividades; 

    public function __construct($nomeLocalidade,$Atividades){
        $this-> setNomeLocalidade($nomeLocalidade);
        $this -> setAtividades($Atividades);
    }

    public function informarAtividades() {
        echo "localidade: {$this->nomeLocalidade}\n
        Atividades: {$this->Atividades}";
    }

    public function setNomeLocalidade($nomeLocalidade) {
        $this -> nomeLocalidade = ucwords(strtolower($nomeLocalidade));
    }

    public function setAtividades($Atividades){
        $this -> Atividades = ucwords(strtolower($Atividades));
    }

    public function getAtividades () {
        return $this-> Atividades;
    }

    public function getNomeLocalidade() {
        return $this->nomeLocalidade;
    }
}

interface Atividade {
    public function executar ();
}

class Comida {
    public String $descricao;
    public function __construct($descricao){
        $this->setDescricao($descricao);
    }
    public function setDescricao($descricao) {
        $this->$descricao = ucwords(strtolower($descricao));
    }
    public function getDescricao() {
        return $this->descricao;
    }
}

class CorpoDagua {
    public $tipo; 
    public function __contruct ($tipo) {
        $this->setTipo($tipo);
    }
    public function setTipo($tipo) {
        $this->tipo = ucwords(strtolower($tipo));
    }
    public function getTipo(){ 
        return $this->tipo;
    }
}

?>