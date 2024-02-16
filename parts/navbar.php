
<nav>
    <ul>
        <li><a href="<?= BASE_URL ?>">Home</a></li>
        <li><a href="<?= BASE_URL ?>category.php?category=political">Political</a></li>
        <li><a href="<?= BASE_URL ?>category.php?category=book">Books</a></li>
        <li><a href="<?= BASE_URL ?>category.php?category=sport">Sports</a></li>
        <?php if (authenticated()): ?>
        <li><a style="color:red" href="<?= BASE_URL ?>panel.php">Panel</a></li>
        <?php else :?>
        <li><a style="color:red" href="<?= BASE_URL ?>login.php">Login</a></li>
        <?php endif ?>    

    </ul>
    <form action="search.php" method="GET">
    <input type="text" name="search" placeholder="Search your word" value="<?= isset($_GET['search'])? $_GET['search'] : '' ?>">
    <input type="submit" value="Search">
    </form>
</nav>