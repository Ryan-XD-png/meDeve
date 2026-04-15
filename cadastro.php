<?php
session_start();
$resp=["senha","email","nome"];
$n=9;
if(isset($_POST['btn'])) {
if(isset($_POST["user"])&& $_POST["user"]!=""){
    if(isset($_POST["name"])&& $_POST["name"]!=""){
        if(isset($_POST["senha"])&& $_POST["senha"]!=""){
            for($i = 0 ; $i < count($_SESSION['users']);$i ++){
                if($_POST['user']==$_SESSION['users'][$i]['email']){
                    $copy=true;
                    break;
                }else{
                    $copy=false;
                }
            }
            if(!$copy){
                $n=9;
                $user=[
                    "tipo"=>"c",
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
                exit;
            }else{
                $n=1;
            }
            }else{$n=0;}
    }else{$n=0;}
    }else{$n=0;}
}
include ('includes/header.php');
?>
<main class="cad">
    <?php if($n==1):?>
        <div class="alert alert-warning" role="alert">
            <h3>Conta já existente</h3>
        </div>
        <?php endif; ?>
    <?php if($n==0):?>
        <div class="alert alert-warning" role="alert">
            <h3>informações incompletas</h3>
        </div>
        <?php endif; ?>
    <div class="form f-lg">
    <form action="" class="f" method="post">
        <label class="form-label" for="user">Email</label>
        <input class="form-control form-control-lg" type="email" name="user" id="user">
        <label class="form-label" for="name">Nome de usuario</label>
        <input class="form-control form-control-lg" type="text" name="name" id="name">
        <label class="form-label" for="senha">Senha</label>
        <input class="form-control form-control-lg" type="password" name="senha" id="senha">
        <button class="btn btn-primary btn-lg" type="submit" name="btn">Ir</button>
    </form>
    </div>
    <a class="btn btn-info btn-lg" href="index.php">Já tenho conta</a>
    </main>
</body>
</html>