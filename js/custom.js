/*
|--------------------------------------------------------------------------
| Rede de Atendimento
|--------------------------------------------------------------------------|
| author Gianlucca Augusto <gianlucca.augusto@extreme.digital>
| version 1.0
| copyright Proderj 2023.
*/

async function pesquisar() {
    // Recuperar o id da categoria
    var categoria_id = document.getElementById("categoria_id").value;
    //console.log(categoria_id);

    // Fazer a requisição para o arquivo pesquisar.php
    var dados = await fetch("pesquisar.php?categoria_id=" + categoria_id);

    // Ler os dados retornado do arquivo pesquisar.php
    var resposta = await dados.json();
    //console.log(resposta);

    // Acessa o IF quando não retornar nenhum produtos do banco de dados
    if(!resposta['status']){
        // Enviar a mensagem de erro do JavaScript para o HTML
        document.getElementById('msg').innerHTML = resposta['msg'];
    }else{
        // Substituir a mensagem de erro
        document.getElementById('msg').innerHTML = "";
        
        // Enviar a lista de produtos do JavaScript para o HTML
        document.getElementById("listar-produtos").innerHTML = resposta['dados'];
    }

}