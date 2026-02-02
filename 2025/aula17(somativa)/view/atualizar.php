<?php
$id = $_POST['id'];
$novotitulo = $_POST['novotitulo'];
$autor = $_POST['autor'];
$genero = $_POST['genero'];
$ano = $_POST['ano'];
$qtde = $_POST['qtde'];

require_once __DIR__ . "\\..\\controller\\BibliotecaController.php";

$controller = new BibliotecaController();

$controller->atualizar($id,$novotitulo,$autor,novoGenero: $genero,novoAno: $ano,novaQtde: $qtde);
echo "Livro Atualizado !";
echo "Voltar para página inicial: <a href='index.php'> voltar </a>";
?>