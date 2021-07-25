<?php
session_start();

if (!empty($_POST)) {
    if ($_POST['start'] === 'guest') {
        $_SESSION['id'] = 13;
        $_SESSION['time'] = time();
        header('Location: game.php');
        exit();
    }
    if ($_POST['start'] === 'restore') {
        header('Location: join/');
        exit();
    }
    if ($_POST['start'] === 'login') {
        header('Location: login.php');
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>じゃんけんゲーム</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body class="container">
    <header>
        <h2>むかしなつかし～じゃんけんゲーム～</h2>
    </header>
    <main>
        <div class="main_view">
            <!-- <h2>むかしなつかし～じゃんけんゲーム～</h2> -->
            <img src="images/janken_boys.png" alt="じゃんけんゲーム">
            <h3>アプリの説明</h3>
            <p>このアプリは、昔よくゲームセンターにあったコイン式の「じゃんけんゲーム」を楽しんでいただけるものです。</p>
            <p>ユーザー登録すれば、もらったコインを次回も使えるようになります。</p>
            <p>ゲストや初めて登録する方は、コイン10枚からスタートです。</p>
        </div>
        <form class="row g-3" action="" method="post">
            <div class="col-auto">
                <button type="submit" name="start" value="guest" class="btn btn-primary mb-3">ゲストとして遊ぶ</button>
            </div>
            <div class="col-auto">
                <button type="submit" name="start" value="restore" class="btn btn-warning mb-3">ユーザー登録して遊ぶ</button>
            </div>
            <div class="col-auto">
                <button type="submit" name="start" value="login" class="btn btn-success mb-3">続きから遊ぶ</button>
            </div>
        </form>
    </main>
    <footer>
        <small>@2021 Welcome Kazuki</small>
    </footer>

</body>

</html>