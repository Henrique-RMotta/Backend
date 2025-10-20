<?php
namespace AULA13;
require_once "CRUD.php";
require_once "AlunoDAO.php";

$dao = new AlunoDAO(); // objeto da classe aluno dao para testar métodos crud

//create 
$aluno1 = new Aluno(1,"motta","eletro");
$aluno2 = new Aluno(2, "Victor Hugo", "manicure");
$aluno3 = new Aluno(3,"Beatriz","Eletricista");
$dao -> criarAlunos($aluno1);
$dao -> criarAlunos($aluno2);
$dao -> criarAlunos($aluno3);
// READ 

echo "\nListagem Inicial: \n";
foreach ($dao-> lerAlunos() as $aluno) {
    echo "{$aluno->getId()} - {$aluno->getNome()} - {$aluno->getCurso()}\n";
}

// UPDATE


echo "\nApós atualização:\n";
$dao -> atualizarAlunos("1", "morsa" ,"tec em mec"); 
foreach ($dao-> lerAlunos() as $aluno) {
    echo "{$aluno->getId()} - {$aluno->getNome()} - {$aluno->getCurso()}\n";
}

// delete
echo "\nApós a exclusão\n";
$dao -> excluirAlunos("3"); // excluindo objeto $aluno3 --> id 3
foreach ($dao-> lerAlunos() as $aluno) {
    echo "{$aluno->getId()} - {$aluno->getNome()} - {$aluno->getCurso()}\n";
}

?>