<?php
session_start();
    $ex=1;
    $users = [
        [
            "tipo"=>"c",
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
            "tipo"=>"c",
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
            "tipo"=>"c",
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
        ],
        [   
            "tipo"=>"a",
            "email"=>"adm@gmail.com",
            "nome"=>"adm",
            "senha"=>"adm",
            "deve"=>[
                "nome"=>[],
                "valor"=>[]
            ],
            "devo"=>[
                "nome"=>[],
                "valor"=>[]
            ]
        ]
    ];
    if(!isset($_SESSION['users'])){
        $_SESSION['users']=$users;
    }else{
        $users=$_SESSION['users'];
    }
    if(isset($_POST['btn'])) {
    if(isset($_POST["senha"]) && $_POST["senha"]!=""){
    if(isset($_POST["user"]) && $_POST["user"]!=""){
        for($i = 0 ; $i<count($users);$i++){
            if($_POST["user"]==$users[$i]["nome"] && $_POST["senha"]==$users[$i]["senha"]){
                $ex=true;
                $_SESSION['user']=$users[$i];
                header("location: meDeve.php");
                exit;
            }else{
                $ex=0;
            }}
        }else{
            $ex=2;
        }
    }else{
            $ex=2;
        }}
    
    
include ('includes/header.php');
?>
    
    <main class="cad">
        <?php if($ex==2):?>
        <div class="alert alert-warning" role="alert">
            <h3>informações incompletas</h3>
        </div>
        <?php endif; ?>
        <?php if($ex==0):?>
        <div class="alert alert-warning" role="alert">
            <h3>informações incorretas</h3>
        </div>
        <?php endif; ?>
    <div class="form">
    <form action="" class="f" method="post">
        <label class="form-label" for="user">Nome de usuario</label>
        <input class="form-control form-control-lg" type="text" name="user" id="user">
        <label class="form-label" for="senha">Senha</label>
        <input class="form-control form-control-lg" type="password" name="senha" id="senha">
        <button class="btn btn-primary btn-lg" type="submit" name="btn">Ir</button>
    </form>
    </div>
   <a class="btn btn-info btn-lg" href="cadastro.php">Criar conta</a>
    </main>
<?php 
include ('includes/footer.php');
?>