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
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Pesquisar com PHP e JavaScript campo select</title>
</head>

<body>
    <h1>Pesquisar Produtos</h1>

    <span id="msg"></span>

    <form>
        <label>Pesquisar: </label>
        <?php
        // Criar QUERY pesquisar usuários
        $query_categorias = "SELECT id, nome_categoria 
                    FROM categorias 
                    ORDER BY nome_categoria ASC";
        // Preparar a QUERY
        $resut_categorias = $conn->prepare($query_categorias);
        // Executar a QUERY
        $resut_categorias->execute();
        ?>
        <select name="categoria_id" id="categoria_id" onchange="pesquisar();">
            <option value="">Selecione</option>
            <?php
            // Ler os registros retornado do banco de dados 
            while($row_categoria = $resut_categorias->fetch(PDO::FETCH_ASSOC)){
                // Extrair o array para imprimir através da chave no array
                extract($row_categoria);

                // Imprimir o valor retornado do banco de dados
                echo "<option value='$id'>$nome_categoria</option>";
            }
            ?>
        </select>
    </form><br><br>

    
    <span id="listar-produtos"></span>

    <script src="js/custom.js"></script>

</body>

</html>

