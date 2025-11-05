<?php

namespace Aula15;
// Confirmações de formulário 213
require_once __DIR__ . "\\..\\controller\\BebidaController.php";
$controller = new BebidaController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'] ?? '';
    if($acao === 'criar'){
        $controller->criar(
            $_POST['nome'],
            $_POST['categoria'],
            $_POST['volume'],
            $_POST['valor'],
            $_POST['qtde']
        );
    } elseif ($acao === 'deletar') {
        $controller->deletar($_POST['nome']);
    } elseif ($acao === 'verItens') {
        $controller->ler();
    }
}
?>
<!-- Formulário HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de bebidas</title>
</head>
<body>
    <h1>Formulário para preenchimento de bebidas:</h1>
    <form method="POST">
        <input type="hidden" name="acao" value="criar">
        <input type="text" name="nome" placeholder="Nome da Bebida:" required>
        <select name="categoria" required>
            <option value="">Selecione a Categoria</option>
            <option value="Refrigerante">Refrigerante</option>
            <option value="Cerveja">Cerveja</option>
            <option value="Vinho">Vinho</option>
            <option value="Destilado">Destilado</option>
            <option value="Água">Água</option>
            <option value="Energético">Energético</option>
        </select> 
        <input type="text" name="volume" placeholder="Volume (ex:300ml):" required>
        <input type="number" name="valor" step="0.01" placeholder="Valor em Reais (R$)" required>
        <input type="number" name="qtde" placeholder="Quantidade em Estoque:" required>
        <button type="submit">Cadastrar</button>
    </form>
    <table method="POST">
        <button name="acao" value="VerItens"></button>
        <tr>
            <th>nome</th>
            <th>categoria</th>
            <th>volume</th>
            <th>valor</th>
            <th>qtde</th>
        </tr>
    </table>
</body>
    <script>
        fetch("bebidas.json")
        .then()
    </script>
</html>

