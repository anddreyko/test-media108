# test-media108
<h1>Тестовое задание</h1>
Написать PHP функцию/метод который выполняет арифметическое действие над соответствующими элементами 2 массивов (если N массивами - это будет очень круто). 
Арифметическое действие может быть комплексное, например: 100 *(а4 + б4)/ (а4*б4) - при этом схему арифметического действия формировать шаблоном (придумать этот шаблон) входящим параметром функции/метода

например: если переданы array Arifmetic(Array(1,2,3), Array(5,4,4), ‘100*(a+b)/(a*b)’)
результатом должен быть массив:
Array(
120,
75,
58,3333
)

<h2>Описание</h2>
<ul><li>в файле index.php находятся исходные данные и вызов функции Ariphmetic</li>
<li>в файле #script.php находится описание функции Ariphmetic</li>
<li>в файле #three.php классы, содержащие методы по хранению и построению дерева, а также "считающие" результат</li></ul>
Функция Ariphmetic принимет в себя параметры: ассоциативный массив, где ключи это обозначения переменных и строка с уравнением.
<h2>примеры вызывающего кода</h2>
<h2>две переменные по три значения</h2>
    <pre>
    Ariphmetic(
        array(
            'a'=>array(1,2,3)           //a
          , 'b'=>array(5,4,4)           //b
        )
      , '100*(a+b)/(a*b)'               //expression
    );
    </pre>
100*(a+b)/(2*2) = 150<br> при: a: 1; b: 5; <br><br>100*(a+b)/(2*2) = 150<br> при: a: 2; b: 4; <br><br>100*(a+b)/(2*2) = 175<br> при: a: 3; b: 4; <br><br>    <h2>три переменные по пять значений</h2>
    <pre>
    Ariphmetic(
        array(
            'a'=>array(1,2,2.3,4.9,-5)  //a
          , 'b'=>array(1,2.5,3,7.9,9)   //b
          , 'c'=>array(5.5,4.5,4,5,2)   //c
        )
      , '5*a^2+3*b+c+1'                 //expression
    );
    </pre>
5*a^2+3*b+c+1 = 14.5<br> при: a: 1; b: 1; c: 5.5; <br><br>5*a^2+3*b+c+1 = 33<br> при: a: 2; b: 2.5; c: 4.5; <br><br>5*a^2+3*b+c+1 = 40.45<br> при: a: 2.3; b: 3; c: 4; <br><br>5*a^2+3*b+c+1 = 149.75<br> при: a: 4.9; b: 7.9; c: 5; <br><br>5*a^2+3*b+c+1 = 155<br> при: a: -5; b: 9; c: 2; <br><br>    <h2>одна переменная по три значения</h2>
    <pre>
    Ariphmetic(
        array(
            'u'=>array(1,2,2.3)         //u
        )
      , 'u+2'                           //expression
    );
    </pre>
u+2 = 3<br> при: u: 1; <br><br>u+2 = 4<br> при: u: 2; <br><br>u+2 = 4.3<br> при: u: 2.3; <br><br>    <h2>одна переменная по одному значению</h2>
    <pre>
    Ariphmetic(
        array(
            'x'=>array(0)               //x
        )
      , 'x*5'                           //expression
    );
    </pre>
x*5 = 0<br> при: x: 0; <br><br>    
