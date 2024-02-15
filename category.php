<?php
require('./function.php');

if (!isset($_GET['category'])){
    redirect('index.php');
}
$category=$_GET['category'];

$setting = get_data('setting');
$posts = get_data('post');
$category_post=get_category($posts,$category);
$top_post_view=get_post_by_view($posts);

?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="This is a gitmag website">
        <meta name="keyword" content="<?= $setting['keywords']?>">
        <meta name="author" content="<?= $setting['author']?>">

        <title><?= $setting['title']?></title>
        <link rel="stylesheet" href="<?= assts('css/style.css')?>">
    </head>
    <body>
        <main>
            <?php require('./parts/header.php') ?>            
            <?php require('./parts/navbar.php') ?>

            <section id="content">
            <?php require('./parts/asides.php') ?>

                <?php if ($category_post):?>    
                    <div id="articles">  
                        <?php foreach($category_post as $post):?>
                            <article>
                                <div class="caption">
                                    <h3><?=$post['title']?></h3>
                                    <ul>
                                        <li>Date: <span>2020-05-15</span></li>
                                        <li>Views: <span>1526 view</span></li>
                                    </ul>
                                    <p><?= get_excerpt($post['content'])?>
                                    </p>
                                    <a href="single.php?post=<?= $post['id']?>">More...</a>
                                </div>
                                <div class="image">
                                    <img src="<?= assts('images/gitmag.jpg')?>" alt="This is a post">
                                </div>
                                <div class="clearfix"></div>
                            </article>
                        <?php endforeach ?>
                    </div>
                <?php else : ?>
                    <div id="article">
                        There is not any data for choosing your category!
                    </div>
                <?php endif ?>   
                    <div class="clearfix"></div>
            </section>
            <?php require('./parts/footer.php') ?> 
        </main>
    </body>
</html>