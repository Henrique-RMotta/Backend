<?php 
    $num = readline("Olá, digite um número a fazer a tabuada:");
    for ($i = 0; $i <= 10 ; $i++){
        $tabuada = $num * $i;
        echo("$num * $i = $tabuada\n");
    }
    ?>