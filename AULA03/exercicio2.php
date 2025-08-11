<?php
    $nome = readline("Olá, por gentileza, poderia digitar seu nome:");
    $nota = readline("Digite a sua nota, por favor:");
        if($nota >= 9){
            echo "Senhor(a) $nome\no resultado da sua nota foi: execelente";
        } elseif ($nota >= 7) {
            echo "Senhor(a) $nome\no resultado da sua nota foi: bom";
        } else {
            echo "Senhor(a) $nome\no resultado da sua nota foi: reprovado";
  
        }
?>