<?php
namespace AULA13;
class AlunoDAO{ // classe DAO (Data Access Object) para manipulação das funções CRUD (create,read,update e delete)
    private $alunos = []; // Array $alunos para armazenamento dos objetos a serem manipulados antes de ser enviado ao banco de dados
    
    public function criarAlunos(Aluno $aluno) { // método para criar um objeto no array alunos -> create
        $this-> alunos[$aluno->getId()] = $aluno;
    }

    public function lerAlunos() { // método para ler os dados de um objeto ja criado --> read
        return $this-> alunos; 
    }

    public function atualizarAlunos($id,$novoNome,$novoCurso) {
        if (isset($this->alunos[$id])){
            $this->alunos[$id] -> setNome($novoNome);
            $this->alunos[$id] -> setId($id);
            $this->alunos[$id] -> setCurso($novoCurso);
        }

    }

    public function excluirAlunos($id){// método para excluir um objeto --> delete
        unset($this->alunos[$id]);
    }
}
?>