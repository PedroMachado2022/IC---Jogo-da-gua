<?php
session_start();

//Incluir a conexao com BD
include_once("connect.php");

$log_file = dirname(__FILE__) . "/debug_log.txt";

//Receber os dados do formulário
$arquivo_tmp = $_FILES['arquivo']['tmp_name'];

$linhas = file($arquivo_tmp);

// Concatena todas as linhas para formar uma única string
$dados_completos = implode('', $linhas);

// Divide a string em três partes com base no caractere '|'
$partes = explode('|', $dados_completos);

// Pegamos as três partes do arquivo (nome, jogos e jogadas), para tratar individualmente
$nome = trim($partes[0]);
$jogos = trim($partes[1]);
$jogadas = trim($partes[2]);


// Nome do arquivo para cada parte
$arquivo_nome = "nome.txt";
$arquivo_jogos = "jogos.txt";
$arquivo_jogadas = "jogadas.txt";

// Salvar cada parte em um arquivo separado
file_put_contents($arquivo_nome, $nome);
file_put_contents($arquivo_jogos, $jogos);
file_put_contents($arquivo_jogadas, $jogadas)


// // Divide os jogos
// $array_jogos = explode(';', $jogos);

// // Divide as jogadas
// $array_jogadas = explode(';', $jogadas);

// // Função para retirar os acentos do nome para evitar erros.
// function tirarAcentos($string){
//     return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/"
//     ,"/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
// }

// // Nome sem acentos
// $nome_sem_acentos = tirarAcentos($nome);

// $verifica_id_user = "SELECT id FROM users WHERE name = '$nome_sem_acentos'"; 
// $verifica_user_ok = mysqli_query($conn, $verifica_id_user);

// //$_SESSION['id'] = $verifica_id_user_ok;

// // Verifica se o usuário já existe no banco de dados
// if (mysqli_num_rows($verifica_user_ok) == 0) { 
    
//     // Caso não exista, cria ele no banco de dados com uma senha padrão.
//     $insere_tabela_users = "INSERT INTO users (name, password, created, modified ) VALUES ('$nome_sem_acentos', MD5('123456'), NOW(), NOW())";
//     $insere_tabela_users_ok = mysqli_query($conn, $insere_tabela_users);   
   

//     // Salva o ID do usuário na sessão
//     $id_usuario = mysqli_insert_id($conn);
//     $_SESSION['id'] = $id_usuario; 

//     //$arquivo_id = "id_usuario.txt";
//     // Escreve o ID do usuário no arquivo
//     //file_put_contents($arquivo_id, $id_usuario);
   
// } 
// // Caso o usuário exista, não faz nada na tabela "users";
// else if (mysqli_num_rows($verifica_user_ok) == 1) {
    
//     $row = mysqli_fetch_assoc($verifica_user_ok);
//     $id_usuario = $row['id'];

//     // Salva o ID do usuário na sessão
//     $_SESSION['id'] = $id_usuario;

//     // Escreve o ID do usuário no arquivo
//     // $arquivo_id = "id_usuario.txt";
//     // file_put_contents($arquivo_id, $id_usuario);
// }




// // Percorre por todos os jogos enviados no arquivo
// foreach ($array_jogos as $jogo) {
    
//     // Dividimos cada elemento dentro de cada jogo com ","
//     $dados_jogo = explode(',', $jogo);


//     $query_inserir_jogo = "INSERT INTO jogos (user_id, jogo_id, dificuldade, finalizado, pontos, problemas, abertos, mascote, created, modified ) 
//                            VALUES ('".$_SESSION['id']."', '".$dados_jogo[0]."', '".$dados_jogo[1]."', '".$dados_jogo[2]."', '".$dados_jogo[3]."', '".$dados_jogo[4]."', '".$dados_jogo[5]."', '".$dados_jogo[6]."', '".$dados_jogo[7]."', '".$dados_jogo[8]."')";
//     mysqli_query($conn, $query_inserir_jogo);
// }


// foreach ($array_jogadas as $jogada) {
    
//     // Dividimos cada elemento dentro de cada jogada com ","
//     $dados_jogada = explode(',', $jogada);

//     // Corrigindo o acesso aos elementos do array $dados_jogada e construção da query
//     $query_inserir_jogada = "INSERT INTO jogadas (jogo_id, user_id, fase, pontos, vida, objeto_id, objeto, acao, intencao, created, modified ) 
//                              VALUES ('".$dados_jogada[0]."', '".$_SESSION['id']."', '".$dados_jogada[1]."', '".$dados_jogada[2]."', '".$dados_jogada[3]."', 0, '".$dados_jogada[4]."', '".$dados_jogada[5]."', '".$dados_jogada[6]."', '".$dados_jogada[7]."', '".$dados_jogada[8]."')";
//     mysqli_query($conn, $query_inserir_jogada);
// }





