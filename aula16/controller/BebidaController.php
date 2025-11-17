<?php 

require_once __DIR__ . '\\..\\model\\BebidaDAO.php';
require_once __DIR__ . '\\..\\model\\Bebida.php';

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
        $this->dao->criarBebida($bebida);
    }

    // Atualizar bebida existente 
    public function atualizar($nome,$novoNome,$valor,$qtde,$volume,$categoria) {
        $this->dao->atualizarBebida($nome,$novoNome,$valor,$qtde,$volume,$categoria);
    }

    // exclui bebida 
    public function deletar($nome) {
        $this->dao->excluirBebida($nome);
    }

}
?>