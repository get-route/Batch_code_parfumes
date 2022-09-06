<?php
header('Content-Type: application/xml; charset=utf-8');
require_once 'Admin/db-install.php';
require_once 'Admin/db.php';
require_once 'Admin/function.php';
$url_str="https://myparfumes.ru/";

echo "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">";
?>
<?php
db_cat();
foreach ($cat as $row)
{

    echo "<url>"."\n";
    echo "<loc>".$url_str.$row['url']."</loc>"."\n";
    echo "<priority>1</priority>"."\n";
    echo "</url>"."\n";

}
?>
<?php
more_post_sitemap();
foreach ($table_posts as $item)
{

    echo "<url>"."\n";
    echo "<loc>".$url_str.$item['category_id']."/".$item['url']."</loc>"."\n";
    echo "<changefreq>weekly</changefreq>"."\n";
    echo "<priority>0.7</priority>"."\n";
    echo "</url>"."\n";

}
?>
<?php echo "</urlset>";?>