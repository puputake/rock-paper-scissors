<?php
session_start();
require('../dbconnect.php');

// フォームが送信された場合
if (!empty($_POST)) {
    // エラーチェック
    if ($_POST['name'] === '') {
        $error['name'] = 'blank';
    }
    if ($_POST['email'] === '') {
        $error['email'] = 'blank';
    }
    if (strlen($_POST['password']) < 4) {
        $error['password'] = 'length';
    }
    if ($_POST['password'] === '') {
        $error['password'] = 'blank';
    }
    $fileName = $_FILES['image']['name'];
    if (!empty($fileName)) {
        $ext = substr($fileName, -3);
        if ($ext != 'jpg' && $ext != 'png' && $ext != 'gif') {
            $error['image'] = 'type';
        }
    }

    //アカウントの重複をチェック
    if (empty($error)) {
        $member = $db->prepare('SELECT COUNT(*) AS cnt FROM users WHERE email=?');
        $member->execute(array($_POST['email']));
        $record = $member->fetch();
        if ($record['cnt'] > 0) {
            $error['email'] = 'duplicate';
        }
    }

    // 画像をmember_pictureフォルダに保存
    if (empty($error)) {
        $image = date('YmdHis') . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], '../member_picture/' . $image);
        $_SESSION['join'] = $_POST;
        $_SESSION['join']['image'] = $image;
        header('Location: check.php');
        exit();
    }
}

// check.phpで「変更する」を押された場合
if ($_REQUEST['action'] == 'rewrite' && isset($_SESSION['join'])) {
    $_POST = $_SESSION['join'];
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
            <h3>ユーザー登録</h3>
            <p>次の項目に必要事項を入力してください</p>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">ユーザー名<span class="required"> ※ 必須</span></label>
                    <input type="text" name="name" class="form-control" id="exampleFormControlInput1">
                    <?php if ($error['name'] === 'blank') : ?>
                        <p class="error">※ユーザー名を入力してください</p>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">メールアドレス<span class="required"> ※ 必須</span></label>
                    <input type="email" name="email" class="form-control" id="exampleFormControlInput1">
                    <?php if ($error['email'] === 'blank') : ?>
                        <p class="error">※メールアドレスを入力してください</p>
                    <?php endif; ?>
                    <?php if ($error['email'] === 'duplicate') : ?>
                        <p class="error">*指定されたメールアドレスは既に登録されています</p>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">パスワード<span class="required"> ※ 必須（４文字以上）</span></label>
                    <input type="password" name="password" class="form-control" id="exampleFormControlInput1">
                    <?php if ($error['password'] === 'length') : ?>
                        <p class="error">※パスワードは４文字以上で入力してください</p>
                    <?php endif; ?>
                    <?php if ($error['password'] === 'blank') : ?>
                        <p class="error">※パスワードを入力してください</p>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">画像など</label>
                    <input class="form-control" type="file" name="image" id="formFile">
                    <?php if ($error['image'] === 'type') : ?>
                        <p class="error">※画像ファイルを添付してください</p>
                    <?php endif; ?>
                    <?php if (!empty($error)) : ?>
                        <p class="error">※恐れ入りますが、画像を改めて指定してください</p>
                    <?php endif; ?>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">入力内容を確認する</button>
                </div>
            </form>
        </div>
    </main>
    <footer>
        <small>@2021 Welcome Kazuki</small>
    </footer>

</body>

</html>