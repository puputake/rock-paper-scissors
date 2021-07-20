<?php
session_start();
require('dbconnect.php');

//　クッキーの設定



//　ログインボタン押下時
if (!empty($_POST)) {
    $email = $_POST['email'];

    if ($_POST['email'] != '' && $_POST['password'] != '') {
        $login = $db->prepare('SELECT * FROM users WHERE email=? AND password=?');
        $login->execute(array(
            $_POST['email'],
            sha1($_POST['password'])
        ));
        $member = $login->fetch();

        if ($member) {
            // $_SESSION['game']['id'] = $member['id'];
            $_SESSION['game'] = $member;
            $_SESSION['time'] = time();

            //　チェックボックスチェック時




            header('Location: game.php');
            exit();
        } else {
            $error['login'] = 'failed';
        }
    } else {
        $error['login'] = 'blank';
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
        <div class="main_view row">
            <h2>ログインする</h2>
            <p>メールアドレスとパスワードを入力してログインしてください</p>
            <p>ユーザー登録がまだの方はこちらからどうぞ</p>
            <p>&raquo;<a href="join/">入会手続きをする</a></p>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">メールアドレス</label>
                    <input type="email" name="email" class="form-control" id="exampleFormControlInput1" size="35" maxlength="255" value="<?php print(htmlspecialchars($email, ENT_QUOTES)); ?>">
                    <?php if ($error['login'] === 'blank') : ?>
                        <p class="error">※メールアドレスとパスワードを入力してください</p>
                    <?php endif; ?>
                    <?php if ($error['login'] === 'failed') : ?>
                        <p class="error">※ログインに失敗しました。正しく入力してください。</p>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">パスワード</label>
                    <input type="password" name="password" class="form-control" id="exampleFormControlInput1" size="10" maxlength="20" value="<?php print(htmlspecialchars($_POST['password'], ENT_QUOTES)); ?>">
                </div>
                <!-- <div class="mb-3">
                    <p>ログイン情報の記録</p>
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">次回からは自動的にログインする</label>
                </div> -->
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">ログインする</button>
                </div>
            </form>
        </div>
    </main>
    <footer>
        <small>@2021 Welcome Kazuki</small>
    </footer>

</body>

</html>