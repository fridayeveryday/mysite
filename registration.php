<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <title>Регистрация</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Sonsie+One" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/styles/menu.css">
    <link rel="stylesheet" href="/styles/styleRegistration.css">
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
                  <li><a href="Game.php">Игра</a></li>
                  <li id="active"><a href="authorization.php">Авторизация</a></li>
              </ul>
            </nav>
    <?php
        $dbc = mysqli_connect("localhost", "root", "", "registrationlaba5")
        OR DIE('Ошибка подключения к базе данных');

        $errors = "";
        $errors_log = "";
        $errors_pass1 = "";
        $errors_pass2 = "";
        $errors_mail = "";

        //
        $login = htmlspecialchars($_POST["login"]);

        if ((isset($_POST["submit"])) /*&& !empty($_POST["submit"])*/) {

            $login = htmlspecialchars($_POST["login"]);
            $login = mysqli_real_escape_string($dbc, trim($_POST["login"]));

            $mail = htmlspecialchars($_POST["mail"]);
            $mail = mysqli_real_escape_string($dbc, trim($_POST["mail"]));

            $pass_1 = htmlspecialchars($_POST["pass1"]);
            $pass_1 = mysqli_real_escape_string($dbc, trim($_POST["pass1"]));

            $pass_2 = htmlspecialchars($_POST["pass2"]);
            $pass_2 = mysqli_real_escape_string($dbc, trim($_POST["pass2"]));
            if (!empty($login) && !empty($pass_1) && !empty($mail) && !empty($pass_2) && ($pass_1 == $pass_2)) {
                $query = "SELECT * FROM `laba` WHERE username = '$login'";
                $data = mysqli_query($dbc, $query);
                if (mysqli_num_rows($data) == 0) {
                    //соль
                    // $pass_2 .= 5;
                    $query = "SELECT * FROM `laba` WHERE email = '$mail'";
                    $data = mysqli_query($dbc, $query);
                    if (mysqli_num_rows($data) == 0) {
                        $query = "INSERT INTO `laba` (username, password, email) VALUES ('$login',SHA( '$pass_2'), '$mail')";
                        mysqli_query($dbc, $query);
                        $_SESSION["luckReg"] = true;
                        // echo 'Всё готово, можете авторизоваться';
                        //вывод html кода для перехода куда либо, на авторизацию например
                    } else {
                        $errors_mail = "Такая почта уже существует.";
                    }
                    mysqli_close($dbc);
                    // exit();
                } else {
                    $errors_log = "Такой логин уже существует.";
                    // $errors = "Логин уже существует";
                    //echo 'Логин уже существует';
                    $queryError = "SELECT * FROM `laba` WHERE email = '$mail'";
                    $dataError = mysqli_query($dbc, $queryError);
                    if (mysqli_num_rows($dataError) != 0) {
                        $errors_mail = "Такая почта уже существует.";
                    }
                }
            }

            if (empty($login)) {
                $errors_log .= "Введите пожалуйста логин <br>";
            }
            if (empty($mail)) {
                $errors_mail .= "Введите пожалуйста электронную почту <br>";
            }
            if (empty($pass_1)) {
                $errors_pass .= "Пароль не введен <br>";
            }
            if (!empty($pass_1)) {
                if (empty($pass_2)) {
                    $errors_pass2 .= "Вы не ввели пароль повторно <br>";
                }
            }
            if (!empty($pass_2)) {
                if (($pass_1) != ($pass_2)) {
                    $errors_pass2 .= "Пароль не совпадает <br>";
                    $pass_1 = "";
                    $pass_2 = "";
                }
            }
        }                            //<?php echo $_SERVER['PHP_SELF'];

        if(empty($_SESSION["luckReg"])) {?>
            <div id="authorization">

                <form action="registration.php" method="POST" name="regForm">
                    <div id="regTitle">Регистрация нового пользователя.</div>
                    <div id="errors_log">
                        <?= $errors_log ?>
                    </div>
                    <div>
                        <div id="title">Логин:</div>
                        <input type="text" name="login" value="<?= $login ?>">
                    </div>
                    <div id="errors_mail">
                        <?= $errors_mail ?>
                    </div>
                    <div>
                        <div id="title">E-mail:</div>
                        <input type="email" name="mail" value="<?= $mail; ?>">
                    </div>
                    <div id="errors_pass">
                        <?= $errors_pass ?>
                    </div>
                    <div>
                        <div id="title">Пароль:</div>
                        <input type="password" name="pass1" value="">
                    </div>
                    <div id="errors_pass">
                        <?= $errors_pass2 ?>
                    </div>
                    <div>
                        <div id="title">Пароль повторно:</div>
                        <input type="password" name="pass2" value="">
                    </div>
                    <div id="divButton">
                        <button type="submit" name="submit">Зарегестрироваться</button>
                    </div>
                </form>
            </div>
    <?php
    }else{?>
        <div id="wrapperReg">
            <div id="gratText">
                <div id="gratTitle">Ура, успешная регистрация!</div>
                Поздравляю вас с успешной регистрацией на моём сайте. <br> Теперь вы можете авторизоваться.
                <div id="buttonLogin"><a href="authorization.php">Авторизоваться</a></div>
            </div>
        </div>
    <?php
    }
    $_SESSION["luckReg"]="";
    ?>


            <footer>
              <h4>Связаться со мною по e-mail:  <br> 123@mailololol.com</h4>
            </footer>

  </body>
</html>