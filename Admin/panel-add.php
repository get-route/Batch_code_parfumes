<?php session_start();
//Если сессия админа не равна значению админ, то переводим страницу на 404
if ($_SESSION['admin']!=='admin') {
    header("Location: ../404.php");
}
require_once 'db-install.php';
require_once 'db.php';
require_once 'function.php';
//Проверяем кнопку выхода. Если в гет есть id godby, то прерываем сессию и выходим на страницу авторизации.
$_GET['exit']=good_param($_GET['exit']);
if ($_GET['exit']=='godby')
{
    unset($_SESSION['admin']);
    session_destroy();
    header("Location:../log-in.php");
}

?>
<script src="../Admin/ckeditor/ckeditor.js"></script>
<body class="adminka">
<div class="col-lg-12 text-center">
    <h2>Панель управления сайтом</h2>
    <button value="Refresh Page" onClick="window.location.href=window.location.href">Обновить</button>
</div>
<section class="comment-table">
    <p>
        <a class="collapse show btn btn-primary komment-button-admin" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            Комментарии
        </a>
    </p>
    <div class="collapse komment-table-admin" id="collapseExample">
        <div class="card card-body">
            <h3 class="text-center">Редактор комментариев</h3>

            <table class="table">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Комментарий</th>
                    <th>Ссылка</th>
                    <th>Автор</th>
                    <th>Удалить</th>
                    <th>Модерация</th>
                    <th>Одобрен</th>
                </tr></thead>
                <tbody>
                <?php more_comment();
                foreach ($table_comments as $item)
                {
                ?>
                <tr>
                    <th><?php echo $item ['id']?></th>
                    <td><?php echo $item ['text']?></td>
                    <td><a href="../brands<?php echo "/".$item['id_post'];?>">Перейти</a></td>
                    <td><?php echo $item ['avtor']?></td>
                    <?php
                    if (good_param($_GET['delete']!==NULL)) {
                        $delkom = good_param($_GET['delete']);
                        delete_comment();
                    }?>
                    <td><a href="?delete=<?php echo $item['id']?>">Удалить</a> </td>
                    <td><a href="?public=<?php echo $item['id']?>">Одобрить</a></td>
                    <?php
                    if ((good_param(!empty($_GET['public']))))
                    {
                        public_comment();
                    }?>
                    <td><?php echo $item['public']?></td>
                    <?php
                    }
                    ?>
                </tr>
                </tbody>

            </table>

        </div>
    </div>
</section>
<section class="post-table">
    <p>
        <a class="collapse show btn btn-primary komment-button-admin" data-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample1">
            Все записи
        </a>
    </p>
    <div class="collapse komment-table-admin" id="collapseExample1">
        <div class="card card-body">
            <h3 class="text-center">Таблица записей</h3>

            <table class="table">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Заголовок</th>
                    <th>Ссылка</th>
                    <th>Дата</th>
                    <th>Удалить</th>
                    <th>Редактировать</th>
                    <th>Опубликована</th>
                    <th>Да(yes)Нет(No)</th>
                </tr></thead>
                <tbody>
                <?php
                more_post();
                foreach ($table_posts as $row)
                {
                ?>
                <tr>
                    <th><?php echo $row ['id']?></th>
                    <td><?php echo $row ['title']?></td>
                    <td><a href="../<?php echo $row ['category_id']."/".$row['url']?>">Перейти</a></td>
                    <td><?php echo $row ['date']?></td>
                    <?php if (good_param($_GET['deletepost']!==NULL)) {
                        $delpost = good_param($_GET['deletepost']);
                        delete_post();
                    }?>
                    <td><a href="?deletepost=<?php echo $row['id']?>">Удалить</a> </td>
                    <td><a href="update.php?redectpost=<?php echo $row['id']?>">Редактировать</a> </td>
                    <td><a href="?publicpost=<?php echo $row['id']?>">Одобрить</a></td>
                    <?php
                    if ((good_param($_GET['publicpost']!==NULL)))
                    {
                        public_post();
                    }
                    ?>
                    <td><?php echo $row['public']?></td>
                </tr>
                </tbody>
                <?php } ?>
            </table>

        </div>
    </div>
