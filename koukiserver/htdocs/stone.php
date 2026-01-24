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
<title>石を集める</title>

<style>
body {
    margin: 0;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;     
    font-family: sans-serif;
    background: #f0f0f0;
}

.box {
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    text-align: center;
    width: 300px;
}

button {
    padding: 10px 20px;
    margin-top: 10px;
    font-size: 16px;
    cursor: pointer;
}
</style>
</head>
<body>

<div class="box">
    <h2>石を集める</h2>

    <p>現在の石：<span id="stone"><?= $_SESSION['stone'] ?></span></p>

    <button id="addStone">石を1個もらう</button>

    <br><br>

    <form action="gacha_form.php" method="get">
        <button type="submit">戻る</button>
    </form>
</div>

<script>
const stoneEl = document.getElementById('stone');
const btn = document.getElementById('addStone');

btn.addEventListener('click', () => {
    fetch('stone_add.php', { method: 'POST' })
        .then(res => res.json())
        .then(data => {
            stoneEl.textContent = data.stone;
        });
});
</script>

</body>
</html>
