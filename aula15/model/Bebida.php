<?php 
namespace aula15;
class Bebida {
    private $nome; 
    private $categoria; 
    private $volume; 
    private $valor; 
    private $qtde; 

    public function __construct($nome,$categoria,$volume,$valor,$qtde) {
        $this-> setNome($nome); 
        $this-> setCategoria($categoria); 
        $this-> setVolume($volume); 
        $this-> setValor($valor); 
        $this-> setQtde($qtde); 
    }

    public function getNome()
    {
        return $this->nome;
    }
    public function setNome($nome)
    {
        $this->nome = $nome;

    }
    public function getCategoria()
    {
        return $this->categoria;
    }
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }

    public function getVolume()
    {
        return $this->volume;
    }

    public function setVolume($volume)
    {
        $this->volume = $volume;
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    public function getQtde()
    {
        return $this->qtde;
    }

    public function setQtde($qtde)
    {
        $this->qtde = $qtde;
    }
}
?>