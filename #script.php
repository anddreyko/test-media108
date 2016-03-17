<?php
include_once('#three.php');
$globalargs = array();
function Ariphmetic(){
    $arRes=array();
    $arArgs = func_get_args();
    $countArgs = func_num_args();
    $countArr = count(func_get_arg(0));
    $isEqualArrs=true;
    //выясняем равность количества элементов в массивах с данными
    for($i=1;$i<$countArgs-1;$i++){
        if($countArr!=count(func_get_arg($i))){
            $isEqualArrs=false;
            break;
        }
    }
    if($isEqualArrs){
        $parse = new Main();
        // задаем исходное математическое выражение
        $str = (func_get_arg($countArgs-1));
        // строительство дерева классов
        $parse->Build($str);
        for($i=0;$i<$countArr;$i++){
            $a = func_get_arg(0)[$i];
            $b = func_get_arg(1)[$i];
            $c = func_get_arg(2)[$i];
            //решаем
            echo $str.' = '.$parse->Calculate($a, $b).'<br>';

            echo ' при: a='.$a.'; b='.$b.'; c='.$c.'<br>'.'<br>';
        }
    }
    else{
        echo 'error: arrays are different sizes ';
    }
}
?>