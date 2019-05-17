   <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <title>Дискретная математика</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Sonsie+One" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/styles/styleDiscreteMathLaba3.css">
    <link rel="stylesheet" href="/styles/menu.css">

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
    $mass = "";
    $relat = "";
    /**
     * getIndexElement
     * функция возврата номера индекса из массива
     * @param $element - входящая строка "a,b c,d"
     * @return bool|int
     */
    function getIndexElement($element, $mass)
    {
        for ($i = 0; $i < count($mass); $i++)

            if ($mass[$i] == $element)
                return $i;
        return false;
    }

    /**
     * @param $multitudeA - первое множество
     * @param $multitudeB - второе мнжество
     * @return array - массив нулей
     */
    function formingEmptyArray($multitudeA,$multitudeB){
        $resultArray = [];
        for ($i = 0; $i < count($multitudeA); $i++){
            for($j = 0 ; $j < count($multitudeB); $j++){
                $resultArray[$i][$j] = 0;
            }
        }
        return $resultArray;
    }

    /**
     * @param $multitudeA - первое множество
     * @param $multitudeB - второе мнжество
     * @param $relation - массив отношений в виде a,b c,d ...
     * @param $resultArray - массив заполненый нулями
     * @return array | bool- массив бинарных отношений или отсутствие какого-либо отношения
     */
    function formingArrayOfRelation($multitudeA,$multitudeB,$relation, $resultArray){

        for($i = 0; $i < count($relation); $i++){
            $relation[$i] = explode(",",$relation[$i]);
            if((in_array($relation[$i][0],$multitudeA)) &&
                (in_array($relation[$i][1],$multitudeB))){
                $resultArray[getIndexElement($relation[$i][0], $multitudeA)][getIndexElement($relation[$i][1], $multitudeB)] = 1;
            }else{
                return false;
            }
        }
        return $resultArray;
    }

    /** Функция для проверки на функцию
     * @param $array - массив отношений для проверки
     * @return bool - результат
     */
    function checkIsFunction($array){
        $result = false;
        for ($i = 0; $i < count($array); $i++){
            $sum = 0;
            for($j = 0; $j < count($array[0]); $j++){
                $sum +=$array[$i][$j];
            }
            if($sum != 1){
                $result = false;
                return $result;
            }else{
                $result = true;
            }
        }
        return $result;
    }
    /**
     * printMass
     * функция вывода массива
     * @param $array- входящая матрица nxm
     * @param $multitudeA - матрица для определения индексов по n
     * @param $multitudeB - матрица для определения индексов по m
     * @return void
     */
    function printMass($array, $multitudeA, $multitudeB){?>
        <table><tr>
            <th></th>
            <?php
            for ($i = 0;$i < count($multitudeB);$i++){?>
                  <th><?php echo $multitudeB[$i]." ";?></th>
            <?php
            }?>
        </tr>
        <?php
        for ($i = 0; $i < count($multitudeA); $i++){?>
            <tr>
            <td><?php echo $multitudeA[$i]." ";?></td>
            <?php
            for ($j = 0; $j < count($multitudeB); $j++){?>
                <td><?php echo $array[$i][$j]." ";?></td>
            <?php
            }?>
            </tr>
        <?php
        }?>
        </table><?php
    }


    /***************************************************************************************************************************/
    if(isset($_POST["sub"])){

        $multitudeA = htmlspecialchars($_POST["mass1"]);
        $multitudeB = htmlspecialchars($_POST["mass2"]);
        $relat  = htmlspecialchars($_POST["relat1"]);

        $multitudeA = trim($multitudeA," ");
        $multitudeB = trim($multitudeB," ");
        $relat = trim($relat," ");

        $stringMulA = $multitudeA;          // для input
        $stringMulB = $multitudeB;
        $stringRelat = $relat;

        $multitudeA = explode(" ",$multitudeA);
        $multitudeB = explode(" ",$multitudeB);
        $relat = explode(" ", $relat);

        $emptyArray = formingEmptyArray($multitudeA, $multitudeB);

        $resultArrayOfFunction = formingArrayOfRelation($multitudeA, $multitudeB, $relat, $emptyArray);
        if(!$resultArrayOfFunction){
            $flagCheckRelations = false;
        }else{
            $flagCheckRelations = true;
        }
        $flagCheckInput = true;

        $errorsMultitudeA = "";
        $errorsMultitudeB = "";
        $errorsRelations = "";
        $errorsOfCorrectRelations = "";

        if (empty($stringMulA)){
            $flagCheckInput = false;
            $errorsMultitudeA = "Введите множество A.";
        }
        if (empty($stringMulB)) {
            $flagCheckInput = false;
            $errorsMultitudeB = "Введите множество В.";
        }
        if (empty($stringRelat)) {
            $flagCheckInput = false;
            $errorsRelations = "Введите отношение.";
        }
        if(!$flagCheckRelations){
            $flagCheckInput = false;
            $errorsOfCorrectRelations = "Проверьте корректность введёнх отношений.";
        }
    }
    ?>

    <div id="wrapper">
        <div id="input">
            <form action="" method="post">
                <div id="descriptions"><div id="title">Определение функции по введённым множествам и отношениям.</div> <br>
                    Множества перечисляются через пробел. Отношения через запятую (например: (1,a); где "1" - элемент первого множества, "а" - элемент второго).
                </div>
                <div> Множество А: <span><?=$errorsMultitudeA?></span></div> <input type="text" name="mass1" value="<?=$stringMulA?>"><br>
                <div> Множество В: <span><?=$errorsMultitudeB?></span></div><input type="text" name="mass2" value="<?=$stringMulB?>"><br>
                <div>Отношения: <span><?=$errorsRelations?></span></div><input type="text" name="relat1" value="<?=$stringRelat?>">
                <br>
                <div id="button"><input type="submit" name="sub" value="Разобрать"></div>
                <div><span><?= $errorsOfCorrectRelations?></span></div>
            </form>
        </div>
        <div class="result">

            <div id="errors">

            </div>
                <?php
                if($flagCheckInput){
                    ?>
                    <div id="array"><?php printMass($resultArrayOfFunction, $multitudeA, $multitudeB); ?></div>
                    <div id="result">
                        <?php
                        if($resultArrayOfFunction){
                            if(checkIsFunction($resultArrayOfFunction)){?>
                                <div>Это функция</div>
                                <?php
                            }else{?>
                                <div>Это не функция</div>
                                <?php
                            }
                        }?>
                    </div>
                    <?php
                }?>


        </div>
    </div>
            <footer>
              <h4>Связаться со мною по e-mail:  <br> 123@mailololol.com</h4>
            </footer>

  </body>
</html>