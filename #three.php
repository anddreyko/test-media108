<?php
class Main {
    // массив объектов дерева
    var $arNode = Array();
    // расчет значения с учетом параметров
    public function Calculate($a, $b, $c){
        if($a)
            foreach ($this->arNode as $obj){
                if($obj->const == 'a'){
                    $obj->var = $a;
                    break;
                }
            }
        if($b)
            foreach ($this->arNode as $obj){
                if($obj->const == 'b'){
                    $obj->var = $b;
                    break;
                }
            }
        if($c)
            foreach ($this->arNode as $obj){
                if($obj->const == 'c'){
                    $obj->var = $c;
                    break;
                }
            }
        foreach ($this->arNode as $obj)
            if(!$obj->parent)
                return $obj->Calculate();
    }
    // строительство дерева
    public function Build ($str) {  
        // массив объектов дерева
        $arNode = Array();
        // предварительные операции с входной строкой
        function parse ($str){
            // подготовка входного выражения к парсингу
            $str = mb_strtolower($str, 'UTF-8');
            $str = str_replace(' ', '', $str);
            $n = mb_strlen($str, 'UTF-8');
            $arStr = preg_split('/(?!^)(?=.)/u', $str);
            // преобразуем массив символов в массив слов
            $j=0;
            $accum = $arStr[0];
            for($i=1; $i<$n+1; ++$i){
                if ($i==$n+1){
                    $arLec[$j] = $accum;
                    break;
                }
                if($accum=='-' && $i==1){
                    if(preg_match('/\d/', $arStr[$i])){
                        $accum = $accum.$arStr[$i];
                    }
                    if($arStr[$i]=='('){
                        $arLec[$j] = '0';
                        $arLec[++$j] = '-';
                        ++$j;
                        $accum = $arStr[$i];
                    }
                    continue;
                }
                if($accum=='-' && $arLec[$j-1]=='('){
                    $accum = $accum.$arStr[$i];
                    continue;
                }
                if(!(isset($arStr[$i])&&null!=$arStr[$i]))
                    $arStr[$i]='';
                if (preg_match('/^[\d.]/', $accum) && preg_match('/^[\d.]/', $arStr[$i])){
                    $accum = $accum.$arStr[$i];
                }else{
                    $arLec[$j] = $accum;
                    ++$j;
                    $accum = $arStr[$i];
                }
            }
            return $arLec;
        }
        // построение узла
        function objBuild($point){
            static $arNumNode = Array(
                'addition' => 1,
                'subtraction' => 1,
                'pow' =>1,
                'multiplication' => 1,
                'division' => 1,
                'number' => 1,
                'constant' => 1);
            switch ($point){
                case '+': $name = 'Plus'.$arNumNode['addition'];
                    $node = new Plus($name);
                    ++$arNumNode['addition'];
                    break;
                case '-': $name = 'Minus'.$arNumNode['subtraction'];
                    $node = new Minus($name);
                    ++$arNumNode['subtraction'];
                    break;
                case '*': $name = 'Multiply'.$arNumNode['multiplication'];
                    $node = new Multiply($name);
                    ++$arNumNode['multiplication'];
                    break;
                case '/': $name = 'Fission'.$arNumNode['division'];
                    $node = new Fission($name);
                    ++$arNumNode['division'];
                    break;
                case '^': $name = 'Pow'.$arNumNode['pow'];
                    $node = new Pow($name);
                    ++$arNumNode['pow'];
                    break;
                case 'a': $name = 'Constant'.$arNumNode['constant'];
                    $node = new Constant($name);
                    $node->const = 'a';
                    $node->var = 0;
                    ++$arNumNode['constant'];
                    break;
                case 'b': $name = 'Constant'.$arNumNode['constant'];
                    $node = new Constant($name);
                    $node->const = 'b';
                    $node->var = 0;
                    ++$arNumNode['constant'];
                    break;
                case 'c': $name = 'Constant'.$arNumNode['constant'];
                    $node = new Constant($name);
                    $node->const = 'c';
                    $node->var = 0;
                    ++$arNumNode['constant'];
                    break;
                default: $name = 'Variable'.$arNumNode['number'];
                    $node = new Variable($name);
                    $node->var = $point;
                    ++$arNumNode['number'];
            }
            return $node;                    
        }
        // строительство тройки объектов дерева
        function trioBuild($topLec, $leftLec, $rightLec, $topP, $leftP, $rightP, $topObj){
            // вершина
            if(!$topObj){
                $topTrio = objBuild($topP);
                $topTrio->lec = $topLec;
            }  else
                $topTrio = $topObj;
            // левые узлы
            $leftTrio = objBuild($leftP);
            $leftTrio->lec = $leftLec;
            // правые узлы
            $rightTrio = objBuild($rightP);
            $rightTrio->lec = $rightLec;
            // формирование узла
            $topTrio->childrenLeft = $leftTrio;
            $topTrio->childrenRight = $rightTrio;
            $leftTrio->parent = $topTrio;
            $rightTrio->parent = $topTrio;
            if(!$topObj){
                $trio = Array($topTrio, $leftTrio, $rightTrio);
                return $trio;
            }  else {
                $duo = Array($leftTrio, $rightTrio);
                return $duo;
            }
        }
        // проверка на полное построение дерева
        function stopBuild($arNode){
            foreach ($arNode as $obj){
                if(!(isset($obj->lec[1])&&null!=$obj->lec[1]))
                    $obj->lec[1]='';
                if(!(isset($obj->childrenLeft)&&null!=$obj->childrenLeft))
                    $obj->childrenLeft='';
                if(!(isset($obj->childrenRight)&&null!=$obj->childrenRight))
                    $obj->childrenRight='';
                if($obj->lec[1] && !$obj->childrenLeft && !$obj->childrenRight)
                    return false;
            }
            return true;
        }
        // поиск вершины для следующего уровня узлов текущей ветки
        function searchObj($arNode){
            foreach ($arNode as $obj)
                if($obj->lec[1] && !$obj->childrenLeft && !$obj->childrenRight)
                    return $obj;
        }
        // нахождение оператора
        function currOperator($lec){
            $oper=0;
            $max=0;
            static $br = 0;
            static $arPrioritet = Array(
                '+' => 3,
                '-' => 3,
                '*' => 2,
                '/' => 2,
                '^' => 1);
            foreach ($lec as $key=>$value){
                if(preg_match('/^[\d.]/', $value)){
                    continue;
                }
                if($value=='('){
                    ++$br;
                    continue;
                }
                if($value==')'){
                    --$br;
                    continue;
                }
                if(!(isset($arPrioritet[$value])&&null!=$arPrioritet[$value]))
                    $arPrioritet[$value]='';
                if($arPrioritet[$value]-3*$br >= $max){
                    $max=$arPrioritet[$value]-3*$br;
                    $oper=$key;
                }
            }
            return $oper;
        }
        $arLec = parse($str);
        // корень
        $topN = currOperator($arLec);
        $topP = $arLec[$topN];
        $leftLec = array_slice($arLec, 0, $topN);
        if(!(isset($leftLec[0])&&null!=$leftLec[0]))
            $leftLec[0]='';
        if(!(isset($leftLec[count($leftLec)-1])&&null!=$leftLec[count($leftLec)-1]))
            $leftLec[count($leftLec)-1]='';
        if($leftLec[0]=='(' && $leftLec[count($leftLec)-1]==')'){
            array_shift($leftLec);
            array_pop($leftLec);
        }
        $rightLec = array_slice($arLec, $topN+1);
        if(!(isset($rightLec[0])&&null!=$rightLec[0]))
            $rightLec[0]='';
        if(!(isset($rightLec[count($rightLec)-1])&&null!=$rightLec[count($rightLec)-1]))
            $rightLec[count($rightLec)-1]='';
        if($rightLec[0]=='(' && $rightLec[count($rightLec)-1]==')'){
            array_shift($rightLec);
            array_pop($rightLec);
        }
        $leftN = currOperator($leftLec);
        //непоняточки
        $leftP = $leftLec[$leftN];
        $rightN = currOperator($rightLec);
        //непоняточки
        $rightP = $rightLec[$rightN];                
        $trio = trioBuild($arLec, $leftLec, $rightLec, $topP, $leftP, $rightP, NULL);
        $arNode = $trio;
        // дети
        while (!stopBuild($arNode)){
                $topTrio = searchObj($arNode);
                $arLec = $topTrio->lec;
                $topN = currOperator($arLec);    
                $leftLec = array_slice($arLec, 0, $topN);
                if($leftLec[0]=='(' && $leftLec[count($leftLec)-1]==')'){
                    array_shift($leftLec);
                    array_pop($leftLec);
                }
                $rightLec = array_slice($arLec, $topN+1);
                if($rightLec[0]=='(' && $rightLec[count($rightLec)-1]==')'){
                    array_shift($rightLec);
                    array_pop($rightLec);
                }
                $leftN = currOperator($leftLec);
                $leftP = $leftLec[$leftN];
                $rightN = currOperator($rightLec);
                $rightP = $rightLec[$rightN];                
                $duo = trioBuild(NULL, $leftLec, $rightLec, NULL, $leftP, $rightP, $topTrio);
                $arNode = array_merge($arNode, $duo);
        }
        $this->arNode = $arNode;
    }
}
abstract class Obj {
    public $name;
    public $childrenLeft;
    public $childrenRight;
    public $parent;
    public $lec;
    public $const;
    public $var;
    public function __construct($name) {
        $this->name = $name;
    }
    abstract function Calculate();
}
class Plus extends Obj {
    public function Calculate() {
        return $this->childrenLeft->Calculate()+$this->childrenRight->Calculate();
    }
}
class Minus extends Obj {
    public function Calculate() {
        return $this->childrenLeft->Calculate()-$this->childrenRight->Calculate();
    }
}
class Multiply extends Obj {
    public function Calculate() {
        return $this->childrenLeft->Calculate()*$this->childrenRight->Calculate();
    }
}
class Fission extends Obj {
    public function Calculate() {
        return $this->childrenLeft->Calculate()/$this->childrenRight->Calculate();
    }
}
class Pow extends Obj {
    public function Calculate() {
        return pow ($this->childrenLeft->Calculate(), $this->childrenRight->Calculate());
    }
}
class Constant extends Obj {
    public function Calculate() {
        return $this->var;
    }
}
class Variable extends Obj {
    public function Calculate() {
        return $this->var;
    }
}
?>