<?php
session_start();
if (!isset($_SESSION['stone'])) {
    $_SESSION['stone'] = 0;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>ガチャフォーム</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="box">
    <h2>ガチャフォーム</h2>
    <p>所持石：<?= $_SESSION['stone'] ?></p>

    <form action="stone.php" method="get">
        <button type="submit">石を集める</button>
    </form>

    <form action="gacha_result.php" method="post">
        <button name="type" value="1">1連（石5個）</button>
        <button name="type" value="10">10連（石50個）</button>
    </form>
</div>
</body>
</html>
