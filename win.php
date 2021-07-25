<?php
session_start();

$coins = $_SESSION['coins'];

// フォームが送信された場合
if (!empty($_POST)) {
    if ($_POST['battle'] === 'get_coins') {
        // 獲得するコイン数をランダムで決定する
        $randam = mt_rand(1, 4);
        $_SESSION['coins'] = $coins + $randam;
        $_SESSION['randam'] = $randam;
        header('Location: roulette.php');
        exit();
    }
    if ($_POST['battle'] === 'finish') {
        header('Location: finish.php');
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
        <div class="main_view row">
            <div class="col-8 main_view_1">
                <h3>おめでとう！あなたの勝ちです！</h3>
                <img src="images/pose_win_boy.png" alt="勝ち">
                <div class="row">
                    <div class="col-5 user">
                        <p><?php print(htmlspecialchars($_SESSION['name'])); ?>さんの出し手</p>
                        <img src="images/<?php print($_SESSION['user_hand']); ?>.png" alt="">
                    </div>
                    <div class="col-5 maker">
                        <p>あいての出し手</p>
                        <img src="images/<?php print($_SESSION['maker_hand']); ?>.png" alt="">
                    </div>
                </div>
                <form class="row g-3" action="" method="post">
                    <div class="col-auto">
                        <button type="submit" name="battle" value="get_coins" class="btn btn-primary mb-3">コインを受け取る</button>
                    </div>
                    <div class="col-auto">
                        <button type="submit" name="battle" value="finish" class="btn btn-primary mb-3">ゲームを辞める</button>
                    </div>
                </form>
            </div>
            <aside class="col-3">
                <p><?php print(htmlspecialchars($_SESSION['name'], ENT_QUOTES)); ?>さん</p>
                <p><img src="user_image/<?php print(htmlspecialchars($_SESSION['picture'], ENT_QUOTES)); ?>" alt=""></p>
                <p>コイン所有数：<?php print($coins); ?>枚</p>
            </aside>
        </div>
    </main>
    <footer>
    </footer>
</body>

</html>