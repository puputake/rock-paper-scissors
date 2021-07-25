<?php
session_start();
require('dbconnect.php');

// ログインしているユーザーのみアクセスを許可する
if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
    $_SESSION['time'] = time();

    // ログインユーザーの情報を取得する
    $members = $db->prepare('SELECT * FROM users WHERE id=?');
    $members->execute(array($_SESSION['id']));
    $member = $members->fetch();
} else {
    header('Location: login.php');
    exit();
}

// 取得したデータの定数化
$name = $member['name'];
$picture = $member['picture'];
$coins = $member['coins'];

if ($_REQUEST['action'] == 'retry') {
    $coins = $_SESSION['coins'];
}

// プレイヤーが出し手をクリックした場合
if (!empty($_POST['user_hand'])) {

    $user = $_POST['user_hand'];

    // コンピューターの出し手を決定
    $hand = array('rock', 'scissor', 'paper');
    $count = count($hand);
    $random = mt_rand(0, $count - 1);
    $maker = $hand[$random];

    // 勝ちの場合
    if (($user === 'rock' && $maker === 'scissor') ||  ($user === 'scissor' && $maker === 'paper') || ($user === 'paper' && $maker === 'rock')) {
        $_SESSION['name'] = $name;
        $_SESSION['picture'] = $picture;
        $_SESSION['coins'] = $coins;
        $_SESSION['user_hand'] = $user;
        $_SESSION['maker_hand'] = $maker;
        header('Location: win.php');
        exit();
    }

    // 負けの場合
    if (($user === 'rock' && $maker === 'paper') ||  ($user === 'scissor' && $maker === 'rock') || ($user === 'paper' && $maker === 'scissor')) {
        $_SESSION['name'] = $name;
        $_SESSION['picture'] = $picture;
        $_SESSION['coins'] = $coins;
        $_SESSION['coins'] = $coins - 1;
        $_SESSION['user_hand'] = $user;
        $_SESSION['maker_hand'] = $maker;
        header('Location: lose.php');
        exit();
    }
    // あいこの場合
    if ($user ===  $maker) {
        $_SESSION['name'] = $name;
        $_SESSION['picture'] = $picture;
        $_SESSION['coins'] = $coins;
        $_SESSION['user_hand'] = $user;
        $_SESSION['maker_hand'] = $maker;
        header('Location: draw.php');
        exit();
    }
}
// プレイヤーがトップに戻るをクリックした場合
if (!empty($_POST['battle'])) {
    $_SESSION['name'] = $name;
    $_SESSION['picture'] = $picture;
    $_SESSION['coins'] = $coins;
    header('Location: finish.php');
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
        <h2>むかしなつかし～じゃんけんゲーム～</h2>
    </header>
    <main>
        <div class="main_view row">
            <div class="col-8 main_view_1">
                <h3>じゃんけんっ！</h3>
                <div class="maker game_maker">
                    <h3>あいての手</h3>
                    <img id="mypic" src="images/rock.png" height="150">
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
                </div>
                <div class="user">
                    <h5><?php print(htmlspecialchars($name, ENT_QUOTES)); ?>さんの手<br>（出したい手をクリック！ ↓）</h5>
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
                <form class="row g-3" action="" method="post">
                    <div class="col-auto">
                        <button type="submit" name="battle" value="finish" class="btn btn-primary mb-3">ゲームを辞める</button>
                    </div>
                </form>
            </div>
            <aside class="col-3">
                <p><?php print(htmlspecialchars($name, ENT_QUOTES)); ?>さん</p>
                <p><img src="user_image/<?php print(htmlspecialchars($picture, ENT_QUOTES)); ?>" alt=""></p>
                <p>コイン所有数：<?php print($coins); ?>枚</p>
            </aside>
        </div>
    </main>
    <footer>
    </footer>
</body>

</html>