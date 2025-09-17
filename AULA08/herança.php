<?php
//Classe Pai ou Principal
    class Animal {
        private String $especie;
        private String $habitat;
        private String $sexo;
        private String $alimentacao;
        public function __construct($especie,$habitat,$sexo,$alimentacao) {
            $this->setEspecie($especie);
            $this->setHabitat($habitat);
            $this->setSexo($sexo);
            $this->setAlimentacao($alimentacao);
        }
        public function getEspecie() {
            return $this->especie;
        }
        public function setEspecie($especie) {
            $this->especie = ucwords(strtolower($especie));
        }
        public function getHabitat() {
            return $this->habitat;
        }
        public function setHabitat($habitat) {
            $this->habitat = ucwords(strtolower($habitat));
        }
        public function getSexo() {
            return $this->sexo;
        }
        public function setSexo($sexo) {
            $this->sexo = ucwords(strtolower($sexo));
        }
        public function getAlimentacao() {
            return $this->alimentacao;
        }
        public function setAlimentacao($Alimentacao) {
            $this->alimentacao = ucwords(strtolower($Alimentacao));
        }
    }
    class dog extends Animal {
        private String $raca;
        public function __construct($especie, $habitat, $sexo, $alimentacao,$raca) {
            parent::__construct($especie, $habitat, $sexo, $alimentacao);
            $this->setRaca($raca);
        }
        public function setRaca($Raca) {
            $this->raca = ucwords(strtolower($Raca));
        }
        public function getRaca() {
            return $this->raca;
        }
    }
    class Pangolim extends Animal {
        private int $N_escamas;
        public function __construct($especie, $habitat, $sexo, $alimentacao,$N_escamas) {
            parent::__construct($especie, $habitat, $sexo, $alimentacao);
            $this->N_escamas = abs((int)$N_escamas);
        }
    }
    class Macaco extends Animal  {
        private String $tempo_dormindo;
        private int $qtde_bananas_dia;

        public function __construct($especie, $habitat, $sexo, $alimentacao,$tempo_dormindo,$qtde_bananas_dia) {
            parent::__construct($especie, $habitat, $sexo, $alimentacao);
            $this->tempo_dormindo = $tempo_dormindo;
            $this->qtde_bananas_dia = $qtde_bananas_dia;
        }
    }
    // Crie uma classe Filha "Gato" para a classe "Animal", contendo o atributo "Tipo_ronronamento"
    class Gato extends Animal {
        private String $tipo_ronronamento;
        public function __construct($especie, $habitat, $sexo, $alimentacao,$tipo_ronronamento) {
            parent::__construct($especie, $habitat, $sexo, $alimentacao);
            $this->tipo_ronronamento = $tipo_ronronamento;              //not null
        }
    }
?>