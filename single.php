<?php
    require('./function.php');
    if (!isset($_GET['post'])){
        redirect("index.php");

    }
    $setting=get_data('setting');
    $posts=get_data('post');
    $id=$_GET['post'];
    $post=get_id($posts,$id);
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
                <div id="articles">
                    <?php if ($post !=null):?>
                        <article>
                            <div class="caption">
                                <h3><?=$post['title']?></h3>
                                <ul>
                                    <li>Date: <span>2020-05-15</span></li>
                                    <li>Views: <span>1526 view</span></li>
                                </ul>
                                <p><?= $post['content']?>
                                </p>
                            </div>
                            <div class="image">
                                <img src="<?= assts('images/gitmag.jpg')?>" alt="This is a post">
                            </div>
                            <div class="clearfix"></div>
                        </article>   
                    <?php else:?>
                        <article>
                            <strong>404</strong>Does not exist any text.
                        </article>
                    <?php endif ?>   
                </div>
                <div class="clearfix"></div>
            </section>
            <?php require('./parts/footer.php') ?> 
        </main>
    </body>
</html>