</section>
<section class="public-post">
    <p>
        <a class="collapse show btn btn-primary komment-button-admin" data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample2">
            Добавить запись
        </a>
    </p>
    <div class="collapse komment-table-admin" id="collapseExample2">
        <div class="card card-body">
            <h3 class="text-center">Картинка поста:</h3>
            <?php
            $donwld='../images/';
            $upload=$donwld.basename($_FILES['image-post']['name']);
            if ((isset($_FILES['image-post']))&& move_uploaded_file($_FILES['image-post']['tmp_name'],$upload)){
                echo "файл загружен";
            } else echo "Не загружен";

            ?>
            <form method="post" action="" enctype="multipart/form-data">
                <input type="file" name="image-post" required>
                <input type="submit" value="отправить">
            </form>
            <h3 class="text-center">Форма записи:</h3>
            <?php
            $text_post= $_POST['editor1'];
            $title_post=good_param($_POST['title-post']);
            $description_post=good_param($_POST['description-post']);
            $h1_post=good_param($_POST['h1-post']);
            $url_post=good_param($_POST['url-post']);
            $cat_url=$cat_inf[0];
            $cat_title=$cat_inf[1];
            $posting_post=good_param($_POST['posting-post']);
            $name_img=good_param($_POST['img-posts']);
            $alt_img=good_param($_POST['alt-post']);
            $brands_post=good_param($_POST['brands-post']);
            $info_post=good_param($_POST['info-post']);
            $year_post=good_param($_POST['year-post']);
            $where_img=good_param($_POST['where-img']);
            $where_img_alt=good_param($_POST['where-img-alt']);
            $brands_header=good_param($_POST['brands-header']);
            //Берем данные из Selecta и делим строку для получения урла и тайтла категории поста.
            $cat_inf=explode(';',good_param($_POST['cat-post']));
            if ($posting_post==true)
            {
                public_post_bd();
                header("Refresh:0");
            }
            ?>
            <form name="publicated-post" method="post">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Текст статьи</label>
                    <textarea name="editor1" rows="10" cols="80" class="form-control" id="exampleFormControlTextarea1 editor1" ></textarea>
                    <script>
                        // Replace the <textarea id="editor1"> with a CKEditor 4
                        // instance, using default configuration.
                        CKEDITOR.replace( 'editor1' );
                    </script>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Title</label>
                    <input name="title-post" type="text" class="form-control" id="exampleFormControlInput1" placeholder="заголовок статьи">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Описание.Description</label>
                    <input name="description-post" type="text" class="form-control" id="exampleFormControlInput1" placeholder="описание статьи">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Название функции для Рассчета</label>
                    <input name="brands-post" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Название функция для вычера батч-кода">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Имя бренда для главной</label>
                    <input name="brands-header" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Как будет называться бренда в категории и на главной">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Доп.Информация</label>
                    <input name="info-post" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Доп.информация в посте">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Срок Годности</label>
                    <input name="year-post" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Срок годности отдельного товара">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Заголовок</label>
                    <input name="h1-post" type="text" class="form-control" id="exampleFormControlInput1" placeholder="H1 для статьи">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">URL</label>
                    <input name="url-post" type="text" class="form-control" id="exampleFormControlInput1" placeholder="адрес статьи">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Превью картинка.</label>
                    <?php
                    $file_dir='../images/';
                    $directory=scandir($file_dir);

                    ?>
                    <select name="img-posts" class="form-control" id="exampleFormControlSelect1">
                        <option value="in">Выбрать</option>
                        <?php
                        foreach ($directory as $item){ ?>
                            <option value="<?php echo ($item);?>"><?php echo $item;?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <input name="alt-post" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Описание превью">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Фото где достать батч код</label>

                    <select name="where-img" class="form-control" id="exampleFormControlSelect1">
                        <option value="in">Выбрать</option>
                        <?php
                        foreach ($directory as $item){ ?>
                            <option value="<?php echo ($item);?>"><?php echo $item;?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <input name="where-img-alt" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Описание картинки где достать фото">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Категория</label>
                    <select name="cat-post" class="form-control" id="exampleFormControlSelect1">
                        <option value="0" >Выбрать</option>
                        <?php db_cat();
                        foreach ($cat as $cat) {
                            ?>
                            <option value="<?php echo $cat['url'].";".$cat['title']?>"><?php echo $cat['title']?> </option>

                        <?php                      }
                        ?>
                    </select>
                </div>
                <input type="submit" name="posting-post" class="btn btn-primary">
            </form>
        </div>
    </div>
</section>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/style.css">
<link rel="shortcut icon" href="../images/favicon.png" type="image/x-icon">
<div class="col-lg-12 text-center">
    <a class="text-center" href="/Admin/panel-add.php/?exit=godby">Выйти</a>
</div>
</div><script src="../js/jquery-3.5.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/popper.min.js"></script></body>
<script src="https://use.fontawesome.com/c90ce9b1a2.js"></script>
</body>