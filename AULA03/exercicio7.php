<?php 
    $num = readline("Olá , veja a os números pares até um número a sua escolha:");
    for ($i = 0; $i < $num ; $i++){
        if ($i%2 == 0){
            echo "$i\n";
        }
    }
    ?>