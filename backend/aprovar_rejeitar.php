<?php
session_start();
include_once('../backend/Conexao.php');

$idAtualizacao = $_POST['id_atualizacao'];
$acao = $_POST['acao'];

// Buscar a atualização pendente
$sql = "SELECT * FROM atualizacoes_pendentes WHERE id_atualizacoes_pendentes = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idAtualizacao);
$stmt->execute();
$result = $stmt->get_result();
$atualizacao = $result->fetch_assoc();

if ($acao === 'aprovar') {
    // Atualizar os dados do trabalhador na tabela 'trabalhador'
    // $sqlAtualizarTrabalhador = "UPDATE trabalhador 
    //                             SET nome = ?, email = ?, senha = ?, contato = ?, data_nasc = ?, descricao = ?, id_area = ?, id_categoria = ?, 
    //                                 foto_perfil = ?, foto_trabalho1 = ?, foto_trabalho2 = ?, foto_trabalho3 = ?, foto_banner = ?
    //                             WHERE id_trabalhador = ?";
    $sqlAtualizarTrabalhador = "UPDATE trabalhador SET nome = ?, email = ?, contato = ?, data_nasc = ?, descricao = ?, id_area = ?, id_categoria = ?";
    
    // Parâmetros a serem usados
    $parametros = [$atualizacao['nome'], $atualizacao['email'], $atualizacao['contato'], $atualizacao['data_nasc'], $atualizacao['descricao'], $atualizacao['id_area'], $atualizacao['id_categoria']];
    
    // Verifica e adiciona os campos opcionais de imagens
    if (!empty($atualizacao['foto_perfil'])) {
        $sqlAtualizarTrabalhador .= ", foto_perfil = ?";
        $parametros[] = $atualizacao['foto_perfil'];
    }
    if (!empty($atualizacao['foto_trabalho1'])) {
        $sqlAtualizarTrabalhador .= ", foto_trabalho1 = ?";
        $parametros[] = $atualizacao['foto_trabalho1'];
    }
    if (!empty($atualizacao['foto_trabalho2'])) {
        $sqlAtualizarTrabalhador .= ", foto_trabalho2 = ?";
        $parametros[] = $atualizacao['foto_trabalho2'];
    }
    if (!empty($atualizacao['foto_trabalho3'])) {
        $sqlAtualizarTrabalhador .= ", foto_trabalho3 = ?";
        $parametros[] = $atualizacao['foto_trabalho3'];
    }
    if (!empty($atualizacao['foto_banner'])) {
        $sqlAtualizarTrabalhador .= ", foto_banner = ?";
        $parametros[] = $atualizacao['foto_banner'];
    }
    
    // Finaliza a query com o WHERE
    $sqlAtualizarTrabalhador .= " WHERE id_trabalhador = ?";
    $parametros[] = $atualizacao['id_trabalhador'];
    
    // Preparar a declaração
    $stmtAtualizar = $conn->prepare($sqlAtualizarTrabalhador);
    
    // Definir os tipos de parâmetros dinamicamente
    $tipos = str_repeat('s', count($parametros) - 1) . 'i';
    $stmtAtualizar->bind_param($tipos, ...$parametros);
    // $stmtAtualizar = $conn->prepare($sqlAtualizarTrabalhador);
    // $stmtAtualizar->bind_param("sssssssssssssi", 
    //     $atualizacao['nome'], $atualizacao['email'], $atualizacao['senha'], $atualizacao['contato'], 
    //     $atualizacao['data_nasc'], $atualizacao['descricao'], 
    //     $atualizacao['id_area'], $atualizacao['id_categoria'], 
    //     $atualizacao['foto_perfil'], $atualizacao['foto_trabalho1'], $atualizacao['foto_trabalho2'], 
    //     $atualizacao['foto_trabalho3'], $atualizacao['foto_banner'], $atualizacao['id_trabalhador']);
    
    if ($stmtAtualizar->execute()) {
        // Remover a atualização pendente após aprovação
        $sqlRemover = "DELETE FROM atualizacoes_pendentes WHERE id_atualizacoes_pendentes = ?";
        $stmtRemover = $conn->prepare($sqlRemover);
        $stmtRemover->bind_param("i", $idAtualizacao);
        $stmtRemover->execute();
        $_SESSION['mensagem'] = "Atualização aprovada e aplicada com sucesso!";
    } else {
        $_SESSION['mensagem'] = "Erro ao aplicar a atualização.";
    }
} elseif ($acao === 'rejeitar') {
    // Remover a atualização pendente se for rejeitada
    $sqlRemover = "DELETE FROM atualizacoes_pendentes WHERE id_atualizacoes_pendentes = ?";
    $stmtRemover = $conn->prepare($sqlRemover);
    $stmtRemover->bind_param("i", $idAtualizacao);
    
    if ($stmtRemover->execute()) {
        $_SESSION['mensagem'] = "Atualização rejeitada com sucesso!";
    } else {
        $_SESSION['mensagem'] = "Erro ao rejeitar a atualização.";
    }
}
echo $_SESSION['mensagem'] ;
$conn->close();

// Redireciona de volta para a página de administração
header('Location: ../html/Solicitacoes.php');
?>
