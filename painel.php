<?php
include "conexao.php";

date_default_timezone_set('America/Sao_Paulo');

/* ============================
   FUNÇÕES PARA CONVERTER IDS
============================ */

function nomeCurso($valor) {

    // Se já vier como texto, apenas retorna
    if (!is_numeric($valor)) {
        return $valor;
    }

    // Se vier como número, converte
    $lista = [
        1 => "Desenvolvimento de Sistemas",
        2 => "Informática",
        3 => "Administração",
        4 => "Enfermagem"
    ];

    return $lista[$valor] ?? "Não informado";
}


function nomeResponsavelTipo($id) {
    $lista = [
        1 => "Pai/Mãe",
        2 => "Avô/Avó",
        3 => "Tio/Tia",
        4 => "Irmão/Irmã",
        5 => "Primo/Prima",
        6 => "Outro"
    ];
    return $lista[$id] ?? "Não informado";
}

/* ============================
    CONSULTAS PRINCIPAIS
============================ */

// 1) Total de alunos
$total_alunos = $conexao->query("SELECT COUNT(*) AS total_alunos FROM alunos")->fetch_assoc()['total_alunos'];

// 2) Quantidade de alunos por curso
$alunos_por_curso = $conexao->query("SELECT curso_escolhido, COUNT(*) AS total FROM alunos GROUP BY curso_escolhido");

// 3) Média de idade
$media_idade = $conexao->query("SELECT AVG(TIMESTAMPDIFF(YEAR, data_nascimento, CURDATE())) AS media_idade FROM alunos")->fetch_assoc()['media_idade'];

// 4) Alunos por tipo de responsável
$alunos_por_responsavel = $conexao->query("SELECT tipo_responsavel, COUNT(*) AS total FROM alunos GROUP BY tipo_responsavel");

// 5) Bairro com mais alunos
$bairro_mais_alunos = $conexao->query("SELECT endereco_bairro, COUNT(*) AS total FROM alunos GROUP BY endereco_bairro ORDER BY total DESC LIMIT 1")->fetch_assoc();
$bairro_top = $bairro_mais_alunos['endereco_bairro'];
$bairro_total = $bairro_mais_alunos['total'];

// 6) Alunos mais velhos (top 5)
$mais_velhos = $conexao->query("SELECT nome_completo, data_nascimento FROM alunos ORDER BY data_nascimento ASC LIMIT 5");

// 7) Alunos mais novos (top 5)
$mais_novos = $conexao->query("SELECT nome_completo, data_nascimento FROM alunos ORDER BY data_nascimento DESC LIMIT 5");

// 8) Alunos por bairro
$alunos_por_bairro = $conexao->query("SELECT endereco_bairro, COUNT(*) AS total FROM alunos GROUP BY endereco_bairro ORDER BY total DESC");

// 9) CEP com mais alunos
$alunos_por_cep = $conexao->query("SELECT endereco_cep, COUNT(*) AS total FROM alunos GROUP BY endereco_cep ORDER BY total DESC LIMIT 5");

// 10) Responsáveis com mais de 1 aluno
$responsaveis_mais = $conexao->query("SELECT nome_responsavel, COUNT(*) AS total FROM alunos GROUP BY nome_responsavel HAVING total > 1 ORDER BY total DESC LIMIT 5");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dashboard de Alunos - Elegante</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
:root {
    --cor-principal: #007bff;
    --cor-secundaria: #6c757d;
    --cor-destaque-primaria: #003366; 
    --cor-destaque-secundaria: #008080; 
    --cor-fundo-suave: #f8f9fa;
    --cor-sombra: 0 4px 15px rgba(0,0,0,0.05);
}

body { background-color: var(--cor-fundo-suave); }
.card { border-radius: 12px; box-shadow: var(--cor-sombra); border: none; }
.card-title { font-weight: 600; color: var(--cor-destaque-primaria); opacity: 0.8; }

