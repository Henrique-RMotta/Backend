<?php
class produtosmercado {// criando classe 
    //cração dos atributos
    public $nome; 
    public $categoria;
    public $fornecedor;
    public $qtde_estoque;
    //criação dos metodos  

    public function atualizarestoque ($qtde_vendida) {
       $this-> qtde_estoque -= $qtde_vendida;
       return $this->qtde_estoque; 

    }
    // Criando construtor
    public function __construct($nome,$categoria,$fornecedor,$qtde_estoque){
        $this->nome = $nome;
        $this->categoria=$categoria;
        $this->fornecedor=$fornecedor;
        $this->qtde_estoque=$qtde_estoque;
    }
}
//Criando objetos sem construtor feito
$produto1 = new produtosmercado();
$produto1 -> nome = "Suco Tang";
$produto1 -> categoria = "Bebidas";
$produto1 -> fornecedor = "Mondelez";
$produto1 -> qtde_estoque = 200;

$produto2 = new produtosmercado();
$produto2 -> nome = "Energético Monster";
$produto2 -> categoria = "Bebidas";
$produto2 -> fornecedor = "Coca-Cola";
$produto2 -> qtde_estoque = 120;


//Criando objetos com construtor feito 
$produto1 = new produtosmercado ("Suco Tang", "Bebidas", "Mondelez",200);
$produto2 = new produtosmercado ("Energético Monster","Bebidas","Coca-Cola",120);


?>