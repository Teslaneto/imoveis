<?php
session_start();
require_once("./conexao/conexao.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Verificando se o ID é um número inteiro válido
    if (filter_var($id, FILTER_VALIDATE_INT)) {
        $sql = "DELETE FROM imoveis WHERE id = :id";
        $stmt = $conex->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $_SESSION['delete'] = "Imóvel Deletado com Sucesso!";
            header("Location: ./listar.php"); 
            exit; 
        } else {
            $_SESSION['delete'] = "Erro: ao deletar o Imóvel!";
            header("Location: ./listar.php");
            exit; 
        }
    } else {
        $_SESSION['delete'] = "ID inválido!";
        header("Location: ./listar.php"); 
        exit;
    }
}
?>
