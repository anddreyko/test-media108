<?php
    include_once('#script.php');
    include_once('#three.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Алгоритм</title>
    </head>
    <body>
    <h1>Разбор и решение уравнений</h1>
    <h2>три переменные по пять значений</h2>
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
    </body>
</html>