
<aside>
                    <div class="aside-box">
                            <h2>Top Posts</h2>                                     
                            <ul>
                                <?php foreach($top_post_view as $item):?> 
                                <li><a href="single.php?post=<?=$item['id']?>"><?= $item['title']?> <small> <?= $item['view']." view"?></small></a></li>
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