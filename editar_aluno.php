<?php
include "conexao.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID inválido.");
}

$id_aluno = intval($_GET['id']);

// Buscar dados do aluno
$query = $conexao->query("SELECT * FROM alunos WHERE id_aluno = $id_aluno");

if ($query->num_rows === 0) {
    die("Aluno não encontrado.");
}

$aluno = $query->fetch_assoc();

// Salvar alterações
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome_completo = $conexao->real_escape_string($_POST['nome_completo']);
    $data_nascimento = $_POST['data_nascimento'];
    $endereco_rua = $conexao->real_escape_string($_POST['endereco_rua']);
    $endereco_numero = $conexao->real_escape_string($_POST['endereco_numero']);
    $endereco_bairro = $conexao->real_escape_string($_POST['endereco_bairro']);
    $endereco_cep = $conexao->real_escape_string($_POST['endereco_cep']);
    $nome_responsavel = $conexao->real_escape_string($_POST['nome_responsavel']);
    $tipo_responsavel = $conexao->real_escape_string($_POST['tipo_responsavel']);
    $curso_escolhido = $conexao->real_escape_string($_POST['curso_escolhido']);

    $sql = "
        UPDATE alunos SET
            nome_completo = '$nome_completo',
            data_nascimento = '$data_nascimento',
            endereco_rua = '$endereco_rua',
            endereco_numero = '$endereco_numero',
            endereco_bairro = '$endereco_bairro',
            endereco_cep = '$endereco_cep',
            nome_responsavel = '$nome_responsavel',
            tipo_responsavel = '$tipo_responsavel',
            curso_escolhido = '$curso_escolhido'
        WHERE id_aluno = $id_aluno
    ";

    if ($conexao->query($sql)) {
        header("Location: alunos.php?status=sucesso");
        exit;
    } else {
        $erro = "Erro ao atualizar: " . $conexao->error;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title>Editar Aluno</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

<h3>Editar Aluno: <?= htmlspecialchars($aluno['nome_completo']) ?></h3>

<?php if (isset($erro)): ?>
    <div class="alert alert-danger"><?= $erro ?></div>
<?php endif; ?>

<form method="POST" class="card p-4 shadow-sm">

<h5>Dados Pessoais</h5>
<div class="mb-3">
    <label>Nome Completo</label>
    <input type="text" name="nome_completo" class="form-control" required
           value="<?= htmlspecialchars($aluno['nome_completo']) ?>">
</div>

<div class="mb-3">
    <label>Data de Nascimento</label>
    <input type="date" name="data_nascimento" class="form-control" required
           value="<?= $aluno['data_nascimento'] ?>">
</div>


<h5 class="mt-3">Endereço</h5>
<div class="mb-3">
    <label>Rua</label>
    <input type="text" name="endereco_rua" class="form-control"
           value="<?= htmlspecialchars($aluno['endereco_rua']) ?>">
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <label>Número</label>
        <input type="text" name="endereco_numero" class="form-control"
               value="<?= htmlspecialchars($aluno['endereco_numero']) ?>">
    </div>
    <div class="col-md-8 mb-3">
        <label>Bairro</label>
        <input type="text" name="endereco_bairro" class="form-control"
               value="<?= htmlspecialchars($aluno['endereco_bairro']) ?>">
    </div>
</div>

<div class="mb-3">
    <label>CEP</label>
    <input type="text" name="endereco_cep" class="form-control"
           value="<?= htmlspecialchars($aluno['endereco_cep']) ?>">
</div>


<h5 class="mt-3">Responsável</h5>
<div class="mb-3">
    <label>Nome do Responsável</label>
    <input type="text" name="nome_responsavel" class="form-control"
           value="<?= htmlspecialchars($aluno['nome_responsavel']) ?>">
</div>

<div class="mb-3">
    <label>Tipo do Responsável</label>
    <select name="tipo_responsavel" class="form-select">
        <option <?= ($aluno['tipo_responsavel']=="Pai/Mãe")?'selected':'' ?>>Pai/Mãe</option>
        <option <?= ($aluno['tipo_responsavel']=="Avô/Avó")?'selected':'' ?>>Avô/Avó</option>
        <option <?= ($aluno['tipo_responsavel']=="Tio/Tia")?'selected':'' ?>>Tio/Tia</option>
        <option <?= ($aluno['tipo_responsavel']=="Irmão/Irmã")?'selected':'' ?>>Irmão/Irmã</option>
        <option <?= ($aluno['tipo_responsavel']=="Primo/Prima")?'selected':'' ?>>Primo/Prima</option>
        <option <?= ($aluno['tipo_responsavel']=="Outro")?'selected':'' ?>>Outro</option>
    </select>
</div>


<h5 class="mt-3">Curso</h5>
<div class="mb-3">
    <label>Curso</label>
    <select name="curso_escolhido" class="form-select">
        <option <?= ($aluno['curso_escolhido']=="Desenvolvimento de Sistemas")?'selected':'' ?>>Desenvolvimento de Sistemas</option>
        <option <?= ($aluno['curso_escolhido']=="Informática")?'selected':'' ?>>Informática</option>
        <option <?= ($aluno['curso_escolhido']=="Administração")?'selected':'' ?>>Administração</option>
        <option <?= ($aluno['curso_escolhido']=="Enfermagem")?'selected':'' ?>>Enfermagem</option>
    </select>
</div>

<div class="d-flex justify-content-between mt-4">
    <button type="submit" class="btn btn-success">Salvar Alterações</button>
    <a href="alunos.php" class="btn btn-secondary">Cancelar</a>
</div>

</form>
</div>
</body>
</html>
