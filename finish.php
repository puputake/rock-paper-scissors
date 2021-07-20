<?php
session_start();
require('dbconnect.php');

// ユーザー登録済の人


// 登録する場合
$coins = $_SESSION['finish']['coins'];
$id = $_SESSION['finish']['id'];

if ($_POST['Registration'] === 'ok') {
    $upd = $db->prepare('UPDATE users SET coins=? WHERE id=?');
    $upd->execute(array($coins, $id));
    $_SESSION['ranking'] = $_SESSION['finish'];
    header('Location: ranking.php');
    exit();
}
if ($_POST['Registration'] === 'ng') {
    header('Location: ranking.php');
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
                <h2>お疲れ様でした</h2>
                <p><?php print(htmlspecialchars($_SESSION['finish']['name'])); ?>さんの持っているコイン枚数：<?php print($_SESSION['finish']['coins']); ?></p>
                <p>コインを預ければ、次回も同じコインが使えます。（guestは預けられません）</p>
                <div class="main_view row">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="col-auto">
                            <?php if ($_SESSION['finish']['name'] != 'guest') : ?>
                                <button type="submit" name="Registration" value="ok" class="btn btn-primary mb-3">預ける</button>
                            <?php endif; ?>
                            <button type="submit" name="Registration" value="ng" class="btn btn-primary mb-3">預けない</button>
                        </div>
                    </form>
                </div>
            </div>
            <aside class="col-4">
                <p><?php print(htmlspecialchars($_SESSION['finish']['name'], ENT_QUOTES)); ?>さん</p>
                <?php if ($_SESSION['finish']['name'] === 'guest') : ?>
                    <p><img src="user_image/boy_01.png" alt="guest"></p>
                <?php else : ?>
                    <p><img src="user_image/<?php print(htmlspecialchars($_SESSION['finish']['picture'], ENT_QUOTES)); ?>" alt=""></p>
                <?php endif; ?>
                <p>コイン所有数：<?php print($_SESSION['finish']['coins']); ?>枚</p>
            </aside>
    </main>
    <footer>
    </footer>
</body>

</html>