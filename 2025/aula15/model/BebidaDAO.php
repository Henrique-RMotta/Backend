<?php
namespace aula15;

require_once "Bebida.php";
class BebidaDAO {
private $bebidasArray = [];
private $arquivoJson = __DIR__ . '\\bebidas.json';

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
    file_put_contents($this->arquivoJson,json_encode($dados,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
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
public function atualizarBebidas($nome,$novoNome,$novoValor,$novaQtde,$novoVolume,$novaCategoria) {
    if (isset($this->bebidasArray[$nome])){
      // 1. Pega todas as chaves em ordem
        $keys = array_keys($this->bebidasArray);

        // 2. Descobre a posição da chave antiga
        $index = array_search($nome, $keys);

        // 3. Cria o novo objeto
        $novaBebida = new Bebida($novoNome, $novaCategoria, $novoVolume, $novoValor, $novaQtde);

        // 4. Troca a chave mantendo a mesma posição
        $keys[$index] = $novoNome;

        // 5. Atualiza o array mantendo ordem
        $this->bebidasArray = array_combine($keys, $this->bebidasArray);

        // 6. Coloca o objeto atualizado na posição certa
        $this->bebidasArray[$novoNome] = $novaBebida;
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