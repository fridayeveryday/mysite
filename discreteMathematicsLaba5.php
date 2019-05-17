   <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <title>Дискретная математика</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Sonsie+One" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/styles/styleDiscreteMathLaba5.css">
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
                  <li><a href="Game.html">Игра</a></li>
                  <li><a href="authorization.html">Авторизация</a></li>
              </ul>
            </nav>
    <?php
    /** Функция формировангия двумерного массива из textarea
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

    /** Функция формирования матрицы достижимости
     * @param $array - матрица смежности
     * @return $array - матрица достижимости
     */
    function reachabilityMatrix($array){
        for($k = 0; $k < count($array); $k++){
            for($i = 0; $i < count($array); $i++){
                for($j= 0; $j < count($array); $j++){
                    if ($array[$i][$k] && $array[$k][$j] && $i!=$j) {
                        if (($array[$i][$k] + $array[$k][$j] < $array[$i][$j]) || $array[$i][$j] == 0) {
                            $array[$i][$j] = $array[$i][$k] + $array[$k][$j];
                        }
                    }
                }
            }
        }
        return $array;
    }

    /** Функция вывода всеъ путей
     * @param $arrayOfLength - массив длин маршрутов
     * @param $arrayOfLetters - массив строк, состоящих из последовательных вершин маршрута
     */
    function printArray($array){?>
    <table><tr>
            <th></th>
            <?php
            for ($i = 0;$i < count($array);$i++){?>
                <th><?php echo ($i + 1)." ";?></th>
                <?php
            }?>
        </tr>
        <?php
        for ($i = 0; $i < count($array); $i++){?>
            <tr>
                <td><?php echo ($i + 1)." ";?></td>
                <?php
                for ($j = 0; $j < count($array); $j++){?>
                    <td><?php echo $array[$i][$j]." ";?></td>
                    <?php
                }?>
            </tr>
            <?php
        }?>
    </table><?php
    }


    /***************************************************************************************************************************/
   if(isset($_POST["sub"])) {

       $stringArray = htmlspecialchars($_POST["array"]);
       $stringArray = trim($stringArray, " \r\n");
       $array = forming2dArray($stringArray);

       $array = reachabilityMatrix($array);

       $errorsArray ="";

       if (empty($stringArray)){
            $errorsArray = "Вы не ввели матрицу смежности.";
       }else{
           if(!checkArray($array)){
               $errorsArray = "Проверьте корректность введённой матрицы смежности";
           }
       }
   }?>

    <div id="wrapper">
        <div id="title">
            Нахождение матрицы достижимости.
        </div>
        <div id="descriptions">
            Граф вводится в виде матрицы смежности, гда на пересечении i строки и j столбца находится число (вес ребра), отличное от нуля.
            Наличие числа, отличного от нуля, означает наличие пути из i в j. Иначе отсутствует.
        </div>
        <div id="input">
            <form action="discreteMathematicsLaba5.php" method="post">
                <div id="textarea">
                    <div> <span>Введите матрицу смежности графа.</span> <span id="errorsString" ><?=$errorsArray?></span></div>
                    <textarea name="array" ><?=$stringArray?></textarea>
                </div>
                <div id="button"><input type="submit" name="sub" value="Разобрать"></div>
            </form>
        </div>
        <div class="result">
        <?php
        if(!empty($array)){
               printArray($array);
        }
        ?>

        </div>
    </div>
            <footer>
              <h4>Связаться со мною по e-mail:  <br> 123@mailololol.com</h4>
            </footer>

  </body>
</html>