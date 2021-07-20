<?php
session_start();

// $_SESSION['user_hand'] = $_POST['user_hand'];
//　ゲストモード
if ($_SESSION['game']['user'] === 'guest') {
}


if (!empty($_POST)) {
    // ユーザーの手をセッション入力
    $_SESSION['game']['user_hand'] = $_POST['user_hand'];

    // コンピューターの出し手を決定
    $hand = array('rock', 'scissor', 'paper');
    $count = count($hand);
    $random = mt_rand(0, $count - 1);
    $maker = $hand[$random];
    $_SESSION['game']['maker_hand'] = $maker;

    // 勝ちの場合
    if (($_POST['user_hand'] === 'rock' && $maker === 'scissor') ||  ($_POST['user_hand'] === 'scissor' && $maker === 'paper') || ($_POST['user_hand'] === 'paper' && $maker === 'rock')) {
        // $_SESSION['win']['coins'] = $coins;
        // $_SESSION['win']['id'] = $_SESSION['game']['id'] ;
        $_SESSION['win'] = $_SESSION['game'];
        header('Location: win.php');
        exit();
    }

    // 負けの場合
    if (($_POST['user_hand'] === 'rock' && $maker === 'paper') ||  ($_POST['user_hand'] === 'scissor' && $maker === 'rock') || ($_POST['user_hand'] === 'paper' && $maker === 'scissor')) {
        $coins = $coins - 1;
        // $_SESSION['lose']['coins'] = $coins;
        // $_SESSION['lose']['id'] = $_SESSION['game']['id'] ;
        $_SESSION['lose'] = $_SESSION['game'];
        $_SESSION['lose']['coins'] = $_SESSION['game']['coins'] - 1;
        header('Location: lose.php');
        exit();
    }
    // あいこの場合
    if ($_POST['user_hand'] ===  $maker) {
        $_SESSION['draw'] = $_SESSION['game'];
        header('Location: draw.php');
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
        <h1>むかしなつかし～じゃんけんゲーム～</h1>
    </header>
    <main>
        <h1>じゃんけんっ！</h1>
        <div class="main_view row">
            <div class="col-8 main_view_1">
                <h2>あいての手</h2>
                <img id="mypic" src="images/rock.png" width="400" height="300">
                <script>
                    var pics_src = new Array("images/rock.png", "images/scissor.png", "images/paper.png");
                    var num = -1;

                    slideshow_timer();

                    function slideshow_timer() {
                        if (num == 2) {
                            num = 0;
                        } else {
                            num++;
                        }
                        document.getElementById("mypic").src = pics_src[num];
                        setTimeout("slideshow_timer()", 100);
                    }
                </script>
                <h2><?php print(htmlspecialchars($_SESSION['game']['name'], ENT_QUOTES)); ?>さんの手（出したい手をクリック！）</h2>
                <form class="row g-3" action="" method="post">
                    <div class="col-4">
                        <button type="submit" name="user_hand" value="rock" class="btn mb-3"><img src="images/rock.png" alt="rock"></button>
                    </div>
                    <div class="col-4">
                        <button type="submit" name="user_hand" value="scissor" class="btn mb-3"><img src="images/scissor.png" alt="scissor"></button>
                    </div>
                    <div class="col-4">
                        <button type="submit" name="user_hand" value="paper" class="btn mb-3"><img src="images/paper.png" alt="paper"></button>
                    </div>
                </form>
            </div>
            <aside class="col-4">
                <p><?php print(htmlspecialchars($_SESSION['game']['name'], ENT_QUOTES)); ?>さん</p>
                <?php if ($_SESSION['game']['name'] === 'guest') : ?>
                    <p><img src="user_image/boy_01.png" alt="guest"></p>
                <?php else : ?>
                    <p><img src="user_image/<?php print(htmlspecialchars($_SESSION['game']['picture'], ENT_QUOTES)); ?>" alt=""></p>
                <?php endif; ?>
                <p>コイン所有数：<?php print($_SESSION['game']['coins']); ?>枚</p>
            </aside>
        </div>
    </main>
    <footer>
    </footer>
</body>

</html>