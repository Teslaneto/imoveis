<?php
session_start();
require_once("./conexao/conexao.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(!empty($_POST['tipoImovel']) && !empty($_POST['preco'])){

        $tipoImovel = $_POST['tipoImovel'];
        $bairro  = !empty($_POST['bairros']) ? implode(', ', $_POST['bairros']) : null;
        $quartos = $_POST['quartos'];
        $precoImovel = $_POST['preco'];

        $sql = "INSERT INTO imoveis (tipo, bairro, quartos, preco)
                VALUES (:tipoimovel, :bairro, :quartos, :precoimovel)"
                ;
        $stmt = $conex->prepare($sql);
        $stmt->bindParam(":tipoimovel", $tipoImovel, PDO::PARAM_STR);
        $stmt->bindParam(":bairro",  $bairro, PDO::PARAM_STR);
        $stmt->bindParam(":quartos", $quartos);
        $stmt->bindParam(":precoimovel", $precoImovel);

        if($stmt->execute()){
            $_SESSION['cadastroMsg'] = "Cadastro Bem sucedido!";
            header("Location: ./index.php");
            exit;
        }else{
            $_SESSION['cadastroMsg'] = "Cadastro Falhou!";
            header("Location: ./index.php");
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

    <title>Sistema de Cadastro</title>
</head>
<body>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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
        <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px;">
            <h3 class="text-center mb-4">Cadastro de Imóvel</h3>
            <form method="POST">
                <div class="mb-3">
                    <label for="tipo" class="form-label">Tipo do Imóvel</label>
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
                    <label for="bairro" class="form-label">Bairro</label>
                    <select multiple class="form-select" id="bairros" name="bairros[]">
                        <option value="Centro">Centro</option>
                        <option value="Jardins">Jardins</option>
                        <option value="Vila">Vila</option>
                        <option value="Zona Norte">Zona Norte</option>
                        <option value="Zona Sul">Zona Sul</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="quartos" class="form-label">Número de Quartos</label>
                    <input type="number" class="form-control" id="quartos" name="quartos" min="0" required>
                </div>

                <div class="mb-3">
                    <label for="preco" class="form-label">Preço (R$)</label>
                    <input type="number" step="0.01" class="form-control" id="preco" name="preco" min="0.01" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Cadastrar Imóvel</button>
                </div>

                <?php if (!empty($_SESSION['cadastroMsg'])): ?>
                    <div class="mt-3 text-success text-center">
                        <?= $_SESSION['cadastroMsg'] ?>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <!--BOOTSTRAP-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>  