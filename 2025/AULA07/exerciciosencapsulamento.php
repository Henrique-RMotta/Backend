<?php
class carro {
    private $marca;
    private $modelo;

    function __construct($marca,$modelo){
        $this -> marca = $marca;
        $this -> modelo = $modelo;
    }
    public function setMarca ($marca) {
        $this -> marca = ucwords(strtolower($marca));
    }
    public function getMarca () {
        return $this -> marca;
    }

    public function setModelo ($modelo) {
        $this -> modelo = ucwords(strtolower($modelo));
    }
    public function getModelo () {
        return $this -> modelo;
    }
}

$carro = new carro("Honda","Civic");

echo $carro -> getMarca();
echo $carro -> getModelo();

class pessoa {
    private $nome; 
    private $idade;
    private $email;

    function __construct($nome,$idade,$email){
        $this -> setNome($nome);
        $this -> setIdade($idade);
        $this -> setEmail($email);
    }

    public function setNome ($nome){
        $this -> nome = ucwords(strtolower($nome));
    }

    public function getNome() {
        return $this -> nome;
    }
    public function setIdade($idade){
        $this -> idade = abs((int)$idade);
    }
    public function getIdade() {
        return $this -> idade;
    }
    public function setEmail($email) {
        $this -> email = preg_replace('/\d/', '', $email);
    }

    public function getEmail() {
        return $this -> email;
    }
    public function exibir(){
        $nome = $this->nome;
        $idade = $this->idade;
        $email = $this->email;

        echo "\nNome: $nome\nIdade: $idade\nEmail: $email\n";
    }

}

$pess1 = new pessoa("Samuel","22","samuel@exemplo.com");
$pess1 -> exibir();

class aluno {
    private $nome;
    private $nota;

    function __construct($nome,$nota){
        $this -> setNome($nome);
        $this -> setNota($nota);
    }

    public function setNome($nome){
        $this -> nome = ucwords(strtolower($nome));
    }

    public function setNota($nota) {
        $this -> nota = abs((int) $nota);

    }

    public function getNome() {
        return $this -> nome; 
    }

    public function getNota() {
            return $this -> nota; 
    }

    public function exibir() {
        $nome = $this->nome;
        $nota = $this -> nota;
        if ($nota > 10) {
            $nota = 'nota inválida';
        }
        echo "\nNome:$nome\nNota:$nota\n";
    }
}

    $aluno1 = new aluno("motta","10");
    $aluno1 -> exibir();

    class produto {
        private $nome; 
        private $preco;
        private $estoque;

        public function __construct($nome,$preco,$estoque){
            $this -> setNome($nome);
            $this -> setPreco($preco);
            $this -> setEstoque($estoque);
        }

        public function setNome($nome){
            $this -> nome = ucwords(strtolower($nome));
        }

        public function setPreco($preco){
            $this -> preco = abs((float)$preco);
        }

        public function setEstoque($estoque){
            $this -> estoque = abs((int)$estoque);
        }

        public function getNome() {
            return $this -> nome; 
        }

        public function getPreco(){
            return $this ->preco;
        }

        public function getEstoque() {
            return $this -> estoque;
        }

        public function exibir() {
            $nome = $this->nome;
            $preco = $this -> preco;
            $estoque = $this -> estoque;

            echo "\nNome:$nome\nPreco:$preco\nEstoque:$estoque\n";
        }
    }
    $produto = new produto("Abacate",5,20);
    $produto -> exibir();

    class funcionario {
        private $nome;
        private $salario; 

        public function __construct($nome,$salario){
            $this -> setNome($nome);
            $this -> setSalario($salario);
        }
        public function setNome ($nome) {
            $this -> nome = ucwords(strtolower($nome));
        }

        public function setSalario($salario) {
            $this -> salario = abs((float) $salario);
        }

        public function getNome() {
            return $this -> nome;
        }
        public function getSalario() {
            return $this -> salario;
        }
        public function exibirDados() {
            $nome = $this -> nome;
            $salario = $this -> salario;
            echo "\nNome:$nome\nSalario:$salario\n";
        }
    }
    $funcionario = new funcionario("Motta", 1000);
    $funcionario -> exibirDados();  
?>