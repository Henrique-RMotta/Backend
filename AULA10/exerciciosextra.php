<?php
    namespace AULA10;

    interface movel {
        public function mover();
    }

    interface abastecivel {
        public function abastecer($quantidade);
    }

    interface manutencivel {
        public function fazerManutencao();
    }

    class Carro implements movel,abastecivel{
        public function mover(){
            echo "O carro está se movimentando\n";
        }

        public function abastecer($quantidade){
            echo "Foi abastecido $quantidade litros de gasolina\n";
        }
    }

    class bicicleta implements movel,manutencivel{
        public function mover(){
            echo"a bicicleta está pedalando.\n";
        }

        public function fazerManutencao(){
            echo"A bicicleta foi lubrificada\n";
        }
    }

    class onibus implements movel,manutencivel,abastecivel{
        public function mover(){
            echo"O ônibus está trasnsportando passageiros\n";
        }

        public function abastecer($quantidade){
            echo "O ônibus abasteceu $quantidade litros de gasolina\n";
        }

        public function fazerManutencao(){
            echo"O ônibus está passando por revisão\n";
        }
    }

    $carro = new carro();
    $carro ->mover();
    $carro ->abastecer(10);

    $bicicleta = new bicicleta();
    $bicicleta->mover();
    $bicicleta->fazerManutencao();

    $onibus = new onibus();
    $onibus->mover();
    $onibus->abastecer(40);
    $onibus->fazerManutencao();
?>