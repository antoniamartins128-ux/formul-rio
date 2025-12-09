<?php
include "conexao.php";

/* ============================
   FUNÇÃO PARA CONVERTER CURSO
================================ */
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


/* ============================
   CONSULTA: LISTA DE ALUNOS
================================ */
$alunos_query = $conexao->query("
    SELECT id_aluno, nome_completo, curso_escolhido, endereco_bairro, nome_responsavel
    FROM alunos 
    ORDER BY id_aluno ASC
");

/* ============================
   EXCLUSÃO
================================ */
if (isset($_GET['acao']) && $_GET['acao'] == 'excluir' && isset($_GET['id'])) {
    $id_excluir = intval($_GET['id']);
    $conexao->query("DELETE FROM alunos WHERE id_aluno = $id_excluir");
    header("Location: alunos.php?status=excluido");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title>Lista de Alunos</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.navbar { background-color: #ffffff !important; border-bottom: 3px solid #003366; }
.nav-link { color: #003366 !important; font-weight: 500; }
.nav-link:hover { color: #008080 !important; }
.btn-logout { background-color: #dc3545; color: white !important; }
.btn-logout:hover { background-color: #c82333; }
.table th { background-color: #003366; color: white; }
.table-striped>tbody>tr:nth-of-type(odd){ background-color: #e9ecef; }
</style>
</head>

<body>

<!-- ============================
     NAVBAR (MESMA DO PAINEL)
============================== -->
<nav class="navbar navbar-expand-lg navbar-light bg-white mb-4 shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="painel.php"> Dashboard Letícia</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="painel.php"> Home</a></li>
        <li class="nav-item"><a class="nav-link active" href="alunos.php"> Alunos</a></li>

      </ul>

      <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link btn btn-sm btn-logout" href="logout.php"> Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4">

<h3 class="mb-4">Lista de Alunos</h3>

<?php if (isset($_GET['status']) && $_GET['status'] == 'excluido'): ?>
    <div class="alert alert-danger">Aluno excluído com sucesso!</div>
<?php endif; ?>

<div class="card p-3 shadow-sm">
<table class="table table-striped table-hover">
<thead>
<tr>
    <th>ID</th>
    <th>Nome Completo</th>
    <th>Curso</th>
    <th>Bairro</th>
    <th>Responsável</th>
    <th>Ações</th>
</tr>
</thead>
<tbody>

<?php while ($aluno = $alunos_query->fetch_assoc()): ?>
<tr>
    <td><?= $aluno['id_aluno'] ?></td>
    <td><?= htmlspecialchars($aluno['nome_completo']) ?></td>
    <td><?= htmlspecialchars(nomeCurso($aluno['curso_escolhido'])) ?></td>
    <td><?= htmlspecialchars($aluno['endereco_bairro']) ?></td>
    <td><?= htmlspecialchars($aluno['nome_responsavel']) ?></td>

    <td>
        <a href="editar_aluno.php?id=<?= $aluno['id_aluno'] ?>" 
           class="btn btn-sm btn-primary">Editar</a>

        <a href="alunos.php?acao=excluir&id=<?= $aluno['id_aluno'] ?>" 
           onclick="return confirm('Excluir aluno <?= $aluno['nome_completo'] ?>?')"
           class="btn btn-sm btn-danger">Excluir</a>
    </td>
</tr>
<?php endwhile; ?>

</tbody>
</table>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
