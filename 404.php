<?php
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<?php
require_once 'header.php';
$urls=$_SERVER['REQUEST_URI'];
$url=explode("/",$urls);
$id=$url[2];
?>
    <meta name="description" content="Ошибка на странице?>">
    <title>Ошибка 404. Страница не найдена!...</title>
</head>
<body>
<header class="header">
    <div class="container">
        <?php
        require_once 'navigate.php';
        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="info-post">
                    <h1 class="post-header-title text-center">Ошибка 404! Увы! такой страницы нет...</h1>
                </div>

            </div>

        </div>
    </div>
</header>
<section class="content-section">
    <div class="container ">

    </div>
</section>
</body>
<?php
require_once 'footer.php';
?>

</html>