// // 
// file_put_contents('array_jogos.txt', implode(PHP_EOL, $array_jogos));
// file_put_contents('array_jogadas.txt', implode(PHP_EOL, $array_jogadas));


// // Exemplo de iteração sobre $array_jogos
// foreach ($array_jogos as $jogo) {
    
// }

// // Exemplo de iteração sobre $array_jogadas
// foreach ($array_jogadas as $jogada) {
//     // Processar cada jogada conforme necessário
// }















































// // Obtém o caminho absoluto do diretório atual
// $diretorio_atual = getcwd();

// //Define o destino como o diretório atual mais o nome original do arquivo enviado
// $destino = $diretorio_atual . '/' . $_FILES['arquivo']['name'];

// // Move o arquivo temporário para o destino
// if (move_uploaded_file($arquivo_tmp, $destino)) {
//     echo 'Arquivo salvo com sucesso em ' . $destino;
// } else {
//     echo 'Erro ao salvar o arquivo';
// }

// //ler todo o arquivo para um array
// $dados = file($arquivo_tmp);

// // $arquivo_saida = 'dados.txt';

// // // Escrever os dados no arquivo de saída
// // file_put_contents($arquivo_saida, $dados);


// //Ler os dados do array
// foreach($dados as $linha){
//     //Retirar os espaços em branco no inicio e no final da string
//     $linha = trim($linha);
   
    
//     //Armazena um array com index 3, dividindo nome, jogos e jogadas
//     $valor = explode('|', $linha);
    
     
//     // Conta o número de index do array (conta a quantidade de barras no arquivo)
//     $conta = substr_count($linha, '|'); 
    
//     // $arquivo_saida = 'dados.txt';
//     // file_put_contents($arquivo_saida, $conta);
    
//     // Percorre pela de barras (array de nome, jogos, jogadas)
//     for($i=0; $i<$conta; $i++){ 
        
//         // Conta o número de ; em cada index do primeiro array
//         $conta2 = substr_count($valor[$i], ';');

//         for($j=0; $j<=$conta2; $j++){
//             $valor2 = explode(';', $valor[$i]);
//             $campos = explode(',', $valor2[$j]);
            
//             // Pega o primeiro elemento do arquivo (nome)
//             if($i == 0 && $j == 0){ 
            	
//             	function tirarAcentos($string){
//                     return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
//                 }
                
//                 // Remove os acentos do nome para evitar possíveis erros
//                 $campos[0] = tirarAcentos($campos[0]);
                
                
//                 // $arquivo_saida = 'dados.txt';
//                 // file_put_contents($arquivo_saida, $campos);
                
            

//                 // Verificação para saber o usuário existe no banco de dados
//                 $verifica_user = "SELECT * FROM users WHERE name = '$campos[0]'"; 
//                 $verifica_user_ok = mysqli_query($conn, $verifica_user);
                
//                 // Caso não exista (seja um novo usuário), insere ele no banco com uma senha padrão
//                 if (mysqli_num_rows($verifica_user_ok) == 0) { 
    
//                     $insere_tabela_users = "INSERT INTO users (name, password, created, modified ) VALUES ('$campos[0]', MD5('123456'), NOW(), NOW())";
//                     $insere_tabela_users_ok = mysqli_query($conn, $insere_tabela_users);    

//                 }

//                 // Caso o usuário exista, não faz nada na tabela "users";
//                 if (mysqli_num_rows($verifica_user_ok) == 1) {
//                 }

                
//                 // Faz uma consulta no banco de dados para pegar o ID do usuário, para relacionar ele com as outras tabelas.
//                 $verifica_id_user = "SELECT id FROM users WHERE name = '$campos[0]'";
//                 $verifica_id_user_ok = mysqli_query($conn, $verifica_id_user);
//                 // Armazena o id do usuário atual
//                 $row = mysqli_fetch_array($verifica_id_user_ok, MYSQLI_NUM);
            
//                 // Armazena o id do usuário para ser utilizado em outro momento no código
//                 $_SESSION['id'] = $row;

//                 $valores_campos = "$row[0], '".$campos[1]."', '".$campos[2]."', '".$campos[3]."', '".$campos[4]."', '".$campos[5]."', '".$campos[6]."', '".$campos[7]."', '".$campos[8]."'";

//                 // Salvar os valores dos campos em um arquivo de texto
//                 $arquivo_valores = 'valores_campos.txt';
//                 file_put_contents($arquivo_valores, $valores_campos);

//                 $insere_tabela_jogos = "INSERT INTO jogos (user_id, dificuldade, finalizado, pontos, problemas, abertos, mascote, created, modified ) VALUES ('$row', '".$campos[1]."', '".$campos[2]."', '".$campos[3]."', '".$campos[4]."', '".$campos[5]."', '".$campos[6]."', '".$campos[7]."', '".$campos[8]."')";
//                 $insere_tabela_jogos_ok = mysqli_query($conn, $insere_tabela_jogos);

