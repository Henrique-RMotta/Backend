<?php
class carro {
    public $marca;
    public $modelo;
    public $revisao;
    public $N_donos;

    public $ano;

    public function __construct($marca,$modelo,$ano,$revisao,$N_donos){
        $this->marca=$marca;
        $this->modelo=$modelo;
        $this->ano=$ano;
        $this->N_donos=$N_donos;
        $this->revisao=$revisao;
    }
}

$carro1 = new carro("Porche","911",2020, false, 3);//criando objeto 1 
$carro2 = new carro("Mitsubish","Lancer",1945,true,1);//criando objeto 2

//criando mais 4 objetos

$carro3 = new carro("Honda","Civic","2005",true,2);
$carro4 = new carro("Ford","Fiesta","2015",false,5);
$carro5 = new carro("Volkswagen","Golf","2018",true,3);
$carro6 = new carro("BMW","M3","2021",true,2);

?>