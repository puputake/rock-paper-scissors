<?php
session_start();
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
                <h2>あいこ！もう一回勝負！！</h2>
                <img src="images/janken_boys.png" alt="あいこ">
                <div class="row">
                    <div class="col-6">
                        <p>あなたの出し手</p>
                        <img src="images/<?php print($_SESSION['draw']['user_hand']); ?>.png" alt="">
                    </div>
                    <div class="col-6">
                        <p>あいての出し手</p>
                        <img src="images/<?php print($_SESSION['draw']['maker_hand']); ?>.png" alt="">
                    </div>
                </div>
                <a href="game.php">もう一回！</a>
            </div>
            <aside class="col-4">
                <p><?php print(htmlspecialchars($_SESSION['draw']['name'], ENT_QUOTES)); ?>さん</p>
                <?php if ($_SESSION['draw']['name'] === 'guest') : ?>
                    <p><img src="user_image/boy_01.png" alt="guest"></p>
                <?php else : ?>
                    <p><img src="user_image/<?php print(htmlspecialchars($_SESSION['draw']['picture'], ENT_QUOTES)); ?>" alt=""></p>
                <?php endif; ?>
                <p>コイン所有数：<?php print($_SESSION['draw']['coins']); ?>枚</p>
            </aside>
        </div>
    </main>
    <footer>
    </footer>
</body>

</html>