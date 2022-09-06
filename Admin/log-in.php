<?php
session_start();
//Если сессия зарегистрирована как админ, то сразу переходим на админку без авторизации
if ($_SESSION['admin']==='admin')
{
    header("Location:panel-add.php");
    exit();
}
require_once 'db-install.php';
require_once 'db.php';
require_once 'function.php';
in_admin();
$name_admin=good_param($_POST['login-name']);
$psw_admin=md5(md5(md5(good_param($_POST['login-psw']))));
$admin_submit=good_param($_POST['subm-login']);
foreach ($passlog as $value)
{
    //Если пароль из бд равен паролю введенному и логину, то переходим на админку, регистрируя сессию.
if ((md5(md5(md5($value['password']))))===(($psw_admin)) && ($name_admin===$value['login']))
{
    $_SESSION['admin']='admin';
    header("Location: panel-add.php");
    exit();
}else echo"Пароль или логин не верны";
}
?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/style.css">
<link rel="shortcut icon" href="../images/favicon.png" type="image/x-icon">

<section>
    <title>Форма входа на сайт</title>
    <div class="container">
            <div class="col-lg-12 text-center login-header">
                <h2>Введите логин и пароль</h2>
            </div>
            <div class="col-lg-12">
                <form method="post" name="login-form">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Логин</label>
                        <input type="text" class="form-control" name="login-name" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <small id="emailHelp" class="form-text text-muted">Введите логин</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Пароль</label>
                        <input type="password" class="form-control" name="login-psw" id="exampleInputPassword1">
                    </div>
                    <input type="submit" name="subm-login" class="btn btn-primary">
                </form>
            </div>
    </div>
</section>
<script src="../js/jquery-3.5.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/popper.min.js"></script></body>
<script src="https://use.fontawesome.com/c90ce9b1a2.js"></script>