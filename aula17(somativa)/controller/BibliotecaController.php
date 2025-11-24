<?php
require_once __DIR__ . '\\..\\model\\BibliotecaDAO.php';
require_once __DIR__ . '\\..\\model\\Biblioteca.php';

class BibliotecaController{ 
    private $dao; 

    public function __construct()
    {
        $this->dao = new BibliotecaDAO();
    }

    public function ler() {
        return $this->dao->lerBiblioteca();
    }

    public function criarLivro($titulo,$autor,$genero,$ano,$qtde){
        $biblioteca = new Biblioteca($titulo,$autor,$ano,$genero,$qtde);
        $this->dao->criarBiblioteca($biblioteca);
    }

    public function atualizar($id,$novoTitulo,$novoAutor,$novoAno,$novoGenero,$novaQtde) {
        $this->dao->atualizarLivro($id,$novoTitulo,$novoAutor,novoAno: $novoAno,novoGenero: $novoGenero,novaQtde: $novaQtde);
    }

    public function deletar($id) {
        $this->dao->excluirLivro($id);
    }
}

?>