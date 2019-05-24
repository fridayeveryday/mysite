   <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <title>Дискретная математика</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Sonsie+One" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/styles/styleDiscreteMathLaba4.css">
    <link rel="stylesheet" href="/styles/menu.css">
<!--    <script src="/scripts/saveRadio.js"></script>-->

  </head>

  <body>
    <div id="logo">
        <a href="index.html"></a>
    </div>
          <nav>
              <input type="checkbox" id="menuCheck"><label for="menuCheck">
              <div id="picopmenu">Меню
              </div></label>
              <ul class="menu">
                  <li><a href="index.html">Главная</a></li>
                  <li><a href="gallery.html">Галерея</a></li>
                  <li id="active"><a href="discreteMathematics.html">Дискретная математика</a></li>
                  <li><a href="Game.php">Игра</a></li>
                  <li><a href="authorization.php">Авторизация</a></li>
              </ul>
            </nav>
    <?php
    /** Функция формаирования двумериного массива из textarea
     * @param $string - входная строка из textarea
     * @return array - двумерный массив, матрица смежности
     */
    function forming2dArray($string){
        $string = trim($string," ");
        $string = explode("\r\n", $string);
        for($i = 0; $i < count($string); $i++){
            $string[$i] = trim($string[$i]," ");
            $string[$i] = explode(" ", $string[$i]);
        }
        return $string;
    }



    /** Функция на проверку положителдьных значений в матрице и нулевую главную диагональ
     * @param $array
     * @return bool
     */
    function checkArray($array){
        for($i = 0; $i < count($array); $i++){
            for($j = 0; $j < count($array); $j++){
                if($array[$i][$j] < 0){
                    return false;
                }
            }
            if($array[$i][$i] != 0 ){
                return false;
            }
        }
        return true;
    }

    /** Функция для нахождения минимальногой по длине машрута и запись его в соответсвующие переменные
     * @param $num - номер найденного маршрута
     * @param $length - его длина
     * @param $string - последовательность вершин
     * @return void
     */
    function findMin($num, $length, $string){
        global $minLengthOfRoute;
        global $minLettersOfRoute;

        if($num == 0){
            $minLengthOfRoute = $length;
            $minLettersOfRoute = $string;
        }else{
            if($length < $minLengthOfRoute){
                $minLengthOfRoute = $length;
                $minLettersOfRoute = $string;
            }
        }
    }

    /** Функция для записи найденного маршрута в глобальные массивы длины и псоледовательности вершин
     * @param $length - длина маршрута
     * @param $string - строка вершин маршрута
     * @return void
     */
    function f($length, $string){
        global $arrayOfRoutes;
        global $globalCount;
        global $arrayOfLengthRoutes;

        $ind = $globalCount;
        $arrayOfLengthRoutes[$ind] = $length;
        $arrayOfRoutes[$ind] = $string;
        findMin($ind, $length, $string);
        $globalCount++;

    }

    /** Функия для прохождения всей матрицы смежности в поисках машрута
     * @param $i - i-ая строка вершины, с которой начинается или продолжается поиск
     * @param $j - j-ая столбец вершины, с которой начинается или продолжается поиск
     * @param $length - длина пройденного маршрута
     * @param $someString - строка вершин пройденного маршрута
     * @param $someArray - матрица смежности
     * @param $someStringOfLetters - строка всех вершин графа
     */
    function g($i, $j, $length, $someString, $someArray, $someStringOfLetters){ //сделать конкатенацию length  на входе в фугкцию, чтоб начинался со стартовой точки
        if(checkReturn2ExPoint($someString)){
            return;
        }
        global $numEndPoint;
        $heightArray = count($someArray);
        $widthArray = count($someArray[0]);
        if (($i == $heightArray) || ($i == $numEndPoint)){// размерность массива 3x3 // пройтись надо по всему массиву
            return;
        }else{
            if($j == $widthArray){// размерность массива
                return;
            }else{
                if($j != $widthArray){
                    g($i,$j + 1, $length, $someString, $someArray, $someStringOfLetters);
                }else{
                    return;
                }
                if($someArray[$i][$j] == 0){
                    return;
                }else{
                    $length += $someArray[$i][$j];//нч
                    $someString .= $someStringOfLetters[$j];
                    if($j== $numEndPoint){
                        f($length, $someString);
                    }// проверка флагом или замена массива
                    if(($someArray[$j][$i] != 0) && ($someArray[$i][$j] != 0)) {
                        $someArray[$j][$i] = 0; //чтоб не было зацикленного вызова когда попдём на неориентированный участок графа: из Н в М и из М в Н
                        // против зацикливачнивания между стартовой и финальной точками, но не ними.
                    }//кц в отдельную функцию
                    g($j, 0, $length, $someString, $someArray, $someStringOfLetters);
                }
            }
        }
    }

    /** Функция для получения номера начальной вершины из строки(буква или символ)
     * @param $string - строка всех вершин
     * @param $point - строка (1 символ) начальной или конечной вершины
     * @return bool|int - индекс в массиве старта или конца, или чего-то не хватает
     */
    function getNumberFromStringOfVertex($string, $point){
        for($i = 0; $i < count($string); $i++){
            if($string[$i] == $point){
                return $i;
            }
        }
        return false;
    }

    /** Функция на проверку путей в начальную точку
     * @param $numberStart - индекс старта
     * @param $array - матрица смежности
     * @return bool - результат
     */
    function checkPathToStartPoint($numberStart, $array){
        $result = false;
        for ($i = 0; $i < count($array); $i++){
            if($array[$i][$numberStart] != 0){
                $result = true;
                return $result;
            }
        }
        return $result;
    }

    /** Функция удаления путей в стартовую точку, дабы избежать зацикливания алгоритма, т.е. из А в Б, из Б в Д, из Д в А.
     * @param $numberStart - индекс старта
     * @param $array - матрица смежности
     * @return $array - матрица смежности с удалёнными путями к старту
     */
    function zeroingPathToStartPoint($numberStart, $array){
        for ($i = 0; $i < count($array); $i++){
            $array[$i][$numberStart] = 0;
        }
        return $array;
    }

    /** Функция на проверку повторной вершины, был ли алгоритм в этой вершине или нет
     * @param $string - строка из пройденных вершин
     * @return bool - результат
     */
    function checkReturn2ExPoint( $string){
        $string = preg_split('//', $string, -1, PREG_SPLIT_NO_EMPTY);
        for ($i = 0; $i < count($string); $i++){
            for($j = $i + 1; $j < count($string); $j++){
                if($string[$i] == $string[$j]){
                    return true;
                }
            }
        }
        return false;
    }

    /** Функция вывода всеъ путей
     * @param $arrayOfLength - массив длин маршрутов
     * @param $arrayOfLetters - массив строк, состоящих из последовательных вершин маршрута
     */
    function printArrayOfPath($arrayOfLength, $arrayOfLetters){?>
    <table>
        <tr>
            <th>№</th>
            <th>Маршрут</th>
            <th>Длина маршрута</th>
        </tr>
        <?php
        for($i = 1; $i < count($arrayOfLetters) + 1; $i++){?>
            <tr>
                <td><?=$i?></td>
                <td><?=$arrayOfLetters[$i-1]?></td>
                <td><?=$arrayOfLength[$i-1]?></td>
            </tr>
        <?php
        }?>
    </table>
    <?php
    }


    /***************************************************************************************************************************/
   if(isset($_POST["sub"])) {

       $stringArray = htmlspecialchars($_POST["array"]);
       $stringArray = trim($stringArray, " \r\n");
       $array = forming2dArray($stringArray);

       $stringVertexes = htmlspecialchars($_POST["stringOfPoints"]);
       $stringVertexes = trim($stringVertexes, " ");
       $stringArrayVertexes = explode(" ",$stringVertexes);

       $startPoint = htmlspecialchars($_POST["startPoint"]);
       $endPoint = htmlspecialchars($_POST["endPoint"]);

       $numStartPoint = getNumberFromStringOfVertex($stringArrayVertexes, $startPoint);
       $numEndPoint = getNumberFromStringOfVertex($stringArrayVertexes, $endPoint);

       // если есть пути в стартовую точку, то обнулить их, дабы не было зацикливания
        if(checkPathToStartPoint($numStartPoint, $array)){
            $array = zeroingPathToStartPoint($numStartPoint, $array);
        }

        $minLengthOfRoute = 0;
        $minLettersOfRoute = "";


       $arrayOfRoutes = array();           // машрут в виде букв
       $arrayOfLengthRoutes = array();     // машрут в виде длин(числа)
       $globalCount = 0;

       $errorsArray ="";
       $errorsEndStart = "";
       $errorsStartPoint = "";
       $errorsString = "";

       if (empty($stringArray)){
            $errorsArray = "Вы не ввели матрицу смежности.";
       }else{
           if(!checkArray($array)){
               $errorsArray = "Проверьте корректность введённой матрицы смежности";
           }
       }
       if(empty($stringVertexes)){
            $errorsString = "Вы не ввели вершины графа.";
       }
       if(empty($startPoint)){
            $errorsStartPoint = "Вы не ввели начальную вершину.";
       }
       if(empty($endPoint)){
            $errorsEndPoint = "Вы не ввели конечную вершину.";
       }

   }?>

    <div id="wrapper">
        <div id="title">
            Определение оптимального пути в ориентированном графе.
        </div>
        <div id="descriptions">
            Граф вводится в виде матрицы смежности, гда на пересечении i строки и j столбца находится число (вес ребра), отличное от нуля.
            Наличие числа, отличного от нуля, означает наличие пути из i в j. Иначе отсутствует.
        </div>
        <div id="input">
            <form action="discreteMathematicsLaba4.php" method="post">
                <div id="textarea">
                    <div> <span>Введите матрицу смежности графа.</span> <span id="errorsString" ><?=$errorsArray?></span></div>
                    <textarea name="array" ><?=$stringArray?></textarea>
                </div>
                <div class="input">
                    <span>Введите вершины графа через пробел.</span>  <span id="errorsString"><?=$errorsString?></span>
                    <input type="text" name="stringOfPoints" value="<?=$stringVertexes ?>">
                </div>
                <div class="input">
                    <span>Введите начальную вершину.</span>  <span id="errorsString"><?=$errorsStartPoint?></span>
                    <input type="text" name="startPoint" maxlength="1" value="<?=$startPoint ?>">
                </div>
                <div class="input">
                    <span>Введите конечную вершину.</span>  <span id="errorsString"><?=$errorsEndPoint?></span>
                    <input type="text" name="endPoint" maxlength="1" value="<?=$endPoint ?>">
                </div>
                <div id="button"><input type="submit" name="sub" value="Разобрать"></div>
                <div id="checkbox">Показать все маршруты
                    <input id="stat" type="checkbox" name="allRoutes" value="yes" <?php
                    if($_POST['allRoutes'] == 'yes'){
                        echo 'checked="checked">';
                    }
                    ?></div>
            </form>
        </div>
        <div class="result">
        <?php
        if(!empty($array)){
            g($numStartPoint, 0, 0, $startPoint, $array, $stringArrayVertexes);
            if(isset($_POST['allRoutes']) && ($_POST['allRoutes'] == 'yes') &&
                (!empty($minLengthOfRoute) && !empty($minLettersOfRoute))){
                printArrayOfPath($arrayOfLengthRoutes, $arrayOfRoutes);
            }
        }
        ?>
        <div id="optimalRoute">
            <?php
            if(!empty($minLengthOfRoute) && !empty($minLettersOfRoute)){?>
                Самый оптимальный маршрут <span id="resultString"> <?=$minLettersOfRoute?> </span> длиною в <span id="resultString"><?=$minLengthOfRoute?> </span>.
            <?php
            }else{
                if(!empty($stringArray) && !empty($stringArrayVertexes) && !empty($startPoint) && !empty($endPoint)){?>
                    В данном графе <span id="resultString">нет</span> машрута от <?=$startPoint?> до <?=$endPoint?>
                <?php
                }?>
            <?php
            }?>

        </div>

        </div>
    </div>
            <footer>
              <h4>Связаться со мною по e-mail:  <br> 123@mailololol.com</h4>
            </footer>

  </body>
</html>