 <div class="col-lg-12 soc-icon text-center">
     <?php
     $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
     $soc_text= $info_post['title'];
     ?>
                <p class="text-center">Соц.Сети:
                    <a href="https://vk.com/share.php?url=<?php echo $url;?>&amp;title=<?php echo $soc_text;?>&amp;"><img src="<?php echo INDEX;?>/images/vk-icon.png"class="vk-icon-post" alt="Иконка ВКонтакте"></a>
                    <a href="https://connect.ok.ru/offer?url=<?php echo $url?>&amp;title=<?php echo $soc_text?>&amp;"><img src="<?php echo INDEX;?>/images/ok-icon.png" class="fb-icon" alt="Иконка Одноклассники"></a>
                    <a href="https://t.me/share/url?url=<?php echo $url?>&amp;text=<?php echo $soc_text?>&amp;"><img src="<?php echo INDEX;?>/images/tg-icon.png" class="tg-icon" alt="Иконка Телеграм"></a>
                    <a href="https://twitter.com/intent/tweet?text=<?php echo $soc_text?>&amp;url=<?php echo $url?>&amp;"><img src="<?php echo INDEX;?>/images/tw-icon.png" class="tw-icon" alt="Иконка Твиттера"></a></p>
</div>