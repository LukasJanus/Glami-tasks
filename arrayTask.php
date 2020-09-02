<?php
    require_once('vendor/autoload.php');
    require_once ('class/workWithArrayClass.php');
    $loader = new \Twig\Loader\FilesystemLoader('./templates');
    $twig = new \Twig\Environment($loader);
    
    if($_POST['send']){
        $dimensions = htmlspecialchars($_POST['dimensions']);
        $size = htmlspecialchars($_POST['size']);
        if(!is_numeric($dimensions) && $dimensions <= 0){
            $dimensions = 0;
        }
        if(!is_numeric($size) && $size <= 0){
            $size = 0;
        }
    $arrayClass = new workWithArray($size,$dimensions);
    $arrayClass->setArray()
               ->setSimplifiedArray();
    echo $twig->render('arrayTask.twig', ['array' => $arrayClass->getArray(), 'minValue' => $arrayClass->getMinVal(), 'maxValue' => $arrayClass->getMaxVal(), 'dimensions'=>$dimensions, 'size'=>$size]);
    }else{
    echo $twig->render('arrayTask.twig', ['array' => [], 'minValue' => 0, 'maxValue' => 0, null, null]);   
    }
       
        