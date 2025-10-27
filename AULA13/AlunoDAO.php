<?php
namespace AULA13;

class AlunoDAO{ // classe DAO (Data Access Object) para manipulação das funções CRUD (create,read,update e delete)
    private $alunos = []; // Array $alunos para armazenamento dos objetos a serem manipulados antes de ser enviado ao banco de dados
    
    private $arquivo = "alunos.json"; // Cria o arquivo json para que os dados sejam armazenados 

    // Construtor AlunoDAO --> carrega carrega os dados do arquivo json ao iniciar a aplicação

    public function __construct(){
        if (file_exists($this->arquivo)) {
            // lê o conteudo do arquivo caso ele já exista
            $conteudo = file_get_contents($this->arquivo);// atribui as informações do arquivo existente a variavel $conteudo
            $dados = json_decode($conteudo,true);// converter o json em um array associativo

            if ($dados) { // verifica se o array é nulo ou falso, caso seja válido e contenha conteúdo, ele prossegue para a lógica dentro do if
                foreach ($dados as $id => $info) {// precorre o array $dados relacionando chave e valor
                    $this-> alunos[$id] = new Aluno( // Cria um novo objeto já com as chaves e os valores associados
                        $info['id'],
                        $info['nome'],
                        $info['curso']
                    ); 
                }
            }
        }
    }

    // Método auxiliar -> para salvar o array $alunos no arquivo JSON

    private function salvarEmArquivo() {
        $dados = [];

        // Transforma os objetos em arrays convencionais 
        foreach ($this->alunos as $id => $aluno) {
            $dados [$id] = [
            'id'=> $aluno -> getId(),
            'nome'=>$aluno -> getNome(),
            'curso'=> $aluno -> getCurso(),
            ];
        }

        file_put_contents($this->arquivo,json_encode($dados,JSON_PRETTY_PRINT));
    }

    // CREATE
    public function criarAlunos(Aluno $aluno) { // método para criar um objeto no array alunos -> create
        $this-> alunos[$aluno->getId()] = $aluno;
        $this->salvarEmArquivo();
    }

    // READ
    public function lerAlunos() { // método para ler os dados de um objeto ja criado --> read
        return $this-> alunos; 
    }

    // UPDATE
    public function atualizarAlunos($id,$novoNome,$novoCurso) {
        if (isset($this->alunos[$id])){
            $this->alunos[$id] -> setNome($novoNome);
            $this->alunos[$id] -> setId($id);
            $this->alunos[$id] -> setCurso($novoCurso);
        }
        $this->salvarEmArquivo();
    }

    // DELETE
    public function excluirAlunos($id){// método para excluir um objeto --> delete
        unset($this->alunos[$id]);
        $this->salvarEmArquivo();
    }
}
?>