.navbar { background-color: #ffffff !important; border-bottom: 3px solid var(--cor-destaque-primaria); }
.nav-link { color: var(--cor-destaque-primaria) !important; font-weight: 500; }
.nav-link:hover { color: var(--cor-destaque-secundaria) !important; }
.btn-logout { background-color: #dc3545; color: white !important; }
.btn-logout:hover { background-color: #c82333; }

.table th { background-color: var(--cor-destaque-primaria); color: white; }
.table-striped>tbody>tr:nth-of-type(odd){ background-color: #e9ecef; }

.text-primary-mod { color: var(--cor-destaque-secundaria) !important; }
.text-success-mod { color: #28a745 !important; }
.text-warning-mod { color: #ffc107 !important; }
</style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white mb-4 shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="painel.php"> Dashboard Letícia</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link active" href="painel.php"> Home</a></li>
        <li class="nav-item"><a class="nav-link" href="alunos.php"> Alunos</a></li>
      </ul>

      <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link btn btn-sm btn-logout" href="logout.php"> Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">

  <!-- CARDS -->
  <div class="row g-4 mb-4">
      <div class="col-md-3">
          <div class="card p-3 bg-white text-center">
              <h5 class="card-title">Total de Alunos</h5>
              <p class="fs-3 fw-bold text-primary-mod"><?= $total_alunos ?></p>
          </div>
      </div>

      <div class="col-md-3">
          <div class="card p-3 bg-white text-center">
              <h5 class="card-title">Média de Idade</h5>
              <p class="fs-3 fw-bold text-success-mod"><?= round($media_idade,1) ?> anos</p>
          </div>
      </div>

      <div class="col-md-3">
          <div class="card p-3 bg-white text-center">
              <h5 class="card-title">Bairro Top</h5>
              <p class="fs-5 fw-bold text-warning-mod"><?= $bairro_top ?> (<?= $bairro_total ?>)</p>
          </div>
      </div>

      <div class="col-md-3">
          <div class="card p-3 bg-white">
              <h5 class="card-title text-center">Tipos de Responsável</h5>
              <?php while($row = $alunos_por_responsavel->fetch_assoc()): ?>
                  <p class="fw-bold">
                      <?= nomeResponsavelTipo($row['tipo_responsavel']) ?>:
                      <span class="text-primary-mod"><?= $row['total'] ?></span>
                  </p>
              <?php endwhile; ?>
          </div>
      </div>
  </div>

  <!-- GRAFICOS -->
  <div class="row g-4 mb-4">
      <div class="col-md-6">
          <div class="card p-3 shadow-sm">
              <h5 class="text-center mb-3">Gráfico Alunos por Curso</h5>
              <canvas id="graficoCurso"></canvas>
          </div>
      </div>

      <div class="col-md-6">
          <div class="card p-3 shadow-sm">
              <h5 class="text-center mb-3">Gráfico Alunos por Bairro</h5>
              <canvas id="graficoBairro"></canvas>
          </div>
      </div>
  </div>

  <!-- LISTAGENS -->
  <div class="row g-4 mb-4">
      <div class="col-md-6">
          <div class="card p-3 shadow-sm">
              <h5 class="text-center mb-3">Alunos Mais Velhos </h5>
              <table class="table table-striped table-hover">
                  <thead><tr><th>Nome</th><th>Data</th></tr></thead>
                  <tbody>
                      <?php while($row = $mais_velhos->fetch_assoc()): ?>
                          <tr>
                              <td><?= $row['nome_completo'] ?></td>
                              <td><?= $row['data_nascimento'] ?></td>
                          </tr>
                      <?php endwhile; ?>
                  </tbody>
              </table>
          </div>
      </div>

      <div class="col-md-6">
          <div class="card p-3 shadow-sm">
              <h5 class="text-center mb-3">Alunos Mais Novos </h5>
              <table class="table table-striped table-hover">
                  <thead><tr><th>Nome</th><th>Data</th></tr></thead>
                  <tbody>
                      <?php while($row = $mais_novos->fetch_assoc()): ?>
                          <tr>
                              <td><?= $row['nome_completo'] ?></td>
                              <td><?= $row['data_nascimento'] ?></td>
                          </tr>
                      <?php endwhile; ?>
                  </tbody>
              </table>
          </div>
      </div>
  </div>

  <!-- CEPs e Responsáveis -->
  <div class="row g-4 mb-5">
      <div class="col-md-6">
          <div class="card p-3 shadow-sm">
              <h5 class="text-center mb-3">Top CEPs </h5>
              <table class="table table-striped table-hover">
                  <thead><tr><th>CEP</th><th>Total</th></tr></thead>
                  <tbody>
                      <?php while($row = $alunos_por_cep->fetch_assoc()): ?>
                          <tr>
                              <td><?= $row['endereco_cep'] ?></td>
                              <td><?= $row['total'] ?></td>
                          </tr>
                      <?php endwhile; ?>
                  </tbody>
              </table>
          </div>
      </div>

      <div class="col-md-6">
          <div class="card p-3 shadow-sm">
              <h5 class="text-center mb-3">Responsáveis com + de 1 aluno</h5>
              <table class="table table-striped table-hover">
                  <thead><tr><th>Nome</th><th>Total</th></tr></thead>
                  <tbody>
                      <?php while($row = $responsaveis_mais->fetch_assoc()): ?>
                          <tr>
                              <td><?= $row['nome_responsavel'] ?></td>
                              <td><?= $row['total'] ?></td>
                          </tr>
                      <?php endwhile; ?>
                  </tbody>
              </table>
          </div>
      </div>
  </div>

</div>

<!-- =======================
     CHART JS
========================== -->

<script>
const colors = ['#003366','#008080','#4682b4','#708090','#3cb371','#4b0082','#ffa500'];

// GRAFICO CURSO
const ctxCurso = document.getElementById('graficoCurso').getContext('2d');
const graficoCurso = new Chart(ctxCurso, {
    type: 'doughnut',
    data: {
        labels: [
            <?php 
                $labels = [];
                $alunos_por_curso->data_seek(0);
                while($row = $alunos_por_curso->fetch_assoc()){
                    $labels[] = "'" . nomeCurso($row['curso_escolhido']) . "'";
                }
                echo implode(",", $labels);
            ?>
        ],
        datasets: [{
            data: [
                <?php
                    $data = [];
                    $alunos_por_curso->data_seek(0);
                    while($row = $alunos_por_curso->fetch_assoc()){
                        $data[] = $row['total'];
                    }
                    echo implode(",", $data);
                ?>
            ],
            backgroundColor: colors
        }]
    },
    options: { plugins: { legend: { position: 'bottom' } } }
});

// GRAFICO BAIRRO
const ctxBairro = document.getElementById('graficoBairro').getContext('2d');
const graficoBairro = new Chart(ctxBairro, {
    type: 'bar',
    data: {
        labels: [
            <?php 
                $labels = [];
                $alunos_por_bairro->data_seek(0);
                while($row = $alunos_por_bairro->fetch_assoc()){
                    $labels[] = "'".$row['endereco_bairro']."'";
                }
                echo implode(",", $labels);
            ?>
        ],
        datasets: [{
            data: [
                <?php
                    $data = [];
                    $alunos_por_bairro->data_seek(0);
                    while($row = $alunos_por_bairro->fetch_assoc()){
                        $data[] = $row['total'];
                    }
                    echo implode(",", $data);
                ?>
            ],
            backgroundColor: '#003366'
        }]
    },
    options: { scales: { y: { beginAtZero: true } } }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
