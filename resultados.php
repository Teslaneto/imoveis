<?php
session_start();
require_once("./conexao/conexao.php");

if (isset($_GET['id_interesse'])) {
    $idInteresse = $_GET['id_interesse'];

    $sqlInteresse = "SELECT * FROM interesses WHERE id = ?";
    $stmtInteresse = $conex->prepare($sqlInteresse);
    $stmtInteresse->bindParam(1, $idInteresse, PDO::PARAM_INT);
    $stmtInteresse->execute();
    $interesse = $stmtInteresse->fetch(PDO::FETCH_ASSOC);

    $tipoImovel = $interesse['tipo_desejado'];
    $precoMin = $interesse['preco_min'];
    $precoMax = $interesse['preco_max'];
    $quartosMin = $interesse['quartos_min'];
    $bairros = explode(', ', $interesse['bairros']);  

    // Consulta os imóveis que atendem aos critérios
    $sqlImoveis = "SELECT * FROM imoveis WHERE tipo = ? 
                   AND quartos >= ? 
                   AND preco BETWEEN ? AND ? 
                   AND bairro IN (" . implode(",", array_fill(0, count($bairros), "?")) . ")";

    $stmtImoveis = $conex->prepare($sqlImoveis);
    $stmtImoveis->bindValue(1, $tipoImovel, PDO::PARAM_STR);
    $stmtImoveis->bindValue(2, $quartosMin, PDO::PARAM_INT);
    $stmtImoveis->bindValue(3, $precoMin, PDO::PARAM_STR);
    $stmtImoveis->bindValue(4, $precoMax, PDO::PARAM_STR);

    foreach ($bairros as $index => $bairro) {
        $stmtImoveis->bindValue($index + 5, $bairro, PDO::PARAM_STR);
    }

    $stmtImoveis->execute();
    $imoveis = $stmtImoveis->fetchAll(PDO::FETCH_ASSOC);
} else {
    echo "Interesse não encontrado.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de Correspondência</title>
    <!-- Adicionando Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
                <a class="nav-link text-white" href="./resultado.php">Resultado Interesse</a>
            </li>
        </ul>
    </nav>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="container bg-white p-4 rounded shadow" style="max-width: 900px; margin-bottom: 300px;">
            <h3 class="text-center mb-4">Imóveis que atendem ao seu interesse</h3>

            <?php if (count($imoveis) > 0): ?>
                <!-- Tabela -->
                <table class="table table-hover text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Tipo de Imóvel</th>
                            <th>Preço</th>
                            <th>Quartos</th>
                            <th>Bairro</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($imoveis as $imovel): ?>
                            <tr>
                                <td><?= htmlspecialchars($imovel['tipo']) ?></td>
                                <td>R$ <?= number_format($imovel['preco'], 2, ',', '.') ?></td>
                                <td><?= $imovel['quartos'] ?></td>
                                <td><?= htmlspecialchars($imovel['bairro']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-center">Nenhum imóvel encontrado que atenda aos critérios.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Adicionando o script do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
