<?php 

spl_autoload_register(function($className){
    // className = Controllers\Article;
    // require = libraries/controllers/article.php;
    $className = str_replace("\\", "/", $className);
    $className = strtolower($className);    
    require_once("libraries/$className.php");

})

?>