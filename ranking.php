<?php
session_start();
require('dbconnect.php');

$ranks = $db->query('SELECT * FROM users ORDER BY coins DESC LIMIT 0,5');

if (($_POST['finish']) == 'top') {
    header('Location: index.php');
    exit();
}
if (($_POST['finish']) == 'out') {
    header('Location: logout.php');
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
        <h1>ランキング</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">user</th>
                    <th scope="col"> </th>
                    <th scope="col">coins</th>
                    <th scope="col">latest_play</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ranks as $rank) : ?>
                    <tr>
                        <td><?php print(htmlspecialchars($rank['name'])); ?></td>
                        <td><img src="user_image/<?php print(htmlspecialchars($rank['picture'])); ?>" alt=""></td>
                        <td><?php print(htmlspecialchars($rank['coins'])); ?></td>
                        <td><?php print(htmlspecialchars($rank['modified'])); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <form class="row" action="" method="post" enctype="multipart/form-data">
            <div class="col-auto">
                <button type="submit" name="finish" value="top" class="btn btn-primary mb-3">トップに戻る</button>
            </div>
            <div class="col-auto">
                <button type="submit" name="finish" value="out" class="btn btn-primary mb-3">ログアウト</button>
            </div>
        </form>
    </main>
    <footer>
    </footer>
</body>

</html>