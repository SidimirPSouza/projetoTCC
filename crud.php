<?php

$servidor = "127.0.0.1";
$usuario = "root";
$senha = "";
$bd = "bdcantina";

$conexao= mysqli_connect($servidor, $usuario, $senha, $bd);

if(!$conexao){
 die("A conexão com o banco de dados falhou".mysqli_connect_error($conexao));
}

// verificar login

function verificacaologin(){
    session_start();
    if(!isset($_SESSION['usuario'])){
        header("location:login.php?erro=Usuário não autenticado");
    }
}

// efetuar login

function login($email,$senha){
    global $conexao;
    $sql = "SELECT * FROM usuarios WHERE email='$email';";
    $resultado = mysqli_query($conexao,$sql);
    if(mysqli_num_rows($resultado)>0){
        $linha = mysqli_fetch_assoc($resultado);
        if($linha['senha']!=$senha){
            $erro = "Senha incorreta.";
        }
    }else{
        $erro = "Usuário não encontrado.";
    }
    if(isset($erro)){
        header("location:login.php?erro=$erro");
    }else{
        session_start();
        $_SESSION['email']=$email;
        header("location:index.php");
    }
}


// ------- Funções para preencher o SELECT de turma e aluno---------------------

function preencherselect($tabela){
    global $conexao;
    $sql = "SELECT * FROM $tabela;";
    $resultado = mysqli_query($conexao,$sql);
    while($registro = mysqli_fetch_array($resultado)){
        echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
    }
}


// ------------- Funções do CRUD ----------------------

//-------------- Função de EXIBIR ---------------------

//Estilo da tabela (Descomentar o estilo que quiser usar)
// $estilotabela = "table table-dark";
$estilotabela = "table table-striped";
// $estilotabela = "table table-striped table-dark";
// $estilotabela = "table table-bordered";
// $estilotabela = "table table-bordered table-dark";
// $estilotabela = "table table-hover";
// $estilotabela = "table table-hover table-dark";
// $estilotabela = "table table-sm";
// $estilotabela = "table table-sm table-dark";
function exibir($tabela)
{
    global $conexao;
    global $estilotabela;
    $sql = "SELECT * FROM $tabela;";
    $resultado = mysqli_query($conexao, $sql);
    if (mysqli_num_rows($resultado) > 0) {
        //Exibe o resultado na tela dentro de uma tabela 
        echo "<table class='$estilotabela'>
        <thead>
          <tr>";
        //Consulta para buscar os nomes dos campos da tabela
        $sql1 = "DESCRIBE $tabela";
        $campos = mysqli_query($conexao, $sql1);
        while ($coluna = mysqli_fetch_array($campos)) {
            echo "<th scope='col'>" . $coluna[0] . "</th>";
        }
        echo "<th colspan=2 style='text-align:Center;'>Edição</th>";
        echo "</tr>
        </thead>
        <tbody>";
        echo "<tr>";
        //Exibe os registros da tabela
        while ($registro = mysqli_fetch_assoc($resultado)) {
            foreach ($registro as $valor) {
                echo "<td>$valor</td>";
            }
            //Pegando a chave primaria da tabela automaticamente
            $sql2 = 'SELECT information_schema.KEY_COLUMN_USAGE.COLUMN_NAME as COLUMN_NAME
            FROM information_schema.KEY_COLUMN_USAGE
            WHERE information_schema.KEY_COLUMN_USAGE.CONSTRAINT_NAME LIKE "PRIMARY" AND
            information_schema.KEY_COLUMN_USAGE.TABLE_SCHEMA LIKE "$bd" AND
            information_schema.KEY_COLUMN_USAGE.TABLE_NAME LIKE "$tabela";';
            $resultado2 = mysqli_query($conexao, $sql1);
            $chave = mysqli_fetch_array($resultado2);
            //Cria os botões de editar e apagar
            echo "<td style='width:20px; text-align:center;'><a href='editar.php?tabela=$tabela&campo=" . $chave[0] . "&valor=" . $registro[$chave[0]] . "'><i class='bi bi-pencil' ></i></a></td>";
            echo "<td style='width:20px; text-align:center;'><a href='apagar.php?tabela=$tabela&campo=" . $chave[0] . "&valor=" . $registro[$chave[0]] . "' onclick=\"return confirm('Confirma Exclusão?');\"><i class='bi bi-trash'></i></a></td>";
            echo "</tr>";
        }
        echo "</tbody>
        </table>";
    } else {
        //Exibe mensagem de erro
        echo "<p>Nenhum Registro encontrado</p>";
    }
    mysqli_close($conexao);
}

//-------------------------- Função de CADASTRO --------------------------------

function cadastrar($tabela, $dados)
{
    global $conexao;
    $campos = implode(", ", array_keys($dados));
    $valores = implode(", ", $dados);
    $sql = "INSERT INTO $tabela($campos) values ($valores);";
    if (mysqli_query($conexao, $sql)) {
        echo "<div class='p-3 mb-2 bg-success text-white'>Cadastro realizado com Sucesso <a href='index.html'>Voltar</a></div>";
    } else {
        echo "<div class='p-3 mb-2 bg-danger text-white'>Erro ao cadastrar</div>";
    }
    mysqli_close($conexao);
}



function editar()
{
}


//-------------------------- Função APAGAR --------------------------------
function apagar($tabela, $campo, $valor)
{
    global $conexao;
    $sqlapagar = "DELETE FROM $tabela WHERE $campo = $valor;";
    mysqli_query($conexao,$sqlapagar);
}



?>