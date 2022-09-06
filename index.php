<?php
header("Last-Modified: " . date("D, d M Y H:i:s", time()) . " GMT");
require_once "./Admin/function.php";
require_once "./Admin/db-install.php";
require_once "./Admin/db.php";
$urls=$_SERVER['REQUEST_URI'];
$url=explode("/",$urls);
routing_urls();
foreach ($route as $item) {
    $str_kat =$item['kat'] ;
    $str_pos = "/" . $url[1] . "/" . $item['post'];
    if ($urls === "/") {
    }
    elseif ($urls === "/" . $str_kat) {
        include_once 'category.php';
        exit();
    } elseif ($urls === $str_pos) {
        include_once 'post.php';
        exit();
    } elseif ($urls === "/sitemap.xml") {
        include_once 'sitemap.php';
        exit();}
}
if (($urls !=="/")) {
    http_response_code(404);
    include_once '404.php';
    exit();
}
?>
<!DOCTYPE html>
<html lang="ru" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Бесплатная проверка батч кода духов и любого парфюма известных брендов. Анализ подлинности по штрих-коду, а также выявление подделок.">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo INDEX;?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo INDEX;?>/css/style.css">
    <link rel="icon" href="<?php echo INDEX;?>/favicon.png" type="image/png">
    <title>"МойПарфюм" - бесплатная проверка подлинности парфюма и косметики по батч коду</title>
</head>
<body>

<div class="header">
    <div class="container">
        <?php
        require_once 'navigate.php';
        ?>
        <div class="col-lg-12">
            <h1 id="code" class="form-search-header text-center">Бесплатный анализатор подлинности срока годности на русском языке</h1>
            <p class="form-search-paragraph text-center">Выберите бренд, укажите значение и нажмите "проверить" для запуска инструмента.</p>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <noindex>
                <div class="row">
                    <?php index_post();
                    foreach ($related_posts as $ind_post){
                        ?>
                        <div class="col-lg-6 button-parfume">
                             <a class="button-parfume-link" href="<?php echo INDEX."/".$ind_post['category_id']."/".$ind_post['url'];?>"><?php echo $ind_post['brands_header']?></a>
                        </div>
                    <?php }
                    ?>
                </div>
                </noindex>
                <div class="col-lg-12 all-brands text-center">
                    <a href="<?php echo INDEX."/"."brands"?>"target="_blank">Показать все бренды</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="col-lg-12 text-right parfume-img text-right">
                    <img src="<?php echo INDEX;?>/images/no.png" class="no">
                    <img src="<?php echo INDEX;?>/images/parfume.png" class="doc">
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</header>
<section class="our-servis">
    <div class="container">
        <div class="col-lg-12 text-center">
            <h2>Многофункциональный инструмент анализа</h2>
            <img src="<?php echo INDEX?>/favicon.png" width="120" height="120" alt="что за сервис Myparfumes">
            <p>"Сервис MyParfumes - универсальная площадка проверки множества классических ароматов и косметической продукции известных мировых марок."</p>
        </div>
    </div>
</section>
<section class="video-promo d-none d-lg-block d-xl-block">
    <div class="container">
        <div class="col-lg-12 text-center">
            <video class="promo-video" controls poster = "./images/video/what-servis.jpg">
                <source src = "<?php echo INDEX?>/images/video/MyParfumes.mp4" type = 'video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
                <source src = "<?php echo INDEX?>/images/video/MyParfumes.ogg" type = 'video/ogg; codecs="theora, vorbis"'>
                <source src="<?php echo INDEX?>/images/video/MyParfumes.webm" type='video/webm; codecs="vp8, vorbis"'>
            </video>
        </div>
    </div>
