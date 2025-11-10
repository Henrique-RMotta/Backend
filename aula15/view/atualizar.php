<?php

namespace Aula15;
$nome=$_POST['nome'];
$qtde =$_POST['qtde'];
$valor = $_POST['valor'];
$categoria = $_POST['categoria'];
$volume = $_POST['volume'];

require_once __DIR__ . "\\..\\controller\\BebidaController.php";

$controller = new BebidaController();
$controller->atualizar($nome,$qtde,$valor,$volume,$categoria);
echo"certo!";
echo "<br><a href='index.php'>voltar</a>"
   
?>