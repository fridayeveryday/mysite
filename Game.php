<?php     session_start();?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <title>Игра</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Sonsie+One" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/styles/styleGame.css">
    <link rel="stylesheet" href="/styles/menu.css">

  </head>

  <body>
    <div id="logo">
        <a href="index.html"></a>
    </div>

          <nav>
              <input type="checkbox" id="menuCheck"><label for="menuCheck">
              <div id="picopmenu">Меню
                  <!--<img src="../images/icon.png" alt="">-->
              </div></label>
              <ul class="menu">
                  <li><a href="index.html">Главная</a></li>
                  <li><a href="gallery.html">Галерея</a></li>
                  <li><a href="discreteMathematics.html">Дискретная математика</a></li>
                  <li id="active"><a href="Game.php">Игра</a></li>
                  <li><a href="authorization.php">Авторизация</a></li>
              </ul>
            </nav>
            <div id="game">
                <?php
                if(!isset($_GET["submit"])){
                $newScore = htmlspecialchars($_GET["score"]);
                $scoreMy = $_SESSION["userScore"];

                ?>
                <div id="rule">
                    <p>Вам предстоит сыграть в одну игру.</p> Перед вами будут появляться слова, означающие цвета, но написанные не тем цветом, которые они значат.
                    Ваша задача заключается в следующем: необходимо выбрать тот цвет среди предложенных, которым написано слово. Дерзайте, время на выбор ограничен!
                </div>
                <button id="beginGame"  ><a id="link" href="GamePlay.php">                    Начать игру!
                    </a>
                </button>
            </div>
                <?php
                }else{
                     $newScore = $login = htmlspecialchars($_GET["score"]);
                        $scoreMy = $_SESSION["userScore"];  }



                ?><div></div>





            <?php
            if(!empty($_SESSION["loggedUser"])){
                $dbc = mysqli_connect("localhost","root","","registrationlaba5")
                OR DIE('Ошибка подключения к базе данных');
                $login = $_SESSION["loggedUser"];

                $str = "SELECT `score` FROM `laba`  WHERE username='$login'";
                //$queryn = mysql_query($dbc," ");
                $zapr = mysqli_query($dbc, $str);
                $array = mysqli_fetch_array($zapr);
                $score = $array[0];
                mysqli_close($dbc);
            }
            ?>
<!--            <div id="oldScore">--><?//=$score?><!--</div>-->
            <footer>
              <h4>Связаться со мною по e-mail:  <br> 123@mailololol.com</h4>
            </footer>
<!--    <script src="scripts/gameold.js"></script>-->
  </body>
</html>