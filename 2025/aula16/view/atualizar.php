<?php
$nome=$_POST['nome'];
$novoNome= $_POST['novonome'];
$qtde =$_POST['qtde'];
$valor = $_POST['valor'];
$categoria = $_POST['categoria'];
$volume = $_POST['volume'];

require_once __DIR__ . "\\..\\controller\\BebidaController.php";

$controller = new BebidaController();
$controller->atualizar($nome,$novoNome,$qtde,$valor,$volume,$categoria);
echo"certo!";
echo "<br><a href='index.php'>voltar</a>"
   
?>