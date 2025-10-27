<?php
    namespace AULA14_1;
    require_once "ProdutoDAO.php";
    require_once "Produto.php";

    $dao1 = new ProdutoDAO();
    $dao1 -> criarProdutos(new Produto(1,"Tomate",3));
    $dao1 -> criarProdutos(new Produto(2,"Maçã",5));
    $dao1 -> criarProdutos(new Produto(3,"Queijo Brie",10));
    $dao1 -> criarProdutos(new Produto(4,"Iogurte Grego",10));
    $dao1 -> criarProdutos(new Produto(5,"Guaraná Jesus", 8));
    $dao1 -> criarProdutos(new Produto(6, "Bolacha Bono",5));
    $dao1 -> criarProdutos(new Produto(7,"Desinfetante Urca",30));
    $dao1 -> criarProdutos(new Produto(8,"Prestobarba Bic",20));

    $dao1 -> atualizarProdutos(7,"Desinfetante Barbarex",30);

    $dao1 -> atualizarProdutos(1, "Tomate", 5);

    $dao1 -> atualizarProdutos(2,"Maçã",7);

    $dao1 -> deletarProdutos(1);
    $dao1 -> deletarProdutos(2);

    echo "\nResultado:\n";
    foreach ($dao1->lerProdutos() as $produto)  {
        echo "{$produto->getCodigo()} - {$produto->getNome()} - {$produto->getPreco()} \n";
    }

?>