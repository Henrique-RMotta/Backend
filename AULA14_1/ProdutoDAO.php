<?php
namespace AULA14_1;
    class ProdutoDAO {
        private $produtos = [];
        private $arquivo = "produtos.json";

        public function __construct(){
            if(file_exists($this->arquivo)){
                $conteudo = file_get_contents($this->arquivo);
                $dados = json_decode($conteudo,true);

                if($dados) {
                    foreach ($dados as $codigo => $info) {
                        $this -> produtos[$codigo] = new Produto (
                            $info['codigo'],
                            $info['nome'],
                            $info['preco']
                        );
                    }
                }
            }
        }

        public function salvar() {
            $dados = [];
            foreach ($this->produtos as $codigo => $produto) {
                $dados [$codigo] = [
                    'codigo'=>$produto -> getCodigo(),
                    'nome'=>$produto->getNome(),
                    'preco'=>$produto->getPreco(),
                ];
            }
            file_put_contents($this->arquivo,json_encode($dados,JSON_PRETTY_PRINT));
        }

        public function criarProdutos(Produto $produto){
            $this-> produtos[$produto->getCodigo()] = $produto;
            $this -> salvar();
        }

        public function lerProdutos() {
            return $this->produtos;
        }

        public function atualizarProdutos($codigo,$novoNome,$novoPreco) {
            if (isset($this->produtos[$codigo])){
                $this->produtos[$codigo] ->setNome($novoNome);
                $this->produtos[$codigo] -> setPreco($novoPreco);
            }
            $this->salvar();
        }

        public function deletarProdutos($codigo) {
            unset($this->produtos[$codigo]);
            $this->salvar();
        }
    }
?>