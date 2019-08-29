<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Comments</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="css/app.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="index.html">
                    Project
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                            <li class="nav-item">
                                <a class="nav-link" href="login.html">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="register.html">Register</a>
                            </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header"><h3>Комментарии</h3></div>

                            <div class="card-body">
                                <?php
                                //флеш уведомление
                                if ($_SESSION{'name'} != null){
                                    echo '<div class="alert alert-success" role="alert">
                                    Комментарий успешно добавлен
                                </div>
                                ';
                                unset($_SESSION{'name'});
                                };
                              ?>
                                <?php
                                //соединени с бд
                                $host = 'localhost';
                                $user = 'root';
                                $password = '';
                                $dbName = 'gb';
                                $db = mysqli_connect($host, $user, $password, $dbName);
                                //запрос в базу
                                $sql = mysqli_query($db, "SELECT * FROM Comment ORDER BY id DESC ");
                                // Выводим в ассоциатвный масвив
                                $data = mysqli_fetch_all($sql, MYSQLI_ASSOC);
                                ?>
                                <?php foreach($data as $comments): ?>
                                <div class="media">
                                  <img src="<?php echo $comments['img']; ?>" class="mr-3" alt="..." width="64" height="64">
                                  <div class="media-body">
                                    <h5 class="mt-0"><?php echo $comments['name']; ?></h5>
                                    <span><small><?php
                                            $comments{'date'} = strftime(timestamp);
                                            $comments{'date'} = date('d/m/Y');
                                            echo $comments['date']; ?></small></span>
                                    <p>
                                        <?php echo $comments['text']; ?>
                                    </p>
                                  </div>
                                </div>
                             <?php endforeach; ?>



                            </div>
                        </div>
                    </div>
                
                    <div class="col-md-12" style="margin-top: 20px;">
                        <div class="card">
                            <div class="card-header"><h3>Оставить комментарий</h3></div>
                            <div class="card-body">
                                <form action="action.php" method="post">
                                    <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Имя</label>
                                    <?php
                                    //валидация
                                        if ($_SESSION['commentUserError'] == 'true'){
                                            echo '<style type="text/css">
                                            .form-group p{
                                                background: red;
                                                padding: 5px 2px;
                                                border: 1px solid #000;
                                                text-align: center;
                                            }
                                        </style>
                                        <p>Вы не вили своё имя</p>';
                                            unset($_SESSION['commentUserError']);
                                        };
                                    ?>
                                    <input name="name" class="form-control" id="exampleFormControlTextarea1"  value="dfdsfds"/>
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Сообщение</label>
                                      <?php
                                      if ($_SESSION['commentTextError'] == 'true'){
                                          echo '<style type="text/css">
                                            .form-group p{
                                                background: red;
                                                padding: 5px 2px;
                                                border: 1px solid #000;
                                                text-align: center;
                                            }
                                        </style>
                                        <p>Вы не вили свой коментарий</p>';
                                          unset($_SESSION['commentTextError']);
                                      };
                                      ?>
                                    <textarea name="text" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                  </div>
                                  <button type="submit" class="btn btn-success">Отправить</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
