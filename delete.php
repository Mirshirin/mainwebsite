<?php

require('./function.php');
 if (! authenticated()){
        redirect('login.php');
    }

if (!isset($_GET['id'])){
    redirect('panel.php');

}


$id=$_GET['id'];
$posts=get_data('post');
if (!get_id($posts,$id) ){
    redirect('panel.php');

}
 delete_post($posts,$id);
 redirect('panel.php');

?>