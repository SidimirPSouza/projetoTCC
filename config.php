<?php

$servidor = "127.0.0.1";
$usuario = "root";
$senha = "";
$bd = "bdcantina";

$conexao= mysqli_connect($servidor, $usuario, $senha, $bd);

if(!$conexao){
 die("A conexão com o banco de dados falhou".mysqli_connect_error($conexao));
}else{
    
}

////////função cadastrar////////
function cadastrar($tabela, $dados)
{
    global $conexao;
    $campos = implode(", ", array_keys($dados));
    $valores = implode(", ", $dados);
    $sql = "INSERT INTO $tabela($campos) values ($valores);";
    if (mysqli_query($conexao, $sql)) {
        echo "<div style='color: green; font-weight: bold;'>Cadastro realizado com sucesso! <a href='index.php'>Voltar</a></div>";
        } else {
        echo "<div class='p-3 mb-2 bg-danger text-white'>Erro ao cadastrar</div>";
    }
    mysqli_close($conexao);
}

////////função cadastrar produtos////////
function cadastrarprod($tabela, $dados)
{
    global $conexao;
    $campos = implode(", ", array_keys($dados));
    $valores = implode(", ", $dados);
    $sql = "INSERT INTO $tabela($campos) values ($valores);";
    if (mysqli_query($conexao, $sql)) {
        echo "<div style='color: green; font-weight: bold;'>Cadastro realizado com sucesso! <a href='vsestoque.php'>Voltar</a></div>";
    } else {
        echo "<div class='p-3 mb-2 bg-danger text-white'>Erro ao cadastrar</div>";
    }
    mysqli_close($conexao);
}

// efetuar login //

function login($email,$senha){
    global $conexao;
    $sql = "SELECT * FROM tbusuarios WHERE email='$email';";
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
        
        //header("location:index.php?erro=$erro");
    }else{
        session_start();
        $_SESSION['email']=$email;
        header("location:index.php");
    }
}


function verificaValorExistente($pdo, $tabela, $coluna, $valor) {
    $sql = "SELECT COUNT(*) FROM $tabela WHERE $coluna = :valor";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':valor', $valor);
    $stmt->execute();

    // Retorna true se o valor já existir e false caso contrário
    return $stmt->fetchColumn() > 0;
}


// verificar login //

function verificacaologin(){
    session_start();
    if(!isset($_SESSION['usuario'])){
        header("location:login.php?erro=Usuário não autenticado");
    }
}





?>


