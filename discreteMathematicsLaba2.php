<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <title>Дискретная математика</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Sonsie+One" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/styles/styleDiscreteMathLaba2.css">
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
                  <li><a href="Game.php">Игра</a></li>
                  <li><a href="authorization.php">Авторизация</a></li>
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
     * getArrayFromString
     * функция получения массива из строки (пары элементнов)
     * @param $string - входящая строка "a,b c,d"
     * @param $massA - матрица для определения индекса
     * @return array|bool
     */
    function getArrayFromString($string, $massA){
        $mass = array();
        $massInput = explode(" ",$string);

        for($i = 0; $i < count($massA); $i++){
            for($j = 0; $j < count($massA); $j++){
                $mass[$i][$j] = 0;
            }
        }
        for($i = 0; $i < count($massInput); $i++){
            $massInput[$i] = explode(",", $massInput[$i]);
            if(in_array($massInput[$i][0],$massA) &&
                in_array($massInput[$i][1],$massA)) {
                $mass[getIndexElement($massInput[$i][0], $massA)][getIndexElement($massInput[$i][1], $massA)] = 1;
            }
            else {
//                echo "Элемент ".$massInput[$i][0]." & ".$massInput[$i][1]." не найден";
                return false;
            }
        }
        return $mass;
    }
    /**
     * printMass
     * функция вывода массива
     * @param $massA - матрица для определения индекса
     * @param $mass - входящая матрица nxn
     * @return void
     */
    function printMass($mass, $massA){?>
        <table><tr>
            <th></th>
            <?php
            for ($i = 0;$i < count($massA);$i++){?>
                <th><?php echo $massA[$i]." ";?> </th>
            <?php
            }?>
        </tr>
        <?php
        for ($i = 0; $i < count($mass); $i++){?>
            <tr>
            <td> <?php echo $massA[$i]." "; ?> </td>
            <?php
            for ($j = 0; $j < count($mass); $j++){?>
                <td><?php echo $mass[$i][$j]." ";?></td>
            <?php
            }?>
            </tr>
        <?php
        }?>
        </table><?php
    }

    /** Функция определения рефлексивного отношения
     * @param $mass - матрица отношений
     * @return bool - результат свойства
     */
    function reflexivity($mass){
        $result = false;
        for($i = 0; $i < count($mass); $i++){
            if($mass[$i][$i] == 1){
                $result = true;
            }
            else{
                $result = false;
                return $result;
            }
        }
        return $result;
    }

    /** Функция определения симметричности отношения
     * @param $mass - матрица отношений
     * @return bool - результат свойства
     */
    function symmetry($mass){
        $result = false;
        for($i = 0; $i < count($mass); $i++){
            for($j = $i + 1; $j < count($mass); $j++){
                if ($mass[$i][$j] == 1){
                    if(($mass[$i][$j] == $mass[$j][$i])){
                        $result = true;
                    }else{
                        $result = false;
                        return $result;
                    }
                }else{
                    continue;
                }
            }
        }
        return $result;
    }

    /** Функция определения свойства кососимметричности
     * @param $mass -  матрица отношений
     * @return bool - результат свойства
     */
    function skewSymmetry($mass){
        $result = false;
        for($i = 0; $i < count($mass); $i++){
            for($j = $i + 1; $j < count($mass); $j++) {
                if ($mass[$i][$j] == 1){
                    if(($mass[$i][$j] != $mass[$j][$i])){
                        $result = true;
                    }else{
                        $result = false;
                        return $result;
                    }
                }else{
                    continue;
                }
            }
        }
        return $result;
    }

    /** Функция определения свойства тринзитивности
     * @param $mass - массив отношений
     * @return bool - результат свойства
     */
    function transitivity($mass){
        $result = false;
        $massOfSquare = [];
        for($i = 0; $i < count($mass); $i++){
            for($j = 0; $j < count($mass); $j++){
                for($k = 0; $k < count($mass); $k++){
                    $massOfSquare[$i][$j] += $mass[$i][$k]*$mass[$k][$j];
                    if($massOfSquare[$i][$j] > 1){
                        $massOfSquare[$i][$j] = 1;
                    }
                }
            }
        }
        for($i = 0; $i < count($mass); $i++){
            for($j = 0; $j < count($mass); $j++){
                if($massOfSquare[$i][$j] == 1){
                    if(($massOfSquare[$i][$j] == 1) && ($mass[$i][$j] == 1)){
                        $result = true;
                    }else{
                        $result = false;
                        return $result;
                    }
                }
            }
        }
        return $result;
    }
    /***************************************************************************************************************************/
    if(isset($_POST["sub"])){

        $mass = htmlspecialchars($_POST["mass1"]);
        $relat  = htmlspecialchars($_POST["relat1"]);

        $mass = trim($mass," ");
        $relat = trim($relat," ");

        $massA = explode(" ",$mass);

    }
    ?>

    <div id="wrapper">
        <div id="title">
            <span id="titleSpan">Определение свойств отношений.</span>  <br><br>
            Элементы массива перечисляются через пробел. Отношения через запятую (например: (1,a); где "1" - элемент первого множества, "а" - элемент второго).
        </div>
        <div id="input">

            <form action="" method="post">
               <span> Массив: </span><input type="text" name="mass1" value="<?=$mass?>"><br>
                <span>Отношение: </span><input type="text" name="relat1" value="<?=$relat?>">
                <br>
                <div id="button"><input type="submit" name="sub" value="Разобрать"></div>
            </form>
        </div>
        <div class="result">
            <?php
            if(empty($mass) || empty($relat)){
                ?>
                <div id="errors">Введите отношение и массив</div>
                <?php
            }else{ ?>
                <div class="output">
                    <?php
                    $massRelat = getArrayFromString($relat, $massA);
                    if ($massRelat == false){
                        ?>
                        <div id="errors">Ошибка в ведённых отношениях. </div>
                    <?php
                    }else {?>
                        <div id="arrayHW"><?php printMass($massRelat, $massA); ?></div>
                        <div id="properties">
                            <div id="reflexivity">
                                <?php
                                if (reflexivity($massRelat)) {
                                    ?>
                                    Рефлексивно
                                    <?php
                                } else { ?>
                                    Не рефлексивно
                                    <?php
                                }
                                ?>
                            </div>

                            <div id="symmetry">
                                <?php
                                if (symmetry($massRelat)) {
                                    ?>
                                    Симметрично
                                    <?php
                                } else { ?>
                                    Не симметрично
                                <?php }
                                ?>
                            </div>

                            <div id="skewSymmetry">
                                <?php
                                if (skewSymmetry($massRelat)) {
                                    ?>
                                    Кососимметрично
                                    <?php
                                } else { ?>
                                    Не кососимметрично
                                <?php }
                                ?>
                            </div>

                            <div id="transitivity">
                                <?php
                                if (transitivity($massRelat)) {
                                    ?>
                                    Транзитивно
                                    <?php
                                } else { ?>
                                    Не транзитивно
                                <?php }
                                ?>
                            </div>
                        </div>
                        <?php
                    }?>
                </div>

            <?php }
            ?>
        </div>
    </div>
            <footer>
              <h4>Связаться со мною по e-mail:  <br> 123@mailololol.com</h4>
            </footer>

  </body>
</html>