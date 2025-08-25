<?php
//crie uma classe (molde de objetos) chamada 'cachorros' com os seguintes atributos: nome, idade, raça, castrado e sexo
class cachorro {
    public $nome;
    public $idade;
    public $raca;
    public $castrado;
    public $sexo;

    public function __construct($nome,$idade,$raca,$castrado,$sexo){
        $this->nome = $nome;
        $this->idade = $idade;
        $this->raca = $raca;
        $this->castrado = $castrado;
        $this->sexo = $sexo;
    }
    public function latir () {
        $nome = $this -> nome;
        echo "O cachorro $nome está latindo !\n";
    }

    public function marcarterritorio () {
        $nome = $this -> nome;
        $raca = $this -> raca;
        echo "O cachorro $nome da raça $raca está marcando território\n";
    }
}

$cachorro1= new cachorro("Dog",3,"Labrador",true,"Macho");

$cachorro2= new cachorro("lua",5,"shitzu",false,"Femea");

$cachorro3= new cachorro("teo",1,"lulu da palmerania",true,"Macho");
$cachorro4= new cachorro("toddy",4,"pug",true,"Macho");
$cachorro5 = new cachorro("mel",2,"Golden", false, "femea" );
$cachorro6= new cachorro("kayque", 12,"labrador",true,"Macho");
$cachorro7 = new cachorro("blessed",7,"pooddle",true,"femea");
$cachoro8 = new cachorro("cristal",3,"pug",true,"Femea");
$cachorro9 = new cachorro("cacau",2,"Shitzu",true,"femea");
$cachorro10 = new cachorro("jao",10,"Chihuahua",false,"Macho");

$cachorro1 -> latir();
$cachorro2 -> marcarterritorio();

?>