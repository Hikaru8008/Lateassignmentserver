<?php
require_once __DIR__ . '/db_config.php';

// ================================
// POSTチェック
// ================================
$userId = $_POST['user_id'] ?? null;
if (!$userId) {
    die("ユーザーIDが指定されていません。フォームからアクセスしてください。");
}

// ================================
// ガチャ設定
// ================================
$gachaId = 1;
$drawCount = 10;

// ================================
// ガチャアイテム取得
// ================================
$sql = "
    SELECT g.item_id, i.item_name, i.rarity, g.weight
    FROM gacha_items g
    JOIN items i ON g.item_id = i.item_id
    WHERE g.gacha_id = :gacha_id
";

$stmt = $pdo->prepare($sql);
$stmt->execute(['gacha_id' => $gachaId]);
$items = $stmt->fetchAll();

if (!$items) {
    die('ガチャデータがありません');
}

// ================================
// 重み合計
// ================================
$totalWeight = array_sum(array_column($items, 'weight'));

// ================================
// ガチャ処理
// ================================
$results = []; // ←ここで必ず初期化

for ($i = 0; $i < $drawCount; $i++) {
    $rand = mt_rand(1, $totalWeight);
    $current = 0;
    foreach ($items as $item) {
        $current += $item['weight'];
        if ($rand <= $current) {
            $results[] = $item;
            break;
        }
    }
}

// ================================
// レア度色設定
// ================================
$rarityColors = [
    '神レア' => 'gold',
    '超レア' => 'purple',
    'レア' => 'blue',
    '普通' => 'gray',
    'ガラクタ' => 'brown'
];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>ガチャ結果</title>
<style>
body { font-family: sans-serif; }
.item {
    font-size: 1.2em;
    margin-bottom: 10px;
    opacity: 0;
    transform: rotateX(90deg);
    transition: all 0.5s ease;
    display: inline-block;
}
.item.show {
    opacity: 1;
    transform: rotateX(0deg);
}
</style>
</head>
<body>
<h1>ガチャ結果</h1>

<div id="results-container">
    <?php if (!empty($results)): ?>
        <?php foreach ($results as $index => $item): ?>
            <div class="item"
                 style="color: <?= $rarityColors[$item['rarity']] ?? 'black' ?>;"
                 data-index="<?= $index ?>">
                <?= $index + 1 ?>：<?= htmlspecialchars($item['item_name'], ENT_QUOTES, 'UTF-8') ?>
                (<?= $item['rarity'] ?>)
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>ガチャ結果はありません。</p>
    <?php endif; ?>
</div>

<br>
<a href="gacha_form.php">戻る</a>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const items = document.querySelectorAll(".item");
    items.forEach((item, index) => {
        setTimeout(() => {
            item.classList.add("show");
        }, index * 500); 
    });
});
</script>
</body>
</html>
