<?php
require_once 'db-install.php';
require_once 'db.php';
//Функция для реализации шорткодов на сайт. Удобно заменять любые ссылки в постах
function AddBB($text_decode) {
    global $text_decode;
    $search = array(
        //Шорткод ссылки оффера. Вставить нужно [link]. Ссылка берется из БД
        '#\[link\]#',
        '#\[link2\]#',
        '#\[link3\]#',
    );

    $str="<div class=\"d-none d-sm-none d-md-block d-lg-block d-xl-block\">".BLOK1."</div>".
"<div class=\"d-block d-sm-block d-md-none d-lg-none d-xl-none\">".BLOKMD1."</div>
";
    $str2="<div class=\"d-none d-sm-none d-md-block d-lg-block d-xl-block\">".BLOK2."</div>".
        "<div class=\"d-block d-sm-block d-md-none d-lg-none d-xl-none\">".BLOKMD2."</div>
";
    $str3="<div class=\"d-none d-sm-none d-md-block d-lg-block d-xl-block\">".BLOK3."</div>".
        "<div class=\"d-block d-sm-block d-md-none d-lg-none d-xl-none\">".BLOKMD3."</div>
";
    $replace = array(
        "$str",
        "$str2",
        "$str3",
    );
    $text_decode = preg_replace ($search, $replace, $text_decode);
    return $text_decode;
}

//Выводит посты в зависимости от категории
function db_post()
{
    global $dbh;
    global $id;
    global $post;
    $post=$dbh->prepare("SELECT * FROM post WHERE category_id=:id AND public='yes'");
    $post->execute(array('id'=>$id));
    return $post;
}
//Выводит инфу о основной информации внутри поста
function post_info()
{
    global $dbh;
    global $id;
    global $posty;
    $posty=$dbh->prepare("SELECT * FROM post WHERE url=:id");
    $posty->execute(array('id'=>$id));
    return $posty;
}
//Список категорий и их урлы в меню

function db_cat()
{
    $zapros = "SELECT * FROM category ";
    global $dbh;
    global $cat;
    $cat = $dbh->query($zapros);
    return $cat;
}
//Выводит информацию на странице категории
function category_info()
{
    global $dbh;
    global $cat;
    global $urls;
    $id=$urls;
    $id=htmlspecialchars($id);
    $id=urldecode($id);
    $id=trim($id);
    $cat = $dbh->prepare("SELECT * FROM category WHERE url=:id");
    $cat->execute(array('id'=>$id));
    return $cat;
}
//Функция поиска
function search_post()
{
    global $dbh;
    global $search;
    global $search_name;
    global $num_res;
    $search=$dbh->prepare("SELECT * FROM post WHERE MATCH (text) AGAINST (? IN BOOLEAN MODE)");
    $search->execute (array($search_name));
    $num_res=$search->rowCount();
    return $search;
}
//Функция отправки комментария
function post_comment ()
{
    global $dbh;
    global $komment;
    global $id;
    global $comment_text;
    global $comment_name;
    global $comment_email;
    $komment=$dbh->prepare("INSERT INTO comments SET avtor=?,text=?,id_post=?,Email=?")->execute([$comment_name,$comment_text,$id,$comment_email]);
    return $komment;
}
//Отправка поста в БД
function public_post_bd()
{
    global $dbh;
    global $public_bd;
    global $text_post;
    global $brands_post;
    global $info_post;
    global $year_post;
    global $title_post;
    global $description_post;
    global $h1_post;
    global $url_post;
    global $cat_inf;
    global $name_img;
    global $alt_img;
    global $where_img;
    global $where_img_alt;
    global $brands_header;
    $public_bdata="INSERT INTO post (text,url,title,description,h1,category_id,category_title,image_alt,image,brands,info,years,where_img,where_img_alt,brands_header) VALUES (:text,:url,:title,:description,:h1,:category_id,:category_title,:image_alt,:image,:brands,:info,:years,:where_img,:where_img_alt,:brands_header)";
    $public_based=[':text'=>$text_post,':url'=>$url_post,':title'=>$title_post,':description'=>$description_post,'h1'=>$h1_post,'category_id'=>$cat_inf[0],'category_title'=>$cat_inf[1],'image_alt'=>$alt_img,'image'=>$name_img,'brands'=>$brands_post,'info'=>$info_post,'years'=>$year_post,'where_img'=>$where_img,'where_img_alt'=>$where_img_alt,'brands_header'=>$brands_header];
    $public_bd=$dbh->prepare($public_bdata)->execute($public_based);
}

