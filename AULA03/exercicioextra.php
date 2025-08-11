<?php
echo "Olá, bem-vindo ao identificador de tipos de variáveis\nDigite dois valores sendo de tipos iguais ou não\n";
    $valor1 = "abc";
    $valor2 = "a";
    if (gettype($valor1) === gettype($valor2)){
    echo "Variáveis de tipos iguais!\nPrimeiro valor do tipo",gettype($valor1), "e Segundo valor do tipo",gettype($valor2);
    } else {
        echo "ERRO! variaveis de tipos diferentes.\nPrimeiro valor do tipo ",gettype($valor1), " e Segundo valor do tipo ", gettype($valor2);
    }
?>