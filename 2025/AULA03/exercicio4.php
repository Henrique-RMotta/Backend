<?php
    echo "Olá, bem vindo a calculadora de apenas uma operação. Digite dois números a serem operados e o operador desejado\n";
    $num1 = readline("Digite o primeiro número:");
    $num2 = readline("Digite o segundo número:");
    $op = readline("Digite o operador:");
    switch ($op){
        case "+":
            $soma = $num1 + $num2;
            echo "O operador escolhido foi: soma - o resultado foi: $soma";
            break;
        case "*":
            $mult = $num1 * $num2;
            echo "O operador escolhido foi: multiplicação - o resultado foi: $mult";
            break;
        case "-":
            $sub = $num1 - $num2;
            echo "O operador escolhido foi: subtração - o resultado foi: $sub";
            break;
        case "/":
            $div = $num1 / $num2;
            echo "O operador escolhido foi: divisão - o resultado foi: $div";
            break;
        default:
            echo "Digite um operador válido !";
        
    }

?>