//                 $verifica_id_jogo = "SELECT * FROM jogos WHERE id = (select max(id) from jogos)";
//                 $verifica_id_jogo_ok = mysqli_query($conn, $verifica_id_jogo);
//                 $row2 = mysqli_fetch_array($verifica_id_jogo_ok, MYSQLI_NUM);


//                 $campos2 = explode(',', $valor2[1]); 
//                 $conta_virgulas = substr_count($valor2[1], ',');

//                 $resultado_conta_virgulas_temp = $conta_virgulas/10; //divide o numero total de registros do txt pelo numero da campos da tabela jogadas, afim de saber o numero de inserts na tabela
//                 $resultado_conta_virgulas = round($resultado_conta_virgulas_temp);

//                 //echo $resultado_conta . '<br>';

//                 for($y = 0; $y < $resultado_conta_virgulas; $y++ ){

//                     if($y==0){ //primeira vez, insere normal
//                         $cont = 0;
//                     }
//                     if($y>0){ //a partir da segunda vez...
//                         $cont = $cont + 10; //contador de 10 em 10 para inserir os campos do vetor corretamente
//                     }

//                     $insere_tabela_jogadas = "INSERT INTO jogadas (jogo_id, fase, pontos, vida, objeto_id, objeto, acao, intencao, created, modified ) VALUES ('".$row2[0]."', '".$campos2[1+$cont]."', '".$campos2[2+$cont]."', '".$campos2[3+$cont]."', '".$campos2[4+$cont]."', '".$campos2[5+$cont]."', '".$campos2[6+$cont]."', '".$campos2[7+$cont]."', '".$campos2[8+$cont]."', '".$campos2[9+$cont]."' )";
//                     $insere_tabela_jogodas_ok = mysqli_query($conn, $insere_tabela_jogadas); 

//                 }

//                 //AQUII INSERE DADOS DO USER SE EXISTE OU NAO E PRIMEIRO JOGO
//             }
//             if($i > 0 && $j == 0){

//                 $_SESSION['id'] = $row[0];
//                 $id = $_SESSION['id'];

//                 $insere_tabela_jogos = "INSERT INTO jogos (user_id, dificuldade, finalizado, pontos, problemas, abertos, mascote, created, modified ) VALUES ('$id', '".$campos[0]."', '".$campos[1]."', '".$campos[2]."', '".$campos[3]."', '".$campos[4]."', '".$campos[5]."', '".$campos[6]."', '".$campos[7]."')";
//                 $insere_tabela_jogos_ok = mysqli_query($conn, $insere_tabela_jogos);

//                 $verifica_id_jogo = "SELECT * FROM jogos WHERE id = (select max(id) from jogos)";
//                 $verifica_id_jogo_ok = mysqli_query($conn, $verifica_id_jogo);
//                 $row2 = mysqli_fetch_array($verifica_id_jogo_ok, MYSQLI_NUM);

//                 $campos2 = explode(',', $valor2[1]); 
//                 $conta_virgulas = substr_count($valor2[1], ',');

//                 $resultado_conta_virgulas_temp = $conta_virgulas/10; //divide o numero total de registros do txt pelo numero da campos da tabela jogadas, afim de saber o numero de inserts na tabela
//                 $resultado_conta_virgulas = round($resultado_conta_virgulas_temp);

//                 //echo $resultado_conta . '<br>';

//                 for($y = 0; $y < $resultado_conta_virgulas; $y++ ){

//                     if($y==0){ //primeira vez, insere normal
//                         $cont = 0;
//                     }
//                     if($y>0){ //a partir da segunda vez...
//                         $cont = $cont + 10; //contador de 10 em 10 para inserir os campos do vetor corretamente
//                     }

//                     $insere_tabela_jogadas = "INSERT INTO jogadas (jogo_id, fase, pontos, vida, objeto_id, objeto, acao, intencao, created, modified ) VALUES ('".$row2[0]."', '".$campos2[1+$cont]."', '".$campos2[2+$cont]."', '".$campos2[3+$cont]."', '".$campos2[4+$cont]."', '".$campos2[5+$cont]."', '".$campos2[6+$cont]."', '".$campos2[7+$cont]."', '".$campos2[8+$cont]."', '".$campos2[9+$cont]."' )";
//                     $insere_tabela_jogodas_ok = mysqli_query($conn, $insere_tabela_jogadas); 

//                 }
//             }
//         }
//     }
// }
//     // if (mysqli_num_rows($result_user) == 0) {
//     //     // Se o usuário não existe, inserir no banco de dados
//     //     $insere_usuario = "INSERT INTO users (name, password, created, modified') VALUES ('$usuario', MD5('123456'), NOW(), NOW())";
//     //     mysqli_query($conn, $insere_usuario);
//     //     $user_id = mysqli_insert_id($conn);
//     // } else {
//     //     // Se o usuário já existe, obter o ID
//     //     $user_row = mysqli_fetch_array($result_user);
//     //     $user_id = $user_row['id'];
//     // }
