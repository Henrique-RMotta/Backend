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
$dao -> criarAlunos(new Aluno(4,"Aurora","Arquitetura"));
$dao -> criarAlunos(new Aluno(5,"Olivier","CEO"));
$dao -> criarAlunos(new Aluno(6,"Amanda","Luta"));
$dao -> criarAlunos(new Aluno(7,"Geysa","Engenharia"));
$dao -> criarAlunos(new Aluno(8,"Joab","Eletrica"));
$dao -> criarAlunos(new Aluno(9,"Miguel","Streamer"));
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

// EXERCICIOS
// Mudar nome da geysa para clotilde
echo "\nMudar o Nome da Geysa para a Clotilde\n";
$dao ->atualizarAlunos(7,"Clotilde","Engenharia");
foreach($dao -> lerAlunos() as $aluno) {
    echo "{$aluno->getId()} - {$aluno->getNome()} - {$aluno->getCurso()}\n";
}
// Mudar nome do Joab para Joana
echo "\nMudar o Nome do Joab para Joana\n";
$dao -> atualizarAlunos(8 , "Joana", "Eletrica");
foreach ($dao -> lerAlunos() as $aluno) {
    echo "{$aluno->getId()} - {$aluno->getNome()} - {$aluno->getCurso()}\n";
}
// Mudar o curso do miguel 
echo "\nMudar o Curso do Miguel para Designer\n";
$dao -> atualizarAlunos(9 , "Miguel", "Designer");
foreach ($dao->lerAlunos() as $aluno) {
   echo "{$aluno->getId()} - {$aluno->getNome()} - {$aluno->getCurso()}\n";
}
// Mudar curso da Amanda
echo "\nMudar o Curso da Amanda para Logistica\n";
$dao-> atualizarAlunos(6,"Amanda","Logistica");
foreach($dao->lerAlunos() as $aluno) {
     echo "{$aluno->getId()} - {$aluno->getNome()} - {$aluno->getCurso()}\n";
}
// Mudar curso do Olivier 
echo "\nMudar o Curso do Olivier para Elettrica\n";
$dao->atualizarAlunos(5,"Olivier","Eletrica");
foreach ($dao->lerAlunos() as $aluno) {
     echo "{$aluno->getId()} - {$aluno->getNome()} - {$aluno->getCurso()}\n";
}

// Excluindo a Clotilde e a Aurora
echo "\nExcluindo a Clotilde e a Aurora\n";
$dao->excluirAlunos(4);
$dao->excluirAlunos(7);
foreach ($dao->lerAlunos() as $aluno) {
     echo "{$aluno->getId()} - {$aluno->getNome()} - {$aluno->getCurso()}\n";
}

?>