//Функция для безопасности гет и пост запросов
function good_param($proverka)
{
    $proverka=htmlspecialchars($proverka);
    $proverka=urldecode($proverka);
    $proverka=trim($proverka);
    $proverka=stripcslashes($proverka);
    return $proverka;
}
//Функция вывода списка одобренных комментариев
function comments_good()
{
    global $dbh;
    global $goodkom;
    global $id;
    $goodkom=$dbh->prepare("SELECT * FROM comments WHERE id_post=:id AND public='yes'");
    $goodkom->execute(array('id'=>$id));
    return $goodkom;
}
//Функция получения значения логин-пароль
function in_admin ()
{
    global $dbh;
    global $passlog;
    $passlog=$dbh->query("SELECT * FROM admin");
    return $passlog;
}
//Получаем все комментарии
function more_comment()
{
    global $dbh;
    global $table_comments;
    $use_comment="SELECT * FROM comments";
    $table_comments=$dbh->query($use_comment);
    return $table_comments;
}
//Удаление комментария
function delete_comment()
{
    global $dbh;
    global $delcomment;
    global $delkom;
    $delcomment=$dbh->prepare("DELETE FROM comments WHERE id=?");
    $delcomment->execute([$delkom]);
    return $delkom;
}
//одобрение комментариев
function public_comment()
{
    global $dbh;
    global $public_comments;
    global $publcom;
    $publcom = good_param($_GET['public']);
    $publ='yes';
    $public_comment="UPDATE comments SET public=? WHERE id=?";
    $public_comments=$dbh->prepare($public_comment);
    $public_comments->execute([$publ,$publcom]);
    return $public_comments;
}
//одобрение поста
function public_post()
{
    global $dbh;
    global $public_post;
    global $publpost;
    $publpost = good_param($_GET['publicpost']);
    $publk='yes';
    $public_posts="UPDATE post SET public=? WHERE id=?";
    $public_post=$dbh->prepare($public_posts);
    $public_post->execute([$publk,$publpost]);
    return $public_post;
}
//Все статьи
function more_post()
{
    global $dbh;
    global $table_posts;
    $use_post="SELECT * FROM post ORDER BY brands";
    $table_posts=$dbh->query($use_post);
    return $table_posts;
}
//Бренды на главной
function on_post()
{
    global $dbh;
    global $on_posts;
    $use_post="SELECT * FROM post WHERE `public` ='yes' ORDER BY brands_header";
    $on_posts=$dbh->query($use_post);
    return $on_posts;
}
//Все статьи в категории
function cat_post()
{
    global $dbh;
    global $cat_posts;
    $use_post="SELECT * FROM post WHERE public='yes'";
    $cat_posts=$dbh->query($use_post);
    return $cat_posts;
}
//Случайные статьи в футере
function footer_post(){
    global $index_two_posts;
    two_index_post();
    foreach ($index_two_posts as $footers){
        echo "<ul><li>";
        echo "<a href=".INDEX."/".$footers['category_id']."/".$footers['url'].">".$footers['title']."</a>";
        echo "</li></ul>";
    }
}
//Удаление поста
function delete_post()
{
    global $dbh;
    global $delposts;
    global $delpost;
    $delposts=$dbh->prepare("DELETE FROM post WHERE id=?");
    $delposts->execute([$delpost]);
    return $delposts;
}

