<?php
require('./function.php');
if (authenticated()){
    logout();
}else{
    redirect('index.php');
}
?>