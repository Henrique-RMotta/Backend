<?php
namespace aula15\Model;

class BebidaDAO {
private $bebidasArray = [];
private $arquivoJson = 'bebidas.json';

public function __construct() {
    if (file_exists($this->arquivoJson)) {
        $conteudoArquivo = file_get_contents($this->arquivoJson);

        $dadosArquivoEmArray = json_decode($conteudoArquivo, true);

        if ($dadosArquivoEmArray) {
            foreach ($dadosArquivoEmArray as $nome => $info) {
                $this->bebidasArray[$nome] = new Bebida(
                    $info['nome'],
                    $info['categoria'],
                    $info['volume'],
                    $info['valor'],
                    $info['qtde']
                );
            }
        }
    }
}

private function salvarArquivo() {
    $dados = [];

    foreach ($this->bebidasArray as $nome => $bebida) {
        $dados[$nome] = [
            'nome'=>$bebida->getNome(),
            'categoria'=>$bebida->getCategoria(),
            'volume'=>$bebida->getVolume(),
            'valor'=>$bebida->getValor(),
            'qtde'=>$bebida->getQtde()
        ];
    }
    file_put_contents($this->arquivoJson,json_encode($dados,JSON_PRETTY_PRINT));
}

// create 
public function criarBebidas(Bebida $bebida) {
    $this-> bebidasArray[$bebida->getNome()] = $bebida;
    $this->salvarArquivo();
}

// read 
public function lerBebidas() {
    return $this-> bebidasArray;
}

// update 
public function atualizarBebidas($nome,$novoValor,$novaQtde,$novoVolume,$novaCategoria) {
    if (isset($this->bebidasArray[$nome])){
        $this->bebidasArray[$nome]->setValor($novoValor);
        $this->bebidasArray[$nome]->setQtde($novaQtde);
        $this->bebidasArray[$nome]->setVolume($novoVolume);
        $this->bebidasArray[$nome]->setCategoria($novaCategoria);
    }
    $this->salvarArquivo();
}
 
// delete
public function excluirBebida($nome) {
    unset($this->bebidasArray[$nome]);
    $this->salvarArquivo();
}
}
?> 