</section>
<section class="keys">
    <div class="container">
        <div class="col-lg-12 text-center">
            <h3 class="keys-header">Истории от клиентов:</h3>
        </div>
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">

            <div class="row slide-carusel">
                <div class="col-lg-12 text-left">
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        Хочу еще!...
                    </a>
                </div>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">

                    <div class="row">
                        <div class="col-lg-3 text-center">
                            <img src="<?php echo INDEX?>/images/keys/dior.jpg" alt="правила проверки духов фирмы Диор" class="slide-img">
                        </div>
                        <div class="col-lg-9 keys-slide">
                            <p>"При анализе духов бренда "Dior", был выявлен интересный момент, на который пожаловался пользователь. Сканирование батч кода дало результат 2018 года, хотя парфюм ,был приобретен где-то 20 лет назад и находится в личной коллекции.</p>
                            <p>Выяснилось, что инструмент проверки показал правильный результат. По внешним признакам была дополнительно проверена подлинность. Год у идентификаторов компании, меняется каждые 10 лет. Следовательно коды 1998 года, могут быть актуальны для 2008 и 2018."</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-lg-3 text-center">
                            <img src="<?php echo INDEX?>/images/keys/montale.jpg" alt="проверка срока годности монтале" class="slide-img">
                        </div>
                        <div class="col-lg-9">
                            <p>"На проверку инструменту попали духи фирмы Монталь. Купленны они были через известных интернет-магазин. Рекомендации в интернете помогли понять, что распространенные советы, навроде стойкости аромата, качества краски и т.д не подойдут.</p>
                            <p>На деле выяснился интересный факт. При детальном сравнении внешнего вида с продукцией с официального сайта на русском языке, стало ясно, что перед нами подделка. Во-первых контрофакт выдавали несоответствия шрифта. Во-вторых код заведомо говорил о том, что срок годности давно истек.</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-lg-3 text-center">
                            <img src="<?php echo INDEX?>/images/keys/ysl-keys.jpg" alt="Как идентифицировать коды Ив Сент Лоран" class="slide-img">
                        </div>
                        <div class="col-lg-9 keys-slide">
                            <p>"На сайте объявлений было куплено 2 коробки духов YSL. Продавец уведомил его о том, что товар оригинальный и идет со скидкой. В ходе проверки myparfumes показал год - 2006</p>
                            <p>Однако, спросив мнения у более опытных пользователей, стало ясно, что подобная маркировка была присуща парфюму 2003 года, следовательно товар уже просрочен. Инструмент показал правильный результат. Однако дополнительная проверка его подкоректировалла"</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-lg-3 text-center">
                            <img src="<?php echo INDEX?>/images/keys/dior2.jpg" alt="Правила расшифровки батч кода диора" class="slide-img">
                        </div>
                        <div class="col-lg-9 keys-slide">
                            <p>"При покупке известного аромата от Диор, клиент обнаружил странную деталь. На коробке набора и бутыли содержались различные значения батч кода. Также идентификатор хорошо стирался со стекла.</p>
                            <p>Сравнение с оригиналом дало понять, что это подделка. Коды давали верный результат и говорили о подлинности. Но низкое качество стекла, из которого изготовлен товар, а также различия по цифрам на коробке и бутыли, выдало в парфюме контрофакт. Дальнейшая проверка по аромату также подтвердила все догадки."</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</section>
<section class="what-servises text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Для каких целей создан сервис?</h2>
            </div>
        <div class="col-lg-4 what-servises-blok text-center">
            <img src="<?php echo INDEX?>/images/info/expert.png" class="what-servise-img">
            <p class="what-servise-text">Позволяет провести оценку даты выпуска продукции. Для проверки могут указываться идентификаторы духов, косметики, одежды и обуви.</p>
        </div>
            <div class="col-lg-4 what-servises-blok ">
                <img class="what-servise-img" src="<?php echo INDEX?>/images/info/fake.png" alt="Сервис проверки">
                <p class="what-servise-text">Помогает определить подлинность, на основе данных о периоде производства.</p>
            </div>
            <div class="col-lg-4 what-servises-blok">
                <img src="<?php echo INDEX?>/images/info/period.png" class="what-servise-img">
                <p class="what-servise-text">Обобщает полезную информацию о проверяемом товаре на основе рекомендаций пользователей.</p>
            </div>
            </div>
    </div>
</section>

