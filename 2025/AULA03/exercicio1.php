<?php 
    $nome = readline ("Digite seu nome, por favor:");
    $idade = readline("Qual a sua idade: ");
    if ($idade >= 18){
        echo "Sr(a):$nome\nVocê é de maior de idade, já que possui $idade anos";
    } else {
        echo "Sr(a):$nome\nVocê é de menor de idade, já que possui $idade anos";

    }
?>

