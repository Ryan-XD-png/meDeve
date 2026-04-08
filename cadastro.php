<?php
session_start();
$resp=["senha","email","nome"];
$n=9;
if(isset($_POST["user"])&& $_POST["user"]!=""){
    if(isset($_POST["name"])&& $_POST["name"]!=""){
        if(isset($_POST["senha"])&& $_POST["senha"]!=""){
            $user=[
                "email"=>$_POST["user"],
                "nome"=>$_POST["name"],
                "senha"=>$_POST["senha"],
                "deve"=>[
                "nome"=>[],
                "valor"=>[]
                ],
                "devo"=>[
                "nome"=>[],
                "valor"=>[]
                ]];
            $_SESSION['users'][]=$user;
            $_SESSION['user']=$user;
            header("location: meDeve.php");
            
        }else{
            $n=0;
        }
    }else{
        $n=2;
    }
}else{
    $n=1;
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    <?php if($n!=9): ?>
        <p>informações incompletas</p>
    <?php endif; ?>
    <form action="" method="post">
        <label for="user">Email</label>
        <input type="email" name="user" id="user">
        <label for="name">Nome de usuario</label>
        <input type="text" name="name" id="name">
        <label for="senha">Senha</label>
        <input type="password" name="senha" id="senha">
        <button>Ir</button>
    </form>
    <a href="index.php">Ja tem conta</a>

</body>
</html>