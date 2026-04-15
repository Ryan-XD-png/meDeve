<?php
session_start();
$user=$_SESSION["user"];
if(isset($_POST['btn'])){
    list($id, $tipo)= explode('|',$_POST['btn']);
    unset($user[$tipo]['nome'][$id]);
    unset($user[$tipo]['valor'][$id]);
    $user[$tipo]['nome']=array_values($user[$tipo]['nome']);
    $user[$tipo]['valor']=array_values($user[$tipo]['valor']);
    $_SESSION["user"]=$user;
    for ($f=0; $f < count($_SESSION["users"]); $f++) { 
        if($_SESSION["users"][$f]["nome"]==$user["nome"]){
            $_SESSION["users"][$f]=$user;
        }
    }
}
$n=9;
if(isset($_POST['btn-cria'])) {
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

            }else{
                $n=1;
            }
            }else{$n=0;}
    }else{$n=0;}
    }else{$n=0;}
}
if(isset($_POST['del'])){
    unset($_SESSION['users'][$_POST['del']]);
    $_SESSION["users"]=array_values( $_SESSION["users"]);
}
if(isset($_POST['adm'])){
    $_SESSION['users'][$_POST['adm']]['tipo']='a';
}
if(isset($_POST['dow'])){
    $_SESSION['users'][$_POST['dow']]['tipo']='c';
}

$et=0;
if(isset($_POST['env'])){

if(isset($_POST["pessoa"])&& $_POST["pessoa"]!=""){
    if(isset($_POST["tipo"])&& $_POST["tipo"]!=""){
        if(isset($_POST["valor"])&& $_POST["valor"]!=""){
            $preco = str_replace(",", ".", $_POST["valor"]);
            if (is_numeric($preco)) {
                $et = 0;
                $preco = floatval($preco);
                $user[$_POST["tipo"]]['nome'][]=$_POST["pessoa"];
                $user[$_POST["tipo"]]['valor'][]=$_POST["valor"];
                
            } else {
            $et = 1;
            }
        }else {$et = 2;}
    }else {$et = 2;}
}else {$et = 2;}
}
if(!isset($_SESSION['click'])){
    $_SESSION['click']=true;
}
if($user['tipo']=='c'){
    $_SESSION['click']=true;
}
if(isset($_POST['btn-ck'])){
    if($_SESSION['click']==true){
        $_SESSION['click']=false;
    }else{
        $_SESSION['click']=true;
    }
}

if(isset($_POST['sair'])){
    unset($_SESSION['user']);
    header("location: index.php");
    exit;
}

include ('includes/header.php');
?>
    <?php if($user['tipo']=='a'): ?>
    <form class="mini" method="post">
        <button class=" btn btn-info btn-sm " type="submit" name="btn-ck" value="ck">Painel Admin</button>
    </form>
    <?php endif; ?>
    <main class="menu">
    <div class="items container">
        <?php  if($_SESSION['click']==true): ?>
        <h2>Está me devendo</h2>
        <ul>
           <?php if(count($user['deve']['nome'])>0):?>
            <?php for($i=0;$i<count($user['deve']['nome']);$i++):?>
                <li>
                    <h4>Nome: <?= $user['deve']['nome'][$i]?> </h4>
                    <h4>Valor: R$ <?= $user['deve']['valor'][$i]?></h4>
                <form method="POST">
                <button class=" btn btn-danger btn-sm" type="submit" name="btn" value="<?= $i ?>|deve"></button>
                </form>
                </li>
            <?php endfor; ?>
            <?php else: ?>
                <h4>Sem devedores</h4>
            <?php endif; ?>
        </ul>
        <?php else: ?>
            <h2>Usuários</h2>
        <ul>
           <?php if(count($_SESSION['users'])>0):?>
            <?php for($i=0;$i<count($_SESSION['users']);$i++):?>
                <?php if($_SESSION['users'][$i]['tipo']=='c'):?>
                <li>
                    <h4>Nome: <?= $_SESSION['users'][$i]['nome']?> </h4>
                    
                <form method="POST">
                <button class=" btn btn-danger btn-sm" type="submit" name="del" value="<?= $i ?>">deletar</button>
                <button class=" btn btn-success btn-sm s" type="submit" name="adm" value="<?= $i ?>">upgrade</button>
                </form>
                </li>
                <?php endif; ?>
            <?php endfor; ?>
       <?php endif; ?>

        </ul>
         <?php endif; ?>
    </div>
    <div class="items container flex">
        <?php  if($_SESSION['click']==true): ?>
            <?php if($et==1):?>
        <div class="alert alert-warning" role="alert">
            <h3>valor incorreto</h3>
        </div>
        <?php endif; ?>
        <?php if($et==2):?>
        <div class="alert alert-warning" role="alert">
            <h3>informações incompletas</h3>
        </div>
        <?php endif; ?>
        <div class="form maior">
    <form action="" class="f" method="post">
        <label class="form-label" for="pessoa">Nome</label>
        <input class="form-control form-control-lg" type="text" name="pessoa" id="pessoa">
        <label  class="form-label" for="tipo" >tipo</label>
        <div class="chek">
        
        <input class="form-check-input" type="radio" name="tipo" value="deve" id="">
        <label for="">Deve</label>
        <input  class="form-check-input" type="radio" name="tipo" value="devo" id="">
        <label for="">Devo</label> 
        </div>
        <label class="form-label" for="valor">valor</label>
        <input class="form-control form-control-lg" type="text" name="valor" id="valor">
        <button class="btn btn-primary btn-lg" type="submit" name="env">Ir</button>
    </form>
    </div>
        <?php else: ?>
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
        <button class="btn btn-primary btn-lg" type="submit" name="btn-cria">Ir</button>
    </form>
    </div>
    <?php endif; ?>
    <form method="post">
        <button class=" btn btn-danger btn-sm " type="submit" name="sair">Sair da conta</button>
    </form>

    </div>
    <div class="items container">
        <?php  if($_SESSION['click']==true): ?>
        <h2>Estou devendo</h2>
        <ul>
            <?php if(count($user['devo']['nome'])>0):?>
            <?php for($i=0;$i<count($user['devo']['nome']);$i++):?>
                <li><h4>Nome: <?= $user['devo']['nome'][$i]?> </h4> <h4>Valor: R$ <?= $user['devo']['valor'][$i]?></h4>
                
                <form method="POST">
                <button class=" btn btn-danger btn-sm" type="submit" name="btn" value="<?= $i ?>|devo"></button>
                </form>
                </li>
                <?php endfor; ?>
                <?php else: ?>
                    <h4>Não está devendo ninguém</h4>
                <?php endif; ?>
        </ul>
        <?php else: ?>
            <h2>Administradores</h2>
        <ul>
           <?php if(count($_SESSION['users'])>0):?>
            <?php for($i=0;$i<count($_SESSION['users']);$i++):?>
                <?php if($_SESSION['users'][$i]['tipo']=='a'):?>
                <li>
                    <h4>Nome: <?= $_SESSION['users'][$i]['nome']?> </h4>
                    
                <form method="POST">
                <button class=" btn btn-danger btn-sm" type="submit" name="del" value="<?= $i ?>">deletar</button>
                <button class=" btn btn-success btn-sm s" type="submit" name="dow" value="<?= $i ?>">downgrade</button>
                </form>
                </li>
                <?php endif; ?>
            <?php endfor; ?>
       <?php endif; ?>

        </ul>
         <?php endif; ?>

    </div>
    </main>
</body>
</html>