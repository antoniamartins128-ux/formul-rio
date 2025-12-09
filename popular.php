<?php
$message = "";

// Quando clicar no botão, executa o código de popular
if (isset($_GET['pop'])) {

    include "conexao.php";

    // Define o fuso horário para evitar erros de data
    date_default_timezone_set('America/Sao_Paulo');

    // --- Listas de dados aleatórios ---
    $primeiros_nomes = ['Ana', 'Bruno', 'Carla', 'Daniel', 'Eduarda', 'Fábio', 'Gabriela', 'Hugo', 'Isabela', 'João', 'Larissa', 'Marcos', 'Natália', 'Otávio', 'Patrícia', 'Rafael', 'Sofia', 'Tiago', 'Vitória', 'William'];
    $sobrenomes = ['Silva', 'Santos', 'Oliveira', 'Souza', 'Rodrigues', 'Ferreira', 'Alves', 'Pereira', 'Lima', 'Gomes', 'Costa', 'Ribeiro', 'Martins', 'Carvalho', 'Almeida'];
    $ruas = ['Rua das Flores', 'Avenida Principal', 'Rua da Matriz', 'Travessa das Acácias', 'Rua dos Pinheiros', 'Avenida Brasil', 'Rua do Comércio'];
    $bairros = ['Centro', 'Vila Nova', 'Jardim das Rosas', 'Bairro Alto', 'Santa Fé', 'Parque Industrial', 'Boa Vista'];
    $cursos = ['Desenvolvimento de Sistemas', 'Informática', 'Administração', 'Enfermagem'];

    // --- Loop para inserir 100 alunos ---
    for ($i = 1; $i <= 100; $i++) {
        
        // Gera dados aleatórios
        $nome_aleatorio = $primeiros_nomes[array_rand($primeiros_nomes)] . " " . $sobrenomes[array_rand($sobrenomes)];
        $resp_aleatorio = $primeiros_nomes[array_rand($primeiros_nomes)] . " " . $sobrenomes[array_rand($sobrenomes)];
        
        // Gera uma data de nascimento aleatória
        $timestamp_aleatorio = mt_rand(strtotime("2004-01-01"), strtotime("2010-12-31"));
        $data_nasc = date("Y-m-d", $timestamp_aleatorio);

        $rua = $ruas[array_rand($ruas)];
        $numero = rand(10, 1500);
        $bairro = $bairros[array_rand($bairros)];
        $cep = rand(10000, 99999) . "-" . rand(100, 999);
        $tipo_resp = rand(1, 6);
        $curso_escolhido = $cursos[array_rand($cursos)];

        // Escapa os valores
        $nome_completo_safe       = mysqli_real_escape_string($conexao, $nome_aleatorio);
        $data_nascimento_safe     = mysqli_real_escape_string($conexao, $data_nasc);
        $endereco_rua_safe        = mysqli_real_escape_string($conexao, $rua);
        $endereco_numero_safe     = mysqli_real_escape_string($conexao, $numero);
        $endereco_bairro_safe     = mysqli_real_escape_string($conexao, $bairro);
        $endereco_cep_safe        = mysqli_real_escape_string($conexao, $cep);
        $nome_responsavel_safe    = mysqli_real_escape_string($conexao, $resp_aleatorio);
        $tipoResponsavel_safe     = mysqli_real_escape_string($conexao, $tipo_resp);
        $curso_escolhido_safe     = mysqli_real_escape_string($conexao, $curso_escolhido);

        // SQL corrigido
        $sql = "INSERT INTO alunos
                (nome_completo, data_nascimento, endereco_rua, endereco_numero, endereco_bairro, endereco_cep, nome_responsavel, tipo_responsavel, curso_escolhido)
                VALUES 
                ('$nome_completo_safe', '$data_nascimento_safe', '$endereco_rua_safe', '$endereco_numero_safe', '$endereco_bairro_safe', '$endereco_cep_safe', '$nome_responsavel_safe', '$tipoResponsavel_safe', '$curso_escolhido_safe')";

        $conexao->query($sql);
    }

    $message = "🎉 <b>100 alunos populados com sucesso!</b>";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popular Banco</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<section class="h-100">
    <div class="container h-100">
        <div class="row justify-content-sm-center h-100">
            <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">

                <div class="text-center my-5"></div>

                <div class="card shadow-lg">
                    <div class="card-body p-5 text-center">

                        <h1 class="fs-4 card-title fw-bold mb-4">Popular Tabela de Alunos</h1>
                        <p class="text-muted">Clique abaixo para inserir <b>100 alunos aleatórios</b> no banco.</p>

                        <a href="popular.php?pop=1" class="btn btn-primary btn-lg w-100">
                            Popular Banco (100 alunos)
                        </a>

                        <?php if ($message != ""): ?>
                        <div class="alert alert-success mt-3">
                            <?= $message ?>
                        </div>
                        <?php endif; ?>

                    </div>
                </div>

                <div class="text-center mt-3 text-muted">
                    © 2025 — Manoel
                </div>

            </div>
        </div>
    </div>
</section>
</body>
</html>
