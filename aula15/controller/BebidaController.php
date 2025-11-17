<?php 
namespace Aula15;

<<<<<<< HEAD
use aula15\Model\Bebida;
use aula15\Model\BebidaDAO;



require_once __DIR__ . '\\..\\model\\BebidaDAO.php';
require_once __DIR__ . '\\..\\model\\Bebida.php';
=======
require_once __DIR__ . '\\..\\model\\BebidaDAO.php';
require_once  __DIR__ . '\\..\\model\\Bebida.php';
>>>>>>> c2ced602e67b6f404078c704e02187f61a890643

class BebidaController{
    private $dao; 

    // Contrutor: cria o objeto DAO (responsável por salvar/carregar)
    public function __construct(){
        $this->dao = new BebidaDAO();
    }

    // Lista todas as Bebidas
    public function ler() {
        return $this->dao->lerBebidas();
    }

    // Cadastra nova bebida 
    public function criar($nome,$categoria,$volume,$valor,$qtde) {
        // // gera ID automaticamente com base no timestamp (exemplo simples) 
        // $id = time(); // Função caso o objeto tenha umatributo id 
        $bebida = new Bebida($nome,$categoria,$volume,$valor,$qtde);
        $this->dao->criarBebidas($bebida);
    }

    // Atualizar bebida existente 
    public function atualizar($nome,$valor,$qtde,$volume,$categoria) {
<<<<<<< HEAD
        $this->dao->atualizarBebidas($nome,$valor,$qtde,$volume,$categoria);
=======
        $this->dao->atualizarBebidas($nome,$valor,$qtde,$volume, $categoria);
>>>>>>> c2ced602e67b6f404078c704e02187f61a890643
    }

    // exclui bebida 
    public function deletar($nome) {
        $this->dao->excluirBebida($nome);
    }

}
?>