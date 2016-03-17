<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Алгоритм</title>
    </head>
    <body>
    <h1>Разбор и решение уравнений</h1>
<?php
    include_once('#script.php');
    Ariphmetic(
        Array(1,2,2.3,4.9,-5)    //a
      , Array(1,2.5,3,7.9,9)    //b    
      , Array(5.5,4.5,4,5,2)    //c
      , '5*a^2+3*b+c+1'
    );
?>
    </body>
</html>