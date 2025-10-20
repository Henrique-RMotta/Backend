<?php
/*
class cinema {
public $filmes; 

public function ingressos(){
}
}

class Clientes{
public function comprarIngressos(){
}
}
*/
class SistemaDeCinema{
    public static function exibirSessoes(){
        echo " A sessões são exibidas";
    }
    public static function venderIngresso(){
        echo "O ingresso é vendido";
    }
}

class cliente {
    public $nome; 
    public function comprarIngresso () {
        echo "Senhor(a),seu ingresso foi comprado";
    }
}

class Filme {
    public $nome; 
    public $Classificacao;
    public $Descricao; 

    public function getDetalhes() {
        echo "Este filme é:\n
        -{$this->nome}\n
        -{$this->Classificacao}\n
        -{$this->Descricao}\n";
    } 
}

class Sessao {
public $numAssento; 

public function reservarAssento() {
    echo "O assento número {$this->numAssento} foi reservado";
}
public function liberarAssento() {
    echo "O assento número {$this->numAssento} foi liberado";
}
}

class Ingresso {
    public static function validar() {
        echo "O seu ingresso foi validado";
    }
}

class Sala {
    public $numSala;
    public $assentostotais;

    public function verificarDisponibilidade() {
        echo "{$this->numSala} está disponível";
    }
}
?>