//Получение постов на главной
function two_index_post()
{
    global $dbh;
    global $index_two_posts;
    $use_post="SELECT * FROM `post` WHERE public='yes' ORDER BY RAND() LIMIT 3 ";
    $index_two_posts=$dbh->query($use_post);
    return $index_two_posts;
}
//последние записи
function related_index_post()
{
    global $dbh;
    global $related_posts;
    $use_post="SELECT * FROM `post` WHERE public='yes' ORDER BY RAND() LIMIT 6";
    $related_posts=$dbh->query($use_post);
    return $related_posts;
}
//последние записи на главной
function index_post()
{
    global $dbh;
    global $related_posts;
    $use_post="SELECT * FROM `post` WHERE public='yes' ORDER BY DATE LIMIT 10";
    $related_posts=$dbh->query($use_post);
    return $related_posts;
}
//Количество постов
function rows_post(){
    global $dbh;
    global $nRows;
    $nRows = $dbh->query('select count(*) from post')->fetchColumn();
}
//Каталог статей в Алфавитном порядке с буквами
function alphabet(){
    global $on_posts;
    global $unic_simbols;
    global $simbols_post;
    on_post();
    foreach ($on_posts as $item) {
        //Обрезаем название бренда по первой букве.
        $simbols_post = substr($item['brands_header'], 0, 1);
        //Если заголовок буквы алфавита уже есть, то не печатаем его
        //Выводим списком посты, согласно алфавита.
        if ($simbols_post !== $unic_simbols){
            $unic_simbols = $simbols_post;
            ?>
            <div class="col-lg-12 text-center">
            <h2 class="text-center header-alphabet"><?php echo $simbols_post; ?></h2>
            </div><?php } ?>
        <ul class="alphabet-ul">
            <li><h3>
                    <a href="/<?php echo $item ['category_id'] ?>/<?php echo $item ['url'] ?>"
                       class="card-title"><?php echo $item ['brands_header'] ?></a>
                </h3></li>
        </ul>
    <?php }

}
//Все статьи для sitemap
function more_post_sitemap()
{
    global $dbh;
    global $table_posts;
    $use_post="SELECT * FROM post WHERE public='yes'";
    $table_posts=$dbh->query($use_post);
    return $table_posts;
}
//Редактирование статей
function EditPost(){
    global $read;
    global $dbh;
    global $reads_post;
    $reads_post=good_param($_GET['redectpost']);
    $read=$dbh->prepare("SELECT * FROM post WHERE id=?");
    $read->execute(array($reads_post));
}
function UpdatePost(){
    global $dbh;
    global $text_post;
    global $brands_post;
    global $info_post;
    global $year_post;
    global $title_post;
    global $description_post;
    global $h1_post;
    global $url_post;
    global $name_img;
    global $alt_img;
    global $where_img;
    global $where_img_alt;
    global $brands_header;
    global $reads_post;
    $update=$dbh->prepare("UPDATE post SET text=:text,title=:title,description=:description,h1=:h1,image=:image,image_alt=:image_alt,brands=:brands,info=:info,years=:years,where_img=:where_img,where_img_alt=:where_img_alt,brands_header=:brands_header,url=:url WHERE id=:id");
    $update->execute(array('text'=>"$text_post",'title'=>"$title_post",'description'=>"$description_post",'h1'=>"$h1_post",'image'=>"$name_img",'image_alt'=>"$alt_img",'brands'=>"$brands_post",'info'=>$info_post,'years'=>"$year_post",'where_img'=>"$where_img",'where_img_alt'=>"$where_img_alt",'brands_header'=>"$brands_header",'url'=>"$url_post",'id'=>"$reads_post"));
}
//Создаем массивы для функции роутинга
function routing_urls(){
    global $table_posts;
    global $cat;
    global $post_url;
    global $cat_url;
    global $url_kat;
    global $url_post;
    global $route;
    more_post();
    foreach ($table_posts as $post_url){
        $url_post[]=array("post"=>$post_url['url']);
    }
    db_cat();
    foreach ($cat as $cat_url){
        $url_kat[]=array("kat"=>$cat_url['url']);
    }
    $route=array_merge($url_kat,$url_post);
}
//ФУНКЦИИ ДЛЯ ПАРФЮМА. ДЛЯ ВЫВОДА ПОЛУЧАЕМ $YEAR - ГОД И $MONTH - МЕСЯЦ.
//Функция для Kilian
function Kilian(){
    global $batch_form;
    global $year;
    global $month;
    global $day;
    //Обрезаем строку до нужного размера. Берем необходимое количество символов
    $month='Год ';
    $twonum=substr($batch_form,'0','1');
    $one_year=date('Y');
    $ar_year = array($one_year - 1 => 'A',
        $one_year=> 'B', $one_year - 2 => 'C', $one_year - 3 => 'D',
        $one_year - 4 => 'E', $one_year - 5 => 'F', $one_year - 6 => 'G',
        $one_year - 7 => 'H', $one_year - 8 => 'J', $one_year - 9 => 'K',
        $one_year - 10 => 'L', $one_year - 11 => 'M',
    );

    foreach ($ar_year as $simbols => $years) {
        if ($years == $twonum) {
            $year = $simbols;
            $day = $one_year - $simbols;
            break;
        }
    }
    return $year;
}

?>