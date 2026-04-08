<?php
session_start();
    $ex=true;
    $users = [
        [
            "email"=>"teste1@gmail.com",
            "nome"=>"teste1",
            "senha"=>1,
            "deve"=>[
                "nome"=>["teste3"],
                "valor"=>[200]
            ],
            "devo"=>[
                "nome"=>["teste2"],
                "valor"=>[200]
            ]
        ],
        [
            "email"=>"teste2@gmail.com",
            "nome"=>"teste2",
            "senha"=>1,
            "deve"=>[
                "nome"=>["teste1"],
                "valor"=>[200]
            ],
            "devo"=>[
                "nome"=>["teste3"],
                "valor"=>[200]
            ]
        ],
        [
            "email"=>"teste3@gmail.com",
            "nome"=>"teste3",
            "senha"=>1,
            "deve"=>[
                "nome"=>["teste2"],
                "valor"=>[200]
            ],
            "devo"=>[
                "nome"=>["teste1"],
                "valor"=>[200]
            ]
        ]
    ];

    if(isset($_POST["user"])&& $_POST["user"]!=""){
        for($i = 0 ; $i<count($users);$i++){
            if($_POST["user"]==$users[$i]["email"]){
                $ex=true;
                $_SESSION['user']=$users[$i];
                header("location: meDeve.php");
                exit;
            }else{
                $ex = false;
            }
        }
    }
    
    $_SESSION['users']=$users;

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    <?php if($ex==false):?>
        <p>informações incorretas</p>
        <?php endif; ?>
    <form action="" method="post">
        <label for="user">Email</label>
        <input type="email" name="user" id="user">
        <label for="senha">Senha</label>
        <input type="password" name="senha" id="senha">
        <button>Ir</button>
    </form>
   <a href="cadastro.php">Criar conta</a>
    
</body>
</html>