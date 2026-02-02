<?php
namespace AULA13;

class Aluno {
    private $id; 
    private $nome;
    private $curso; 
    public function __construct($id,$nome,$curso)
    {
        $this->setId($id);
        $this->setNome($nome);
        $this->setCurso($curso);
    }
  
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getNome()
    {
        return $this->nome;
    }
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function getCurso()
    {
        return $this->curso;
    }
    public function setCurso($curso)
    {
        $this->curso = $curso;
    }


}
?>