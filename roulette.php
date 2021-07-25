<?php
session_start();

if (!empty($_POST)) {
    if ($_POST['battle'] === 'retry') {
        header('Location: game.php?action=retry');
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
                <h3>おめでとうございます！<span class="required"><?php print($_SESSION['randam']); ?></span>枚のコインがもらえます！</h3>
                <img src="images/game_coin.png" alt="コイン獲得">
                <form class="row g-3" action="" method="post">
                    <div class="col-auto">
                        <button type="submit" name="battle" value="retry" class="btn btn-primary mb-3">もう一回勝負！</button>
                    </div>
                    <div class="col-auto">
                        <button type="submit" name="battle" value="finish" class="btn btn-primary mb-3">もう辞める</button>
                    </div>
                </form>
            </div>
            <aside class="col-3">
                <p><?php print(htmlspecialchars($_SESSION['name'], ENT_QUOTES)); ?>さん</p>
                    <p><img src="user_image/<?php print(htmlspecialchars($_SESSION['picture'], ENT_QUOTES)); ?>" alt=""></p>
                <p>コイン所有数：<?php print($_SESSION['coins']); ?>枚</p>
            </aside>
        </div>
    </main>
    <footer>
    </footer>
</body>

</html>