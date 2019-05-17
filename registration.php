<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <title>Главная</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Sonsie+One" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/styles/menu.css">
    <link rel="stylesheet" href="/styles/styleAuthorization.css">
  </head>

  <body>
    <div id="logo">
        <a href="index.html"></a>
    </div>

          <nav>
              <ul class="menu">
                  <li><a href="index.html">Главная</a></li>
                  <li><a href="gallery.html">Галерея</a></li>
                  <li><a href="discreteMathematics.html">Дискретная математика</a></li>
                  <li><a href="Game.html">Игра</a></li>
                  <li id="active"><a href="authorization.html">Авторизация</a></li>
              </ul>
            </nav>
            <div id="authorization">
                    <form action="" method="POST" name="regForm">
                        <div>
                        Логин:<input name="login" value="<?=$login?>">
                        </div>
                        <div>
                            Пароль:<input type="password" name="pass" value="<?=$pass?>">
                        </div>
                        <div>
                            <a href="registration.php"></a>
                        </div>
                    </form>
            </div>



            <footer>
              <h4>Связаться со мною по e-mail:  <br> 123@mailololol.com</h4>
            </footer>

  </body>
</html>