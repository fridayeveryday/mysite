<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <title>Дискретная математика</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Sonsie+One" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/styles/styleDiscreteMathLaba1.css">
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

    //проверка на правильность введныйх данных
    /**
     * @param $word
     * @return bool
     */
    function checkWords($word){
        $result = false;
        if(strlen($word)>5){
            $result = false;
            return $result;
        }
        $symWord = preg_split('//',$word,-1, PREG_SPLIT_NO_EMPTY);
        if ( (ctype_digit($symWord[0]+48)) && (ctype_alpha($symWord[1])) && (ctype_alpha($symWord[2])) && //+48 ибо ascii
            (ctype_digit($symWord[3]+48) && ($symWord[3]%2==0)) && (ctype_digit($symWord[4]+48) && ($symWord[3]%2==0))){
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    /** Функция разделения строки на массив по пробелам
     * @param $string - входная строка
     * @return array - выходной массив
     */
    function devideString($string) {
        $arrayOfWords = explode(' ', $string);
        return $arrayOfWords;
    }

    /**
     * @param $words
     * @return bool
     */
    function checkString($words) {
        $result = false;
        $kol = count($words);
        for($count = 0; $count < $kol; $count++) { // count
            if(checkWords($words[$count])){
                $result = true;
            }
            else {
                return $result;
            }
        }
        return $result;
    }

    /** Функция нахождения объединения 2-ух множеств
     * @param $arr1 - 1-ое множество
     * @param $arr2 - 2-ое множество
     * @return array - множество объединения 1-ого и 2-ого
     */
    function union($arr1, $arr2){
        $resArr = [];
        for($i = 0; $i < count($arr1); $i++){
            $resArr[$i] = $arr1[$i];
        }
        $koli=count($arr2);

        for($i = 0; $i < $koli; $i++){
            $coincidence = false;
            $kolj=count($resArr);
            for($j = 0; $j < $kolj; $j++){
                if($arr2[$i] == $resArr[$j]){
                    $coincidence = true;
                    break;
                }
            }
            if(!$coincidence) {
                array_push($resArr, $arr2[$i]);
                // или функцийю добавления
            }
        }
        return $resArr;
    }

    /** Функция нахождения пересечения 2-ух множеств
     * @param $arr1 - 1-ое множество
     * @param $arr2 - 2-ое множество
     * @return array - множество пересечения 1-ого и 2-ого
     */
    function intersection($arr1, $arr2){
        $resArr = [];
        for($i = 0; $i < count($arr1); $i++){
            for($j = 0; $j < count($arr2); $j++){
                if($arr1[$i] == $arr2[$j]){
                    $resArr[] = $arr1[$i]; // просто равно
                    continue;
                }
            }
        }
        return $resArr;
    }

    /** Функция нахождения симметрической разницы 2-ух множеств
     * @param $arr1 - 1-ое множество
     * @param $arr2 - 2-ое множество
     * @return array - множество симметрической разницы 1-ого и 2-ого
     */
    function symmetricDifferenceOfArrays($arr1, $arr2){
        $resArr = [];
        for($i = 0; $i < count($arr1); $i++){
            $coincident = true;
            for($j = 0; $j < count($arr2); $j++){
                if($arr1[$i] == $arr2[$j]){
                    $coincident = false;
                    break;// аккуратнее
                }
            }
            if ($coincident){
                $resArr[] = $arr1[$i];
            }
        }

        for($i = 0; $i < count($arr2); $i++){
            $coincident = true;
            for($j = 0; $j < count($arr1); $j++){
                if($arr2[$i] == $arr1[$j]){         // попробовать объединить это условие чреез и с верхним
                    $coincident = false;
                    break;// аккуратнее
                }
            }
            if ($coincident){
                $resArr[] = $arr2[$i];
            }
        }
        return $resArr;
    }


    /** Функция нахождения дополнения 1-ого множества до 2-ого
     * @param $arr1 - 1-ое множество
     * @param $arr2 - 2-ое множество
     * @return array - множество дополнения 1-ого множества до 2-ого
     */
    function additiion1to2($arr1,$arr2){
        $resArr = [];
        for($i = 0; $i < count($arr2); $i++){
            $flag = true;
            for($j = 0; $j < count($arr1); $j++){
                if($arr2[$i] == $arr1[$j]) {
                    $flag = false;
                }
            }
            if($flag){
                $resArr[] = $arr2[$i];
            }
        }
        return $resArr;
    }



    /** Функция нахождения дополнения 2-ого множества до 1-ого
     * @param $arr1 - 1-ое множество
     * @param $arr2 - 2-ое множество
     * @return array - множество дополнения 2-ого множества до 1-ого
     */
    function additiion2to1($arr1,$arr2){
        $resArr =[];
        for($i = 0; $i < count($arr1); $i++){
            $flag = true;
            for($j = 0; $j < count($arr2); $j++){
                if($arr1[$i] == $arr2[$j]) {
                    $flag = false;
                    //break;
                }
            }
            if($flag){
                $resArr[] = $arr1[$i];
            }
        }
        return $resArr;
    }
    /*******************************************************************************************************************/

    if ((isset($_POST["sub"])) && !empty($_POST["sub"])){
        $mainString1 = htmlspecialchars($_POST["1multitude"]);
        $mainString2 = htmlspecialchars($_POST["2multitude"]);

        $errors = "";

        $words1 = devideString($mainString1);
        $words2 = devideString($mainString2);
        if (checkString($words1) && checkString($words2)) {
            $stringUnion = implode(" ",$stringUnion = union($words1, $words2));

            $stringIntersection = implode(" ", $stringIntersection = intersection($words1, $words2));

            $stringSymmetricDifferenceOfArrays = implode(" ",$stringSymmetricDifferenceOfArrays = symmetricDifferenceOfArrays($words1, $words2));

            $stringAdd1to2 = implode(" ",$stringAdd1to2 = additiion1to2($words1, $words2));

            $stringAdd2to1 = implode(" ", $stringAdd2to1 = additiion2to1($words1, $words2));

        } else{
            $errors="Ошибка в введёных множествах, проверьте корректность введённых данных.";
        }
    }
    ?>
    <div id="wrapper">
        <h1>Операции со множествами.</h1>
        <div class="listoperations">Выполняемые операции: <br>
            <div>
                <ul id="list">
                    <li id="item">Объединение.</li>
                    <li id="item">Персечение.</li>
                    <li id="item">Симметрическая разность.</li>
                    <li id="item">Дополнение первого до второго.</li>
                    <li id="item">Дополнение второго до первого.</li>
                </ul>
            </div>
        </div>
        <form action="" method="post" name="multitudes" id="form">
            <p>Введите элементы множества в виде cbbij, где с - цифра, b -  буква, i - чётная цифра, j - нечётная цифра.</p>
            <p id="multitude"> Первое множество: <input class="input" name="1multitude" value="<?=$mainString1?>"><br><br>

                Второе множество: <input class="input" name="2multitude" value="<?=$mainString2?>"><br><br>
            </p>
            <input class="do_it" type="submit" name="sub" value="Выполнить операции"> <a href="#operations"></a>
        </form>

        <a name="operations"
        <div class="operations"></a><?php
            if(empty($errors)) {
                ?>

                <div class="operation">
                    <p> Объединение:<br><br></p>
                    <div class="result">
                        <? echo $stringUnion . "<br>"; ?>
                    </div>
                    <br><br>
                </div>
                <div class="operation">
                    <p>Пересечение:<br><br></p>
                    <div class="result">
                        <? echo $stringIntersection . "<br>"; ?>
                    </div>
                    <br><br>
                </div>
                <div class="operation">
                    <p>Симметрическая разница:</p>
                    <div class="result">
                        <? echo $stringSymmetricDifferenceOfArrays . "<br>"; ?>
                    </div>
                    <br><br>
                </div>
                <div class="operation">
                    <p>Дополнение 1-ого до 2-ого:</p>
                    <div class="result">
                        <?
                        echo $stringAdd1to2 . "<br>"; ?>
                    </div>
                    <br><br>
                </div>
                <div class="operation">
                    <p>Дополнение 2-ого до 1-ого:</p>
                    <div class="result">
                        <?
                        echo $stringAdd2to1 . "<br>"; ?>
                    </div>
                    <br><br>
                </div>
                <?php
            } else {
                ?>
                <div id="errors"><?php echo $errors ?></div>
                <?php
            }
            ?>
        </div>
    </div>

    <footer>
      <h4>Связаться со мною по e-mail:  <br> 123@mailololol.com</h4>
    </footer>

  </body>
</html>