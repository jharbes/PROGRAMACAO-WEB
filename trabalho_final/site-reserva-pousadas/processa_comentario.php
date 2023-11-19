<?php

// Conexão com o banco de dados
include 'includes/banco.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebe os dados do formulário
    $usuarioId = $_POST['usuario_id'] ?? 0;
    $pousadaId = $_POST['pousada_id'] ?? 0;
    $nota = $_POST['nota'] ?? 0;
    $comentario = $_POST['comentario'] ?? '';

    // Prepara e executa a consulta SQL
    $stmt = $banco->prepare("INSERT INTO avaliacao (fk_idusuario, fk_idpousada, nota, comentario) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiis", $usuarioId, $pousadaId, $nota, $comentario);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Comentário adicionado com sucesso!";
    } else {
        echo "Erro ao adicionar comentário: " . $banco->error;
    }
}
?>
