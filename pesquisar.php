<?php

/*
|--------------------------------------------------------------------------
| Rede de Atendimento
|--------------------------------------------------------------------------|
| author Gianlucca Augusto <gianlucca.augusto@extreme.digital>
| version 1.0
| copyright Proderj 2023.
*/

// Incluir a conexão com o banco de dados
include_once 'conexao.php';

// Receber os dados do JavaScript
$categoria_id = filter_input(INPUT_GET, 'categoria_id', FILTER_SANITIZE_NUMBER_INT);

// Acessa o IF quando o campo categoria_id possui valor
if (!empty($categoria_id)) {

    // Criar QUERY pesquisar produtos
    $query_produtos = "SELECT prod.id, prod.nome_produto,
                cat.nome_categoria
                FROM produtos AS prod
                INNER JOIN categorias AS cat ON cat.id=prod.categoria_id
                WHERE prod.categoria_id=:categoria_id";

    // Preparar a QUERY
    $result_produtos = $conn->prepare($query_produtos);

    // Substitui o link pelo valor que vem do formulário
    $result_produtos->bindParam(':categoria_id', $categoria_id);

    // Executar a QUERY
    $result_produtos->execute();

    // Recebe os dados dos produtos
    $listar_produtos = "";

    // Acessa o IF quando retornar produtos no banco de dados
    if (($result_produtos) and ($result_produtos->rowCount() != 0)) {
        // Ler os registros retornado do banco de dados 
        while ($row_produto = $result_produtos->fetch(PDO::FETCH_ASSOC)) {
            // Extrair o array para imprimir através da chave no array
            extract($row_produto);

            // Imprimir o valor retornado do banco de dados
            $listar_produtos .= "ID: $id <br>";
            $listar_produtos .= "Nome: $nome_produto <br>";
            $listar_produtos .= "Categoria: $nome_categoria <br>";
            $listar_produtos .= "<hr>";
        }
        // Criar o array de informações que será retornado para o JavaScript
        $retorna = ['status' => true, 'dados' => $listar_produtos];
    } else {
        // Criar o array de informações que será retornado para o JavaScript
        $retorna = ['status' => false, 'msg' => "<p style='color: #f00;'>Erro: Nenhum produtos encontrado!</p>"];
    }
} else {
    // Criar o array de informações que será retornado para o JavaScript
    $retorna = ['status' => false, 'msg' => "<p style='color: #f00;'>Erro: Nenhum produtos encontrado!</p>"];
}



// Converter o array em objeto e retornar para o JavaScript
echo json_encode($retorna);
