<?php
session_start();
require_once("./conexao/conexao.php");


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $tipoImovel = $_POST['tipoImovel'];
    $bairro  = $_POST['bairro'];
    $quartos = $_POST['quartos'];
    $precoImovel = $_POST['preco'];
    $idimovel = $_POST['id'];

    $sql = "UPDATE imoveis SET tipo = :tipo, bairro = :bairro, quartos = :quartos, preco = :preco WHERE id = :id";
    $stmt = $conex->prepare($sql);
    $stmt->bindParam(':tipo',  $tipoImovel, PDO::PARAM_STR);
    $stmt->bindParam(':bairro', $bairro, PDO::PARAM_STR);
    $stmt->bindParam(':quartos', $quartos);
    $stmt->bindParam(':preco', $precoImovel);
    $stmt->bindParam(':id', $idimovel, PDO::PARAM_INT);

    if($stmt->execute()){
        $_SESSION['updateMsg'] = 'A edição foi concluida com Exito!';
        header('Location: ./listar.php');
        exit;
    }else{
        $_SESSION['updateMsg'] = 'A edição de Usuario Falhou!';
        header('Location: ./listar.php');
        exit;
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">


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
        <div class="container bg-white p-4 rounded shadow" >
            <h3 class="text-center mb-4">Listar de Imóveis</h3>

            <?php
            $sql = "SELECT * FROM imoveis";
            $stmt = $conex->prepare($sql);
            $stmt->execute();
            $listarImoveis = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <!-- Tabela -->
            <table class="table table-hover text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Bairro</th>
                        <th>Quartos</th>
                        <th>Preço</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($listarImoveis as $imoveis): ?>
                    <tr>
                        <td><?= $imoveis['id'] ?></td>
                        <td><?= htmlspecialchars($imoveis['tipo']) ?></td>
                        <td><?= htmlspecialchars($imoveis['bairro']) ?></td>
                        <td><?= htmlspecialchars($imoveis['quartos']) ?></td>
                        <td><?= $imoveis['preco'] ?></td>
                        <td>
                            <!-- Botão que ativa o modal específico -->
                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal<?= $imoveis['id'] ?>">
                                <i class="bi bi-pencil-square"></i>
                            </button>

                            <a href="excluir.php?id=<?= $imoveis['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza que deseja excluir?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>

                    <!-- Modal de edição (um para cada usuário) -->
                    <div class="modal fade" id="modal<?= $imoveis['id'] ?>" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <form method="POST" action="">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Editar: <?= htmlspecialchars($imoveis['nome']) ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id" value="<?= $imoveis['id'] ?>">

                                    <div class="mb-3">
                                        <label for="tipo" class="form-label">Tipo do Imóvel</label>
                                        <select class="form-select" id="tipoImovel" name="tipoImovel" required>
                                            <option value="">Selecione</option>
                                            <option value="Casa" <?= $imoveis['tipo'] == 'Casa' ? 'selected' : '' ?>>Casa</option>
                                            <option value="Kitnet" <?= $imoveis['tipo'] == 'Kitnet' ? 'selected' : '' ?>>Kitnet</option>
                                            <option value="Apartamento" <?= $imoveis['tipo'] == 'Apartamento' ? 'selected' : '' ?>>Apartamento</option>
                                            <option value="Sobrado" <?= $imoveis['tipo'] == 'Sobrado' ? 'selected' : '' ?>>Sobrado</option>
                                            <option value="Outro" <?= $imoveis['tipo'] == 'Outro' ? 'selected' : '' ?>>Outro</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                    <label for="bairro" class="form-label">Bairro</label>
                                    <select class="form-select" id="bairro" name="bairro" required>
                                        <option value="">Selecione</option>
                                        <option value="Centro" <?= $imoveis['bairro'] == 'Centro' ? 'selected' : '' ?>>Centro</option>
                                        <option value="Zona Norte" <?= $imoveis['bairro'] == 'Zona Norte' ? 'selected' : '' ?>>Zona Norte</option>
                                        <option value="Zona Sul" <?= $imoveis['bairro'] == 'Zona Sul' ? 'selected' : '' ?>>Zona Sul</option>
                                        <option value="Leste" <?= $imoveis['bairro'] == 'Leste' ? 'selected' : '' ?>>Leste</option>
                                        <option value="Oeste" <?= $imoveis['bairro'] == 'Oeste' ? 'selected' : '' ?>>Oeste</option>
                                        <option value="Outro" <?= $imoveis['bairro'] == 'Outro' ? 'selected' : '' ?>>Outro</option>
                                    </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Quartos</label>
                                        <input type="text" name="quartos" class="form-control" value="<?= htmlspecialchars($imoveis['quartos']) ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Preço</label>
                                        <input type="text" name="preco" class="form-control" value="<?= htmlspecialchars($imoveis['preco']) ?>" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>
                <?php endforeach; ?>
                </tbody>
            <!--LOGICA DE AVISOS-->
            <?php if(!empty($_SESSION['updateMsg']) || !empty($_SESSION['delete'])):?>

                    <div class="mt-3 text-success text-center">
                        <?= $_SESSION['updateMsg'] ?>
                    </div>
            </table>
                    <div class="mt-3 text-success text-center">
                        <?= $_SESSION['delete'] ?>
                    </div>

            <?php 
                unset($_SESSION['updateMsg']);//ELE REMOVE A CHAVE 'updateMsg' 
                unset($_SESSION['delete']);   //da sessão assim quando a pagina carrega novamente a messagem não é mais exibida
                endif;
            ?>

        </div>
    </div>

    <!--BOOTSTRAP-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>  