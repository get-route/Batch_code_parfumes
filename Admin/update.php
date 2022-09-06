<?php
session_start();
if ($_SESSION['admin']!=='admin') {
    header("Location: ../404.php");
}
require_once 'db-install.php';
require_once 'db.php';
require_once 'function.php';
EditPost();
$text_post= $_POST['editor1'];
$title_post=good_param($_POST['title-post']);
$description_post=good_param($_POST['description-post']);
$h1_post=good_param($_POST['h1-post']);
$url_post=good_param($_POST['url-post']);
$posting_post=good_param($_POST['posting-post']);
$name_img=good_param($_POST['img-posts']);
$alt_img=good_param($_POST['alt-post']);
$brands_post=good_param($_POST['brands-post']);
$info_post=good_param($_POST['info-post']);
$year_post=good_param($_POST['year-post']);
$where_img=good_param($_POST['where-img']);
$where_img_alt=good_param($_POST['where-img-alt']);
$brands_header=good_param($_POST['brands_header']);
//Берем данные из Selecta и делим строку для получения урла и тайтла категории поста.
$cat_inf=explode(';',good_param($_POST['cat-post']));
if ($_POST['updates']!==NULL){
    UpdatePost();
    header("Refresh:0");
}
foreach ($read as $item) {

?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../Admin/ckeditor/ckeditor.js"></script>
<form name="publicated-post" method="post">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Текст статьи</label>
                    <textarea name="editor1" rows="10" cols="80" class="form-control" id="exampleFormControlTextarea1 editor1" ><?php echo $item['text']?></textarea>
                    <script>
                        // Replace the <textarea id="editor1"> with a CKEditor 4
                        // instance, using default configuration.
                        CKEDITOR.replace( 'editor1' );
                    </script>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Title</label>
                    <input value="<?php echo $item['title']?>" name="title-post" type="text" class="form-control" id="exampleFormControlInput1" placeholder="заголовок статьи">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Описание.Description</label>
                    <input value="<?php echo $item['description']?>"  name="description-post" type="text" class="form-control" id="exampleFormControlInput1" placeholder="описание статьи">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Название функции для Рассчета</label>
                    <input value="<?php echo $item['brands']?>" name="brands-post" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Название функция для вычера батч-кода">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Имя бренда для главной</label>
                    <input value="<?php echo $item['brands_header']?>" name="brands_header" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Как будет называться бренда в категории и на главной">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Доп.Информация</label>
                    <input value="<?php echo $item['info']?>" name="info-post" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Доп.информация в посте">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Срок Годности</label>
                    <input value="<?php echo $item['years']?>" name="year-post" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Срок годности отдельного товара">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Заголовок</label>
                    <input value="<?php echo $item['h1']?>" name="h1-post" type="text" class="form-control" id="exampleFormControlInput1" placeholder="H1 для статьи">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">URL</label>
                    <input value="<?php echo $item['url']?>" name="url-post" type="text" class="form-control" id="exampleFormControlInput1" placeholder="адрес статьи">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Превью картинка.</label>
                    <?php
                    $file_dir='../images/';
                    $directory=scandir($file_dir);

                    ?>
                    <select name="img-posts" class="form-control" id="exampleFormControlSelect1">
                        <option value="<?php echo $item['image']?>"><?php echo $item['image']?></option>
                        <?php
                        foreach ($directory as $prewiev){?>
                            <option value="<?php echo ($prewiev);?>"><?php echo $prewiev;?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <input value="<?php echo $item['image_alt']?>" name="alt-post" type="text" class="form-control" id="exampleFormControlInput1" placeholder="<?php echo $item['image_alt']?>">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1">Фото где достать батч код</label>

                    <select name="where-img" class="form-control" id="exampleFormControlSelect1">
                        <option value="<?php echo $item['where_img']?>"><?php echo $item['where_img']?></option>
                        <?php
                        foreach ($directory as $where_batch){ ?>
                            <option value="<?php echo ($where_batch);?>"><?php echo $where_batch;?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <input name="where-img-alt" type="text" class="form-control" id="exampleFormControlInput1" placeholder="<?php echo $item['where_img_alt']?>" value="<?php echo $item['where_img_alt']?>">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Категория</label>
                    <select name="cat-post" class="form-control" id="exampleFormControlSelect1">
                        <option value="<?php echo $item['category_id']?>" ><?php echo $item['category_title']?></option>
                        <?php db_cat();
                        foreach ($cat as $cat) {
                            ?>
                            <option value="<?php echo $cat['url'].";".$cat['title']?>"><?php echo $cat['title']?> </option>

                        <?php                      }
                        ?>
                    </select>
                </div>
                <input type="submit" name="updates" class="btn btn-primary" value="Обновить">
            </form>
<?php } ?>

<div class="col-lg-12 text-center">
    <a class="text-center" href="/Admin/panel-add.php/?exit=godby">Выйти</a>
</div>
<div class="col-lg-12 text-center">
    <a class="text-center" href="<?php echo INDEX?>/Admin/panel-add.php">Обратно в Админку</a>
</div>
</div><script src="../js/jquery-3.5.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/popper.min.js"></script>
</body>