<?php

require('./function.php');

if(! authenticated()) {
    redirect('login.php');
}

if(! isset($_GET['id'])) {
    redirect('panel.php');
}

$id = $_GET['id'];
$posts = get_data('post');
$post = get_id($posts, $id);

if(is_null($post)) {
    redirect('panel.php');
}

$user = get_user_data();
if($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['title']) and isset($_POST['category']) and isset($_POST['content']) and isset($_FILES['image'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $image = $_FILES['image'];
    $errors = validate_edit_post($title, $category, $content, $image);
    if(count($errors) == 0) {
        $posts = get_data('post');
        edit_post($posts, $id, $title, $category, $content, $image);
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
                    <li><a href="<?= BASE_URL ?>index.php">Wbsite</a></li>
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
                        <input type="text" name="title" id="title" value="<?= $post['title'] ?>">
                    </div>
                    <div>
                        <label for="category">Category</label>
                        <select name="category" id="category">
                            <option value="political" <?= ($post['category'] == 'political')? 'selected' : '' ?>>Political</option>
                            <option value="sport" <?= ($post['category'] == 'sport')? 'selected' : '' ?>>Sport</option>
                            <option value="book" <?= ($post['category'] == 'book')? 'selected' : '' ?>>Book</option>
                        </select>
                    </div>
                    <div>
                        <label for="content">Content</label>
                        <textarea name="content" id="content" cols="30" rows="10"><?= $post['content'] ?></textarea>
                    </div>
                    <div>
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image">
                        <img src="<?= assts($post['image']) ?>" alt="">
                    </div>
                    <div>
                        <input type="submit" value="edit post">
                    </div>
                </form>
            </section>
        </main>
    </body>
</html>