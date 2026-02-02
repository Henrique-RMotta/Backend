<?php
    echo "Bem vindo ao mostrador de dias da semana, digite um número de 1 a 7\n";
    $dia = readline("Digite o número:");
        switch ($dia){
            case 1:
                echo "O dia da semana é: segunda";
                break;
            case 2:
                echo "O dia da semana é: terça";
                break;
            case 3:
                echo "O dia da semana é: quarta";
                break;
            case 4:
                echo "O dia da semana é: quinta";
                break;
            case 5: 
                echo "O dia da semana é: sexta";
                break;
            case 6:
                echo "O dia da semana é: sábado";
                break;
            case 7:
                echo "O dia da semana é: domingo";
                break;
            default:
                echo "Digite um valor válido";
                break;

        }
?>