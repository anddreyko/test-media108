<?php
    include_once('#script.php');
    include_once('#three.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Разбор и решение уравнений</title>
    </head>
    <body>
    <h1>Разбор и решение уравнений</h1>
    <h2>две переменные по три значения</h2>
    <pre>
    Ariphmetic(
        array(
            'a'=>array(1,2,3)           //a
          , 'b'=>array(5,4,4)           //b
        )
      , '100*(a+b)/(2*2)'               //expression
    );
    </pre>
<?php
    Ariphmetic(
        array(
            'a'=>array(1,2,3)           //a
          , 'b'=>array(5,4,4)           //b
        )
      , '100*(a+b)/(2*2)'               //expression
    );
?>
    <h2>три переменные по пять значений</h2>
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
<?php
    Ariphmetic(
        array(
            'a'=>array(1,2,2.3,4.9,-5)  //a
          , 'b'=>array(1,2.5,3,7.9,9)   //b
          , 'c'=>array(5.5,4.5,4,5,2)   //c
        )
      , '5*a^2+3*b+c+1'                 //expression
    );
?>
    <h2>одна переменная по три значения</h2>
    <pre>
    Ariphmetic(
        array(
            'u'=>array(1,2,2.3)         //u
        )
      , 'u+2'                           //expression
    );
    </pre>
<?php
    Ariphmetic(
        array(
            'u'=>array(1,2,2.3)         //u
        )
      , 'u+2'                           //expression
    );
?>
    <h2>одна переменная по одному значению</h2>
    <pre>
    Ariphmetic(
        array(
            'x'=>array(0)               //x
        )
      , 'x*5'                           //expression
    );
    </pre>
<?php
    Ariphmetic(
        array(
            'x'=>array(0)               //x
        )
      , 'x*5'                           //expression
    );
?>
    </body>
</html>