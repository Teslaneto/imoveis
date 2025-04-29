<?php
session_start();
require_once("./conexao/conexao.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(!empty($_POST['nome']) && !empty($_POST['telefone']) && !empty($_POST['tipoImovel'])){

        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];
        $tipoImovel = $_POST['tipoImovel'];
        $precoMin = $_POST['precoMin'];
        $precoMax = $_POST['precoMax'];
        $quartosMin = $_POST['quartosMin'];
        $bairros = !empty($_POST['bairros']) ? implode(', ', $_POST['bairros']) : null;

        $sql = "INSERT INTO interesses (nome, telefone, tipo_desejado, preco_min, preco_max, quartos_min, bairros)
                VALUES (:nome, :telefone, :tipoimovel, :precomin, :precomax, :quartosmin, :bairros)";
        $stmt = $conex->prepare($sql);
        $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
        $stmt->bindParam(":telefone", $telefone, PDO::PARAM_STR);
        $stmt->bindParam(":tipoimovel", $tipoImovel, PDO::PARAM_STR);
        $stmt->bindParam(":precomin", $precoMin);
        $stmt->bindParam(":precomax", $precoMax);
        $stmt->bindParam(":quartosmin", $quartosMin);
        $stmt->bindParam(":bairros", $bairros, PDO::PARAM_STR);

        if($stmt->execute()){
            $_SESSION['cadastroMsg'] = "Interesse cadastrado com sucesso!";
            // Redireciona para a página de resultados após o cadastro
            $lastId = $conex->lastInsertId();
            header("Location: resultados.php?id_interesse=$lastId");
            exit;
        }else{
            $_SESSION['cadastroMsg'] = "Falha ao cadastrar o interesse.";
            header("Location: ./interesse.php");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--BOOTSTRAP-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Sistema de Cadastro de Interesse</title>
</head>
<body>
    <nav class="bg-dark p-3">
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link text-white" href="./index.php">Cadastro de Imóvel</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="./listar.php">Listar Imóveis</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="./interesse.php">Cadastro de Interesse</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="./resultados.php">Resultado Interesse</a>
            </li>
        </ul>
    </nav>

    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px; margin-top: 300px;">
            <h3 class="text-center mb-4">Cadastro de Interesse de Cliente</h3>
            <form method="POST">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome do cliente" required>
                </div>

                <div class="mb-3">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Digite o telefone" required>
                </div>

                <div class="mb-3">
                    <label for="tipoImovel" class="form-label">Tipo de Imóvel Desejado</label>
                    <select class="form-select" id="tipoImovel" name="tipoImovel" required>
                        <option value="">Selecione</option>
                        <option value="Casa">Casa</option>
                        <option value="Kitnet">Kitnet</option>
                        <option value="Apartamento">Apartamento</option>
                        <option value="Sobrado">Sobrado</option>
                        <option value="Outro">Outro</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="precoMin" class="form-label">Faixa de Preço Mínimo (R$)</label>
                    <input type="number" class="form-control" id="precoMin" name="precoMin" min="0">
                </div>

                <div class="mb-3">
                    <label for="precoMax" class="form-label">Faixa de Preço Máximo (R$)</label>
                    <input type="number" class="form-control" id="precoMax" name="precoMax" min="0">
                </div>

                <div class="mb-3">
                    <label for="quartosMin" class="form-label">Número Mínimo de Quartos</label>
                    <input type="number" class="form-control" id="quartosMin" name="quartosMin" min="0">
                </div>

                <div class="mb-3">
                    <label for="bairros" class="form-label">Bairros Desejados</label>
                    <select multiple class="form-select" id="bairros" name="bairros[]">
                        <option value="Centro">Centro</option>
                        <option value="Jardins">Jardins</option>
                        <option value="Vila">Vila</option>
                        <option value="Zona Norte">Zona Norte</option>
                        <option value="Zona Sul">Zona Sul</option>
                    </select>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Cadastrar Interesse</button>
                </div>

                <?php if (!empty($_SESSION['cadastroMsg'])): ?>
                    <div class="mt-3 text-success text-center">
                        <?= $_SESSION['cadastroMsg'] ?>
                    </div>
                <?php 
                    unset($_SESSION['cadastroMsg']);
                    endif; 
                ?>
            </form>
        </div>
    </div>

    <!--BOOTSTRAP-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
