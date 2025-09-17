<?php
    // Modificadores de acesso:
    //     Existem 3 tipos: public,private e protected
    //     public NomeDoAtributo: métodos e atributos públicos (qualquer um acessa)
    //     private NomeDoAtributo: métodos e atributos privados para acesso somente dentro da classe.
    //     Utilizamos os geters e setters para acessa-los
    //     protected NomeDoAtributo: métodos e atributos protegidos para acesso somente da classes e de sua classes filhas

    //     pacotes (packages): sintaxe logo no inicio do código que atribui de onde os arquivos
    //     pertencem, ou seja, o caminho da pasta em que ele está contido. Exemplo:
    //         namespace Aula 09;
    //     Caso tenham mais arquivos eque formam o BackEnd de uma página WEB e possuem a mesma
    //     raiz, o namespace será o mesmo.
    namespace BackEnd\AULA09;
    // Interfaces: É um recurso no qual garante que obrigatoriamente a classe tenha que construir algum método previamente determiando. Funciona como uma promessa
    // ou contrato. Exemplo: Configuramos uma interface "pagamento" que faz com que qualquer classe que implemente, tenha que obrigatoriamente construir o método "pagar"
    interface Pagamento {
        //Interface de contrato de pagamento
        public function pagar($valor);
    }
    class cliente implements Pagamento {
        private String $formaPagamento;
        private float $valor;
        public function __construct($valor,$formaPagamento) {
            $this->valor = abs($valor);
            $this->formaPagamento = strtolower($formaPagamento);
        }
        public function getFP() {
            return $this->formaPagamento;
        }
        public function pagar($valor){
            switch ($this->getFP()) {
                case "cartao de credito":
                    echo "\nPagamento foi realizado com cartão de crédito, valor: R$$valor";
                    break;
                case "pix":
                    echo "\nPagamento foi realizado via PIX, valor: R$$valor";
                    break;
                case "dinheiro":
                    $valor *= 0.90;
                    echo "\nPagamento foi realizado com dinheiro em especie, valor: R$$valor";
                    break;
                
                default:
                    echo "\nErro no pagamento forma escolhida não existe.";
                    break;
            }
        }
        public function realizarPagamento() {
            $this->pagar($this->valor);
        }
    }
    $cliente1 = new cliente(2545.25,"pix");
    $cliente1->realizarPagamento();
    $cliente2 = new cliente(4361,"dinheiro");
    $cliente2->realizarPagamento();
    $cliente3 = new cliente(7812.96,"cartao de credito");
    $cliente3->realizarPagamento();

    // Exercícios
    //1. Criando uma interface simples
    // Crie uma interface chamada forma que obrigue qualquer classe a ter um metodo calcularArea()
    //Depois, cire as classes quadrado e circulo que implementam a interface.
    //Área quadrado = l²
    //Área circulo = pi * r²

    interface forma {
        public function calcularArea($forma);
    }
    class formas implements forma{
        public function calcularArea($forma) {
            switch ($forma) {
                case "quadrado":
                    $lado = readline("\nDigite a medida do lado de seu quadrado: ");
                    echo "A área de seu quadrado é ". $lado**2;
                    break;
                case "circulo":
                    $raio = readline("\nDigite a medida do raio de seu circulo: ");
                    $areaCirculo = $raio**2*number_format(pi(),2);
                    echo "A área de seu circulo é $areaCirculo";
                    break;
                case "pentagono":
                    $lado = readline("\nDigite a medida do lado de seu pentagono: ");
                    $apotema = readline("\nDigite a medida do apótema de seu pentagono: ");
                    $areaPentagono = ($lado*5*$apotema)/2;
                    echo "A área do seu pentagono é $areaPentagono";
                    break;
                case "hexagono":
                    $lado = readline("\nDigite a medida do lado de seu hexagono: ");
                    $areaHexagono = number_format((3**(1/2)*3*$lado)/2,2);
                    echo "A área do seu hexagono é $areaHexagono";
                    break;
                default:
                    echo "Forma não existe ou foi digitada incorretamente";
                    break;
            }
        }
    }
    $forma1 = new formas();
    $forma1->calcularArea("hexagono");
?>