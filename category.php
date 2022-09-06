<?php
header("Last-Modified: " . date("D, d M Y H:i:s", time()) . " GMT");
require_once './Admin/db-install.php';
require_once './Admin/db.php';
require_once './Admin/function.php';
$urls=$_SERVER['REQUEST_URI'];
$urls=trim($urls,"/");
$id=$urls;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<?php
require_once 'header.php';
category_info();
?>
    <?php
    foreach ($cat as $it)
    {?>
    <title><?php echo $it['title'];?></title>
    <meta name="description" content="<?php echo $it['description'];?>"> <?php } ?>
</head>
<body>
<header class="header-post">
    <div class="container">
        <?php
        require_once 'navigate.php';
?>
        <div class="row">
            <div class="col-lg-12">
                <div class="info-post">
                    <h1 class="post-header-title text-center"><?php echo $it['h1'];?></h1>
                    <p class="priview-header-title text-center"><?php echo $it['paragraph'];?></p>

                </div>
            </div>
        </div>
    </div>

</header>


<section class="content-section">
    <div class="container">
                <div class="row text-center">
                    <div class="col-lg-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb content-section-text">
                                <li class="breadcrumb-item"><a href="<?php echo INDEX;?>">Главная</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo $it['title']?></li>
                            </ol>
                        </nav>
                    </div>


                            <div class="col-lg-12 content-section-post">
                                <div class="row">
                                    <?php alphabet();?>
                                </div>
                            </div>
                </div>

    </div>
</section>
</body>
<?php
require_once 'footer.php';
?>
</html>
