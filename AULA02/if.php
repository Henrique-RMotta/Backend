<?php
echo "Boa Tarde\n";
// pede ao usuario que digite a nota,frequencia e nome dos alunos
    $nome = readline("Digite o nome do aluno:");
    $nota1 = readline("Digite a 1° nota do aluno:");
    $nota2 = readline("Digite a 2° nota do aluno:");
    $freq = readline("Digite a presença do aluno:");// presença de porcentagem
    $media = ($nota1 + $nota2)/2;
    if ($media >= 7 && $freq>=80 || $nome === "Enzo Enrico") {
    echo "Você passou !!, com a média: $media e frequencia: $freq";
    } else {
    echo "Você não passou 😭";
    }
// se o nome for enzo enrico ele passará automaticamente
?>