<section class="post-section">
    <div class="container">
        <div class="col-lg-12">
            <h2 id="param" class="text-center">Отзывы</h2>
            <p class="text-center">"Мнений тех, кто оценил работу сервиса"</p>
        </div>
        <div class="row">
            <div class="col-lg-6 review">
                <div id="carouselExampleFade1" class="carousel slide carousel-fade" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active rewiew_blok">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p class="rewiev-text">"На день рождения жены, решил ее порадовать и купить духов. Долго выбирал, в итоге наткнулся на продавца с объявления, поверил ему на слово. В итоге получил просроченный товар. Тогда не посмотрел в сервисе, сейчас только через него закупаюсь."</p>
                                </div>
                                <div class="col-lg-12 text-center">
                                    <p>Александр П</p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item rewiew_blok">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p class="rewiev-text">"Никогда не задумывалась над тем, что у парфюмерного товара может быть сроки годности. Несколько раз купив просрочку, я стала куда умнее и теперь только через подобные анализаторы батч кодов делаю заказы."</p>
                                </div>
                                <div class="col-lg-12 text-center">
                                    <p>Елена М</p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item  rewiew_blok">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p class="rewiev-text">"Наткнулась на MyParfumes случайно, в интернете много подобных сервисов, но не на русском языке. Тут мне понравилось больше всего. Администрация всегда чем-то дополняет сайт и в целом помогает нам более безопасно покупать и пользоваться брендовой продукцией, которую так часто подделывают."</p>
                                </div>
                                <div class="col-lg-12 text-center">
                                    <p>Алла М</p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item  rewiew_blok">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p class="rewiev-text">"У меня чувствительная кожа и косметику приходится подбирать только после тщательной проверки. Сайт помогает в этом. Мне нельзя допустить покупку некачественной косметики, поэтому я всегда заранее проверяю ее здесь."</p>
                                </div>
                                <div class="col-lg-12 text-center">
                                    <p>Инга Л</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 text-right">
                <img src="<?php echo INDEX;?>/images/lupe-parfume.png" class="lupe">
                <img src="<?php echo INDEX;?>/images/parfumere.jpg" class="people">
            </div>
        </div>
    </div>
</section>
<section class="info-section">
    <div class="container">
        <div class="col-lg-12">
            <h3 id="faq" class="text-center">Вопросы:</h3>
        </div>

        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-3">
                    <div class="accordion" id="accordionExample1">

                        <h4 class="lg-0">
                            <button class="btn btn-link text-center buton-info" type="button" data-toggle="collapse"
                                    data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Что такое батч-код парфюма?
                            </button>
                        </h4>

                        <h4 class="lg-0">
                            <button class="btn btn-link collapsed buton-info" type="button" data-toggle="collapse"
                                    data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Какую информацию может показать batch code?
                            </button>
                        </h4>
                        <h4 class="lg-0">
                            <button class="btn btn-link collapsed buton-info" type="button" data-toggle="collapse"
                                    data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Как я могу использовать идентификатор для определения подлинности?
                            </button>
                        </h4>
                        <h4 class="lg-0">
                            <button class="btn btn-link collapsed buton-info" type="button" data-toggle="collapse"
                                    data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Вдруг я обнаружу подделку, что делать?
                            </button>
                        </h4>
                        <h4 class="lg-0">
                            <button class="btn btn-link collapsed buton-info" type="button" data-toggle="collapse"
                                    data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                Как мне быстрее проверить правильность кода?
                            </button>
                        </h4>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="accordion" id="accordionExample">
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                             data-parent="#accordionExample">
                            <div class="card-body">
                                <p class="paragraph-section">Батч коды наносятся на продукцию и кодируются определенным образом, отображая сведения о годе выпуска. По ним можно определить конечный срок годности, а таже узнать просрочен ли товар.
                                </p>
                            </div>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                             data-parent="#accordionExample">
                            <div class="card-body">
                                <p class="paragraph-section">Сведения о периоде производства. Его детальность определяется алгоритмом, конкретным брендом, а также индивидуальными особенностями. Их влияние может меняться в зависимости от ситуации.
                                </p>
                            </div>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                             data-parent="#accordionExample">
                            <div class="card-body">
                                <p class="paragraph-section">Сама по себе batch идентификация не дает 100% гарантии на то, что Вам не продадут подделанные духи или туалетную воду.  Остается уповать на то, что при производстве контрафакта, злоумышленникам нет дела до сверки данных и многие их коды попросту не будут соответствовать правилам. Процедура работает только в совокупности методов анализа, начиная с внешней оценки.
                                </p>
                            </div>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                             data-parent="#accordionExample">
                            <div class="card-body">
                                <p class="paragraph-section">Вы можете написать претензию на имя директора торговой точки и потребовать вернуть средства назад. В качестве причин можно указать найденные в процессе проверки подлинности критерии. Любые конфликтные ситуации лучше решать через суд или общество защиты прав потребителей.
                                </p>
                            </div>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive"
                             data-parent="#accordionExample">
                            <div class="card-body">
                                <p class="paragraph-section"> Всего есть 2 пути решения: найти алгоритм расшифровки конкретной марки и просканировать все через специальные сервисы. Последний путь наиболее надежен, т.к дает меньше вероятности на ошибку.

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
<?php
require_once 'footer.php';
?>
<script>
    $("#carouselExampleControls").carousel({
        interval : false
    });
    $("#carouselExampleFade1").carousel({
        interval : 10000
    });
</script>
</html>