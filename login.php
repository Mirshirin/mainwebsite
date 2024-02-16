<?php
require('./function.php');
if (authenticated()){
    redirect('panel.php');
}
if ($_SERVER["REQUEST_METHOD"] == 'POST' and isset($_POST['email']) and isset($_POST['password'])){ 
    $errors=[];  
    $email=$_POST['email'];
    $password= $_POST['password'];
    $errors=validate_login($email,$password);
    if (! count($errors)){
        $users=get_data('users');
        $user=login($users,$email,$password);
        if ($user){            
            $_SESSION['user']=$user;
            redirect('panel.php');
        }else{
            $errors[]='Invalid credentioal';
        }
    }
    
}

?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="This is a gitmag website">
        <meta name="keyword" content="<?= $setting['keywords']?>">
        <meta name="author" content="<?= $setting['author']?>">
        <title><?= $setting['title']?></title>
        <link rel="stylesheet" href="<?= assts('css/style.css')?>">
        <link rel="stylesheet" href="<?= assts('css/panel.css')?>">

    </head>
    <body>
        <main>
        <form method='post'>
                <div class="login">
                    <h3>Login to page </h3>
                    <?php if(isset($errors) and count($errors)):?>
                        <div class="errors">
                            <ul>
                                <?php foreach($errors as $error):?>
                                    <li><?= $error ?></li>
                                <?php endforeach?>

                            </ul>
                        </div>
                    <?php endif ?>
                    <div>
                        <label for="email">Email:</label>
                        <input type="text" id="email" name="email" value="<?= isset($email) ? $email : '' ?>">
                    </div>
                    <div>
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password">
                    </div>
                    <div>
                        <input type="submit" value="Login">
                    </div>

                </div>
           </form>
        </main>
    </body>
</html>