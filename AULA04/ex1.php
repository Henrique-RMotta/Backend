<?php
$marca_carro1 = "Honda";
$modelo_carro1 = "Civic";
$ano_carro1 = 2016;
$revisao_carro1 = true;
$Ndonos_carro1=2;

$marca_carro2 = "BMW";
$modelo_carro2 = "320i";
$ano_carro2 = 2012;
$revisao_carro2 = false;
$Ndonos_carro2=3;

$marca_carro3 = "Fiat";
$modelo_carro3 = "Uno";
$ano_carro3 = 2005;
$revisao_carro3 = false;
$Ndonos_carro3=1;

$marca_carro4 = "Volkswagen";
$modelo_carro4 = "Jetta";
$ano_carro4 = 2020;
$revisao_carro4 = true;
$Ndonos_carro4=7;

function exibirCarro($modelo, $marca, $ano, $revisao, $Ndonos) {
    echo("    Marca: $marca\n
    Modelo: $modelo\n
    Ano:$ano\n
    Revisao:$revisao\n
    N-Donos:$Ndonos\n");
    if ($revisao == true) {
        echo "Já passou por revisão";
    }
}
exibirCarro($modelo_carro1,$marca_carro1,$ano_carro1,$revisao_carro1,$Ndonos_carro1);
?>