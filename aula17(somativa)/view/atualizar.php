<?php
$titulo = $_POST['titulo'];
$novotitulo = $_POST['novotitulo'];
$autor = $_POST['autor'];
$genero = $_POST['genero'];
$ano = $_POST['ano'];
$qtde = $_POST['qtde'];

require_once __DIR__ . "\\..\\controller\\BibliotecaController.php";

$controller = new BibliotecaController();

$controller->atualizar($titulo,$novotitulo,$autor,$genero,$ano,$qtde);
?>