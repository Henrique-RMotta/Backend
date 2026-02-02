<?php 
    $temp = readline("Qual é a temperatura atual:");
    if ($temp >= 25){
        echo "Hoje está quente";
    } elseif ($temp >= 15 && $temp < 25 ){
        echo "Hoje está agradável";
    } else {
        echo "Hoje está frio";
    }
?>