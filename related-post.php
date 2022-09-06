<?php
require_once './Admin/db-install.php';
require_once './Admin/db.php';
require_once './Admin/function.php';
?>
<noindex>
<div class="container">
    <div class="col-lg-12">
        <h3 class="text-center">Последние записи</h3>
    </div>
<div class="col-lg-12">
    <div class="row">
        <?php
        related_index_post();
        foreach ($related_posts as $rel){
        ?>
        <div class="col-lg-4 kards-telated">
            <a href="<?php echo $rel ['url']?>"><img src="<?php echo INDEX;?>/images/<?php echo $rel ['image']?>" class="related-image" alt="<?php echo $rel ['image_alt']?>">
            <h4><?php echo $rel ['title']?></h4></a>
        </div>
        <?php }?>
    </div>
</div>
</div>
</noindex>