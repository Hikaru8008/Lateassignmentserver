<?php
require 'db_config.php';
$current_user_id = 1;
$card_id = isset($_GET['card_id']) ? (int)$_GET['card_id'] : 0;
if(!$card_id) die("カードIDが指定されていません");

$stmt = $pdo->prepare("SELECT user_card_id, in_team FROM user_cards WHERE user_id=:uid AND card_id=:cid");
$stmt->execute([':uid'=>$current_user_id, ':cid'=>$card_id]);
$instances = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>ベースカード選択</title></head>
<body>
<h1>ベースカードインスタンス選択</h1>
<table border="1">
<tr><th>インスタンスID</th><th>チーム編成中</th><th>選択</th></tr>
<?php foreach($instances as $i): ?>
<tr>
<td><?= $i['user_card_id'] ?></td>
<td><?= $i['in_team'] ? '〇' : '×' ?></td>
<td>
<?php if($i['in_team']==0): ?>
<a href="forge_select_material.php?card_id=<?= $card_id ?>&base_id=<?= $i['user_card_id'] ?>">ベースに決定</a>
<?php else: ?>
素材不可
<?php endif; ?>
</td>
</tr>
<?php endforeach; ?>
</table>
<a href="forge_entrance.php">戻る</a>
</body>
</html>
