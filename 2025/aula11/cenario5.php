<?php
namespace AULA11\Exercicios;

/*
class Biblioteca {
public $livro;
public $revista;

public function Emprestimos(){
}
}

class Usuarios {
public function fazerEmprestimo (){
}
}
*/

class SistemaDeBiblioteca {
    public static function registrarEmprestimo(){ 
        echo "O empréstimo foi registrado";
    }

    public static function registrarDevolucao() {
        echo "A devolução foi registrada";
    }
}
SistemaDeBiblioteca::registrarEmprestimo();
class Usuario{
    public String $aluno; 
    public String $Professor; 

    public function setAluno($aluno) {
        $this -> aluno = ucwords(strtolower($aluno));
    }
    public function setProfessor($Professor) {
        $this -> Professor = ucwords(strtolower($Professor));
    }
    public function __construct($aluno,$Professor){
        $this -> setAluno($aluno);
        $this-> setProfessor($Professor);
    }
    public function getAluno() {
        return $this-> aluno;
    }

    public function getProfessor(){
        return $this -> Professor;
    }
    public function solicitarEmprestimo(){
    $msg = ($this->getAluno()) != "" ? "O emrpréstimo do(a) Aluno: {$this->aluno} foi solicitado" : "O emrpréstimo do(a) Professor: {$this->Professor} foi solicitado" ; 
    echo $msg;
    }
    public function devolverItem() {
        echo "O item foi devolvido";
    }
}
$aluno = new usuario("","aaaaa");
$aluno -> solicitarEmprestimo();

class itemBibliotecario {
    public $livro; 
    public $revista;
    public function emprestar() {
        echo "o livro ou revista foi emprestado";
    }

    public function devolver() {
        echo "O livro ou revista foi devolvido ";
    }
}

class Emprestimo { 
    public static function finalizar(){
        echo "O empréstimo foi finalizado";
    }
}

?>