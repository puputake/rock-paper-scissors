<?php
session_start();

if (!empty($_POST)) {
    $_SESSION['roulette'] = $_SESSION['win'];
    $randam = mt_rand(0, 16);
    $_SESSION['roulette']['coins'] = $_SESSION['win']['coins'] + $randam;
    $_SESSION['roulette']['randam'] = $randam;
    header('Location: roulette.php');
    exit();
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
        <h1>むかしなつかし～じゃんけんゲーム～</h1>
    </header>
    <main>
        <div class="main_view row">
            <div class="col-8 main_view_1">
                <h2>おめでとう！あなたの勝ちです！</h2>
                <img src="images/pose_win_boy.png" alt="勝ち">
                <div class="row">
                    <div class="col-6">
                        <p><?php print(htmlspecialchars($_SESSION['win']['name'])); ?>さんの出し手</p>
                        <img src="images/<?php print($_SESSION['win']['user_hand']); ?>.png" alt="">
                    </div>
                    <div class="col-6">
                        <p>あいての出し手</p>
                        <img src="images/<?php print($_SESSION['win']['maker_hand']); ?>.png" alt="">
                    </div>
                </div>
                <form class="row g-3" action="" method="post">
                    <div class="col-auto">
                        <button type="submit" name="get_coins" class="btn btn-primary mb-3">コインを受け取る</button>
                    </div>
                </form>
            </div>
            <aside class="col-4">
                <p><?php print(htmlspecialchars($_SESSION['win']['name'], ENT_QUOTES)); ?>さん</p>
                <?php if ($_SESSION['win']['name'] === 'guest') : ?>
                    <p><img src="user_image/boy_01.png" alt="guest"></p>
                <?php else : ?>
                    <p><img src="user_image/<?php print(htmlspecialchars($_SESSION['win']['picture'], ENT_QUOTES)); ?>" alt=""></p>
                <?php endif; ?>
                <p>コイン所有数：<?php print($_SESSION['win']['coins']); ?>枚</p>
            </aside>
        </div>
    </main>
    <footer>
    </footer>
</body>

</html>