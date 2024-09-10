<?php
include_once('../backend/Conexao.php');


try {
    
    $sql = "SELECT id_categoria, nome FROM categorias";
    $result = $conn->query($sql);

    $categorias = array();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $categorias[] = array(
                'id_categoria' => $row['id_categoria'],  
                'nome' => $row['nome'] 
            );
        }
    }

   
    echo json_encode($categorias);
} catch (Exception $e) {
    
    echo json_encode(array('error' => 'Erro ao buscar categorias ' . $e->getMessage()));
} finally {
  
    $conn->close();
}

?>
