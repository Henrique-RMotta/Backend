<?php
class pessoa {
    private $nome;
    private $cpf;
    private $telefone;
    private $idade;
    private $email;
    private $senha;

    public function __construct($nome,$cpf,$telefone,$idade,$email,$senha){
        $this -> setNome($nome);
        $this -> setCpf($cpf);
        $this -> setTelefone($telefone);
        $this -> setIdade($idade);
        $this -> email = $email;
        $this -> senha= $senha;
    }

    public function setNome ($nome){
        $this -> nome = ucwords(strtolower($nome));
    }

    public function getNome() {
        return $this -> nome;
    }

    public function setCpf ($cpf) {
        $this-> cpf = preg_replace('/\D/', '', $cpf);
    }

    //getter 
    public function getCpf(){
        return $this -> cpf;
    }

    public function setTelefone($telefone) {
        $this -> telefone = preg_replace('/\D/', '', $telefone);
    }

    public function getTelefone(){
        return $this -> telefone;
    }

    public function setIdade($idade){
        $this -> idade = abs((int)$idade);
    }
}

$aluno1 = new pessoa(
"HeNrIQUe",
 "123.455.087-67",
 "(19)97149-2008",
 "17",
 "henrique@gmail.com",
 "12983");
echo $aluno1->getNome();
?>