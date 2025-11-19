<?php
require_once __DIR__ . "\\..\\controller\\BibliotecaController.php";
$controller = new BibliotecaController();

if($_SERVER['REQUEST_METHOD']=='POST') {
    $acao = $_POST['acao'] ?? '';
    if($acao === 'criar'){
        $controller->criarLivro(
            $_POST['titulo'],
            $_POST['autor'],
            $_POST['genero'],
            $_POST['ano'],
            $_POST['qtde']
        );
    }elseif($acao === 'deletar'){
        $controller->deletar($_POST['titulo']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário da Biblioteca</title>
</head>
<body>
    <h1>Formulário para preenchimento de Livros</h1>
    <form method="POST">
        <input type="hidden" name="acao" value="criar">
        <input type="text" name="titulo" placeholder="Nome do Livro" required>
        <select name="genero">
            <option value=""></option>
            <option value="romance">Romance</option>
            <option value="ficção">Ficção</option>
            <option value="Distopia">Distopia</option>
            <option value="Fantasia">Fantasia</option>
            <option value="Terror">Terror</option>
        </select>
        <input type="number" name="ano" placeholder="Ano (ex:2024)" required>
        <input type="text" name="autor" placeholder="autor" required>
        <input type="number" name="qtde" placeholder="qtde" required>
        <button type="submit">Cadastrar</button>
    </form>

    <?php 
    echo "<table>";
    echo "
    <tr> 
    <th>titulo</th>
    <th>genero</th>
    <th>autor</th>
    <th>qtde</th>
    <th>ano</th>
    <th>Deletar</th>
    <th>Atualizar</th>
    </tr>
    ";
    foreach ($controller->ler() as $livros => $livro) {
        echo "
        <tr>
            <td>{$livro->getTitulo()}</td>
            <td>{$livro->getGenero()}</td>
            <td>{$livro->getAutor()}</td>
            <td>{$livro->getQtde()}</td>
            <td>{$livro->getAno()}</td>
            <td>
             <form method='POST'>
                        <input type='hidden' name='acao' value='deletar'>
                        <input type='hidden' name='titulo' value='{$livro->getTitulo()}'>
                        <button type='submit'>Deletar</button>
            </form>
            </td>
            <td> 
            <a href='editar.php?titulo={$livro->getTitulo()}&genero={$livro->getGenero()}&autor={$livro->getAutor()}&ano=
            {$livro->getAno()}'>editar</a>
            </td>
        </tr>
        ";
    }
        echo "     </table>";
    ?>
</body>
</html>