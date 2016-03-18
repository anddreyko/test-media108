<?php
function Ariphmetic($arr,$exp){
    $countArr = 0;
    $isEqualArrs=false;
    $parse;
    //выясняем равность количества элементов в массивах с данными
    foreach($arr as $a){
        if($isEqualArrs&&$countArr!=count($a)){
            $isEqualArrs=false;
            break;
        }
        $countArr=count($a);
        $isEqualArrs=true;
    }
    if($isEqualArrs){
        $parse = new Main();
        // строительство дерева классов
        $parse->Build($exp);
        for($i=0;$i<$countArr;$i++){
            $var=array();
            $prov='';
            foreach($arr as $k=>$a){
                $var[$k]=$a[$i];
                $prov.=$k.': '.$a[$i].'; ';
            }
            //решаем и выводим ответ
            echo $exp.' = '.$parse->Calculate($var).'<br> при: '.$prov.'<br><br>';
        }
    }
    else{
        echo 'error: arrays are different sizes ';
    }
}
?>