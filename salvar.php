<?php
include "conexao.php";

$nome_completo = mysqli_real_escape_string($conexao, trim($_POST['nome_completo']));
$data_nascimento = mysqli_real_escape_string($conexao, trim($_POST['data_nascimento']));
$endereco_rua = mysqli_real_escape_string($conexao, trim($_POST['endereco_rua']));
$endereco_numero = mysqli_real_escape_string($conexao, trim($_POST['endereco_numero']));
$endereco_bairro = mysqli_real_escape_string($conexao, trim($_POST['endereco_bairro']));
$endereco_cep = mysqli_real_escape_string($conexao, trim($_POST['endereco_cep']));
$nome_responsavel = mysqli_real_escape_string($conexao, trim($_POST['nome_responsavel']));
$tipoResponsavel = mysqli_real_escape_string($conexao, trim($_POST['tipoResponsavel']));
$curso_escolhido = mysqli_real_escape_string($conexao, trim($_POST['curso_escolhido']));

$sql = "INSERT INTO alunos
        (nome_completo, data_nascimento, endereco_rua, endereco_numero, endereco_bairro, endereco_cep, nome_responsavel, tipo_responsavel, curso_escolhido)
        VALUES 
        ('$nome_completo', '$data_nascimento', '$endereco_rua', '$endereco_numero', '$endereco_bairro', '$endereco_cep', '$nome_responsavel', '$tipoResponsavel', '$curso_escolhido')";

if ($conexao->query($sql) === TRUE) {
    echo "Cadastro realizado com sucesso!";
} else {
    echo "Erro: " . $conexao->error;
}

$conexao->close();
?>