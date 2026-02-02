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
        $controller->deletar($_POST['id']);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Formulário da Biblioteca</title>
</head>
<body>
    <h1>Formulário para preenchimento de Livros</h1>
    <form method="POST" class="form-cadastro">
        <input type="hidden" name="acao" value="criar">
        Titulo:<input type="text" name="titulo" placeholder="Nome do Livro (Ex:O Ceifador)" required>
        Genero:<select name="genero">
            <option value="">Selecione o Genero</option>
            <option value="romance">Romance</option>
            <option value="Distopia">Distopia</option>
            <option value="Fantasia">Fantasia</option>
            <option value="Terror">Terror</option>
        </select>
        Ano:<input type="number" name="ano" placeholder="Ano (Ex:2016)" required>
        Autor:<input type="text" name="autor" placeholder="Autor (Ex:Neal Shusterman
)" required>
        Qtde:<input type="number" name="qtde" placeholder="Qtde (Ex:2)" required>
        <button type="submit">Cadastrar</button>
    </form>
    <h1>Lista De Livros</h1>
    <?php 
    echo "<table>";
    echo "
    <tr> 
    <th>Id</th>
    <th>Titulo</th>
    <th>Genero</th>
    <th>Autor</th>
    <th>Qtde</th>
    <th>Ano</th>
    <th>Deletar</th>
    <th>Atualizar</th>
    </tr>
    ";
    foreach ($controller->ler() as $livros => $livro) {
        echo "
        <tr>
            <td>{$livro->getId()}</td>
            <td>{$livro->getTitulo()}</td>
            <td>{$livro->getGenero()}</td>
            <td>{$livro->getAutor()}</td>
            <td>{$livro->getQtde()}</td>
            <td>{$livro->getAno()}</td>
            <td>
            <form method='POST'>
                        <input type='hidden' name='acao' value='deletar'>
                        <input type='hidden' name='id' value='{$livro->getId()}'>
                        <button type='submit' id='deletar'>Deletar</button>
            </form>
            </td>
            <td> 
            <a href='editar.php?id={$livro->getId()}&titulo={$livro->getTitulo()}&genero={$livro->getGenero()}&autor={$livro->getAutor()}&ano={$livro->getAno()}&qtde={$livro->getQtde()}'>Atualizar</a>
            </td>
        </tr>
        ";
    }
        echo "     </table>";
    ?>
</body>
</html>