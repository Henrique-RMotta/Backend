<?php
class Biblioteca {
    private $id; 
    private $Titulo; 
    private  $Autor; 
    private $Ano; 
    private $Genero; 
    private $qtde; 

    public function __construct($Titulo,$Autor,$Ano,$Genero,$qtde) {
        $this->setTtitulo($Titulo);
        $this->setAno($Ano);
        $this->setGenero($Genero);
        $this->setQtde($qtde);
        $this->setAutor($Autor);


    }
    public function getTitulo()
    {
        return $this->Titulo;
    }
    public function setTtitulo($Titulo)
    {
        $this->Titulo = $Titulo;
    }
    public function getAutor()
    {
        return $this->Autor;
    }
    public function setAutor($Autor)
    {
        $this->Autor = $Autor;
    }

    public function getAno()
    {
        return $this->Ano;
    }
    public function setAno($Ano)
    {
        $this->Ano = $Ano;
    }

    public function getGenero()
    {
        return $this->Genero;
    }
    public function setGenero($Genero)
    {
        $this->Genero = $Genero;
    }

    public function getQtde()
    {
        return $this->qtde;
    }
    public function setQtde($qtde)
    {
        $this->qtde = $qtde;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
}

?>