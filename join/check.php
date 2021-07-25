<?php
session_start();
require('../dbconnect.php');

if (!isset($_SESSION['join'])) {
    header('Location: index.php');
    exit();
}

// フォームが送信された場合
if (!empty($_POST)) {
	// DBに登録
    $statement = $db->prepare('INSERT INTO users SET name=?, email=?, password=?, picture=?, coins=10, created=NOW()');
    $statement -> execute(array(
        $_SESSION['join']['name'],
        $_SESSION['join']['email'],
        sha1($_SESSION['join']['password']),
        $_SESSION['join']['image']
    ));
    unset($_SESSION['join']);    

    header('Location: thanks.php');
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
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body class="container">
    <header>
        <h2>むかしなつかし～じゃんけんゲーム～</h2>
    </header>
    <main>
        <div class="main_view row">
            <h3>ユーザー登録確認</h3>
            <p>記入した内容を確認して、「登録する」ボタンをクリックしてください。</p>
            <form action="" method="post">
                <input type="hidden" name="action" value="submit" />
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">ユーザー名</label>
                    <p><?php print(htmlspecialchars($_SESSION['join']['name'])); ?></p>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">メールアドレス</label>
                    <p><?php print(htmlspecialchars($_SESSION['join']['email'])); ?></p>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">パスワード</label>
                    <p>『表示しません』</p>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">画像など</label>
                    <p>
                        <?php if ($_SESSION['join']['image'] !== '') : ?>
                            <img src="../user_image/<?php print(htmlspecialchars($_SESSION['join']['image'], ENT_QUOTES)); ?>" alt="ユーザー画像">
                        <?php endif; ?>
                    </p>
                </div>
                <div class="col-auto">
                    <a class="mb-3" href="index.php?action=rewrite">&laquo;&nbsp;変更する</a>
                    <button type="submit" class="btn btn-primary mb-3">登録する</button>
                </div>
            </form>
        </div>
    </main>
    <footer>
        <small>@2021 Welcome Kazuki</small>
    </footer>

</body>

</html>