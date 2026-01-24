<?php
session_start();

$type = (int)($_POST['type'] ?? 0);
$cost = ($type === 10) ? 50 : 5;

if ($_SESSION['stone'] < $cost) {
    $error = "石が足りません";
} else {
    $_SESSION['stone'] -= $cost;
    $results = [];

    for ($i = 0; $i < $type; $i++) {
        $rand = rand(1, 100);
        if ($rand <= 5) {
            $results[] = "神レア";
        } elseif ($rand <= 30) {
            $results[] = "レア";
        } else {
            $results[] = "ノーマル";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>ガチャ結果</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="box">
    <h2>ガチャ結果</h2>

    <?php if (isset($error)): ?>
        <p><?= $error ?></p>
    <?php else: ?>
        <?php foreach ($results as $r): ?>
            <p><?= $r ?></p>
        <?php endforeach; ?>
    <?php endif; ?>

    <p>残り石：<?= $_SESSION['stone'] ?></p>

    <form action="gacha_form.php" method="get">
        <button type="submit">戻る</button>
    </form>
</div>
</body>
</html>
