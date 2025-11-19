<?php 
$titulo = $_GET['titulo'];
$autor = $_GET['autor'];
$genero = $_GET['genero'];
$ano = $_GET['ano'];
$qtde = $_GET['qtde'];
?>

<form action="atualizar.php" method="POST" >
        <input type="hidden" name="titulo" value=<?php echo $titulo ?>>
        <input type="text" name="novotitulo" placeholder="Nome do Livro"
        value="<?php echo $titulo?>" required >
        <select name="genero">
            <option value=""></option>
            <option value="romance">Romance</option>
            <option value="ficção">Ficção</option>
            <option value="Distopia">Distopia</option>
            <option value="Fantasia">Fantasia</option>
            <option value="Terror">Terror</option>
        </select>
        <input type="number" name="ano" placeholder="Ano (ex:2024)" value="<?php echo $ano?>" required>
        <input type="text" name="autor" placeholder="autor" value="<?php echo $autor?>" required>
        <input type="number" name="qtde" value="<?php echo $qtde?>"placeholder="qtde" required>
        <button type="submit">editar</button>
    </form>