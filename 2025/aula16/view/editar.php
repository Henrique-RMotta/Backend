<?php
$nome=$_GET['nome'];
$qtde =$_GET['qtde'];
$valor = $_GET['valor'];
$categoria = $_GET['categoria'];
$volume = $_GET['volume'];

?>
<form action="atualizar.php" method="POST">
    <h1>Editar</h1>
    <input id="nome" type="hidden" name="nome" value="<?php echo $nome;?>" required>
    <input id="nome" type="text" name="novonome" value="<?php echo $nome;?>" required>
    <select name="categoria" required>
            <option value="">Selecione a Categoria</option>
            <option value="Refrigerante" <?php if($categoria == "Refrigerante") echo 'selected'?>>Refrigerante</option>
            <option value="Cerveja" <?php if($categoria == "Cerveja") echo 'selected'?>>Cerveja</option>
            <option value="Vinho" <?php if($categoria == "Vinho") echo 'selected'?>>Vinho</option>
            <option value="Destilado" <?php if($categoria == "Destilado") echo 'selected'?>>Destilado</option>
            <option value="Água" <?php if($categoria == "Água") echo 'selected'?>>Água</option>
            <option value="Energético" <?php if($categoria == "Energético") echo 'selected'?>>Energético</option>
             </select>
        <input type="number" name="volume" placeholder="Volume (ex:300ml):" value="<?php echo $volume;?>"required>
        <input type="number" name="valor" step="0.01" placeholder="Valor em Reais (R$)" value="<?php echo $valor;?>" required>
        <input type="number" name="qtde" placeholder="Quantidade em Estoque:" value="<?php echo $qtde; ?>"required>
       
    <button type="submit" value="Atualizar">Atualizar</button>

</form>