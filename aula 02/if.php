<?php
    $nome = "Enzo Enrico";
    $nota1 = 7;
    $nota2 = 10;
    $freq = 10;
    $media = ($nota1 + $nota2)/2;
    if ($media >= 7 && $freq>=80 || $nome === "Enzo Enrico") {
    echo "Você passou !!, com a média: $media e frequencia: $freq";
    } else {
    echo "Você não passou 😭";
    }

?>
