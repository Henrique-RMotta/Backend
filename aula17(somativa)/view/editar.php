<?php 
$id =$_GET['id'];
$titulo = $_GET['titulo'];
$autor = $_GET['autor'];
$genero = $_GET['genero'];
$ano = $_GET['ano'];
$qtde = $_GET['qtde'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Formulário da Biblioteca</title>
</head>
<form action="atualizar.php" method="POST" class="form-cadastro">
    <h1>Atualizar</h1>
        <input type="hidden" name="id" value=<?php echo $id ?>>
        Titulo:<input type="text" name="novotitulo" placeholder="Nome do Livro"
        value="<?php echo $titulo?>" required >
        Genero:<select name="genero">
            <option value="">Selecione o Genero</option>
            <option value="romance" <?php if($genero == "romance") echo "selected"?>>Romance</option>
            <option value="Distopia" <?php if($genero == "Distopia") echo "selected"?>>Distopia</option>
            <option value="Fantasia" <?php if($genero == "Fantasia") echo "selected"?>>Fantasia</option>
            <option value="Terror" <?php if($genero == "Terror") echo "selected"?>>Terror</option>
        </select>
        Ano:<input type="number" name="ano" placeholder="Ano (ex:2024)" value="<?php echo $ano?>" required>
        Autor:<input type="text" name="autor" placeholder="autor" value="<?php echo $autor?>" required>
        Qtde:<input type="number" name="qtde" value="<?php echo $qtde?>"placeholder="qtde" required>
        <button type="submit">editar</button>
    </form>
    </body>
</html>