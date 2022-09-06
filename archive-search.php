<!DOCTYPE html>
<html lang="ru">
<?php
//Включаем бд,и функции
require_once './Admin/function.php';
require_once './Admin/db-install.php';
require_once './Admin/db.php';
?>
<head>
    <?php
    require_once './header.php';
    ?>
    <meta name="description" content="Поисковая страница">
    <title>Поиск результатов:</title>
</head>
<?php
//Присваиваем знач гет запроса переменной

?>

<body>
<header class="header">
    <div class="container">
        <?php
        require_once './navigate.php';
        ?>
        <div class="row">
            <?php
            //Если поле ввода не пустое, то проверяем количество строк и выполняем код вывода найденной страницы.
            //В ином случае выводим сообщение о пустой строке или просим уточнить запрос.
            $serch_name=$_GET ['serch-name'];
            $serch_name=htmlspecialchars($serch_name);
            $serch_name=urldecode($serch_name);
            $serch_name=trim($serch_name);

            $search_name=$_GET ['search-name'];
            $search_name=htmlspecialchars($search_name);
            $search_name=urldecode($search_name);
            $search_name=trim($search_name);
            if ($search_name) {
            search_post();
            ?>
            <div class="col-lg-12">

                <div class="info-post">
                    <h1 class="post-header-title text-center">Найдено результатов: <?php echo $num_res?></h1>
                    <p class="paragraph-section"><?php if ($num_res==0){echo "Увы! Такой страницы нет."."<br>"."Уточните Ваш запрос.";}?></p>
                </div>
            </div>
            <?php
            require_once './Search/search.php';
            ?>
        </div>
    </div>
</header>
<section class="content-section">

    <div class="container text-center">

        <div class="row text-center">
            <?php
            foreach ($search as $inc){
            ?>
                <div class="col-lg-3 kards-category">


                    <div class="card border-info" style="max-width: 10rem;">

                        <div class="card-header">Код:
                        </div>

                        <div class="card-body text-info">
                            <a href="/post.php?url=<?php echo $inc['url']?>"><h3 class="card-title"> <?php echo $inc['title_archive'];?></h3></a>
                        </div>
                    </div>
                </div>
            <?php
            }?>
            <?php }else echo "Вы не ввели нужное Вам значение";
            ?>
        </div>
    </div>
</section>


</body>
<?php
require_once './footer.php';
?>

</html>
