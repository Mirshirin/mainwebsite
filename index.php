<?php 
    require('./function.php');
    //dd(get_data('setting'));
    $setting=get_data('setting');
    $posts=get_data('post');
    //dd(get_data('post'));

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
            <header>
                <h1>Main Website</h1>
                <div id="logo">
                    <img src="<?= assts('images/logo.png')?>" alt="Gitmag">
                </div>
            </header>
            <nav>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About us</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Gallery</a></li>
                    <li><a href="#">Contact us</a></li>
                </ul>
                <form action="#" method="GET">
                    <input type="text" name="search" placeholder="Search your word">
                    <input type="submit" value="Search">
                </form>
            </nav>
            <section id="content">
                <aside>
                <div class="aside-box">
                        <h2>Top Posts</h2>                                     
                        <ul>
                            <?php foreach($posts as $item):?> 
                            <li><a href="#"><?= $item['title']?> <small> <?= $item['view']." view"?></small></a></li>
                            <?php endforeach ?>
                        </ul>
                   
                    </div>

                    <div class="aside-box">
                        <h2>Last Posts</h2>
                        <ul>
                            <li><a href="#">This is post 1</a></li>
                            <li><a href="#">This is post 2</a></li>
                            <li><a href="#">This is post 3</a></li>
                            <li><a href="#">This is post 4</a></li>
                            <li><a href="#">This is post 5</a></li>
                            <li><a href="#">This is post 6</a></li>
                            <li><a href="#">This is post 7</a></li>
                        </ul>
                    </div>

                    <div class="aside-box">
                        <h2>Best Posts</h2>
                        <ul>
                            <li><a href="#">This is post 1</a></li>
                            <li><a href="#">This is post 2</a></li>
                            <li><a href="#">This is post 3</a></li>
                            <li><a href="#">This is post 4</a></li>
                            <li><a href="#">This is post 5</a></li>
                            <li><a href="#">This is post 6</a></li>
                            <li><a href="#">This is post 7</a></li>
                        </ul>
                    </div>
                </aside>
                <div id="articles">
                    <?php foreach($posts as $post):?>
                    <article>
                        <div class="caption">
                            <h3>This is a post</h3>
                            <ul>
                                <li>Date: <span>2020-05-15</span></li>
                                <li>Views: <span>1526 view</span></li>
                            </ul>
                            <p><?= get_excerpt($post['content'])?>
                            </p>
                            <a href="#">More...</a>
                        </div>
                        <div class="image">
                            <img src="<?= assts('images/gitmag.jpg')?>" alt="This is a post">
                        </div>
                        <div class="clearfix"></div>
                    </article>
                    <?php endforeach ?>
                    <article>
                        <div class="caption">
                            <h3>This is a post</h3>
                            <ul>
                                <li>Date: <span>2020-05-15</span></li>
                                <li>Views: <span>1526 view</span></li>
                            </ul>
                            <p>
                                In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.
                            </p>
                            <a href="#">More...</a>
                        </div>
                        <div class="image">
                            <img src="<?= assts('images/gitmag.jpg')?>" alt="This is a post">
                        </div>
                        <div class="clearfix"></div>
                    </article>
                    <article>
                        <div class="caption">
                            <h3>This is a post</h3>
                            <ul>
                                <li>Date: <span>2020-05-15</span></li>
                                <li>Views: <span>1526 view</span></li>
                            </ul>
                            <p>
                                In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.
                            </p>
                            <a href="#">More...</a>
                        </div>
                        <div class="image">
                            <img src="<?= assts('images/gitmag.jpg')?>" alt="This is a post">
                        </div>
                        <div class="clearfix"></div>
                    </article>
                    <article>
                        <div class="caption">
                            <h3>This is a post</h3>
                            <ul>
                                <li>Date: <span>2020-05-15</span></li>
                                <li>Views: <span>1526 view</span></li>
                            </ul>
                            <p>
                                In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.
                            </p>
                            <a href="#">More...</a>
                        </div>
                        <div class="image">
                            <img src="<?= assts('images/gitmag.jpg')?>" alt="This is a post">
                        </div>
                        <div class="clearfix"></div>
                    </article>
                    <article>
                        <div class="caption">
                            <h3>This is a post</h3>
                            <ul>
                                <li>Date: <span>2020-05-15</span></li>
                                <li>Views: <span>1526 view</span></li>
                            </ul>
                            <p>
                                In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.
                            </p>
                            <a href="#">More...</a>
                        </div>
                        <div class="image">
                            <img src="<?= assts('images/gitmag.jpg')?>" alt="This is a post">
                        </div>
                        <div class="clearfix"></div>
                    </article>
                </div>
                <div class="clearfix"></div>
            </section>
            <footer>
                <p>Copyright <a href="#">Gitmag</a></p>
            </footer>
        </main>
    </body>
</html>