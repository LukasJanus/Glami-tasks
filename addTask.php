<?php
    require_once('vendor/autoload.php');

    $loader = new \Twig\Loader\FilesystemLoader('./templates');
    $twig = new \Twig\Environment($loader);

    if($_POST['send']){
        $a = strval(htmlspecialchars($_POST['num1']));        
        $b = strval(htmlspecialchars($_POST['num2']));
        $c = gmp_add($a, $b);
        
        echo $twig->render('addTask.twig', ['result'=>gmp_strval($c), 'a'=>$a, 'b'=>$b]);
    }else{
        echo $twig->render('addTask.twig', ['result'=>null, 'a'=>null, 'b'=>null]);
    }