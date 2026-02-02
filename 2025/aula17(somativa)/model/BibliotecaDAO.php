<?php
require_once 'Biblioteca.php';
require_once 'Connection.php';

class BibliotecaDAO {
    public $conn; 

    public function __construct()
    {
       $this->conn = Connection::getInstance();

       $this->conn->exec("
       CREATE TABLE IF NOT EXISTS Biblioteca (
       id INT AUTO_INCREMENT PRIMARY KEY not null, 
       titulo VARCHAR(200) not null,
       autor VARCHAR(150) not null,
       ano INT not null, 
       genero VARCHAR(100) not null,
       qtde INT not null
       );
       ");

    }

    public function criarBiblioteca(Biblioteca $biblioteca){
        $stmt = $this->conn->prepare(
            "INSERT INTO BIBLIOTECA (titulo, autor, ano, genero, qtde) VALUES (:titulo, :autor,:ano, :genero, :qtde )"
        );
        $stmt->execute([
            ':titulo'=>$biblioteca->getTitulo(),
            ':autor'=>$biblioteca->getAutor(),
            ':ano'=>$biblioteca->getAno(),
            ':genero'=>$biblioteca->getGenero(),
            ':qtde'=>$biblioteca->getQtde()
        ]);

    }

    public function lerBiblioteca () {
        $stmt = $this->conn->query("
        SELECT * FROM biblioteca ORDER BY titulo
        ");
        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $biblioteca = new Biblioteca(
                $row['titulo'],
                $row['autor'],
                $row['ano'],
                $row['genero'],
                $row['qtde']
            );
            $biblioteca->setId($row['id']);
            $result[] = $biblioteca;
        }
        return $result;
    }

    public function atualizarLivro($id,$novoTitulo,$novoAutor,$novoAno,$novoGenero,$novaQtde){
        $stmt = $this->conn->prepare("
        UPDATE biblioteca set titulo = :novoTitulo, autor= :novoAutor, ano= :novoAno, genero= :novoGenero, qtde= :novaQtde WHERE id = :id
        ");
        $stmt->execute([
            ':novoTitulo'=> $novoTitulo, 
            ':novoAutor' => $novoAutor,
            ':novoAno' => $novoAno,
            ':novoGenero' => $novoGenero,
            ':novaQtde' => $novaQtde,
            ':id'=> $id
        ]);
    }

    public function excluirLivro($id) {
        $stmt = $this->conn->prepare(
            "DELETE FROM Biblioteca WHERE id = :id"
        );
        $stmt->execute([':id'=> $id]);
    }

    public function buscarLivro($titulo){
        $stmt = $this->conn->prepare("SELECT * FROM Biblioteca WHERE titulo = :titulo LIMIT 1");

        $stmt->execute([':titulo' => $titulo]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            return new Biblioteca(
                $row['titulo'],
                $row['categoria'],
                $row['ano'],
                $row['genero'],
                $row['qtde'],
            );
        }
        return null;
    }
}
?>