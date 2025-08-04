<?php
    $str = "\n O PHP foi criado em mil novecentos e noventa e cinco";
    echo "\n Palavra Original", $str; 
    $str = str_replace(['o','a','i'],['0','4','1'],$str);
    /* ou
    $str = str_replace("o","0",$str);
    $str = str_replace("a","4",$str);
    $str = str_replace("i","1",$str);
    */
    echo "\n Depois das Alterações",$str;
    ?>

