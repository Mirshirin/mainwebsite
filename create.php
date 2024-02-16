<?php

require('./function.php');

if(! authenticated()) {
    redirect('login.php');
}

$user = get_user_data();

if($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['title']) and isset($_POST['category']) and isset($_POST['content']) ) {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $content = $_POST['content'];
    $image = $_FILES['image'];
    $errors = validate_post($title, $category, $content,$image);
    if(! count($errors)) {
        $posts = get_data('post');
        create_post($posts, $title, $category, $content,$image);
       // dd($posts);
        redirect('panel.php');
    }
}

?>

<html>
    <head>
    <head>
        <title>Panel</title>

        <link rel="stylesheet" href="<?= assts('css/style.css') ?>">
        <link rel="stylesheet" href="<?= assts('css/panel.css') ?>">
    </head>
    </head>
    <body>
        <main>
            <nav>
                <ul>
                    <li><a href="<?= BASE_URL ?>index.php">MainWebsite</a></li>
                    <li><a href="<?= BASE_URL ?>panel.php">Panel</a></li>
                    <li><a href="<?= BASE_URL ?>create.php">Create post</a></li>
                    <li><a href="<?= BASE_URL ?>logout.php">Logout</a></li>
                </ul>
                <ul>
                    <li><?= $user['name'] . ' ' . $user['family'] ?></li>
                </ul>
            </nav>
            <section class="content">
                <?php if(isset($errors) and count($errors)): ?>
                    <div class="errors">
                        <ul>
                            <?php foreach($errors as $error): ?>
                                <li><?= $error ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif ?>
                <form method="POST" enctype="multipart/form-data">
                    <div>
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" value="<?= isset($title)? $title : ''?>">
                    </div>
                    <div>
                        <label for="category">Category</label>
                        <select name="category" id="category">
                            <option value="political" <?= (isset($category) and $category == 'political')? 'selected' : '' ?>>Political</option>
                            <option value="sport" <?= (isset($category) and $category == 'sport')? 'selected' : '' ?>>Sport</option>
                            <option value="book" <?= (isset($category) and $category == 'book')? 'selected' : '' ?>>Book</option>
                        </select>
                    </div>
                    <div>
                        <label for="content">Content</label>
                        <textarea name="content" id="content" cols="30" rows="10"><?= isset($content)? $content : ''?></textarea>
                    </div>
                    <div>
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image">
                    </div>
                    <div>
                        <input type="submit" value="create post">
                    </div>
                </form>
            </section>
        </main>
    </body>
</html>