<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Cadastrar Aluno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<section class="h-100">
    <div class="container h-100">
        <div class="row justify-content-sm-center h-100">
            <div class="col-xxl-6 col-xl-6 col-lg-7 col-md-9 col-sm-11">
                
                <div class="card shadow-lg my-5"> 
                    <div class="card-body p-5">
                        
                        <div class="text-center">
                            <img src="https://eeepmanoelmano.com.br/assets/logo-escola-vertical-dark-814d04a6.svg" alt="Logo da EEEP Manoel Mano" style="width: 100px;" class="mb-4">
                        </div>

                        <h1 class="fs-4 card-title fw-bold mb-4 text-center">Cadastrar Aluno</h1>

                        <form action="salvar.php" method="POST" class="needs-validation" novalidate>

                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="nome_completo">Nome completo</label>
                                <input type="text" class="form-control" name="nome_completo" id="nome_completo" placeholder="Digite o nome completo" required>
                                <div class="invalid-feedback">Campo obrigatório</div>
                            </div>

                            
                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="data_nascimento">Data de nascimento</label>
                                <input type="date" class="form-control" name="data_nascimento" id="data_nascimento" required>
                                <div class="invalid-feedback">Campo obrigatório</div>
                            </div>

                            <fieldset class="border p-3 rounded mb-3">
                                <legend class="float-none w-auto fs-6 fw-bold px-2">Endereço</legend>

                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="rua">Rua</label>
                                    <input type="text" class="form-control" name="endereco_rua" id="endereco_rua" placeholder="Ex: Rua das Flores" required>
                                    <div class="invalid-feedback">Campo obrigatório</div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="mb-2 text-muted" for="numeroCasa">Número</label>
                                        <input type="text" class="form-control" name="endereco_numero" id="endereco_numero" placeholder="Ex: 123" required>
                                    </div>
                                    <div class="col-md-8 mb-3">
                                        <label class="mb-2 text-muted" for="bairro">Bairro</label>
                                        <input type="text" class="form-control" name="endereco_bairro" id="endereco_bairro" placeholder="Ex: Centro" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="cep">CEP</label>
                                    <input type="text" class="form-control" name="endereco_cep" id="endereco_cep" placeholder="00000-000" inputmode="numeric" pattern="\d{5}-?\d{3}" required>
                                    <div class="invalid-feedback">Por favor, insira um CEP válido.</div>
                                </div>
                            </fieldset>
                            

                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="nome_responsavel">Nome completo do responsável</label>
                                <input type="text" class="form-control" name="nome_responsavel" id="nome_responsavel" placeholder="Nome do responsável:     " required>
                                <div class="invalid-feedback">Campo obrigatório</div>
                            </div>
                            
                            
                            <div class="mb-3 text-muted">
                                <label class="tipoResponsavel" for="tipoResponsavel">Tipo do responsável</label>
                                <br>
                                <select class="form-select" name="tipoResponsavel" id="tipoResponsavel" required>
                                <option selected disabled value="">Selecione...</option>
                                <option value="1">Pai/Mãe</option>
                                <option value="2">Avô/Avó</option>
                                <option value="3">Tio/Tia</option>
                                <option value="4">Irmão/Irmã</option>
                                <option value="5">Primo/Prima</option>
                                <option value="6">Outro</option>
                                </select>
                            </div> 

                            
                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="curso">Curso</label>
                                <select class="form-select" name="curso_escolhido" id="curso_escolhido" required>
                                    <option selected disabled value="">Selecione...</option>
                                    <option value="ds">Desenvolvimento de Sistemas</option>
                                    <option value="informatica">Informática</option>
                                    <option value="adm">Administração</option>
                                    <option value="enfermagem">Enfermagem</option>
                                </select>
                                <div class="invalid-feedback">Selecione um curso</div>
                            </div>

                            
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <a href="index.php" class="btn btn-outline-secondary">Voltar</a>
                                <button type="submit" class="btn btn-primary">Cadastrar</button>
                            </div>

                        </form>
                    </div>
                </div>

                <div class="text-center mt-5 mb-4 text-muted">
                    Copyright &copy; 2025 — Seu Sistema
                </div>

            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>