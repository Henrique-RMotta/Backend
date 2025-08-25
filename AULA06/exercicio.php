<?php

// Crie 3 construtores sendo:
//1º construtor: recebe 3 parametros sensdo eles $dia, $mes e $ano
//2º Construtor: Recebe 7 parametros sendo elas: $nome, $idade, $cpf, $telefone, $endereco, $estado civil e $sexo
//3° Construtor: Recebe 5 parametros sendo eles: $marca, $nome, $categoria, $data_fabricacao e $data_venda;
class moto {
    public $marca;
    public $modelo;
    public $ano;
    public $bateu;
}

$moto1 = new moto();
$moto1 -> marca = "Honda";
$moto1 -> modelo = "Hornet";
$moto1 -> ano = "2018";
$moto1 -> bateu = true;

$moto2 = new moto();
$moto2 -> marca = "BMW";
$moto2 -> modelo = "S1000rr";
$moto2 -> ano = "2020";
$moto2 -> bateu = false;

$moto3 = new moto();
$moto3 -> marca = "honda";
$moto3 -> modelo = "biz";
$moto3 -> ano = "2025";
$moto3 -> bateu = true;

//  public function __construct($dia,$mes,$ano) {
//         $this -> dia = $dia;
//         $this -> mes = $mes;
//         $this -> ano = $ano;
//     }

// public function __construct($nome,$idade,$cpf,$telefone,$endereco,$estado_civil,$sexo){
//         $this -> nome = $nome;
//         $this -> idade = $idade;
//         $this -> cpf = $cpf;
//         $this -> endereco = $endereco;
//         $this -> estado_civil = $estado_civil;
//         $this -> sexo = $sexo; 

// }

// public function __construct($marca,$nome,$categoria,$data_fabricacao,$data_venda){
//     $this -> marca = $marca;
//     $this -> nome = $nome;
//     $this -> categoria = $categoria;
//     $this -> $data_fabricacao = $data_fabricacao;
//     $this -> data_venda = $data_venda;
// }

?>

    <!-- public $dia;
    public $mes;
    public $nome;
    public $idade;
    public $cpf;
    public $telefone;
    public $endereco;
    public $estado_civil;
    public $sexo; -->