<?php 

    session_start();

    date_default_timezone_set('America/Sao_Paulo');

    require('./vendor/autoload.php');

    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");

    use DankiCode\Views\Application;

    define ('INCLUDE_PATH_STATIC','http://localhost/Azulibre-Rede/DankiCode/Views/pages/');
    define ('INCLUDE_PATH','http://localhost/Azulibre-Rede/');
    
    $app = new Application(); 

    $app->run();
    
?>