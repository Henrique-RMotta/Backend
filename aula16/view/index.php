<?php

// Confirmações de formulário 213
require_once __DIR__ . "\\..\\controller\\BebidaController.php";
$controller = new BebidaController();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'] ?? '';
    if ($acao === 'criar') {
        $controller->criar(
            $_POST['nome'],
            $_POST['categoria'],
            $_POST['volume'],
            $_POST['valor'],
            $_POST['qtde']
        );
    } elseif ($acao === 'deletar') {
        $controller->deletar($_POST['nome']);
    }
}
?>
<!-- Formulário HTML -->
<!DOCTYPE html>
<html lang="pt-br">
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
    <?php
    echo "     <table>";
    echo "
                <tr>
                    <th>nome</th>
                    <th>categoria</th>
                    <th>volume</th>
                    <th>valor</th>
                    <th>qtde</th>
                    <th>Deletar</th>
                    <th>Atualizar</th>
                </tr>
    ";
    foreach ($controller->ler() as $bebidas => $bebida) {
        //$nomeEsc = htmlspecialchars($bebida->getNome(), ENT_QUOTES, 'UTF-8');
        /* $params = http_build_query([
        'nome' => $bebida->getNome(),
        'categoria' => $bebida->getCategoria(),
        'volume' => $bebida->getVolume(),
        'valor' => $bebida->getValor(),
        'qtde' => $bebida->getQtde()
    ]);*/
        echo "
                <tr>
                    <td>{$bebida->getNome()}</td>
                    <td>{$bebida->getCategoria()}</td>
                    <td>{$bebida->getVolume()}</td>
                    <td>{$bebida->getValor()}</td>
                    <td>{$bebida->getQtde()}</td>
                    <td>
                        <form method='POST'>
                        <input type='hidden' name='acao' value='deletar'>
                        <input type='hidden' name='nome' value='{$bebida->getNome()}'>
                        <button type='submit'>Deletar</button>
                        </form>
                    <td>
                        <a href='editar.php?nome={$bebida->getNome()}&categoria={$bebida->getCategoria()}&volume={$bebida->getVolume()}&valor={$bebida->getValor()}&qtde={$bebida->getQtde()}'>editar</a>
                    <td>
                </tr>
    ";
    }
    echo "     </table>";

    /*
    
    */
    ?>

    
</body>
<script>
    /*async function loadBebidas() {
        try {
            const response = await fetch("bebidas.json");
            const data = await response.json();
            // verificar se a data é um array
            const bebidas = Array.isArray(data) ? data : Object.values(data);
            const tabela = document.querySelector(".tabela");
            console.log(bebidas)
            bebidas.forEach(bebida => {
                const linha = document.createElement("tr");
                linha.innerHTML = `
                    <td>${bebida.nome}</td>
                    <td>${bebida.categoria}</td>
                    <td>${bebida.volume}</td>
                    <td>${bebida.valor}</td>
                    <td>${bebida.qtde}</td>
                `;
                tabela.appendChild(linha);
            });
        } catch (error) {
            console.error("Error no carregamento das bebidas:", error);
        }
       
    }
    loadBebidas();
    */
</script>

</html>