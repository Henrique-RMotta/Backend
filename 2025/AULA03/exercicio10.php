<?php 
for ($i = 0; $i <= 5 ; $i++){
    $esc = readline("Olá escolha dentre as seguintes opções:\n1-Olá\n2-Data Atual\n3-sair\nDigite aqui:");
    switch ($esc){
        case 1:
            echo "Olá!\n";
            break;
        case 2:
            echo "11/08/2025\n";
            break;
        case 3:
            echo "Tchau\n";
            $i =5;
            break;
        default:
            echo "Digite um comando válido\n";
    }
}
?>




